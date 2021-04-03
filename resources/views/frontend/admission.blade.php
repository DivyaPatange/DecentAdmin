@extends('frontend.front_layout.main')
@section('title', 'Admission')
@section('customcss')
<style type="text/css">
    .class1{
      font-size: 15px;
    }
</style>
@endsection
@section('content')
<!-- ======= Hero Section ======= -->
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title text-center"><b><a href="">Admission Procedure </a></b></h4>
                    </div>
                    <div class="card-body">
                        <p>There is no written test for admission in Nursery, Lower KG & Upper KG.<br />
                            <ul>
                                <li>Admission to the next upper classes the student has to qualify a written test.</li>
                                <li>registration is no guarantee for admission and registration fee is not refundable.</li>
                            </ul>
                            <strong style="color: Black">Subject for admission test:</strong>
                            <br />
                            Mathematics, English and Hindi<br />
                            <strong style="color: Black">Documents at the time of Admission</strong>
                            <br />
                            <ul>
                                <li>Class NUR - UKG : Bith Certificate, Three passport color photographs.</li>
                                <li>Class I to III : Origional Mark Sheet, Transfer certificate, Three passport color photographs.</li>
                            </ul>
                            <div class="col-md-2"><strong style="color: Red">For Contacts :</strong></div>
                            <div class="col-md-6">
                                <strong style="font-size: 16px;">School Office Time<br />
                                    From 9:00 AM to 4:00 PM.
                                </strong>
                            </div>
                            <div class="col-md-12 text-center">
                                <a href="Files/AdmissionForm.pdf"><button class="btn btn-info">Download Admission Form</button></a>
                            </div>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
@endsection 
@section('customjs')

@endsection