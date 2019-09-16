@extends('layouts.admin')

@section('title', 'Teams')

@section('content')
    <div>
        <h2 class="float-left">Teams</h2>
        <a class="btn btn-primary float-right" href="{{ route('dashboard.teams.create') }}">New</a>
    </div>

    <br><br>

    <hr />


@stop
