@extends('layouts.admin')

@section('title', 'Edit Event')

@section('content')
    <div>
        <h2 class="float-left">Events | Edit</h2>
        <a class="btn btn-primary float-right" href="{{ route('admin.dashboard.events') }}">Back</a>
{{--        @if (Auth::user()->hasAllowedRole())--}}
            <a class="btn btn-danger float-right" href="{{ route('admin.dashboard.events.delete', ['id' => $data->id]) }}">Delete</a>
{{--        @endif--}}
    </div>

    <br><br>

    <hr />

    <form method="POST" action="{{ route('admin.dashboard.events.edit', ['id' => $data->id]) }}">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="event">Organisation (<span class="red">*</span>)</label>
            <select class="form-control" id="event" name="organisation" required>
                <option value="">Please select</option>
                <option value="sds" {{ $data->organisation == 'sds' ? 'selected' : '' }}>Student Developer Society</option>
                <option value="dsc" {{ $data->organisation == 'dsc' ? 'selected' : '' }}>DSC APU</option>
            </select>
        </div>

        <div class="form-group">
            <label for="title">Event Title (<span class="red">*</span>)</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" value="{{ $data->title }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description (<span class="red">*</span>)</label>
            <textarea class="form-control" id="description" name="description" placeholder="Enter Description" required rows="5">{{ $data->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="expiry">Expires On (<span class="red">*</span>)</label>
            <input type="datetime-local" class="form-control" id="expiry" name="expiry" value="{{ \Carbon\Carbon::parse($data->expiry)->format('Y-m-d\TH:i') }}" required>
        </div>

        <div class="form-group checkbox">
            <label><input type="checkbox" value="1" name="attendance" {{ $data->attendance == '1' ? 'checked' : '' }}>  Attendance</label>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@stop
