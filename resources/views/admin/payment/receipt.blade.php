<!DOCTYPE html>
<html>
<head>
	<title>fees receipt</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">    
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" >   
    <link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=PT+Sans:ital@1&family=Righteous&display=swap" rel="stylesheet">
	<style >
	.vertically{
        writing-mode:tb-rl;
        -webkit-transform:rotate(180deg);
        -moz-transform:rotate(180deg);
        -o-transform: rotate(180deg);
        -ms-transform:rotate(180deg);
        transform: rotate(180deg);
        text-align: center;
        padding: 0;
        border-left: 2px solid #000;
        
    }
    .vertically h1{
        letter-spacing: 16px;
        font-size: 54px;
        font-family: 'Anton';
        margin: 0;
    }
    img{width: 30%;}
    .title{
        border-bottom: 2px solid #000;

    }

    .title h1{
        font-size: 62px;
    }

    .date input{
        width: 10%;
        border: 0;
    }

    input{
        /* width: 50%; */
        border: none;
        border-bottom: 1px solid #000;
    }

    .desc{
        font-size: 20px;
        font-style: italic;
        line-height: 2;
        font-family: 'PT Sans', sans-serif;
    }
    .hidden{
        display:none;
    }
    #terms{
        font-size: 18px;
        line-height: 1.4;
    }
    @media print {
    h1 {
        font-size: 45px !important;
    }
    button{
        display:none;
    }
    .container{
        width:60% !important;
    }
    }
	</style>
</head>
<body>
	<form>
		<div class="container " style="border: 2px solid #000;">
			<div class="row">
				<div class="col-1 vertically ">
					<h1>FEES RECEIPT</h1>
				</div>

				<div class="col-11 ">
					<div class="row title" >
						<div class="col-12">
							<div class="row">
								<div class="col-3 text-center">
									<img src="{{ asset('border.png') }}">
								</div>
								<div class="col-9 text-center">
									<h1 style="font-family: 'Anton'">DECENT JUNIOR COLLEGE</h1>
									<h6>Civil Lines , Sadar, Nagpur - Ph.No.:0712-2539148</h6>
								</div>
							</div>							
						</div>
					</div>
					<div class="row py-4">
						<div class="col-6">
							<p>Receipt No. <span style="color:red">{{ $payment->receipt_no }}</span></p></p>
						</div>
						<div class="col-6 text-right date">
							<p>Date: {{ $payment->payment_date }}</p>
						</div>
					</div>
                    <?php 
                        $no = round($payment->payment_amount);
                        $decimal = round($payment->payment_amount - ($no = floor($payment->payment_amount)), 2) * 100;    
                        $digits_length = strlen($no);  
                        $i = 0;
                        $str = array();
                        $words = array(
                            0 => '',
                            1 => 'One',
                            2 => 'Two',
                            3 => 'Three',
                            4 => 'Four',
                            5 => 'Five',
                            6 => 'Six',
                            7 => 'Seven',
                            8 => 'Eight',
                            9 => 'Nine',
                            10 => 'Ten',
                            11 => 'Eleven',
                            12 => 'Twelve',
                            13 => 'Thirteen',
                            14 => 'Fourteen',
                            15 => 'Fifteen',
                            16 => 'Sixteen',
                            17 => 'Seventeen',
                            18 => 'Eighteen',
                            19 => 'Nineteen',
                            20 => 'Twenty',
                            30 => 'Thirty',
                            40 => 'Forty',
                            50 => 'Fifty',
                            60 => 'Sixty',
                            70 => 'Seventy',
                            80 => 'Eighty',
                            90 => 'Ninety');
                        $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
                        while ($i < $digits_length) {
                            $divider = ($i == 2) ? 10 : 100;
                            $number = floor($no % $divider);
                            $no = floor($no / $divider);
                            $i += $divider == 10 ? 1 : 2;
                            if ($number) {
                                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;            
                                $str [] = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] . $plural : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural;
                            } else {
                                $str [] = null;
                            }  
                        }
                        $Rupees = implode(' ', array_reverse($str));
                        // dd($Rupees); 
                        $feeHead = DB::table('fee_heads')->where('id', $payment->fee_id)->first();
                    ?>
					<input type="hidden" name="payment_id" value="{{ $payment->id }}">
					<div class="row">
						<div class="col-12 desc">
							<p>Received with thanks from Mr./ Miss 
                            <b>{{ $admission->student_name }}</b>
								of class <b>{{ $admission->adm_sought }}</b> the Amount of Rs.(in words) 
								<b>{{ $Rupees }} Only</b>
								only towards. @if(!empty($feeHead)){{ $feeHead->fee_head }}@endif Through @if(!empty($payment->pay_by)) {{ $payment->pay_by }} @else Cash <input type="radio" class="" name="pay_by" value="Cash" checked>/ NEFT <input type="radio" class="" name="pay_by" value="NEFT">/ Cheque <input type="radio" class="" name="pay_by" value="Cheque">/ D.D. No <input type="radio" class="" name="pay_by" value="DD No">
					<span class="hidden showDiv"><input type="text" name="pay_no"  style="width: 20%;"></span>@endif @if(!empty($payment->pay_by_no)) {{ $payment->pay_by_no }} @endif Dtd. @if(!empty($payment->pay_by_date)) {{ $payment->pay_by_date }} @else<span id="hideDiv">{{ $payment->payment_date }} </span>
					<span class="showDiv hidden"><input type="date" name="pay_date" style=""></span>@endif.
							</p>
						</div>
					</div>

					<div class="row">
						<div class="col-12 rupeesSymbol">
							<label style="border-radius: 4px;background: #ebedee;padding: 0 10px 0 10px">
								<span style='font-size:30px;'>&#8377;</span>
							</label>
							<input type="" name="" value="{{ $payment->payment_amount }}" readonly style="border: 1px solid #000;border-radius: 4px;padding:8px 10px">				
						</div>
					</div>
					
					<div class="row">
						<div class="col-6 desc align-self-end" id="terms">
							<ul class="pl-3">
								<li>Fees Non-refundable under any circumstances.</li>
								<li>Non-transferable</li>
								<li>Payment through Cheque, subject to encashment</li>
							</ul>
						</div>
						<div class="col-3 text-center align-self-end">
							<h4>Seal</h4>
						</div>
						<div class="col-3 text-center align-self-end">
							<h4>Cashier</h4>
						</div>
					</div>

				</div>
			</div>
		</div>
		

	</form>
    <div class="container">
	<div class="row">
		<div class="col-md-2 m-auto">
			@if(!empty($payment->pay_by) && !empty($payment->pay_by_date))
			<button type='button' id='btn' onclick='printDiv();' class="mt-3 btn-primary">Print</button>
			@else
			<button type='button' id='btn' onclick='printDiv();' disabled class="mt-3 btn-primary">Print</button>
            <button type='button' id='btn' onclick="submitForm()" class="mt-3 btn-success">Save</button>
			@endif
		</div>
