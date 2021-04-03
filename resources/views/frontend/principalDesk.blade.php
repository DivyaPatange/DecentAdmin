@extends('frontend.front_layout.main')
@section('title', 'Principal Desk')
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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title text-center"><b>Principal Desk</b></h4>
                    </div>
                    <div class="card-body">
                        <img class="img-responsive float-left pr-3" src="{{ asset('frontAsset/assets/img/dummy.png') }}" width="200px">
                        <p class="text-justify">
                            The Principal of DECENT ENGLISH SCHOOL is experienced in administration. She had attended the Principal  conference twice. She is visionary who looks forward to make this school, the best school in Nagpur. She says Education in not the amount of information that is put into a child’s brain & remain there for the whole life. It is helping the child realize his potential. Education commences at the mothers knees is carried on with teacher’s hand & builds his life & character. It is the ability to meet life’s situations and this is exactly what we are try in do at Gurukul India Olympiad School Of Scholers. Only imparting knowledge does not help, we should aim at virtuous actions, which is result of right knowledge.
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