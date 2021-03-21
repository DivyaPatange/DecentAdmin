@extends('admin.admin_layout.main')
@section('title', 'Teacher')
@section('page_title', 'Teacher Profile')
@section('breadcrumb', 'Teacher Profile')
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
                <img src="@if($teacher->photo){{  URL::asset('teacherPhoto/' . $teacher->photo) }}@else {{ asset('avatar.png') }}@endif" alt="" class="img-fluid" width="100px">
                <h4>{{ $teacher->name }}</h4>
                <p>{{ $teacher->designation }}</p>
            </div>
            <div class="card-block">
                <p><b>ID Card No.</b> <span class="text-primary">{{ $teacher->employee_id }}</span></p>
                <hr>
                <p><b>Contact No.</b> <span class="text-primary">{{ $teacher->mobile_no }}</span></p>
                <hr>
                <p><b>Email.</b> <span class="text-primary">{{ $teacher->email }}</span></p>
            </div>
        </div>

    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header p-b-0">
                <ul class="nav nav-tabs md-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#position" role="tab">Teacher Profile</a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#float" role="tab">Class & Section</a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#overflow" role="tab">Subjects</a>
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
                                <p>{{ $teacher->name }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Date of Birth :</b></p>
                            </div>
                            <div class="col-md-3">
                                <p>{{ $teacher->dob }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Qualification :</b></p>
                            </div>
                            <div class="col-md-3">
                                <p>{{ $teacher->qualification }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Designation :</b></p>
                            </div>
                            <div class="col-md-3">
                                <p>{{ $teacher->designation }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Gender :</b></p>
                            </div>
                            <div class="col-md-3">
                                <p>{{ $teacher->gender }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Religion :</b></p>
                            </div>
                            <div class="col-md-3">
                                <p>{{ $teacher->religion }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Joining Date :</b></p>
                            </div>
                            <div class="col-md-3">
                                <p>{{ $teacher->joining_date }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Username :</b></p>
                            </div>
                            <div class="col-md-3">
                                <p>{{ $teacher->username }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Address :</b></p>
                            </div>
                            <div class="col-md-9">
                                <p>{{ $teacher->address }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="float" role="tabpanel">
                    <div class="generic-card-body">
                        <h6 class="sub-title">Class & Section </h6>
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
                                        <tbody>
                                            @foreach($sections as $s)
                                            <tr>
                                            <?php 
                                                $class = DB::table('classes')->where('id', $s->class_id)->first();
                                            ?>
                                                <td>@if(!empty($class)){{ $class->class_name }}@endif</td>
                                                <td>{{ $s->section_name }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="overflow" role="tabpanel">
                    <div class="generic-card-body">
                        <h6 class="sub-title">Subjects </h6>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Class</th>
                                                <th>Subject</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($subTeacher as $st)
                                            <tr>
                                            <?php 
                                                $section = DB::table('sections')->where('id', $st->section_id)->first();
                                                $subject = DB::table('subjects')->where('id', $st->subject_id)->first();
                                            ?>
                                                <td>@if(!empty($section))
                                                <?php 
                                                    $class1 = DB::table('classes')->where('id', $section->class_id)->first();
                                                ?>
                                                @if(!empty($class1)){{ $class1->class_name }} {{ $section->section_name }} @endif
                                                @endif
                                                </td>
                                                <td>@if(!empty($subject)){{ $subject->subject_name }}@endif</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
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


@endsection