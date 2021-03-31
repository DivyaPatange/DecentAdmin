<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Teacher;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin\AttendanceEmployeeList;
use App\Models\Admin\EmployeeAttendance;

class EmployeeController extends Controller
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
        $teachers = Teacher::orderBy('id', 'DESC')->get();
        if(request()->ajax()) {
            return datatables()->of($teachers)
            ->addColumn('photo', function($row){
                if(!empty($row->photo)){
                $imageUrl = asset('teacherPhoto/' . $row->photo);
                return '<img src="'.$imageUrl.'" width="50px">';
                }
                else
                {
                $imageUrl = asset('avatar.png');
                return '<img src="'.$imageUrl.'" width="50px">';
                }
            })
            ->addColumn('action', 'admin.employee.status')
            ->addColumn('action1', 'admin.employee.action')
            ->rawColumns(['photo', 'action', 'action1'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.employee.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.employee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $teacher = new Teacher();
        $teacher->name = $request->name;
        $teacher->designation = $request->designation;
        $teacher->qualification = $request->qualification;
        $teacher->dob = date("Y-m-d", strtotime($request->dob));
        $teacher->gender = $request->gender;
        $teacher->religion = $request->religion;
        $teacher->email = $request->email;
        $teacher->mobile_no = $request->mobile_no;
        $teacher->employee_id = $request->employee_id;
        $teacher->joining_date = date("Y-m-d", strtotime($request->joining_date));
        $teacher->address = $request->address;
        $image = $request->file('photo');
        $teacher->role_type = $request->role_type;
        // dd($request->file('photo'));
        if($image != '')
        {
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('teacherPhoto'), $image_name);
            $teacher->photo =$image_name;
        }
        $teacher->status = 1;
        $teacher->username = $request->username;
        $teacher->password = Hash::make($request->password);
        $teacher->save();
        return redirect('/admin/employee')->with('success', 'Employee Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empAttendance = AttendanceEmployeeList::where('teacher_id', $id)->get();
        if(request()->ajax()) {
            return datatables()->of($empAttendance)
            ->addColumn('date', function($row){
                $date = EmployeeAttendance::where('id', $row->emp_attendance_id)->first();
                if(!empty($date))
                {
                return $date->attendance_date;
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
            ->rawColumns(['date', 'status'])
            ->addIndexColumn()
            ->make(true);
        }
        $employee = Teacher::findorfail($id);
        return view('admin.employee.show', compact('employee', 'empAttendance'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Teacher::findorfail($id);
        return view('admin.employee.edit', compact('employee'));
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
        $employee = Teacher::findorfail($id);
        $image_name = $request->hidden_image;
        $image = $request->file('photo');
        if($image != '')
        {
            
        $image_name = rand() . '.' . $image->getClientOriginalExtension();
        // $image->storeAs('public/tempcourseimg',$image_name);
        $image->move(public_path('teacherPhoto'), $image_name);
        }
        $input_data = array (
            'name' => $request->name,
            'designation' => $request->designation,
            'qualification' => $request->qualification,
            'dob' => date("Y-m-d", strtotime($request->dob)),
            'gender' => $request->gender,
            'religion' => $request->religion,
            'email' => $request->email,
            'mobile_no' => $request->mobile_no,
            'employee_id' => $request->employee_id,
            'joining_date' => date("Y-m-d", strtotime($request->joining_date)),
            'address' => $request->address,
            'photo' => $image_name,
            'leave_date' => date("Y-m-d", strtotime($request->leave_date)),
            'role_type' => $request->role_type,
        );
        $employee = Teacher::whereId($id)->update($input_data);
        return redirect('/admin/employee')->with('success', 'Employee Profile Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $teacher = Teacher::findorfail($id);
        if($teacher->photo){
            unlink(public_path('teacherPhoto/'.$teacher->photo));
        }
        $teacher->delete();
        return response()->json(['success' => 'Employee Profile Deleted Successfully']);
    }

    public function status($id, Request $request)
    {
        $teacher = Teacher::findorfail($id);
        if($teacher->status == 1)
        {
            $teacher->status = 0;
        }
        else{
            $teacher->status = 1;
        }
        $teacher->update($request->all());
        return response()->json(['success' => 'Employee Profile Status Changed Successfully']);
    }
}
