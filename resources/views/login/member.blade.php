@extends('layouts.auth')

@section('content')
    <div class="logo mb-3">
        <div class="col-md-12 text-center">
            <h1>Login (Member)</h1>
        </div>
    </div>

    <form action="{{ route('member.login.post') }}" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email"  class="form-control" id="email" placeholder="Enter email" required>
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
