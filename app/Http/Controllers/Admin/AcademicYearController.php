<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\AcademicYear;

class AcademicYearController extends Controller
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
        $academicYear = AcademicYear::all();
        if(request()->ajax()) {
            return datatables()->of($academicYear)
            ->addColumn('status', function($row){
                if($row->status == 1)
                return 'Active';
                else
                return 'Inactive';
            })
            ->addColumn('action', 'admin.academic-year.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.academic-year.index');
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
        $academicYear = new AcademicYear();
        $academicYear->from_academic_year = $request->from_academic_year;
        $academicYear->to_academic_year = $request->to_academic_year;
        $academicYear->status = $request->status;
        $academicYear->save();
        return response()->json(['success' => 'Academic Year Added Successfully']);
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

    public function getAcademicYear(Request $request)
    {
        $academicYear = AcademicYear::where('id', $request->bid)->first();
        if (!empty($academicYear)) 
        {
            $data = array('id' =>$academicYear->id,'from_academic_year' =>$academicYear->from_academic_year,'to_academic_year'=>$academicYear->to_academic_year,'status' =>$academicYear->status
            );
        }else{
            $data =0;
        }
        echo json_encode($data);
    }

    public function updateAcademicYear(Request $request)
    {
        $academicYear = AcademicYear::where('id', $request->id)->first();
        $input_data = array (
            'from_academic_year' => $request->from_academic_year,
            'to_academic_year' => $request->to_academic_year,
            'status' => $request->status,
        );

        AcademicYear::whereId($academicYear->id)->update($input_data);
        return response()->json(['success' => 'Academic Year Updated Successfully']);
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
        $academicYear = AcademicYear::findorfail($id);
        $academicYear->delete();
        return response()->json(['success' => 'Academic Year Deleted Successfully']);
    }
}
