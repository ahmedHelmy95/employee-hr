<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LeaveSummaryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'employee_id' => $this->employee_id,
            'employee_name' => $this->employee->name,
            'leaveType_id' => $this->leave_type_id,
            'leaveType_name' => $this->leaveType->name,
            'number_of_days' => $this->number_of_days,
            'leaves_taken' => $this->leaveType->leaveRequests->count()
        ];
    }
}
