@extends('admin.admin_layout.main')
@section('title', 'Edit Student')
@section('page_title', 'Edit Student')
@section('breadcrumb', 'Edit Student')
@section('customcss')

<!-- Data Table Css -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/pages/data-table/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<!-- Select 2 css -->
<link rel="stylesheet" href="{{ asset('files/bower_components/select2/css/select2.min.css') }}" />
<!-- ico font -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/icon/icofont/css/icofont.css') }}">
<!-- animation nifty modal window effects css -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/css/component.css') }}">
<style>
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
                <h5>Edit Student</h5>
                <!--<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>-->
            </div>
            <div class="card-block">
                <form class="form-material" id="form-submit" method="POST" action="{{ route('admin.students.update', $student->id) }}">
                @csrf 
                @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-default">
                                <label>Registration No.</label>
                                <input type="text" class="form-control" readonly value="{{ $student->regi_no }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-default">
                                <label>Class<span style="color:red;">*</span><span  style="color:red" id="from_err"> </span></label><br>
                                <span class="text-danger">Class Can't Change</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-default">
                                <label>Section<span style="color:red;">*</span><span  style="color:red" id="section_err"> </span></label>
                                <select name="section" class="form-control js-example-basic-single" id="section">
                                    <option value="">-Select Section-</option>
                                    @foreach($section as $s)
                                    <option value="{{ $s->id }}" @if($s->id == $student->section_id) Selected @endif>{{ $s->section_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-default">
                                <label>Academic Year<span style="color:red;">*</span><span  style="color:red" id="to_err"> </span></label>
                                <select name="academic_year" class="form-control js-example-basic-single" id="academic_year">
                                    <option value="">-Select Academic Year-</option>
                                    @foreach($academicYear as $a)
                                    <option value="{{ $a->id }}" @if($a->id == $student->academic_id) Selected @endif>({{ $a->from_academic_year }}) - ({{ $a->to_academic_year }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                        <button class="btn btn-sm waves-effect waves-light hor-grd btn-grd-primary" type="button" id="submitForm">Search</button>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
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
<!-- Select 2 js -->
<script type="text/javascript" src="{{ asset('files/bower_components/select2/js/select2.full.min.js') }}"></script>
<!-- Custom js -->
<script type="text/javascript" src="{{ asset('files/assets/pages/advance-elements/select2-custom.js') }}"></script>

<script>

$('body').on('click', '#submitForm', function () {
    var section = $("#section").val();
    var academic_id = $("#academic_year").val();
    
    
    if (section=="") {
        $("#section_err").fadeIn().html("Required");
        setTimeout(function(){ $("#section_err").fadeOut(); }, 3000);
        $("#section").focus();
        return false;
    }
    if (academic_id=="") {
        $("#to_err").fadeIn().html("Required");
        setTimeout(function(){ $("#to_err").fadeOut(); }, 3000);
        $("#academic_year").focus();
        return false;
    }
    else
    { 
        
    }
})

</script>

@endsection