@extends('layouts.admin')

@section('title', 'Templates')

@section('content')
    <div>
        <h2 class="float-left">Templates</h2>
        <a class="btn btn-primary float-right" href="{{ route('dashboard.templates.create') }}">Add</a>
    </div>

    <br><br>

    <hr />
@stop
