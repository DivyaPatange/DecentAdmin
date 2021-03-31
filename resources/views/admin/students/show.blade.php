@extends('admin.admin_layout.main')
@section('title', 'Student')
@section('page_title', 'Student Profile')
@section('breadcrumb', 'Student Profile')
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
    <div class="col-md-4">
        <div class="card">
            <div class="card-header text-center">
                <img src="@if($student->student_photo){{  URL::asset('studentPhoto/' . $student->student_photo) }}@else {{ asset('avatar.png') }}@endif" alt="" class="img-fluid" width="100px">
                <h4>{{ $student->student_name }}</h4>
                <?php 
                    $class = DB::table('classes')->where('id', $student->class_id)->first();
                ?>
                <p>@if(!empty($class)){{ $class->class_name }}@endif</p>
            </div>
            <div class="card-block">
                <p><b>ID Card No.</b> <span class="text-primary"> </span></p>
                <hr>
                <?php 
                    $admission = DB::table('admissions')->where('id', $student->admission_id)->first();
                ?>
                <p><b>Contact No.</b> <span class="text-primary">@if(!empty($admission)){{ $admission->mobile_no }}@endif</span></p>
                <hr>
                <p><b>Address.</b> <span class="text-primary">@if(!empty($admission)) @if($admission->admission_for == "Junior College Admission"){{ $admission->address }} @else {{ $admission->postal_address }} @endif @endif</span></p>
            </div>
        </div>

    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header p-b-0">
                <ul class="nav nav-tabs md-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#position" role="tab">Student Profile</a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#float" role="tab">Subjects</a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#overflow" role="tab">Attendance</a>
                        <div class="slide"></div>
                    </li>
                </ul>
            </div>
            <div class="card-block tab-content p-t-20">
                <div class="tab-pane fade show active" id="position" role="tabpanel">
                    <div class="generic-card-body">
                        <h6 class="sub-title">Student Profile </h6>
                        <div class="row">
                            <div class="col-md-3">
                                <p><b>Full Name </b></p>
                            </div>
                            <div class="col-md-3">
                                <p>: @if(!empty($admission)) @if($admission->admission_for == "Junior College Admission"){{ $admission->student_name }} @else {{ $admission->full_name_pupil }} @endif @endif</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Date of Birth </b></p>
                            </div>
                            <div class="col-md-3">
                                <p>: @if(!empty($admission)){{ $admission->dob }}@endif</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Religion </b></p>
                            </div>
                            <div class="col-md-3">
                                <p>: @if(!empty($admission)){{ $admission->religion }}@endif</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Caste </b></p>
                            </div>
                            <div class="col-md-3">
                                <p>: @if(!empty($admission)) @if($admission->admission_for == "Junior College Admission"){{ $admission->caste }} @else {{ $admission->race_caste }} @endif @endif </p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Mobile No. </b></p>
                            </div>
                            <div class="col-md-3">
                                <p>: @if(!empty($admission)) {{ $admission->mobile_no }} @endif</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Address </b></p>
                            </div>
                            <div class="col-md-3">
                                <p>: @if(!empty($admission)) @if($admission->admission_for == "Junior College Admission"){{ $admission->address }} @else {{ $admission->postal_address }} @endif @endif </p>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="float" role="tabpanel">
                    <div class="generic-card-body">
                        <h6 class="sub-title">Subjects </h6>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Class</th>
                                                <th>Section</th>
                                            </tr>
                                        </thead>
                                       
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="overflow" role="tabpanel">
                    <div class="generic-card-body">
                        <h6 class="sub-title">Attendance </h6>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="dt-responsive table-responsive">
                                    <table id="simpletable" class="table table-striped table-bordered nowrap" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Sr. No.</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Sr. No.</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
var SITEURL = "{{ route('admin.students.show', $student->id)}}";
$('#simpletable').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
    url: SITEURL,
    type: 'GET',
    },
    columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,searchable: false},
            { data: 'date', name: 'date' },
            { data: 'status', name: 'status' },
        ],
    order: [[0, 'desc']]
});
</script>
@endsection