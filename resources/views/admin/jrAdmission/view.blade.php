@extends('admin.admin_layout.main')
@section('title', 'Student Profile')
@section('page_title', 'Student Profile')
@section('breadcrumb', 'Student Profile')
@section('customcss')

<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<!-- ico font -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/icon/icofont/css/icofont.css') }}">
<!-- animation nifty modal window effects css -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/css/component.css') }}">
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        @if ($message = Session::get('success'))
		<div class="alert alert-success alert-block mt-3">
			<button type="button" class="close" data-dismiss="alert">×</button>	
				<strong><i class="fa fa-check text-white">&nbsp;</i>{{ $message }}</strong>
		</div>
		@endif
		@if ($message = Session::get('danger'))
		<div class="alert alert-danger alert-block mt-3">
			<button type="button" class="close" data-dismiss="alert">×</button>	
				<strong>{{ $message }}</strong>
		</div>
		@endif
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <!-- Zero config.table start -->
        <div class="card">
            <div class="card-header">
                <h5>Student Detail ({{ $admission->collage_ID }})</h5>
            </div>
            <div class="card-block">
                <div class="row">
                    <div class="col-md-3 col-xl-6">
                        <p class=""><b>Admission Reg. No.</b></p>
                    </div>
                    <div class="col-md-3 col-xl-6">
                        <p class="">{{ $admission->admission_reg_no }}</p>
                    </div>
                    <div class="col-md-3 col-xl-6">
                        <p class=""><b>Admission Date.</b></p>
                    </div>
                    <div class="col-md-3 col-xl-6">
                        <p class="">{{ $admission->admission_date }}</p>
                    </div>
                    <div class="col-md-3 col-xl-6">
                        <p class=""><b>Student Name</b></p>
                    </div>
                    <div class="col-md-9 col-xl-9">
                        <p class="">{{ $admission->student_name }}</p>
                    </div>
                    <div class="col-md-3 col-xl-3">
                        <p class=""><b>Father Name</b></p>
                    </div>
                    <div class="col-md-3 col-xl-3">
                        <p class="">{{ $admission->father_name }}</p>
                    </div>
                    <div class="col-md-3 col-xl-3">
                        <p class=""><b>Mother Name</b></p>
                    </div>
                    <div class="col-md-3 col-xl-3">
                        <p class="">{{ $admission->mother_name }}</p>
                    </div>
                    <div class="col-md-3 col-xl-3">
                        <p class=""><b>Father Occupation</b></p>
                    </div>
                    <div class="col-md-3 col-xl-3">
                        <p class="">{{ $admission->f_occupation }}</p>
                    </div>
                    <div class="col-md-3 col-xl-3">
                        <p class=""><b>Mother Occupation</b></p>
                    </div>
                    <div class="col-md-3 col-xl-3">
                        <p class="">{{ $admission->m_occupation }}</p>
                    </div>
                    <div class="col-md-3 col-xl-3">
                        <p class=""><b>Mobile No.</b></p>
                    </div>
                    <div class="col-md-3 col-xl-3">
                        <p class="">@if($admission->mobile_no) {{ $admission->mobile_no }}@else N/A @endif</p>
                    </div>
                    <div class="col-md-3 col-xl-3">
                        <p class=""><b>Adhaar No.</b></p>
                    </div>
                    <div class="col-md-3 col-xl-3">
                        <p class="">@if($admission->adhaar_no){{ $admission->adhaar_no }} @else N/A @endif</p>
                    </div>
                    <div class="col-md-3 col-xl-3">
                        <p class=""><b>ID No.</b></p>
                    </div>
                    <div class="col-md-3 col-xl-3">
                        <p class="">@if($admission->id_no){{ $admission->id_no }}@else N/A @endif</p>
                    </div>
                    <div class="col-md-3 col-xl-3">
                        <p class=""><b>Date Of Birth</b></p>
                    </div>
                    <div class="col-md-3 col-xl-3">
                        <p class="">{{ $admission->date_of_birth }}</p>
                    </div>
                    <div class="col-md-3 col-xl-3">
                        <p class=""><b>Address</b></p>
                    </div>
                    <div class="col-md-9 col-xl-9">
                        <p class="">{{ $admission->address }}</p>
                    </div>
                    <div class="col-md-3 col-xl-3">
                        <p class=""><b>Religion</b></p>
                    </div>
                    <div class="col-md-3 col-xl-3">
                        <p class="">{{ $admission->religion }}</p>
                    </div>
                    <div class="col-md-3 col-xl-3">
                        <p class=""><b>Caste</b></p>
                    </div>
                    <div class="col-md-3 col-xl-3">
                        <p class="">{{ $admission->caste }}</p>
                    </div>
                    <div class="col-md-3 col-xl-3">
                        <p class=""><b>Sub-Caste</b></p>
                    </div>
                    <div class="col-md-3 col-xl-3">
                        <p class="">{{ $admission->sub_caste }}</p>
                    </div>
                    <div class="col-md-3 col-xl-3">
                        <p class=""><b>Last Exam Passed</b></p>
                    </div>
                    <div class="col-md-3 col-xl-3">
                        <p class="">{{ $admission->last_exam_passed }}</p>
                    </div>
                    <div class="col-md-3 col-xl-3">
                        <p class=""><b>Percentage</b></p>
                    </div>
                    <div class="col-md-3 col-xl-3">
                        <p class="">{{ $admission->percentage }}</p>
                    </div>
                    <div class="col-md-3 col-xl-3">
                        <p class=""><b>Math Marks</b></p>
                    </div>
                    <div class="col-md-3 col-xl-3">
                        <p class="">{{ $admission->math_mark }}</p>
                    </div>
                    <div class="col-md-3 col-xl-3">
                        <p class=""><b>Science Mark</b></p>
                    </div>
                    <div class="col-md-3 col-xl-3">
                        <p class="">{{ $admission->science_mark }}</p>
                    </div>
                    <div class="col-md-3 col-xl-3">
                        <p class=""><b>Out Of</b></p>
                    </div>
                    <div class="col-md-3 col-xl-3">
                        <p class="">{{ $admission->out_of }}</p>
                    </div>
                    <div class="col-md-3 col-xl-3">
                        <p class=""><b>Last School Attended</b></p>
                    </div>
                    <div class="col-md-9 col-xl-9">
                        <p class="">{{ $admission->last_school_attended }}</p>
                    </div>
                    <div class="col-md-3 col-xl-3">
                        <p class=""><b>Board</b></p>
                    </div>
                    <div class="col-md-3 col-xl-3">
                        <p class="">{{ $admission->board }}</p>
                    </div>
                    @if($admission->board == "Other")
                    <div class="col-md-3 col-xl-3">
                        <p class=""><b>Other Board</b></p>
                    </div>
                    <div class="col-md-3 col-xl-3">
                        <p class="">{{ $admission->other_board }}</p>
                    </div>
                    @endif
                    <div class="col-md-3 col-xl-3">
                        <p class=""><b>Class in which admission sought</b></p>
                    </div>
                    <div class="col-md-3 col-xl-3">
                        <p class="">{{ $admission->adm_sought }}</p>
                    </div>
                    <div class="col-md-3 col-xl-3">
                        <p class=""><b>Academic Session</b></p>
                    </div>
                    <?php 
                     $academicYear = DB::table('academic_years')->where('id', $admission->academic_id)->where('status', 1)->first();
                    ?>
                    <div class="col-md-3 col-xl-3">
                        <p class="">@if(!empty($academicYear)) ({{ $academicYear->from_academic_year }}) - ({{ $academicYear->to_academic_year }}) @endif</p>
                    </div>
                    <div class="col-md-3 col-xl-3">
                        <p class=""><b>Stream</b></p>
                    </div>
                    <div class="col-md-3 col-xl-3">
                        <p class="">@if($admission->stream == "Option-1") General Science - English, Physics, Chemistry, Maths, Biology, Hindi
                            @elseif($admission->stream == "Option-2") General Science - English, Physics, Chemistry, Hindi, Biology, Sociology
                            @elseif($admission->stream == "Option-3") General Science - English, Physics, Chemistry, Maths, Biology, IT 
                            @elseif($admission->stream == "Option-4") General Science - English, Physics, Chemistry, Maths, Sociology, IT 
                            @elseif($admission->stream == "Option-5") General Science - English, Physics, Chemistry, Maths, Computer Science
                            @elseif($admission->stream == "Option-6") General Science - English, Physics, Chemistry, Biology, Fisheries
                            @elseif($admission->stream == "Option-7") Electronics - English, Physics, Chemistry, Maths, Electronics 
                            @endif
                        </p>
                    </div>
               </div>
            </div>
        </div>
        <!-- Zero config.table end -->
    </div>
</div>

@endsection
@section('customjs')

@endsection