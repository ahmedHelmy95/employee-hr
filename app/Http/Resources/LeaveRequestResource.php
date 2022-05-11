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
        return [
            'id' => $this->id,
            'description' => $this->description,
            'form_date' => $this->form_date,
            'to_date' => $this->to_date,
            'manager_id' => $this->manager_id,
            'employee_id' => $this->employee_id,
            'manager_name' => $this->manager->name,
            'employee_name' => $this->employee->name,
            'leave_type_id'=>$this->leave_type_id,
            'state'=>$this->state,
            'reason'=>$this->reason,
            "leave_type" => $this->leaveType->name,
            'created_at' => $this->created_at

        ];
    }
}
