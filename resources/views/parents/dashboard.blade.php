@extends('parents.parent_layout.main')
@section('title', 'Dashboard')
@section('page_title', 'Dashboard')
@section('customcss')

@endsection
@section('content')

<div class="row">
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="text-muted">Upcoming Exam</h5>
                <div class="metric-value d-inline-block">
                    <h1 class="mb-1">{{ date("Y/m/d") }}</h1>
                </div>
                
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="text-muted">Upcoming Event</h5>
                <div class="metric-value d-inline-block">
                    <h1 class="mb-1">{{ date("Y/m/d") }}</h1>
                </div>
               
            </div>
           
        </div>
    </div>
</div>
@endsection
@section('customjs')
@endsection
