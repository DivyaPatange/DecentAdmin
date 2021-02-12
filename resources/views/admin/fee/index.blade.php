@extends('admin.admin_layout.main')
@section('title', 'Fee')
@section('page_title', 'Fee')
@section('breadcrumb', 'Fee')
@section('customcss')

<!-- Data Table Css -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
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
                <h5>Add Fee</h5>
                <!--<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>-->
            </div>
            <div class="card-block">
                <form class="form-material" id="form-submit" method="POST">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group form-default">
                                <select name="fee_head" class="form-control" id="fee_head">
                                    <option value="">-Select Fee Head-</option>
                                    @foreach($feeHead as $f)
                                    <option value="{{ $f->id }}">{{ $f->fee_head }}</option>
                                    @endforeach
                                </select>
                                <span class="form-bar"></span>
                                <label class="float-label">Fee Head<span style="color:red;">*</span><span  style="color:red" id="fee_head_err"> </span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-default">
                                <select name="classes" class="form-control" id="classes">
                                    <option value="">-Select Class-</option>
                                    @foreach($standard as $c)
                                    <option value="{{ $c->standard }}">{{ $c->standard }}</option>
                                    @endforeach
                                </select>
                                <span class="form-bar"></span>
                                <label class="float-label">Class<span style="color:red;">*</span><span  style="color:red" id="classes_err"> </span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-default">
                                <select name="academic_year" class="form-control" id="academic_year">
                                    <option value="">-Select Academic Session-</option>
                                    @foreach($academicYear as $a)
                                    <option value="{{ $a->id }}">({{ $a->from_academic_year }}) - ({{ $a->to_academic_year }})</option>
                                    @endforeach
                                </select>
                                <span class="form-bar"></span>
                                <label class="float-label">Academic Session<span style="color:red;">*</span><span  style="color:red" id="academic_year_err"> </span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-default">
                                <input type="number" name="amount" class="form-control" id="amount">
                                <span class="form-bar"></span>
                                <label class="float-label">Amount<span style="color:red;">*</span><span  style="color:red" id="amount_err"> </span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-default">
                                <input type="text" name="description" class="form-control" id="description">
                                <span class="form-bar"></span>
                                <label class="float-label">Description<span style="color:red;">*</span><span  style="color:red" id="description_err"> </span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-default">
                                <select name="status" class="form-control" id="status">
                                    <option value="">-Select Status-</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                <span class="form-bar"></span>
                                <label class="float-label">Status<span style="color:red;">*</span><span  style="color:red" id="status_err"> </span></label>
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
                <h5>Fee List</h5>
            </div>
            <div class="card-block">
                <div class="dt-responsive table-responsive">
                    <table id="e-product-list" class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Fee Head</th>
                                <th>Class</th>
                                <th>Academic Session</th>
                                <th>Amount</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Fee Head</th>
                                <th>Class</th>
                                <th>Academic Session</th>
                                <th>Amount</th>
                                <th>Description</th>
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

<!-- Modal -->
<div class="md-modal md-effect-8" id="modal-8">
    <div class="md-content">
        <h3>Edit Fee</h3>
        <div>
            <form method="POST" id="editForm">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group form-default">
                            <select name="fee_head" class="form-control" id="edit_fee_head">
                                <option value="">-Select Fee Head-</option>
                                @foreach($feeHead as $f)
                                <option value="{{ $f->id }}">{{ $f->fee_head }}</option>
                                @endforeach
                            </select>
                            <span class="form-bar"></span>
                            <label class="float-label">Fee Head<span style="color:red;">*</span><span  style="color:red" id="edit_fee_head_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-default">
                            <select name="classes" class="form-control" id="edit_class">
                                <option value="">-Select Class-</option>
                                @foreach($standard as $c)
                                <option value="{{ $c->standard }}">{{ $c->standard }}</option>
                                @endforeach
                            </select>
                            <span class="form-bar"></span>
                            <label class="float-label">Class<span style="color:red;">*</span><span  style="color:red" id="edit_class_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-default">
                            <select name="academic_year" class="form-control" id="edit_academic_year">
                                <option value="">-Select Academic Session-</option>
                                @foreach($academicYear as $ay)
                                <option value="{{ $ay->id }}">{{ $ay->from_academic_year }} - {{ $ay->to_academic_year }}</option>
                                @endforeach
                            </select>
                            <span class="form-bar"></span>
                            <label class="float-label">Academic Session<span style="color:red;">*</span><span  style="color:red" id="edit_ay_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-default">
                            <input type="number" name="amount" class="form-control" id="edit_amount">
                            <span class="form-bar"></span>
                            <label class="float-label">Amount<span style="color:red;">*</span><span  style="color:red" id="edit_amount_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-default">
                            <input type="text" name="description" class="form-control" id="edit_description">
                            <span class="form-bar"></span>
                            <label class="float-label">Description<span style="color:red;">*</span><span  style="color:red" id="edit_description_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-default">
                            <select name="status" class="form-control" id="edit_status">
                                <option value="">-Select Status-</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            <span class="form-bar"></span>
                            <label class="float-label">Status<span style="color:red;">*</span><span  style="color:red" id="edit_status_err"> </span></label>
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

<!-- datatable js -->
<script src="{{ asset('files/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('files/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('files/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('files/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
<!-- product list js -->
<!-- <script type="text/javascript" src="{{ asset('files/assets/pages/product-list/product-list.js') }}"></script> -->

<!-- Custom js -->
<!-- <script src="{{ asset('files/assets/pages/data-table/js/data-table-custom.js') }}"></script> -->


