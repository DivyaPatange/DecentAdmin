@extends('admin.admin_layout.main')
@section('title', 'Section')
@section('page_title', 'Section List')
@section('breadcrumb', 'Section List')
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
<!-- Select 2 css -->
<link rel="stylesheet" href="{{ asset('files/bower_components/select2/css/select2.min.css') }}" />
<!-- Multi Select css -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/multiselect/css/multi-select.css') }}" />
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
input[type="checkbox"].switch_1{
	font-size: 20px;
	-webkit-appearance: none;
	   -moz-appearance: none;
	        appearance: none;
	width: 2.5em;
	height: 1.2em;
	background: #dd0c0c;
	border-radius: 3em;
	position: relative;
	cursor: pointer;
	outline: none;
	-webkit-transition: all .2s ease-in-out;
	transition: all .2s ease-in-out;
  }
  
  input[type="checkbox"].switch_1:checked{
	background: green;
  }
  
  input[type="checkbox"].switch_1:after{
	position: absolute;
	content: "";
	width: 1.5em;
	height: 1.5em;
	border-radius: 50%;
	background: #fff;
	-webkit-box-shadow: 0 0 .25em rgba(0,0,0,.3);
	        box-shadow: 0 0 .25em rgba(0,0,0,.3);
	-webkit-transform: scale(.7);
	        transform: scale(.7);
	left: 0;
	-webkit-transition: all .2s ease-in-out;
	transition: all .2s ease-in-out;
    top:-3px;
  }
  
  input[type="checkbox"].switch_1:checked:after{
	left: calc(100% - 1.5em);
  }
  .select2-container--open .select2-dropdown--below{
      z-index:100000;
  }
</style>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Add Section</h5>
                <a href="{{ route('admin.sections.create') }}"><button class="btn waves-effect waves-light btn-primary btn-sm float-right"><i class="icofont icofont-plus"></i>Add New</button></a>
            </div>
            <div class="card-block">
                <div class="dt-responsive table-responsive">
                    <table id="simpletable" class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Section Name</th>
                                <th>Class</th>
                                <th>Capacity</th>
                                <th>Teacher Name</th>
                                <th>Note</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th>Section Name</th>
                                <th>Class</th>
                                <th>Capacity</th>
                                <th>Teacher Name</th>
                                <th>Note</th>
                                <th>Status</th>
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
        <h3>Edit Section</h3>
        <div>
            <form method="POST" id="editForm">
                <div class="row">
                <div class="col-md-6">
                        <div class="form-group form-default">
                            <input type="text" name="section_name" class="form-control" id="section_name" value="">
                            <span class="form-bar"></span>
                            <label class="float-label">Section Name<span style="color:red;">*</span><span  style="color:red" id="name_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-default">
                            <input type="number" name="capacity" class="form-control" id="capacity" value="">
                            <span class="form-bar"></span>
                            <label class="float-label">Capacity
                                <span style="color:red;">*</span><span  style="color:red" id="capacity_err"> </span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-default">
                            <label class="">Class Name
                                <span style="color:red;">*</span><span  style="color:red" id="class_err"> </span>
                            </label>
                            <select class="js-example-basic-single col-sm-12" name="class_name" id="class_name">
                                <option value="">Select Class</option>
                                @foreach($classes as $c)
                                <option value="{{ $c->id }}">{{ $c->class_name }}</option>
                                @endforeach
                            </select>    
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-default">
                            <label class="">Teacher Name
                                <span style="color:red;">*</span><span  style="color:red" id="teacher_err"> </span>
                            </label>
                            <select class="js-example-basic-single col-sm-12" name="teacher_name" id="teacher_name">
                                <option value="">Select Teacher</option>
                                @foreach($teachers as $t)
                                <option value="{{ $t->id }}">{{ $t->name }}</option>
                                @endforeach
                            </select>    
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group form-default">
                            <textarea name="note" id="note" class="form-control"></textarea>
                            <span class="form-bar"></span>
                            <label class="float-label">Note</label>
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
<!-- Select 2 js -->
<script type="text/javascript" src="{{ asset('files/bower_components/select2/js/select2.full.min.js') }}"></script>
<!-- Multiselect js -->
<script type="text/javascript" src="{{ asset('files/bower_components/bootstrap-multiselect/js/bootstrap-multiselect.js') }}">
</script>
<script type="text/javascript" src="{{ asset('files/bower_components/multiselect/js/jquery.multi-select.js') }}"></script>
<script type="text/javascript" src="{{ asset('files/assets/js/jquery.quicksearch.js') }}"></script>
<!-- Custom js -->
<script type="text/javascript" src="{{ asset('files/assets/pages/advance-elements/select2-custom.js') }}"></script>

<script>
var SITEURL = '{{ route('admin.sections.index')}}';
function format ( d ) {
    // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px; width:100%">'+
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
            { data: 'section_name', name: 'section_name' },
            { data: 'class_id', name: 'class_id' },
            { data: 'capacity', name: 'capacity' },
            { data: 'teacher_id', name: 'capacity' },
            { data: 'note', name: 'note' },
            { data: 'status', name: 'status' },
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
        url:"{{ route('admin.get.section') }}",
        data:datastring,
        cache:false,        
        success:function(returndata)
        {
            // alert(returndata);
        if (returndata!="0") {
            $("#modal-8").addClass("md-show");
            var json = JSON.parse(returndata);
            $("#id").val(json.id);
            $("#section_name").val(json.section_name);
            $("#capacity").val(json.capacity);
            $("#class_name").val(json.class_id).select2();
            $("#teacher_name").val(json.teacher_id).select2();
            $("#note").val(json.note);
        }
        }
    });
}

function checkSubmit()
{
    var section_name = $("#section_name").val();
    var capacity = $("#capacity").val();
    var class_name = $("#class_name").val();
    var teacher_name = $("#teacher_name").val();
    var note = $("#note").val();
    var id = $("#id").val().trim();
    // alert(teacher_name);
    if (section_name=="") {
        $("#name_err").fadeIn().html("Required");
        setTimeout(function(){ $("#name_err").fadeOut(); }, 3000);
        $("#section_name").focus();
        return false;
    }
    if (capacity=="") {
        $("#capacity_err").fadeIn().html("Required");
        setTimeout(function(){ $("#capacity_err").fadeOut(); }, 3000);
        $("#capacity").focus();
        return false;
    }
    if (class_name=="") {
        $("#class_err").fadeIn().html("Required");
        setTimeout(function(){ $("#class_err").fadeOut(); }, 3000);
        $("#class_name").focus();
        return false;
    }
    if (teacher_name=="") {
        $("#teacher_err").fadeIn().html("Required");
        setTimeout(function(){ $("#teacher_err").fadeOut(); }, 3000);
        $("#teacher_name").focus();
        return false;
    }
    else
    { 
        $('#editButton').attr('disabled',true);
        var datastring="section_name="+section_name+"&capacity="+capacity+"&id="+id+"&class_name="+class_name+"&teacher_name="+teacher_name+"&note="+note;
        // alert(datastring);
        $.ajax({
            type:"POST",
            url:"{{ url('/admin/section/update') }}",
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
            url: "{{ url('admin/sections') }}"+'/'+id,
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

$('body').on('click', '.switch_1', function () {
    var id = $(this).data("id");
    // alert(id);
    if(id != ''){
        $.ajax({
            type: "get",
            url: "{{ url('admin/sections/status') }}"+'/'+id,
            success: function (data) {
                // alert(data.teacher);
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