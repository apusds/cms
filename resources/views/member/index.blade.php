@extends('layouts.member')

@section('title', 'Dashboard')

@section('content')
    <h2>Hi sir</h2>
    <a
        class="{{ Session::has('ticket') ? 'btn btn-danger' : 'btn btn-primary' }}"
        href="https://cas.apiit.edu.my/cas/login?service={{ Request::root() }}/api/cas/auth">
        {{ Session::has('ticket') ? Session::get('ticket') : 'Link to CAS' }}
    </a>
@stop
