<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Standard;

class StandardController extends Controller
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
        $standards = Standard::all();
        if(request()->ajax()) {
            return datatables()->of($standards)
            ->addColumn('status', function($row){
                if($row->status == 1)
                return 'Active';
                else
                return 'Inactive';
            })
            ->addColumn('action', 'admin.standard.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.standard.index');
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
        $standard = new Standard();
        // dd(strtoupper($request->standard));
        $standard->standard = strtoupper($request->standard);
        $standard->status = $request->status;
        if(strtoupper($request->standard) == "NURSERY")
        {
            $standard->class_code = -3;
        }
        if((strtoupper($request->standard) == "KG-1") || (strtoupper($request->standard) == "KG 1") || (strtoupper($request->standard) == "KG1") || (strtoupper($request->standard) == "KG-I") || (strtoupper($request->standard) == "KG I"))
        {
            $standard->class_code = -2;
        }
        if((strtoupper($request->standard) == "KG-2") || (strtoupper($request->standard) == "KG 2") || (strtoupper($request->standard) == "KG2") || (strtoupper($request->standard) == "KG-II") || (strtoupper($request->standard) == "KG II"))
        {
            $standard->class_code = -1;
        }
        else{
            $standard->class_code = $request->standard;
        }
        $standard->save();
        return response()->json(['success' => 'Standard Added Successfully']);
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

    public function getStandard(Request $request)
    {
        $standard = Standard::where('id', $request->bid)->first();
        if (!empty($standard)) 
        {
            $data = array('id' =>$standard->id,'standard' =>$standard->standard,'status' =>$standard->status
            );
        }else{
            $data =0;
        }
        echo json_encode($data);
    }

    public function updateStandard(Request $request)
    {
        $standard = Standard::where('id', $request->id)->first();
        $input_data = array (
            'standard' => $request->standard,
            'status' => $request->status,
        );

        Standard::whereId($standard->id)->update($input_data);
        return response()->json(['success' => 'Standard Updated Successfully']);
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
        $standard = Standard::findorfail($id);
        $standard->delete();
        return response()->json(['success' => 'Standard Deleted Successfully']);
    }
}
