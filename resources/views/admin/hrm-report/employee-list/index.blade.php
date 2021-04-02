@extends('admin.admin_layout.main')
@section('title', 'Employee List')
@section('page_title', 'Employee List')
@section('breadcrumb', 'Employee List')
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
.table td, .table th {
    padding: 1rem 0.75rem;
}
</style>
@endsection
@section('content')
<div class="row">
    <div class="col-sm-12">
        <!-- Zero config.table start -->
        <div class="card">
            <div class="card-header">
                <h5>Employee List</h5>
            </div>
            <div class="card-block">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group form-default">
                            <label>Employee Type <span  style="color:red" id="type_err"> </span></label>
                            <select name="employee_type" class="form-control js-example-basic-single" id="employee_type">
                                <option value="">-Pick a Type-</option>
                                <option value="Teacher">Teacher</option>
                                <option value="Accountant">Accountant</option>
                                <option value="Librarian">Librarian</option>
                                <option value="Receptionist">Receptionist</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group form-default">
                            <br>
                            <button type="button" id="getList" class="btn btn-primary btn-sm mt-2">Print</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Zero config.table end -->
    </div>
</div>
<div id="DivIdToPrint" class="hidden">
    <div class="row">
        <div class="col-md-12">
            <h2 style="text-align:center">Employee List</h2>
            <p style="text-align:center"><b>Filters : </b>
            Employee Type: <span id="type"></span>&nbsp;
            </p>
            <table  width="100%" style="text-align:center;border: 1px solid black; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th style="border: 1px solid black; border-collapse: collapse;">#</th>
                        <th style="border: 1px solid black; border-collapse: collapse;">Employee Name</th>
                        <th style="border: 1px solid black; border-collapse: collapse;">Designation</th>
                        <th style="border: 1px solid black; border-collapse: collapse;">Qualification</th>
                        <th style="border: 1px solid black; border-collapse: collapse;">Gender</th>
                        <th style="border: 1px solid black; border-collapse: collapse;">Email</th>
                        <th style="border: 1px solid black; border-collapse: collapse;">Phone No.</th>
                        <th style="border: 1px solid black; border-collapse: collapse;">Address</th>
                        <th style="border: 1px solid black; border-collapse: collapse;">Status</th>
                    </tr>
                </thead>
                <tbody id="tableData"></tbody>
            </table>
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
$('#getList').click(function(){
    var employee_type = $("#employee_type").val();
    if(employee_type == '')
    {
        $("#type_err").fadeIn().html("Required");
        setTimeout(function(){ $("#type_err").fadeOut(); }, 3000);
        $("#employee_type").focus();
        return false;
    }
    else{
        $.ajax({
            type:"GET",
            url:"{{ url('admin/get-employee-list') }}",
            data:{employee_type:employee_type},
            cache:false,        
            success:function(returndata)
            {
                if(returndata.success){
                    $("#tableData").html(returndata.output);
                    $("#type").html(returndata.emp_type);
                    var frame = document.getElementById('DivIdToPrint');
                    var data = frame.innerHTML;
                    var win = window.open('', '', 'height=500,width=900');
                    win.document.write('<style>@page{size:landscape;}</style><html><head><title></title>');
                    win.document.write('</head><body >');
                    win.document.write(data);
                    win.document.write('</body></html>');
                    win.print();
                    win.close();
                    return true;
                }
            
            }
        });
  
    }
})
</script>

@endsection