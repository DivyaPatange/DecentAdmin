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
                <h4>{{ $admission->student_name }}</h4>
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
                <p><b>Address.</b> <span class="text-primary">{{ $admission->address }}</span></p>
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
