@extends('layouts.admin')

@section('title', 'New Meetup')

@section('content')
    <div>
        <h2 class="float-left">Events | Create</h2>
        <div class="float-right">
            <a class="btn btn-primary float-right" href="{{ route('dashboard.meetups') }}">Back</a>
        </div>
    </div>

    <br><br>

    <hr />

    <form method="POST" action="{{ route('dashboard.meetups.create') }}" enctype="multipart/form-data">
        {{ csrf_field() }}


        <div class="form-group">
            <label for="title">Meetup Title (<span class="red">*</span>)</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" required>
        </div>

        <br><br>

        <div class="form-group">
            <label for="description">Description (<span class="red">*</span>)</label>
            <textarea class="form-control" id="description" name="description" placeholder="Enter Description" required rows="5"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@stop
