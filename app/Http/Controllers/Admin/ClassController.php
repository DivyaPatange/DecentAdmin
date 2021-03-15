<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Classes;
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
        $class = Classes::all();
        if(request()->ajax()) {
            return datatables()->of($class)
            ->addColumn('status', function($row){
                if($row->status == 1)
                return 'Active';
                else
                return 'Inactive';
            })
            ->addColumn('is_open_for_adm', function($row){
                if($row->is_open_for_adm == 1)
                return 'Yes';
                else
                return 'No';
            })
            ->addColumn('action', 'admin.class.action')
            ->rawColumns(['action', 'status'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.class.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.class.create');
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
        $class->class_name = $request->class_name;
        $class->numeric_value = $request->numeric_value;
        $class->is_open_for_adm = $request->adm;
        $class->note = $request->note;
        $class->status = 1;
        $class->save();
        return redirect('/admin/class')->with('success', 'Class Added Successfully!');
    }

    public function getClass(Request $request)
    {
        $class = Classes::where('id', $request->bid)->first();
        if (!empty($class)) 
        {
            $data = array('id' =>$class->id,'class_name' =>$class->class_name,'numeric_value' =>$class->numeric_value, 'is_open_for_adm' => $class->is_open_for_adm, 'note' => $class->note,'status' => $class->status
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
            'class_name' => $request->name,
            'numeric_value' => $request->numeric,
            'is_open_for_adm' => $request->admission,
            'note' => $request->note,
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
