<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttDev extends Model
{
    use HasFactory;
    protected $table = 'attd_device';
    protected $fillable = [
        'uid', 'employee_id','check_in','attendance_date', 'state', 'type','created_at'
    ];

}
