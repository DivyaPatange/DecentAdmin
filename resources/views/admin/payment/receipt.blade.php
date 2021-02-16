<!DOCTYPE html>
<html>
<head>
	<title>fees receipt</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">    
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Catamaran:wght@500&family=Open+Sans&family=Playfair+Display&family=Staatliches&family=Vollkorn:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=PT+Sans:ital@1&family=Righteous&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Catamaran:wght@500&family=Playfair+Display&family=Staatliches&family=Vollkorn:wght@400;700&display=swap" rel="stylesheet">
	<style >

		</style>
		<style type="text/css" media="print">
		@media print 
{
   @page
   {
    size: A4;
    size: landscape;
  }
}
/* 
		body {
  background: rgb(204,204,204); 
}
page {
  background: white;
  display: block;
  margin: 0 auto;
  margin-bottom: 0.5cm;
  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
}
		body {
    page-break-before: avoid;
    width:100%;
    height:100%;
    -webkit-transform: rotate(-90deg) scale(.68,.68); 
    -moz-transform:rotate(-90deg) scale(.58,.58);
    zoom: 200%    }
	page[size="A4"][layout="landscape"] {
  width: 29.7cm;
  height: 21cm;  
}
@media print {
  body, page {
    margin: 0;
    box-shadow: 0;
  }
} */
	</style>
</head>
<body>	
<page size="A4" layout="landscape">			
<div id="printDiv">
	<table style="border: 2px solid #000; width: 100%;
		margin: 0 auto;" >
		<tr >
			<td rowspan="10" style="border-right: 2px solid #000; width:10%" >
				<h1 style=" writing-mode: tb-rl;
			    -webkit-transform: rotate(180deg);
			    -moz-transform: rotate(270deg);
			    -o-transform: rotate(270deg);
			    -ms-transform: rotate(270deg);
			    text-align: center;
			    padding: 0;			   
			    letter-spacing: 18px;
			    font-family: 'Staatliches', cursive; font-size: 62px;"> FEES RECEIPT</h1>
			</td>

			<td colspan="3" class="" style="text-align: center;line-height: .5;border-bottom: 2px solid #000;">			
					
				<img src="{{ asset('border.png') }}" style="width: 10%; float: left;">
			
				<h1 style="font-family: 'Anton'; font-size: 62px;">DECENT JUNIOR COLLEGE</h1>
				<h6 style="font-size: 18px; font-family: 'Open Sans', sans-serif; ">Civil Lines , Sadar, Nagpur - Ph.No.:0712-2539148</h6>
			</td>
				
			
		</tr>
		<tr>
			<td>
				<tr>
					<td colspan="2">
						<p>Receipt No. <span style="color:red">{{ $payment->receipt_no }}</span></p>
					</td>
					<td style="text-align:right;width: 15%; border: 0;">
						<p>Date: {{ $payment->payment_date }}</p>
					</td>
				</tr>
			</td>
		</tr>
		<tr >
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
		?>
			<td colspan="3" style="font-size: 20px;
			font-style: italic;
			line-height: 2;
			font-family: 'PT Sans', sans-serif;">
				<p>Received with thanks from Mast/ Miss 
				<b>{{ $admission->student_name }}</b>
					of class XI/XII the Amount of Rs.(in words) 
					<b>{{ $Rupees }} Only</b>
					only towards. Admission Fees / Whole Year Tution Fees/ Part Payment of Tution Fees /Reg. Fees/Misc. Through Cas/ NEFT / Cheque/ D.DNo 
					<input type="" name=""  style="width: 20%;"> Dtd.
					Date: 
					<input type="" name="" style="width: 10%;border: 0;">/<input type="" name="" style="width: 10%;border: 0;">/<input type="" name="" value="20" style="width: 10%;border: 0;"> .
				</p>
			</td>
		</tr>
		<tr >
			<td colspan="3" class=" rupeesSymbol">
				<label style="border-radius: 4px;background: #ebedee;padding: 17px 20px 10px 20px;margin-right: 10px;" >
					<span style='font-size:30px;'>&#8377;</span>
				</label>
				<input type="" name="" value="{{ $payment->payment_amount }}" readonly style="border: 1px solid #000;border-radius: 4px;padding:15px 0 0 10px">				
			</td>
		</tr>
		
		<tr style="border-bottom: 2px solid #000;">
			<td style="width: 60%; font-size: 20px;
			font-style: italic;
			line-height: 2;
			font-family: 'PT Sans', sans-serif; font-size: 18px;
			line-height: 1.4;">
				<ul style="padding-left:16px">
					<li>Fees Non-refundable under any circumstances.</li>
					<li>Non-transferable</li>
					<li>Payment through Cheque, subject to encashment</li>
				</ul>
			</td>
			<td style="text-align: center; font-family: 'Open Sans', sans-serif; ">
				<h4>Seal</h4>
			</td>
			<td style="text-align: right; font-family: 'Open Sans', sans-serif; ">
				<h4>Cashier</h4>
			</td>
		</tr>	
				
		
	</table>
</div>


<div class="container">
	<div class="row">
		<div class="col-md-2 m-auto">
			<button type='button' id='btn' onclick='printDiv();' class="mt-3">Print</button>
		</div>
</div>
</page>
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