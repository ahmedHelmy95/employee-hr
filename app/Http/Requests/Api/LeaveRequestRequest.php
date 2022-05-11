<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class LeaveRequestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'form_date' => 'required|date',
            'to_date' => 'required|date|after:form_date',
            'description'=>'required|string',
            'leave_type_id'=>'required|exists:leave_types,id'
        ];
    }
}
