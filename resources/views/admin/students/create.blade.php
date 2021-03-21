@extends('admin.admin_layout.main')
@section('title', 'Add Students')
@section('page_title', 'Add Students')
@section('breadcrumb', 'Add Students')
@section('customcss')

<!-- Data Table Css -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/pages/data-table/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<!-- Select 2 css -->
<link rel="stylesheet" href="{{ asset('files/bower_components/select2/css/select2.min.css') }}" />
<!-- ico font -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/icon/icofont/css/icofont.css') }}">
<!-- animation nifty modal window effects css -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/css/component.css') }}">
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
</style>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Add Students</h5>
                <!--<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>-->
            </div>
            <div class="card-block">
                <form class="form-material" id="form-submit" method="POST">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group form-default">
                                <label>Class<span style="color:red;">*</span><span  style="color:red" id="from_err"> </span></label>
                                <select name="class_name" class="form-control js-example-basic-single" id="class">
                                    <option value="">-Select Class-</option>
                                    @foreach($classes as $c)
                                    <option value="{{ $c->id }}">{{ $c->class_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-default">
                                <label>Academic Year<span style="color:red;">*</span><span  style="color:red" id="to_err"> </span></label>
                                <select name="academic_year" class="form-control js-example-basic-single" id="academic_year">
                                    <option value="">-Select Academic Year-</option>
                                    @foreach($academicYear as $a)
                                    <option value="{{ $a->id }}">({{ $a->from_academic_year }}) - ({{ $a->to_academic_year }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                        <button class="btn btn-sm waves-effect waves-light hor-grd btn-grd-primary" type="button" id="submitForm">Search</button>
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
                <h5>Student List</h5>
            </div>
            <div class="card-block">
                <div class="dt-responsive table-responsive">
                    <table id="simpletable" class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Action</th>
                                <th>Roll No.</th>
                                <th>Application No.</th>
                                <th>Name</th>
                                <th>Class</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Action</th>
                                <th>Roll No.</th>
                                <th>Application No.</th>
                                <th>Name</th>
                                <th>Class</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <form class="form-material" id="allot-form-submit" method="POST">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group form-default">
                                <label>Class<span style="color:red;">*</span><span  style="color:red" id="allot_class_err"> </span></label>
                                <select name="class_name" class="form-control js-example-basic-single" id="class_name">
                                    <option value="">-Select Class-</option>
                                    @foreach($classes as $c)
                                    <option value="{{ $c->id }}">{{ $c->class_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-default">
                                <label>Section<span style="color:red;">*</span><span  style="color:red" id="section_err"> </span></label>
                                <select name="section_name" class="form-control js-example-basic-single" id="section_name">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-default">
                                <label>Academic Year<span style="color:red;">*</span><span  style="color:red" id="allot_academic_err"> </span></label>
                                <select name="academic_year" class="form-control js-example-basic-single" id="allot_academic_year">
                                    <option value="">-Select Academic Year-</option>
                                    @foreach($academicYear as $a)
                                    <option value="{{ $a->id }}">({{ $a->from_academic_year }}) - ({{ $a->to_academic_year }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                        <button class="btn btn-sm waves-effect waves-light hor-grd btn-grd-primary" type="button" id="allotSubmitForm">Allot</button>
                        </div>
                    </div>
                </form>
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
var SITEURL = '{{ route('admin.students.create')}}';
$('body').on('click', '#submitForm', function () {
  var academic_id = $('#academic_year').val();
  var classes = $('#class').val();
  var datastring = "academic_id="+academic_id+"&classes="+classes;
//  alert(datastring);


 if(datastring){
       $('#simpletable').DataTable().destroy();
    //    alert(datastring);
    $('#simpletable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
        url: "{{ route('admin.students.create') }}",
        data: {academic_id:academic_id, classes:classes},
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,searchable: false},
            { data: 'check_val', name: 'check_val' },
            { data: 'roll_no', name: 'roll_no' },
            { data: 'application_no', name: 'application_no' },
            { data: 'student_name', name: 'student_name' },
            { data: 'class', name: 'class' },
        ],
        order: [[0, 'asc']],
    });
 }
})
$('body').on('click', '#allotSubmitForm', function () {
    var classes = $("#class_name").val();
    var section = $("#section_name").val();
    var academic_id = $("#allot_academic_year").val();
    var TableData = new Array();
    $('#simpletable tr').each(function(row, tr) {
        TableData[row] = {
        "ID": $(tr).find("input[name='check_val']").val(),
        "Roll": $(tr).find("input[name='roll_no']").val()
        }//tableData[row]
    });
    TableData.shift(); // first row will be empty - so remove
    var Data;
    Data = JSON.stringify(TableData);
    // alert(array.length);
    
    if (classes=="") {
        $("#allot_class_err").fadeIn().html("Required");
        setTimeout(function(){ $("#allot_class_err").fadeOut(); }, 3000);
        $("#class_name").focus();
        return false;
    }
    if (section=="") {
        $("#section_err").fadeIn().html("Required");
        setTimeout(function(){ $("#section_err").fadeOut(); }, 3000);
        $("#section_name").focus();
        return false;
    }
    if (academic_id=="") {
        $("#allot_academic_err").fadeIn().html("Required");
        setTimeout(function(){ $("#allot_academic_err").fadeOut(); }, 3000);
        $("#allot_academic_year").focus();
        return false;
    }
    else
    { 
        var datastring="classes="+classes+"&academic_id="+academic_id+"&Data="+Data+"&section="+section;
        // alert(datastring);
        $.ajax({
            type:"POST",
            url:"{{ route('admin.students.store') }}",
            data:datastring,
            cache:false,        
            success:function(returndata)
            {
                // console.log(returndata);
                // document.getElementById("allot-form-submit").reset();
                // document.getElementById("form-submit").reset();
                // $('#simpletable').DataTable().clear();
                // $('#simpletable').DataTable().draw();
                // // var oTable = $('#simpletable').dataTable(); 
                // // oTable.fnDraw(false);
                // toastr.success(returndata.success);
            
            location.reload();
            // $("#pay").val("");
            }
        });
    }
})
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