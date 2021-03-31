<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\LeavePolicy;

class LeavePolicyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.leave-policy.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $leavePolicy = LeavePolicy::where('id', $request->id)->first();
        if(empty($leavePolicy))
        {
            $leavePolicy = new LeavePolicy();
            $leavePolicy->casual_leave = $request->casual_leave;
            $leavePolicy->sick_leave = $request->sick_leave;
            $leavePolicy->maternity_leave = $request->maternity_leave;
            $leavePolicy->special_leave = $request->special_leave;
            $leavePolicy->save();
            return response()->json(['success' => 'Leave Policy Created Successfully']);
        }
        else{
            $input_data = array (
                'casual_leave' => $request->casual_leave,
                'sick_leave' => $request->sick_leave,
                'maternity_leave' => $request->maternity_leave,
                'special_leave' => $request->special_leave,
            );
    
            LeavePolicy::whereId($leavePolicy->id)->update($input_data);
            return response()->json(['success' => 'Leave Policy Updated Successfully']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getLeavePolicy(Request $request)
    {
        $leavePolicy = LeavePolicy::where('id', $request->bid)->first();
        if (!empty($leavePolicy)) 
        {
            $data = array('casual_leave' =>$leavePolicy->casual_leave,'sick_leave' =>$leavePolicy->sick_leave,'maternity_leave'=>$leavePolicy->maternity_leave,'special_leave' =>$leavePolicy->special_leave
            );
        }else{
            $data =0;
        }
        echo json_encode($data);
    }
}
