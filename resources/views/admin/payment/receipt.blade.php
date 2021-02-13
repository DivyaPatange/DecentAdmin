<!DOCTYPE html>
<html>
<head>
	<title>fees receipt</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">    
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" >   
    <link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=PT+Sans:ital@1&family=Righteous&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
			width: 50%;
			border: none;
			border-bottom: 1px solid #000;
		}

		.desc{
			font-size: 20px;
			font-style: italic;
			line-height: 2;
			font-family: 'PT Sans', sans-serif;
		}

		#terms{
			font-size: 18px;
			line-height: 1.4;
		}
	</style>
</head>
<body>
<div id="printDiv">
	<div class="container " style="border: 2px solid #000; margin-top:20px;">
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
						<p>Receipt No. <span class="text-danger">{{ $payment->receipt_no }}</span></p>
					</div>
					<div class="col-6 text-right date">
						<p>Date: {{ $payment->payment_date }}</p>
					</div>
				</div>

				<div class="row">
					<div class="col-12 desc">
						<p>Received with thanks from Mast/ Miss 
							<b>{{ $admission->student_name }}</b>
							of class XI/XII the Amount of Rs.(in words) 
							<b>{{ $payment->payment_amount }}</b>
							only towards. Admission Fees / Whole Year Tution Fees/ Part Payment of Tution Fees /Reg. Fees/Misc. Through Cash/ NEFT / Cheque/ D.DNo 
							<input type="" name=""  style="width: 20%;"> Dtd.
							Date: 
							<input type="date" name="" style="width: 20%;border: 0;">
						</p>
					</div>
				</div>

				<div class="row">
					<div class="col-12 rupeesSymbol">
						<label style="border-radius: 4px;background: #ebedee;padding: 0 10px 0 10px">
							<span style='font-size:30px;'><i class="fa fa-inr"></i></span>
						</label>
						<input type="" name="" style="border: 1px solid #000;border-radius: 4px;padding:7px" value="{{ $payment->payment_amount }}">				
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
</div>
<div class="container">
	<div class="row">
		<div class="col-md-2 m-auto">
			<button type='button' id='btn' onclick='printDiv();' class="mt-3">Print</button>
		</div>
</div>
<script>
function printDiv() 
{

  var divToPrint=document.getElementById('printDiv');

  var newWin=window.open('','Print-Window');

  newWin.document.open();

  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

  newWin.document.close();

  setTimeout(function(){newWin.close();},10);

}
</script>
</body>
</html>