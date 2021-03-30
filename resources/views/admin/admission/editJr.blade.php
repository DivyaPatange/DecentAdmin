@extends('admin.admin_layout.main')
@section('title', 'Admission Form')
@section('page_title', 'Admission Form')
@section('breadcrumb', 'Edit Admission Form')
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
.select2-container .select2-selection--single{
    height:39px;
}
.card .card-header span{
    margin-top:0px;
}
.select2-container--default .select2-selection--single .select2-selection__rendered{
    padding: 4px 30px 4px 20px;
}
</style>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Edit Admission Form</h5>
            </div>
            <div id="jrAdmission" class="">
                <div class="card-block">
                    <h4 class="sub-title">Junior College Admission Form</h4>
                    <form method="post" enctype="multipart/form-data" id="jrSubmit" action="{{ route('admin.junior-admission.update', $admission->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="admission_reg_no" class="col-form-label">Admission Reg. No.</label>
                                <input id="admission_reg_no" name="admission_reg_no" type="text" class="form-control" value="{{ $admission->admission_reg_no }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="datetimepicker4" class="col-form-label">Admission Date <span style="color:red;">*</span><span  style="color:red" id="adm_date_err"> </span></label>
                                <input type="date" name="admission_date" id="admission_date" class="form-control" value="{{ $admission->admission_date }}"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="academic_session" class="col-form-label">Academic Session <span style="color:red;">*</span><span  style="color:red" id="session_err"> </span></label>
                                <select id="academic_session" name="academic_session" class="form-control js-example-basic-single">
                                    <option value="">-Select Academic Session-</option>
                                    @foreach($academicYear as $a)
                                    <option value="{{ $a->id }}" @if($admission->academic_id == $a->id) Selected @endif>{{ $a->from_academic_year }} - {{ $a->to_academic_year }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="student_name" class="col-form-label">Student Name <span style="color:red;">*</span><span  style="color:red" id="student_err"> </span></label>
                                <input id="student_name" name="student_name" type="text" class="form-control" value="{{ $admission->student_name }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="father_name" class="col-form-label">Father Name <span style="color:red;">*</span><span  style="color:red" id="father_err"> </span></label>
                                <input id="father_name" name="father_name" type="text" class="form-control" value="{{ $admission->father_name }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="mother_name" class="col-form-label">Mother Name <span style="color:red;">*</span><span  style="color:red" id="mother_err"> </span></label>
                                <input id="mother_name" name="mother_name" type="text" class="form-control" value="{{ $admission->mother_name }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="father_occupation" class="col-form-label">Father Occupation <span style="color:red;">*</span><span  style="color:red" id="f_occu_err"> </span></label>
                                <input id="father_occupation" name="father_occupation" type="text" class="form-control" value="{{ $admission->f_occupation }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="mother_occupation" class="col-form-label">Mother Occupation <span style="color:red;">*</span><span  style="color:red" id="m_occu_err"> </span></label>
                                <input id="mother_occupation" name="mother_occupation" type="text" class="form-control" value="{{ $admission->m_occupation }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="mobile_no" class="col-form-label">Mobile No.</label>
                                <input id="mobile_no" name="mobile_no" type="number" class="form-control" value="{{ $admission->mobile_no }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="adhaar_no" class="col-form-label">Adhaar No.</label>
                                <input id="adhaar_no" name="adhaar_no" type="number" class="form-control" value="{{ $admission->adhaar_no }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_no" class="col-form-label">ID No.</label>
                                <input id="id_no" name="id_no" type="text" class="form-control" value="{{ $admission->id_no }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="datetimepicker5" class="col-form-label">Date of Birth <span style="color:red;">*</span><span  style="color:red" id="birth_err"> </span></label>
                                <input type="date" name="dob" id="dob" class="form-control" value="{{ $admission->dob }}"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="religion" class="col-form-label">Religion <span style="color:red;">*</span><span  style="color:red" id="religion_err"> </span></label>
                                <input id="religion" name="religion" type="text" class="form-control" value="{{ $admission->religion }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="caste" class="col-form-label">Caste <span style="color:red;">*</span><span  style="color:red" id="caste_err"> </span></label>
                                <input id="caste" name="caste" type="text" class="form-control" value="{{ $admission->caste }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="sub_caste" class="col-form-label">Sub-Caste <span style="color:red;">*</span><span  style="color:red" id="sub_caste_err"> </span></label>
                                <input id="sub_caste" name="sub_caste" type="text" class="form-control" value="{{ $admission->sub_caste }}">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="address" class="col-form-label">Address <span style="color:red;">*</span><span  style="color:red" id="address_err"> </span></label>
                                <textarea name="address" id="address" class="form-control">{{ $admission->address }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="sub_caste" class="col-form-label">Last Exam Passed <span style="color:red;">*</span><span  style="color:red" id="l_exam_err"> </span></label><br>
                                @foreach($class1 as $class)
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="last_exam_passed" class="custom-control-input" value="{{ $class->id }}" @if($class->id == $admission->last_exam_passed) Checked @endif><span class="custom-control-label">{{ $class->class_name }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="percentage" class="col-form-label">Percentage</label>
                                <input id="percentage" name="percentage" type="text" class="form-control" value="{{ $admission->percentage }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="out_of" class="col-form-label">Out Of</label>
                                <input id="out_of" name="out_of" type="number" class="form-control" value="{{ $admission->out_of }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="math_mark" class="col-form-label">Marks in Maths</label>
                                <input id="math_mark" name="math_mark" type="number" class="form-control" value="{{ $admission->math_mark }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="science_mark" class="col-form-label">Marks in Science</label>
                                <input id="science_mark" name="science_mark" type="number" class="form-control" value="{{ $admission->science_mark }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="last_school_attended" class="col-form-label">Last School Attended <span style="color:red;">*</span><span  style="color:red" id="l_school_err"> </span></label>
                                <input id="last_school_attended" name="last_school_attended" type="text" class="form-control" value="{{ $admission->last_school_attended }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="last_exam_passed" class="col-form-label">Board</label>
                                <select name="board" id="board" class="form-control js-example-basic-single">
                                    <option value="">-Select Board-</option>
                                    <option value="Maharashtra State Board" @if($admission->board == "Maharashtra State Board") Selected @endif>Maharashtra State Board</option>
                                <option value="CBSE" @if($admission->board == "CBSE") Selected @endif>CBSE</option>
                                <option value="ICSE" @if($admission->board == "ICSE") Selected @endif>ICSE</option>
                                <option value="Other" @if($admission->board == "Other") Selected @endif>Other</option>
                                </select>
                            </div>
                        </div>
                        @if($admission->board == "Other")
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="last_exam_passed" class="col-form-label">Other Board</label>
                                <input id="other_board" name="other_board" type="text" class="form-control" value="{{ $admission->other_board }}">
                            </div>
                        </div>
                        @endif
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
                                    <input type="radio" name="adm_sought" class="custom-control-input" value="{{ $cl->id }}" @if($cl->id == $admission->adm_sought) Checked @endif><span class="custom-control-label">{{ $cl->class_name }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="stream" class="col-form-label">Stream <span style="color:red;">*</span><span  style="color:red" id="stream_err"> </span></label>
                                <select id="stream" name="stream" class="form-control js-example-basic-single">
                                    <option value="">-Select Stream-</option>
                                    <option value="Option-1" @if($admission->stream == "Option-1") Selected @endif>General Science - English, Physics, Chemistry, Maths, Biology, Hindi</option>
                                    <option value="Option-2" @if($admission->stream == "Option-2") Selected @endif>General Science - English, Physics, Chemistry, Hindi, Biology, Sociology</option>
                                    <option value="Option-3" @if($admission->stream == "Option-3") Selected @endif>General Science - English, Physics, Chemistry, Maths, Biology, IT</option>
                                    <option value="Option-4" @if($admission->stream == "Option-4") Selected @endif>General Science - English, Physics, Chemistry, Maths, Sociology, IT</option>
                                    <option value="Option-5" @if($admission->stream == "Option-5") Selected @endif>General Science - English, Physics, Chemistry, Maths, Computer Science</option>
                                    <option value="Option-6" @if($admission->stream == "Option-6") Selected @endif>General Science - English, Physics, Chemistry, Biology, Fisheries</option>
                                    <option value="Option-7" @if($admission->stream == "Option-7") Selected @endif>Electronics - English, Physics, Chemistry, Maths, Electronics</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="stream" class="col-form-label">Student Photo</label>
                                <input type="file" name="student_photo" id="student_photo" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="hidden" class="form-control-file" name="hidden_image" value="{{ $admission->student_photo }}">
                                @if($admission->student_photo)
                                <a href="{{  URL::asset('studentPhoto/' . $admission->student_photo) }}" target="_blank">Click Here to View</a>
                                @endif
                            </div>
                        </div>
                    </div>  
                    <div class="row">
                        <div class="col-md-12">
                        <button class="btn btn-sm waves-effect waves-light hor-grd btn-grd-primary" type="button" id="jrButton">Update</button>
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

</script>
@endsection