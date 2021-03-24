@extends('admin.admin_layout.main')
@section('title', 'Payment')
@section('page_title', 'Make Payment')
@section('breadcrumb', 'Make Payment')
@section('customcss')
<!-- Select 2 css -->
<link rel="stylesheet" href="{{ asset('files/bower_components/select2/css/select2.min.css') }}" />
<!-- themify-icons line icon -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/icon/themify-icons/themify-icons.css') }}">
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<!-- ico font -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/icon/icofont/css/icofont.css') }}">
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
.icons-alert:before{
    top:10px;
}
.table td, .table th{
    padding: 0.75rem 0.75rem;
}
.hidden{
    display:none;
}
</style>
@endsection
@section('content')
<div class="row">
    <div class="col-sm-12">
        <!-- Material tab card start -->
        <div class="card">
            <div class="card-header">
                <h5>Student Info</h5>
            </div>
            <div class="card-block">
                <!-- Row start -->
                <div class="row">
                    <div class="col-lg-12 col-xl-12">
                        <ul class="nav nav-tabs md-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#home3" role="tab">Search By Regi. No.</a>
                                <div class="slide"></div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#profile3" role="tab">Search By Class</a>
                                <div class="slide"></div>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content card-block">
                            <div class="tab-pane active" id="home3" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group form-default">
                                            <label>Student Regi. No.<span  style="color:red" id="allot_academic_err"> </span></label>
                                            <input type="text" name="student_regi_no" class="form-control" id="student_regi_no">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="profile3" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-4">
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
                                    <div class="col-md-4">
                                        <div class="form-group form-default">
                                            <label>Section <span  style="color:red" id="section_err"> </span></label>
                                            <select name="section_name" class="form-control js-example-basic-single" id="section_name">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-default">
                                            <label>Roll No. <span  style="color:red" id="roll_err"> </span></label>
                                            <input type="text" name="roll_no" class="form-control" id="roll_no">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row end -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group form-default">
                            <label>Student Name <span  style="color:red" id="student_err"> </span></label>
                            <input type="text" name="student_name" readonly class="form-control" id="student_name">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group form-default">
                        <br>
                            <button type="button" id="getList" class="btn btn-primary btn-sm">Search</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Material tab card end -->
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>Fee Info</h5>
            </div>
            <div class="card-block">

            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>Pay Fee</h5>
            </div>
            <div class="card-block">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger icons-alert">
                            <p><strong>Note!</strong> Search Student First</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group form-default">
                            <label>Fee Head <span  style="color:red" id="allot_class_err"> </span></label>
                            <select name="fee_head" class="form-control js-example-basic-single" id="fee_head">
                                
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive"> 
                            <table class="table table-bordered" id="feeHeadTable"> 
                                <thead> 
                                    <tr> 
                                        <th class="text-center">Fee Head</th> 
                                        <th class="text-center">Amount</th> 
                                        <th></th>
                                    </tr> 
                                </thead> 
                                <tbody id="tbody"> 
                        
                                </tbody> 
                            </table> 
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <form method="post" id="submitForm">
                            <table class="table table-striped">
                                <tr>
                                    <th>Total Amount</th>
                                    <td><input type="text" class="form-control" id="total_amt" name="total_amt" readonly value="0.00"></td>
                                </tr>
                                <tr>
                                    <th>Discount Amount</th>
                                    <td><input type="text" class="form-control" id="discount" name="discount" value="0.00"></td>
                                </tr>
                                <tr>
                                    <th>Net Amount</th>
                                    <td><input type="text" class="form-control" id="net_amt" name="net_amt" readonly value="0.00"></td>
                                </tr>
                                <tr>
                                    <th>Paid Amount <span style="color:red;">*</span><span  style="color:red" id="amt_err"> </span></th>
                                    <td><input type="text" class="form-control" id="paid_amt" name="paid_amt" value="0.00"></td>
                                </tr>
                                <tr>
                                    <th>Due Amount</th>
                                    <td><input type="text" class="form-control" id="due_amt" name="due_amt" readonly value="0.00"></td>
                                </tr>
                                <tr>
                                    <th>Due Date</th>
                                    <td><input type="date" class="form-control" id="due_date" name="due_date"></td>
                                </tr>
                                <tr>
                                    <th>Payment Method <span style="color:red;">*</span><span  style="color:red" id="method_err"> </span></th>
                                    <td>
                                        <select class="form-control js-example-basic-single" id="pay_method" name="pay_method">
                                            <option value="">Pick a method</option>
                                            <option value="Cash">Cash</option>
                                            <option value="NEFT">NEFT</option>
                                            <option value="Cheque">Cheque</option>
                                            <option value="D.D.">D.D.</option>
                                            <option value="Online Banking">Online Banking</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Payment Reference No.</th>
                                    <td><input type="text" class="form-control" id="pay_ref_no" name="pay_ref_no"></td>
                                </tr>
                            </table>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-primary waves-effect waves-light btn-sm" id="button1">Pay Fee</button>
                        <button class="btn btn-success waves-effect waves-light btn-sm hidden" id="button2" class="hidden">Pay Fee</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('customjs')
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
        $("#section_name").append('<option value="">Select Section</option>');
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

$('#pay_method').change(function(){
    var pay_method = $(this).val();
    if(pay_method == "Online Banking")
    {
        $('#button2').removeClass("hidden");
        $('#button1').addClass("hidden");
    }
    else{
        $('#button1').removeClass("hidden");
        $('#button2').addClass("hidden");
    }
})

