@extends('admin.admin_layout.main')
@section('title', 'Class')
@section('page_title', 'Add Class')
@section('breadcrumb', 'Add Class')
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
        <div class="card">
            <div class="card-header">
                <h5>Add Class</h5>
            </div>
            <div class="card-block">
                <form class="form-material" id="form-submit" method="POST" action="{{ route('admin.class.store') }}">
                @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-default">
                                <input type="text" name="class_name" class="form-control" id="class_name">
                                <span class="form-bar"></span>
                                <label class="float-label">Class Name<span style="color:red;">*</span><span  style="color:red" id="name_err"> </span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-default">
                                <input type="number" name="numeric_value" class="form-control" id="numeric_value">
                                <span class="form-bar"></span>
                                <label class="float-label">Numeric Value
                                    <span style="color:red;">*</span><span  style="color:red" id="numeric_err"> </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-default">
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                    Is Open For Admission?
                                        <input type="checkbox" name="adm" class="form-check-input" value="1">
                                    </label>
                                </div>
                               
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

<!-- Custom js -->
<script src="{{ asset('files/assets/pages/data-table/js/data-table-custom.js') }}"></script>


<script>


$('body').on('click', '#submitForm', function () {
    var name = $("#class_name").val();
    var numeric = $("#numeric_value").val();
    if (name=="") {
        $("#name_err").fadeIn().html("Required");
        setTimeout(function(){ $("#name_err").fadeOut(); }, 3000);
        $("#class_name").focus();
        return false;
    }
    if (numeric=="") {
        $("#numeric_err").fadeIn().html("Required");
        setTimeout(function(){ $("#numeric_err").fadeOut(); }, 3000);
        $("#numeric_value").focus();
        return false;
    }
    else
    { 
        $('.form-material').submit();  
    }
})


</script>

@endsection