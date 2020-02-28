@extends('layouts.auth')

@section('content')
    <div class="logo mb-3">
        <div class="col-md-12 text-center">
            <h1>Please set your password</h1>
        </div>
    </div>

    <form action="{{ route('member.verify.post', ['token' => $token, 'email' => $email]) }}" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password"  class="form-control" placeholder="Enter Password" autocomplete>
        </div>
        <div class="form-group">
            <label for="confirm">Confirm Password</label>
            <input type="password" name="confirm_password" id="confirm"  class="form-control" placeholder="Please re-enter password" autocomplete>
        </div>
        <div class="col-md-12 text-center ">
            <button type="submit" class=" btn btn-block mybtn btn-primary tx-tfm">Login</button>
        </div>
    </form>
@stop
