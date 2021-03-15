@extends('admin.admin_layout.main')
@section('title', 'Subject Teacher')
@section('page_title', 'Edit Subject Teacher')
@section('breadcrumb', 'Edit Subject Teacher')
@section('customcss')
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<!-- ico font -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/icon/icofont/css/icofont.css') }}">
<!-- Select 2 css -->
<link rel="stylesheet" href="{{ asset('files/bower_components/select2/css/select2.min.css') }}" />
<!-- animation nifty modal window effects css -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/css/component.css') }}">
<style>

  .select2-container--open .select2-dropdown--below{
      z-index:100000;
  }
</style>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Edit Subject Teacher</h5>
                <!--<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>-->
            </div>
            <div class="card-block">
                <form class="form-material" id="form-submit" method="POST" action="{{ route('admin.subject-teacher.update', $subTeacher->id) }}">
                @csrf 
                @method('PUT')
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group form-default">
                                <label class="">Class Name<span style="color:red;">*</span><span  style="color:red" id="section_err"> </span></label>
                                <select class="js-example-basic-single col-sm-12" name="section_name" id="section_name">
                                    <option value="">Select Class</option>
                                    @foreach($sections as $s)
                                    <?php 
                                        $class = DB::table('classes')->where('id', $s->class_id)->where('status', 1)->first();
                                    ?>
                                    <option value="{{ $s->id }}" @if($s->id == $subTeacher->section_id) Selected @endif>@if(!empty($class)) {{ $class->class_name }} {{ $s->section_name }} @endif</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-default">
                                <label class="">Subject Name
                                    <span style="color:red;">*</span><span  style="color:red" id="subject_err"> </span>
                                </label>
                                <select class="js-example-basic-single col-sm-12" name="subject_name" id="subject_name">
                                    @foreach($subjects as $s)
                                    <option value="{{ $s->id }}" @if($s->id == $subTeacher->subject_id) Selected @endif>{{ $s->subject_name }}</option>
                                    @endforeach
                                </select>   
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-default">
                                <label class="">Teacher Name
                                    <span style="color:red;">*</span><span  style="color:red" id="teacher_err"> </span>
                                </label>
                                <select class="js-example-basic-single col-sm-12" name="teacher_name" id="teacher_name">
                                    <option value="">Select Teacher</option>
                                    @foreach($teachers as $t)
                                    <option value="{{ $t->id }}" @if($t->id == $subTeacher->teacher_id) Selected @endif>{{ $t->name }}</option>
                                    @endforeach
                                </select>   
                            </div>
                        </div>
                        <div class="col-md-12">
                        <button class="btn btn-sm waves-effect waves-light hor-grd btn-grd-primary" type="button" id="submitForm">Update</button>
                        </div>
                    </div>
                    
                </form>
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
$('#section_name').change(function(){
  var sectionID = $(this).val();  
//   alert(brandID);
  if(sectionID){
    $.ajax({
      type:"GET",
      url:"{{url('admin/get-subject-list')}}?section_id="+sectionID,
      success:function(res){        
      if(res){
        $("#subject_name").empty();
        $("#subject_name").append('<option>Select Subject</option>');
        $.each(res,function(key,value){
          $("#subject_name").append('<option value="'+key+'">'+value+'</option>');
        });
      
      }else{
        $("#subject_name").empty();
      }
      }
    });
  }else{
    $("#subject_name").empty();
  }   
  });

$('body').on('click', '#submitForm', function () {
    var section_name = $("#section_name").val();
    var subject_name = $("#subject_name").val();
    var teacher_name = $("#teacher_name").val();
    if (section_name=="") {
        $("#section_err").fadeIn().html("Required");
        setTimeout(function(){ $("#section_err").fadeOut(); }, 3000);
        $("#section_name").focus();
        return false;
    }
    if (subject_name=="") {
        $("#subject_err").fadeIn().html("Required");
        setTimeout(function(){ $("#subject_err").fadeOut(); }, 3000);
        $("#subject_name").focus();
        return false;
    }
    if (teacher_name=="") {
        $("#teacher_err").fadeIn().html("Required");
        setTimeout(function(){ $("#teacher_err").fadeOut(); }, 3000);
        $("#teacher_name").focus();
        return false;
    }
    else
    { 
        $("#form-submit").submit();
    }
})


</script>

@endsection