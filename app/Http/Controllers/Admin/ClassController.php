<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Classes;
use App\Models\Admin\Standard;
use App\Models\Admin\Section;

class ClassController extends Controller
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
        $standards = Standard::where('status', 1)->get();
        $sections = Section::where('status', 1)->get();
        $class = Classes::all();
        if(request()->ajax()) {
            return datatables()->of($class)
            ->addColumn('status', function($row){
                if($row->status == 1)
                return 'Active';
                else
                return 'Inactive';
            })
            ->addColumn('action', 'admin.class.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.class.index', compact('standards', 'sections'));
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
        $class = new Classes();
        $class->class = $request->standard.' '.$request->section;
        $class->standard = $request->standard;
        $class->section = $request->section;
        $class->status = $request->status;
        $class->save();
        return response()->json(['success' => 'Class Added Successfully']);
    }

    public function getClass(Request $request)
    {
        $class = Classes::where('id', $request->bid)->first();
        if (!empty($class)) 
        {
            $data = array('id' =>$class->id,'section' =>$class->section,'status' =>$class->status, 'standard' => $class->standard
            );
        }else{
            $data =0;
        }
        echo json_encode($data);
    }

    public function updateClass(Request $request)
    {
        $class = Classes::where('id', $request->id)->first();
        $input_data = array (
            'class' => $request->standard.' '.$request->section,
            'standard' => $request->standard,
            'section' => $request->section,
            'status' => $request->status,
        );

        Classes::whereId($class->id)->update($input_data);
        return response()->json(['success' => 'Class Updated Successfully']);
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
        $class = Classes ::findorfail($id);
        $class->delete();
        return response()->json(['success' => 'Class Deleted Successfully']);
    }
}
