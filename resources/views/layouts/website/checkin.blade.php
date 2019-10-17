@extends('layouts.auth')

@section('content')
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

    @if ($data)

        <div class="logo mb-3">
            <div class="col-md-12 text-center">
                <h1>{{ $data->title }}</h1>
            </div>
        </div>
        <div>
          <span>Description : {{ $data->description }}</span>
        </div>
        <div>
          <span>Start Time : {{ $data->event_start }}</span>
        </div>
        <div>
          <span>End Time : {{ $data->event_end }}</span>
        </div>
        <div>
            <span>Location : {{ $data->location ?? "To be decided" }}</span>
        </div>

        <form action="{{ route('member.checkin') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="student_id">TP Number</label>
                <input type="text" name="student_id"  class="form-control" id="student_id" placeholder="Enter your TP Number" required>
            </div>
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-block mybtn btn-primary tx-tfm">Check in!</button>
            </div>
        </form>

    @else
      <h2> There are no meetup scheduled </h2>
    @endif
@stop
