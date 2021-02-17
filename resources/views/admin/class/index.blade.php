@extends('admin.admin_layout.main')
@section('title', 'Class')
@section('page_title', 'Class')
@section('breadcrumb', 'Class')
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
                <h5>Add Class</h5>
                <!--<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>-->
            </div>
            <div class="card-block">
                <form class="form-material" id="form-submit" method="POST">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group form-default">
                                <select name="standard" class="form-control" id="standard">
                                    <option value="">-Select Standard-</option>
                                    @foreach($standards as $s)
                                    <option value="{{ $s->standard }}">{{ $s->standard }}</option>
                                    @endforeach
                                </select>
                                <span class="form-bar"></span>
                                <label class="float-label">Standard<span style="color:red;">*</span><span  style="color:red" id="standard_err"> </span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-default">
                                <select name="section" class="form-control" id="section">
                                    <option value="">-Select Section-</option>
                                    @foreach($sections as $sec)
                                    <option value="{{ $sec->section }}">{{ $sec->section }}</option>
                                    @endforeach
                                </select>
                                <span class="form-bar"></span>
                                <label class="float-label">Section
                                    <!-- <span style="color:red;">*</span><span  style="color:red" id="section_err"> </span> -->
                                </label>
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
                <h5>Class List</h5>
            </div>
            <div class="card-block">
                <div class="dt-responsive table-responsive">
                    <table id="simpletable" class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Class</th>
                                <th>Standard</th>
                                <th>Section</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Class</th>
                                <th>Standard</th>
                                <th>Section</th>
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
        <h3>Edit Class</h3>
        <div>
            <form method="POST" id="editForm">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-default">
                            <select name="standard" class="form-control" id="edit_standard">
                                <option value="">-Select Standard-</option>
                                @foreach($standards as $s)
                                <option value="{{ $s->standard }}">{{ $s->standard }}</option>
                                @endforeach
                            </select>
                            <span class="form-bar"></span>
                            <label class="float-label">Standard<span style="color:red;">*</span><span  style="color:red" id="edit_standard_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group form-default">
                            <select name="section" class="form-control" id="edit_section">
                                <option value="">-Select Section-</option>
                                @foreach($sections as $sec)
                                <option value="{{ $sec->section }}">{{ $sec->section }}</option>
                                @endforeach
                            </select>
                            <span class="form-bar"></span>
                            <label class="float-label">Section 
                                <!-- <span style="color:red;">*</span><span  style="color:red" id="edit_section_err"> </span> -->
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12">
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
var SITEURL = '{{ route('admin.class.index')}}';
$('#simpletable').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
    url: SITEURL,
    type: 'GET',
    },
    columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,searchable: false},
            { data: 'class', name: 'class' },
            { data: 'standard', name: 'standard' },
            { data: 'section', name: 'section' },
            { data: 'status', name: 'status' },
            {data: 'action', name: 'action', orderable: false},
        ],
    order: [[0, 'desc']]
});


$('body').on('click', '#submitForm', function () {
    var standard = $("#standard").val();
    var section = $("#section").val();
    var status = $("#status").val();
    if (standard=="") {
        $("#standard_err").fadeIn().html("Required");
        setTimeout(function(){ $("#standard_err").fadeOut(); }, 3000);
        $("#standard").focus();
        return false;
    }
    // if (section=="") {
    //     $("#section_err").fadeIn().html("Required");
    //     setTimeout(function(){ $("#section_err").fadeOut(); }, 3000);
    //     $("#section").focus();
    //     return false;
    // }
    if (status=="") {
        $("#status_err").fadeIn().html("Required");
        setTimeout(function(){ $("#status_err").fadeOut(); }, 3000);
        $("#status").focus();
        return false;
    }
    else
    { 
        var datastring="standard="+standard+"&status="+status+"&section="+section;
        // alert(datastring);
        $.ajax({
            type:"POST",
            url:"{{ route('admin.class.store') }}",
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
        url:"{{ route('admin.get.class') }}",
        data:datastring,
        cache:false,        
        success:function(returndata)
        {
            // alert(returndata);
        if (returndata!="0") {
            $("#modal-8").addClass("md-show");
            var json = JSON.parse(returndata);
            $("#id").val(json.id);
            $("#edit_standard").val(json.standard);
            $("#edit_section").val(json.section);
            $("#edit_status").val(json.status);
        }
        }
    });
}

function checkSubmit()
{
    var standard = $("#edit_standard").val();
    var section = $("#edit_section").val();
    var status = $("#edit_status").val();
    var id = $("#id").val().trim();
    if (standard=="") {
        $("#edit_standard_err").fadeIn().html("Required");
        setTimeout(function(){ $("#edit_standard_err").fadeOut(); }, 3000);
        $("#edit_standard").focus();
        return false;
    }
    // if (section=="") {
    //     $("#edit_section_err").fadeIn().html("Required");
    //     setTimeout(function(){ $("#edit_section_err").fadeOut(); }, 3000);
    //     $("#edit_section").focus();
    //     return false;
    // }
    if (status=="") {
        $("#edit_status_err").fadeIn().html("Required");
        setTimeout(function(){ $("#edit_status_err").fadeOut(); }, 3000);
        $("#edit_status").focus();
        return false;
    }
    else
    { 
        $('#editButton').attr('disabled',true);
        var datastring="standard="+standard+"&status="+status+"&id="+id+"&section="+section;
        // alert(datastring);
        $.ajax({
            type:"POST",
            url:"{{ url('/admin/class/update') }}",
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
            url: "{{ url('admin/class') }}"+'/'+id,
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