<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Classes;
use App\Models\Admin\Section;
use App\Models\Admin\Admission;
use App\Models\Admin\Student;
use App\Models\Admin\AcademicYear;
use Auth;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $classes = Classes::where('status', 1)->get();

        if(request()->ajax()) 
        {
            // dd($request->academic);s
            if($request->section && $request->classs)
            {
                $data = Student::where('class_id', $request->classs)->where('section_id', $request->section)->get();
            }
            else{
                $data = Student::all();
            }
            return datatables()->of($data)
            ->addColumn('student_photo', function($row){
                $admission = Admission::where('id', $row->admission_id)->first();
                if(!empty($admission->student_photo)){
                $imageUrl = asset('studentPhoto/' . $admission->student_photo);
                return '<img src="'.$imageUrl.'" width="100px">';
                }
                else
                {
                $imageUrl = asset('avatar.png');
                return '<img src="'.$imageUrl.'" width="100px">';
                }
            })
            ->addColumn('name', function($row){
                $admission = Admission::where('id', $row->admission_id)->first();
                if(!empty($admission))
                {
                    if($admission->admission_for == "Junior College Admission")
                    {
                        return $admission->student_name;
                    }
                    else{
                        return $admission->full_name_pupil;
                    }
                }
            })
            ->addColumn('mobile_no', function($row){
                $admission = Admission::where('id', $row->admission_id)->first();
                if(!empty($admission))
                {
                    return $admission->mobile_no;
                }
            })
            ->addColumn('address', function($row){
                $admission = Admission::where('id', $row->admission_id)->first();
                if(!empty($admission))
                {
                    if($admission->admission_for == "Junior College Admission")
                    {
                        return $admission->address;
                    }
                    else{
                        return $admission->postal_address;
                    }
                }
            })
            ->addColumn('status', 'admin.students.status')
            ->addColumn('action', 'admin.students.action')
            ->rawColumns(['action','student_photo', 'name', 'mobile_no',  'status','address'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.students.index', compact('classes'));
    }

    public function getSectionList(Request $request)
    {
        $section = Section::where('class_id', $request->class_id)->where('status', 1)->pluck("section_name","id");
        return response()->json($section);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $admission = Admission::where('adm_sought', $request->classes)->where('academic_id', $request->academic_id)->where('is_register', 0)->get();
        if(request()->ajax()) {
            return datatables()->of($admission)
            ->addColumn('student_name', function($row){
                if($row->admission_for == "Junior College Admission")
                {
                    return $row->student_name;
                }
                else{
                    return $row->full_name_pupil;
                }
            })
            ->addColumn('check_val', function($row){
                $button = '<div class="form-check"><input type="checkbox"  class="form-check-input" name="check_val" value="'.$row->id.'" /></div>';
                return $button;
            })
            ->addColumn('roll_no', function($row){
                $button = '<input type="text"  class="form-control" name="roll_no" />';
                return $button;
            })
            ->addColumn('class', function($row){
                $class = Classes::where('id', $row->adm_sought)->first();
                if(!empty($class))
                {
                    return $class->class_name;
                }
            })
            ->rawColumns(['check_val', 'roll_no', 'student_name', 'class'])
            ->addIndexColumn()
            ->make(true);
        }
        $classes = Classes::where('status', 1)->get();
        $academicYear = AcademicYear::where('status', 1)->get();
        return view('admin.students.create', compact('classes', 'academicYear'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $obj = json_decode($request->Data, true);
            // $someObject = json_decode($someJSON);
        for($i=0; $i < count($obj); $i++)
        {
            $id = mt_rand(1000,9999);
            $student = new Student();
            $student->class_id = $request->classes;
            $student->section_id = $request->section;
            $student->academic_id = $request->academic_id;
            $student->admission_id = $obj[$i]["ID"];
            $student->roll_no = $obj[$i]["Roll"];
            $student->regi_no = $id;
            $student->status = 1;
            $student->is_promoted = 0;
            $student->created_by = Auth::guard('admin')->user()->id;
            $student->save();
            $admission = Admission::where('id', $obj[$i]["ID"])->update(['is_register' => 1]);
        }
        return response()->json(['success' => 'Student Added Successfully']);
        // return $obj;
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
        $student = Student::findorfail($id);
        $section = Section::where('class_id', $student->class_id)->get();
        $academicYear = AcademicYear::where('status', 1)->get();
        return view('admin.students.edit', compact('student', 'section', 'academicYear'));
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
        $student = Student::findorfail($id);
        $input_data = array (
            'section_id' => $request->section,
            'academic_id' => $request->academic_year,
        );

        Student::whereId($id)->update($input_data);
        return redirect('/admin/students')->with('success', 'Student Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::findorfail($id);
        $admission = Admission::where('id', $student->admission_id)->update(['is_register' => 0]);
        $student->delete();
        return response()->json(['success' => 'Student Deleted Successfully']);
    }

    public function status($id, Request $request)
    {
        $student = Student::findorfail($id);
        if($student->status == 1)
        {
            $student->status = 0;
        }
        else{
            $student->status = 1;
        }
        $student->update($request->all());
        return response()->json(['success' => 'Student Status Changed Successfully']);
    }
}
