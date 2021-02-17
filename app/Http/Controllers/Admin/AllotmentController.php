<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Classes;
use App\Models\Admin\AcademicYear;
use App\Models\Admin\JuniorAdmission;

class AllotmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $admission = JuniorAdmission::where('adm_sought', $request->classes)->where('academic_id', $request->academic_id)->where('status', 0)->get();
        if(request()->ajax()) {
            return datatables()->of($admission)
            ->addColumn('academic_id', function(JuniorAdmission $juniorAdmission){
                if(!empty($juniorAdmission->sessions->from_academic_year) && !empty($juniorAdmission->sessions->to_academic_year)){
                return '('.$juniorAdmission->sessions->from_academic_year.') - ('.$juniorAdmission->sessions->to_academic_year.')';
                }
            })
            ->addColumn('check_val', function($admission){
                $button = '<div class="form-check"><input type="checkbox"  class="form-check-input" name="check_val" value="'.$admission->id.'" /></div>';
                return $button;
            })
            ->rawColumns(['check_val'])
            ->addIndexColumn()
            ->make(true);
        }
        $classes = Classes::where('status', 1)->get();
        $academicYear = AcademicYear::where('status', 1)->get();
        return view('admin.allotment.create', compact('classes', 'academicYear'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
