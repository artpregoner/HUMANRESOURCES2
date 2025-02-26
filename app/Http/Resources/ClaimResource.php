<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClaimResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
            ],
            'expense_date' => $this->expense_date->format('Y-m-d'),
            'description' => $this->description,
            'status' => $this->status,
            'total_amount' => $this->total_amount,
            'currency' => $this->currency,
            'payroll_status' => $this->payroll_status,
            'sent_to_payroll_at' => $this->sent_to_payroll_at?->format('Y-m-d H:i:s'),
            'paid_date' => $this->paid_date?->format('Y-m-d H:i:s'),
            'payroll_remarks' => $this->payroll_remarks,
            'items' => $this->whenLoaded('items'),
            'attachments' => $this->whenLoaded('attachments'),
        ];
    }
}
