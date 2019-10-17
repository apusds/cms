<!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="utf-8">
      <title>Meetup Check-in</title>
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
      <meta content="APU Student Developer Society Meetup Check-in" name="keywords">
      <meta content="APU Student Developer Society Meetup Check-in" name="description">

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
      <footer id="footer">
        <div class="footer-top">
          <div class="container">

            <div class="row">

              <div class="col footer-info">

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
                          <strong>Email:</strong> <a href="mailto:info@apusds.com">info@apusds.com</a><br>
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

              <div class="col footer-info">

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

              <div class="col footer-info">
                <h4>Our Discord Guild</h4>
                <iframe src="https://discordapp.com/widget?id=625938559819317268&theme=light" height="350" allowtransparency="true" frameborder="0"></iframe>
              </div>

            </div>

          </div>
        </div>

        <div class="container">
          <div class="copyright">
            &copy; Copyright <strong>APU SDS</strong>. All Rights Reserved
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