<script>
var SITEURL = '{{ route('admin.fee.index')}}';
$('#e-product-list').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
    url: SITEURL,
    type: 'GET',
    },
    columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,searchable: false},
            { data: 'fee_head_id', name: 'fee_head_id' },
            { data: 'class_id', name: 'class_id' },
            { data: 'academic_id', name: 'academic_id' },
            { data: 'amount', name: 'amount' },
            { data: 'description', name: 'description' },
            { data: 'status', name: 'status' },
            {data: 'action', name: 'action', orderable: false},
        ],
    order: [[0, 'desc']]
});


$('body').on('click', '#submitForm', function () {
    var fee_head = $("#fee_head").val();
    var classes = $("#classes").val();
    var academic_year = $("#academic_year").val();
    var amount = $("#amount").val();
    var description = $("#description").val();
    var status = $("#status").val();
    if (fee_head=="") {
        $("#fee_head_err").fadeIn().html("Required");
        setTimeout(function(){ $("#fee_head_err").fadeOut(); }, 3000);
        $("#fee_head").focus();
        return false;
    }
    if (classes=="") {
        $("#classes_err").fadeIn().html("Required");
        setTimeout(function(){ $("#classes_err").fadeOut(); }, 3000);
        $("#classes").focus();
        return false;
    }
    if (academic_year=="") {
        $("#academic_year_err").fadeIn().html("Required");
        setTimeout(function(){ $("#academic_year_err").fadeOut(); }, 3000);
        $("#academic_year").focus();
        return false;
    }
    if (amount=="") {
        $("#amount_err").fadeIn().html("Required");
        setTimeout(function(){ $("#amount_err").fadeOut(); }, 3000);
        $("#amount").focus();
        return false;
    }
    if (description=="") {
        $("#description_err").fadeIn().html("Required");
        setTimeout(function(){ $("#description_err").fadeOut(); }, 3000);
        $("#description").focus();
        return false;
    }
    if (status=="") {
        $("#status_err").fadeIn().html("Required");
        setTimeout(function(){ $("#status_err").fadeOut(); }, 3000);
        $("#status").focus();
        return false;
    }
    else
    { 
        var datastring="fee_head="+fee_head+"&status="+status+"&description="+description+"&classes="+classes+"&academic_year="+academic_year+"&amount="+amount;
        // alert(datastring);
        $.ajax({
            type:"POST",
            url:"{{ route('admin.fee.store') }}",
            data:datastring,
            cache:false,        
            success:function(returndata)
            {
                document.getElementById("form-submit").reset();
                var oTable = $('#e-product-list').dataTable(); 
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
        url:"{{ route('admin.get.fee') }}",
        data:datastring,
        cache:false,        
        success:function(returndata)
        {
            // alert(returndata);
        if (returndata!="0") {
            $("#modal-8").addClass("md-show");
            var json = JSON.parse(returndata);
            $("#id").val(json.id);
            $("#edit_fee_head").val(json.fee_head_id);
            $("#edit_class").val(json.class_id);
            $("#edit_academic_year").val(json.academic_id);
            $("#edit_amount").val(json.amount);
            $("#edit_description").val(json.description);
            $("#edit_status").val(json.status);
        }
        }
    });
}

function checkSubmit()
{
    var fee_head = $("#edit_fee_head").val();
    var classes = $("#edit_class").val();
    var academic_year = $("#edit_academic_year").val();
    var amount = $("#edit_amount").val();
    var description = $("#edit_description").val();
    var status = $("#edit_status").val();
    var id = $("#id").val().trim();
    // alert(classes);
    if(fee_head=="") {
        $("#edit_fee_head_err").fadeIn().html("Required");
        setTimeout(function(){ $("#edit_fee_head_err").fadeOut(); }, 3000);
        $("#edit_fee_head").focus();
        return false;
    }
    if(classes=="") {
        $("#edit_class_err").fadeIn().html("Required");
        setTimeout(function(){ $("#edit_class_err").fadeOut(); }, 3000);
        $("#edit_class").focus();
        return false;
    }
    if(academic_year=="") {
        $("#edit_ay_err").fadeIn().html("Required");
        setTimeout(function(){ $("#edit_ay_err").fadeOut(); }, 3000);
        $("#edit_academic_year").focus();
        return false;
    }
    if(amount=="") {
        $("#edit_amount_err").fadeIn().html("Required");
        setTimeout(function(){ $("#edit_amount_err").fadeOut(); }, 3000);
        $("#edit_amount").focus();
        return false;
    }
    if(description=="") {
        $("#edit_description").fadeIn().html("Required");
        setTimeout(function(){ $("#edit_description_err").fadeOut(); }, 3000);
        $("#edit_description").focus();
        return false;
    }
    if(status=="") {
        $("#edit_status_err").fadeIn().html("Required");
        setTimeout(function(){ $("#edit_status_err").fadeOut(); }, 3000);
        $("#edit_status").focus();
        return false;
    }
    else
    { 
        $('#editButton').attr('disabled',true);
        var datastring="fee_head="+fee_head+"&status="+status+"&id="+id+"&description="+description+"&classes="+classes+"&academic_year="+academic_year+"&amount="+amount;
        alert(datastring);
        $.ajax({
            type:"POST",
            url:"{{ url('/admin/fee/update') }}",
            data:datastring,
            cache:false,        
            success:function(returndata)
            {
            $('#editButton').attr('disabled',false);
            $("#modal-8").removeClass("md-show");
            var oTable = $('#e-product-list').dataTable(); 
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
            url: "{{ url('admin/fee') }}"+'/'+id,
            success: function (data) {
            var oTable = $('#e-product-list').dataTable(); 
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