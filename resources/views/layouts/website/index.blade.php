<!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="utf-8">
      <title>{{ $data->title }}</title>
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
      <meta content="{{ $data->keyword }}" name="keywords">
      <meta content="APU Student Developer Society" name="description">

      <!-- Favicons -->
      <link href="img/favicon.png" rel="icon">
      <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

      <!-- Faggot<li><a href="#partners">Partners</a></li> Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,500,600,700,700i|Montserrat:300,400,500,600,700" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

      <!-- Bootstrap CSS File -->
      <link href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

      <!-- Libraries CSS Files -->
      <link href="{{ asset('lib/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
      <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
      <link href="{{ asset('lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
      <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
      <link href="{{ asset('lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">

      <!-- Main Stylesheet File -->
      <link href="{{ asset('css/main/style.css') }}" rel="stylesheet">

    </head>

    <body>

      <header id="header">

        <div id="topbar">
          <div class="container">
            <div class="social-links">
              <!-- <i href="#" class="twitter"><i class="fa fa-twitter"></i></a> -->
              <a href="https://www.facebook.com/apusds" target="_blank" class="facebook"><i class="fa fa-facebook"></i></a>
              <a href="https://www.linkedin.com/company/apusds/" target="_blank" class="linkedin"><i class="fa fa-linkedin"></i></a>
              <a href="https://www.instagram.com/dsc.apu/" target="_blank" class="instagram"><i class="fa fa-instagram"></i></a>
            </div>
          </div>
        </div>

        <div class="container">

          @if ($data->announcement !== null)
            <div class="alert alert-warning alert-dismissible fade show">
                <marquee><strong>Warning!</strong> {{ $data->announcement }}</marquee>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
          @endif

          <div class="logo float-left">
            <a href="#header" class="scrollto"><img src="{{ asset('img/sds.png') }}" alt="" class="img-fluid"></a>
            
          </div>

          <div class="float-right" style="display: flex">
          <span><a href="#membershipModal" class="btn-join" data-toggle="modal" data-target="#membershipModal">Join Us</a></span>
          <nav class="main-nav d-none d-lg-block">
            <ul>
              <li class="active"><a href="#intro">Home</a></li>
              <li class="drop-down"><a href="">Events</a>
                <ul>
                  <li class="drop-down"><a href="#">Upcoming</a>
                    <ul>
                    @foreach($activeEvents as $ae)
                        <li><a href="e/{{ $ae->identifier }}">{{ $ae->title }}</a></li>
                    @endforeach
                    </ul>
                  </li>
                  <li class="drop-down"><a href="#">Past</a>
                    <ul>
                    @foreach($expiredEvents as $ee)
                        <li><a href="e/{{ $ae->identifier }}" class="disabled">{{ $ee->title }} ({{ strtoupper($ee->organisation) }})</a></li>
                    @endforeach
                    </ul>
                  </li>
                  <li class="drop-down"><a href="#">DSC Events</a>
                    <ul>
                        @foreach($dscEvents as $dsc)
                            <li><a href="e/{{ $ae->identifier }}">{{ $dsc->title }}</a></li>
                        @endforeach
                    </ul>
                  </li>
                </ul>
              </li>
              <li><a href="#about">About</a></li>
              <li><a href="#dsc">DSC</a></li>
              <li><a href="#partners">Partners</a></li>
              <li><a href="#gallery">Gallery</a></li>
              <li><a href="#team">Team</a></li>
              <li><a href="#join">Join</a></li>
              <li><a href="#footer">Contact</a></li>
            </ul>
          </nav>
          </div>

        </div>
      </header>

      <section id="intro" class="clearfix">
        <div class="container d-flex h-100">
          <div class="row justify-content-center align-self-center">
            <div class="col-md-6 intro-info order-md-first order-last wow fadeInLeft">
              <h5><i>Asia Pacific University</i></h5>
              <h3><b>Student Developer Society</b></h3>
              <p class="wow fadeInRightBig">{{ $data->philosophy }}</p>
              <div>
                <a href="#membershipModal" class="btn-get-started" data-toggle="modal" data-target="#membershipModal">Join Us</a>
              </div>
            </div>

            <div class="col-md-6 intro-img order-md-last order-first">
              <img src="{{ asset('img/sds.png') }}" alt="" class="img-fluid wow fadeInRight">
            </div>
          </div>

        </div>
      </section>

      <main id="main">

        <section id="about" class="section-colorful-wakiki">
          <div class="container">
            <div class="about-content">
              <h2>About Us</h2>
              <h3>{{ $data->about_us }}</h3>
            </div>
          </div>
        </section>

        <section id="dsc">
          <div class="container">
            <div class="dsc-content">
              <img src="{{ asset('img/DSC_APU_Logo.png') }}" alt="DSC APU" style="width: 300px">
              <h3>{{ $data->dsc_apu }}</h3>
              <div>
                <a href="#" class="btn-learn-more">
                  <span class="wave1"></span>
                  <span class="wave2"></span>
                  <span class="wave4"></span>
                  <span class="wave3"></span>
                  Learn More
                </a>
              </div>
            </div>
          </div>
        </section>

        <section id="partners" class="section-bg wow fadeInUp">
            <div class="container">
                <header class="section-header">
                    <h3>Our Partners</h3>
                </header>
                <div class="owl-carousel partners-carousel">
                    <img src="{{ asset('img/DSC_APU_Logo.png') }}" alt="">
                </div>
            </div>
        </section>

        <section id="gallery" class="section-colorful-yellow">
          <div class="container">

            <header class="section-header">
              <h3 class="section-title">Our Gallery</h3>
            </header>

            <div class="row">
              <div class="col-lg-12">
                <ul id="gallery-flters">
                  <li data-filter="*" class="filter-active">All</li>
                    @foreach (\App\Event::all() as $e)
                      <li data-filter=".filter-{{ str_replace(' ', '-', strtolower($e->title)) }}"> {{ $e->title }} </li>
                    @endforeach
                </ul>
              </div>
            </div>

            <div class="row gallery-container">
                @foreach(\App\Gallery::all() as $i)
                    <div class="col-lg-4 col-md-6 gallery-item filter-{{ str_replace(' ', '-', strtolower($i->eventData()->title)) }}" data-wow-delay="0.2s">
                        <div class="gallery-wrap">
                            <img src="{{ asset(env('PUBLIC_PATH') . '/gallery/' . $i->file) }}" class="img-fluid" alt="">
                            <div class="gallery-info">
                                <h4><a href="#">{{ $i->title }}</a></h4>
                                <p>{{ $i->eventData()->title }}</p>
                                <div>
                                    <a href="{{ asset(env('PUBLIC_PATH') . '/gallery/' . $i->file) }}" class="link-preview" data-lightbox="gallery" data-title="{{ $i->title }}" title="Preview"><i class="ion ion-eye"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

          </div>
        </section>

        <section id="team">
          <div class="container">
            <div class="section-header">
              <h3>Core Team</h3>
              <p>These are the wizards behind Student Developer Society!</p>
            </div>

            <div class="row">

              @foreach (\App\Committee::all() as $committee)
                <div class="col-lg-3 col-md-6 wow fadeInUp">
                  <div class="member">
                    <img src="{{ asset(env('PUBLIC_PATH') . '/committee/' . $committee->file) }}" class="img-fluid" alt="">
                    <div class="member-info">
                      <div class="member-info-content">
                        <h4>{{ $committee->name }}</h4>
                        <span>{{ $committee->role }}</span>
                        <div class="social">
                          @if (isset($committee->facebook))
                            <a href="{{ $committee->facebook }}"><i class="fa fa-facebook"></i></a>
                          @elseif (isset($committee->twitter))
                            <a href="{{ $committee->twitter }}"><i class="fa fa-twitter"></i></a>
                          @elseif (isset($committe->linkedln))
                            <a href="{{ $committee->linkedln }}"><i class="fa fa-linkedin"></i></a>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach

            </div>

          </div>
        </section>

      </main>

    <!-- The Modal -->
    <div class="modal fade" id="membershipModal">
          <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
              <div class="modal-content">

                  <!-- Modal Header -->
                  <div class="modal-header">
                      <h4 class="modal-title">Membership Form</h4>
                  </div>

                  <!-- Modal body -->
                  <div class="modal-body">
                      <h3>Benefits</h3>
                      <div>
                          <ul>
                              <li>
                                  Get Member price for our events and workshops
                              </li>
                              <li>
                                  Exclusive invitation to gatherings and activities with our Partners
                              </li>
                              <li>
                                  Collaborate and build cool projects
                              </li>
                              <li>
                                  Access to our Secret Base :)
                              </li>
                          </ul>
                      </div>
                      <b><i>Note: Open to APU Students only</i></b>

                      <hr />

                      <form method="POST" action="">
                          {{ csrf_field() }}

                          <div class="form-group">
                              <label for="email">Email Address (<span class="red">*</span>)</label>
                              <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
                          </div>

                          <div class="form-group">
                              <label for="name">Name (<span class="red">*</span>)</label>
                              <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required>
                          </div>

                          <div class="form-group">
                              <label for="mobile">Mobile (<span class="red">*</span>)</label>
                              <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter Mobile Number" required>
                          </div>

                          <div class="form-group">
                              <label for="tp">TP Number (<span class="red">*</span>)</label>
                              <input type="text" class="form-control" id="tp" name="tp" placeholder="Enter TP Number" required>
                          </div>

                          <div class="form-group">
                              <label for="intake">Intake (<span class="red">*</span>)</label>
                              <input type="text" class="form-control" id="intake" name="intake" placeholder="Enter Intake" required>
                          </div>

                          <label for="skills">How did you find us? (<span class="red">*</span>)</label>

                          <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="0" id="check1" name="check">
                              <label class="form-check-label" for="check1">
                                  Facebook
                              </label>
                          </div>

                          <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="1" id="check2" name="check">
                              <label class="form-check-label" for="check2">
                                  Heard from friend
                              </label>
                          </div>

                          <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="2" id="check3" name="check">
                              <label class="form-check-label" for="check3">
                                  Attended our Event/Workshop
                              </label>
                          </div>

                          <br>

                          <button type="submit" id="submitBtn" class="btn btn-success">Submit</button>
                      </form>
                  </div>

                  <!-- Modal footer -->
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>

              </div>
          </div>
      </div>

      <footer id="footer">
        <div class="footer-top">
          <div class="container">

            <div class="row">

              <div class="col-lg-6">

                <div class="row">

                    <div class="col-sm-6">
                      <div class="footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                          <li><a href="#">Home</a></li>
                          <li><a href="#">Terms of service</a></li>
                          <li><a href="#">Privacy policy</a></li>
                        </ul>
                      </div>

                      <div class="footer-links">
                        <h4>Contact Us</h4>
                          <strong>Email:</strong> <a href="mailto:studentdevelopersociety@gmail.com">studentdevelopersociety@gmail.com</a><br>
                          <strong>Mobile:</strong> <a href="tel:60173762015">+60173762015</a><br>
                        </p>
                      </div>

                      <div class="social-links">
                        <!-- <a href="" class="twitter"><i class="fa fa-twitter"></i></a> -->
                        <a href="https://www.facebook.com/apusds" target="_blank" class="facebook"><i class="fa fa-facebook"></i></a>
                        <a href="https://www.instagram.com/dsc.apu/" target="_blank" class="instagram"><i class="fa fa-instagram"></i></a>
                        <a href="https://www.linkedin.com/company/apusds/" target="_blank" class="linkedin"><i class="fa fa-linkedin"></i></a>
                      </div>

                    </div>

                </div>

              </div>

              <div class="col-lg-6">

                <div class="form">

                  <h4>Send us a message</h4>
                  <p>Just drop us a Message.</p>
                  <form action="" method="post" role="form" class="contactForm">
                    <div class="form-group">
                      <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                      <div class="validation"></div>
                    </div>
                    <div class="form-group">
                      <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                      <div class="validation"></div>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                      <div class="validation"></div>
                    </div>
                    <div class="form-group">
                      <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                      <div class="validation"></div>
                    </div>

                    <div id="sendmessage">Your message has been sent. Thank you!</div>
                    <div id="errormessage"></div>

                    <div class="text-center"><button type="submit" title="Send Message">Send Message</button></div>
                  </form>
                </div>

              </div>

            </div>

          </div>
        </div>

        <div class="container">
          <div class="copyright">
            &copy; Copyright <strong>APU SDS</strong>. All Rights Reserved
          </div>
          <div class="credits">
            Designed by <a href="https://rtgnetworks.com/">Raeveen Pasupathy</a>
          </div>
        </div>
      </footer>

      <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

      <div id="preloader"></div>

      <script src="{{ asset('lib/jquery/jquery.min.js') }}"></script>
      <script src="{{ asset('lib/jquery/jquery-migrate.min.js') }}"></script>
      <script src="{{ asset('lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
      <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
      <script src="{{ asset('lib/mobile-nav/mobile-nav.js') }}"></script>
      <script src="{{ asset('lib/wow/wow.min.js') }}"></script>
      <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
      <script src="{{ asset('lib/counterup/counterup.min.js') }}"></script>
      <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
      <script src="{{ asset('lib/isotope/isotope.pkgd.min.js') }}"></script>
      <script src="{{ asset('lib/lightbox/js/lightbox.min.js') }}"></script>

      <script src="{{ asset('js/main/main.js') }}"></script>

    </body>
</html>
