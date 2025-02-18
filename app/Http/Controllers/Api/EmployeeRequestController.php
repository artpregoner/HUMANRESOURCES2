<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EmployeeRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Exception;

class EmployeeRequestController extends Controller
{
    /**
     * Get all employee requests
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $employeeRequests = EmployeeRequest::latest()->paginate(10);

            return response()->json([
                'success' => true,
                'message' => 'Employee requests retrieved successfully',
                'data' => $employeeRequests,
                'status_code' => 200
            ], 200);
        } catch (Exception $e) {
            Log::error('Failed to retrieve employee requests: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve employee requests',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error',
                'status_code' => 500
            ], 500);
        }
    }

    /**
     * Store a new employee request
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string|max:255',
                'middle_name' => 'nullable|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:employee_requests,email',
                'phone' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10'],
                'birthdate' => 'required|date|before:today',
                'gender' => 'required|in:Male,Female',
                'civil_status' => 'required|string|in:single,married,divorced,widowed,separated,engaged',
                'address' => 'required|string|max:500',
                'social_media' => 'nullable|string|max:255',
                'department' => 'required|string|in:admin,hr1,hr2,hr3,finance,logistic1,logistic2,core1,core2,core3',
                'emergency_name' => 'required|string|max:255',
                'emergency_address' => 'required|string|max:500',
                'emergency_phone' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10'],
                'emergency_relationship' => 'required|string|max:100',
            ], [
                'phone.regex' => 'The phone number must be valid.',
                'emergency_phone.regex' => 'The emergency phone number must be valid.',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation errors',
                    'errors' => $validator->errors(),
                    'status_code' => 422
                ], 422);
            }

            // Sanitize and prepare input data
            $validatedData = $validator->validated();
            $validatedData = array_map('trim', $validatedData);

            // Create employee request
            $employeeRequest = EmployeeRequest::create($validatedData);

            // Log successful creation
            Log::info('New employee request created', ['id' => $employeeRequest->id, 'email' => $employeeRequest->email]);

            return response()->json([
                'success' => true,
                'message' => 'Employee request submitted successfully',
                'data' => $employeeRequest,
                'status_code' => 201
            ], 201);

        } catch (Exception $e) {
            Log::error('Failed to create employee request: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to create employee request',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error',
                'status_code' => 500
            ], 500);
        }
    }

    /**
     * Get a specific employee request
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $employeeRequest = EmployeeRequest::find($id);

            if (!$employeeRequest) {
                return response()->json([
                    'success' => false,
                    'message' => 'Employee request not found',
                    'status_code' => 404
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Employee request retrieved successfully',
                'data' => $employeeRequest,
                'status_code' => 200
            ], 200);
        } catch (Exception $e) {
            Log::error('Failed to retrieve employee request: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve employee request',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error',
                'status_code' => 500
            ], 500);
        }
    }

    /**
     * Update an employee request
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        try {
            $employeeRequest = EmployeeRequest::find($id);

            if (!$employeeRequest) {
                return response()->json([
                    'success' => false,
                    'message' => 'Employee request not found',
                    'status_code' => 404
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'first_name' => 'sometimes|string|max:255',
                'middle_name' => 'nullable|string|max:255',
                'last_name' => 'sometimes|string|max:255',
                'email' => 'sometimes|email|unique:employee_requests,email,' . $id,
                'phone' => ['sometimes', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10'],
                'birthdate' => 'sometimes|date|before:today',
                'gender' => 'sometimes|in:Male,Female',
                'civil_status' => 'sometimes|string|in:single,married,divorced,widowed,separated,engaged',
                'address' => 'sometimes|string|max:500',
                'social_media' => 'nullable|string|max:255',
                'department' => 'sometimes|string|in:admin,hr1,hr2,hr3,finance,logistic1,logistic2,core1,core2,core3',
                'emergency_name' => 'sometimes|string|max:255',
                'emergency_address' => 'sometimes|string|max:500',
                'emergency_phone' => ['sometimes', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10'],
                'emergency_relationship' => 'sometimes|string|max:100',
            ], [
                'phone.regex' => 'The phone number must be valid.',
                'emergency_phone.regex' => 'The emergency phone number must be valid.',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation errors',
                    'errors' => $validator->errors(),
                    'status_code' => 422
                ], 422);
            }

            // Sanitize and prepare input data
            $validatedData = $validator->validated();
            $validatedData = array_map('trim', $validatedData);

            // Update employee request
            $employeeRequest->update($validatedData);

            // Log successful update
            Log::info('Employee request updated', ['id' => $employeeRequest->id]);

            return response()->json([
                'success' => true,
                'message' => 'Employee request updated successfully',
                'data' => $employeeRequest,
                'status_code' => 200
            ], 200);

        } catch (Exception $e) {
            Log::error('Failed to update employee request: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to update employee request',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error',
                'status_code' => 500
            ], 500);
        }
    }

    /**
     * Delete an employee request
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $employeeRequest = EmployeeRequest::find($id);

            if (!$employeeRequest) {
                return response()->json([
                    'success' => false,
                    'message' => 'Employee request not found',
                    'status_code' => 404
                ], 404);
            }

            // Delete employee request
            $employeeRequest->delete();

            // Log successful deletion
            Log::info('Employee request deleted', ['id' => $id]);

            return response()->json([
                'success' => true,
                'message' => 'Employee request deleted successfully',
                'status_code' => 200
            ], 200);

        } catch (Exception $e) {
            Log::error('Failed to delete employee request: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to delete employee request',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error',
                'status_code' => 500
            ], 500);
        }
    }
}
