@extends('admin.admin_layout.main')
@section('title', 'Total Fee Collection List')
@section('page_title', 'Total Fee Collection List')
@section('breadcrumb', 'Total Fee Collection List')
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
                <h5>Total Fee Collection List</h5>
            </div>
            <div class="card-block">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group form-default">
                            <label>Academic Year <span  style="color:red" id="year_err"> </span></label>
                            <select name="academic_year" class="form-control js-example-basic-single" id="academic_year">
                                <option value="">-Select Class-</option>
                                @foreach($academicYear as $a)
                                <option value="{{ $a->id }}">({{ $a->from_academic_year }}) - ({{ $a->to_academic_year }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group form-default">
                            <label>Class <span  style="color:red" id="class_err"> </span></label>
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
            <h2 style="text-align:center">Total Fee Collection List</h2>
            <p style="text-align:center"><b>Filters : </b>
            Academic Year: <span id="academic_year1"></span>&nbsp;
            Class: <span id="class_name1"></span>&nbsp;
            Section: <span id="section"></span>
            </p>
            <table  width="100%" style="text-align:center;border: 1px solid black; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th style="border: 1px solid black; border-collapse: collapse;">#</th>
                        <th style="border: 1px solid black; border-collapse: collapse;">Student Name</th>
                        <th style="border: 1px solid black; border-collapse: collapse;">Roll No.</th>
                        <th style="border: 1px solid black; border-collapse: collapse;">Fee Head</th>
                        <th style="border: 1px solid black; border-collapse: collapse;">Receipt No.</th>
                        <th style="border: 1px solid black; border-collapse: collapse;">Payment Method</th>
                        <th style="border: 1px solid black; border-collapse: collapse;">Payment Amount</th>
                        <th style="border: 1px solid black; border-collapse: collapse;">Payment Date</th>
                        <th style="border: 1px solid black; border-collapse: collapse;">Due Amount</th>
                        <th style="border: 1px solid black; border-collapse: collapse;">Due Date</th>
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
$('#getList').click(function(){
    var academic_id = $("#academic_year").val();
    var class_id = $("#class_name").val();
    var section_id = $("#section_name").val();
    if(academic_id == '')
    {
        $("#year_err").fadeIn().html("Required");
        setTimeout(function(){ $("#year_err").fadeOut(); }, 3000);
        $("#academic_year").focus();
        return false;
    }
    if(class_id == '')
    {
        $("#class_err").fadeIn().html("Required");
        setTimeout(function(){ $("#class_err").fadeOut(); }, 3000);
        $("#class_name").focus();
        return false;
    }
    if(section_id == '')
    {
        $("#section_err").fadeIn().html("Required");
        setTimeout(function(){ $("#section_err").fadeOut(); }, 3000);
        $("#section_name").focus();
        return false;
    }
    else{
        $.ajax({
            type:"GET",
            url:"{{ url('admin/get-total-fee-collection') }}",
            data:{academic_id:academic_id, class_id:class_id, section_id:section_id},
            cache:false,        
            success:function(returndata)
            {
                if(returndata.success){
                    $("#tableData").html(returndata.output);
                    $("#academic_year1").html(returndata.academic_year);
                    $("#class_name1").html(returndata.class_name);
                    $("#section").html(returndata.section);
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