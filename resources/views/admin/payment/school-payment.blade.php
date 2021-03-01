@extends('admin.admin_layout.main')
@section('title', 'Payment')
@section('page_title', 'Payment')
@section('breadcrumb', 'Payment')
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
    <div class="col-sm-12">
        <!-- Panel card start -->
        <div class="card">
            <div class="card-header">
                <h5>Payment Details ({{ $admission->full_name_pupil }})</h5>
                <button class="btn btn-info btn-sm waves-effect waves-light float-right" onclick="Pay(this, {{ $admission->id }})">Pay Balance Amount</button>
            </div>
            <div class="card-block panels-wells">
                <div class="row">
                    <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6">
                        <div class="panel panel-success">
                            <div class="panel-heading bg-success">
                                Total Amount Pay
                            </div>
                            <div class="panel-body">
                                <p>&#8377; {{ $fees }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading bg-primary">
                                Advanced Amount Pay
                            </div>
                            <div class="panel-body">
                                <p>&#8377; {{ $payment }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6">
                        <div class="panel panel-danger">
                            <div class="panel-heading bg-danger">
                                Balance Amount
                            </div>
                            <div class="panel-body">
                                <p>{{ $fees - $payment }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- end of row -->
                </div>
            </div>
        </div>
        <!-- Panel card end -->
    </div>
</div>
<!-- Modal -->
<div class="md-modal md-effect-8" id="modal-8">
    <div class="md-content">
        <h3>Pay Balance Amount</h3>
        <div>
            <form method="POST" id="editForm">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group form-default">
                            <input type="text" readonly name="amount_pay" class="form-control" id="amount_pay" value="">
                            <span class="form-bar"></span>
                            <label class="float-label">Total Amount Pay</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-default">
                            <input type="text" readonly name="adv_amount" class="form-control" id="adv_amount" value="">
                            <span class="form-bar"></span>
                            <label class="float-label">Advance Amount</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-default">
                            <input type="text" name="bal_amount" readonly class="form-control" id="bal_amount" value="">
                            <span class="form-bar"></span>
                            <label class="float-label">Balance Amount</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-default">
                            <select name="fee_head" class="form-control" id="fee_head">
                                <option value="">-Select Fee Head-</option>
                                @foreach($feeHead as $f)
                                <?php 
                                    $fee_head = DB::table('fee_heads')->where('id', $f->fee_head_id)->first();
                                ?>
                                <option value="{{ $f->id }}">@if(!empty($fee_head)){{ $fee_head->fee_head }}@endif</option>
                                @endforeach
                            </select>
                            <span class="form-bar"></span>
                            <label class="float-label">Payment For<span style="color:red;">*</span><span  style="color:red" id="fee_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-default">
                            <input type="number" name="pay_amount" class="form-control" id="pay_amount" value="">
                            <span class="form-bar"></span>
                            <label class="float-label">Pay Amount<span style="color:red;">*</span><span  style="color:red" id="pay_amt_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-default">
                            <input type="date" name="pay_date" class="form-control" id="pay_date" value="">
                            <span class="form-bar"></span>
                            <label class="float-label">Payment Date<span style="color:red;">*</span><span  style="color:red" id="pay_date_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-default">
                            <input type="date" name="due_date" class="form-control" id="due_date" value="">
                            <span class="form-bar"></span>
                            <label class="float-label">Due Date<span style="color:red;">*</span><span  style="color:red" id="due_date_err"> </span></label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <input type="hidden" name="id" id="id" value="">
                        <input type="hidden" name="adm_sought" value="{{ $admission->adm_sought }}" id="adm_sought">
                        <button class="btn btn-sm waves-effect waves-light hor-grd btn-grd-primary" type="button" id="editButton" onclick="return checkSubmit()">Pay</button>
                        <button type="button" class="btn btn-sm waves-effect waves-light hor-grd btn-grd-danger md-close">Close</button>
                    </div>
                </div>
            </form>
            
            
        </div>
    </div>
</div>
<div class="md-overlay"></div>
@if(count($paymentLogs) > 0)
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Payment Logs</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="simpletable" class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <th>Fee Head</th>
                                <th>Payment Amount</th>
                                <th>Payment Date</th>
                                <th>Next Due Date</th>
                                <th>Receipt</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
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
var SITEURL = '{{ url('admin/school-payment', $admission->id)}}';
$('#simpletable').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
    url: SITEURL,
    type: 'GET',
    },
    columns: [
            { data: 'fee_head', name: 'fee_head' },
            { data: 'payment_amount', name: 'payment_amount' },
            { data: 'payment_date', name: 'payment_date' },
            { data: 'due_date', name: 'due_date' },
            {data: 'action', name: 'action', orderable: false},
        ],
    order: [[0, 'desc']]
});

