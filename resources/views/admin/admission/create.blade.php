@extends('admin.admin_layout.main')
@section('title', 'Admission Form')
@section('page_title', 'Admission Form')
@section('breadcrumb', 'Admission Form')
@section('customcss')

<!-- ico font -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/icon/icofont/css/icofont.css') }}">
<!-- animation nifty modal window effects css -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/css/component.css') }}">
<!-- Select 2 css -->
<link rel="stylesheet" href="{{ asset('files/bower_components/select2/css/select2.min.css') }}" />
<style>
.hidden{
    display:none;
}
</style>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Choose Admission Form</h5>
            </div>
            <div class="card-block">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-xl-12 m-b-30">
                    <form>
                        <div class="form-radio">
                            <div class="radio radio-inline">
                                <label>
                                    <input type="radio" name="radio" value="Primary School Admission" checked>
                                    <i class="helper"></i>Primary School Admission
                                </label>
                            </div>
                            <div class="radio radio-inline">
                                <label>
                                    <input type="radio" name="radio" value="Junior College Admission">
                                    <i class="helper"></i>Junior College Admission
                                </label>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
            <div id="priAdmission">
                <form method="POST" action="{{ url('/admin/primary-admission/store') }}" id="priSubmit">
                    @csrf
                    <div class="card-block">
                        <h4 class="sub-title">Primary School Admission</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="gr_no" class="col-form-label">G.R. No.</label>
                                    <input id="gr_no" name="gr_no" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="datetimepicker4" class="col-form-label">Admission Date <span style="color:red;">*</span><span  style="color:red" id="adm_date_err"> </span></label>
                                    <input type="date" name="admission_date" id="admission_date" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="academic_session" class="col-form-label">Academic Session <span style="color:red;">*</span><span  style="color:red" id="session_err"> </span></label>
                                    <select id="academic_session" name="academic_session" class="form-control js-example-basic-single">
                                        <option value="">-Select Academic Session-</option>
                                        @foreach($academicYear as $a)
                                        <option value="{{ $a->id }}">{{ $a->from_academic_year }} - {{ $a->to_academic_year }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="full_name_pupil" class="col-form-label">Full Name of the Pupil<span style="color:red;">*</span><span  style="color:red" id="full_name_err"> </span></label>
                                    <input id="full_name_pupil" name="full_name_pupil" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="surname" class="col-form-label">Surname <span style="color:red;">*</span><span  style="color:red" id="surname_err"> </span></label>
                                    <input id="surname" name="surname" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="father_name" class="col-form-label">Father's Name <span style="color:red;">*</span><span  style="color:red" id="f_name_err"> </span></label>
                                    <input id="father_name" name="father_name" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="mother_name" class="col-form-label">Mother's Name <span style="color:red;">*</span><span  style="color:red" id="m_name_err"> </span></label>
                                    <input id="mother_name" name="mother_name" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="postal_address" class="col-form-label">Full Local/Postal Address of Parents <span style="color:red;">*</span><span  style="color:red" id="p_address_err"> </span></label>
                                    <input id="postal_address" name="postal_address" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="occupation" class="col-form-label">Occupation <span style="color:red;">*</span><span  style="color:red" id="occ_err"> </span></label>
                                    <input id="occupation" name="occupation" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="phone_no" class="col-form-label">Phone No. <span style="color:red;">*</span><span  style="color:red" id="phone_err"> </span></label>
                                    <input id="phone_no" name="phone_no" type="number" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="race_caste" class="col-form-label">Race & Caste <span style="color:red;">*</span><span  style="color:red" id="race_caste_err"> </span></label>
                                    <input id="race_caste" name="race_caste" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="monthly_income" class="col-form-label">Monthly Income <span style="color:red;">*</span><span  style="color:red" id="income_err"> </span></label>
                                    <input id="monthly_income" name="monthly_income" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="datetimepicker5" class="col-form-label">Date of Birth <span style="color:red;">*</span><span  style="color:red" id="dob_err"> </span></label>
                                    <input type="date" name="dob" id="dob" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="birth_place" class="col-form-label">Place of Birth <span style="color:red;">*</span><span  style="color:red" id="birth_place_err"> </span></label>
                                    <input id="birth_place" name="birth_place" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nationality" class="col-form-label">Nationality <span style="color:red;">*</span><span  style="color:red" id="nationality_err"> </span></label>
                                    <input id="nationality" name="nationality" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="last_school_attended" class="col-form-label">Last School Attended <span style="color:red;">*</span><span  style="color:red" id="last_sa_err"> </span></label>
                                    <input id="last_school_attended" name="last_school_attended" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="last_exam_passed" class="col-form-label">Last Promotion Examination Passed <span style="color:red;">*</span><span  style="color:red" id="last_ep_err"> </span></label>
                                    <select id="last_exam_passed" name="last_exam_passed" class="form-control js-example-basic-single">
                                    <option value="">Choose</option>
                                        @foreach($class3 as $c)
                                        <option value="{{ $c->id }}">{{ $c->class_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="adm_sought" class="col-form-label">Class in which admission sought <span style="color:red;">*</span><span  style="color:red" id="adm_s_err"> </span></label>
                                    <select id="adm_sought" name="adm_sought" class="form-control js-example-basic-single">
                                    <option value="">Choose</option>
                                        @foreach($class as $c)
                                        <option value="{{ $c->id }}">{{ $c->class_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="medium" class="col-form-label">Medium <span style="color:red;">*</span><span  style="color:red" id="medium_err"> </span></label>
                                    <input id="medium" name="medium" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="medium" class="col-form-label">RTE <span style="color:red;">*</span><span  style="color:red" id="rte_err"> </span></label><br>
                                    <label class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" name="rte" checked="" class="custom-control-input" value="Yes"><span class="custom-control-label">Yes</span>
                                    </label>
                                    <label class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" name="rte" class="custom-control-input" value="No"><span class="custom-control-label">No</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-block">
                        <h4 class="sub-title">Father Details</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="father_name1" class="col-form-label">Father Name</label>
                                    <input id="father_name1" name="father_name1" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="f_occupation" class="col-form-label">Father Occupation</label>
                                    <input id="f_occupation" name="f_occupation" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="f_education" class="col-form-label">Education</label>
                                    <input id="f_education" name="f_education" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="f_phone_no" class="col-form-label">Phone No.</label>
                                    <input id="f_phone_no" name="f_phone_no" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="f_address" class="col-form-label">Address</label>
                                    <input id="f_address" name="f_address" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="card-block">
                        <h4 class="sub-title">Mother Details</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="mother_name1" class="col-form-label">Mother Name</label>
                                    <input id="mother_name1" name="mother_name1" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="m_occupation" class="col-form-label">Mother Occupation</label>
                                    <input id="m_occupation" name="m_occupation" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="m_education" class="col-form-label">Education</label>
                                    <input id="m_education" name="m_education" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="m_phone_no" class="col-form-label">Phone No.</label>
                                    <input id="m_phone_no" name="m_phone_no" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="m_address" class="col-form-label">Address</label>
                                    <input id="m_address" name="m_address" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="card-block">
                        <h4 class="sub-title">Guardian Details</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="guardian_name" class="col-form-label">Guardian Name</label>
                                    <input id="guardian_name" name="guardian_name" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="g_occupation" class="col-form-label">Guardian Occupation</label>
                                    <input id="g_occupation" name="g_occupation" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="g_education" class="col-form-label">Education</label>
                                    <input id="g_education" name="g_education" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="g_phone_no" class="col-form-label">Phone No.</label>
                                    <input id="g_phone_no" name="g_phone_no" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="g_address" class="col-form-label">Address</label>
                                    <input id="g_address" name="g_address" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-sm waves-effect waves-light hor-grd btn-grd-primary" type="button" id="priButton">Submit</button>
                            </div>
                        </div> 
                    </div>
                </form>
            </div>
            <div id="jrAdmission" class="hidden">
                <div class="card-block">
                    <h4 class="sub-title">Junior College Admission Form</h4>
                    <form method="post" enctype="multipart/form-data" id="jrSubmit" action="{{ url('/admin/junior-admission/store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="admission_reg_no" class="col-form-label">Admission Reg. No.</label>
                                <input id="admission_reg_no" name="admission_reg_no" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="datetimepicker4" class="col-form-label">Admission Date <span style="color:red;">*</span><span  style="color:red" id="adm_date_err"> </span></label>
                                <input type="date" name="admission_date" id="admission_date" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="academic_session" class="col-form-label">Academic Session <span style="color:red;">*</span><span  style="color:red" id="session_err"> </span></label>
                                <select id="academic_session" name="academic_session" class="form-control js-example-basic-single">
                                    <option value="">-Select Academic Session-</option>
                                    @foreach($academicYear as $a)
                                    <option value="{{ $a->id }}">{{ $a->from_academic_year }} - {{ $a->to_academic_year }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="student_name" class="col-form-label">Student Name <span style="color:red;">*</span><span  style="color:red" id="student_err"> </span></label>
                                <input id="student_name" name="student_name" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="father_name" class="col-form-label">Father Name <span style="color:red;">*</span><span  style="color:red" id="father_err"> </span></label>
                                <input id="father_name" name="father_name" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="mother_name" class="col-form-label">Mother Name <span style="color:red;">*</span><span  style="color:red" id="mother_err"> </span></label>
                                <input id="mother_name" name="mother_name" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="father_occupation" class="col-form-label">Father Occupation <span style="color:red;">*</span><span  style="color:red" id="f_occu_err"> </span></label>
                                <input id="father_occupation" name="father_occupation" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="mother_occupation" class="col-form-label">Mother Occupation <span style="color:red;">*</span><span  style="color:red" id="m_occu_err"> </span></label>
                                <input id="mother_occupation" name="mother_occupation" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="mobile_no" class="col-form-label">Mobile No.</label>
                                <input id="mobile_no" name="mobile_no" type="number" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="adhaar_no" class="col-form-label">Adhaar No.</label>
                                <input id="adhaar_no" name="adhaar_no" type="number" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_no" class="col-form-label">ID No.</label>
                                <input id="id_no" name="id_no" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="datetimepicker5" class="col-form-label">Date of Birth <span style="color:red;">*</span><span  style="color:red" id="birth_err"> </span></label>
                                <input type="date" name="dob" id="dob" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="religion" class="col-form-label">Religion <span style="color:red;">*</span><span  style="color:red" id="religion_err"> </span></label>
                                <input id="religion" name="religion" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="caste" class="col-form-label">Caste <span style="color:red;">*</span><span  style="color:red" id="caste_err"> </span></label>
                                <input id="caste" name="caste" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="sub_caste" class="col-form-label">Sub-Caste <span style="color:red;">*</span><span  style="color:red" id="sub_caste_err"> </span></label>
                                <input id="sub_caste" name="sub_caste" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="address" class="col-form-label">Address <span style="color:red;">*</span><span  style="color:red" id="address_err"> </span></label>
                                <textarea name="address" id="address" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="sub_caste" class="col-form-label">Last Exam Passed <span style="color:red;">*</span><span  style="color:red" id="l_exam_err"> </span></label><br>
                                @foreach($class1 as $class)
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="last_exam_passed" class="custom-control-input" value="{{ $class->id }}"><span class="custom-control-label">{{ $class->class_name }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="percentage" class="col-form-label">Percentage</label>
                                <input id="percentage" name="percentage" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="out_of" class="col-form-label">Out Of</label>
                                <input id="out_of" name="out_of" type="number" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="math_mark" class="col-form-label">Marks in Maths</label>
                                <input id="math_mark" name="math_mark" type="number" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="science_mark" class="col-form-label">Marks in Science</label>
                                <input id="science_mark" name="science_mark" type="number" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="last_school_attended" class="col-form-label">Last School Attended <span style="color:red;">*</span><span  style="color:red" id="l_school_err"> </span></label>
                                <input id="last_school_attended" name="last_school_attended" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="last_exam_passed" class="col-form-label">Board</label>
                                <select name="board" id="board" class="form-control js-example-basic-single">
                                    <option value="">-Select Board-</option>
                                    <option value="Maharashtra State Board">Maharashtra State Board</option>
                                    <option value="CBSE">CBSE</option>
                                    <option value="ICSE">ICSE</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 hidden" id="showDiv">
                            <div class="form-group">
                                <label for="last_exam_passed" class="col-form-label">Other Board</label>
                                <input id="other_board" name="other_board" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="adm_sought" class="col-form-label">Class in which admission sought <span style="color:red;">*</span><span  style="color:red" id="adm_sought_err"> </span></label><br>
                                @foreach($class2 as $cl)
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="adm_sought" class="custom-control-input" value="{{ $cl->id }}"><span class="custom-control-label">{{ $cl->class_name }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="stream" class="col-form-label">Stream <span style="color:red;">*</span><span  style="color:red" id="stream_err"> </span></label>
                                <select id="stream" name="stream" class="form-control js-example-basic-single">
                                    <option value="">-Select Stream-</option>
                                    <option value="Option-1">General Science - English, Physics, Chemistry, Maths, Biology, Hindi</option>
                                    <option value="Option-2">General Science - English, Physics, Chemistry, Hindi, Biology, Sociology</option>
                                    <option value="Option-3">General Science - English, Physics, Chemistry, Maths, Biology, IT</option>
                                    <option value="Option-4">General Science - English, Physics, Chemistry, Maths, Sociology, IT</option>
                                    <option value="Option-5">General Science - English, Physics, Chemistry, Maths, Computer Science</option>
                                    <option value="Option-6">General Science - English, Physics, Chemistry, Biology, Fisheries</option>
                                    <option value="Option-7">Electronics - English, Physics, Chemistry, Maths, Electronics</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="stream" class="col-form-label">Student Photo</label>
                                <input type="file" name="student_photo" id="student_photo" class="form-control">
                            </div>
                        </div>
                    </div>  
                    <div class="row">
                        <div class="col-md-12">
                        <button class="btn btn-sm waves-effect waves-light hor-grd btn-grd-primary" type="button" id="jrButton">Submit</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('customjs')
<!-- Select 2 js -->
<script type="text/javascript" src="{{ asset('files/bower_components/select2/js/select2.full.min.js') }}"></script>
<!-- Custom js -->
<script type="text/javascript" src="{{ asset('files/assets/pages/advance-elements/select2-custom.js') }}"></script>
<script>
$('body').on('change', '#board', function() {
  var board = $(this).val();
  if(board == "Other")
  {
      $('#showDiv').show();
  }
  else{
    $('#showDiv').hide();
  }
});
$('body').on('click', 'input[name="radio"]', function() {
  var form = $(this).val();
  if(form == "Primary School Admission")
  {
      $('#priAdmission').show();
      $('#jrAdmission').hide();
  }
  else{
    $('#jrAdmission').show();
    $('#priAdmission').hide();
  }
});

$('body').on('click', '#jrButton', function() {
    var admission_date = $("#jrAdmission #admission_date").val();
    var academic_session = $("#jrAdmission #academic_session").val();
    var student_name = $("#jrAdmission #student_name").val();
    var father_name = $("#jrAdmission #father_name").val();
    var mother_name = $("#jrAdmission #mother_name").val();
    var father_occupation = $("#jrAdmission #father_occupation").val();
    var mother_occupation = $("#jrAdmission #mother_occupation").val();
    var date_of_birth = $("#jrAdmission #dob").val();
    var religion = $("#jrAdmission #religion").val();
    var caste = $("#jrAdmission #caste").val();
    var sub_caste = $("#jrAdmission #sub_caste").val();
    var address = $("#jrAdmission textarea#address").val();
    var last_exam_passed = $("#jrAdmission input[name='last_exam_passed']:checked").val();
    var last_school_attended = $("#jrAdmission #last_school_attended").val();
    var adm_sought = $("#jrAdmission input[name='adm_sought']:checked").val();
    var stream = $("#jrAdmission #stream").val();
    if (admission_date=="") {
        $("#jrAdmission #adm_date_err").fadeIn().html("Required");
        setTimeout(function(){ $("#jrAdmission #adm_date_err").fadeOut(); }, 3000);
        $("#jrAdmission #admission_date").focus();
        return false;
    }
    if (academic_session=="") {
        $("#jrAdmission #session_err").fadeIn().html("Required");
        setTimeout(function(){ $("#jrAdmission #session_err").fadeOut(); }, 3000);
        $("#jrAdmission #academic_session").focus();
        return false;
    }
    if (student_name=="") {
        $("#jrAdmission #student_err").fadeIn().html("Required");
        setTimeout(function(){ $("#jrAdmission #student_err").fadeOut(); }, 3000);
        $("#jrAdmission #student_name").focus();
        return false;
    }
    if (father_name=="") {
        $("#jrAdmission #father_err").fadeIn().html("Required");
        setTimeout(function(){ $("#jrAdmission #father_err").fadeOut(); }, 3000);
        $("#jrAdmission #father_name").focus();
        return false;
    }
    if (mother_name=="") {
        $("#jrAdmission #mother_err").fadeIn().html("Required");
        setTimeout(function(){ $("#jrAdmission #mother_err").fadeOut(); }, 3000);
        $("#jrAdmission #mother_name").focus();
        return false;
    }
    if (father_occupation=="") {
        $("#jrAdmission #f_occu_err").fadeIn().html("Required");
        setTimeout(function(){ $("#jrAdmission #f_occu_err").fadeOut(); }, 3000);
        $("#jrAdmission #father_occupation").focus();
        return false;
    }
    if (mother_occupation=="") {
        $("#jrAdmission #m_occu_err").fadeIn().html("Required");
        setTimeout(function(){ $("#jrAdmission #m_occu_err").fadeOut(); }, 3000);
        $("#jrAdmission #mother_occupation").focus();
        return false;
    }
    if (date_of_birth=="") {
        $("#jrAdmission #birth_err").fadeIn().html("Required");
        setTimeout(function(){ $("#jrAdmission #birth_err").fadeOut(); }, 3000);
        $("#jrAdmission #dob").focus();
        return false;
    }
    if (religion=="") {
        $("#jrAdmission #religion_err").fadeIn().html("Required");
        setTimeout(function(){ $("#jrAdmission #religion_err").fadeOut(); }, 3000);
        $("#jrAdmission #religion").focus();
        return false;
    }
    if (caste=="") {
        $("#jrAdmission #caste_err").fadeIn().html("Required");
        setTimeout(function(){ $("#jrAdmission #caste_err").fadeOut(); }, 3000);
        $("#jrAdmission #caste").focus();
        return false;
    }
    if (sub_caste=="") {
        $("#jrAdmission #sub_caste_err").fadeIn().html("Required");
        setTimeout(function(){ $("#jrAdmission #sub_caste_err").fadeOut(); }, 3000);
        $("#jrAdmission #sub_caste").focus();
        return false;
    }
    if (address=="") {
        $("#jrAdmission #address_err").fadeIn().html("Required");
        setTimeout(function(){ $("#jrAdmission #address_err").fadeOut(); }, 3000);
        $("#jrAdmission #address").focus();
        return false;
    }
    if (last_exam_passed==null) {
        $("#jrAdmission #l_exam_err").fadeIn().html("Required");
        setTimeout(function(){ $("#jrAdmission #l_exam_err").fadeOut(); }, 3000);
        $("#jrAdmission #last_exam_passed").focus();
        return false;
    }
    if (last_school_attended=="") {
        $("#jrAdmission #l_school_err").fadeIn().html("Required");
        setTimeout(function(){ $("#jrAdmission #l_school_err").fadeOut(); }, 3000);
        $("#jrAdmission #last_school_attended").focus();
        return false;
    }
    if (adm_sought==null) {
        $("#jrAdmission #adm_sought_err").fadeIn().html("Required");
        setTimeout(function(){ $("#jrAdmission #adm_sought_err").fadeOut(); }, 3000);
        $("#jrAdmission #adm_sought").focus();
        return false;
    }
    if (stream=="") {
        $("#jrAdmission #stream_err").fadeIn().html("Required");
        setTimeout(function(){ $("#jrAdmission #stream_err").fadeOut(); }, 3000);
        $("#jrAdmission #stream").focus();
        return false;
    }
    else{
        $("#jrSubmit").submit()
    }
})

$('body').on('click', '#priButton', function () {
    var adm_date = $("#priAdmission #admission_date").val();
    var full_name = $("#full_name_pupil").val();
    var surname = $("#surname").val();
    var father_name = $("#priAdmission #father_name").val();
    var mother_name = $("#priAdmission #mother_name").val();
    var postal_address = $("#priAdmission #postal_address").val();
    var occupation = $("#priAdmission #occupation").val();
    var phone_no = $("#phone_no").val();
    var race_caste = $("#race_caste").val();
    var monthly_income = $("#monthly_income").val();
    var dob = $("#priAdmission #dob").val();
    var birth_place = $("#priAdmission #birth_place").val();
    var nationality = $("#priAdmission #nationality").val();
    var last_school_attended = $("#priAdmission #last_school_attended").val();
    var last_exam_passed = $("#priAdmission #last_exam_passed").val();
    var adm_sought = $("#priAdmission #adm_sought").val();
    var medium = $("#priAdmission #medium").val();
    var rte = $("#priAdmission input[name='rte']:checked").val();
    var academic_session = $("#priAdmission #academic_session").val();
    if (adm_date=="") {
        $("#priAdmission #adm_date_err").fadeIn().html("Required");
        setTimeout(function(){ $("#priAdmission #adm_date_err").fadeOut(); }, 3000);
        $("#priAdmission #admission_date").focus();
        return false;
    }
    if (academic_session=="") {
        $("#priAdmission #session_err").fadeIn().html("Required");
        setTimeout(function(){ $("#priAdmission #session_err").fadeOut(); }, 3000);
        $("#priAdmission #academic_session").focus();
        return false;
    }
    if (full_name=="") {
        $("#full_name_err").fadeIn().html("Required");
        setTimeout(function(){ $("#full_name_err").fadeOut(); }, 3000);
        $("#full_name_pupil").focus();
        return false;
    }
    if (surname=="") {
        $("#surname_err").fadeIn().html("Required");
        setTimeout(function(){ $("#surname_err").fadeOut(); }, 3000);
        $("#surname").focus();
        return false;
    }
    if (father_name=="") {
        $("#priAdmission #f_name_err").fadeIn().html("Required");
        setTimeout(function(){ $("#priAdmission #f_name_err").fadeOut(); }, 3000);
        $("#priAdmission #father_name").focus();
        return false;
    }
    if (mother_name=="") {
        $("#priAdmission #m_name_err").fadeIn().html("Required");
        setTimeout(function(){ $("#priAdmission #m_name_err").fadeOut(); }, 3000);
        $("#priAdmission #mother_name").focus();
        return false;
    }
    if (postal_address=="") {
        $("#priAdmission #p_address_err").fadeIn().html("Required");
        setTimeout(function(){ $("#priAdmission #p_address_err").fadeOut(); }, 3000);
        $("#priAdmission #postal_address").focus();
        return false;
    }
    if (occupation=="") {
        $("#priAdmission #occ_err").fadeIn().html("Required");
        setTimeout(function(){ $("#priAdmission #occ_err").fadeOut(); }, 3000);
        $("#priAdmission #occupation").focus();
        return false;
    }
    if (phone_no=="") {
        $("#priAdmission #phone_err").fadeIn().html("Required");
        setTimeout(function(){ $("#priAdmission #phone_err").fadeOut(); }, 3000);
        $("#priAdmission #phone_no").focus();
        return false;
    }
    if (race_caste=="") {
        $("#priAdmission #race_caste_err").fadeIn().html("Required");
        setTimeout(function(){ $("#priAdmission #race_caste_err").fadeOut(); }, 3000);
        $("#priAdmission #race_caste").focus();
        return false;
    }
    if (monthly_income=="") {
        $("#income_err").fadeIn().html("Required");
        setTimeout(function(){ $("#income_err").fadeOut(); }, 3000);
        $("#monthly_income").focus();
        return false;
    }
    if (dob=="") {
        $("#priAdmission #dob_err").fadeIn().html("Required");
        setTimeout(function(){ $("#priAdmission #dob_err").fadeOut(); }, 3000);
        $("#dob").focus();
        return false;
    }
    if (birth_place=="") {
        $("#priAdmission #birth_place_err").fadeIn().html("Required");
        setTimeout(function(){ $("#priAdmission #birth_place_err").fadeOut(); }, 3000);
        $("#priAdmission #birth_place").focus();
        return false;
    }
    if (nationality=="") {
        $("#priAdmission #nationality_err").fadeIn().html("Required");
        setTimeout(function(){ $("#priAdmission #nationality_err").fadeOut(); }, 3000);
        $("#priAdmission #nationality").focus();
        return false;
    }
    if (last_school_attended=="") {
        $("#priAdmission #last_sa_err").fadeIn().html("Required");
        setTimeout(function(){ $("#priAdmission #last_sa_err").fadeOut(); }, 3000);
        $("#priAdmission #last_school_attended").focus();
        return false;
    }
    if (last_exam_passed=="") {
        $("#priAdmission #last_ep_err").fadeIn().html("Required");
        setTimeout(function(){ $("#priAdmission #last_ep_err").fadeOut(); }, 3000);
        $("#priAdmission #last_exam_passed").focus();
        return false;
    }
    if (adm_sought=="") {
        $("#priAdmission #adm_s_err").fadeIn().html("Required");
        setTimeout(function(){ $("#priAdmission #adm_s_err").fadeOut(); }, 3000);
        $("#priAdmission #adm_sought").focus();
        return false;
    }
    if (medium=="") {
        $("#medium_err").fadeIn().html("Required");
        setTimeout(function(){ $("#medium_err").fadeOut(); }, 3000);
        $("#medium").focus();
        return false;
    }
    if (rte=="") {
        $("#rte_err").fadeIn().html("Required");
        setTimeout(function(){ $("#rte_err").fadeOut(); }, 3000);
        $("input[name='rte']:checked").focus();
        return false;
    }
    else{
        $("#priSubmit").submit();
    }
})
</script>
@endsection