@extends('layouts.admin')

@section('title', 'My Profile')

@section('content')
    <div>
        <h2 class="float-left">My Profile</h2>
        <div class="float-right">
            <a href="{{ route('dashboard.roles') }}" class="btn btn-danger">Back</a>
        </div>
    </div>

    <br><br>

    <hr />

    <form method="POST" action="{{ route('dashboard.profile') }}">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="password">Password (<span class="red">*</span>)</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter New Password" required>
        </div>

        <div class="form-group">
            <label for="confirm">Confirm Password (<span class="red">*</span>)</label>
            <input type="password" class="form-control" id="confirm" name="confirm" placeholder="Confirm your Password" required>
        </div>

        <span class="red">Please note that your changes cannot be undone & you will be automatically logged out.</span>
        <hr />

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@stop
