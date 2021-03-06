<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttendanceEmp;
use App\Http\Resources\CheckResource;
use App\Models\Attendance;
use App\Models\Check;
use App\Models\Employee;
use App\Models\Leave;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    // check in / out
    public function check()
    {
        $employee = auth('api')->user();
        $latest_check = Check::whereEmployeeId($employee->id)->whereDate('check_in', Carbon::today())->first();
        if ($latest_check == null) {
            $check = ApiController::newAttandance($employee);
            return response()->json(['data' => new CheckResource($check), 'message' => 'Successful in assign the leave', 'code' => 200], 200);
        } else if ($latest_check->check_out !== null) {
            $latest_check->check_out = date("Y-m-d H:i:s");
            $latest_check->time = date("Y-m-d H:i:s");
            $latest_check->status = 'out';
            $latest_check->save();
            return response()->json(['data' => new CheckResource($latest_check), 'message' => 'Successful in assign the leave', 'code' => 200], 200);
        } else {
            $latest_check->check_out = date("Y-m-d H:i:s");
            $latest_check->time = date("Y-m-d H:i:s");
            $latest_check->status = 'out';
            $latest_check->save();
            return response()->json(['data' => new CheckResource($latest_check), 'message' => 'Successful in assign the leave', 'code' => 200], 200);
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
        if (!$check) {
            return response()->json(['data' => null,
                'message' => 'latest attendance status', 'code' => 200], 200);
        }
        return response()->json(['data' => new CheckResource($check),
            'message' => 'latest attendance status', 'code' => 200], 200);
    }

    public function attendance(AttendanceEmp $request)
    {
        $request->validated();
        if ($employee = Employee::whereEmail(request('email'))->first()) {

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
                return response()->json(['error' => 'you assigned your attendance before', 'code' => 404], 404);
            }

        }
        return response()->json(['message' => 'Successful in assign the attendance', 'code' => 200], 200);

    }

    public function leave(AttendanceEmp $request)
    {
        $request->validated();

        if ($employee = Employee::whereEmail(request('email'))->first()) {

             
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
                    return response()->json(['error' => 'you assigned your leave before', 'code' => 404], 404);
                }
            
        }
        return response()->json(['message' => 'Successful in assign the leave', 'code' => 200], 200);
    }

}
