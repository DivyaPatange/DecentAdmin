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
                <h4>{{ $admission->full_name_pupil }}</h4>
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
                <p><b>Address.</b> <span class="text-primary">{{ $admission->postal_address }}</span></p>
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
                                <p>: {{ $admission->full_name_pupil }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Surname </b></p>
                            </div>
                            <div class="col-md-3">
                                <p>: {{ $admission->surname }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Date of Birth </b></p>
                            </div>
                            <div class="col-md-3">
                                <p>: {{ $admission->dob }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Birth Place </b></p>
                            </div>
                            <div class="col-md-3">
                                <p>: {{ $admission->birth_place }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Father's Name </b></p>
                            </div>
                            <div class="col-md-3">
                                <p>: {{ $admission->father_name }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Mother's Name </b></p>
                            </div>
                            <div class="col-md-3">
                                <p>: {{ $admission->mother_name }}</p>
                            </div>
                            <div class="col-md-4">
                                <p><b>Full Local/Postal Address of Parents </b></p>
                            </div>
                            <div class="col-md-8">
                                <p>: {{ $admission->postal_address }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Occupation </b></p>
                            </div>
                            <div class="col-md-3">
                                <p>: {{ $admission->occupation }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Phone No. </b></p>
                            </div>
                            <div class="col-md-3">
                                <p>: {{ $admission->mobile_no }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Race & Caste </b></p>
                            </div>
                            <div class="col-md-3">
                                <p>: {{ $admission->race_caste }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Monthly Income</b></p>
                            </div>
                            <div class="col-md-3">
                                <p>: {{ $admission->monthly_income }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Nationality</b></p>
                            </div>
                            <div class="col-md-3">
                                <p>: {{ $admission->nationality }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Last School Attended</b></p>
                            </div>
                            <div class="col-md-3">
                                <p>: {{ $admission->last_school_attended }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Last Exam Passed</b></p>
                            </div>
                            <?php 
                                $class1 = DB::table('classes')->where('id', $admission->last_exam_passed)->first();
                            ?>
                            <div class="col-md-3">
                                <p>: @if(!empty($class1)) {{ $class1->class_name }} @endif</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Class</b></p>
                            </div>
                            <div class="col-md-3">
                                <p>: @if(!empty($class)){{ $class->class_name }} @endif</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Medium</b></p>
                            </div>
                            <div class="col-md-3">
                                <p>: {{ $admission->medium }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>RTE</b></p>
                            </div>
                            <div class="col-md-3">
                                <p>: {{ $admission->rte }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="generic-card-body">
                        <h6 class="sub-title">Father Details </h6>
                        <div class="row">
                            <div class="col-md-3">
                                <p><b>Father Name </b></p>
                            </div>
                            <div class="col-md-3">
                                <p>: {{ $admission->father_name1 }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Occupation </b></p>
                            </div>
                            <div class="col-md-3">
                                <p>: {{ $admission->f_occupation }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Education </b></p>
                            </div>
                            <div class="col-md-3">
                                <p>: {{ $admission->f_education }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Phone No. </b></p>
                            </div>
                            <div class="col-md-3">
                                <p>: {{ $admission->f_phone_no }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Address</b></p>
                            </div>
                            <div class="col-md-9">
                                <p>: {{ $admission->f_address }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="generic-card-body">
                        <h6 class="sub-title">Mother Details </h6>
                        <div class="row">
                            <div class="col-md-3">
                                <p><b>Mother Name </b></p>
                            </div>
                            <div class="col-md-3">
                                <p>: {{ $admission->mother_name1 }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Occupation </b></p>
                            </div>
                            <div class="col-md-3">
                                <p>: {{ $admission->m_occupation }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Education </b></p>
                            </div>
                            <div class="col-md-3">
                                <p>: {{ $admission->m_education }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Phone No. </b></p>
                            </div>
                            <div class="col-md-3">
                                <p>: {{ $admission->m_phone_no }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Address</b></p>
                            </div>
                            <div class="col-md-9">
                                <p>: {{ $admission->m_address }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="generic-card-body">
                        <h6 class="sub-title">Guardian Details </h6>
                        <div class="row">
                            <div class="col-md-3">
                                <p><b>Guardian Name </b></p>
                            </div>
                            <div class="col-md-3">
                                <p>: {{ $admission->guardian_name }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Occupation </b></p>
                            </div>
                            <div class="col-md-3">
                                <p>: {{ $admission->g_occupation }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Education </b></p>
                            </div>
                            <div class="col-md-3">
                                <p>: {{ $admission->g_education }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Phone No. </b></p>
                            </div>
                            <div class="col-md-3">
                                <p>: {{ $admission->g_phone_no }}</p>
                            </div>
                            <div class="col-md-3">
                                <p><b>Address</b></p>
                            </div>
                            <div class="col-md-9">
                                <p>: {{ $admission->g_address }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="float" role="tabpanel">
                    <div class="generic-card-body">
                        <h6 class="sub-title">Payment </h6>
                        
                    </div>
                </div>
                <div class="tab-pane fade" id="invoice" role="tabpanel">
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