@extends('layouts.auth')

@section('title', 'Member')

@section('content')
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-pic">
                @if (count($activeEvents) > 0)
                    <table class="table">
                        <thead>
                        <tr>
                            <th style="color: white; background-color: black; border-color: white">Upcoming Event(s)</th>
                            <th style="color: white; background-color: black; border-color: white">Countdown</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($activeEvents as $e)
                            <tr>
                                <td>{{ $e->title }}</td>
                                <td>{{ \Carbon\Carbon::parse($e->expiry)->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <img src="{{ asset('login/images/img-01.png') }}" alt="IMG">
                @endif
            </div>

            <form class="login100-form validate-form" method="POST" action="{{ route('member.login.post') }}">
                {{ csrf_field() }}

                <span class="login100-form-title">
                    Member Login
                </span>

                <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                    <input class="input100" type="text" name="email" placeholder="Email">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                    </span>
                </div>

                <div class="wrap-input100 validate-input" data-validate = "Password is required">
                    <input class="input100" type="password" name="password" placeholder="Password">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                    </span>
                </div>

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn">
                        Login
                    </button>
                </div>

                <div class="text-center p-t-136">
                    <a class="txt2" href="{{ asset('documents/policy.pdf') }}" target="_blank">
                        Our Privacy Policy
                        <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>
@stop
