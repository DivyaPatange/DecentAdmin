<!DOCTYPE html>
<html>
<head>
	<title>Leaving Certificate</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" >
    <link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Candal&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Candal&family=Lemonada:wght@300&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Candal&family=Inter&family=Lemonada:wght@300&display=swap" rel="stylesheet">
    <style>

    	.container{
    		max-width: 1024px;
    		margin: 0 auto;
    		font-family: 'Inter', sans-serif;
    		background-color:rgba(170, 243, 199,.4);

    	}
		h1{
			font-size: 56px;
		}
    	.header{
    		width: 100%;
    		text-align: center;
    		color: #000;
    		border-bottom: 2px solid #000;
    		line-height: .4;
    	}
    	.content{
    		width: 33%;
    		float: left;
    		padding-top: 32px;
    	}
    	input{
    		background: transparent;
    		width: 24%;
    		border: none;
    		border-bottom: 1px solid #000;
    	}
    	#highlight{
    		font-weight: bold;
    	}
    	.belowContent{
    		
    	}
    	.below{
    		width: 25%;
    		float: left;

    	}
    	.clear{
    		clear: both;
    	}
    	.mainInfo h3{
    		background-color: #000;
    		padding: 5px 10px 5px 10px;
    		border-radius: 8px;
    		margin: 0 auto;
    		color: #fff;
    		width: 50%;
    		text-align: center;
    	}
    	.mainInfo{
    		text-align: justify;
    		line-height: 2;
    	}
    	.footer{
    		padding-top: 100px;
    	}
		@media print {
		button{
			display:none;
		}
		h1{
			font-size:30px;
		}
		h4{
			font-size: 1rem;
		}
		h2{
			font-size:1.5rem;
		}
		#hide{
			display:none;
		}
		label{
			line-height:1px;
		}
    }
    </style>
</head>
<body>

