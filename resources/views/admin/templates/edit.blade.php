@extends('layouts.admin')

@section('title', 'Edit Template')

@section('content')
    <div>
        <h2 class="float-left">Templates | Edit</h2>
        <a class="btn btn-danger float-right" href="{{ route('dashboard.templates') }}">Back</a>
    </div>

    <br><br>

    <hr />

@stop
