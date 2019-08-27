@extends ('layouts.admin')

@section('title', 'New User')

@section('content')
    <div>
        <h2 class="float-left">Users | Create</h2>
        <a class="btn btn-primary float-right" href="{{ route('dashboard.users') }}">Back</a>
    </div>

    <br><br><br>

    <form method="POST" action="{{ route('dashboard.users.create') }}">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="inputUsername">Username</label>
            <input type="text" class="form-control" id="inputUsername" name="username" placeholder="Enter username" required>
        </div>
        <div class="form-group">
            <label for="inputEmail">Email</label>
            <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Enter Email" required>
        </div>
        <div class="form-group">
            <label for="inputPassword">Password</label>
            <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Enter Password" required>
        </div>
        <div class="form-group">
            <label for="roleSelect">Role</label>
            <select class="form-control" id="roleSelect" name="role_id" required>
                <option value="">Please select</option>
                @foreach (\App\Role::all() as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@stop
