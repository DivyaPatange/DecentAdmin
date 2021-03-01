<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Standard;
use App\Models\Admin\PrimarySchool;
use App\Models\Admin\AcademicYear;

class PrimarySchoolController extends Controller
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
        $admission = PrimarySchool::all();
        if(request()->ajax()) {
            return datatables()->of($admission)
            ->addColumn('academic_id', function(PrimarySchool $primarySchool){
                if(!empty($primarySchool->sessions->from_academic_year) && !empty($primarySchool->sessions->to_academic_year)){
                return '('.$primarySchool->sessions->from_academic_year.') - ('.$primarySchool->sessions->to_academic_year.')';
                }
            })
            ->addColumn('action', 'admin.primary-admission.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.primary-admission.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $academicYear = AcademicYear::all();
        $standards = Standard::where('class_code', '<=', 10)->get();
        // dd($standards);
        return view('admin.primary-admission.create', compact('standards', 'academicYear'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $admission = new PrimarySchool();
        $admission->gr_no = $request->gr_no;
        $admission->academic_id = $request->academic_session;
        $admission->admission_date = date("Y-m-d", strtotime($request->adm_date));
        $admission->full_name_pupil = $request->full_name_pupil;
        $admission->surname = $request->surname;
        $admission->father_name = $request->father_name;
        $admission->mother_name = $request->mother_name;
        $admission->postal_address = $request->postal_address;
        $admission->occupation = $request->occupation;
        $admission->phone_no = $request->phone_no;
        $admission->race_caste = $request->race_caste;
        $admission->monthly_income = $request->monthly_income;
        $admission->dob = date("Y-m-d", strtotime($request->dob));
        $admission->birth_place = $request->birth_place;
        $admission->nationality = $request->nationality;
        $admission->last_school_attended = $request->last_school_attended;
        $admission->last_exam_passed = $request->last_exam_passed;
        $admission->adm_sought = $request->adm_sought;
        $admission->medium = $request->medium;
        $admission->rte = $request->rte;
        $admission->father_name1 = $request->father_name1;
        $admission->f_occupation = $request->f_occupation;
        $admission->f_education = $request->f_education;
        $admission->f_address = $request->f_address;
        $admission->f_phone_no = $request->f_phone_no;
        $admission->mother_name1 = $request->mother_name1;
        $admission->m_occupation = $request->m_occupation;
        $admission->m_education = $request->m_education;
        $admission->m_address = $request->m_address;
        $admission->m_phone_no = $request->m_phone_no;
        $admission->guardian_name = $request->guardian_name;
        $admission->g_occupation = $request->g_occupation;
        $admission->g_education = $request->g_education;
        $admission->g_address = $request->g_address;
        $admission->g_phone_no = $request->g_phone_no;
        $id = mt_rand(10000,99999);
        $admission->school_ID = "DEC".$id;
        $admission->save();
        return redirect('/admin/primary-school')->with('success', 'Admission Created Successfully');
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
        $primarySchool = PrimarySchool::findorfail($id);
        $primarySchool->delete();
        return response()->json(['success' => 'Admission Deleted Successfully']);
    }
}
