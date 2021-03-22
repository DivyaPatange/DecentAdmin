@extends('admin.admin_layout.main')
@section('title', 'Fees')
@section('page_title', 'Fees List')
@section('breadcrumb', 'Fees List')
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
                <a href="{{ route('admin.payment.create') }}"><button class="btn waves-effect waves-light btn-primary btn-sm float-right"><i class="fa fa-plus"></i>Add New</button></a>
            </div>
            <div class="card-block">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group form-default">
                            <label>Class <span  style="color:red" id="allot_class_err"> </span></label>
                            <select name="class_name" class="form-control js-example-basic-single" id="class_name">
                                <option value="">-Select Class-</option>
                                @foreach($classes as $c)
                                <option value="{{ $c->id }}">{{ $c->class_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group form-default">
                            <label>Section <span  style="color:red" id="section_err"> </span></label>
                            <select name="section_name" class="form-control js-example-basic-single" id="section_name">
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group form-default">
                            <label>Student <span  style="color:red" id="allot_academic_err"> </span></label>
                            <select name="student" class="form-control js-example-basic-single" id="student">
                            
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group form-default">
                            <label>Date From <span  style="color:red" id="allot_academic_err"> </span></label>
                            <input type="date" name="date_from" class="form-control" id="date_from">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group form-default">
                            <label>Date To <span  style="color:red" id="allot_academic_err"> </span></label>
                            <input type="date" name="date_to" class="form-control" id="date_to">
                        </div>
                    </div>
                    <div class="col-md-3">
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
                                <th></th>
                                <th>Receipt No.</th>
                                <th>Payment Date</th>
                                <th>Student Name</th>
                                <th>Class</th>
                                <th>Section</th>
                                <th>Roll No.</th>
                                <th>Total</th>
                                <th>Discount</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th>Receipt No.</th>
                                <th>Payment Date</th>
                                <th>Student Name</th>
                                <th>Class</th>
                                <th>Section</th>
                                <th>Roll No.</th>
                                <th>Total</th>
                                <th>Discount</th>
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
var SITEURL = '{{ route('admin.payment.index')}}';
function format ( d ) {
    // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px; width:100%">'+
        '<tr>'+
            '<td style="text-align:center">Net Total</td>'+
            '<td style="text-align:center">'+d.payment_amount+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td style="text-align:center">Paid</td>'+
            '<td style="text-align:center">'+d.payment_amount+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td style="text-align:center">Payment Method</td>'+
            '<td style="text-align:center">'+d.payment_method+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td style="text-align:center">Cheque/NEFT</td>'+
            '<td style="text-align:center">'+d.payment_method_no+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td style="text-align:center">Cheque/NEFT Date</td>'+
            '<td style="text-align:center">'+d.payment_method_date+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td style="text-align:center">Action</td>'+
            '<td style="text-align:center">'+d.action+'</td>'+
        '</tr>'+
    '</table>';
}
$(document).ready(function() {
    fetch_data();
    function fetch_data(sectionID = '', classID = '', student = '', date_from = '', date_to = ''){
    var table = $('#simpletable').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
    url: SITEURL,
    type: 'GET',
    data: {sectionID:sectionID, classID:classID, student:student, date_from:date_from, date_to:date_to}
    },
    columns: [
            {
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ''
            },
            { data: 'receipt_no', name: 'receipt_no' },
            { data: 'payment_date', name: 'payment_date' },
            { data: 'student_name', name: 'student_name' },
            { data: 'class', name: 'class' },
            { data: 'section', name: 'section' },
            { data: 'roll_no', name: 'roll_no' },
            { data: 'payment_amount', name: 'payment_amount' },
            { data: 'discount', name: 'discount' },
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
    $('#getList').click(function () {
        var sectionID = $("#section_name").val();
        var classID = $("#class_name").val(); 
        var student = $("#student").val();   
        var date_from = $("#date_from").val();
        var date_to = $("#date_to").val();
        $("#simpletable").DataTable().destroy();
        fetch_data(sectionID, classID, student, date_from, date_to);
    });
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

$('#section_name').change(function(){
  var sectionID = $(this).val();
  var classID = $("#class_name").val();   
    //   alert(brandID);
  if(sectionID && classID){
    $.ajax({
      type:"GET",
      url:"{{url('admin/get-student-list')}}",
      data:{ classID:classID, sectionID:sectionID},
      success:function(res){        
      if(res){
        $("#student").empty();
        $("#student").append('<option>Select Student</option>');
        $.each(res,function(key,value){
          $("#student").append('<option value="'+key+'">'+value+'</option>');
        });
      
      }else{
        $("#student").empty();
      }
      }
    });
  }else{
    $("#student").empty();
  }   
});
</script>

@endsection