<?php

namespace App\Models;

 
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LeaveRequest extends Model
{
    protected $guarded = [];
    protected $appends = ['number_of_days'];

    /**
     * Get the employee that owns the LeaveRequest
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'employee_id', 'id');
    }

    /**
     * Get the manager that owns the LeaveRequest
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'manager_id', 'id');
    }

    /**
     * Get the manager that owns the LeaveRequest
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function leaveType(): BelongsTo
    {
        return $this->belongsTo(LeaveType::class, 'leave_type_id', 'id');
    }

    public function getNumberOfDaysAttribute()
    {
        $from_date = Carbon::parse($this->from_date); 
        $to_date = Carbon::parse($this->to_date);
         

        return $from_date->diffInDays($to_date);
        
    }
}
