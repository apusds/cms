@extends('layouts.admin')

@section('title', 'Gallery')

@section('content')
    <div>
        <h2 class="float-left">Gallery</h2>
        <a class="btn btn-primary float-right" href="{{ route('dashboard.gallery.upload') }}">New</a>
    </div>

    <br><br>

    <hr />


@stop
