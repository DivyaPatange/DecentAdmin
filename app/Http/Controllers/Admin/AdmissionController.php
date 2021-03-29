<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\AcademicYear;
use App\Models\Admin\Classes;
use App\Models\Admin\Admission;
use Auth;

class AdmissionController extends Controller
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
        $admission = Admission::all();
        return view('admin.admission.index', compact('admission'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $class3 = Classes::where('numeric_value', '<', 10)->where('status', 1)->get();
        $class = Classes::where('numeric_value', '<=', 10)->where('is_open_for_adm', 1)->get();
        $class1 = Classes::where('numeric_value', '>=', 10)->where('status', 1)->get();
        $class2 = Classes::where('numeric_value', '>', 10)->where('is_open_for_adm', 1)->get();
        $academicYear = AcademicYear::where('status', 1)->get();
        return view('admin.admission.create', compact('academicYear', 'class', 'class1', 'class2', 'class3'));
    }

    public function storeJuniorAdmission(Request $request)
    {
        $admission = new Admission();
        $id = mt_rand(10000,99999);
        $admission->admission_for = "Junior College Admission";
        $admission->created_by = "Admin";
        $admission->parent_id = Auth::guard('admin')->user()->id;
        $admission->application_no = $id;
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
        $admission->dob = $request->dob;
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
        $image = $request->file('student_photo');
        // dd($request->file('photo'));
        if($image != '')
        {
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('studentPhoto'), $image_name);
            $admission->student_photo =$image_name;
        }
        $admission->is_register = 0;
        $admission->is_allot = 0;
        $admission->save();
        
        return redirect('/admin/admission')->with('success', 'Admission Created Successfully!');
    }

    public function storePrimaryAdmission(Request $request)
    {
        $admission = new Admission();
        $admission->gr_no = $request->gr_no;
        $admission->academic_id = $request->academic_session;
        $admission->admission_date = date("Y-m-d", strtotime($request->admission_date));
        $admission->full_name_pupil = $request->full_name_pupil;
        $admission->surname = $request->surname;
        $admission->father_name = $request->father_name;
        $admission->mother_name = $request->mother_name;
        $admission->postal_address = $request->postal_address;
        $admission->occupation = $request->occupation;
        $admission->mobile_no = $request->phone_no;
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
        $admission->application_no = $id;
        $admission->admission_for = "Primary School Admission";
        $admission->created_by = "Admin";
        $admission->parent_id = Auth::guard("admin")->user()->id;
        $admission->is_register = 0;
        $admission->is_allot = 0;
        $admission->save();
        return redirect('/admin/admission')->with('success', 'Admission Created Successfully');
    }

    public function edit($id)
    {
        $class3 = Classes::where('numeric_value', '<', 10)->where('status', 1)->get();
        $class = Classes::where('numeric_value', '<=', 10)->where('is_open_for_adm', 1)->get();
        $class1 = Classes::where('numeric_value', '>=', 10)->where('status', 1)->get();
        $class2 = Classes::where('numeric_value', '>', 10)->where('is_open_for_adm', 1)->get();
        $academicYear = AcademicYear::where('status', 1)->get();
        $admission = Admission::findorfail($id);
        if($admission->admission_for == "Junior College Admission")
        {
            return view('admin.admission.editJr', compact('admission', 'class1', 'class2', 'academicYear'));
        }
        else{
            return view('admin.admission.editPri', compact('admission', 'academicYear', 'class', 'class3'));
        }
    }

    public function updateJuniorAdmission(Request $request, $id)
    {
        $admission = Admission::findorfail($id);
        $image_name = $request->hidden_image;
        $image = $request->file('student_photo');
        if($image != '')
        {
            
        $image_name = rand() . '.' . $image->getClientOriginalExtension();
        // $image->storeAs('public/tempcourseimg',$image_name);
        $image->move(public_path('studentPhoto'), $image_name);
        }
        $input_data = array (
            'admission_reg_no' => $request->admission_reg_no,
            'admission_date' => $request->admission_date,
            'academic_id' => $request->academic_session,
            'student_name' => $request->student_name,
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'f_occupation' => $request->father_occupation,
            'm_occupation' => $request->mother_occupation,
            'mobile_no' => $request->mobile_no,
            'adhaar_no' => $request->adhaar_no,
            'id_no' => $request->id_no,
            'dob' => date("Y-m-d", strtotime($request->dob)),
            'religion' => $request->religion,
            'caste' => $request->caste,
            'sub_caste' => $request->sub_caste,
            'address' => $request->address,
            'last_exam_passed' => $request->last_exam_passed,
            'percentage' => $request->percentage,
            'math_mark' => $request->math_mark,
            'science_mark' => $request->science_mark,
            'out_of' => $request->out_of,
            'last_school_attended' => $request->last_school_attended,
            'board' => $request->board,
            'other_board' => $request->other_board,
            'adm_sought' => $request->adm_sought,
            'stream' => $request->stream,
            'student_photo' => $image_name,
        );
        $admission = Admission::whereId($id)->update($input_data);
        return redirect('/admin/admission')->with('success', 'Admission Updated Successfully');
    }

    public function updatePrimaryAdmission(Request $request, $id)
    {
        $admission = Admission::findorfail($id);
        $input_data = array (
            'gr_no' => $request->gr_no,
            'academic_id' => $request->academic_session,
            'admission_date' => date("Y-m-d", strtotime($request->admission_date)),
            'full_name_pupil' => $request->full_name_pupil,
            'surname' => $request->surname,
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'postal_address' => $request->postal_address,
            'occupation' => $request->occupation,
            'mobile_no' => $request->phone_no,
            'race_caste' => $request->race_caste,
            'monthly_income' => $request->monthly_income,
            'dob' => date("Y-m-d", strtotime($request->dob)),
            'birth_place' => $request->birth_place,
            'nationality' => $request->nationality,
            'last_school_attended' => $request->last_school_attended,
            'last_exam_passed' => $request->last_exam_passed,
            'adm_sought' => $request->adm_sought,
            'medium' => $request->medium,
            'rte' => $request->rte,
            'father_name1' => $request->father_name1,
            'f_occupation' => $request->f_occupation,
            'f_education' => $request->f_education,
            'f_address' => $request->f_address,
            'f_phone_no' => $request->f_phone_no,
            'mother_name1' => $request->mother_name1,
            'm_occupation' => $request->m_occupation,
            'm_education' => $request->m_education,
            'm_address' => $request->m_address,
            'm_phone_no' => $request->m_phone_no,
            'guardian_name' => $request->guardian_name,
            'g_occupation' => $request->g_occupation,
            'g_education' => $request->g_education,
            'g_address' => $request->g_address,
            'g_phone_no' => $request->g_phone_no,
        );
        Admission::whereId($id)->update($input_data);
        return redirect('/admin/admission')->with('success', 'Admission Updated Successfully!');
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
        $admission = Admission::findorfail($id);
        if($admission->admission_for == "Junior College Admission")
        {
            return view('admin.admission.showJr', compact('admission'));
        }
        else{
            return view('admin.admission.showPri', compact('admission'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

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
        $admission = Admission::findorfail($id);
        if($admission->student_photo){
            unlink(public_path('studentPhoto/'.$admission->student_photo));
        }
        $admission->delete();
        return redirect('/admin/admission')->with('success', 'Admission Deleted Successfully!');
    }

    public function status(Request $request, $id)
    {
        $admission = Admission::findorfail($id);
        if($admission->is_register == 0)
        {
            $admission->is_register = 1;
        }
        else{
            $admission->is_register = 0;
        }
        $admission->update($request->all());
        return redirect('/admin/admission')->with('success', 'Admission Status Changed Successfully!');
    }

    public function confirmed($id)
    {
        $admission = Admission::findorfail($id);
       
        $admission->status = "Approved";
        $admission->save();
        return redirect('/admin/admission')->with('success', 'Admission is Confirmed!');
    }
    public function rejected($id)
    {
        $admission = Admission::findorfail($id);
       
        $admission->status = "Rejected";
        $admission->save();
        return redirect('/admin/admission')->with('success', 'Admission is Rejected!');
    }
}
