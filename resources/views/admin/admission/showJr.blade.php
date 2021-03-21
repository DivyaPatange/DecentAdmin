@extends('admin.admin_layout.main')
@section('title', 'Admission Details')
@section('page_title', 'Admission Details')
@section('breadcrumb', 'Admission Details')
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
                <img src="@if($admission->student_photo){{  URL::asset('studentPhoto/' . $admission->student_photo) }}@else {{ asset('avatar.png') }}@endif" alt="" class="img-fluid" width="100px">
                <h4>{{ $admission->student_name }}</h4>
                <?php 
                    $class = DB::table('classes')->where('id', $admission->adm_sought)->first();
                ?>
                <p>@if(!empty($class)){{ $class->class_name }} @endif</p>
            </div>
            <div class="card-block">
                <p><b>Applicaton No.</b> <span class="text-primary">{{ $admission->application_no }}</span></p>
                <hr>
                <p><b>Contact No.</b> <span class="text-primary">{{ $admission->mobile_no }}</span></p>
                <hr>
                <p><b>Address.</b> <span class="text-primary">{{ $admission->address }}</span></p>
            </div>
        </div>

    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header p-b-0">
                <ul class="nav nav-tabs md-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#position" role="tab">Profile</a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#invoice" role="tab">Invoice</a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#float" role="tab">Payment</a>
                        <div class="slide"></div>
                    </li>
                    
                </ul>
            </div>
            <div class="card-block tab-content p-t-20">
                <div class="tab-pane fade show active" id="position" role="tabpanel">
                    <div class="generic-card-body">
                        <h6 class="sub-title">Personal Info </h6>
                        <div class="row">
                            <div class="col-md-3">
                                <p><b>Student Name </b></p>
                            </div>
                            <div class="col-md-3">
                                <p>: {{ $admission->student_name }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Date of Birth </b></p>
                            </div>
                            <div class="col-md-3">
                                <p>: {{ $admission->dob }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Father Name </b></p>
                            </div>
                            <div class="col-md-3">
                                <p>: {{ $admission->father_name }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Mother Name </b></p>
                            </div>
                            <div class="col-md-3">
                                <p>: {{ $admission->mother_name }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Father Occupation</b></p>
                            </div>
                            <div class="col-md-3">
                                <p>: {{ $admission->f_occupation }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Mother Occupation </b></p>
                            </div>
                            <div class="col-md-3">
                                <p>: {{ $admission->m_occupation }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Mobile No. </b></p>
                            </div>
                            <div class="col-md-3">
                                <p>: {{ $admission->mobile_no }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Adhaar No. </b></p>
                            </div>
                            <div class="col-md-3">
                                <p>: {{ $admission->adhaar_no }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>ID No. </b></p>
                            </div>
                            <div class="col-md-3">
                                <p>: {{ $admission->id_no }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Religion </b></p>
                            </div>
                            <div class="col-md-3">
                                <p>: {{ $admission->religion }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Caste </b></p>
                            </div>
                            <div class="col-md-3">
                                <p>: {{ $admission->caste }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Sub-Caste </b></p>
                            </div>
                            <div class="col-md-3">
                                <p>: {{ $admission->sub_caste }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Address </b></p>
                            </div>
                            <div class="col-md-9">
                                <p>: {{ $admission->address }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Last Exam Passed </b></p>
                            </div>
                            <?php 
                                $class1 = DB::table('classes')->where('id', $admission->last_exam_passed)->first();
                            ?>
                            <div class="col-md-3">
                                <p>: @if(!empty($class1)){{ $class1->class_name }} @endif</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Percentage </b></p>
                            </div>
                            <div class="col-md-3">
                                <p>: {{ $admission->percentage }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Out Of </b></p>
                            </div>
                            <div class="col-md-3">
                                <p>: {{ $admission->out_of }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Marks in Maths </b></p>
                            </div>
                            <div class="col-md-3">
                                <p>: {{ $admission->math_mark }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Marks in Science </b></p>
                            </div>
                            <div class="col-md-3">
                                <p>: {{ $admission->science_mark }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Last School Attended </b></p>
                            </div>
                            <div class="col-md-3">
                                <p>: {{ $admission->last_school_attended }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Board </b></p>
                            </div>
                            <div class="col-md-3">
                                <p>: {{ $admission->board }}</p>
                            </div>
                            @if($admission->board == "Other")
                            <div class="col-md-3">
                                <p><b>Other Board </b></p>
                            </div>
                            <div class="col-md-3">
                                <p>: {{ $admission->other_board }}</p>
                            </div>
                            @endif
                            <div class="col-md-3">
                                <p><b>Class </b></p>
                            </div>
                            <div class="col-md-3">
                                <p>: @if(!empty($class)){{ $class->class_name }} @endif</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Stream </b></p>
                            </div>
                            <div class="col-md-9">
                                <p>: @if($admission->stream == "Option-1") General Science - English, Physics, Chemistry, Maths, Biology, Hindi @endif
                                @if($admission->stream == "Option-2") General Science - English, Physics, Chemistry, Hindi, Biology, Sociology @endif
                                @if($admission->stream == "Option-3") General Science - English, Physics, Chemistry, Maths, Biology, IT @endif
                                @if($admission->stream == "Option-4") General Science - English, Physics, Chemistry, Maths, Sociology, IT @endif 
                                @if($admission->stream == "Option-5") General Science - English, Physics, Chemistry, Maths, Computer Science @endif
                                @if($admission->stream == "Option-6") General Science - English, Physics, Chemistry, Biology, Fisheries @endif
                                @if($admission->stream == "Option-7") Electronics - English, Physics, Chemistry, Maths, Electronics @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="float" role="tabpanel">
                    <div class="generic-card-body">
                        <h6 class="sub-title">Payment </h6>
                        
                    </div>
                </div>
                <div class="tab-pane fade" id="float" role="tabpanel">
                    <div class="generic-card-body">
                        <h6 class="sub-title">Invoice </h6>
                        
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