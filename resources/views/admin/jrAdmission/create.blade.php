@extends('admin.admin_layout.main')
@section('title', 'Academic Year')
@section('page_title', 'Academic Year')
@section('breadcrumb', 'Academic Year')
@section('customcss')
 <!--forms-wizard css-->
 <link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/jquery.steps/css/jquery.steps.css') }}">
 <!-- Style.css -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/css/style.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/css/jquery.mCustomScrollbar.css') }}">

@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
            
        <!-- Design Wizard card start -->
        <div class="card">
            <div class="card-header">
                <h5>Junior College Admission</h5>
            </div>
            <div class="card-block">
                <div class="row">
                    <div class="col-md-12">
                        <div id="wizardc">
                            <section>
                                <form class="wizard-form" id="design-wizard" method="POST">
                                    <h3></h3>
                                    <fieldset>
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <label for="admission_reg_no" class="block">Admission Reg. No. <span style="color:red;">*</span><span  style="color:red" id="reg_err"> </span></label>
                                                <input id="admission_reg_no" name="admission_reg_no" type="text" class=" form-control @error('admission_reg_no') is-invalid @enderror">
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="admission_date" class="block">Admission Date <span style="color:red;">*</span><span  style="color:red" id="adm_date_err"> </span></label>
                                                <input id="admission_date" name="admission_date" type="date" class=" form-control @error('admission_date') is-invalid @enderror">
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="academic_session" class="block">Academic Session <span style="color:red;">*</span><span  style="color:red" id="session_err"> </span></label>
                                                <select id="academic_session" name="academic_session" class=" form-control @error('academic_session') is-invalid @enderror">
                                                    <option value="">-Select Academic Session-</option>
                                                    @foreach($academicYear as $a)
                                                    <option value="{{ $a->id }}">{{ $a->from_academic_year }} - {{ $a->to_academic_year }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label for="student_name" class="block">Student Name <span style="color:red;">*</span><span  style="color:red" id="student_err"> </span></label>
                                                <input id="student_name" name="student_name" type="text" class=" form-control @error('student_name') is-invalid @enderror">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="father_name" class="block">Father Name <span style="color:red;">*</span><span  style="color:red" id="father_err"> </span></label>
                                                <input id="father_name" name="father_name" type="text" class="form-control @error('father_name') is-invalid @enderror">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="mother_name" class="block">Mother Name <span style="color:red;">*</span><span  style="color:red" id="mother_err"> </span></label>
                                                <input id="mother_name" name="mother_name" type="text" class="form-control @error('mother_name') is-invalid @enderror">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="father_occupation" class="block">Father Occupation <span style="color:red;">*</span><span  style="color:red" id="f_occu_err"> </span></label>
                                                <input id="father_occupation" name="father_occupation" type="text" class="form-control @error('father_occupation') is-invalid @enderror">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="mother_occupation" class="block">Mother Occupation <span style="color:red;">*</span><span  style="color:red" id="m_occu_err"> </span></label>
                                                <input id="mother_occupation" name="mother_occupation" type="text" class="form-control @error('mother_occupation') is-invalid @enderror">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <label for="mobile_no" class="block">Mobile No. <span style="color:red;">*</span><span  style="color:red" id="mobile_err"> </span></label>
                                                <input id="mobile_no" name="mobile_no" type="number" class="form-control @error('mobile_no') is-invalid @enderror">
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="adhaar_no" class="block">Adhaar No. <span style="color:red;">*</span><span  style="color:red" id="adhaar_err"> </span></label>
                                                <input id="adhaar_no" name="adhaar_no" type="number" class="form-control @error('adhaar_no') is-invalid @enderror">
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="id_no" class="block">ID No. <span style="color:red;">*</span><span  style="color:red" id="id_err"> </span></label>
                                                <input id="id_no" name="id_no" type="text" class="form-control @error('id_no') is-invalid @enderror">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="date_of_birth" class="block">Date of Birth <span style="color:red;">*</span><span  style="color:red" id="birth_err"> </span></label>
                                                <input id="date_of_birth" name="date_of_birth" type="date" class="form-control @error('date_of_birth') is-invalid @enderror">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="religion" class="block">Religion <span style="color:red;">*</span><span  style="color:red" id="religion_err"> </span></label>
                                                <input id="religion" name="religion" type="text" class="form-control @error('religion') is-invalid @enderror">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="caste" class="block">Caste <span style="color:red;">*</span><span  style="color:red" id="caste_err"> </span></label>
                                                <input id="caste" name="caste" type="text" class="form-control @error('caste') is-invalid @enderror">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="sub_caste" class="block">Sub-Caste <span style="color:red;">*</span><span  style="color:red" id="sub_caste_err"> </span></label>
                                                <input id="sub_caste" name="sub_caste" type="text" class="form-control @error('sub_caste') is-invalid @enderror">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label for="address" class="block">Address <span style="color:red;">*</span><span  style="color:red" id="address_err"> </span></label>
                                                <textarea id="address" name="address" type="password" class="form-control @error('address') is-invalid @enderror mb-3"></textarea>
                                            </div>
                                        </div>

                                    </fieldset>
                                    <h3></h3>
                                    <fieldset>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="name-2" class="block">Last Exam Passed <span style="color:red;">*</span><span  style="color:red" id="l_exam_err"> </span></label>
                                                
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="radio" name="last_exam_passed" class="form-check-input d-inline @error('last_exam_passed') is-invalid @enderror" value="X">X
                                                    </label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="radio" name="last_exam_passed" class="form-check-input d-inline @error('last_exam_passed') is-invalid @enderror" value="XI">XI
                                                    </label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="radio" name="last_exam_passed" class="form-check-input d-inline @error('last_exam_passed') is-invalid @enderror" value="XII">XII
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="percentage" class="block">Percentage</label>
                                                <input id="percentage" name="percentage" type="text" class="form-control @error('percentage') is-invalid @enderror">
                                            </div>
                                            <div class="col-sm-6">
                                            <label for="out_of" class="block">Out Of</label>
                                                <input id="out_of" name="out_of" type="text" class="form-control @error('out_of') is-invalid @enderror">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="math_mark" class="block">Marks in Maths</label>
                                                <input id="math_mark" name="math_mark" type="number" class="form-control @error('math_mark') is-invalid @enderror">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="science_mark" class="block">Marks in Science</label>
                                                <input id="science_mark" name="science_mark" type="number" class="form-control @error('science_mark') is-invalid @enderror">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label for="last_school_attended" class="block">Last School Attended<span style="color:red;">*</span><span  style="color:red" id="l_school_err"> </span></label>
                                                <input id="last_school_attended" name="last_school_attended" type="text" class="form-control @error('last_school_attended') is-invalid @enderror">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-4">Board</div>
                                            <div class="col-sm-8">
                                                <select name="board" id="board" class="form-control @error('board') is-invalid @enderror">
                                                    <option value="">-Select Board-</option>
                                                    <option value="Maharashtra State Board">Maharashtra State Board</option>
                                                    <option value="CBSE">CBSE</option>
                                                    <option value="ICSE">ICSE</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <label for="other_board" class="block">Other Board</label>
                                            </div>
                                            <div class="col-sm-8">
                                            <input id="other_board" name="other_board" type="text" class="form-control">
                                            </div>
                                        </div>
                                    </fieldset>
                                    <h3></h3>
                                    <fieldset>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="admission_sought" class="block">Class in which Admission Sought<span style="color:red;">*</span><span  style="color:red" id="adm_sought_err"> </span></label>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="radio" name="adm_sought" class="form-check-input d-inline @error('adm_sought') is-invalid @enderror" value="XI">XI
                                                    </label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="radio" name="adm_sought" class="form-check-input d-inline @error('adm_sought') is-invalid @enderror" value="XII">XII
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label for="stream" class="block">Stream<span style="color:red;">*</span><span  style="color:red" id="stream_err"> </span></label>
                                            </div>
                                            <div class="col-sm-12">
                                                <select id="stream" name="stream" class="form-control @error('stream') is-invalid @enderror">
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
                                    </fieldset>
                                </form>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Design Wizard card end -->
    </div>
</div>
@endsection
@section('customjs')
<!--Forms - Wizard js-->
<script src="{{ asset('files/bower_components/jquery.cookie/js/jquery.cookie.js') }}"></script>
<script src="{{ asset('files/bower_components/jquery.steps/js/jquery.steps.js') }}"></script>
<script src="{{ asset('files/bower_components/jquery-validation/js/jquery.validate.js') }}"></script>
<!-- Validation js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<script type="text/javascript" src="{{ asset('files/assets/pages/form-validation/validate.js') }}"></script>
<!-- Custom js -->
<script src="{{ asset('files/assets/pages/forms-wizard-validation/form-wizard.js') }}"></script>
<script src="{{ asset('files/assets/js/pcoded.min.js') }}"></script>
<script src="{{ asset('files/assets/js/vertical/vertical-layout.min.js') }}"></script>
<script src="{{ asset('files/assets/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('files/assets/js/script.js') }}"></script>
<!-- Switch component js -->
<script type="text/javascript" src="{{ asset('files/bower_components/switchery/js/switchery.min.js') }}"></script>
<script>
$('body').on('click', 'a[href^="#finish"]', function () {
    var admission_reg_no = $("#admission_reg_no").val();
    var admission_date = $("#admission_date").val();
    var academic_session = $("#academic_session").val();
    var student_name = $("#student_name").val();
    var father_name = $("#father_name").val();
    var mother_name = $("#mother_name").val();
    var father_occupation = $("#father_occupation").val();
    var mother_occupation = $("#mother_occupation").val();
    var mobile_no = $("#mobile_no").val();
    var adhaar_no = $("#adhaar_no").val();
    var id_no = $("#id_no").val();
    var date_of_birth = $("#date_of_birth").val();
    var religion = $("#religion").val();
    var caste = $("#caste").val();
    var sub_caste = $("#sub_caste").val();
    var address = $("textarea#address").val();
    var last_exam_passed = $("input[name='last_exam_passed']:checked").val();
    var percentage = $("#percentage").val();
    var math_mark = $("#math_mark").val();
    var science_mark = $("#science_mark").val();
    var out_of = $("#out_of").val();
    var last_school_attended = $("#last_school_attended").val();
    var board = $("#board").val();
    var other_board = $("#other_board").val();
    var adm_sought = $("input[name='adm_sought']:checked").val();
    var stream = $("#stream").val();
    // alert(address);
    if (admission_reg_no=="") {
        $("#reg_err").fadeIn().html("Required");
        setTimeout(function(){ $("#reg_err").fadeOut(); }, 3000);
        $("#admission_reg_no").focus();
        return false;
    }
    if (admission_date=="") {
        $("#adm_date_err").fadeIn().html("Required");
        setTimeout(function(){ $("#adm_date_err").fadeOut(); }, 3000);
        $("#admission_date").focus();
        return false;
    }
    if (academic_session=="") {
        $("#session_err").fadeIn().html("Required");
        setTimeout(function(){ $("#session_err").fadeOut(); }, 3000);
        $("#academic_session").focus();
        return false;
    }
    if (student_name=="") {
        $("#student_err").fadeIn().html("Required");
        setTimeout(function(){ $("#student_err").fadeOut(); }, 3000);
        $("#student_name").focus();
        return false;
    }
    if (father_name=="") {
        $("#father_err").fadeIn().html("Required");
        setTimeout(function(){ $("#father_err").fadeOut(); }, 3000);
        $("#father_name").focus();
        return false;
    }
    if (mother_name=="") {
        $("#mother_err").fadeIn().html("Required");
        setTimeout(function(){ $("#mother_err").fadeOut(); }, 3000);
        $("#mother_name").focus();
        return false;
    }
    if (father_occupation=="") {
        $("#f_occu_err").fadeIn().html("Required");
        setTimeout(function(){ $("#f_occu_err").fadeOut(); }, 3000);
        $("#father_occupation").focus();
        return false;
    }
    if (mother_occupation=="") {
        $("#m_occu_err").fadeIn().html("Required");
        setTimeout(function(){ $("#m_occu_err").fadeOut(); }, 3000);
        $("#mother_occupation").focus();
        return false;
    }
    if (mobile_no=="") {
        $("#mobile_err").fadeIn().html("Required");
        setTimeout(function(){ $("#mobile_err").fadeOut(); }, 3000);
        $("#mobile_no").focus();
        return false;
    }
    if (adhaar_no=="") {
        $("#adhaar_err").fadeIn().html("Required");
        setTimeout(function(){ $("#adhaar_err").fadeOut(); }, 3000);
        $("#adhaar_no").focus();
        return false;
    }
    if (id_no=="") {
        $("#id_err").fadeIn().html("Required");
        setTimeout(function(){ $("#id_err").fadeOut(); }, 3000);
        $("#id_no").focus();
        return false;
    }
    if (date_of_birth=="") {
        $("#birth_err").fadeIn().html("Required");
        setTimeout(function(){ $("#birth_err").fadeOut(); }, 3000);
        $("#date_of_birth").focus();
        return false;
    }
    if (religion=="") {
        $("#religion_err").fadeIn().html("Required");
        setTimeout(function(){ $("#religion_err").fadeOut(); }, 3000);
        $("#religion").focus();
        return false;
    }
    
    
    if (caste=="") {
        $("#caste_err").fadeIn().html("Required");
        setTimeout(function(){ $("#caste_err").fadeOut(); }, 3000);
        $("#caste").focus();
        return false;
    }
    if (sub_caste=="") {
        $("#sub_caste_err").fadeIn().html("Required");
        setTimeout(function(){ $("#sub_caste_err").fadeOut(); }, 3000);
        $("#sub_caste").focus();
        return false;
    }
    if (address=="") {
        $("#address_err").fadeIn().html("Required");
        setTimeout(function(){ $("#address_err").fadeOut(); }, 3000);
        $("#address").focus();
        return false;
    }
    if (last_exam_passed=="") {
        $("#l_exam_err").fadeIn().html("Required");
        setTimeout(function(){ $("#l_exam_err").fadeOut(); }, 3000);
        $("#last_exam_passed").focus();
        return false;
    }
    if (last_school_attended=="") {
        $("#l_school_err").fadeIn().html("Required");
        setTimeout(function(){ $("#l_school_err").fadeOut(); }, 3000);
        $("#last_school_attended").focus();
        return false;
    }
    if (adm_sought=="") {
        $("#adm_sought_err").fadeIn().html("Required");
        setTimeout(function(){ $("#adm_sought_err").fadeOut(); }, 3000);
        $("#adm_sought").focus();
        return false;
    }
    if (stream=="") {
        $("#stream_err").fadeIn().html("Required");
        setTimeout(function(){ $("#stream_err").fadeOut(); }, 3000);
        $("#stream").focus();
        return false;
    }
    else
    { 
        var datastring="admission_reg_no="+admission_reg_no+"&admission_date="+admission_date+"&academic_session="+academic_session+"&student_name="+student_name+"&father_name="+father_name+"&mother_name="+mother_name+"&father_occupation="+father_occupation+"&mother_occupation="+mother_occupation+"&mobile_no="+mobile_no+"&adhaar_no="+adhaar_no+"&id_no="+id_no+"&address="+address+"&date_of_birth="+date_of_birth+"&religion="+religion+"&caste="+caste+"&sub_caste="+sub_caste+"&last_exam_passed="+last_exam_passed+"&percentage="+percentage+"&math_mark="+math_mark+"&science_mark="+science_mark+"&out_of="+out_of+"&last_school_attended="+last_school_attended+"&board="+board+"&other_board="+other_board+"&adm_sought="+adm_sought+"&stream="+stream;
        // alert(datastring);
        $.ajax({
            type:"POST",
            url:"{{ route('admin.junior-college-admission.store') }}",
            data:datastring,
            cache:false,        
            success:function(returndata)
            {
                document.getElementById("design-wizard").reset(); 
            }
        });
    }
})
</script>
@endsection