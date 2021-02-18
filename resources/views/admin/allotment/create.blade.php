@extends('admin.admin_layout.main')
@section('title', 'New Allotment')
@section('page_title', 'New Allotment')
@section('breadcrumb', 'New Allotment')
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
                <h5>New Allotment</h5>
                <!--<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>-->
            </div>
            <div class="card-block">
                <form class="form-material" id="form-submit" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-default">
                                <select name="classes" class="form-control" id="classes">
                                    <option value="">-Select Class-</option>
                                    @foreach($classes as $c)
                                    <option value="{{ $c->class }}">{{ $c->class }}</option>
                                    @endforeach
                                </select>
                                <span class="form-bar"></span>
                                <label class="float-label">Class<span style="color:red;">*</span><span  style="color:red" id="from_err"> </span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-default">
                                <select name="academic_year" class="form-control" id="academic_year">
                                    <option value="">-Select Academic Year-</option>
                                    @foreach($academicYear as $a)
                                    <option value="{{ $a->id }}">({{ $a->from_academic_year }}) - ({{ $a->to_academic_year }})</option>
                                    @endforeach
                                </select>
                                <span class="form-bar"></span>
                                <label class="float-label">Academic Year<span style="color:red;">*</span><span  style="color:red" id="to_err"> </span></label>
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
                                <th>College ID</th>
                                <th>Student Name</th>
                                <th>Class</th>
                                <th>Academic Year</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Action</th>
                                <th>College ID</th>
                                <th>Student Name</th>
                                <th>Class</th>
                                <th>Academic Year</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <form class="form-material" id="allot-form-submit" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-default">
                                <select name="classes" class="form-control" id="allot_class">
                                    <option value="">-Select Class-</option>
                                    @foreach($classes as $c)
                                    <option value="{{ $c->id }}">{{ $c->class }}</option>
                                    @endforeach
                                </select>
                                <span class="form-bar"></span>
                                <label class="float-label">Class<span style="color:red;">*</span><span  style="color:red" id="allot_class_err"> </span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-default">
                                <select name="academic_year" class="form-control" id="allot_academic_year">
                                    <option value="">-Select Academic Year-</option>
                                    @foreach($academicYear as $a)
                                    <option value="{{ $a->id }}">({{ $a->from_academic_year }}) - ({{ $a->to_academic_year }})</option>
                                    @endforeach
                                </select>
                                <span class="form-bar"></span>
                                <label class="float-label">Academic Year<span style="color:red;">*</span><span  style="color:red" id="allot_academic_err"> </span></label>
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


<script>
var SITEURL = '{{ route('admin.allotment.create')}}';
$('body').on('click', '#submitForm', function () {
  var academic_id = $('#academic_year').val();
  var classes = $('#classes').val();
  var datastring = "academic_id="+academic_id+"&classes="+classes;
//  alert(datastring);


 if(datastring){
       $('#simpletable').DataTable().destroy();
    //    alert(datastring);
$('#simpletable').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: "{{ route('admin.allotment.create') }}",
      data: {academic_id:academic_id, classes:classes},
    },
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,searchable: false},
        { data: 'check_val', name: 'check_val' },
        { data: 'collage_ID', name: 'collage_ID' },
        { data: 'student_name', name: 'student_name' },
        { data: 'adm_sought', name: 'adm_sought' },
        { data: 'academic_id', name: 'academic_id' },
    ],
    order: [[0, 'asc']],
    });
 }
})
$('body').on('click', '#allotSubmitForm', function () {
    var classes = $("#allot_class").val();
    var academic_id = $("#allot_academic_year").val();
    var array = [];
    $("input:checkbox[name=check_val]:checked").each(function(){
        array.push($(this).val());
    });
    // alert(array.length);
    if(array.length == 0)
    {
        alert('Please Select Student to Allot');
        return false;
    }
    if (classes=="") {
        $("#allot_class_err").fadeIn().html("Required");
        setTimeout(function(){ $("#allot_class_err").fadeOut(); }, 3000);
        $("#allot_class").focus();
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
        var datastring="classes="+classes+"&academic_id="+academic_id+"&array="+array;
        // alert(datastring);
        $.ajax({
            type:"POST",
            url:"{{ route('admin.allotment.store') }}",
            data:datastring,
            cache:false,        
            success:function(returndata)
            {
                document.getElementById("allot-form-submit").reset();
                document.getElementById("form-submit").reset();
                $('#simpletable').DataTable().clear();
                $('#simpletable').DataTable().draw();
                // var oTable = $('#simpletable').dataTable(); 
                // oTable.fnDraw(false);
                toastr.success(returndata.success);
            
            // location.reload();
            // $("#pay").val("");
            }
        });
    }
})
</script>

@endsection