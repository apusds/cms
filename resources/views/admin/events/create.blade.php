@extends('layouts.admin')

@section('title', 'New Event')

@section('content')
    <div>
        <h2 class="float-left">Events | Create</h2>
        <div class="float-right">
            <a class="btn btn-primary float-right" href="{{ route('dashboard.events') }}">Back</a>
        </div>
    </div>

    <br><br><br>

    <form method="POST" action="{{ route('dashboard.events.create') }}">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="inputTitle">Event Title (<span class="red">*</span>)</label>
            <input type="text" class="form-control" id="inputTitle" name="title" placeholder="Enter Title" required>
        </div>
        <div class="form-group">
            <label for="inputImage">Image URL (Direct Image url)</label>
            <input type="text" class="form-control" id="inputImage" name="image" placeholder="Enter Image URL">
        </div>
        <div class="form-group">
            <label for="inputDescription">Description (<span class="red">*</span>)</label>
            <textarea class="form-control" id="inputDescription" name="description" placeholder="Enter Description" required rows="5"></textarea>
        </div>
        <div class="form-group">
            <label for="selectExpire">Expires On (<span class="red">*</span>)</label>
            <input type="date" class="form-control" id="selectExpire" name="expiry" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@stop
