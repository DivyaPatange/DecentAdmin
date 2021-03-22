@extends('admin.admin_layout.main')
@section('title', 'Payment')
@section('page_title', 'Make Payment')
@section('breadcrumb', 'Make Payment')
@section('customcss')
<!-- Select 2 css -->
<link rel="stylesheet" href="{{ asset('files/bower_components/select2/css/select2.min.css') }}" />
<style>
.select2-container .select2-selection--single{
    height:39px;
}
.card .card-header span{
    margin-top:0px;
}
.select2-container--default .select2-selection--single .select2-selection__rendered{
    padding: 4px 30px 4px 20px;
}
</style>
@endsection
@section('content')
<div class="row">
    <div class="col-sm-12">
        <!-- Material tab card start -->
        <div class="card">
            <div class="card-header">
                <h5>Student Info</h5>
            </div>
            <div class="card-block">
                <!-- Row start -->
                <div class="row">
                    <div class="col-lg-12 col-xl-12">
                        <ul class="nav nav-tabs md-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#home3" role="tab">Search By Regi. No.</a>
                                <div class="slide"></div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#profile3" role="tab">Search By Class</a>
                                <div class="slide"></div>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content card-block">
                            <div class="tab-pane active" id="home3" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group form-default">
                                            <label>Student Regi. No.<span  style="color:red" id="allot_academic_err"> </span></label>
                                            <input type="text" name="student_regi_no" class="form-control" id="student_regi_no">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="profile3" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group form-default">
                                            <label>Class <span  style="color:red" id="allot_class_err"> </span></label>
                                            <select name="class_name" class="form-control js-example-basic-single" id="class_name">
                                                <option value="">-Select Class-</option>
                                                @foreach($classes as $c)
                                                <option value="{{ $c->id }}">{{ $c->class_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-default">
                                            <label>Section <span  style="color:red" id="section_err"> </span></label>
                                            <select name="section_name" class="form-control js-example-basic-single" id="section_name">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-default">
                                            <label>Roll No. <span  style="color:red" id="roll_err"> </span></label>
                                            <input type="text" name="roll_no" class="form-control" id="roll_no">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row end -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group form-default">
                            <label>Student Name <span  style="color:red" id="student_err"> </span></label>
                            <input type="text" name="student_name" readonly class="form-control" id="student_name">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Material tab card end -->
    </div>
</div>
@endsection
@section('customjs')
<!-- Select 2 js -->
<script type="text/javascript" src="{{ asset('files/bower_components/select2/js/select2.full.min.js') }}"></script>
<!-- Custom js -->
<script type="text/javascript" src="{{ asset('files/assets/pages/advance-elements/select2-custom.js') }}"></script>
<script>
$('#class_name').change(function(){
  var classID = $(this).val();  
//   alert(brandID);
  if(classID){
    $.ajax({
      type:"GET",
      url:"{{url('admin/get-section-list')}}?class_id="+classID,
      success:function(res){        
      if(res){
        $("#section_name").empty();
        $("#section_name").append('<option>Select Section</option>');
        $.each(res,function(key,value){
          $("#section_name").append('<option value="'+key+'">'+value+'</option>');
        });
      
      }else{
        $("#section_name").empty();
      }
      }
    });
  }else{
    $("#section_name").empty();
  }   
  });
</script>
@endsection