<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\SubjectTeacher;
use App\Models\Admin\Section;
use App\Models\Admin\Subject;
use App\Models\Admin\Teacher;
use App\Models\Admin\Classes;

class SubjectTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subTeacher = SubjectTeacher::orderBy('id', 'DESC')->get();
        $sections = Section::where('status', 1)->orderBy('id', 'DESC')->get();
        $subjects = Subject::where('status', 1)->orderBy('id', 'DESC')->get();
        $teachers = Teacher::where('status', 1)->orderBy('id', 'DESC')->get();
        if(request()->ajax()) {
            return datatables()->of($subTeacher)
            ->addColumn('section_id', function($row){
                $section = Section::where('id', $row->section_id)->first();
                if(!empty($section))
                {
                    $class = Classes::where('id', $section->class_id)->first();
                    if(!empty($class))
                    {
                        return $class->class_name.' '.$section->section_name;
                    }
                }
            })
            ->addColumn('subject_id', function(SubjectTeacher $subTeacher1){
                if(!empty($subTeacher1->subjects->subject_name))
                return $subTeacher1->subjects->subject_name;
            })
            ->addColumn('teacher_id', function(SubjectTeacher $subTeacher1){
                if(!empty($subTeacher1->teachers->name))
                return $subTeacher1->teachers->name;
            })
            ->addColumn('status', function($row){
                $button = '';
                $button .= '<div class="switch_box box_1">
                <input type="checkbox" class="switch_1" data-id="'.$row->id.'"';
                 if($row->status == 1){ 
                 $button .= 'Checked'; 
                 }
                 $button .= '>
                </div>';
                return $button;
            })
            ->addColumn('action', 'admin.subject-teacher.action')
            ->rawColumns(['action', 'status'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.subject-teacher.index', compact('sections', 'teachers', 'subjects'));
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
        $subTeacher = new SubjectTeacher();
        $subTeacher->section_id = $request->section_name;
        $subTeacher->subject_id = $request->subject_name;
        $subTeacher->teacher_id = $request->teacher_name;
        $subTeacher->status = 1;
        $subTeacher->save();
        return response()->json(['success' => 'Subject Teacher Added Successfully!']);
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
        $subTeacher = SubjectTeacher::findorfail($id);
        $section = Section::where('id', $subTeacher->section_id)->first();
        $sections = Section::where('status', 1)->orderBy('id', 'DESC')->get();
        $subjects = Subject::where('class_id', $section->class_id)->where('status', 1)->get();
        $teachers = Teacher::where('status', 1)->orderBy('id', 'DESC')->get();
        return view('admin.subject-teacher.edit', compact('subTeacher', 'sections', 'subjects', 'teachers'));
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
        $subTeacher = SubjectTeacher::findorfail($id);
        $input_data = array (
            'section_id' => $request->section_name,
            'subject_id' => $request->subject_name,
            'teacher_id' => $request->teacher_name,
        );

        SubjectTeacher::whereId($id)->update($input_data);
        return redirect('/admin/subject-teacher')->with('success', 'Subject Teacher Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subTeacher = SubjectTeacher::findorfail($id);
        $subTeacher->delete();
        return response()->json(['success', 'Subject Teacher Deleted Successfully!']);
    }

    public function getSubjectList(Request $request)
    {
        $section = Section::where('id', $request->section_id)->first();
        $subject = Subject::where("class_id", $section->class_id)->where('status', 1)
        ->pluck("subject_name","id");
        return response()->json($subject);
    }

    public function status($id, Request $request)
    {
        $subTeacher = SubjectTeacher::findorfail($id);
        if($subTeacher->status == 1)
        {
            $subTeacher->status = 0;
        }
        else{
            $subTeacher->status = 1;
        }
        $subTeacher->update($request->all());
        return response()->json(['success' => 'Status Updated Successfully!']);
    }
}
