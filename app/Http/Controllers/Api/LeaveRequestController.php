<?php

namespace App\Http\Controllers\Api;

use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\LeaveRequestResource;
use App\Http\Requests\Api\LeaveRequestRequest;
use App\Http\Requests\Api\RefuseRequestRequest;
use App\Http\Requests\Api\ApproveRequestRequest;

class LeaveRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth('api')->user();
        switch ($user->type) {
            case 'employee':
                $requests = LeaveRequest::whereEmployeeId($user->id)->get();
                break;
            case 'manager':
                $requests = LeaveRequest::whereEmployeeId($user->id)->orWhere('manager_id', $user->id)->get();
                break;
            default:
                $requests = LeaveRequest::all();
        }
        return LeaveRequestResource::collection($requests)->additional(['message' => 'get all data', 'code' => 200]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LeaveRequestRequest $request)
    {
        $data = $request->all();
        $data['manager_id'] = auth('api')->user()->manager_id ?? auth('api')->user()->id;
        $data['employee_id'] = auth('api')->user()->id;
        $leaveRequest = LeaveRequest::create($data);
        return ['data' => new LeaveRequestResource($leaveRequest),
            'message' => 'get data', 'code' => 200];

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LeaveRequest  $leaveRequest
     * @return \Illuminate\Http\Response
     */
    public function show(LeaveRequest $leaveRequest)
    {
        return ['data' => new LeaveRequestResource($leaveRequest),
        'message' => 'get data', 'code' => 200];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LeaveRequest  $leaveRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LeaveRequest $leaveRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LeaveRequest  $leaveRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(LeaveRequest $leaveRequest)
    {
        //
    }

    public function approve(ApproveRequestRequest $request, LeaveRequest $leaveRequest)
    {
         $leaveRequest->update(['state'=>true]);
         return ['data' => new LeaveRequestResource($leaveRequest),
        'message' => 'get data', 'code' => 200];
    }

    public function refuse(RefuseRequestRequest $request,LeaveRequest $leaveRequest)
    {
        $leaveRequest->update(['state'=>false,'reason'=>$request->reason]);
         return ['data' => new LeaveRequestResource($leaveRequest),
        'message' => 'get data', 'code' => 200];
    }
}
