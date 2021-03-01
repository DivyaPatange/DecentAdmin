@extends('admin.admin_layout.main')
@section('title', 'Primary School Admission')
@section('page_title', 'Primary School Admission')
@section('breadcrumb', 'Primary School Admission')
@section('customcss')

<!-- Data Table Css -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/pages/data-table/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<!-- ico font -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/icon/icofont/css/icofont.css') }}">
<!-- animation nifty modal window effects css -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/css/component.css') }}">
<!-- Date-Dropper css -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/datedropper/css/datedropper.min.css') }}" />
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Date-Dropper card start -->
        <form method="POST" action="{{ route('admin.primary-school.update', $admission->id) }}" id="primary-form">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header">
                <h5>Edit Admission</h5>
            </div>
            <div class="card-block">
                <div class="row">
                    <div class="col-sm-4 col-xl-4">
                        <div class="form-group form-default">
                            <input type="text" name="gr_no" class="form-control" id="gr_no" value="{{ $admission->gr_no }}">
                            <span class="form-bar"></span>
                            <label class="float-label">G.R. No.<span style="color:red;">*</span><span  style="color:red" id="gr_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xl-4">
                        <div class="form-group form-default">
                            <input id="dropper-default" class="form-control" name="adm_date" type="text" placeholder="Select date" value="{{ $admission->admission_date }}"/>
                            <span class="form-bar"></span>
                            <label class="float-label">Admission Date<span style="color:red;">*</span><span  style="color:red" id="adm_date_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group form-default">
                        
                            <select id="academic_session" name="academic_session" class="form-control @error('academic_session') is-invalid @enderror">
                                <option value="">-Select Academic Session-</option>
                                @foreach($academicYear as $a)
                                <option value="{{ $a->id }}" @if($admission->academic_id == $a->id) Selected @endif>{{ $a->from_academic_year }} - {{ $a->to_academic_year }}</option>
                                @endforeach
                            </select>
                            <span class="form-bar"></span>
                            <label class="float-label">Academic Session <span style="color:red;">*</span><span  style="color:red" id="session_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xl-4">
                        <div class="form-group form-default">
                            <input type="text" name="full_name_pupil" class="form-control" id="full_name_pupil" value="{{ $admission->full_name_pupil }}">
                            <span class="form-bar"></span>
                            <label class="float-label">Full Name of the Pupil<span style="color:red;">*</span><span  style="color:red" id="full_name_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xl-4">
                        <div class="form-group form-default">
                            <input type="text" name="surname" class="form-control" id="surname" value="{{ $admission->surname }}">
                            <span class="form-bar"></span>
                            <label class="float-label">Surname<span style="color:red;">*</span><span  style="color:red" id="surname_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xl-4">
                        <div class="form-group form-default">
                            <input type="text" name="father_name" class="form-control" id="father_name" value="{{ $admission->father_name }}">
                            <span class="form-bar"></span>
                            <label class="float-label">Father's Name<span style="color:red;">*</span><span  style="color:red" id="f_name_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xl-4">
                        <div class="form-group form-default">
                            <input type="text" name="mother_name" class="form-control" id="mother_name" value="{{ $admission->mother_name }}">
                            <span class="form-bar"></span>
                            <label class="float-label">Mother's Name<span style="color:red;">*</span><span  style="color:red" id="m_name_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-sm-8 col-xl-8">
                        <div class="form-group form-default">
                            <input type="text" name="postal_address" class="form-control" id="postal_address" value="{{ $admission->postal_address }}">
                            <span class="form-bar"></span>
                            <label class="float-label">Full Local/Postal Address of Parents<span style="color:red;">*</span><span  style="color:red" id="p_address_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xl-4">
                        <div class="form-group form-default">
                            <input type="text" name="occupation" class="form-control" id="occupation" value="{{ $admission->occupation }}">
                            <span class="form-bar"></span>
                            <label class="float-label">Occupation<span style="color:red;">*</span><span  style="color:red" id="occ_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xl-4">
                        <div class="form-group form-default">
                            <input type="text" name="phone_no" class="form-control" id="phone_no" value="{{ $admission->phone_no }}">
                            <span class="form-bar"></span>
                            <label class="float-label">Phone No.<span style="color:red;">*</span><span  style="color:red" id="phone_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xl-4">
                        <div class="form-group form-default">
                            <input type="text" name="race_caste" class="form-control" id="race_caste" value="{{ $admission->race_caste }}">
                            <span class="form-bar"></span>
                            <label class="float-label">Race & Caste<span style="color:red;">*</span><span  style="color:red" id="race_caste_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xl-4">
                        <div class="form-group form-default">
                            <input type="text" class="form-control autonumber" data-a-sign="Rs. " name="monthly_income" id="monthly_income" value="{{ $admission->monthly_income }}">
                            <span class="form-bar"></span>
                            <label class="float-label">Monthly Income<span style="color:red;">*</span><span  style="color:red" id="income_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xl-4">
                        <div class="form-group form-default">
                            <input id="dropper-animation" class="form-control" name="dob" type="text" placeholder="Select Date" value="{{ $admission->dob }}"/>
                            <span class="form-bar"></span>
                            <label class="float-label">Date of Birth<span style="color:red;">*</span><span  style="color:red" id="dob_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xl-4">
                        <div class="form-group form-default">
                            <input type="text" name="birth_place" class="form-control" id="birth_place" value="{{ $admission->birth_place }}">
                            <span class="form-bar"></span>
                            <label class="float-label">Place of Birth<span style="color:red;">*</span><span  style="color:red" id="birth_place_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xl-4">
                        <div class="form-group form-default">
                            <input type="text" name="nationality" class="form-control" id="nationality" value="{{ $admission->nationality }}">
                            <span class="form-bar"></span>
                            <label class="float-label">Nationality<span style="color:red;">*</span><span  style="color:red" id="nationality_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xl-4">
                        <div class="form-group form-default">
                            <input type="text" name="last_school_attended" class="form-control" id="last_school_attended" value="{{ $admission->last_school_attended }}">
                            <span class="form-bar"></span>
                            <label class="float-label">Last School Attended<span style="color:red;">*</span><span  style="color:red" id="last_sa_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xl-4">
                        <div class="form-group form-default">
                            <select name="last_exam_passed" class="form-control" id="last_exam_passed">
                                <option value="">Choose</option>
                                @foreach($standards as $s)
                                <option value="{{ $s->standard }}" @if($admission->last_exam_passed == $s->standard) Selected @endif>{{ $s->standard }}</option>
                                @endforeach
                            </select>
                            <span class="form-bar"></span>
                            <label class="float-label">Last Promotion Examination Passed<span style="color:red;">*</span><span  style="color:red" id="last_ep_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xl-4">
                        <div class="form-group form-default">
                            <select name="adm_sought" class="form-control" id="adm_sought">
                                <option value="">Choose</option>
                                @foreach($standards as $s)
                                <option value="{{ $s->standard }}" @if($admission->adm_sought == $s->standard) Selected @endif>{{ $s->standard }}</option>
                                @endforeach
                            </select>
                            <span class="form-bar"></span>
                            <label class="float-label">Class in which admission sought<span style="color:red;">*</span><span  style="color:red" id="adm_s_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xl-4">
                        <div class="form-group form-default">
                            <input type="text" name="medium" class="form-control" id="medium" value="{{ $admission->medium }}">
                            <span class="form-bar"></span>
                            <label class="float-label">Medium<span style="color:red;">*</span><span  style="color:red" id="medium_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xl-4">
                        <div class="form-group form-default">
                            <span class="form-bar"></span>
                            <label class="float-label">RTE<span style="color:red;">*</span><span  style="color:red" id="rte_err"> </span></label>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="rte" value="Yes" @if($admission->rte == "Yes") Checked @endif >Yes
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="rte" value="No" @if($admission->rte == "No") Checked @endif>No
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5>Father Details</h5>
            </div>
            <div class="card-block">
                <div class="row">
                    <div class="col-sm-4 col-xl-4">
                        <div class="form-group form-default">
                            <input type="text" name="father_name1" class="form-control" id="father_name1" value="{{ $admission->father_name1 }}">
                            <span class="form-bar"></span>
                            <label class="float-label">Father Name<span  style="color:red" id="from_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xl-4">
                        <div class="form-group form-default">
                            <input type="text" name="f_occupation" class="form-control" id="f_occupation" value="{{ $admission->f_occupation }}">
                            <span class="form-bar"></span>
                            <label class="float-label">Father Occupation<span  style="color:red" id="from_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xl-4">
                        <div class="form-group form-default">
                            <input id="f_education" class="form-control" type="text" name="f_education" value="{{ $admission->f_education }}"/>
                            <span class="form-bar"></span>
                            <label class="float-label">Education<span  style="color:red" id="from_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xl-4">
                        <div class="form-group form-default">
                            <input type="text" name="f_phone_no" class="form-control" id="f_phone_no" value="{{ $admission->f_phone_no }}">
                            <span class="form-bar"></span>
                            <label class="float-label">Phone No.<span  style="color:red" id="from_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-sm-8 col-xl-8">
                        <div class="form-group form-default">
                            <input type="text" name="f_address" class="form-control" id="f_address" value="{{ $admission->f_address }}">
                            <span class="form-bar"></span>
                            <label class="float-label">Address<span  style="color:red" id="from_err"> </span></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5>Mother Details</h5>
            </div>
            <div class="card-block">
                <div class="row">
                    <div class="col-sm-4 col-xl-4">
                        <div class="form-group form-default">
                            <input type="text" name="mother_name1" class="form-control" id="mother_name1" value="{{ $admission->mother_name1 }}">
                            <span class="form-bar"></span>
                            <label class="float-label">Mother Name<span  style="color:red" id="from_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xl-4">
                        <div class="form-group form-default">
                            <input type="text" name="m_occupation" class="form-control" id="m_occupation" value="{{ $admission->m_occupation }}">
                            <span class="form-bar"></span>
                            <label class="float-label">Mother Occupation<span  style="color:red" id="from_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xl-4">
                        <div class="form-group form-default">
                            <input id="m_education" class="form-control" type="text" name="m_education" value="{{ $admission->m_education }}"/>
                            <span class="form-bar"></span>
                            <label class="float-label">Education<span  style="color:red" id="from_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xl-4">
                        <div class="form-group form-default">
                            <input type="text" name="m_phone_no" class="form-control" id="m_phone_no" value="{{ $admission->m_phone_no }}">
                            <span class="form-bar"></span>
                            <label class="float-label">Phone No.<span  style="color:red" id="from_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-sm-8 col-xl-8">
                        <div class="form-group form-default">
                            <input type="text" name="m_address" class="form-control" id="m_address" value="{{ $admission->m_address }}">
                            <span class="form-bar"></span>
                            <label class="float-label">Address<span  style="color:red" id="from_err"> </span></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5>Guardian Details</h5>
            </div>
            <div class="card-block">
                <div class="row">
                    <div class="col-sm-4 col-xl-4">
                        <div class="form-group form-default">
                            <input type="text" name="guardian_name" class="form-control" id="guardian_name" value="{{ $admission->guardian_name }}">
                            <span class="form-bar"></span>
                            <label class="float-label">Guardian Name<span  style="color:red" id="from_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xl-4">
                        <div class="form-group form-default">
                            <input type="text" name="g_occupation" class="form-control" id="g_occupation" value="{{ $admission->g_occupation }}">
                            <span class="form-bar"></span>
                            <label class="float-label">Guardian Occupation<span  style="color:red" id="from_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xl-4">
                        <div class="form-group form-default">
                            <input id="g_education" class="form-control" type="text" name="g_education" value="{{ $admission->g_education }}"/>
                            <span class="form-bar"></span>
                            <label class="float-label">Education<span  style="color:red" id="from_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xl-4">
                        <div class="form-group form-default">
                            <input type="text" name="g_phone_no" class="form-control" id="g_phone_no" value="{{ $admission->g_phone_no }}">
                            <span class="form-bar"></span>
                            <label class="float-label">Phone No.<span  style="color:red" id="from_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-sm-8 col-xl-8">
                        <div class="form-group form-default">
                            <input type="text" name="g_address" class="form-control" id="g_address" value="{{ $admission->g_address }}">
                            <span class="form-bar"></span>
                            <label class="float-label">Address<span  style="color:red" id="from_err"> </span></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button class="btn btn-sm waves-effect waves-light hor-grd btn-grd-primary" type="button" id="submitForm">Update</button>
        <!-- Date-Dropper card end -->
        </form>
    </div>
