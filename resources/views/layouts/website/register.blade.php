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
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,500,600,700,700i|Montserrat:300,400,500,600,700"
    rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="{{ asset('lib/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
  <link href="{{ asset('lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">

  <!-- Register Stylesheet File -->
  <link href="{{ asset('css/register/style.css') }}" rel="stylesheet">

</head>

<body>
    <script>
        const msg = '{{ Session::get('alert') }}';
        const exist = '{{ Session::has('alert') }}';
        if (exist){
            alert(msg);
        }
    </script>

  <div class="container">
    <div id="membershipForm">
      <div class="content rounded">
        <h4>Membership Form</h4>
        <span><b><i>Note: Open to APU Students & Alumni only</i></b></span>

        <hr />

        <form method="POST" action="{{ route('membership.post') }}">
          {{ csrf_field() }}

          <div class="form-group">
            <label for="email">Email Address <span class="red">*</span></label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
          </div>

          <div class="form-group">
            <label for="name">Name <span class="red">*</span></label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required>
          </div>

          <div class="form-group">
            <label for="mobile">Mobile <span class="red">*</span></label>
            <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter Mobile Number"
              required>
          </div>

          <div class="form-group">
            <label for="tp">TP Number <span class="red">*</span></label>
            <input type="text" class="form-control" id="tp" name="tp" placeholder="Enter TP Number" required>
            <small style="padding-left: 15px;" class="red" id="tpError"></small>
          </div>

          <div class="form-group">
            <label for="intake">Intake <span class="red">*</span></label>
            <input type="text" class="form-control" id="intake" name="intake" placeholder="Enter Intake" required>
            <small style="padding-left: 15px;" class="red" id="intakeError"></small>
          </div>

          <div class="form-group">
            <label for="gender">Gender? <span class="red">*</span></label>

            <div class="row">
              <div class="material-radio col left">
                <input class="form-check-input" type="radio" value="male" id="male" name="gender">
                <label class="form-check-label" for="male">
                  Male
                </label>
              </div>

              <div class="material-radio col right">
                <input class="form-check-input" type="radio" value="female" id="female" name="gender">
                <label class="form-check-label" for="female">
                  Female
                </label>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="skills">Skills <span class="red">*</span></label>

            <div class="row">
              <div class="material-check col left">
                <input class="form-check-input" type="checkbox" value="beginner" id="beginner" name="skills[]">
                <label class="form-check-label" for="beginner">
                  Beginner
                </label>
              </div>

              <div class="material-check col right">
                <input class="form-check-input" type="checkbox" value="web dev" id="web dev" name="skills[]">
                <label class="form-check-label" for="web dev">
                  Web
                </label>
              </div>

              <div class="w-100"></div>

              <div class="material-check col left">
                <input class="form-check-input" type="checkbox" value="backend" id="backend" name="skills[]">
                <label class="form-check-label" for="backend">
                  Backend
                </label>
              </div>

              <div class="material-check col right">
                <input class="form-check-input" type="checkbox" value="android" id="android" name="skills[]">
                <label class="form-check-label" for="android">
                  Mobile
                </label>
              </div>

              <div class="w-100"></div>

              <div class="material-check col left">
                <input class="form-check-input" type="checkbox" value="deployment" id="deployment" name="skills[]">
                <label class="form-check-label" for="deployment">
                  Deployment
                </label>
              </div>

              <div class="material-check col right">
                <input class="form-check-input" type="checkbox" value="database" id="database" name="skills[]">
                <label class="form-check-label" for="database">
                  Database
                </label>
              </div>

              <div class="w-100"></div>

              <div class="material-check col left">
                <input class="form-check-input" type="checkbox" value="networking" id="networking" name="skills[]">
                <label class="form-check-label" for="networking">
                  Networking
                </label>
              </div>

              <div class="material-check col right">
                <input class="form-check-input" type="checkbox" value="data science" id="data science" name="skills[]">
                <label class="form-check-label" for="data science">
                  Data Science
                </label>
              </div>

            </div>
          </div>

          <div class="form-group">
            <label for="find-us">How did you find us? <span class="red">*</span></label>

            <div>
              <div class="material-radio">
                <input class="form-check-input" type="radio" value="0" id="facebook" name="check">
                <label class="form-check-label" for="facebook">
                  Social Media
                </label>
              </div>

              <div class="material-radio">
                <input class="form-check-input" type="radio" value="1" id="heard" name="check">
                <label class="form-check-label" for="heard">
                  Heard From Friend
                </label>
              </div>

              <div class="material-radio">
                <input class="form-check-input" type="radio" value="2" id="attended" name="check">
                <label class="form-check-label" for="attended">
                  Attended Event/Workshop
                </label>
              </div>
            </div>
          </div>

          <hr>
          
          <div class="text-center">
            <a href="{{ route('home') }}" class="btn btn-danger" style="margin-right: 5px;">Back</a>
            <button type="submit" id="submitBtn" class="btn btn-success">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div id="preloader"></div>

  <script src="{{ asset('lib/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('lib/jquery/jquery-migrate.min.js') }}"></script>
  <script src="{{ asset('lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
  <script src="{{ asset('lib/mobile-nav/mobile-nav.js') }}"></script>
  <script src="{{ asset('lib/wow/wow.min.js') }}"></script>
  <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
  <script src="{{ asset('lib/counterup/counterup.min.js') }}"></script>
  <script src="{{ asset('lib/isotope/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('lib/lightbox/js/lightbox.min.js') }}"></script>

  <script src="{{ asset('js/main/main.js') }}"></script>

</body>

</html>
