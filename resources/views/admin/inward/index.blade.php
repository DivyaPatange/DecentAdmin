@extends('admin.admin_layout.main')
@section('title', 'Inward Document')
@section('page_title', 'Inward Document')
@section('breadcrumb', 'Inward Document')
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
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Add Inward Document</h5>
                <!--<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>-->
            </div>
            <div class="card-block">
                <form class="form-material" id="form-submit" method="POST">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group form-default">
                                <input type="text" name="document_name" class="form-control" id="document_name">
                                <span class="form-bar"></span>
                                <label class="float-label">Document Name<span style="color:red;">*</span><span  style="color:red" id="document_err"> </span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-default">
                                <input type="text" name="received_from" class="form-control" id="received_from">
                                <span class="form-bar"></span>
                                <label class="float-label">Received From<span style="color:red;">*</span><span  style="color:red" id="received_err"> </span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-default">
                                <input type="text" name="dept" class="form-control" id="dept">
                                <span class="form-bar"></span>
                                <label class="float-label">Department<span  style="color:red" id="dept_err"> </span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-default">
                                <input type="date" name="in_date" class="form-control" id="in_date">
                                <span class="form-bar"></span>
                                <label class="float-label">Date<span style="color:red;">*</span><span  style="color:red" id="date_err"> </span></label>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group form-default">
                                <input type="text" name="message" class="form-control" id="message">
                                <span class="form-bar"></span>
                                <label class="float-label">Message<span style="color:red;">*</span><span  style="color:red" id="message_err"> </span></label>
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
<div class="row">
    <div class="col-sm-12">
        <!-- Zero config.table start -->
        <div class="card">
            <div class="card-header">
                <h5>Inward Document List</h5>
            </div>
            <div class="card-block">
                <div class="dt-responsive table-responsive">
                    <table id="simpletable" class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Document Name</th>
                                <th>Received From</th>
                                <th>Department</th>
                                <th>Date</th>
                                <th>Message</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Document Name</th>
                                <th>Received From</th>
                                <th>Department</th>
                                <th>Date</th>
                                <th>Message</th>
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

<!-- Modal -->
<div class="md-modal md-effect-8" id="modal-8">
    <div class="md-content">
        <h3>Edit Inward Document</h3>
        <div>
            <form method="POST" id="editForm">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group form-default">
                            <input type="text" name="document_name" class="form-control" id="edit_document_name" value="">
                            <span class="form-bar"></span>
                            <label class="float-label">Document Name<span style="color:red;">*</span><span  style="color:red" id="document_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-default">
                            <input type="text" name="received_from" class="form-control" id="edit_received_from" value="">
                            <span class="form-bar"></span>
                            <label class="float-label">Received From<span style="color:red;">*</span><span  style="color:red" id="edit_received_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-default">
                            <input type="text" name="dept" class="form-control" id="edit_dept" value="">
                            <span class="form-bar"></span>
                            <label class="float-label">Department<span  style="color:red" id="edit_dept_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-default">
                            <input type="date" name="in_date" class="form-control" id="edit_in_date" value="">
                            <span class="form-bar"></span>
                            <label class="float-label">Date<span style="color:red;">*</span><span  style="color:red" id="edit_date_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group form-default">
                            <input type="text" name="message" class="form-control" id="edit_message" value="">
                            <span class="form-bar"></span>
                            <label class="float-label">Message<span style="color:red;">*</span><span  style="color:red" id="edit_message_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <input type="hidden" name="id" id="id" value="">
                        <button class="btn btn-sm waves-effect waves-light hor-grd btn-grd-primary" type="button" id="editButton" onclick="return checkSubmit()">Update</button>
                        <button type="button" class="btn btn-sm waves-effect waves-light hor-grd btn-grd-danger md-close">Close</button>
                    </div>
                </div>
            </form>
            
            
        </div>
    </div>
</div>
<div class="md-overlay"></div>
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


<script>
var SITEURL = '{{ route('admin.inward.index')}}';
$('#simpletable').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
    url: SITEURL,
    type: 'GET',
    },
    columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,searchable: false},
            { data: 'document_name', name: 'document_name' },
            { data: 'received_from', name: 'received_from' },
            { data: 'dept', name: 'dept' },
            { data: 'in_date', name: 'in_date' },
            { data: 'message', name: 'message' },
            {data: 'action', name: 'action', orderable: false},
        ],
    order: [[0, 'desc']]
});


