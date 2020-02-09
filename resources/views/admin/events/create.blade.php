@extends('layouts.admin')

@section('title', 'New Event')

@section('content')
    <div>
        <h2 class="float-left">Events | Create</h2>
        <div class="float-right">
            <a class="btn btn-primary float-right" href="{{ route('dashboard.events') }}">Back</a>
        </div>
    </div>

    <br><br>

    <hr />

    <form method="POST" action="{{ route('dashboard.events.create') }}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="event">Organisation (<span class="red">*</span>)</label>
            <select class="form-control" id="event" name="organisation" required>
                <option value="">Please select</option>
                <option value="sds">Student Developer Society</option>
                <option value="dsc">DSC APU</option>
            </select>
        </div>

        <div class="form-group">
            <label for="title">Event Title (<span class="red">*</span>)</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" required>
        </div>

        <label>Poster Image (<span class="red">*</span>)</label>
        <div class="form-group custom-file">
            <label class="custom-file-label" for="customFile">Choose file</label>
            <input type="file" class="custom-file-input" id="customFile" name="file" required>
        </div>

        <br><br>

        <div class="form-group">
            <label for="description">Description (<span class="red">*</span>)</label>
            <textarea class="form-control" id="description" name="description" placeholder="Enter Description" required rows="5"></textarea>
        </div>

        <div class="form-group">
            <label for="expiry">Expires On (<span class="red">*</span>)</label>
            <input type="datetime-local" class="form-control" id="expiry" name="expiry" required>
        </div>

        <div class="form-group checkbox">
            <label><input type="checkbox" value="1" name="form">Enable Sign-up Form</label>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@stop
