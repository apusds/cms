@extends('layouts.admin')

@section('title', 'Create Page')

@section('content')
    <div>
        <h2 class="float-left">Pages</h2>
        <div class="float-right">
            <a href="{{ route('dashboard.pages.create') }}" class="btn btn-primary">New</a>
        </div>
    </div>

    <br><br><br>

    <!--- TODO -->
@stop
