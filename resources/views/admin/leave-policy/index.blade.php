@extends('admin.admin_layout.main')
@section('title', 'HR Policy')
@section('page_title', 'Policy Settings')
@section('breadcrumb', 'Policy Settings')
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
                <h5>Leave Policy</h5>
            </div>
            <div class="card-block">
                <form method="POST" id="submitForm">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group form-default">
                                <label>Total Casual Leave <span  style="color:red" id="casual_err"> </span></label>
                                <input type="number" name="casual_leave" id="casual_leave" class="form-control" value="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group form-default">
                                <label>Total Sick Leave <span  style="color:red" id="sick_err"> </span></label>
                                <input type="number" name="sick_leave" id="sick_leave" class="form-control" value="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group form-default">
                                <label>Total Maternity Leave <span  style="color:red" id="maternity_err"> </span></label>
                                <input type="number" name="maternity_leave" id="maternity_leave" class="form-control" value="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group form-default">
                                <label>Total Special Leave <span  style="color:red" id="special_err"> </span></label>
                                <input type="number" name="special_leave" id="special_leave" class="form-control" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-default">
                                <input type="hidden" name="id" id="id" value="1">
                                <button type="button" id="getList" class="btn btn-primary btn-sm mt-2">Save</button>
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
var SITEURL = "{{ route('admin.get.leave-policy') }}";
$('body').on('click', '#getList', function () {
    var casual_leave = $("#casual_leave").val();
    var sick_leave = $("#sick_leave").val();
    var maternity_leave = $("#maternity_leave").val();
    var special_leave = $("#special_leave").val();
    var id = $("#id").val();
    if (casual_leave=="") {
        $("#casual_err").fadeIn().html("Required");
        setTimeout(function(){ $("#casual_err").fadeOut(); }, 3000);
        $("#casual_leave").focus();
        return false;
    }
    if (sick_leave=="") {
        $("#sick_err").fadeIn().html("Required");
        setTimeout(function(){ $("#sick_err").fadeOut(); }, 3000);
        $("#sick_leave").focus();
        return false;
    }
    if (maternity_leave=="") {
        $("#maternity_err").fadeIn().html("Required");
        setTimeout(function(){ $("#maternity_err").fadeOut(); }, 3000);
        $("#maternity_leave").focus();
        return false;
    }
    if (special_leave=="") {
        $("#special_err").fadeIn().html("Required");
        setTimeout(function(){ $("#special_err").fadeOut(); }, 3000);
        $("#special_leave").focus();
        return false;
    }
    else
    { 
        var datastring="casual_leave="+casual_leave+"&sick_leave="+sick_leave+"&maternity_leave="+maternity_leave+"&special_leave="+special_leave+"&id="+id;
        // alert(datastring);
        $.ajax({
            type:"POST",
            url:"{{ route('admin.leave-policy.store') }}",
            data:datastring,
            cache:false,        
            success:function(returndata)
            {
                if(returndata.success){
                // document.getElementById("submitForm").reset();
                // $("#submitForm").load(SITEURL);
                toastr.success(returndata.success);
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
$(window).on("load", function () {
    var id = $("#id").val();
    var datastring="bid="+id;
    // alert(datastring);
    $.ajax({
        type:"POST",
        url:"{{ route('admin.get.leave-policy') }}",
        data:datastring,
        cache:false,        
        success:function(returndata)
        {
            // alert(returndata);
        if (returndata!="0") {
            var json = JSON.parse(returndata);
            $("#casual_leave").val(json.casual_leave);
            $("#sick_leave").val(json.sick_leave);
            $("#maternity_leave").val(json.maternity_leave);
            $("#special_leave").val(json.special_leave);
        }
        }
    });
});

</script>

@endsection