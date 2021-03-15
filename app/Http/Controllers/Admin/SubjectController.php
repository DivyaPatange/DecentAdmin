<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Subject;
use App\Models\Admin\Classes;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::orderBy('id', 'DESC')->get();
        $classes = Classes::where('status', 1)->get();
        if(request()->ajax()) {
            return datatables()->of($subjects)
            ->addColumn('class_id', function(Subject $subject){
                if(!empty($subject->classes->class_name))
                return $subject->classes->class_name;
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
            ->addColumn('action', 'admin.subjects.action')
            ->rawColumns(['action', 'status', 'class_id'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.subjects.index', compact('classes'));
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
        $subject = new Subject();
        $subject->subject_name = $request->subject_name;
        $subject->class_id = $request->class_name;
        $subject->status = 1;
        $subject->save();
        return response()->json(['success' => 'Subject Added Successfully']);
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

    public function getSubject(Request $request)
    {
        $subject = Subject::where('id', $request->bid)->first();
        if (!empty($subject)) 
        {
            $data = array('id' =>$subject->id,'subject_name' =>$subject->subject_name,'class_id'=>$subject->class_id
            );
        }else{
            $data =0;
        }
        echo json_encode($data);
    }

    public function updateSubject(Request $request)
    {
        $subject = Subject::where('id', $request->id)->first();
        $input_data = array (
            'subject_name' => $request->subject_name,
            'class_id' => $request->class_id,
        );

        Subject::whereId($subject->id)->update($input_data);
        return response()->json(['success' => 'Subject Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subject = Subject::findorfail($id);
        $subject->delete();
        return response()->json(['success' => 'Subject Deleted Successfully']);
    }

    public function status($id, Request $request)
    {
        $subject = Subject::findorfail($id);
        if($subject->status == 1)
        {
            $subject->status = 0;
        }
        else{
            $subject->status = 1;
        }
        $subject->update($request->all());
        return response()->json(['success' => 'Status Updated Successfully!']);
    }
}
