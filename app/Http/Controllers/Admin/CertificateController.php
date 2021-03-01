<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\AllotmentStudent;
use App\Models\Admin\AcademicYear;
use App\Models\Admin\LeavingCertificate;

class CertificateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        $allotment = AllotmentStudent::orderBy('id', 'DESC')->get();
        if(request()->ajax()) {
            return datatables()->of($allotment)
            ->addColumn('student_name', function(AllotmentStudent $allotS){
                if(!empty($allotS->admission->student_name)){
                return $allotS->admission->student_name;
                }
            })
            ->addColumn('adm_sought', function(AllotmentStudent $allotS){
                if(!empty($allotS->admission->adm_sought)){
                return $allotS->admission->adm_sought;
                }
            })
            ->addColumn('academic_id', function(AllotmentStudent $allotS){
                if(!empty($allotS->admission->academic_id)){
                    $academicYear = AcademicYear::where('id', $allotS->admission->academic_id)->first();
                    if(!empty($academicYear)){
                    return '('.$academicYear->from_academic_year.') - ('.$academicYear->to_academic_year.')';
                    }
                }
            })
            ->addColumn('action', 'admin.certificate.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.certificate.index');
    }

    public function jrBonafideCertificate($id)
    {
        $allotmentS = AllotmentStudent::findorfail($id);
        // dd($allotment);
        return view('admin.certificate.bonafide', compact('allotmentS'));
    }

    public function jrCharacterCertificate($id)
    {        
        $allotmentS = AllotmentStudent::findorfail($id);
        return view('admin.certificate.character', compact('allotmentS'));
    }

    public function jrLeavingCertificate($id)
    {
        $allotmentS = AllotmentStudent::findorfail($id);
        $leavingCertificate = LeavingCertificate::where('allot_student_id', $allotmentS->id)->first();
        return view('admin.certificate.leaving', compact('allotmentS', 'leavingCertificate'));
    }

    public function jrLeavingCertificateSave(Request $request)
    {
        $leavingCertificate = new LeavingCertificate();
        $leavingCertificate->certificate_no = 1021;
        $leavingCertificate->general_reg_no = $request->general_reg_no;
        $leavingCertificate->allot_student_id = $request->allot_student_id;
        $leavingCertificate->admission_id = $request->admission_id;
        $leavingCertificate->mother_tongue = $request->mother_tongue;
        $leavingCertificate->birth_place = $request->birth_place;
        $leavingCertificate->taluka = $request->taluka;
        $leavingCertificate->district = $request->district;
        $leavingCertificate->state = $request->state;
        $leavingCertificate->country = $request->country;
        $leavingCertificate->academic_progress = $request->academic_progress;
        $leavingCertificate->conduct = $request->conduct;
        $leavingCertificate->leaving_date = $request->leaving_date;
        $leavingCertificate->college_studying = $request->college_studying;
        $leavingCertificate->leaving_reason = $request->leaving_reason;
        $leavingCertificate->remarks = $request->remarks;
        $leavingCertificate->date_present = $request->year.'-'.sprintf("%02d", $request->month).'-'.sprintf("%02d", $request->day);
        $leavingCertificate->save();
        return $leavingCertificate->save();
    }
}
