@extends('admin.admin_layout.main')
@section('title', 'Library Book')
@section('page_title', 'Add Library Book')
@section('breadcrumb', 'Add Library Book')
@section('customcss')

<!-- Data Table Css -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/pages/data-table/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<!-- ico font -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/icon/icofont/css/icofont.css') }}">
<!-- animation nifty modal window effects css -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/css/component.css') }}">
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
td.details-control:before {
    font-family: 'FontAwesome';
    /*content: '\f105';*/
    display: block;
    text-align: center;
    font-size: 20px;
}
tr.shown td.details-control:before{
   font-family: 'FontAwesome';
    /*content: '\f107';*/
    display: block;
    text-align: center;
    font-size: 20px;
}
</style>
@endsection
@section('content')
<div class="row">
    <div class="col-sm-12">
        <!-- Zero config.table start -->
        <div class="card">
            <div class="card-header">
                <h5>Add Library Book</h5>
            </div>
            <div class="card-block">
                <form method="POST" id="submitForm">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group form-default">
                                <label>Code/ISBN No. <span  style="color:red" id="code_err"> </span></label>
                                <input type="text" name="code" id="code" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-default">
                                <label>Book Name <span  style="color:red" id="book_err"> </span></label>
                                <input type="text" name="book_name" id="book_name" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-default">
                                <label>Author <span  style="color:red" id="author_err"> </span></label>
                                <input type="text" name="author_name" id="author_name" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group form-default">
                                <label>Type <span  style="color:red" id="type_err"> </span></label>
                                <select name="type" class="form-control js-example-basic-single" id="type">
                                    <option value="">Pick a Type</option>
                                    <option value="Academic">Academic</option>
                                    <option value="Novel">Novel</option>
                                    <option value="Magazine">Magazine</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group form-default">
                                <label>Class <span  style="color:red" id="class_err"> </span></label>
                                <select name="class_id" class="form-control js-example-basic-single" id="class_id">
                                    <option value="">Pick a Class</option>
                                    @foreach($classes as $c)
                                    <option value="{{ $c->id }}">{{ $c->class_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group form-default">
                                <label>Quantity <span  style="color:red" id="quantity_err"> </span></label>
                                <input type="number" class="form-control" name="quantity" id="quantity">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group form-default">
                                <label>Rack No. <span  style="color:red" id="rack_err"> </span></label>
                                <input type="text" class="form-control" name="rack_no" id="rack_no">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-default">
                                <button type="button" id="getList" class="btn btn-primary btn-sm mt-2">Add New</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Zero config.table end -->
    </div>
</div>

@endsection
@section('customjs')

<!-- data-table js -->
<script src="{{ asset('files/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('files/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('files/assets/pages/data-table/js/jszip.min.js') }}"></script>
<script src="{{ asset('files/assets/pages/data-table/js/pdfmake.min.js') }}"></script>
<script src="{{ asset('files/assets/pages/data-table/js/vfs_fonts.js') }}"></script>
<script src="{{ asset('files/bower_components/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('files/bower_components/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('files/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('files/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('files/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
<!-- Custom js -->
<script src="{{ asset('files/assets/pages/data-table/js/data-table-custom.js') }}"></script>
<!-- Select 2 js -->
<script type="text/javascript" src="{{ asset('files/bower_components/select2/js/select2.full.min.js') }}"></script>
<!-- Custom js -->
<script type="text/javascript" src="{{ asset('files/assets/pages/advance-elements/select2-custom.js') }}"></script>

<script>
$('body').on('click', '#getList', function () {
    var code = $("#code").val();
    var book_name = $("#book_name").val();
    var author_name = $("#author_name").val();
    var type = $("#type").val();
    var class_id = $("#class_id").val();
    var quantity = $("#quantity").val();
    var rack_no = $("#rack_no").val();
    if (code=="") {
        $("#code_err").fadeIn().html("Required");
        setTimeout(function(){ $("#code_err").fadeOut(); }, 3000);
        $("#code").focus();
        return false;
    }
    if (book_name=="") {
        $("#book_err").fadeIn().html("Required");
        setTimeout(function(){ $("#book_err").fadeOut(); }, 3000);
        $("#book_name").focus();
        return false;
    }
    if (author_name=="") {
        $("#author_err").fadeIn().html("Required");
        setTimeout(function(){ $("#author_err").fadeOut(); }, 3000);
        $("#author_name").focus();
        return false;
    }
    if (type=="") {
        $("#type_err").fadeIn().html("Required");
        setTimeout(function(){ $("#type_err").fadeOut(); }, 3000);
        $("#type").focus();
        return false;
    }
    if (class_id=="") {
        $("#class_err").fadeIn().html("Required");
        setTimeout(function(){ $("#class_err").fadeOut(); }, 3000);
        $("#class_id").focus();
        return false;
    }
    if (quantity=="") {
        $("#quantity_err").fadeIn().html("Required");
        setTimeout(function(){ $("#quantity_err").fadeOut(); }, 3000);
        $("#quantity").focus();
        return false;
    }
    if (rack_no=="") {
        $("#rack_err").fadeIn().html("Required");
        setTimeout(function(){ $("#rack_err").fadeOut(); }, 3000);
        $("#rack_no").focus();
        return false;
    }
    else
    { 
        var datastring="code="+code+"&book_name="+book_name+"&author_name="+author_name+"&type="+type+"&class_id="+class_id+"&quantity="+quantity+"&rack_no="+rack_no;
        // alert(datastring);
        $.ajax({
            type:"POST",
            url:"{{ route('admin.books.store') }}",
            data:datastring,
            cache:false,        
            success:function(returndata)
            {
                document.getElementById("submitForm").reset();
                toastr.success(returndata.success);
            
            // location.reload();
            // $("#pay").val("");
            }
        });
    }
})


</script>

@endsection