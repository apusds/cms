@extends('layouts.auth')

@section('content')
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
      @if($data->location)
        <span>Location : {{ $data->location }}</span>
      @else
        <span>Location : To be decided~ </span>
      @endif
    </div>

    <form action="{{ route('admin.post') }}" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="student_id">TP Number</label>
            <input type="text" name="student_id"  class="form-control" id="student_id" placeholder="Enter your TP Number" required>
        </div>
        <div class="col-md-12 text-center ">
            <button type="submit" class=" btn btn-block mybtn btn-primary tx-tfm">Check in!</button>
        </div>
    </form>
@else
  <h2> There are no meetup scheduled </h2>
@endif
@stop
