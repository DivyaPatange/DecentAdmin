@extends('admin.admin_layout.main')
@section('title', 'Student')
@section('page_title', 'Student List')
@section('breadcrumb', 'Student List')
@section('customcss')

<!-- Data Table Css -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/pages/data-table/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">
<!-- Select 2 css -->
<link rel="stylesheet" href="{{ asset('files/bower_components/select2/css/select2.min.css') }}" />
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<!-- ico font -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/icon/icofont/css/icofont.css') }}">
<!-- animation nifty modal window effects css -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/css/component.css') }}">
<style>
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
.switch_box{
	display: -webkit-box;
	display: -ms-flexbox;
	display: flex;
	/* max-width: 200px; */
	/* min-width: 200px; */
	/* height: 200px; */
	-webkit-box-pack: center;
	    -ms-flex-pack: center;
	        justify-content: center;
	-webkit-box-align: center;
	    -ms-flex-align: center;
	        align-items: center;
	-webkit-box-flex: 1;
	    -ms-flex: 1;
	        flex: 1;
}

/* Switch 1 Specific Styles Start */

.box_1{
	/* background: #eee; */
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
  .select2-container .select2-selection--single{
      height:39px;
  }
  .card .card-header span{
      margin-top:0px;
  }
  .select2-container--default .select2-selection--single .select2-selection__rendered{
      padding: 4px 30px 4px 20px;
  }
</style>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        @if ($message = Session::get('success'))
		<div class="alert alert-success alert-block mt-3">
			<button type="button" class="close" data-dismiss="alert">×</button>	
				<strong><i class="fa fa-check text-white">&nbsp;</i>{{ $message }}</strong>
		</div>
		@endif
		@if ($message = Session::get('danger'))
		<div class="alert alert-danger alert-block mt-3">
			<button type="button" class="close" data-dismiss="alert">×</button>	
				<strong>{{ $message }}</strong>
		</div>
		@endif
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <!-- Zero config.table start -->
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group form-default">
                            <select class="js-example-basic-single col-sm-12" name="class_name" id="class_name">
                                <option value="">Select Class</option>
                                @foreach($classes as $c)
                                <option value="{{ $c->id }}">{{ $c->class_name }}</option>
                                @endforeach
                            </select>    
                        </div>
                    </div>
                <div class="col-md-2">
                    <div class="form-group form-default">
                        <select class="js-example-basic-single col-sm-12" name="section_name" id="section_name">
                            
                        </select>    
                    </div>
                </div>
                <div class="col-md-5"></div>
                <div class="col-md-3 text-right">
                <a href="{{ route('admin.students.create') }}"><button class="btn waves-effect waves-light btn-primary btn-sm"><i class="icofont icofont-user-alt-3"></i>Add New</button></a>
                </div>
                </div>
            </div>
            <div class="card-block">
                <div class="dt-responsive table-responsive">
                    <table id="simpletable" class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Photo</th>
                                <th>Regi. No.</th>
                                <th>Name</th>
                                <th>Roll No.</th>
                                <th>Mobile No.</th>
                                <th>Address</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th>Photo</th>
                                <th>Regi. No.</th>
                                <th>Name</th>
                                <th>Roll No.</th>
                                <th>Mobile No.</th>
                                <th>Address</th>
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
var SITEURL = '{{ route('admin.students.index')}}';
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
$(document).ready(function(){
  fetch_data();
  function fetch_data(section = '', classs = '')
  {
    var table =$('#simpletable').DataTable({
        processing: true,
        serverSide: true,
    ajax: {
      url: SITEURL,
      data: {section:section, classs:classs}
    },
    columns: [
            {
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ''
            },
            { data: 'student_photo', name: 'student_photo'},
            { data: 'regi_no', name: 'regi_no' },
            { data: 'student_name', name: 'student_name' },
            { data: 'roll_no', name: 'roll_no' },
            { data: 'mobile_no', name: 'mobile_no' },
            { data: 'address', name: 'address' },
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
    });
  }
    $('#section_name').change(function(){
    var section_id = $('#section_name').val();
    var class_id = $('#class_name').val();

    $('#simpletable').DataTable().destroy();
    
    fetch_data(section_id, class_id);
    });

});



$('body').on('click', '#delete', function () {
    var id = $(this).data("id");

    if(confirm("Are You sure want to delete !")){
        $.ajax({
            type: "delete",
            url: "{{ url('admin/students') }}"+'/'+id,
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

$('body').on('click', '.switch_1', function () {
    var id = $(this).data("id");
    // alert(id);
    if(id != ''){
        $.ajax({
            type: "get",
            url: "{{ url('admin/students/status') }}"+'/'+id,
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

$('#class_name').change(function(){
  var classID = $(this).val();  
//   alert(brandID);
  if(classID){
    $.ajax({
      type:"GET",
      url:"{{url('admin/get-section-list')}}?class_id="+classID,
      success:function(res){        
      if(res){
        $("#section_name").empty();
        $("#section_name").append('<option>Select Section</option>');
        $.each(res,function(key,value){
          $("#section_name").append('<option value="'+key+'">'+value+'</option>');
        });
      
      }else{
        $("#section_name").empty();
      }
      }
    });
  }else{
    $("#section_name").empty();
  }   
  });
</script>

@endsection