<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Enquiry;
use Redirect;

class EnquiryController extends Controller
{
    public function create()
    {
        return view('admin.enquiry');
    }

    public function store(Request $request)
    {
        $enquiry = new Enquiry();
        $id = mt_rand(100000, 999999);
        $enquiry->enquiry_no = "ENQ".$id;
        $enquiry->student_name = $request->student_name;
        $enquiry->father_name = $request->father_name;
        $enquiry->mother_name = $request->mother_name;
        $enquiry->dob = $request->dob;
        $enquiry->contact_no = $request->contact_no;
        $enquiry->address = $request->address;
        $enquiry->last_exam_passed = $request->last_exam_passed;
        $enquiry->percentage = $request->percentage;
        $enquiry->adm_sought = $request->adm_sought;
        $enquiry->save();
        return Redirect::back()->with('success', 'Thanks for contacting us!');
    }
}
