@extends('frontend.front_layout.main')
@section('title', 'School Information')
@section('customcss')
<style type="text/css">
    .class1{
      font-size: 15px;
    }
</style>
@endsection
@section('content')
<!-- ======= Hero Section ======= -->
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card" style="min-height: 412px">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title text-center"><b><a href="">Aim</a></b></h4>
                    </div>
                    <div class="card-body">
                        <p class="text-justify">The School aims at making the students attain self fulfilment in their personal lives and become useful citizens of our mother land India. DECENT ENGLISH SCHOOL, Nagpur has these facts in mind. To achieve this, the students ,are assisted to grow morally,intellectually physcially ans socially by forming in them the habits of basic virtues like honesty ,dedication, hardwork, excellence in both academic and non-academic activities. Habits of health care, athletic values, characteristics to ancient heritage and modern progress are embeded in them. Value Education is given an important place in the curriculum. Our Schools came to recognize in the region for it's valued education.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card" style="min-height: 412px">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title text-center"><b><a href="">Our Identity</a></b></h4>
                    </div>
                    <div class="card-body">
                        <img class="img-responsive float-left pr-3" src="{{ asset('frontAsset/images/school.png') }}" width="200px">
                        <p class="text-justify">
                        Keeping the need of time in mind the school prepares all the student to face many challenges in the inter-school level for excellency. DECENT ENGLISH SCHOOL Club holds extra curricular activities such as painting, clay modeling, craft, drama, dance, one actplay, speeches, indoor and outdoor games including visual shows.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
@endsection 
@section('customjs')

@endsection