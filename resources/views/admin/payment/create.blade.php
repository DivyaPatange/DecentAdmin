@extends('admin.admin_layout.main')
@section('title', 'Payment')
@section('page_title', 'Make Payment')
@section('breadcrumb', 'Make Payment')
@section('customcss')
<!-- Select 2 css -->
<link rel="stylesheet" href="{{ asset('files/bower_components/select2/css/select2.min.css') }}" />
<!-- themify-icons line icon -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/icon/themify-icons/themify-icons.css') }}">
<!-- ico font -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/icon/icofont/css/icofont.css') }}">
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
.icons-alert:before{
    top:10px;
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
                    <div class="col-md-4">
                        <div class="form-group form-default">
                        <br>
                            <button type="button" id="getList" class="btn btn-primary btn-sm">Search</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Material tab card end -->
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>Fee Info</h5>
            </div>
            <div class="card-block">

            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>Pay Fee</h5>
            </div>
            <div class="card-block">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger icons-alert">
                            <p><strong>Note!</strong> Search Student First</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group form-default">
                            <label>Fee Head <span  style="color:red" id="allot_class_err"> </span></label>
                            <select name="fee_head" class="form-control js-example-basic-single" id="fee_head">
                                
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive"> 
                            <table class="table table-bordered"> 
                                <thead> 
                                    <tr> 
                                        <th class="text-center">Fee Head</th> 
                                        <th class="text-center">Amount</th> 
                                        <th></th>
                                    </tr> 
                                </thead> 
                                <tbody id="tbody"> 
                        
                                </tbody> 
                            </table> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

$('#getList').click(function(){
    // the click occured outside '#element'
    var regi_no = $('#student_regi_no').val();
    var roll_no = $('#roll_no').val();
    var classs = $('#class_name').val();
    var section = $('#section_name').val();
    // alert(regi_no != '');
    if((regi_no != '') || (roll_no != '') || (classs != '') || (section != ''))
    {
        $.ajax({
        type:"GET",
        url:"{{url('admin/get-student-name')}}?regi_no="+regi_no+"&roll_no="+roll_no+"&classs="+classs+"&section="+section,
        success:function(res){ 
            // alert(res.fees);
            $("#student_name").val(res.name);
            if(res.fees){
            $("#fee_head").empty();
            $("#fee_head").append('<option value="">Select Fee Head</option>');
            $.each(res.fees,function(key,value){
                // alert(key, value);
            $("#fee_head").append('<option value="'+key+'">'+value+'</option>');
            });
            }
            else{
                $("#fee_head").empty();
            }
        }
        })  
    }
   
});

var rowIdx = 0; 
$( document ).ready(function() {
$('#fee_head').change(function(){
    var feeID = $(this).val();
    // alert(feeID);
    if(feeID)
    {
        $.ajax({
        type:"GET",
        url:"{{url('admin/get-fee-amount')}}?fee_id="+feeID,
        success:function(res){
            // alert(res);
            $.each(res.fees,function(key,value){
            $('#tbody').append('<tr id="'+res.id+'"><td class="row-index text-center"><p>'+value+'</p></td><td class="row-index text-center"><p>'+key+'</p></td><td class="text-center"><button class="btn btn-danger btn-sm remove" type="button"><i class="fa fa-times mr-0"></i></button></td></tr>'); 
            })
        }
        })
    }
});
});
</script>
@endsection