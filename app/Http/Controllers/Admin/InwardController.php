<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Inward;

class InwardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inward = Inward::orderBy('id', 'DESC')->get();
        if(request()->ajax()) {
            return datatables()->of($inward)
            ->addColumn('action', 'admin.inward.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.inward.index');
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
        $inward = new Inward();
        $inward->document_name = $request->document_name;
        $inward->in_date = $request->in_date;
        $inward->received_from = $request->received_from;
        $inward->dept = $request->dept;
        $inward->message = $request->message;
        $inward->save();
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

    public function getInward(Request $request)
    {
        $inward = Inward::where('id', $request->bid)->first();
        if (!empty($inward)) 
        {
            $data = array('id' =>$inward->id,'document_name' =>$inward->document_name,'in_date'=>$inward->in_date,'received_from' =>$inward->received_from, 'dept' => $inward->dept, 'message' => $inward->message
            );
        }else{
            $data =0;
        }
        echo json_encode($data);
    }

    public function updateInward(Request $request)
    {
        $inward = Inward::where('id', $request->id)->first();
        $input_data = array (
            'document_name' => $request->document_name,
            'in_date'=>$request->in_date,
            'received_from' =>$request->received_from, 
            'dept' => $request->dept, 
            'message' => $request->message
        );

        Inward::whereId($inward->id)->update($input_data);
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
        $inward = Inward::findorfail($id);
        $inward->delete();
        return response()->json(['success' => 'Record Deleted Successfully']);
    }
}
