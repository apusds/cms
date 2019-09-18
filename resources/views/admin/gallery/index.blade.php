@extends('layouts.admin')

@section('title', 'Gallery')

@section('content')
    <div>
        <h2 class="float-left">Gallery</h2>
        <a class="btn btn-primary float-right" href="{{ route('dashboard.gallery.upload') }}">New</a>
    </div>

    <br><br>

    <hr />

    <div class="row">
        @if (count(\App\Gallery::all()) > 0)
            @foreach (\App\Gallery::all() as $gallery)
                <div class="col-sm-12 col-lg-3" style="width: 18rem;">
                    <div class="card">
                        <img class="card-img-top" src="{{ asset(env('PUBLIC_PATH') . '/gallery/' . $gallery->file) }}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{ $gallery->title }}</h5>
                            <p class="card-text">{{ $gallery->eventData()->title }}</p>
                            <a href="{{ route('dashboard.gallery.delete', ['id' => $gallery->id]) }}" class="btn btn-danger">Delete</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <h3>Please add some pictures.</h3>
        @endif
    </div>

@stop
