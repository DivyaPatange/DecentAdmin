@extends('frontend.front_layout.main')
@section('title', 'Secretary Desk')
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
                        <h4 class="card-title text-center"><b>Secretary Desk</b></h4>
                    </div>
                    <div class="card-body">
                        <img class="img-responsive float-left pr-3" src="{{ asset('frontAsset/assets/img/dummy.png') }}" width="200px">
                    <p class="text-justify class1">
                        At DECENT ENGLISH SCHOOL,Nagpur, we recognize the imperative of imparting an educational experience that is world-class in every respect and which prepares children for global citizenship. We are a school with an Indian mind, an Indian heart and an Indian soul; a school that celebrates the culture of excellence and is an embodiment of values. We believe that a curriculum of excellence with a global dimension is central to the education of children to face the challenges of the 21st century with confidence and strength of character.
                    </p>
                    <p class="text-justify class1">
                        Our caring and committed teachers are our pillars of strength. They teach our children not just with their minds but with their hearts, making learning enjoyable and rewarding, and instilling in children sound values and attributes. Our educational programmes are complemented by state-of-the-art facilities and resources, and numerous opportunities for children to engage and excel in sports and co-curricular activities.
                    </p><br>
                    <p class="text-right">- Founder & Secretary</p>
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