@extends('frontend.front_layout.main')
@section('title', 'Contact')
@section('customcss')
<style type="text/css">
    .class1{
      font-size: 15px;
    }
</style>
@endsection
@section('content')
<!-- ======= Hero Section ======= -->
<main id="main">
    <!-- ======= Contact Section ======= -->
    <div class="map-section">
        <iframe style="border:0; width: 100%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3720.7670177203117!2d79.0692475144096!3d21.161668188604743!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bd4c0fc0a91e751%3A0x7e917b4288a60389!2sDecent%20English%20High%20School!5e0!3m2!1sen!2sus!4v1617355999323!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
    <section id="contact" class="contact">
        <div class="container">
            <div class="row justify-content-center" data-aos="fade-up">
                <div class="col-lg-10">
                    <div class="info-wrap">
                        <div class="row">
                            <div class="col-lg-4 info">
                                <i class="icofont-google-map"></i>
                                <h4>Location:</h4>
                                <p>Opp. Sheetla Mata Mandir,
                                    <br>Civil Lines, Sadar,<br>
                                    Nagpur, Maharashtra
                                </p>
                            </div>
                            <div class="col-lg-4 info mt-4 mt-lg-0">
                                <i class="icofont-envelope"></i>
                                <h4>Email:</h4>
                                <p>info@example.com<br>contact@example.com</p>
                            </div>
                            <div class="col-lg-4 info mt-4 mt-lg-0">
                                <i class="icofont-phone"></i>
                                <h4>Call:</h4>
                                <p>0712- 2539148</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5 justify-content-center" data-aos="fade-up">
                <div class="col-lg-10">
                    <form action="#" method="post" role="form" class="php-email-form">
                        <div class="form-row">
                            <div class="col-md-6 form-group">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                                <div class="validate"></div>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                                <div class="validate"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                            <div class="validate"></div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                            <div class="validate"></div>
                        </div>
                        <div class="mb-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                        </div>
                        <div class="text-center"><button type="submit">Send Message</button></div>
                    </form>
                </div>
            </div>
        </div>
    </section><!-- End Contact Section -->
</main><!-- End #main -->
@endsection 
@section('customjs')

@endsection