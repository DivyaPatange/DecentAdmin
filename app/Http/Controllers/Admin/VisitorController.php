<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Visitor;

class VisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $visitor = Visitor::orderBy('id', 'DESC')->get();
        if(request()->ajax()) {
            return datatables()->of($visitor)
            ->addColumn('date_time', function($row){
                return $row->visit_date.' '.$row->visit_time;
            })
            ->addColumn('action', 'admin.visitor.action')
            ->rawColumns(['action', 'date_time'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.visitor.index', compact('visitor'));
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
        $visitor = new Visitor();
        $visitor->visit_date = date("Y-m-d");
        $visitor->visit_time = date("h:i:s");
        $visitor->temp = $request->temp;
        $visitor->visitor_name = $request->visitor_name;
        $visitor->student_name = $request->student_name;
        $visitor->phone_no = $request->phone_no;
        $visitor->address = $request->address;
        $visitor->purpose = $request->purpose;
        $visitor->save();
        return response()->json(['success' => 'Visitor Added Successfully']);
    }

    public function getVisitor(Request $request)
    {
        $visitor = Visitor::where('id', $request->bid)->first();
        if (!empty($visitor)) 
        {
            $data = array('id' =>$visitor->id,'temp' =>$visitor->temp,'student_name' =>$visitor->student_name, 'visitor_name' => $visitor->visitor_name, 'phone_no' => $visitor->phone_no, 'address' => $visitor->address, 'purpose' => $visitor->purpose
            );
        }else{
            $data =0;
        }
        echo json_encode($data);
    }

    public function updateVisitor(Request $request)
    {
        $visitor = Visitor::where('id', $request->id)->first();
        $input_data = array (
            'temp' => $request->temp,
            'visitor_name' => $request->visitor_name,
            'student_name' => $request->student_name,
            'phone_no' => $request->phone_no,
            'address' => $request->address,
            'purpose' => $request->purpose,
        );

        Visitor::whereId($visitor->id)->update($input_data);
        return response()->json(['success' => 'Visitor Updated Successfully']);
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
        $visitor = Visitor::findorfail($id);
        $visitor->delete();
        return response()->json(['success' => 'Visitor Deleted Successfully']);
    }
}
