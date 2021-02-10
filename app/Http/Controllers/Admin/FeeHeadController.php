<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\FeeHead;

class FeeHeadController extends Controller
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
        $feeHead = FeeHead::all();
        if(request()->ajax()) {
            return datatables()->of($feeHead)
            ->addColumn('status', function($row){
                if($row->status == 1)
                return 'Active';
                else
                return 'Inactive';
            })
            ->addColumn('action', 'admin.fee-head.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.fee-head.index');
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
        $feeHead = new FeeHead();
        $feeHead->fee_head = $request->fee_head;
        $feeHead->description = $request->description;
        $feeHead->status = $request->status;
        $feeHead->save();
        return response()->json(['success' => 'Fee Head Added Successfully']);
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

    public function getFeeHead(Request $request)
    {
        $feeHead = FeeHead::where('id', $request->bid)->first();
        if (!empty($feeHead)) 
        {
            $data = array('id' =>$feeHead->id,'fee_head' =>$feeHead->fee_head,'description'=>$feeHead->description,'status' =>$feeHead->status
            );
        }else{
            $data =0;
        }
        echo json_encode($data);
    }

    public function updateFeeHead(Request $request)
    {
        $feeHead = FeeHead::where('id', $request->id)->first();
        $input_data = array (
            'fee_head' => $request->fee_head,
            'description' => $request->description,
            'status' => $request->status,
        );

        FeeHead::whereId($feeHead->id)->update($input_data);
        return response()->json(['success' => 'Fee Head Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $feeHead = FeeHead::findorfail($id);
        $feeHead->delete();
        return response()->json(['success' => 'Fee Head Deleted Successfully']);
    }
}
