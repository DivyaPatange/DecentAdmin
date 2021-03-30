@extends('admin.admin_layout.main')
@section('title', 'Employee Attendance')
@section('page_title', 'Add Employee Attendance')
@section('breadcrumb', 'Add Employee Attendance')
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
.hidden{
    display:none;
}
</style>
@endsection
@section('content')
<div class="row">
    <div class="col-sm-12" id="formDiv">
        <!-- Zero config.table start -->
        <div class="card">
            <div class="card-header">
                <h5>Add Employee Attendance</h5>
            </div>
            <div class="card-block">
                <form method="POST" id="submitForm">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group form-default">
                                <label>Date <span  style="color:red" id="date_err"> </span></label>
                                <input type="date" name="date" class="form-control" id="date" value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                        
                        <div class="col-md-8">
                            <div class="form-group form-default">
                                <button type="button" id="getList" class="btn btn-primary btn-sm mt-2">Entry Attendance</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Zero config.table end -->
    </div>
    <div class="col-sm-12">
        <!-- Zero config.table start -->
        <div class="card">
            <div class="card-header">
                <h5>Employee List</h5>
            </div>
            <div class="card-block hidden" id="studentList">
                <div class="col-12">
                    <div class="panel panel-default mb-4">
                        <div class="panel-heading bg-default txt-white text-center">
                            <h4>Attendance Entry For <span id="attend_date"></span></h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="dt-responsive table-responsive" >
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Employee ID</th>
                                    <th>Is Present ? <br>
                                        <input type="checkbox" id="select_all" value="1">&nbsp;&nbsp;&nbsp;Select / Deselect All
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="table-div"></tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="form-group form-default">
                        <input type="hidden" name="id" id="id" value="">
                        <button type="button" id="addAttendance" class="btn btn-primary btn-sm mt-2">Add Attendance</button>
                    </div>
                </div>
            </div>
        </div>
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
    var date = $("#date").val();
    // alert(date);
    if (date=="") {
        $("#date_err").fadeIn().html("Required");
        setTimeout(function(){ $("#date_err").fadeOut(); }, 3000);
        $("#date").focus();
        return false;
    }
    else
    { 
        // alert(datastring);
        $.ajax({
            type:"POST",
            url:"{{ route('admin.employee-attendance.store') }}",
            data:{date:date},
            cache:false,        
            success:function(returndata)
            {
                alert(returndata);
                if(returndata.success){
                    $("#formDiv").addClass('hidden');
                    $("#studentList").removeClass('hidden');
                    $("#attend_date").html(returndata.date);
                    $("#table-div").html(returndata.output);
                    $("#id").val(returndata.id);
                }
                else{
                    toastr.error(returndata.error);
                }
            
            }
        });
    }
})
$(function() {
  
  $(document).on('click', '#select_all', function() {
  
    if ($(this).val() == 1) {
      $('input[name="check_val"]').prop('checked', true);
      $('input[name="check_val"]:checked').val("Present");
      $(this).val(0);
    } else {
      $('input[name="check_val"]').prop('checked', false);
      $('input[name="check_val"]').val("Absent");
      $(this).val(1);
    }
  });
  
});

$('body').on('click', '#addAttendance', function () {
    var id = $("#id").val();
    var TableData = new Array();
    $('.table tr').each(function(row, tr) {
        TableData[row] = {
        "ID": $(tr).find("input[name='teacher_id']").val(),
        "Status": $(tr).find("input[name='check_val']").val()
        }//tableData[row]
    });
    TableData.shift(); // first row will be empty - so remove
    var Data;
    Data = JSON.stringify(TableData);
    // alert(Data);
    $.ajax({
        type:"POST",
        url:"{{ route('admin.employee-attendance.employeeList') }}",
        data:{id:id, Data:Data},
        cache:false,        
        success:function(returndata)
        {
            // alert(returndata);
            toastr.success(returndata.success);
            
        // $("#pay").val("");
        }
    });
});

$('body').on('click', 'input[name="check_val"]', function () {
    var query = $(this).val();
    // alert(query);
    if(query == "Absent")
    {
        $(this).val("Present");
    }
    else{
        $(this).val("Absent");
    }
})
</script>

@endsection