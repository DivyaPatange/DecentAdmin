@extends('frontend.front_layout.main')
@section('title', 'Index')
@section('customcss')
<style type="text/css">
  /*top bar*/
    @media only screen and (max-width: 600px) 
    {
    .social-links{
      display: none;
      }
    }
    .client-img {
      width: 120px;
      height: 120px;
      overflow: hidden;
      border: 4px solid #fff;
      margin: 0px auto 20px;
      border-radius: 100%;
    }
    .carousel-content {
      padding: 50px 0px;
    }
    .carousel-content h3 span {
      font-size: 17px;
      font-weight: normal;
      color: #e8e8e8;
      text-transform: uppercase;
    }
    .client-img img {
        width: 100%;
    }
    #testimonial {
        text-align: center;
        padding: 40px 0px;
    /*color: #fff;*/
    }
    #testimonial .carousel-control-prev,
    #testimonial .carousel-control-next {
      font-size: 36px;
    }
    #testimonial h2 {
        font-size: 40px;
        font-style: italic;
        border-bottom: 1px solid #7fbdff;
        padding-bottom: 20px;
        display: inline-block;
    }
    .class1{
      font-size: 15px;
   
    }
</style>
@endsection
@section('content')
 <!-- ======= Hero Section ======= -->
 <section id="hero">
      <div id="heroCarousel" class="carousel slide carousel-fade" data-ride="carousel">

        <div class="carousel-inner" role="listbox">

          <!-- Slide 1 -->
          <div class="carousel-item active" style="background-image: url('{{ asset('frontAsset/assets/img/slide/d1.jpeg') }}');">
          </div>

          <!-- Slide 2 -->
          <div class="carousel-item" style="background-image: url('{{ asset('frontAsset/assets/img/slide/d2.jpeg') }}');">
          </div>

          <!-- Slide 3 -->
          <div class="carousel-item" style="background-image: url('{{ asset('frontAsset/assets/img/slide/d4.jpeg') }}');">
          </div>

        </div>

        <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon bx bx-left-arrow" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>

        <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
          <span class="carousel-control-next-icon bx bx-right-arrow" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>

        <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

      </div>
    </section><!-- End Hero -->

    <main id="main">

    <!-- ======= Cta Section ======= -->
      <section id="cta" class="cta">
        <div class="container">
          <ul class="nav nav-pills mb-3 nav-fill" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
              <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">News & Events</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Notice & Circular</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Schedules</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Student Activity</a>
            </li>
          </ul>
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">...</div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">...</div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
          </div>
        </div>
      </section><!-- End Cta Section -->

      <!-- ======= About Section ======= -->
      <section>
        <div class="container">
            <!-- <div class="icon-box" data-aos="fade-up" data-aos-delay="100"> -->
          <div class="col-lg-12 col-md-12">
            <div class="row">
              <div class="col-lg-8 col-md-8">
                <h4 class="text-center"><a href="">About School</a></h4><br>
                <img class="img-responsive float-left pr-3" src="{{ asset('frontAsset/assets/img/school.jpeg') }}" width="300px">
                <p class="text-justify class1">
                  Decent English High School's location is at Sadar, Nagpur. It is a State Board school, with a team of 9 dedicated and professional faculties, which are here to ensure that the children get the most from their education.<br>
                  1971 saw Decent English High School being launched. The primary medium of instruction is English and the student teacher ratio is 22:1. The school takes pride of its excellent teaching methodology.<br> 
                  Classes from 9 to 12 run in this school. The current student strength of the school is approximately 206 with residential facilities. The library in this school has 1800 books.The school has given exceptional results in the academic sphere and its students have excelled in extra co-curricular activities too.
                 
                </p>
              </div>
              <div class="col-lg-4 col-md-4">
                <h4 class="text-center"><a href="">On Founders Desk</a></h4><br>
                <video width="100%" height="300px"  controls="controls" autoplay="autoplay" class="indexvideo"><source src="Brave.mp4" type="Images/   " />
                  Your browser does not support the video tag.
                </video>
                <p class="description"></p>
              </div>
            </div>
          </div>
        </div>         
      </section><!-- End About Section -->

    <!-- ======= Portfolio Section ======= -->
      <section>
        <div class="container">
          <div class="row">
            <div class="col-lg-6 col-md-6">
              <h4><a href="">Founder & Chairperson Message</a></h4><br>
              <img class="img-responsive float-left pr-3" src="{{ asset('frontAsset/assets/img/dummy.png') }}" width="200px">
              <p class="text-justify class1"> 
                At DECENT ENGLISH SCHOOL,Nagpur, we recognize the imperative of imparting an educational experience that is world-class in every respect and which prepares children for global citizenship. We are a school with an Indian mind, an Indian heart and an Indian soul; a school that celebrates the culture of excellence and is an embodiment of values.<br>  We believe that a curriculum of excellence with a global dimension is central to the education of children to face the challenges of the 21st century with confidence and strength of character. Our caring and committed teachers are our pillars of strength. They teach our children not just with their minds but with their hearts, making learning enjoyable and rewarding, and instilling in children sound values and attributes. Our educational programmes are complemented by state-of-the-art facilities and resources, and numerous opportunities for children to engage and excel in sports and co-curricular activities.<br>- Founder & Chairperson<br>
                           Decent English School, Nagpur
              </p>
            </div>
            <div class="col-lg-6 col-md-6">
              <h4><a href="">Founder & Secretary Desk</a></h4><br>
               <img class="img-responsive float-left pr-3" src="{{ asset('frontAsset/assets/img/dummy.png') }}" width="200px">
                <p class="text-justify class1"> A school plays a central role in nurturing and developing the unique talent of every child, and enabling him or her to blossom by discovering the joy of learning. We believe that this can be achieved by providing children a safe and conducive environment to do their best in academics, sports, arts and cultural activities.<br> At DECENT ENGLISH SCHOOL, this guiding philosophy of providing children a holistic education has always been at the heart of everything we do. Every day, all our efforts are focused on making  DECENT ENGLISH SCHOOL a happy school, where teaching is a pleasure and learning is a joy. A school that prepares children to identify their interests early on and develop them into their passion. A school that makes them believe in themselves and think big. A school that inspires them to 'Dare to Dream… and Learn to Excel' and orients them to be lifelong learners.<br>
                -Founder & Secretary<br>
                           Decent English School, Nagpur</p>
            
          </div>
        </div>
      </div>
    </section>

    <!-- ======= Our Clients Section ======= -->
   
    <!-- ======= Our Team Section ======= -->
    <!-- End Our Team Section -->
     <section id="testimonial" style="background-color: #f3f1f0">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <h2>Board Of Members</h2>
            </div>
            <div class="col-12">
              <div id="testimonialCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Slide Indicators -->
                <ol class="carousel-indicators">
                  <li data-target="#testimonialCarousel" data-slide-to="0" class="active"></li>
                  <li data-target="#testimonialCarousel" data-slide-to="1"></li>
                  <li data-target="#testimonialCarousel" data-slide-to="2"></li>
                  <li data-target="#testimonialCarousel" data-slide-to="3"></li>
                  <li data-target="#testimonialCarousel" data-slide-to="4"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                  <!-- Slide 1 -->
                  <div class="carousel-item active">
                    <div class="carousel-content">
                      <div class="client-img">
                        <img src="{{ asset('frontAsset/assets/img/dummy.png') }}" alt="Testimonial Slider">
                      </div>
                      <!-- <h3>Shri. Rupesh Gedam</h3> -->
                      <p class="col-md-8 offset-md-2">Working Precident</p>
                    </div>
                  </div>
                  <!-- Slide 2 -->
                  <div class="carousel-item">
                    <div class="carousel-content">
                      <div class="client-img">
                        <img src="{{ asset('frontAsset/assets/img/dummy.png') }}" alt="Testimonial Slider">
                      </div>
                      <p class="col-md-8 offset-md-2">Vice Precident</p>
                    </div>
                  </div>
                  <!-- Slide 3 -->
                  <div class="carousel-item">
                    <div class="carousel-content">
                      <div class="client-img">
                        <img src="{{ asset('frontAsset/assets/img/dummy.png') }}" alt="Testimonial Slider">
                      </div>
                      <p class="col-md-8 offset-md-2">Secretary</p>
                    </div>
                  </div>
                  <!-- Slide 4 -->
                  <div class="carousel-item">
                    <div class="carousel-content">
                      <div class="client-img">
                        <img src="{{ asset('frontAsset/assets/img/dummy.png') }}" alt="Testimonial Slider">
                      </div>
                      <p class="col-md-8 offset-md-2">Treasurer</p>
                    </div>
                  </div>
                  <!-- Slide 5 -->
                  <div class="carousel-item">
                    <div class="carousel-content">
                      <div class="client-img">
                        <img src="{{ asset('frontAsset/assets/img/dummy.png') }}" alt="Testimonial Slider">
                      </div>
                      <!-- <h3>Shri. Amarjit Manzi</h3> -->
                      <p class="col-md-8 offset-md-2">Co-Treasurer</p>
                    </div>
                  </div>
                  <!-- Slider pre and next arrow -->
                  <a class="carousel-control-prev text-white" href="#testimonialCarousel" role="button" data-slide="prev">
                    <img src="{{ asset('frontAsset/images/prev.png') }}" alt="Testimonial Slider">
                  </a>
                  <a class="carousel-control-next text-white" href="#testimonialCarousel" role="button" data-slide="next">
                    <img src="{{ asset('frontAsset/images/next.png') }}" alt="Testimonial Slider">
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main><br>
  <!-- End #main -->
@endsection 
@section('customjs')

@endsection