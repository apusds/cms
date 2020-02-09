@extends('layouts.admin')

@section('title', 'Teams')

@section('content')
    <div>
        <h2 class="float-left">Teams | Upload</h2>
        <a class="btn btn-danger float-right" href="{{ route('dashboard.teams') }}">Back</a>
    </div>

    <br><br>

    <hr />

    <form method="POST" action="{{ route('dashboard.teams.create') }}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="name">Name (<span class="red">*</span>)</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Member Name" required>
        </div>

        <div class="form-group">
            <label for="role">Role (<span class="red">*</span>)</label>
            <input type="text" class="form-control" id="role" name="role" placeholder="Enter Role" required>
        </div>

        <label>Upload the Image (<span class="red">*</span>)</label>
        <div class="custom-file">
            <label class="custom-file-label" for="customFile">Choose file</label>
            <input type="file" class="custom-file-input" id="customFile" name="file" required>
        </div>

        <br><br>
        <div>
            <h2>Social Links</h2>
        </div>
        <hr />

        <div class="form-group">
            <label for="facebook">Facebook</label>
            <input type="text" class="form-control" id="facebook" name="facebook" placeholder="Example: Facebook Link">
        </div>

        <div class="form-group">
            <label for="twitter">Twitter</label>
            <input type="text" class="form-control" id="twitter" name="twitter" placeholder="Example: Twitter Link">
        </div>

        <div class="form-group">
            <label for="instagram">Instagram</label>
            <input type="text" class="form-control" id="instagram" name="instagram" placeholder="Example: Instagram Link">
        </div>

        <div class="form-group">
            <label for="linkedln">Linkedln</label>
            <input type="text" class="form-control" id="linkedln" name="linkedln" placeholder="Example: Linkedln Link">
        </div>

        <button type="submit" id="submitBtn" class="btn btn-primary">Submit</button>
        <a href="{{ route('dashboard.teams.create') }}" class="btn btn-success">Reset Fields</a>
    </form>
@stop