function Pay(obj,bid)
{
    var adm_sought = "{{ $admission->adm_sought }}";
    var datastring="bid="+bid+"&adm_sought="+adm_sought;
    // alert(datastring);
    $.ajax({
        type:"POST",
        url:"{{ route('admin.get.school-payment') }}",
        data:datastring,
        cache:false,        
        success:function(returndata)
        {
            // alert(returndata);
        if (returndata!="0") {
            $("#modal-8").addClass("md-show");
            var json = JSON.parse(returndata);
            $("#id").val(json.id);
            $("#amount_pay").val(json.amount_pay);
            $("#adv_amount").val(json.adv_amount);
            $("#bal_amount").val(json.bal_amount);
        }
        }
    });
}
$('body').on('click', '.md-close', function () {
    $("#modal-8").removeClass("md-show");
})

function checkSubmit()
{
    var bal_amt = $("#bal_amount").val();
    var pay_amt = $("#pay_amount").val();
    var pay_date = $("#pay_date").val();
    var due_date = $("#due_date").val();
    var fee_head = $("#fee_head").val();
    var id = $("#id").val().trim();
    var adm_sought = $("#adm_sought").val();
    if (pay_amt=="") {
        $("#pay_amt_err").fadeIn().html("Required");
        setTimeout(function(){ $("#pay_amt_err").fadeOut(); }, 3000);
        $("#pay_amount").focus();
        return false;
    }
    if (fee_head=="") {
        $("#fee_err").fadeIn().html("Required");
        setTimeout(function(){ $("#fee_err").fadeOut(); }, 3000);
        $("#fee_head").focus();
        return false;
    }
    if (pay_date=="") {
        $("#pay_date_err").fadeIn().html("Required");
        setTimeout(function(){ $("#pay_date_err").fadeOut(); }, 3000);
        $("#pay_date").focus();
        return false;
    }
    if (due_date=="") {
        $("#due_date_err").fadeIn().html("Required");
        setTimeout(function(){ $("#due_date_err").fadeOut(); }, 3000);
        $("#due_date").focus();
        return false;
    }
    if(bal_amt == 0)
    {
        return false;
    }
    else
    { 
        $('#editButton').attr('disabled',true);
        var datastring="pay_amt="+pay_amt+"&pay_date="+pay_date+"&id="+id+"&due_date="+due_date+"&fee_head="+fee_head+"&adm_sought="+adm_sought;
        // alert(datastring);
        $.ajax({
            type:"POST",
            url:"{{ route('admin.payment.store') }}",
            data:datastring,
            cache:false,        
            success:function(returndata)
            {
            $('#editButton').attr('disabled',false);
            $("#modal-8").removeClass("md-show");
            toastr.success(returndata.success);
            
            $("body").load("{{ url('admin/school-payment', $admission->id) }}");
            // $("#pay").val("");
            }
        });
    }
}
$('body').on('click', '#receipt', function () {
    var id = $(this).data("id");
    window.location.href="/admin/receipt/"+id
});
</script>

@endsection