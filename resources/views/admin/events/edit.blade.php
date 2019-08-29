@extends('layouts.admin')

@section('title', 'Edit Event')

@section('content')
    <div>
        <h2 class="float-left">Events | Edit</h2>
        @if (Auth::user()->hasAllowedRole())
            <a class="btn btn-primary float-right" href="{{ route('dashboard.events') }}">Back</a>
            <a class="btn btn-danger float-right" href="{{ route('dashboard.events.delete', ['id' => $data->id]) }}">Delete</a>
        @endif
    </div>

    <br><br><br>

    <form method="POST" action="{{ route('dashboard.events.edit', ['id' => $data->id]) }}">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="inputTitle">Event Title (<span class="red">*</span>)</label>
            <input type="text" class="form-control" id="inputTitle" name="title" placeholder="Enter Title" value="{{ $data->title }}" required>
        </div>
        <div class="form-group">
            <label for="inputImage">Image URL (Direct Image url)</label>
            <input type="text" class="form-control" id="inputImage" name="image" placeholder="Enter Image URL" value="{{ $data->image }}">
        </div>
        <div class="form-group">
            <label for="inputDescription">Description (<span class="red">*</span>)</label>
            <textarea class="form-control" id="inputDescription" name="description" placeholder="Enter Description" required rows="5">{{ $data->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="selectExpire">Expires On (<span class="red">*</span>)</label>
            <input type="date" class="form-control" id="selectExpire" name="expiry" value="{{ date('Y-m-d', strtotime($data->expiry)) }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@stop
