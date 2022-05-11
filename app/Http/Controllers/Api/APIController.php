<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Check;
use App\Models\Leave;
use App\Models\Employee;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttendanceEmp;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\CheckResource;

class ApiController extends Controller
{
    // check in / out
    public function check()
    {
        $employee = auth('api')->user();
        $latest_check = Check::whereEmployeeId($employee->id)->whereDate('check_in', Carbon::today())->first();
        if ($latest_check == null) {
            $check = ApiController::newAttandance($employee);
            return response()->json(['data' => new CheckResource($check), 'success' => 'Successful in assign the leave'], 200);
        } else if ($latest_check->check_out !== null) {
            $latest_check->check_out = date("Y-m-d H:i:s");
            $latest_check->time = date("Y-m-d H:i:s");
            $latest_check->status = 'out';
            $latest_check->save();
            return response()->json(['data' => new CheckResource($latest_check), 'success' => 'Successful in assign the leave'], 200);
        } else { 
            $latest_check->check_out = date("Y-m-d H:i:s");
            $latest_check->time = date("Y-m-d H:i:s");
            $latest_check->status = 'out';
            $latest_check->save();
            return response()->json(['data' => new CheckResource($latest_check), 'success' => 'Successful in assign the leave'], 200);
        }

    }

    public function newAttandance($employee)
    {
        $check = new Check;
        $check->employee_id = $employee->id;
        $check->check_in = date("Y-m-d H:i:s");
        $check->time = date("Y-m-d H:i:s");
        $check->status = 'in';
        $check->check_out = null;
        $check->save();
        return $check;
    }
    public function MyStatus()
    {
        $employee = auth('api')->user();
        $check = Check::whereEmployeeId($employee->id)->latest()->first();
        return response()->json(['data' => new CheckResource($check),
            'success' => 'latest attendance status'], 200);
    }

    public function attendance(AttendanceEmp $request)
    {
        $request->validated();
        if ($employee = Employee::whereEmail(request('email'))->first()) {

            if (Hash::check($request->pin_code, $employee->pin_code)) {
                if (!Attendance::whereAttendance_date(date("Y-m-d"))->whereemployee_id($employee->id)->first()) {
                    $attendance = new Attendance;
                    $attendance->employee_id = $employee->id;
                    $attendance->check_in = date("H:i:s");
                    $attendance->attendance_date = date("Y-m-d");

                    if (!($employee->schedules->first()->time_in >= $attendance->check_in)) {
                        $attendance->status = 0;
                        AttendanceController::lateTime($employee);
                    };

                    $attendance->save();
                } else {
                    return response()->json(['error' => 'you assigned your attendance before'], 404);
                }
            } else {
                return response()->json(['error' => 'Failed to assign the attendance'], 404);
            }
        }
        return response()->json(['success' => 'Successful in assign the attendance'], 200);

    }

    public function leave(AttendanceEmp $request)
    {
        $request->validated();

        if ($employee = Employee::whereEmail(request('email'))->first()) {

            if (Hash::check($request->pin_code, $employee->pin_code)) {
                if (!Leave::wherecheck_in(date("Y-m-d"))->whereemployee_id($employee->id)->first()) {
                    $leave = new Leave;
                    $leave->employee_id = $employee->id;
                    $leave->check_out = date("H:i:s");
                    $leave->check_in = date("Y-m-d");
                    // ontime + overtime if true , else "early go" ....
                    if ($leave->check_out >= $employee->schedules->first()->time_out) {
                        leaveController::overTime($employee);
                    } else {
                        $leave->status = 0;
                    }

                    $leave->save();
                } else {
                    return response()->json(['error' => 'you assigned your leave before'], 404);
                }
            } else {
                return response()->json(['error' => 'Failed to assign the leave'], 404);
            }
        }
        return response()->json(['success' => 'Successful in assign the leave'], 200);
    }

}
