@extends('layouts.admin')

@section('title', 'Gallery')

@section('content')
    <div>
        <h2 class="float-left">Gallery | Upload</h2>
        <a class="btn btn-danger float-right" href="{{ route('dashboard.gallery') }}">Back</a>
    </div>

    <br><br>

    <hr />

    <form method="POST" action="{{ route('dashboard.gallery.upload') }}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="event">Event (<span class="red">*</span>)</label>
            <select class="form-control" id="event" name="event" required>
                <option value="">Please select</option>
                @foreach ($events as $ae)
                    <option value="{{ $ae->id }}">{{ $ae->title }}</option>
                @endforeach
            </select>
        </div>

        <label>Upload the Image (<span class="red">*</span>)</label>
        <a class="btn btn-primary" style="margin-left: 20px" href="#" id="addField">Add more</a>
        <hr />

        <div class="custom-file">
            <label class="custom-file-label" for="customFile">Choose file</label>
            <input type="file" class="custom-file-input" id="customFile" name="file[]" required>
        </div>

        <div id="form-field"></div>

        <hr />

        <button type="submit" id="submitBtn" class="btn btn-primary">Submit</button>
        <a href="{{ route('dashboard.gallery.upload') }}" class="btn btn-success">Reset Fields</a>
    </form>
@stop
