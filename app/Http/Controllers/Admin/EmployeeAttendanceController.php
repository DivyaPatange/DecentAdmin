<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\EmployeeAttendance;
use App\Models\Admin\AttendanceEmployeeList;
use App\Models\Admin\Teacher;
use Auth;


class EmployeeAttendanceController extends Controller
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
    public function index(Request $request)
    {
        if(request()->ajax()) {
            if(!empty($request->date))
            {
                $empAttendance = EmployeeAttendance::where('attendance_date', $request->date)->first();
                if(!empty($empAttendance))
                {
                    $employeeList = AttendanceEmployeeList::where('emp_attendance_id', $empAttendance->id)->get();
                    
                }
            }
            return datatables()->of($employeeList)
            ->addColumn('name', function($row){    
                $employee = Teacher::where('id', $row->teacher_id)->first();
                if(!empty($employee))
                {
                    return $employee->name;
                }                                                                                                                                                                                                                                                                                              
            })
            ->addColumn('employee_id', function($row){    
                $employee = Teacher::where('id', $row->teacher_id)->first();
                if(!empty($employee))
                {
                return $employee->employee_id;
                }                                                                                                                                                                                                                                                                                               
            })
            ->addColumn('status', function($row){
                if($row->status == "Present"){
                    return '<span class="pcoded-badge label label-success ">'.$row->status.'</span>';
                }
                else{
                    return '<span class="pcoded-badge label label-danger ">'.$row->status.'</span>';
                }
            })
            ->addColumn('action', 'admin.employee-attendance.action')
            ->rawColumns(['name', 'action', 'employee_id', 'status'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.employee-attendance.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.employee-attendance.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $empAttendance = EmployeeAttendance::where('attendance_date', date("Y-m-d", strtotime($request->date)))->first();
        if(empty($empAttendance))
        {
            $empAttend = new EmployeeAttendance();
            $empAttend->attendance_date = $request->date;
            $empAttend->created_by = "Admin";
            $empAttend->created_by_id = Auth::guard('admin')->user()->id;
            $empAttend->save();
            
            $employee = Teacher::where('status', 1)->get();
            $output = '';
            foreach($employee as $key => $s)
            {
                $output .= '<tr>'.
                    '<td>'.++$key.'</td>'.
                    '<td>'.$s->name.'</td>'.
                    '<td>'.$s->employee_id.'</td>'.
                    '<td><input type="hidden" name="teacher_id" value="'.$s->id.'"><div class="form-check"><input type="checkbox"  class="form-check-input" name="check_val" value="Absent" /></div></td>'.
                '</tr>';
            }

            return response()->json(['success' => 'Attendance Created Successfully!', 'id' => $empAttend->id, 'date' => $empAttend->attendance_date, 'output' => $output]);
        }
        else{
            $employeeList = AttendanceEmployeeList::where('emp_attendance_id', $empAttendance->id)->get();
            if(count($employeeList) > 0)
            {
                return response()->json(['error' => 'Attendance is already created.']);
            }
            else{

                $employee = Teacher::where('status', 1)->get();
                $output = '';
                foreach($employee as $key => $s)
                {
                    $output .= '<tr>'.
                        '<td>'.++$key.'</td>'.
                        '<td>'.$s->name.'</td>'.
                        '<td>'.$s->employee.'</td>'.
                        '<td><input type="hidden" name="teacher_id" value="'.$s->id.'"><div class="form-check"><input type="checkbox"  class="form-check-input" name="check_val" value="Absent" /></div></td>'.
                    '</tr>';
                }
                return response()->json(['success' => 'Attendance Created Successfully!', 'id' => $empAttendance->id, 'date' => $empAttendance->attendance_date,
                'output' => $output]);
            }
        }
        // return empty($empAttendance);
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

    public function addEmployee(Request $request)
    {
        $obj = json_decode($request->Data, true);
            // $someObject = json_decode($someJSON);
        for($i=0; $i < count($obj); $i++)
        {
            $employee = AttendanceEmployeeList::where('emp_attendance_id', $request->id)->where('teacher_id', $obj[$i]["ID"])->first();
            if(empty($employee))
            {
                $employeeList = new AttendanceEmployeeList();
                $employeeList->emp_attendance_id = $request->id;
                $employeeList->teacher_id = $obj[$i]["ID"];
                $employeeList->status = $obj[$i]["Status"];
                $employeeList->save();
            }
        }
        return response()->json(['success' => 'Employee attendance marked']);
    }

    public function status($id, Request $request)
    {
        $employee = AttendanceEmployeeList::findorfail($id);
        if($employee->status == "Present")
        {
            $employee->status = "Absent";
        }
        else{
            $employee->status = "Present";
        }
        $employee->update($request->all());
        return response()->json(['success' => 'Status Changed Successfully']);
    }
}