</div>

@endsection
@section('customjs')

<!-- data-table js -->
<script src="{{ asset('files/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('files/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('files/assets/pages/data-table/js/jszip.min.js') }}"></script>
<script src="{{ asset('files/assets/pages/data-table/js/pdfmake.min.js') }}"></script>
<script src="{{ asset('files/assets/pages/data-table/js/vfs_fonts.js') }}"></script>
<script src="{{ asset('files/bower_components/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('files/bower_components/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('files/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('files/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('files/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
<!-- Custom js -->
<script src="{{ asset('files/assets/pages/data-table/js/data-table-custom.js') }}"></script>
<!-- Bootstrap date-time-picker js -->
<script type="text/javascript" src="{{ asset('files/assets/pages/advance-elements/moment-with-locales.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('files/bower_components/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('files/assets/pages/advance-elements/bootstrap-datetimepicker.min.js') }}"></script>
<!-- Date-range picker js -->
<script type="text/javascript" src="{{ asset('files/bower_components/bootstrap-daterangepicker/js/daterangepicker.js') }}"></script>
<!-- Date-dropper js -->
<script type="text/javascript" src="{{ asset('files/bower_components/datedropper/js/datedropper.min.js') }}"></script>
<!-- Custom js -->
<script type="text/javascript" src="{{ asset('files/assets/pages/advance-elements/custom-picker.js') }}"></script>
<script src="{{ asset('files/assets/pages/form-masking/autoNumeric.js') }}"></script>
<script src="{{ asset('files/assets/pages/form-masking/inputmask.js') }}"></script>
<script src="{{ asset('files/assets/pages/form-masking/jquery.inputmask.js') }}"></script>
<script src="{{ asset('files/assets/pages/form-masking/form-mask.js') }}"></script>
<script>

