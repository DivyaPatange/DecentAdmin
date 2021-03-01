@extends('admin.admin_layout.main')
@section('title', 'Document Master')
@section('page_title', 'Document Master')
@section('breadcrumb', 'Document Master')
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
                <h5>Add Document</h5>
                <!--<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>-->
            </div>
            <div class="card-block">
                <form class="form-material" id="form-submit" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-default">
                                <select name="admission_form" class="form-control" id="admission_form">
                                    <option value="">Choose</option>
                                    <option value="Junior College Admission">Junior College Admission</option>
                                    <option value="Primary School Admission">Primary School Admission</option>
                                </select>
                                <span class="form-bar"></span>
                                <label class="float-label">Admission Form<span style="color:red;">*</span><span  style="color:red" id="form_err"> </span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-default">
                                <input type="text" name="document_name" class="form-control" id="document_name">
                                <span class="form-bar"></span>
                                <label class="float-label">Document Name<span style="color:red;">*</span><span  style="color:red" id="name_err"> </span></label>
                            </div>
                        </div>
                        <div class="col-md-12">
                        <button class="btn btn-sm waves-effect waves-light hor-grd btn-grd-primary" type="button" id="submitForm">Submit</button>
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
                <h5>Document Master List</h5>
            </div>
            <div class="card-block">
                <div class="dt-responsive table-responsive">
                    <table id="simpletable" class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Admission Form</th>
                                <th>Document Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Admission Form</th>
                                <th>Document Name</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <!-- Zero config.table end -->
    </div>
</div>

<!-- Modal -->
<div class="md-modal md-effect-8" id="modal-8">
    <div class="md-content">
        <h3>Edit Document Master</h3>
        <div>
            <form method="POST" id="editForm">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-default">
                            <select name="admission_form" class="form-control" id="edit_admission_form">
                                <option value="">Choose</option>
                                <option value="Junior College Admission">Junior College Admission</option>
                                <option value="Primary School Admission">Primary School Admission</option>
                            </select>
                            <span class="form-bar"></span>
                            <label class="float-label">Admission Form<span style="color:red;">*</span><span  style="color:red" id="edit_form_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group form-default">
                            <input type="text" name="document_name" class="form-control" id="edit_document_name" value="">
                            <span class="form-bar"></span>
                            <label class="float-label">Document Name<span style="color:red;">*</span><span  style="color:red" id="edit_name_err"> </span></label>
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
var SITEURL = '{{ route('admin.documents.index')}}';
$('#simpletable').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
    url: SITEURL,
    type: 'GET',
    },
    columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,searchable: false},
            { data: 'admission_form', name: 'admission_form' },
            { data: 'document_name', name: 'document_name' },
            {data: 'action', name: 'action', orderable: false},
        ],
    order: [[0, 'desc']]
});


$('body').on('click', '#submitForm', function () {
    var admission_form = $("#admission_form").val();
    var document_name = $("#document_name").val();
    if (admission_form=="") {
        $("#form_err").fadeIn().html("Required");
        setTimeout(function(){ $("#form_err").fadeOut(); }, 3000);
        $("#admission_form").focus();
        return false;
    }
    if (document_name=="") {
        $("#name_err").fadeIn().html("Required");
        setTimeout(function(){ $("#name_err").fadeOut(); }, 3000);
        $("#document_name").focus();
        return false;
    }
    else
    { 
        var datastring="admission_form="+admission_form+"&document_name="+document_name;
        // alert(datastring);
        $.ajax({
            type:"POST",
            url:"{{ route('admin.documents.store') }}",
            data:datastring,
            cache:false,        
            success:function(returndata)
            {
                document.getElementById("form-submit").reset();
                var oTable = $('#simpletable').dataTable(); 
                oTable.fnDraw(false);
                toastr.success(returndata.success);
            
            // location.reload();
            // $("#pay").val("");
            }
        });
    }
})

function EditModel(obj,bid)
{
    var datastring="bid="+bid;
    // alert(datastring);
    $.ajax({
        type:"POST",
        url:"{{ route('admin.get.document') }}",
        data:datastring,
        cache:false,        
        success:function(returndata)
        {
            // alert(returndata);
        if (returndata!="0") {
            $("#modal-8").addClass("md-show");
            var json = JSON.parse(returndata);
            $("#id").val(json.id);
            $("#edit_admission_form").val(json.admission_form);
            $("#edit_document_name").val(json.document_name);
        }
        }
    });
}

function checkSubmit()
{
    var admission_form = $("#edit_admission_form").val();
    var document_name = $("#edit_document_name").val();
    var id = $("#id").val().trim();
    if (admission_form=="") {
        $("#edit_form_err").fadeIn().html("Required");
        setTimeout(function(){ $("#edit_form_err").fadeOut(); }, 3000);
        $("#edit_admission_form").focus();
        return false;
    }
    if (document_name=="") {
        $("#edit_name_err").fadeIn().html("Required");
        setTimeout(function(){ $("#edit_name_err").fadeOut(); }, 3000);
        $("#edit_document_name").focus();
        return false;
    }
    else
    { 
        $('#editButton').attr('disabled',true);
        var datastring="admission_form="+admission_form+"&document_name="+document_name+"&id="+id;
        // alert(datastring);
        $.ajax({
            type:"POST",
            url:"{{ url('/admin/document/update') }}",
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
            url: "{{ url('admin/documents') }}"+'/'+id,
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