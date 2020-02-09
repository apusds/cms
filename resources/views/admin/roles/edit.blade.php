@extends('layouts.admin')

@section('title', 'Edit Role')

@section('content')
    <div>
        <h2 class="float-left">Roles | Edit</h2>
        <div class="float-right">
            <a href="{{ route('dashboard.roles') }}" class="btn btn-danger">Back</a>
        </div>
    </div>

    <br><br>

    <hr />

    <form method="POST" action="{{ route('dashboard.roles.edit', ['id' => $role->id]) }}">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="inputName">Role Name (<span class="red">*</span>)</label>
            <input type="text" class="form-control" id="inputName" name="name" placeholder="Enter Role Name" value="{{ $role->name }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@stop