$('body').on('click', '#submitForm', function () {
    var gr_no = $("#gr_no").val();
    var adm_date = $("#dropper-default").val();
    var full_name = $("#full_name_pupil").val();
    var surname = $("#surname").val();
    var father_name = $("#father_name").val();
    var mother_name = $("#mother_name").val();
    var postal_address = $("#postal_address").val();
    var occupation = $("#occupation").val();
    var phone_no = $("#phone_no").val();
    var race_caste = $("#race_caste").val();
    var monthly_income = $("#monthly_income").val();
    var dob = $("#dropper-animation").val();
    var birth_place = $("#birth_place").val();
    var nationality = $("#nationality").val();
    var last_school_attended = $("#last_school_attended").val();
    var last_exam_passed = $("#last_exam_passed").val();
    var adm_sought = $("#adm_sought").val();
    var medium = $("#medium").val();
    var rte = $("input[name='rte']:checked").val();
    var academic_session = $("#academic_session").val();
    if (gr_no=="") {
        $("#gr_err").fadeIn().html("Required");
        setTimeout(function(){ $("#gr_err").fadeOut(); }, 3000);
        $("#gr_no").focus();
        return false;
    }
    if (academic_session=="") {
        $("#session_err").fadeIn().html("Required");
        setTimeout(function(){ $("#session_err").fadeOut(); }, 3000);
        $("#academic_session").focus();
        return false;
    }
    if (adm_date=="") {
        $("#adm_date_err").fadeIn().html("Required");
        setTimeout(function(){ $("#adm_date_err").fadeOut(); }, 3000);
        $("#dropper-default").focus();
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
        $("#f_name_err").fadeIn().html("Required");
        setTimeout(function(){ $("#f_name_err").fadeOut(); }, 3000);
        $("#father_name").focus();
        return false;
    }
    if (mother_name=="") {
        $("#m_name_err").fadeIn().html("Required");
        setTimeout(function(){ $("#m_name_err").fadeOut(); }, 3000);
        $("#mother_name").focus();
        return false;
    }
    if (postal_address=="") {
        $("#p_address_err").fadeIn().html("Required");
        setTimeout(function(){ $("#p_address_err").fadeOut(); }, 3000);
        $("#postal_address").focus();
        return false;
    }
    if (occupation=="") {
        $("#occ_err").fadeIn().html("Required");
        setTimeout(function(){ $("#occ_err").fadeOut(); }, 3000);
        $("#occupation").focus();
        return false;
    }
    if (phone_no=="") {
        $("#phone_err").fadeIn().html("Required");
        setTimeout(function(){ $("#phone_err").fadeOut(); }, 3000);
        $("#phone_no").focus();
        return false;
    }
    if (race_caste=="") {
        $("#race_caste_err").fadeIn().html("Required");
        setTimeout(function(){ $("#race_caste_err").fadeOut(); }, 3000);
        $("#race_caste").focus();
        return false;
    }
    if (monthly_income=="") {
        $("#income_err").fadeIn().html("Required");
        setTimeout(function(){ $("#income_err").fadeOut(); }, 3000);
        $("#monthly_income").focus();
        return false;
    }
    if (dob=="") {
        $("#dob_err").fadeIn().html("Required");
        setTimeout(function(){ $("#dob_err").fadeOut(); }, 3000);
        $("#dropper-animation").focus();
        return false;
    }
    if (birth_place=="") {
        $("#birth_place_err").fadeIn().html("Required");
        setTimeout(function(){ $("#birth_place_err").fadeOut(); }, 3000);
        $("#birth_place").focus();
        return false;
    }
    if (nationality=="") {
        $("#nationality_err").fadeIn().html("Required");
        setTimeout(function(){ $("#nationality_err").fadeOut(); }, 3000);
        $("#nationality").focus();
        return false;
    }
    if (last_school_attended=="") {
        $("#last_sa_err").fadeIn().html("Required");
        setTimeout(function(){ $("#last_sa_err").fadeOut(); }, 3000);
        $("#last_school_attended").focus();
        return false;
    }
    if (last_exam_passed=="") {
        $("#last_ep_err").fadeIn().html("Required");
        setTimeout(function(){ $("#last_ep_err").fadeOut(); }, 3000);
        $("#last_exam_passed").focus();
        return false;
    }
    if (adm_sought=="") {
        $("#adm_s_err").fadeIn().html("Required");
        setTimeout(function(){ $("#adm_s_err").fadeOut(); }, 3000);
        $("#adm_sought").focus();
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
        $("#primary-form").submit();
    }
})

</script>

@endsection