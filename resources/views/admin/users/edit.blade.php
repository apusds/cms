@extends ('layouts.old')

@section('title', 'Manage User')

@section('content')
    <div>
        <h2 class="float-left">Users | Edit</h2>
        <div class="float-right">
            <a class="btn btn-primary float-right" href="{{ route('dashboard.users') }}">Back</a>
            <a class="btn btn-danger float-right" href="{{ route('dashboard.users.delete', ['id' => $data->id]) }}">Delete</a>
        </div>
    </div>

    <br><br>

    <hr />

    <form method="POST" action="{{ route('dashboard.users.edit', ['id' => $data->id]) }}">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="inputUsername">Username (<span class="red">*</span>)</label>
            <input type="text" class="form-control" id="inputUsername" name="username" placeholder="Enter username" value="{{ $data->username }}" required>
        </div>
        <div class="form-group">
            <label for="inputEmail">Email (<span class="red">*</span>)</label>
            <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Enter Email" value="{{ $data->email }}" required>
        </div>
        <div class="form-group">
            <label for="inputPassword">Password</label>
            <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Update Password">
        </div>
        <div class="form-group">
            <label for="roleSelect">Role (<span class="red">*</span>)</label>
            <select class="form-control" id="roleSelect" name="role_id" required>
                <option value="">Please select</option>
                @foreach (\App\Role::all() as $role)
                    <option value="{{ $role->id }}" {{ $role->id == $data->role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>

@stop
