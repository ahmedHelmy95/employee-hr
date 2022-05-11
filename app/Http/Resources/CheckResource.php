<?php

namespace App\Http\Resources;

use App\Models\Employee;
use Illuminate\Http\Resources\Json\JsonResource;

class CheckResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $emp = Employee::findOrFail($this->employee_id);
        return [
            'id' => $this->id,
            "employee" => $emp->name, 
            "status" => $this->status, 
            "check_in" => $this->check_in, 
            "check_out" => $this->check_out, 
            "time" => $this->time
        ];
    }
}