$('#getList').click(function(){
    // the click occured outside '#element'
    var regi_no = $('#student_regi_no').val();
    var roll_no = $('#roll_no').val();
    var classs = $('#class_name').val();
    var section = $('#section_name').val();
    // alert(regi_no != '');
    if((regi_no != '') || (roll_no != '') || (classs != '') || (section != ''))
    {
        $.ajax({
        type:"GET",
        url:"{{url('admin/get-student-name')}}?regi_no="+regi_no+"&roll_no="+roll_no+"&classs="+classs+"&section="+section,
        success:function(res){ 
            // alert(res.fees);
            $("#student_name").val(res.name);
            if(res.fees){
            $("#fee_head").empty();
            $("#fee_head").append('<option value="">Select Fee Head</option>');
            $.each(res.fees,function(key,value){
                // alert(key, value);
            $("#fee_head").append('<option value="'+key+'">'+value+'</option>');
            });
            }
            else{
                $("#fee_head").empty();
            }
        }
        })  
    }
   
});

$('#button1').click(function(){
    var paid_amt = $('#paid_amt').val();
    var pay_method = $('#pay_method').val();
    var pay_ref_no = $('#pay_ref_no').val();
    var regi_no = $('#student_regi_no').val();
    var roll_no = $('#roll_no').val();
    var classs = $('#class_name').val();
    var section = $('#section_name').val();
    var due_date = $('#due_date').val();
    var feeHead = [];
    i = 0;
    $('#tbody tr').each(function()
    {
        feeHead[i++] = $(this).attr('id');
    });
    var discount = $('#discount').val();
    var net_amt = $('#net_amt').val();
    var due_amt = $('#due_amt').val();
    if(paid_amt == '')
    {
        $("#amt_err").fadeIn().html("Required");
        setTimeout(function(){ $("#amt_err").fadeOut(); }, 3000);
        $("#paid_amt").focus();
        return false;
    }
    if(pay_method == '')
    {
        $("#method_err").fadeIn().html("Required");
        setTimeout(function(){ $("#method_err").fadeOut(); }, 3000);
        $("#pay_method").focus();
        return false;
    }
    else
    { 
        var datastring="paid_amt="+paid_amt+"&pay_method="+pay_method+"&pay_ref_no="+pay_ref_no+"&feeHead="+feeHead+"&discount="+discount+"&net_amt="+net_amt+"&due_amt="+due_amt+"&regi_no="+regi_no+"&roll_no="+roll_no+"&classs="+classs+"&section="+section+"&due_date="+due_date;
        alert(datastring);
        $.ajax({
            type:"POST",
            url:"{{ route('admin.payment.store') }}",
            data:datastring,
            cache:false,        
            success:function(returndata)
            {
                alert(returndata);
                $("#tbody").empty();
                document.getElementById("submitForm").reset();
                toastr.success(returndata.success);
            
            // location.reload();
            // $("#pay").val("");
            }
        });
    }
})

// var rowIdx = 0; 
$( document ).ready(function() {
$('#fee_head').change(function(){
    var feeID = $(this).val();
    // alert(feeID);
    if(feeID)
    {
        $.ajax({
        type:"GET",
        url:"{{url('admin/get-fee-amount')}}?fee_id="+feeID,
        success:function(res){
            // alert(res);
            var arr = [];
            i = 0;
            var TotalValue = 0;
            $('#tbody tr').each(function()
            {
                arr[i++] = $(this).attr('id');
            });
            // alert(arr);
            if(arr.length == 0)
            {
                $.each(res.fees,function(key,value){
                    $('#tbody').append('<tr id="'+res.id+'"><th class="row-index text-center"><p>'+value+'</p></th><td class="row-index text-center"><p>'+key+'</p></td><th class="text-center"><button class="btn btn-danger btn-sm remove" type="button"><i class="fa fa-times mr-0"></i></button></th></tr>'); 
                })
            }
            else{
                if(arr.includes(res.id) == false){
                    $.each(res.fees,function(key,value){
                    $('#tbody').append('<tr id="'+res.id+'"><th class="row-index text-center"><p>'+value+'</p></th><td class="row-index text-center"><p>'+key+'</p></td><th class="text-center"><button class="btn btn-danger btn-sm remove" type="button"><i class="fa fa-times mr-0"></i></button></td></tr>'); 
                    })
                }
                else{
                    toastr.error("Fee already added in list.");
                }
            }
            $("#tbody td").each(function(index,value){
                currentRow = parseFloat($(this).text());
                TotalValue += currentRow
            });
            $('#total_amt').val(TotalValue);
            $('#net_amt').val(TotalValue);
            $('#due_amt').val(TotalValue);
        }
        })
    }
});
});
$("#paid_amt").keyup(function(){
    var paid_amt = $(this).val();
    var total_amt = $('#total_amt').val();
    var discount = $('#discount').val();
    var due_amt = total_amt - discount - paid_amt;
    $('#due_amt').val(due_amt);
})
$("#discount").keyup(function(){
    var discount = $(this).val();
    var total_amt = $('#total_amt').val();
    var paid_amt = $('#paid_amt').val();
    var due_amt = total_amt - discount;
    if(paid_amt != 0){
    var paid_amt1 = total_amt -discount;
    }
    else{
        var paid_amt1 = paid_amt -discount;
    }
    $('#due_amt').val(due_amt);
    $('#paid_amt').val(paid_amt1);
})
</script>
@endsection