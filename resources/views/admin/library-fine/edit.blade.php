@extends('admin.admin_layout.main')
@section('title', 'Library Fine Collection')
@section('page_title', 'Edit Library Fine Collection')
@section('breadcrumb', 'Edit Library Fine Collection')
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
                <h5>Edit Library Fine Collection</h5>
            </div>
            <div class="card-block">
                <form method="POST" id="submitForm">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group form-default">
                                <label>Student Regi. No. <span  style="color:red" id="regi_err"> </span></label>
                                <input type="text" name="regi_no" id="regi_no" class="form-control" value="{{ $libraryFine->student_regi_no }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-default">
                                <label>Collection Date <span  style="color:red" id="date_err"> </span></label>
                                <input type="date" name="collect_date" id="collect_date" class="form-control" value="{{ $libraryFine->collection_date }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-default">
                                <label>Fine Amount <span  style="color:red" id="amt_err"> </span></label>
                                <input type="number" name="fine_amt" id="fine_amt" class="form-control" value="{{ $libraryFine->fine_amt }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group form-default">
                                <label>Description <span  style="color:red" id="description_err"> </span></label>
                                <textarea class="form-control" name="description" id="description">{{ $libraryFine->description }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-default">
                                <button type="button" id="getList" class="btn btn-primary btn-sm mt-2">Update</button>
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
var SITEURL = '{{ route('admin.library-fine.update', $libraryFine->id)}}';
$('body').on('click', '#getList', function () {
    var regi_no = $("#regi_no").val();
    var collect_date = $("#collect_date").val();
    var fine_amt = $("#fine_amt").val();
    var description = $("#description").val();
    if (regi_no=="") {
        $("#regi_err").fadeIn().html("Required");
        setTimeout(function(){ $("#regi_err").fadeOut(); }, 3000);
        $("#regi_no").focus();
        return false;
    }
    if (collect_date=="") {
        $("#date_err").fadeIn().html("Required");
        setTimeout(function(){ $("#date_err").fadeOut(); }, 3000);
        $("#collect_date").focus();
        return false;
    }
    if (fine_amt=="") {
        $("#amt_err").fadeIn().html("Required");
        setTimeout(function(){ $("#amt_err").fadeOut(); }, 3000);
        $("#fine_amt").focus();
        return false;
    }
    else
    { 
        var datastring="collect_date="+collect_date+"&regi_no="+regi_no+"&fine_amt="+fine_amt+"&description="+description;
        // alert(datastring);
        $.ajax({
            type:"PUT",
            url:"{{ route('admin.library-fine.update', $libraryFine->id) }}",
            data:datastring,
            cache:false,        
            success:function(returndata)
            {
                if(returndata.success){
                document.getElementById("submitForm").reset();
                toastr.success(returndata.success);
                // $("#submitForm").load(SITEURL); 
                }
                else{
                    toastr.error(returndata.error);
                }
            
            // location.reload();
            // $("#pay").val("");
            }
        });
    }
})


</script>

@endsection