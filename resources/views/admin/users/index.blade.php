@extends ('layouts.admin')

@section('title', 'Users')

@section('content')
    <div>
        <h2 class="float-left">Users</h2>
        <a class="btn btn-primary float-right" href="{{ route('dashboard.users.create') }}">Add</a>
    </div>

    <br><br><br>

    <div class="row">
        @foreach(\App\User::all() as $user)
            <div class="col-sm-12 col-lg-3">
                <div class="card">
                    <div class="card-header {{ $user->username === Auth::user()->username ? 'bg-danger' : 'bg-success' }}"></div>
                    <div class="card-body">
                        <b>Username</b>: {{ strtolower($user->username) === strtolower(Auth::user()->username) ? "{$user->username} (You)" : $user->username }}
                        <br>
                        <b>Role</b>: {{ $user->role->name }}
                    </div>
                    <div class="card-footer">
                        <div class="text-center">
                            @if (strtolower($user->username) === strtolower(Auth::user()->username))
                                <a href="" class="btn btn-primary disabled">Manage</a>
                            @else
                                <a href="{{ route('dashboard.users.edit') }}" class="btn btn-primary">Manage</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@stop
