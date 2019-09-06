@extends('layouts.auth')

@section('content')
    <div class="logo mb-3">
        <div class="col-md-12 text-center">
            <h1>Login</h1>
        </div>
    </div>

    <form action="{{ route('login.post') }}" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username"  class="form-control" id="username" placeholder="Enter username" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password"  class="form-control" placeholder="Enter Password" autocomplete>
        </div>
        <div class="col-md-12 text-center ">
            <button type="submit" class=" btn btn-block mybtn btn-primary tx-tfm">Login</button>
        </div>
    </form>
@stop
