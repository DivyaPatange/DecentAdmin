<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Teacher;
use Illuminate\Support\Facades\Hash;

class TeachersController extends Controller
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
                return '<img src="'.$imageUrl.'" width="100px">';
                }
                else
                {
                $imageUrl = asset('avatar.jpg');
                return '<img src="'.$imageUrl.'" width="100px">';
                }
            })
            ->addColumn('action', 'admin.teachers.status')
            ->addColumn('action1', 'admin.teachers.action')
            ->rawColumns(['photo', 'action', 'action1'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.teachers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.teachers.create');
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
        // dd($request->file('photo'));
        if($image != '')
        {
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('teacherPhoto'), $image_name);
            $teacher->photo =$image_name;
        }
        $teacher->username = $request->username;
        $teacher->password = Hash::make($request->password);
        $teacher->save();
        return redirect('/admin/teachers')->with('success', 'Teacher Profile Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $teacher = Teacher::findorfail($id);
        return view('admin.teachers.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teacher = Teacher::findorfail($id);
        return view('admin.teachers.edit', compact('teacher'));
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
        $teacher = Teacher::findorfail($id);
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
            'dob' => $request->dob,
            'gender' => $request->gender,
            'religion' => $request->religion,
            'email' => $request->email,
            'mobile_no' => $request->mobile_no,
            'employee_id' => $request->employee_id,
            'joining_date' => $request->joining_date,
            'address' => $request->address,
            'photo' => $image_name,
        );
        $teacher = Teacher::whereId($id)->update($input_data);
        return redirect('/admin/teachers')->with('success', 'Teacher Profile Updated Successfully');
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
        return response()->json(['success' => 'Teacher Profile Deleted Successfully']);
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
        return response()->json(['success' => 'Teacher Profile Status Changed Successfully']);
    }
}
