<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Outward;

class OutwardController extends Controller
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
        $outward = Outward::orderBy('id', 'DESC')->get();
        if(request()->ajax()) {
            return datatables()->of($outward)
            ->addColumn('action', 'admin.outward.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.outward.index');
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
        $outward = new Outward();
        $outward->document_name = $request->document_name;
        $outward->out_date = $request->out_date;
        $outward->issued_to = $request->issued_to;
        $outward->message = $request->message;
        $outward->save();
        return response()->json(['success' => 'Record Added Successfully']);
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

    public function getOutward(Request $request)
    {
        $outward = Outward::where('id', $request->bid)->first();
        if (!empty($outward)) 
        {
            $data = array('id' =>$outward->id,'document_name' =>$outward->document_name,'out_date'=>$outward->out_date,'issued_to' =>$outward->issued_to, 'message' => $outward->message
            );
        }else{
            $data =0;
        }
        echo json_encode($data);
    }

    public function updateOutward(Request $request)
    {
        $outward = Outward::where('id', $request->id)->first();
        $input_data = array (
            'document_name' => $request->document_name,
            'out_date'=>$request->out_date,
            'issued_to' =>$request->issued_to, 
            'message' => $request->message
        );

        Outward::whereId($outward->id)->update($input_data);
        return response()->json(['success' => 'Record Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $outward = Outward::findorfail($id);
        $outward->delete();
        return response()->json(['success' => 'Record Deleted Successfully']);
    }
}
