@extends('admin.admin_layout.main')
@section('title', 'Employee')
@section('page_title', 'Employee Profile')
@section('breadcrumb', 'Employee Profile')
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
                <img src="@if($employee->photo){{  URL::asset('teacherPhoto/' . $employee->photo) }}@else {{ asset('avatar.png') }}@endif" alt="" class="img-fluid" width="100px">
                <h4>{{ $employee->name }}</h4>
                <p>{{ $employee->designation }}</p>
            </div>
            <div class="card-block">
                <p><b>ID Card No.</b> <span class="text-primary">{{ $employee->employee_id }}</span></p>
                <hr>
                <p><b>Contact No.</b> <span class="text-primary">{{ $employee->mobile_no }}</span></p>
                <hr>
                <p><b>Email.</b> <span class="text-primary">{{ $employee->email }}</span></p>
            </div>
        </div>

    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header p-b-0">
                <ul class="nav nav-tabs md-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#position" role="tab">Employee Profile</a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#float" role="tab">Leave Balance</a>
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
                        <h6 class="sub-title">Teacher Profile </h6>
                        <div class="row">
                            <div class="col-md-3">
                                <p><b>Full Name :</b></p>
                            </div>
                            <div class="col-md-3">
                                <p>{{ $employee->name }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Date of Birth :</b></p>
                            </div>
                            <div class="col-md-3">
                                <p>{{ $employee->dob }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Qualification :</b></p>
                            </div>
                            <div class="col-md-3">
                                <p>{{ $employee->qualification }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Designation :</b></p>
                            </div>
                            <div class="col-md-3">
                                <p>{{ $employee->designation }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Gender :</b></p>
                            </div>
                            <div class="col-md-3">
                                <p>{{ $employee->gender }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Religion :</b></p>
                            </div>
                            <div class="col-md-3">
                                <p>{{ $employee->religion }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Joining Date :</b></p>
                            </div>
                            <div class="col-md-3">
                                <p>{{ $employee->joining_date }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Username :</b></p>
                            </div>
                            <div class="col-md-3">
                                <p>{{ $employee->username }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Address :</b></p>
                            </div>
                            <div class="col-md-9">
                                <p>{{ $employee->address }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="float" role="tabpanel">
                    <div class="generic-card-body">
                        <h6 class="sub-title">Leave Balance </h6>
                        <div class="row">
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                <div class="panel panel-primary">
                                    <div class="panel-heading bg-primary">
                                        Casual Leave
                                    </div>
                                    <div class="panel-body">
                                        <?php 
                                            $casualLeave = DB::table('employee_leaves')->where('teacher_id', $employee->id)->where('leave_type', '=', 'Casual Leave')->where('status', '=', 'Approved')->get();
                                            $leavePolicy = DB::table('leave_policies')->where('id', 1)->first();
                                        ?>
                                        <h4 class="text-primary text-center p-3">{{ count($casualLeave) }} / @if(!empty($leavePolicy)) {{ $leavePolicy->casual_leave }} @else 0 @endif</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                <div class="panel panel-danger">
                                    <div class="panel-heading bg-danger">
                                        Sick Leave
                                    </div>
                                    <div class="panel-body">
                                        <?php 
                                            $sickLeave = DB::table('employee_leaves')->where('teacher_id', $employee->id)->where('leave_type', '=', 'Sick Leave')->where('status', '=', 'Approved')->get();
                                        ?>
                                        <h4 class="text-danger text-center p-3">{{ count($sickLeave) }} / @if(!empty($leavePolicy)) {{ $leavePolicy->sick_leave }} @else 0 @endif</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                <div class="panel panel-primary">
                                    <div class="panel-heading bg-primary">
                                        Undefined Leave
                                    </div>
                                    <div class="panel-body">
                                        <?php 
                                            $undefinedLeave = DB::table('employee_leaves')->where('teacher_id', $employee->id)->where('leave_type', '=', 'Undefined Leave')->where('status', '=', 'Approved')->get();
                                        ?>
                                        <h4 class="text-primary text-center p-3">{{ count($undefinedLeave) }} / &infin;</h4>
                                    </div>
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


@endsection