<form method="POST">
	<div class="container">
		<div class="header">
			<h1 style="font-family: 'Candal', sans-serif;">DECENT JUNIOR COLLEGE</h1>
			<h4>CIVIL LINES , SADAR , NAGPUR-440001.</h4>
			<p style="font-style: italic;font-family: 'Lemonada', cursive">Under the management of</p>
			<h2 style="font-family: 'Candal', sans-serif;">THE BRIGHT CAREER EDUCATION SOCIETY</h2>
			<h4 id="hide">CIVIL LINES , SADAR , NAGPUR-440001.</h4>
		</div>
		<div class="content">
			<p >Phone No.: <label id="highlight"> 0712-2539148</label></p>
		</div>
		<div class="content">
			<p>Email: <label id="highlight"> dehs.abid@yahoo.com</label></p>
		</div>
		<div class="content">
			<p>Sr. No.: <span class="text-danger">{{ $leavingCertificate->certificate_no }}</span></p>
		</div>
		<div class="clear"></div>
		<div class="belowContent">
			<p>General Reg.No.: <input type="text" name="gen_reg_no" value="{{ $leavingCertificate->general_reg_no }}"> College Recognisation No.:<span id="highlight"> HSC/1708/(183/08)</span> अ /उमाशि-1 दि.10 जुलै 2008 <br>
				<div class="below">
					Medium: <span id="highlight">English</span>
					</div>
			<div class="below"> 
				U.Disc No.: <span id="highlight">27091508403</span>
			</div>
			<div class="below">
				Board: <span id="highlight"> NAGPUR DIV. BOARD</span>
			</div>
			<div class="below">
				Index No.: <span id="highlight">06.01.151 </p></span>
			</div>
		</div>
        <?php 
            $admission = DB::table('junior_admissions')->where('id', $allotmentS->admission_id)->first();
            $allotment = DB::table('allotments')->where('id', $allotmentS->allotment_id)->first(); 
        ?>
		<div class="clear"></div>
		<div class="mainInfo">
			<h3>COLLEGE LEAVING CERTIFICATE</h3>
			<label>Student ID.</label>
			 <b>{{ $admission->collage_ID }}</b>
			<br>

			<label>U.I.D.No.(Adhar Card No.)</label>
			 <b>{{ $admission->adhaar_no }}</b>
			<br>
			<br>

			<label>Full Name of the Student: </label>
			<input type="text" name="" readonly value="{{ $admission->student_name }}">
            <br>
			<label>Mother's Name:</label>
			<input type="text" name="" readonly value="{{ $admission->mother_name }}">

			<label>Nationality:	</label>
			<label id="highlight">INDIAN</label>
			<br>

			<label>Religion: </label>
			<input type="text" name="" readonly value="{{ $admission->religion }}">

			<label>Mother Tongue:</label>
			<input type="text" name="mother_tongue" @if($leavingCertificate->mother_tongue != "") readonly @endif value="{{ $leavingCertificate->mother_tongue }}">

			<label>Caste:</label>
			<input type="text" name="" readonly value="{{ $admission->caste }}">

			<label>Sub-caste: </label>
			<input type="text" name="" readonly value="{{ $admission->sub_caste }}">

			<label>Birth place(Town/City):</label>
			<input type="text" name="birth_place" @if($leavingCertificate->birth_place != "") readonly @endif value="{{ $leavingCertificate->birth_place }}">

			<label>Taluka:</label>
			<input type="text" name="taluka" style="width: 15%;" @if($leavingCertificate->taluka != "") readonly @endif value="{{ $leavingCertificate->taluka }}">

			<label>District:</label>
			<input type="text" name="district" @if($leavingCertificate->district != "") readonly @endif value="{{ $leavingCertificate->district }}">

			<label>State:</label>
			<input type="text" name="state" @if($leavingCertificate->state != "") readonly @endif value="{{ $leavingCertificate->state }}">

			<label>Country:</label>
			<input type="text" name="country" @if($leavingCertificate->country != "") readonly @endif value="{{ $leavingCertificate->country }}">

			<label>Date of Birth:</label>
			<input type="date" name="" readonly value="{{ $admission->date_of_birth }}">

			<label>Date of Birth(in words):</label>
			<input type="text" name="" style="width: 44%;" readonly value="{{ date('F d Y', strtotime($admission->date_of_birth)) }}">
			<br>

			<label>Previous School :</label>
			<input type="text" name="" style="width: 50%;" readonly value="{{ $admission->last_school_attended }}">

			<label>Class:</label>
			<input type="text" name="" style="width: 20%;" readonly value="{{ $admission->last_exam_passed }}">

			<label>Date of Admission in this college:</label>
			<input type="text" name="" style="width: 40%;" readonly value="{{ $admission->admission_date }}">

			<label>Class:</label>
			<input type="text" name="" style="width: 20%;" readonly value="{{ $admission->adm_sought }}">

			<label>Academic Progress:</label>
			<input type="text" name="academic_progress" @if($leavingCertificate->academic_progress != "") readonly @endif value="{{ $leavingCertificate->academic_progress }}">

			<label>Conduct:</label>
			<input type="text" name="conduct" style="width: 10%;" @if($leavingCertificate->conduct != "") readonly @endif value="{{ $leavingCertificate->conduct }}">

			<label>Date of leaving the college:</label>
			<input type="date" name="leaving_date" style="width: 20%;" @if($leavingCertificate->leaving_date != "") readonly @endif value="{{ $leavingCertificate->leaving_date }}">

			<label>In which college studying and since when (In words and figure):</label>
			<input type="text" name="college_studying" style="width: 100%;" @if($leavingCertificate->college_studying != "") readonly @endif value="{{ $leavingCertificate->college_studying }}">

			<label>Reason for leaving the college:</label>
			<input type="text" name="leaving_reason" style="width: 100%;" @if($leavingCertificate->leaving_reason != "") readonly @endif value="{{ $leavingCertificate->leaving_reason }}">

			<label>Remarks:</label>
			<input type="text" name="remarks" style="width: 93%;" @if($leavingCertificate->remarks != "") readonly @endif value="{{ $leavingCertificate->remarks }}">

			<p>Certificate is issued according to the information given in General Register No.1 .</p>
			
			<label>Date:</label>
			<input type="" name="day" @if($leavingCertificate->mother_tongue != "") readonly @endif value="{{ $leavingCertificate->mother_tongue }}">

			<label>Month:</label>
			<input type="" name="month" @if($leavingCertificate->mother_tongue != "") readonly @endif value="{{ $leavingCertificate->mother_tongue }}">

			<label>Year:</label>
			<input type="" name="year" @if($leavingCertificate->mother_tongue != "") readonly @endif value="{{ $leavingCertificate->mother_tongue }}">

		</div>

		<div class="footer">
			<div class="content" style="text-align: center;">
				<h5 style="font-weight: bold;text-decoration: underline;">Class Teacher</h5>
			</div>
			<div class="content" style="text-align: center;">
				<h5 style="font-weight: bold;text-decoration: underline;">Writer</h5>
			</div>
			<div class="content" style="text-align: center;">
				<h5 id="highlight">Headmistress/Principal <br>
					(Sign.with Stamp)
				</h5>
			</div>
			<p><label id="highlight">Note:</label>
			Legal action will be taken if unauthorised changes are made in this College Leaving Certificate.</p>
		</div>
	</div>
	<input type="hidden" name="admission_id" value="{{ $admission->id }}">
	<input type="hidden" name="allot_student_id" value="{{ $allotmentS->id }}">
