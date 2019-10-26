<html>
    <head>
        <meta charset="utf-8">
        <title>Check-In</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" >

        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js" type="text/javascript"></script>

        <link href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('lib/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/checkin/style.css') }}" rel="stylesheet">

        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,500,600,700,700i|Montserrat:300,400,500,600,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    </head>

    <body>
        <script src="{{ asset('lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    @if ($message = Session::get('message'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif

    @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif

        <div class="container">
            <div class="logo text-center">
                <a href=""><img src="{{ asset('img/sds.png') }}" alt="" class="img-fluid"></a>
            </div>

            <div class="card shadow">
            @if ($data)

                <div class="mb-3 col-md-12 text-center">
                    <h1>{{ $data->title }}</h1>
                </div>

                <div class="col-md-12 details">
                    <div>Description:  {{ $data->description }}</div>
                    <div>Start Time:  {{ $data->event_start }}</div>
                    <div>End Time:  {{ $data->event_end }}</div>
                    <div>Venue:  {{ $data->location ?? "To be decided" }}</div>
                </div>

                @if (now()->between( $data->event_start , $data->event_end ))
                    <form class="col-md-12 text-center" action="{{ route('member.checkin') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="text" name="student_id"  class="form-control" id="student_id" placeholder="Enter your TP Number" required>
                        </div>
                        <button type="submit" class="btn btn-block mybtn btn-primary tx-tfm">Check in!</button>
                    </form>
                @else
                    <span><em> {{ now()->greaterThan($data->event_end) ? 'The meetup has ended!' : 'Check-in has not started yet, please hang tight!' }} </em></span>
                @endif

            @else
                <div class="text-center">
                    <h2> No meetup scheduled </h2>
                </div>
            @endif
            </div>

        </div>
    </body>
</html>