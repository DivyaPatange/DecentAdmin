<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Teacher;
use DB;
use App\Models\Admin\EmployeeLeave;
use Carbon\CarbonPeriod;

class EmployeeLeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $employee = Teacher::where('status', 1)->get();
        if(request()->ajax()) {
            $employee1 = DB::table('employee_leaves');
            if(isset($request->employee_id) && !empty($request->employee_id))
            {
                $employee1 = $employee1->where('teacher_id', $request->employee_id); 
            }
            if(isset($request->leave_type))
            {
                $employee1 = $employee1->where('leave_type', $request->leave_type); 
            }
            if(isset($request->leave_date))
            {
                $employee1 = $employee1->where('leave_date', $request->leave_date); 
            }
            if(isset($request->type))
            {
                $employee1 = $employee1->where('type', $request->type); 
            }
            $employeeLeave = $employee1->orderBy('id', 'DESC')->get();
            return datatables()->of($employeeLeave)
            ->addColumn('status', 'admin.employee-leave.status')
            ->addColumn('action', 'admin.employee-leave.action')
            ->rawColumns(['action', 'status'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.employee-leave.index', compact('employee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employee = Teacher::where('status', 1)->get();
        return view('admin.employee-leave.create', compact('employee'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->start_date && $request->end_date){
            $period = CarbonPeriod::create($request->start_date, $request->end_date);
            foreach($period as $p)
            {
                $day_num = $p->format("N"); /* 'N' number days 1 (mon) to 7 (sun) */
                if($day_num < 7) { /* weekday */
                    $employee = Teacher::where('id', $request->employee_name)->first();
                    if(!empty($employee)){
                        $employeeLeave = new EmployeeLeave();
                        $employeeLeave->teacher_id = $request->employee_name;
                        $employeeLeave->employee_name = $employee->name;
                        $employeeLeave->leave_type = $request->leave_type;
                        $employeeLeave->leave_date = $p->format('Y-m-d');
                        $employeeLeave->description = $request->description;
                        $employeeLeave->save();
                    }
                    else{
                        return response()->json(['error' => 'Employee Not Found']);
                    }
                } 
                
            }
            return response()->json(['success' => 'Employee Leave Created Successfully']);
        }
        else{
            $employee = Teacher::where('id', $request->employee_name)->first();
            if(!empty($employee)){
                $employeeLeave = new EmployeeLeave();
                $employeeLeave->teacher_id = $request->employee_name;
                $employeeLeave->employee_name = $employee->name;
                $employeeLeave->leave_type = $request->leave_type;
                $employeeLeave->leave_date = $request->start_date;
                $employeeLeave->description = $request->description;
                $employeeLeave->save();
                return response()->json(['success' => 'Employee Leave Created Successfully']);
            }
            else{
                return response()->json(['error' => 'Employee Not Found']);
            }
        }
        // return (CarbonPeriod::create($request->start_date, $request->end_date));
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
        $employee = Teacher::where('status', 1)->get();
        $employeeLeave = EmployeeLeave::findorfail($id);
        return view('admin.employee-leave.edit', compact('employeeLeave', 'employee'));
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
        $employeeLeave = EmployeeLeave::where('id', $id)->first();
        $employee = Teacher::where('id', $request->employee_name)->first();
        if(!empty($employee)){
            $input_data = array (
                'teacher_id' => $request->employee_name,
                'leave_type' => $request->leave_type,
                'leave_date' => $request->leave_date,
                'description' => $request->description,
                'employee_name' => $employee->name,
            );

            EmployeeLeave::whereId($id)->update($input_data);
            return response()->json(['success' => 'Leave Updated Successfully']);
        }
        else{
            return response()->json(['error' => 'Employee Not Found']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employeeLeave = EmployeeLeave::findorfail($id);
        $employeeLeave->delete();
        return response()->json(['success' => 'Leave is Deleted Successfully!']);
    }

    public function confirmed($id)
    {
        $employeeLeave = EmployeeLeave::findorfail($id);
       
        $employeeLeave->status = "Approved";
        $employeeLeave->save();
        return response()->json(['success' => 'Leave is Approved Successfully!']);
    }
    public function rejected($id)
    {
        $employeeLeave = EmployeeLeave::findorfail($id);
       
        $employeeLeave->status = "Rejected";
        $employeeLeave->save();
        return response()->json(['success' => 'Leave is Rejected!']);
    }
}
