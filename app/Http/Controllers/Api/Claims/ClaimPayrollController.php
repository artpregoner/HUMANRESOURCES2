<?php

namespace App\Http\Controllers\Api\Claims;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Claim;
use App\Http\Resources\ClaimResource;
use App\Http\Requests\SendToPayrollRequest;
use App\Http\Requests\PayrollUpdateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
class ClaimPayrollController extends Controller
{
    /**
     * Send approved claims to HR3 payroll system
     */
    public function sendToPayroll(SendToPayrollRequest $request): JsonResponse
    {
        try {
            $claims = Claim::whereIn('id', $request->claim_ids)
                ->where('status', 'approved')
                ->where('sent_to_payroll_at', null)
                ->get();

            if ($claims->isEmpty()) {
                return response()->json([
                    'message' => 'No eligible claims found to send to payroll'
                ], 404);
            }

            // Prepare data for HR3
            $payrollData = $claims->map(function ($claim) {
                return [
                    'claim_id' => $claim->id,
                    'employee_id' => $claim->user_id,
                    'expense_date' => $claim->expense_date->format('Y-m-d'),
                    'description' => $claim->description,
                    'amount' => $claim->total_amount,
                    'currency' => $claim->currency,
                    'items' => $claim->items->map(function ($item) {
                        return [
                            'category' => $item->category?->name,
                            'details' => $item->details,
                            'amount' => $item->amount,
                            'currency' => $item->currency,
                        ];
                    }),
                    'attachments' => $claim->attachments->map(function ($attachment) {
                        return [
                            'file_name' => $attachment->file_name,
                            'file_path' => $attachment->file_path,
                            'file_type' => $attachment->file_type,
                        ];
                    }),
                ];
            });

            // Send to HR3 API
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.hr3.api_key'),
            ])->post(config('services.hr3.endpoint') . '/claims', [
                'claims' => $payrollData
            ]);

            if (!$response->successful()) {
                Log::error('HR3 API Error', [
                    'status' => $response->status(),
                    'response' => $response->json()
                ]);

                return response()->json([
                    'message' => 'Failed to send claims to HR3 system'
                ], 500);
            }

            // Update claims status
            foreach ($claims as $claim) {
                $claim->sendToPayroll();
            }

            return response()->json([
                'message' => 'Claims successfully sent to payroll',
                'claims' => ClaimResource::collection($claims)
            ]);
        } catch (\Exception $e) {
            Log::error('Error sending claims to payroll', [
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'message' => 'An error occurred while processing the request'
            ], 500);
        }
    }

    /**
     * Receive updates from HR3 about claim status
     */
    public function handlePayrollUpdate(PayrollUpdateRequest $request): JsonResponse
    {
        try {
            $claim = Claim::findOrFail($request->claim_id);

            switch ($request->status) {
                case 'paid':
                    $claim->markAsPaid($request->processor_id);
                    $message = 'Claim marked as paid';
                    break;

                case 'rejected':
                    $claim->rejectByPayroll(
                        $request->processor_id,
                        $request->remarks
                    );
                    $message = 'Claim rejected by payroll';
                    break;

                default:
                    return response()->json([
                        'message' => 'Invalid status update'
                    ], 400);
            }

            return response()->json([
                'message' => $message,
                'claim' => new ClaimResource($claim)
            ]);

        } catch (\Exception $e) {
            Log::error('Error updating claim from payroll', [
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'message' => 'An error occurred while processing the update'
            ], 500);
        }
    }

    public function getApprovedClaims(): JsonResponse
    {
        $claims = Claim::where('status', 'approved')
            ->whereNull('sent_to_payroll_at')
            ->get();

        if ($claims->isEmpty()) {
            return response()->json([
                'message' => 'No approved claims available'
            ], 404);
        }

        return response()->json([
            'claims' => ClaimResource::collection($claims)
        ]);
    }

}