</div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
</script>
<script>
function printDiv() 
{

	var css = '@page { size: landscape; }',
    head = document.head || document.getElementsByTagName('head')[0],
    style = document.createElement('style');

style.type = 'text/css';
style.media = 'print';

if (style.styleSheet){
  style.styleSheet.cssText = css;
} else {
  style.appendChild(document.createTextNode(css));
}

head.appendChild(style);

window.print();
//   var divToPrint=document.getElementById('printDiv');

//   var newWin=window.open('','Print-Window');

//   newWin.document.open();

//   newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

//   newWin.document.close();

//   setTimeout(function(){newWin.close();},10);

}
$("input[name='pay_by']").change(function(){
    var query = $(this).val();
	if(query == "Cash")
	{
		$('.showDiv').hide();
		$('#hideDiv').show();
	}
	else{
		$('.showDiv').show();
		$('#hideDiv').hide();
	}
});

function submitForm() {
    var pay_by = $("input[name='pay_by']:checked").val(); 
    var pay_by_no = $("input[name='pay_no']").val();
	var pay_date = $("input[name='pay_date']").val();
	var id = $("input[name='payment_id']").val();
	if(pay_date == "")
	{
		pay_date = $("#hideDiv").text();
	}
	// alert(pay_date);
	$.ajax({
		url: "{{ route('admin.receipt.save') }}",
		method: "POST",
		data: {pay_by:pay_by, pay_by_no:pay_by_no, pay_date:pay_date, id:id},
		success: function(data){
			console.log(data);
			$('.btn-primary').removeAttr("disabled");
			$(".btn-success").attr("disabled","");
			alert('Record Saved Successfully');
		}
	});
    
}
</script>
</body>
</html>