</form>
<div class="container-fluid">
	<div class="row mb-3">
		<div class="col-md-2 m-auto text-center">
			@if(!empty($leavingCertificate))
			<button type='button' id='btn' onclick='printDiv();' class="mt-3 btn-primary">Print</button>
			@else
			<button type='button' id='btn' onclick='printDiv();' disabled class="mt-3 btn-primary">Print</button>
            <button type='button' id='btn' onclick="submitForm()" class="mt-3 btn-success">Save</button>
			@endif
		</div>
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

	var css = '@page { size: portrait; }',
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
function submitForm() {
    var general_reg_no = $("input[name='gen_reg_no']").val(); 
    var mother_tongue = $("input[name='mother_tongue']").val();
	var birth_place = $("input[name='birth_place']").val();
	var taluka = $("input[name='taluka']").val();
	var district = $("input[name='district']").val();
	var state = $("input[name='state']").val();
	var country = $("input[name='country']").val();
	var academic_progress = $("input[name='academic_progress']").val();
	var conduct = $("input[name='conduct']").val();
	var leaving_date = $("input[name='leaving_date']").val();
	var college_studying = $("input[name='college_studying']").val();
	var leaving_reason = $("input[name='leaving_reason']").val();
	var remarks = $("input[name='remarks']").val();
	var day = $("input[name='day']").val();
	var month = $("input[name='month']").val();
	var year = $("input[name='year']").val();
	var admission_id = $("input[name='admission_id']").val();
	var allot_student_id = $("input[name='allot_student_id']").val();
	// alert(remarks);
	$.ajax({
		url: "{{ route('admin.junior-leaving.save') }}",
		method: "POST",
		data: {general_reg_no:general_reg_no, mother_tongue:mother_tongue, birth_place:birth_place, taluka:taluka, district:district, state:state, country:country,academic_progress:academic_progress,conduct:conduct,leaving_date:leaving_date,college_studying:college_studying,remarks:remarks,day:day,month:month, year:year, leaving_reason:leaving_reason, admission_id:admission_id,allot_student_id:allot_student_id},
		success: function(data){
			console.log(data);
			if(data == 1){
			$('.btn-primary').removeAttr("disabled");
			$(".btn-success").attr("disabled","");
			alert('Record Saved Successfully');
			$("body").load("{{ route('admin.junior-leaving.certificate', $allotmentS->id) }}");
			}
		}
	});
    
}
</script>
</body>
</html>