@extends('parents.parent_layout.main')
@section('title', 'Admission Details')
@section('page_title', 'Admission Details')
@section('breadcrumb', 'Admission Details')
@section('customcss')
<style>
.hidden{
    display:none;
}
</style>
@endsection
@section('content')

<!-- ============================================================== -->
<!-- checkboxes and radio -->
<!-- ============================================================== -->
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
            <div class="card-body">
            <p><b>Applicaton No.</b> <span class="text-primary">{{ $admission->application_no }}</span></p>
                <hr>
                <p><b>Contact No.</b> <span class="text-primary">{{ $admission->mobile_no }}</span></p>
                <hr>
                <p><b>Address.</b> <span class="text-primary">{{ $admission->postal_address }}</span></p>
            </div>
        </div>

    </div>
    <div class="col-md-8">
        <div class="tab-regular">
            <ul class="nav nav-tabs nav-fill" id="myTab7" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab-justify" data-toggle="tab" href="#home-justify" role="tab" aria-controls="home" aria-selected="true">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab-justify" data-toggle="tab" href="#profile-justify" role="tab" aria-controls="profile" aria-selected="false">Invoice</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab-justify" data-toggle="tab" href="#contact-justify" role="tab" aria-controls="contact" aria-selected="false">Payment</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent7">
                <div class="tab-pane fade show active" id="home-justify" role="tabpanel" aria-labelledby="home-tab-justify">
                    <div class="generic-card-body">
                        <h3>Personal Info </h3>
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
                        <h3>Father Details </h3>
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
                        <h3>Mother Details </h3>
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
                        <h3>Guardian Details </h3>
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
                <div class="tab-pane fade" id="profile-justify" role="tabpanel" aria-labelledby="profile-tab-justify">
            
                </div>
                <div class="tab-pane fade" id="contact-justify" role="tabpanel" aria-labelledby="contact-tab-justify">
                   
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- end checkboxes and radio -->
<!-- ============================================================== -->
@endsection
@section('customjs')

<script src="{{ asset('assets/vendor/datepicker/moment.js') }}"></script>
<script src="{{ asset('assets/vendor/datepicker/tempusdominus-bootstrap-4.js') }}"></script>
<script src="{{ asset('assets/vendor/datepicker/datepicker.js') }}"></script>

@endsection
