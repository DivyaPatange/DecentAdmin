@extends('admin.admin_layout.main')
@section('title', 'Visitor')
@section('page_title', 'Visitor')
@section('breadcrumb', 'Visitor')
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
                <h5>Add Visitor</h5>
                <!--<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>-->
            </div>
            <div class="card-block">
                <form class="form-material" id="form-submit" method="POST">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group form-default">
                                <input type="text" name="visitor_name" class="form-control" id="visitor_name">
                                <span class="form-bar"></span>
                                <label class="float-label">Name of Visitor<span style="color:red;">*</span><span  style="color:red" id="visitor_err"> </span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-default">
                                <input type="text" name="student_name" class="form-control" id="student_name">
                                <span class="form-bar"></span>
                                <label class="float-label">Student Name
                                    <span style="color:red;">*</span><span  style="color:red" id="student_err"> </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-default">
                                <input type="text" name="temp" class="form-control" id="temp">
                                <span class="form-bar"></span>
                                <label class="float-label">Temperature<span style="color:red;">*</span><span  style="color:red" id="temp_err"> </span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-default">
                                <input type="number" name="phone_no" class="form-control" id="phone_no">
                                <span class="form-bar"></span>
                                <label class="float-label">Phone No.<span style="color:red;">*</span><span  style="color:red" id="phone_err"> </span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-default">
                                <input type="text" name="address" class="form-control" id="address">
                                <span class="form-bar"></span>
                                <label class="float-label">Address<span style="color:red;">*</span><span  style="color:red" id="address_err"> </span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-default">
                                <input type="text" name="purpose" class="form-control" id="purpose">
                                <span class="form-bar"></span>
                                <label class="float-label">Purpose<span style="color:red;">*</span><span  style="color:red" id="purpose_err"> </span></label>
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
                <h5>Visitor List</h5>
            </div>
            <div class="card-block">
                <div class="dt-responsive table-responsive">
                    <table id="simpletable" class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <th>Visitor Name</th>
                                <th>Student Name</th>
                                <th>Temperature</th>
                                <th>Phone No.</th>
                                <th>Address</th>
                                <th>Purpose</th>
                                <th>Date/Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Visitor Name</th>
                                <th>Student Name</th>
                                <th>Temperature</th>
                                <th>Phone No.</th>
                                <th>Address</th>
                                <th>Purpose</th>
                                <th>Date/Time</th>
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
        <h3>Edit Visitor</h3>
        <div>
            <form method="POST" id="editForm">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group form-default">
                            <input type="text" name="visitor_name" class="form-control" id="edit_visitor_name" value="">
                            <span class="form-bar"></span>
                            <label class="float-label">Name of Visitor<span style="color:red;">*</span><span  style="color:red" id="edit_visitor_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-default">
                            <input type="text" name="student_name" class="form-control" id="edit_student_name">
                            <span class="form-bar"></span>
                            <label class="float-label">Student Name
                                <span style="color:red;">*</span><span  style="color:red" id="edit_student_err"> </span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-default">
                            <input type="text" name="temp" class="form-control" id="edit_temp">
                            <span class="form-bar"></span>
                            <label class="float-label">Temperature<span style="color:red;">*</span><span  style="color:red" id="edit_temp_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-default">
                            <input type="number" name="phone_no" class="form-control" id="edit_phone_no">
                            <span class="form-bar"></span>
                            <label class="float-label">Phone No.<span style="color:red;">*</span><span  style="color:red" id="edit_phone_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-default">
                            <input type="text" name="address" class="form-control" id="edit_address">
                            <span class="form-bar"></span>
                            <label class="float-label">Address<span style="color:red;">*</span><span  style="color:red" id="edit_address_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-default">
                            <input type="text" name="purpose" class="form-control" id="edit_purpose">
                            <span class="form-bar"></span>
                            <label class="float-label">Purpose<span style="color:red;">*</span><span  style="color:red" id="edit_purpose_err"> </span></label>
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
var SITEURL = '{{ route('admin.visitor.index')}}';
$('#simpletable').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
    url: SITEURL,
    type: 'GET',
    },
    columns: [
            { data: 'visitor_name', name: 'visitor_name' },
            { data: 'student_name', name: 'student_name' },
            { data: 'temp', name: 'temp' },
            { data: 'phone_no', name: 'phone_no' },
            { data: 'address', name: 'address' },
            { data: 'purpose', name: 'purpose' },
            { data: 'date_time', name: 'date_time' },
            {data: 'action', name: 'action', orderable: false},
        ],
    order: [[0, 'desc']]
});


