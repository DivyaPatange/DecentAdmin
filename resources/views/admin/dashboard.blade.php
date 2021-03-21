@extends('admin.admin_layout.main')
@section('title', 'Dashboard')
@section('page_title', 'Dashboard')
@section('breadcrumb', 'Dashboard')
@section('customcss')

@endsection
@section('content')
<div class="row">
    <!-- task, page, download counter  start -->
    <div class="col-xl-3 col-md-4">
    <?php 
        $jrAdmission = DB::table('admissions')->where('admission_date', date('Y-m-d'))->where('admission_for', "Junior College Admission")->get();
        $prAdmission = DB::table('admissions')->where('admission_date', date('Y-m-d'))->where('admission_for', "Primary School Admission")->get();
        $totalFee = DB::table('pays')->get();
        $visitors = DB::table('visitors')->where('visit_date', date('Y-m-d'))->get();
        $inward = DB::table('inwards')->where('in_date', date('Y-m-d'))->get();
        $outward = DB::table('outwards')->where('out_date', date('Y-m-d'))->get();
    ?>
        <div class="card">
            <div class="card-block">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h4 class="text-c-purple @if(count($jrAdmission) > 0) blink @endif">{{ count($jrAdmission) }}</h4>
                    </div>
                    <div class="col-4 text-right">
                        <i class="fa fa-bar-chart f-28"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-c-purple">
                <div class="row align-items-center">
                    <div class="col-12">
                        <p class="text-white m-b-0 blink">Todays Junior College Admission</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-4">
        <div class="card">
            <div class="card-block">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h4 class="text-c-green @if(count($prAdmission) > 0) blink @endif">{{ count($prAdmission) }}</h4>
                    </div>
                    <div class="col-4 text-right">
                        <i class="fa fa-file-text-o f-28"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-c-green">
                <div class="row align-items-center">
                    <div class="col-12">
                        <p class="text-white m-b-0 @if(count($prAdmission) > 0) blink @endif">Today's Primary School Admission</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-4">
        <div class="card">
            <div class="card-block">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h4 class="text-c-red @if(count($totalFee) > 0) blink @endif">{{ count($totalFee) }}</h4>
                    </div>
                    <div class="col-4 text-right">
                        <i class="fa fa-calendar-check-o f-28"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-c-red">
                <div class="row align-items-center">
                    <div class="col-12">
                        <p class="text-white m-b-0 @if(count($totalFee) > 0) blink @endif">Total Fee Collection</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-4">
        <div class="card">
            <div class="card-block">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h4 class="text-c-default @if(count($visitors) > 0) blink @endif">{{ count($visitors) }}</h4>
                    </div>
                    <div class="col-4 text-right">
                        <i class="fa fa-hand-o-down f-28"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-default">
                <div class="row align-items-center">
                    <div class="col-12">
                        <p class="text-white m-b-0 @if(count($visitors) > 0) blink @endif">Today's Visitor Registration</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-4">
        <div class="card">
            <div class="card-block">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h4 class="text-warning @if(count($inward) > 0) blink @endif">{{ count($inward) }}</h4>
                    </div>
                    <div class="col-4 text-right">
                        <i class="fa fa-file-text-o f-28"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-warning">
                <div class="row align-items-center">
                    <div class="col-12">
                        <p class="text-dark m-b-0 @if(count($inward) > 0) blink @endif">Today's Inward Document</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-4">
        <div class="card">
            <div class="card-block">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h4 class="text-info @if(count($outward) > 0) blink @endif">{{ count($outward) }}</h4>
                    </div>
                    <div class="col-4 text-right">
                        <i class="fa fa-calendar-check-o f-28"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-info">
                <div class="row align-items-center">
                    <div class="col-12">
                        <p class="text-white m-b-0 @if(count($outward) > 0) blink @endif">Today's Outward Document</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- task, page, download counter  end -->

    <!--  acttivity and feed end -->
</div>
@endsection
@section('customjs')


@endsection