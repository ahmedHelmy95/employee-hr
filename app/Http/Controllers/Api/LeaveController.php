<?php

namespace App\Http\Controllers\Api;

use App\Models\Leave;
use Illuminate\Http\Request;
use App\Http\Requests\LeaveRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\LeaveResource;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leaves = Leave::all();
        return LeaveResource::collection($leaves)->additional(['message' => 'get all data', 'code' => 200]);
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LeaveRequest $request)
    {
        $data=$request->all();
        $data['creator_id'] = auth('api')->id();
        LeaveRequest::create($data);
        return ['data' =>null,
            'message' => 'Created successfully', 'code' => 200];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function show(Leave $leave)
    {
        return ['data' => new LeaveResource($leave),
            'message' => 'get data', 'code' => 200];
    }

     

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function update(LeaveRequest $request, Leave $leave)
    {
        $data=$request->all();
        $data['creator_id'] = auth('api')->id();
        $leave->update($data);
        return ['data' => new LeaveResource($leave),
        'message' => 'updated successfully', 'code' => 200];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function destroy(Leave $leave)
    {
        $leave->delete();
        return ['data' => null,
        'message' => 'updated successfully', 'code' => 200];
    }

    public function getLeaveSummary()
    {
        dd('sssss');
    }
}
