<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\FeeHead;
use App\Models\Admin\Fee;
use App\Models\Admin\Classes;
use App\Models\Admin\AcademicYear;

class FeeController extends Controller
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
        $fees = Fee::all();
        $classes = Classes::where('status', 1)->get();
        $academicYear = AcademicYear::where('status', 1)->get();
        $feeHead = FeeHead::where('status', 1)->get();
        if(request()->ajax()) {
            return datatables()->of($fees)
            ->addColumn('fee_head_id', function(Fee $fee){
                if(!empty($fee->fee_head->fee_head)){
                    return $fee->fee_head->fee_head;
                }
            })
            ->addColumn('class_id', function(Fee $fee){
                if(!empty($fee->classes->class)){
                    return $fee->classes->class;
                }
            })
            ->addColumn('academic_id', function(Fee $fee){
                if(!empty($fee->sessions->from_academic_year) && !empty($fee->sessions->to_academic_year)){
                    return '('.$fee->sessions->from_academic_year.') - ('.$fee->sessions->to_academic_year.')';
                }
            })
            ->addColumn('status', function($row){
                if($row->status == 1)
                return 'Active';
                else
                return 'Inactive';
            })
            ->addColumn('action', 'admin.fee.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.fee.index', compact('feeHead', 'classes', 'academicYear'));
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
        $fee = new Fee();
        $fee->fee_head_id = $request->fee_head;
        $fee->class_id = $request->classes;
        $fee->academic_id = $request->academic_year;
        $fee->amount = $request->amount;
        $fee->description = $request->description;
        $fee->status = $request->status;
        $fee->save();
        return response()->json(['success' => 'Fee Added Successfully']);
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
        //
    }
}
