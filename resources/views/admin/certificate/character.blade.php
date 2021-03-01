<!DOCTYPE html>
<html>
<head>
	<title>Character Certificate</title>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" >
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    
    <link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Anton&family=Baskervville&family=Nanum+Myeongjo&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Allura&family=Anton&family=Baskervville&family=Nanum+Myeongjo&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Allura&family=Anton&family=Averia+Libre:wght@300&family=Baskervville&family=Nanum+Myeongjo&display=swap" rel="stylesheet">
    <style>
        @media print {
        button{
            display:none;
        }
        .whole{ border: 10px solid transparent;
        padding: 15px;
        border-image: url("{{ asset('border.png') }}") 30% round; background: #afe1f8;}
        /*header section*/

        .titleName h1{font-size: 3.2em;text-align: center;font-family: 'Anton'}
        .titleName h3{font-size: 1.8em;text-align: center;font-weight: lighter;font-family: 'Nanum Myeongjo', serif;}
        .certHeading h2{float: left;font-size: 2.9em;background: #000;color: #fff;border-radius: 40px;margin: 20px 0 20px 0;
            word-wrap: break-word;padding:5px 20px 5px 20px;font-family: 'Allura', cursive;}
        img{width: 30%;}
        .desc{ font-size: 1.4em; line-height: 2.5;text-align: justify;font-family: 'Averia Libre', cursive;}
        input{border: none;border-bottom: 1px solid #000;background: transparent;}
        .bottomInfo{padding-top: 42px;font-family: 'Averia Libre', cursive;}
        .bottomInfo p{font-size: 1.4em;}
        .photo{width: 100px;height: 120px; border: 1px solid #000;
        }

        }
    </style>
</head>
<body>
	<div class="container whole">
		<form>
			<div class="row">
				<div class="col-12 titleName">
					<h1>DECENT ENGLISH HIGH SCHOOL & JUNIOR COLLEGE</h1>
					<h3>CIVIL LINES , SADAR, NAGPUR - 440001.</h3>
				</div>
			</div>
			<div class="row certHeading">
				<div class="col-4">
					<img src="{{ asset('border.png') }}">
				</div>
				<div class="col-8 text-center ">
					<h2>Character Certificate</h2>
				</div>
			</div>
            <?php 
                $admission = DB::table('junior_admissions')->where('id', $allotmentS->admission_id)->first();
                $academicYear = DB::table('academic_years')->where('id', $admission->academic_id)->first();
            ?>
			<div class="row">
				<div class="col-12 text-right " style="color: red;font-size: 1.3em;">
					<label>200</label>
				</div>
			</div>
			<div class="row ">
				<div class="col desc">
					<p>This is to certify that Mr./Ms. <b>@if(!empty($admission)){{ $admission->student_name }}@endif</b>
						was a student of this Junior College from 
						@if(!empty($academicYear))<b>({{ $academicYear->from_academic_year }}) to ({{ $academicYear->to_academic_year }})</b> @else <input type="" name=""> to <input type="" name=""> @endif . He/She appeared for the S.S.C / H.S.S.C Examination (Arts,Science,Commerce) of Maharshtra Board of Secondary & Higher Secondary Education, Nagpur Div.Nagpur. in 
						<input type="" name="">. He/She Passed in it and was placed in 
						<input type="text" name=""> Division. He/She took keen interest in extra curricular activities like <input type="text" name="">  to the best of my knowledge. He/She bears a good moral character. I wish him/her every success in all walk of life.</p>
				</div>
			</div>

			<div class="row bottomInfo">
				<div class="col-12">
					<p>Nagpur</p>
				</div>
				<div class="col-4">
					<p>Date: <b>{{ date('Y-m-d') }}</b></p>
				</div>
				<div class="col-4 text-center">
					<p>Seal</p>
				</div>
				<div class="col-4 text-right">
					<p>Principal</p>
				</div>
			</div>
		</form>
	</div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 m-auto text-center">
            <button type='button' id='btn' onclick='printDiv();' class="mt-3 btn-primary">Print</button>
            </div>
        </div>
    </div>

    <script>
        function printDiv() 
{

	var css = '@page {  }',
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
    </script>
</body>
</html>