$('body').on('click', '#submitForm', function () {
    var visitor_name = $("#visitor_name").val();
    var student_name = $("#student_name").val();
    var temp = $("#temp").val();
    var phone_no = $("#phone_no").val();
    var address = $("#address").val();
    var purpose = $("#purpose").val();
    if (visitor_name=="") {
        $("#visitor_err").fadeIn().html("Required");
        setTimeout(function(){ $("#visitor_err").fadeOut(); }, 3000);
        $("#visitor_name").focus();
        return false;
    }
    if (phone_no=="") {
        $("#phone_err").fadeIn().html("Required");
        setTimeout(function(){ $("#phone_err").fadeOut(); }, 3000);
        $("#phone_no").focus();
        return false;
    }
    if (address=="") {
        $("#address_err").fadeIn().html("Required");
        setTimeout(function(){ $("#address_err").fadeOut(); }, 3000);
        $("#address").focus();
        return false;
    }
    if (purpose=="") {
        $("#purpose_err").fadeIn().html("Required");
        setTimeout(function(){ $("#purpose_err").fadeOut(); }, 3000);
        $("#purpose").focus();
        return false;
    }
    else
    { 
        var datastring="visitor_name="+visitor_name+"&student_name="+student_name+"&temp="+temp+"&phone_no="+phone_no+"&address="+address+"&purpose="+purpose;
        // alert(datastring);
        $.ajax({
            type:"POST",
            url:"{{ route('admin.visitor.store') }}",
            data:datastring,
            cache:false,        
            success:function(returndata)
            {
                console.log(returndata);
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
        url:"{{ route('admin.get.visitor') }}",
        data:datastring,
        cache:false,        
        success:function(returndata)
        {
            // alert(returndata);
        if (returndata!="0") {
            $("#modal-8").addClass("md-show");
            var json = JSON.parse(returndata);
            $("#id").val(json.id);
            $("#edit_visitor_name").val(json.visitor_name);
            $("#edit_student_name").val(json.student_name);
            $("#edit_temp").val(json.temp);
            $("#edit_phone_no").val(json.phone_no);
            $("#edit_address").val(json.address);
            $("#edit_purpose").val(json.purpose);
        }
        }
    });
}

function checkSubmit()
{
    var visitor_name = $("#edit_visitor_name").val();
    var student_name = $("#edit_student_name").val();
    var temp = $("#edit_temp").val();
    var phone_no = $("#edit_phone_no").val();
    var address = $("#edit_address").val();
    var purpose = $("#edit_purpose").val();
    var id = $("#id").val().trim();
    if (visitor_name=="") {
        $("#edit_visitor_err").fadeIn().html("Required");
        setTimeout(function(){ $("#edit_visitor_err").fadeOut(); }, 3000);
        $("#edit_visitor_name").focus();
        return false;
    }
    if (phone_no=="") {
        $("#edit_phone_err").fadeIn().html("Required");
        setTimeout(function(){ $("#edit_phone_err").fadeOut(); }, 3000);
        $("#edit_phone_no").focus();
        return false;
    }
    if (address=="") {
        $("#edit_address_err").fadeIn().html("Required");
        setTimeout(function(){ $("#edit_address_err").fadeOut(); }, 3000);
        $("#edit_address").focus();
        return false;
    }
    if (purpose=="") {
        $("#edit_purpose_err").fadeIn().html("Required");
        setTimeout(function(){ $("#edit_purpose_err").fadeOut(); }, 3000);
        $("#edit_purpose").focus();
        return false;
    }
    else
    { 
        $('#editButton').attr('disabled',true);
        var datastring="visitor_name="+visitor_name+"&student_name="+student_name+"&temp="+temp+"&phone_no="+phone_no+"&address="+address+"&purpose="+purpose+"&id="+id;
        // alert(datastring);
        $.ajax({
            type:"POST",
            url:"{{ url('/admin/visitor/update') }}",
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
            url: "{{ url('admin/visitor') }}"+'/'+id,
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