@extends('layouts.admin')

@section('title', 'Teams')

@section('content')
    <div>
        <h2 class="float-left">Teams | Edit</h2>
        <a class="btn btn-danger float-right" href="{{ route('admin.dashboard.teams') }}">Back</a>
    </div>

    <br><br>

    <hr />

    <form method="POST" action="{{ route('admin.dashboard.teams.edit', ['id' => $data->id]) }}">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="name">Name (<span class="red">*</span>)</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Member Name" value="{{ $data->name }}" required>
        </div>

        <div class="form-group">
            <label for="role">Role (<span class="red">*</span>)</label>
            <input type="text" class="form-control" id="role" name="role" placeholder="Enter Role" value="{{ $data->role }}" required>
        </div>

        <br><br>
        <div>
            <h2>Social Links</h2>
        </div>
        <hr />

        <div class="form-group">
            <label for="facebook">Facebook</label>
            <input type="text" class="form-control" id="facebook" name="facebook" value="{{ $data->facebook }}" placeholder="Example: Facebook Link">
        </div>

        <div class="form-group">
            <label for="twitter">Twitter</label>
            <input type="text" class="form-control" id="twitter" name="twitter" value="{{ $data->twitter }}" placeholder="Example: Twitter Link">
        </div>

        <div class="form-group">
            <label for="instagram">Instagram</label>
            <input type="text" class="form-control" id="instagram" name="instagram" value="{{ $data->instagram }}" placeholder="Example: Instagram Link">
        </div>

        <div class="form-group">
            <label for="linkedln">Linkedln</label>
            <input type="text" class="form-control" id="linkedln" name="linkedln" value="{{ $data->linkedln }}" placeholder="Example: Linkedln Link">
        </div>

        <button type="submit" id="submitBtn" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.dashboard.teams.edit', ['id' => $data->id]) }}" class="btn btn-success">Reset Fields</a>
    </form>
@stop
