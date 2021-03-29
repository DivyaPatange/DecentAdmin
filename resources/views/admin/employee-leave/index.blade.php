@extends('admin.admin_layout.main')
@section('title', 'Employee Leave')
@section('page_title', 'Employee Leave List')
@section('breadcrumb', 'Employee Leave List')
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
                <h5>Filters</h5>
                <a href="{{ route('admin.employee-leave.create') }}"><button class="btn waves-effect waves-light btn-primary btn-sm float-right"><i class="fa fa-plus"></i>Add New</button></a>
            </div>
            <div class="card-block">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group form-default">
                            <label>Employee Name</label>
                            <select name="employee_id" class="form-control js-example-basic-single" id="employee_id">
                                <option value="">All</option>
                                @foreach($employee as $e)
                                <option value="{{ $e->id }}">{{ $e->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group form-default">
                            <label>Leave Type</label>
                            <select name="leave_type" class="form-control js-example-basic-single" id="leave_type">
                                <option value="">All</option>
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
                            <label>Leave Date </label>
                            <input type="date" name="leave_date" id="leave_date" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group form-default">
                            <label>Status <span  style="color:red" id="allot_academic_err"> </span></label>
                            <select name="type" class="form-control js-example-basic-single" id="type">
                                <option value="">All</option>
                                <option value="Pending">Pending</option>
                                <option value="Approved">Approved</option>
                                <option value="Rejected">Rejected</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group form-default">
                            <br>
                            <button type="button" id="getList" class="btn btn-primary btn-sm">Get List</button>
                        </div>
                    </div>
                </div>
                <div class="dt-responsive table-responsive">
                    <table id="simpletable" class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Employee Name</th>
                                <th>Leave Type</th>
                                <th>Date</th>
                                <th>Note</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Employee Name</th>
                                <th>Leave Type</th>
                                <th>Date</th>
                                <th>Note</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
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
var SITEURL = '{{ route('admin.employee-leave.index')}}';

$(document).ready(function() {
    fetch_data();
    function fetch_data(employee_id = '', leave_type = '', leave_date = '', type= '')
    {
        var table = $('#simpletable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: SITEURL,
            type: 'GET',
            data: {employee_id:employee_id, leave_type:leave_type, leave_date:leave_date, type:type}
            // alert(data);
        },
        columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,searchable: false},
                { data: 'employee_name', name: 'employee_name' },
                { data: 'leave_type', name: 'leave_type' },
                { data: 'leave_date', name: 'leave_date' },
                { data: 'description', name: 'description' },
                { data: 'status', name: 'status' },
                {data: 'action', name: 'action', orderable: false},
            ],
        order: [[0, 'desc']]
        });
    }
    $('#getList').click(function () {
        var employee_id = $("#employee_id").val();
        var leave_type = $("#leave_type").val();
        var leave_date = $("#leave_date").val();
        var type = $("#type").val(); 
        $('#simpletable').DataTable().destroy();
 
        fetch_data(employee_id, leave_type, leave_date, type);
    });
});

$('body').on('click', '#delete', function () {
    var id = $(this).data("id");

    if(confirm("Are You sure want to delete !")){
        $.ajax({
            type: "delete",
            url: "{{ url('admin/employee-leave') }}"+'/'+id,
            success: function (data) {
            var oTable = $('#simpletable').dataTable(); 
            oTable.fnDraw(false);
            toastr.success(data.success);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    }
});
$('body').on('click', '#confirm', function () {
    var id = $(this).data("id");

    if(confirm("Confirm Leave ?")){
        $.ajax({
            type: "get",
            url: "{{ url('admin/employee-leave/confirm') }}"+'/'+id,
            success: function (data) {
            var oTable = $('#simpletable').dataTable(); 
            oTable.fnDraw(false);
            toastr.success(data.success);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    }
});
$('body').on('click', '#reject', function () {
    var id = $(this).data("id");

    if(confirm("Reject Leave ?")){
        $.ajax({
            type: "get",
            url: "{{ url('admin/employee-leave/reject') }}"+'/'+id,
            success: function (data) {
            var oTable = $('#simpletable').dataTable(); 
            oTable.fnDraw(false);
            toastr.success(data.success);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    }
});

</script>

@endsection