<!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="utf-8">
      <title>{{ $data->title }}</title>
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
      <meta content="{{ $data->keyword }}" name="keywords">
      <meta content="APU Student Developer Society" name="description">

        <!-- Google Analytics -->
      <script async src="https://www.googletagmanager.com/gtag/js?id=UA-148897965-1"></script>
      <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-148897965-1');
      </script>

        <!-- Favicons -->
      <link href="{{ asset('img/favicon.png') }}" rel="icon">
      <link href="{{ asset('img/apple-touch-icon.png') }}" rel="apple-touch-icon">

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
              <a href="https://github.com/apusds" target="_blank" class="github"><i class="fa fa-github"></i></a>
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

          <script>
              const msg = '{{ Session::get('alert') }}';
              const exist = '{{ Session::has('alert') }}';
              if (exist){
                  alert(msg);
              }
          </script>



          <div class="logo float-left">
            <a href="#header" class="scrollto"><img src="{{ asset('img/sds.png') }}" alt="" class="img-fluid"></a>

          </div>

          <div class="float-right" style="display: flex">
            <span><a href="{{ route('register') }}" class="btn-join">Join Us</a></span>
            
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
                          <li><a href="e/{{ $ee->identifier }}" class="disabled">{{ $ee->title }} ({{ strtoupper($ee->organisation) }})</a></li>
                      @endforeach
                      </ul>
                    </li>
                    <li class="drop-down"><a href="#">DSC Events</a>
                      <ul>
                          @foreach($dscEvents as $dsc)
                              <li><a href="e/{{ $dsc->identifier }}">{{ $dsc->title }}</a></li>
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
                <a href="{{ route('register') }}" class="btn-get-started">Join Us</a>
              </div>
            </div>

            <div class="col-md-6 intro-img order-md-last order-first">
              <img src="{{ asset('img/sds.png') }}" alt="" class="img-fluid wow fadeInRight">
            </div>
          </div>

        </div>
      </section>

      <main id="main">

        <section id="about" class="section-colorful-wakiki wow fadeIn">
          <div class="container">
            <div class="about-content">
              <h2>About Us</h2>
              <h3>{{ $data->about_us }}</h3>
              <br>
              <blockquote class="blockquote text-center">
                <p class="mb-0">"Everybody should know how to program a computer, because it teaches you how to think."</p>
                <footer class="blockquote-footer"><cite title="Source Title">Steve Jobs</cite></footer>
              </blockquote>
            </div>
          </div>
        </section>

        <section id="dsc">
          <div class="container">
            <div class="dsc-content">
              <img src="{{ asset('img/dscapu-full.png') }}" alt="DSC APU" style="width: 400px">
              <h3>{{ $data->dsc_apu }}</h3>
              <div>
                <a href="#" class="btn-learn-more">
                  <span class="wave3"></span>
                  <span class="wave2"></span>
                  <span class="wave1"></span>
                  Learn More
                </a>
              </div>
            </div>
          </div>
        </section>

        <section id="partners" class="section-light">
          <div class="container">
            <header class="section-header">
              <h2>Our Partners</h2>
            </header>
            <div class="owl-carousel partners-carousel owl-theme align-center">
                <figure><img src="{{ asset('img/dscmy.png') }}" alt="DSC Malaysia" style="width:200px"></figure>
                <figure><img src="{{ asset('img/gdg-cloud-kl.png') }}" alt="GDG Cloud KL" style="width:300px"></figure>
                <figure><img src="{{ asset('img/apca.png') }}" alt="APCA" style="width:200px"></figure>
                <figure><img src="{{ asset('img/um-app-club.jpg') }}" alt="APCA" style="width:150px"></figure>
            </div>
          </div>
        </section>

        <section id="gallery" class="section-dark wow fadeInRightBig">
          <div class="container">

            <header class="section-header">
              <h2 class="section-title">Our Gallery</h2>
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
              <h2>Core Team</h2>
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
                          @if ($committee->facebook !== null)
                            <a href="{{ $committee->facebook }}" target="_blank"><i class="fa fa-facebook"></i></a>
                          @endif
                          @if ($committee->twitter !== null)
                            <a href="{{ $committee->twitter }}" target="_blank"><i class="fa fa-twitter"></i></a>
                          @endif
                          @if ($committee->linkedln !== null)
                              <a href="{{ $committee->linkedln }}" target="_blank"><i class="fa fa-linkedin"></i></a>
                          @endif
                          @if($committee->instagram !== null)
                              <a href="{{ $committee->instagram }}" target="_blank"><i class="fa fa-instagram"></i></a>
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

        <section id="join" class="section-colorful-yellow wow fadeInUp">
          <div class="container">
            <div class="section-header">
              <h2>Join Us</h2>
            </div>

            <h3>Why become a member?</h3>
            <div class="accordion" id="accordionJoin">

              <div class="card">
                <div class="card-header accordion-toggle collapsed" id="heading1" href="#collapse1" data-toggle="collapse" data-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                  Get member price for our workshops and events.
                </div>
                <div id="collapse1" class="collapse" aria-labelledby="heading1" data-parent="#accordionJoin">
                  <div class="card-body" style="background-image: url(https://i.kym-cdn.com/photos/images/newsfeed/000/574/974/013.gif); height: 250px;">
                  </div>
                </div>
              </div>

              <div class="card">
                <div class="card-header accordion-toggle collapsed" id="heading2" href="#collapse2" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                  Get invited to gatherings and activities with our partners.
                </div>
                <div id="collapse2" class="collapse" aria-labelledby="heading2" data-parent="#accordionJoin">
                  <div class="card-body">
                    GDG Cloud KL Meetup, Google DSC Malaysia, UM App Club, Internal Workshop
                  </div>
                </div>
              </div>

              <div class="card">
                <div class="card-header accordion-toggle collapsed" id="heading3" href="#collapse3" data-toggle="collapse" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                  Collaborate and build cool projects.
                </div>
                <div id="collapse3" class="collapse" aria-labelledby="heading3" data-parent="#accordionJoin">
                  <div class="card-body" style="background-image: url(https://media.giphy.com/media/Q9aBxHn9fTqKs/giphy.gif); height: 250px;">
                    <span style="color: white;">Web development, Flutter mobile app</span>, Meme automation, AI girlfriend......
                  </div>
                </div>
              </div>

              <div class="card">
                <div class="card-header accordion-toggle collapsed" id="heading4" href="#collapse4" data-toggle="collapse" data-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                  Access to our Secret Base. <i class="far fa-smile-wink"></i>
                </div>
                <div id="collapse4" class="collapse" aria-labelledby="heading4" data-parent="#accordionJoin">
                  <div class="card-body">
                    <i>Under construction!</i><br>
                    Hint: Level 6
                  </div>
                </div>
              </div>

            </div>

            <div class="register">
              <h4>Be part of the coolest student-run tech community in Malaysia! *</h4>
            </div>
            <div class="register"><a href="{{ route('register') }}" class="btn-rainbow">Register</a></div>
            <div class="disclaimer float-right">* Weird flex but ok.</div>

          </div>
        </section>

      </main>

      <footer id="footer" class="wow fadeInUp">
        <div class="footer-top">
          <div class="container">

            <div class="row">

              <div class="col-sm footer-info">

                <div class="row">

                    <div class="col-sm">
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
                          <strong>Email:</strong> <a href="mailto:info@apusds.com" target="_blank">info@apusds.com</a><br>
                          <strong>Mobile:</strong> <a href="tel:60173762015">+60173762015</a><br>
                        </p>
                      </div>

                      <div class="social-links">
                        <a href="https://www.facebook.com/apusds" target="_blank" class="facebook"><i class="fa fa-facebook"></i></a>
                        <a href="https://www.instagram.com/dsc.apu/" target="_blank" class="instagram"><i class="fa fa-instagram"></i></a>
                        <a href="https://www.linkedin.com/company/apusds/" target="_blank" class="linkedin"><i class="fa fa-linkedin"></i></a>
                        <a href="https://github.com/apusds" target="_blank" class="github"><i class="fa fa-github"></i></a>
                      </div>

                    </div>

                </div>

              </div>

              <div class="col-sm footer-info">

                <div class="form">

                  <h4>Send us a message</h4>
                  <p>Just drop us a Message.</p>
                  <form action="{{ route('inquiry.post') }}" method="POST" role="form" class="contactForm">
                        {{ csrf_field() }}

                        <div class="form-group">
                          <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                        </div>
                        <div class="form-group">
                          <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                        </div>
                        <div class="form-group">
                          <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                        </div>
                        <div class="form-group">
                          <textarea class="form-control" name="message" rows="5" data-rule="required" placeholder="Enter Message" required></textarea>
                        </div>

                        <div class="text-center"><button type="submit" title="Send Message">Send Message</button></div>
                  </form>
                </div>

              </div>

              <div class="col-sm footer-info">
                <h4>Our Discord Guild</h4>
                <iframe src="https://discordapp.com/widget?id=625938559819317268&theme=light" height="350" allowtransparency="true" frameborder="0"></iframe>
              </div>

            </div>

          </div>
        </div>

        <div class="container">
          <div class="copyright">
            <a rel="license" href="http://creativecommons.org/licenses/by/4.0/"><img alt="Creative Commons License" style="border-width:0" src="https://i.creativecommons.org/l/by/4.0/88x31.png" /></a><br />This work is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by/4.0/">Creative Commons Attribution 4.0 International License</a>.
          </div>
          <div class="credits">
            Designed by <a href="https://rtgnetworks.com/" target="_blank">Raeveen Pasupathy</a> and <a href="https://www.linkedin.com/in/almondheng/" target="_blank">Almond Heng</a>
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
