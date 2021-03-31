<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Classes;
use App\Models\Admin\StudentAttendance;
use App\Models\Admin\AttendanceStudentList;
use App\Models\Admin\Student;
use App\Models\Admin\Section;
use Auth;

class StudentAttendanceController extends Controller
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
        $classes = Classes::where('status', 1)->get();
        if(request()->ajax()) {
            if(!empty($request->classID) && !empty($request->sectionID) && !empty($request->date))
            {
                $studAttendance = StudentAttendance::where('class_id', $request->classID)->where('section_id', $request->sectionID)->where('attendance_date', $request->date)->first();
                if(!empty($studAttendance))
                {
                    $studentList = AttendanceStudentList::where('stud_attendance_id', $studAttendance->id)->get();
                    
                }
            }
            return datatables()->of($studentList)
            ->addColumn('student_name', function($row){    
                $student = Student::where('id', $row->student_id)->first();
                if(!empty($student))
                {
                    return $student->student_name;
                }                                                                                                                                                                                                                                                                                              
            })
            ->addColumn('regi_no', function($row){    
                $student = Student::where('id', $row->student_id)->first();
                if(!empty($student))
                {
                return $student->regi_no;
                }                                                                                                                                                                                                                                                                                               
            })
            ->addColumn('roll_no', function($row){    
                $student = Student::where('id', $row->student_id)->first();
                if(!empty($student))
                {
                return $student->roll_no;
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
            ->addColumn('action', 'admin.student-attendance.action')
            ->rawColumns(['student_name', 'action', 'roll_no', 'regi_no', 'status'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.student-attendance.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = Classes::where('status', 1)->get();
        return view('admin.student-attendance.create', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $studAttendance = StudentAttendance::where('class_id', $request->class_name)->where('section_id', $request->section_name)->where('attendance_date', date("Y-m-d", strtotime($request->date)))->first();
        if(empty($studAttendance))
        {
            $studAttend = new StudentAttendance();
            $studAttend->class_id = $request->class_name;
            $studAttend->section_id = $request->section_name;
            $studAttend->attendance_date = date("Y-m-d", strtotime($request->date));
            // return $studAttend->attendance_date;
            $studAttend->created_by = "Admin";
            $studAttend->created_by_id = Auth::guard('admin')->user()->id;
            $studAttend->save();
            $class = Classes::where('id', $studAttend->class_id)->first();
            if(!empty($class))
            {
                $className = $class->class_name;
            }
            else{
                $className = '';
            }
            $section = Section::where('id', $studAttend->section_id)->first();
            if(!empty($section))
            {
                $sectionName = $section->section_name;
            }
            else{
                $sectionName = '';
            }
            $students = Student::where('class_id', $studAttend->class_id)->where('section_id', $studAttend->section_id)->get();
            $output = '';
            foreach($students as $key => $s)
            {
                $output .= '<tr>'.
                    '<td>'.++$key.'</td>'.
                    '<td>'.$s->student_name.'</td>'.
                    '<td>'.$s->roll_no.'</td>'.
                    '<td><input type="hidden" name="student_id" value="'.$s->id.'"><div class="form-check"><input type="checkbox"  class="form-check-input" name="check_val" value="Absent" /></div></td>'.
                '</tr>';
            }

            return response()->json(['success' => 'Attendance Created Successfully!', 'id' => $studAttend->id, 'date' => $studAttend->attendance_date,
            'classes' => $className, 'section' => $sectionName, 'output' => $output]);
        }
        else{
            $studentList = AttendanceStudentList::where('stud_attendance_id', $studAttendance->id)->get();
            if(count($studentList) > 0)
            {
                return response()->json(['error' => 'Attendance is already created.']);
            }
            else{

                $class = Classes::where('id', $studAttendance->class_id)->first();
                if(!empty($class))
                {
                    $className = $class->class_name;
                }
                else{
                    $className = '';
                }
                $section = Section::where('id', $studAttendance->section_id)->first();
                if(!empty($section))
                {
                    $sectionName = $section->section_name;
                }
                else{
                    $sectionName = '';
                }
                $students = Student::where('class_id', $studAttendance->class_id)->where('section_id', $studAttendance->section_id)->get();
                $output = '';
                foreach($students as $key => $s)
                {
                    $output .= '<tr>'.
                        '<td>'.++$key.'</td>'.
                        '<td>'.$s->student_name.'</td>'.
                        '<td>'.$s->roll_no.'</td>'.
                        '<td><input type="hidden" name="student_id" value="'.$s->id.'"><div class="form-check"><input type="checkbox"  class="form-check-input" name="check_val" value="Absent" /></div></td>'.
                    '</tr>';
                }
                return response()->json(['success' => 'Attendance Created Successfully!', 'id' => $studAttendance->id, 'date' => $studAttendance->attendance_date,
                'classes' => $className, 'section' => $sectionName, 'output' => $output]);
            }
        }
        // return empty($studAttendance);
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

    public function addStudent(Request $request)
    {
        $obj = json_decode($request->Data, true);
            // $someObject = json_decode($someJSON);
        for($i=0; $i < count($obj); $i++)
        {
            $student = AttendanceStudentList::where('stud_attendance_id', $request->id)->where('student_id', $obj[$i]["ID"])->first();
            if(empty($student))
            {
                $studentList = new AttendanceStudentList();
                $studentList->stud_attendance_id = $request->id;
                $studentList->student_id = $obj[$i]["ID"];
                $studentList->status = $obj[$i]["Status"];
                $studentList->save();
            }
        }
        return response()->json(['success' => 'Students attendance marked']);
    }

    public function status($id, Request $request)
    {
        $student = AttendanceStudentList::findorfail($id);
        if($student->status == "Present")
        {
            $student->status = "Absent";
        }
        else{
            $student->status = "Present";
        }
        $student->update($request->all());
        return response()->json(['success' => 'Status Changed Successfully']);
    }
}
