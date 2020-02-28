@extends('layouts.admin')

@section('title', 'Roles')

@section('content')
    <div>
        <h2 class="float-left">Roles</h2>
    </div>

    <br><br>

    <hr />

    <div class="row">
        @if (count(\App\Role::all()) > 0)
            @foreach (\App\Role::all() as $role)
                <div class="col-sm-12 col-lg-3">
                    <div class="card">
                        <div class="card-header bg-success"></div>
                        <div class="card-body">
                            Role Name: <b>{{ $role->name }}</b>
                            <br>
                            Created: <b>{{ $role->created_at->diffForHumans() }}</b>
                        </div>
                        <div class="card-footer">
                            <div class="text-center">
                                <a href="{{ $role->name === 'SuperAdmin' ? '' : route('admin.dashboard.roles.edit', ['id' => $role->id]) }}" class="btn btn-primary {{ $role->name === 'SuperAdmin' ? 'disabled' : '' }}">Edit</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <h3>Eh! Make a role. </h3>
        @endif
    </div>

    <br><br>
    <h3> Add Role </h3>
    <hr />

    <form method="POST" action="{{ route('admin.dashboard.roles.create') }}">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="inputName">Role Name (<span class="red">*</span>)</label>
            <input type="text" class="form-control" id="inputName" name="name" placeholder="Enter Role Name" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@stop
