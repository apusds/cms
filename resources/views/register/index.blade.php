@extends('layouts.auth')

@section('content')
    <div class="logo mb-3">
        <div class="col-md-12 text-center">
            <h1>Register</h1>
        </div>
    </div>

    <form action="" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" name="email"  class="form-control" id="email" placeholder="Enter Email" required>
        </div>
        <div class="form-group">
            <label for="name">Your Name</label>
            <input type="text" name="name"  class="form-control" id="name" placeholder="Enter Name" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password"  class="form-control" placeholder="Enter Password" autocomplete>
        </div>
        <div class="col-md-12 text-center ">
            <button type="submit" class=" btn btn-block mybtn btn-primary tx-tfm">Register</button>
        </div>
    </form>
@stop
