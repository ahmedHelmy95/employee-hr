<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LeaveRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // dd($this->from_date);
        return [
            'id' => $this->id,
            'description' => $this->description,
            'from_date' => $this->from_date,
            'to_date' => $this->to_date,
            'manager_id' => $this->manager_id,
            'employee_id' => $this->employee_id,
            'manager_name' => $this->manager->name,
            'employee_name' => $this->employee->name,
            'leave_type_id'=>$this->leave_type_id,
            'state'=>$this->state,
            'status'=>$this->status,
            'job_title' => $this->employee->position,
            'employee_image' => 'https://icon-library.com/images/avatar-icon-images/avatar-icon-images-4.jpg',
            'number_of_days' => $this->number_of_days,
            'reason'=>$this->reason,
            "leave_type" => $this->leaveType->name,
            'created_at' => $this->created_at

        ];
    }
}
