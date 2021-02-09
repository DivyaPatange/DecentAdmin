<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Section;

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
        $sections = Section::all();
        if(request()->ajax()) {
            return datatables()->of($sections)
            ->addColumn('status', function($row){
                if($row->status == 1)
                return 'Active';
                else
                return 'Inactive';
            })
            ->addColumn('action', 'admin.section.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.section.index');
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
        $section = new Section();
        $section->section = $request->section;
        $section->status = $request->status;
        $section->save();
        return response()->json(['success' => 'Section Added Successfully']);
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
            $data = array('id' =>$section->id,'section' =>$section->section,'status' =>$section->status
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
            'section' => $request->section,
            'status' => $request->status,
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
}
