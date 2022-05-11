<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens; 
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Contracts\Auth\MustVerifyEmail; 

class Employee extends Authenticatable
{
    use HasFactory, Notifiable,HasApiTokens;
    
    public function getRouteKeyName()
    {
        return 'name';
    }
    protected $table = 'users';
    protected $fillable = [
        'name', 'email','password', 'pin_code'
    ];

  

    protected $hidden = [
        'pin_code', 'remember_token','password'
    ];


    public function check()
    {
        return $this->hasMany(Check::class);
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }
    public function latetime()
    {
        return $this->hasMany(Latetime::class);
    }
    public function leave()
    {
        return $this->hasMany(Leave::class);
    }
    public function overtime()
    {
        return $this->hasMany(Overtime::class);
    }
    public function schedules()
    {
        return $this->belongsToMany('App\Models\Schedule', 'schedule_employees', 'employee_id', 'schedule_id');
    }


    

}
