@extends('admin.admin_layout.main')
@section('title', 'Teacher')
@section('page_title', 'Add Teacher')
@section('breadcrumb', 'Add Teacher')
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
        <form method="POST" action="{{ route('admin.teachers.store') }}" enctype="multipart/form-data" id="primary-form">
        @csrf
        <div class="card">
            <div class="card-header">
                <h5>Add Teacher</h5>
            </div>
            <div class="card-block">
                <div class="row">
                    <div class="col-sm-4 col-xl-4">
                        <div class="form-group form-default">
                            <input type="text" name="name" class="form-control" id="name">
                            <span class="form-bar"></span>
                            <label class="float-label">Name <span style="color:red;">*</span><span  style="color:red" id="name_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xs-4">
                        <div class="form-group form-default">
                            <select name="designation" class="form-control" id="designation">
                                <option value="">-Pick a Designation-</option>
                                <option value="Principal">Principal</option>
                                <option value="Vice Principal">Vice Principal</option>
                                <option value="Professor">Professor</option>
                                <option value="Asst. Professor">Asst. Professor</option>
                                <option value="Associate Professor">Associate Professor</option>
                                <option value="Lecturer">Lecturer</option>
                                <option value="Accountant">Accountant</option>
                                <option value="Cashier">Cashier</option>
                                <option value="Peon">Peon</option>
                                <option value="Other">Other</option>
                            </select>
                            <span class="form-bar"></span>
                            <label class="float-label">Designation <span style="color:red;">*</span><span  style="color:red" id="designation_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xl-4">
                        <div class="form-group form-default">
                            <input type="text" name="qualification" class="form-control" id="qualification">
                            <span class="form-bar"></span>
                            <label class="float-label">Qualification<span style="color:red;">*</span><span  style="color:red" id="qualification_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xl-4">
                        <div class="form-group form-default">
                            <input id="dropper-default" class="form-control" name="dob" type="text" placeholder="Select date" />
                            <span class="form-bar"></span>
                            <label class="float-label">Date of Birth<span style="color:red;">*</span><span  style="color:red" id="dob_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group form-default">
                        
                            <select id="gender" name="gender" class="form-control @error('gender') is-invalid @enderror">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            <span class="form-bar"></span>
                            <label class="float-label">Gender <span style="color:red;">*</span><span  style="color:red" id="gender_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xl-4">
                        <div class="form-group form-default">
                            <input type="text" name="religion" class="form-control" id="religion">
                            <span class="form-bar"></span>
                            <label class="float-label">Religion<span style="color:red;">*</span><span  style="color:red" id="religion_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xl-4">
                        <div class="form-group form-default">
                            <input type="email" name="email" class="form-control" id="email">
                            <span class="form-bar"></span>
                            <label class="float-label">Email<span style="color:red;">*</span><span  style="color:red" id="email_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xl-4">
                        <div class="form-group form-default">
                            <input type="number" name="mobile_no" class="form-control" id="mobile_no">
                            <span class="form-bar"></span>
                            <label class="float-label">Mobile No.<span style="color:red;">*</span><span  style="color:red" id="mobile_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xl-4">
                        <div class="form-group form-default">
                            <input type="text" name="employee_id" class="form-control" id="employee_id">
                            <span class="form-bar"></span>
                            <label class="float-label">ID Card No./Employee ID<span style="color:red;">*</span><span  style="color:red" id="employee_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xl-4">
                        <div class="form-group form-default">
                            <input id="dropper-animation" class="form-control" name="joining_date" type="text" placeholder="Select Date" />
                            <span class="form-bar"></span>
                            <label class="float-label">Joining Date<span style="color:red;">*</span><span  style="color:red" id="joining_date_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-sm-8 col-xl-8">
                        <div class="form-group form-default">
                            <input type="text" name="address" class="form-control" id="address">
                            <span class="form-bar"></span>
                            <label class="float-label">Address<span style="color:red;">*</span><span  style="color:red" id="address_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xl-4">
                        <div class="form-group form-default">
                            <input type="file" name="photo" class="form-control" id="photo">
                            <span class="form-bar"></span>
                            <label class="float-label">Photo</label>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="sub-title"></div>
                    </div>
                    <div class="col-sm-4 col-xl-4">
                        <div class="form-group form-default">
                            <input type="text" name="username" class="form-control" id="username">
                            <span class="form-bar"></span>
                            <label class="float-label">Username<span style="color:red;">*</span><span  style="color:red" id="username_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xl-4">
                        <div class="form-group form-default">
                            <input type="password" name="password" class="form-control" id="password">
                            <span class="form-bar"></span>
                            <label class="float-label">Password<span style="color:red;">*</span><span  style="color:red" id="password_err"> </span></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button class="btn btn-sm waves-effect waves-light hor-grd btn-grd-primary" type="button" id="submitForm">Submit</button>
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
    var name = $("#name").val();
    var designation = $("#designation").val();
    var qualification = $("#qualification").val();
    var dob = $("#dropper-default").val();
    var gender = $("#gender").val();
    var religion = $("#religion").val();
    var email = $("#email").val();
    var mobile_no = $("#mobile_no").val();
    var employee_id = $("#employee_id").val();
    var joining_Date = $("#dropper-animation").val();
    var address = $("#address").val();
    var username = $("#username").val();
    var password = $("#password").val();
    if (name=="") {
        $("#name_err").fadeIn().html("Required");
        setTimeout(function(){ $("#name_err").fadeOut(); }, 3000);
        $("#name").focus();
        return false;
    }
    if (designation=="") {
        $("#designation_err").fadeIn().html("Required");
        setTimeout(function(){ $("#designation_err").fadeOut(); }, 3000);
        $("#designation").focus();
        return false;
    }
    if (qualification=="") {
        $("#qualification_err").fadeIn().html("Required");
        setTimeout(function(){ $("#qualification_err").fadeOut(); }, 3000);
        $("#qualification").focus();
        return false;
    }
    if (dob=="") {
        $("#dob_err").fadeIn().html("Required");
        setTimeout(function(){ $("#dob_err").fadeOut(); }, 3000);
        $("#dropper-default").focus();
        return false;
    }
    if (gender=="") {
        $("#gender_err").fadeIn().html("Required");
        setTimeout(function(){ $("#gender_err").fadeOut(); }, 3000);
        $("#gender").focus();
        return false;
    }
    if (religion=="") {
        $("#religion_err").fadeIn().html("Required");
        setTimeout(function(){ $("#religion_err").fadeOut(); }, 3000);
        $("#religion").focus();
        return false;
    }
    if (email=="") {
        $("#email_err").fadeIn().html("Required");
        setTimeout(function(){ $("#email_err").fadeOut(); }, 3000);
        $("#email").focus();
        return false;
    }
    if (mobile_no=="") {
        $("#mobile_err").fadeIn().html("Required");
        setTimeout(function(){ $("#mobile_err").fadeOut(); }, 3000);
        $("#mobile_no").focus();
        return false;
    }
    if (employee_id=="") {
        $("#employee_err").fadeIn().html("Required");
        setTimeout(function(){ $("#employee_err").fadeOut(); }, 3000);
        $("#employee_id").focus();
        return false;
    }
    if (joining_Date=="") {
        $("#joining_date_err").fadeIn().html("Required");
        setTimeout(function(){ $("#joining_date_err").fadeOut(); }, 3000);
        $("#dropper-animation").focus();
        return false;
    }
    if (address=="") {
        $("#address_err").fadeIn().html("Required");
        setTimeout(function(){ $("#address_err").fadeOut(); }, 3000);
        $("#address").focus();
        return false;
    }
    if (username=="") {
        $("#username_err").fadeIn().html("Required");
        setTimeout(function(){ $("#username_err").fadeOut(); }, 3000);
        $("#username").focus();
        return false;
    }
    if (password=="") {
        $("#password_err").fadeIn().html("Required");
        setTimeout(function(){ $("#password_err").fadeOut(); }, 3000);
        $("#password").focus();
        return false;
    }
    else{
        $("#primary-form").submit();
    }
})

</script>

@endsection