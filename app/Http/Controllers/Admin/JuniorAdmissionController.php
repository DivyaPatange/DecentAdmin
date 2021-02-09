<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\AcademicYear;
use App\Models\Admin\JuniorAdmission;

class JuniorAdmissionController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $academicYear = AcademicYear::where('status', 1)->orderBy('id', 'DESC')->get();
        return view('admin.jrAdmission.create', compact('academicYear'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $admission = new JuniorAdmission();
        $admission->admission_reg_no = $request->admission_reg_no;
        $admission->admission_date = $request->admission_date;
        $admission->academic_id = $request->academic_session;
        $admission->student_name = $request->student_name;
        $admission->father_name = $request->father_name;
        $admission->mother_name = $request->mother_name;
        $admission->f_occupation = $request->father_occupation;
        $admission->m_occupation = $request->mother_occupation;
        $admission->mobile_no = $request->mobile_no;
        $admission->adhaar_no = $request->adhaar_no;
        $admission->id_no = $request->id_no;
        $admission->date_of_birth = $request->date_of_birth;
        $admission->religion = $request->religion;
        $admission->caste = $request->caste;
        $admission->sub_caste = $request->sub_caste;
        $admission->address = $request->address;
        $admission->last_exam_passed = $request->last_exam_passed;
        $admission->percentage = $request->percentage;
        $admission->math_mark = $request->math_mark;
        $admission->science_mark = $request->science_mark;
        $admission->out_of = $request->out_of;
        $admission->last_school_attended = $request->last_school_attended;
        $admission->board = $request->board;
        $admission->other_board = $request->other_board;
        $admission->adm_sought = $request->adm_sought;
        $admission->stream = $request->stream;
        $admission->status = 0; 
        $admission->save();
        return redirect('/admin/junior-college-admission')->with('success', 'Admission is successfully done!');
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
