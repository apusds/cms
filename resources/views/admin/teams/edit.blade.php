@extends('layouts.admin')

@section('title', 'Teams')

@section('content')
    <div class="container">
        <div>
            <a class="btn btn-danger float-right" href="{{ route('admin.dashboard.teams') }}">Back</a>
        </div>

        <br>

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

            <div class="form-group">
                <label for="email">Email (<span class="red">*</span>)</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="{{ $data->email }}" required>
            </div>

            <hr />

            <div class="form-group">
                <label for="sel1">Active Status</label>
                <select class="form-control" id="isActive" name="isActive" required>
                    <option value="">Please select</option>
                    <option value="1" {{ $data->isActive ? "selected" : "" }}>Yes</option>
                    <option value="0" {{ !$data->isActive ? "selected" : "" }}>No</option>
                </select>
            </div>

            <div class="form-group">
                <label for="summary">Summary</label>
                <textarea placeholder="Please type the summary of them :)" class="form-control" rows="5" id="summary" name="summary">{{ $data->summary }}</textarea>
            </div>

            <br>
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
    </div>

    <br>
@stop
