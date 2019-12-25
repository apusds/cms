@extends('layouts.member')

@section('title', 'Dashboard')

@section('content')
    <h2>Hi sir</h2>
    <a
        class="{{ Session::has('ticket') ? 'btn btn-danger' : 'btn btn-primary' }}"
        href="https://cas.apiit.edu.my/cas/login?service=http://127.0.0.1:8000/api/cas/auth">
        {{ Session::has('ticket') ? Session::get('ticket') : 'Link to CAS' }}
    </a>
@stop