$('body').on('click', '#submitForm', function () {
    var document_name = $("#document_name").val();
    var received_from = $("#received_from").val();
    var dept = $("#dept").val();
    var in_date = $("#in_date").val();
    var message = $("#message").val();
    if (document_name=="") {
        $("#document_err").fadeIn().html("Required");
        setTimeout(function(){ $("#document_err").fadeOut(); }, 3000);
        $("#document_name").focus();
        return false;
    }
    if (received_from=="") {
        $("#received_err").fadeIn().html("Required");
        setTimeout(function(){ $("#received_err").fadeOut(); }, 3000);
        $("#received_from").focus();
        return false;
    }
    if (in_date=="") {
        $("#date_err").fadeIn().html("Required");
        setTimeout(function(){ $("#date_err").fadeOut(); }, 3000);
        $("#in_date").focus();
        return false;
    }
    else
    { 
        var datastring="document_name="+document_name+"&received_from="+received_from+"&dept="+dept+"&in_date="+in_date+"&message="+message;
        // alert(datastring);
        $.ajax({
            type:"POST",
            url:"{{ route('admin.inward.store') }}",
            data:datastring,
            cache:false,        
            success:function(returndata)
            {
                document.getElementById("form-submit").reset();
                var oTable = $('#simpletable').dataTable(); 
                oTable.fnDraw(false);
                toastr.success(returndata.success);
            
            // location.reload();
            // $("#pay").val("");
            }
        });
    }
})

function EditModel(obj,bid)
{
    var datastring="bid="+bid;
    // alert(datastring);
    $.ajax({
        type:"POST",
        url:"{{ route('admin.get.inward') }}",
        data:datastring,
        cache:false,        
        success:function(returndata)
        {
            // alert(returndata);
        if (returndata!="0") {
            $("#modal-8").addClass("md-show");
            var json = JSON.parse(returndata);
            $("#id").val(json.id);
            $("#edit_document_name").val(json.document_name);
            $("#edit_received_from").val(json.received_from);
            $("#edit_dept").val(json.dept);
            $("#edit_in_date").val(json.in_date);
            $("#edit_message").val(json.message);
        }
        }
    });
}

function checkSubmit()
{
    var document_name = $("#edit_document_name").val();
    var received_from = $("#edit_received_from").val();
    var dept = $("#edit_dept").val();
    var in_date = $("#edit_in_date").val();
    var message = $("#edit_message").val();
    var id = $("#id").val().trim();
    if (document_name=="") {
        $("#edit_document_err").fadeIn().html("Required");
        setTimeout(function(){ $("#edit_document_err").fadeOut(); }, 3000);
        $("#edit_document_name").focus();
        return false;
    }
    if (received_from=="") {
        $("#edit_received_err").fadeIn().html("Required");
        setTimeout(function(){ $("#edit_received_err").fadeOut(); }, 3000);
        $("#edit_received_from").focus();
        return false;
    }
    if (in_date=="") {
        $("#edit_date_err").fadeIn().html("Required");
        setTimeout(function(){ $("#edit_date_err").fadeOut(); }, 3000);
        $("#edit_in_date").focus();
        return false;
    }
    else
    { 
        $('#editButton').attr('disabled',true);
        var datastring="document_name="+document_name+"&received_from="+received_from+"&id="+id+"&dept="+dept+"&in_date="+in_date+"&message="+message;
        // alert(datastring);
        $.ajax({
            type:"POST",
            url:"{{ url('/admin/inward/update') }}",
            data:datastring,
            cache:false,        
            success:function(returndata)
            {
            $('#editButton').attr('disabled',false);
            $("#modal-8").removeClass("md-show");
            var oTable = $('#simpletable').dataTable(); 
            oTable.fnDraw(false);
            toastr.success(returndata.success);
            
            // location.reload();
            // $("#pay").val("");
            }
        });
    }
}

$('body').on('click', '#delete', function () {
    var id = $(this).data("id");

    if(confirm("Are You sure want to delete !")){
        $.ajax({
            type: "delete",
            url: "{{ url('admin/inward') }}"+'/'+id,
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

$('body').on('click', '.md-close', function () {
    $("#modal-8").removeClass("md-show");
})
</script>

@endsection