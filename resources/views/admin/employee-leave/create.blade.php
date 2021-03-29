@extends('admin.admin_layout.main')
@section('title', 'Employee Leave')
@section('page_title', 'Add Employee Leave')
@section('breadcrumb', 'Add Employee Leave')
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
                <h5>Add Employee Leave</h5>
            </div>
            <div class="card-block">
                <form method="POST" id="submitForm">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group form-default">
                                <label>Employee Name <span  style="color:red" id="employee_err"> </span></label>
                                <select name="employee_name" class="form-control js-example-basic-single" id="employee_name">
                                    <option value="">Pick a Employee</option>
                                    @foreach($employee as $e)
                                    <option value="{{ $e->id }}">{{ $e->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group form-default">
                                <label>Leave Type <span  style="color:red" id="type_err"> </span></label>
                                <select name="leave_type" class="form-control js-example-basic-single" id="leave_type">
                                    <option value="">Pick a Type</option>
                                    <option value="Casual Leave">Casual Leave</option>
                                    <option value="Sick Leave">Sick Leave</option>
                                    <option value="Undefined Leave">Undefined Leave</option>
                                    <option value="Special Leave">Special Leave</option>
                                    <option value="Maternity Leave">Maternity Leave</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group form-default">
                                <label>Leave Date Start <span  style="color:red" id="start_date_err"> </span></label>
                                <input type="date" name="start_date" id="start_date" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group form-default">
                                <label>Leave End Start <span  style="color:red" id="end_date_err"> </span></label>
                                <input type="date" name="end_date" id="end_date" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-default">
                                <label>Description <span  style="color:red" id="description_err"> </span></label>
                                <textarea class="form-control" name="description" id="description"></textarea>
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
    var employee_name = $("#employee_name").val();
    var leave_type = $("#leave_type").val();
    var start_date = $("#start_date").val();
    var end_date = $("#end_date").val();
    var description = $("#description").val();
    if (employee_name=="") {
        $("#employee_err").fadeIn().html("Required");
        setTimeout(function(){ $("#employee_err").fadeOut(); }, 3000);
        $("#employee_name").focus();
        return false;
    }
    if (leave_type=="") {
        $("#type_err").fadeIn().html("Required");
        setTimeout(function(){ $("#type_err").fadeOut(); }, 3000);
        $("#leave_type").focus();
        return false;
    }
    if (start_date=="") {
        $("#start_date_err").fadeIn().html("Required");
        setTimeout(function(){ $("#start_date_err").fadeOut(); }, 3000);
        $("#start_date").focus();
        return false;
    }
    else
    { 
        var datastring="employee_name="+employee_name+"&leave_type="+leave_type+"&start_date="+start_date+"&end_date="+end_date+"&description="+description;
        // alert(datastring);
        $.ajax({
            type:"POST",
            url:"{{ route('admin.employee-leave.store') }}",
            data:datastring,
            cache:false,        
            success:function(returndata)
            {
                // alert(returndata);
                if(returndata.success){
                document.getElementById("submitForm").reset();
                toastr.success(returndata.success);
                }
                else{
                    toastr.error(returndata.error);
                }
            
            }
        });
    }
})


</script>

@endsection