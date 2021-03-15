<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Section;
use App\Models\Admin\Teacher;
use App\Models\Admin\Classes;

class SectionController extends Controller
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
        $sections = Section::orderBy('id', 'DESC')->get();
        $teachers = Teacher::orderBy('id', 'DESC')->where('status', 1)->get();
        $classes = Classes::where('status', 1)->orderBy('id', 'DESC')->get();
        if(request()->ajax()) {
            return datatables()->of($sections)
            ->addColumn('class_id', function(Section $section){
                if(!empty($section->classes->class_name))
                return $section->classes->class_name;
            })
            ->addColumn('teacher_id', function(Section $section){
                if(!empty($section->teachers->name))
                return $section->teachers->name;
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
            ->addColumn('action', 'admin.section.action')
            ->rawColumns(['action', 'status'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.section.index', compact('teachers', 'classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teachers = Teacher::orderBy('id', 'DESC')->get();
        $classes = Classes::where('status', 1)->orderBy('id', 'DESC')->get();
        return view('admin.section.create', compact('teachers', 'classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $section = new Section();
        $section->section_name = $request->section_name;
        $section->capacity = $request->capacity;
        $section->class_id = $request->class_name;
        $section->teacher_id = $request->teacher_name;
        $section->note = $request->note;
        $section->status = 1;
        $section->save();
        return redirect('/admin/sections')->with('success', 'Section Added Successfully!');
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

    public function getSection(Request $request)
    {
        $section = Section::where('id', $request->bid)->first();
        if (!empty($section)) 
        {
            $data = array('id' =>$section->id,'section_name' =>$section->section_name,'capacity' =>$section->capacity, 'class_id' => $section->class_id, 'teacher_id' => $section->teacher_id, 'note' => $section->note
            );
        }else{
            $data =0;
        }
        echo json_encode($data);
    }

    public function updateSection(Request $request)
    {
        $section = Section::where('id', $request->id)->first();
        $input_data = array (
            'section_name' => $request->section_name,
            'capacity' => $request->capacity,
            'class_id' => $request->class_name,
            'teacher_id' => $request->teacher_name,
            'note' => $request->note,
        );

        Section::whereId($section->id)->update($input_data);
        return response()->json(['success' => 'Section Updated Successfully']);
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
        $section = Section::findorfail($id);
        $section->delete();
        return response()->json(['success' => 'Section Deleted Successfully']);
    }

    public function status($id, Request $request)
    {
        $section = Section::findorfail($id);
        if($section->status == 1)
        {
            $section->status = 0;
        }
        else{
            $section->status = 1;
        }
        $section->update($request->all());
        return response()->json(['success' => 'Status Updated Successfully']);
    }
}
