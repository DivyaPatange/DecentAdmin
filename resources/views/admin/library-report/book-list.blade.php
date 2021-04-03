@extends('admin.admin_layout.main')
@section('title', 'Library Book List')
@section('page_title', 'Library Book List')
@section('breadcrumb', 'Library Book List')
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
                <h5>Library Book List</h5>
            </div>
            <div class="card-block">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group form-default">
                            <label>Author <span  style="color:red" id="author_err"> </span></label>
                            <select name="author_name" class="form-control js-example-basic-single" id="author_name">
                                @foreach($books as $b)
                                <option value="{{ $b->author }}">{{ $b->author }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group form-default">
                            <label>Type <span  style="color:red" id="type_err"> </span></label>
                            <select name="type" class="form-control js-example-basic-single" id="type">
                                <option value="All">All</option>
                                <option value="Academic">Academic</option>
                                <option value="Novel">Novel</option>
                                <option value="Magazine">Magazine</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group form-default">
                            <label>Class <span  style="color:red" id="class_err"> </span></label>
                            <select name="class_name" class="form-control js-example-basic-single" id="class_name">
                                <option value="All">All</option>
                                @foreach($classes as $c)
                                <option value="{{ $c->id }}">{{ $c->class_name }}</option>
                                @endforeach
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
            <h2 style="text-align:center">Library Book List</h2>
            <p style="text-align:center"><b>Filters : </b>
            Author: <span id="author"></span>&nbsp;
            Type: <span id="type1"></span>&nbsp;
            Class: <span id="class_name1"></span>
            </p>
            <table  width="100%" style="text-align:center;border: 1px solid black; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th style="border: 1px solid black; border-collapse: collapse;">#</th>
                        <th style="border: 1px solid black; border-collapse: collapse;">ISBN No.</th>
                        <th style="border: 1px solid black; border-collapse: collapse;">Book Name</th>
                        <th style="border: 1px solid black; border-collapse: collapse;">Type</th>
                        <th style="border: 1px solid black; border-collapse: collapse;">Class</th>
                        <th style="border: 1px solid black; border-collapse: collapse;">Total Quantity</th>
                        <th style="border: 1px solid black; border-collapse: collapse;">Stock Quantity</th>
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
    var author_name = $("#author_name").val();
    var class_id = $("#class_name").val();
    var type = $("#type").val();
    if(author_name == '')
    {
        $("#author_err").fadeIn().html("Required");
        setTimeout(function(){ $("#author_err").fadeOut(); }, 3000);
        $("#author_name").focus();
        return false;
    }
    if(type == '')
    {
        $("#type_err").fadeIn().html("Required");
        setTimeout(function(){ $("#type_err").fadeOut(); }, 3000);
        $("#type").focus();
        return false;
    }
    if(class_id == '')
    {
        $("#class_err").fadeIn().html("Required");
        setTimeout(function(){ $("#class_err").fadeOut(); }, 3000);
        $("#class_name").focus();
        return false;
    }
    else{
        $.ajax({
            type:"GET",
            url:"{{ url('admin/get-library-book-list') }}",
            data:{author_name:author_name, class_id:class_id, type:type},
            cache:false,        
            success:function(returndata)
            {
                if(returndata.success){
                    $("#tableData").html(returndata.output);
                    $("#author").html(returndata.author);
                    $("#type1").html(returndata.type);
                    $("#class_name1").html(returndata.class_name);
                    var divToPrint=document.getElementById('DivIdToPrint');

                    var newWin=window.open('','Print-Window');

                    newWin.document.open();

                    newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

                    newWin.document.close();

                    setTimeout(function(){newWin.close();},10);
                }
            
            }
        });
  
    }
})
</script>

@endsection