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
<style>
td.details-control {
background: url('{{ asset('plus1.png') }}') no-repeat center center;
cursor: pointer;
background-size:25px;
}
tr.shown td.details-control {
    background: url('{{ asset('minus-flat.png') }}') no-repeat center center;
    background-size:25px;
}
</style>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Class List</h5>
                <a href="{{ route('admin.class.create') }}"><button class="btn waves-effect waves-light btn-primary btn-sm float-right"><i class="icofont icofont-plus"></i>Add New</button></a>
            </div>
            <div class="card-block">
                <div class="dt-responsive table-responsive">
                    <table id="simpletable" class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Class Name</th>
                                <th>Numeric Value</th>
                                <th>Is Open For Admission</th>
                                <th>Note</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th>Class Name</th>
                                <th>Numeric Value</th>
                                <th>Is Open For Admission</th>
                                <th>Note</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="md-modal md-effect-8" id="modal-8">
    <div class="md-content">
        <h3>Edit Class</h3>
        <div>
            <form method="POST" id="editForm">
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
                                    <input type="checkbox" name="adm" id="adm" class="form-check-input" value="1">
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
                    <div class="col-md-6">
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
function format ( d ) {
    // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px; width:100%">'+
        '<tr>'+
            '<td style="text-align:center">Status</td>'+
            '<td style="text-align:center">'+d.status+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td style="text-align:center">Action</td>'+
            '<td style="text-align:center">'+d.action+'</td>'+
        '</tr>'+
    '</table>';
}
$(document).ready(function() {
    var table = $('#simpletable').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
    url: SITEURL,
    type: 'GET',
    },
    columns: [
            {
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ''
            },
            { data: 'class_name', name: 'class_name' },
            { data: 'numeric_value', name: 'numeric_value' },
            { data: 'is_open_for_adm', name: 'is_open_for_adm' },
            { data: 'note', name: 'note' },
        ],
    order: [[0, 'desc']]
    });
    $('#simpletable tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    } );
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
            $("#class_name").val(json.class_name);
            $("#numeric_value").val(json.numeric_value);
            if(json.is_open_for_adm == 1)
            {
                $("#adm").attr("checked","");
            }
            $("#note").val(json.note);
            $("#status").val(json.status);
        }
        }
    });
}

function checkSubmit()
{
    var name = $("#class_name").val();
    var numeric = $("#numeric_value").val();
    var admission = $("input[name='adm']:checked").val();
    if(admission == null)
    {
        admission = 0;
    }
    var note = $("#note").val();
    var id = $("#id").val().trim();
    var status = $("#status").val();
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
    // if (section=="") {
    //     $("#edit_section_err").fadeIn().html("Required");
    //     setTimeout(function(){ $("#edit_section_err").fadeOut(); }, 3000);
    //     $("#edit_section").focus();
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
        $('#editButton').attr('disabled',true);
        var datastring="name="+name+"&status="+status+"&id="+id+"&numeric="+numeric+"&admission="+admission+"&note="+note;
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