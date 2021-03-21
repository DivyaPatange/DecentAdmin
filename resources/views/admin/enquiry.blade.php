<!DOCTYPE html>
<html lang="en">

<head>
    <title>Mega Able bootstrap admin template by Phoenixcoded</title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
      <!-- Meta -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="description" content="Gradient Able Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
      <meta name="keywords" content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
      <meta name="author" content="Phoenixcoded" />
      <!-- Favicon icon -->

      <link rel="icon" href="{{ asset('files/assets/images/favicon.ico') }}" type="image/x-icon">
      <!-- Google font-->     
      <link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet">
      <!-- Required Fremwork -->
      <link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/bootstrap/css/bootstrap.min.css') }}">
      <!-- waves.css -->
      <link rel="stylesheet" href="{{ asset('files/assets/pages/waves/css/waves.min.css') }}" type="text/css" media="all">
      <!-- themify-icons line icon -->
      <link rel="stylesheet" type="text/css" href="{{ asset('files/assets/icon/themify-icons/themify-icons.css') }}">
      <!-- ico font -->
      <link rel="stylesheet" type="text/css" href="{{ asset('files/assets/icon/icofont/css/icofont.css') }}">
      <!-- Font Awesome -->
      <link rel="stylesheet" type="text/css" href="{{ asset('files/assets/icon/font-awesome/css/font-awesome.min.css') }}">
      <!-- Style.css -->
      <link rel="stylesheet" type="text/css" href="{{ asset('files/assets/css/style.css') }}">
  </head>

  <body themebg-pattern="theme1">
  <!-- Pre-loader start -->
  <div class="theme-loader">
      <div class="loader-track">
          <div class="preloader-wrapper">
              <div class="spinner-layer spinner-blue">
                  <div class="circle-clipper left">
                      <div class="circle"></div>
                  </div>
                  <div class="gap-patch">
                      <div class="circle"></div>
                  </div>
                  <div class="circle-clipper right">
                      <div class="circle"></div>
                  </div>
              </div>
              <div class="spinner-layer spinner-red">
                  <div class="circle-clipper left">
                      <div class="circle"></div>
                  </div>
                  <div class="gap-patch">
                      <div class="circle"></div>
                  </div>
                  <div class="circle-clipper right">
                      <div class="circle"></div>
                  </div>
              </div>
            
              <div class="spinner-layer spinner-yellow">
                  <div class="circle-clipper left">
                      <div class="circle"></div>
                  </div>
                  <div class="gap-patch">
                      <div class="circle"></div>
                  </div>
                  <div class="circle-clipper right">
                      <div class="circle"></div>
                  </div>
              </div>
            
              <div class="spinner-layer spinner-green">
                  <div class="circle-clipper left">
                      <div class="circle"></div>
                  </div>
                  <div class="gap-patch">
                      <div class="circle"></div>
                  </div>
                  <div class="circle-clipper right">
                      <div class="circle"></div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- Pre-loader end -->
  <section class="login-block">
        <!-- Container-fluid starts -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block mt-3">
                        <button type="button" class="close" data-dismiss="alert">×</button>	
                            <strong><i class="fa fa-check text-white">&nbsp;</i>{{ $message }}</strong>
                    </div>
                    @endif
                    @if ($message = Session::get('danger'))
                    <div class="alert alert-danger alert-block mt-3">
                        <button type="button" class="close" data-dismiss="alert">×</button>	
                            <strong>{{ $message }}</strong>
                    </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <form class="md-float-material form-material" method="POST" action="{{ route('enquiry.submit') }}">
                    @csrf
                        <div class="text-center">
                            <!-- <img src="../files/assets/images/logo.png" alt="logo.png"> -->
                            <!-- <h2>Dece</h2> -->
                        </div>
                        <div class="auth-box card">
                            <div class="card-block">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-center txt-primary">Enquiry Form</h3>
                                    </div>
                                </div>
                                <div class="form-group form-primary">
                                    <input type="text" name="student_name" id="student_name" class="form-control">
                                    <span class="form-bar"></span>
                                    <label class="float-label">Student Name <span class="text-danger" id="student_err"></span></label>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group form-primary">
                                            <input type="text" name="father_name" id="father_name" class="form-control">
                                            <span class="form-bar"></span>
                                            <label class="float-label">Father Name <span class="text-danger" id="father_err"></span></label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group form-primary">
                                            <input type="text" name="mother_name" id="mother_name" class="form-control">
                                            <span class="form-bar"></span>
                                            <label class="float-label">Mother Name <span class="text-danger" id="mother_err"></span></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group form-primary">
                                            <input type="date" name="dob" id="dob" class="form-control">
                                            <span class="form-bar"></span>
                                            <label class="float-label">Date of Birth <span class="text-danger" id="dob_err"></span></label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group form-primary">
                                            <input type="number" name="contact_no" id="contact_no" class="form-control">
                                            <span class="form-bar"></span>
                                            <label class="float-label">Contact No. <span class="text-danger" id="contact_err"></span></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-primary">
                                    <input type="text" name="address" id="address" class="form-control">
                                    <span class="form-bar"></span>
                                    <label class="float-label">Address <span class="text-danger" id="address_err"></span></label>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <?php 
                                            $standard = DB::table('classes')->orderBy('id', 'DESC')->get();
                                        ?>
                                        <div class="form-group form-primary">
                                            <select name="last_exam_passed" id="last_exam_passed" class="form-control">
                                                <option value="">-Select-</option>
                                                @foreach($standard as $s)
                                                <option value="{{ $s->id }}">{{ $s->class_name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="form-bar"></span>
                                            <label class="float-label">Last Exam Passed <span class="text-danger" id="exam_err"></span></label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group form-primary">
                                            <input type="text" name="percentage" id="percentage" class="form-control">
                                            <span class="form-bar"></span>
                                            <label class="float-label">Percentage <span class="text-danger" id="percentage_err"></span></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-primary">
                                    <select name="adm_sought" id="adm_sought" class="form-control">
                                        <option value="">-Select-</option>
                                        @foreach($standard as $s)
                                        <option value="{{ $s->id }}">{{ $s->class_name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="form-bar"></span>
                                    <label class="float-label">Class in which Admission Sought <span class="text-danger" id="adm_err"></span></label>
                                </div>
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button type="button" id="submitForm" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Submit</button>
                                    </div>
                                </div>
                                <hr/>
                                <div class="row">
                                    <div class="col-md-10">
                                        <p class="text-inverse text-left m-b-0">Thank you.</p>
                                        <p class="text-inverse text-left"><a href="index.html"><b>Back to website</b></a></p>
                                    </div>
                                    <div class="col-md-2">
                                        <img src="../files/assets/images/auth/Logo-small-bottom.png" alt="small-logo.png">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </section>
    
<!-- Required Jquery -->
<script type="text/javascript" src="{{ asset('files/bower_components/jquery/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('files/bower_components/jquery-ui/js/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('files/bower_components/popper.js/js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('files/bower_components/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- waves js -->
<script src="{{ asset('files/assets/pages/waves/js/waves.min.js') }}"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="{{ asset('files/bower_components/jquery-slimscroll/js/jquery.slimscroll.js') }}"></script>
<!-- modernizr js -->
<script type="text/javascript" src="{{ asset('files/bower_components/modernizr/js/modernizr.js') }}"></script>
<script type="text/javascript" src="{{ asset('files/bower_components/modernizr/js/css-scrollbars.js') }}"></script>
<!-- i18next.min.js -->
<script type="text/javascript" src="{{ asset('files/bower_components/i18next/js/i18next.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('files/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('files/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('files/bower_components/jquery-i18next/js/jquery-i18next.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('files/assets/js/common-pages.js') }}"></script>
<script>
$('body').on('click', '#submitForm', function () {
    var student_name = $("#student_name").val();
    var father_name = $("#father_name").val();
    var mother_name = $("#mother_name").val();
    var dob = $("#dob").val();
    var contact_no = $("#contact_no").val();
    var address = $("#address").val();
    var last_exam_passed = $("#last_exam_passed").val();
    var percentage = $("#percentage").val();
    var adm_sought = $("#adm_sought").val();
    if (student_name=="") {
        $("#student_err").fadeIn().html("Required");
        setTimeout(function(){ $("#student_err").fadeOut(); }, 3000);
        $("#student_name").focus();
        return false;
    }
    if (father_name=="") {
        $("#father_err").fadeIn().html("Required");
        setTimeout(function(){ $("#father_err").fadeOut(); }, 3000);
        $("#father_name").focus();
        return false;
    }
    if (mother_name=="") {
        $("#mother_err").fadeIn().html("Required");
        setTimeout(function(){ $("#mother_err").fadeOut(); }, 3000);
        $("#mother_name").focus();
        return false;
    }
    if (dob=="") {
        $("#dob_err").fadeIn().html("Required");
        setTimeout(function(){ $("#dob_err").fadeOut(); }, 3000);
        $("#dob").focus();
        return false;
    }
    if (contact_no=="") {
        $("#contact_err").fadeIn().html("Required");
        setTimeout(function(){ $("#contact_err").fadeOut(); }, 3000);
        $("#contact_no").focus();
        return false;
    }
    if (address=="") {
        $("#address_err").fadeIn().html("Required");
        setTimeout(function(){ $("#address_err").fadeOut(); }, 3000);
        $("#address").focus();
        return false;
    }
    if (last_exam_passed=="") {
        $("#exam_err").fadeIn().html("Required");
        setTimeout(function(){ $("#exam_err").fadeOut(); }, 3000);
        $("#last_exam_passed").focus();
        return false;
    }
    if (percentage=="") {
        $("#percentage_err").fadeIn().html("Required");
        setTimeout(function(){ $("#percentage_err").fadeOut(); }, 3000);
        $("#percentage").focus();
        return false;
    }
    if (adm_sought=="") {
        $("#adm_err").fadeIn().html("Required");
        setTimeout(function(){ $("#adm_err").fadeOut(); }, 3000);
        $("#adm_sought").focus();
        return false;
    }
    else{
        $('.form-material').submit()
    }
})
</script>
</body>

</html>
