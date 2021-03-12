@extends('admin.admin_layout.main')
@section('title', 'Section')
@section('page_title', 'Add Section')
@section('breadcrumb', 'Add Section')
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
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Add Section</h5>
            </div>
            <div class="card-block">
                <div class="alert alert-info icons-alert">
                    <p><strong>Note!</strong> Create a teacher and class before create new section.</p>
                </div>
                <form class="form-material" id="form-submit" method="POST" action="{{ route('admin.sections.store') }}">
                @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-default">
                                <input type="text" name="section_name" class="form-control" id="section_name">
                                <span class="form-bar"></span>
                                <label class="float-label">Section Name<span style="color:red;">*</span><span  style="color:red" id="name_err"> </span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-default">
                                <input type="number" name="capacity" class="form-control" id="capacity">
                                <span class="form-bar"></span>
                                <label class="float-label">Capacity
                                    <span style="color:red;">*</span><span  style="color:red" id="capacity_err"> </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-default">
                            <label class="">Class Name
                                    <span style="color:red;">*</span><span  style="color:red" id="class_err"> </span>
                                </label>
                                <select class="js-example-basic-single col-sm-12" name="class_name" id="class_name">
                                    <option value="">Select Class</option>
                                    @foreach($classes as $c)
                                    <option value="{{ $c->id }}">{{ $c->class_name }}</option>
                                    @endforeach
                                </select>    
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-default">
                                <label class="">Teacher Name
                                    <span style="color:red;">*</span><span  style="color:red" id="teacher_err"> </span>
                                </label>
                                <select class="js-example-basic-single col-sm-12" name="teacher_name" id="teacher_name">
                                    <option value="">Select Teacher</option>
                                    @foreach($teachers as $t)
                                    <option value="{{ $t->id }}">{{ $t->name }}</option>
                                    @endforeach
                                </select>    
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-default">
                                <textarea name="note" id="note" class="form-control"></textarea>
                                <span class="form-bar"></span>
                                <label class="float-label">Note</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-sm waves-effect waves-light hor-grd btn-grd-primary" type="button" id="submitForm">Submit</button>
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


$('body').on('click', '#submitForm', function () {
    var section_name = $("#section_name").val();
    var capacity = $("#capacity").val();
    var class_name = $("#class_name").val();
    var teacher_name = $("#teacher_name").val();
    // alert(teacher_name);
    if (section_name=="") {
        $("#name_err").fadeIn().html("Required");
        setTimeout(function(){ $("#name_err").fadeOut(); }, 3000);
        $("#section_name").focus();
        return false;
    }
    if (capacity=="") {
        $("#capacity_err").fadeIn().html("Required");
        setTimeout(function(){ $("#capacity_err").fadeOut(); }, 3000);
        $("#capacity").focus();
        return false;
    }
    if (class_name=="") {
        $("#class_err").fadeIn().html("Required");
        setTimeout(function(){ $("#class_err").fadeOut(); }, 3000);
        $("#class_name").focus();
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
        $('.form-material').submit();  
    }
})


</script>

@endsection