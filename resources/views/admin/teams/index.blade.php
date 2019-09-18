@extends('layouts.admin')

@section('title', 'Teams')

@section('content')
    <div>
        <h2 class="float-left">Teams</h2>
        <a class="btn btn-primary float-right" href="{{ route('dashboard.teams.create') }}">New</a>
    </div>

    <br><br>

    <hr />

    <div class="row">
        @if (count(\App\Committee::all()) > 0)
            @foreach (\App\Committee::all() as $committee)
                <div class="col-sm-12 col-lg-3" style="width: 18rem;">
                    <div class="card">
                        <img class="card-img-top" src="{{ asset(env('PUBLIC_PATH') . '/committee/' . $committee->file) }}" alt="Image not loaded">
                        <div class="card-body">
                            <h5 class="card-title">{{ $committee->name }}</h5>
                            <p class="card-text">{{ $committee->role }}</p>
                            <a href="{{ route('dashboard.teams.delete', ['id' => $committee->id]) }}" class="btn btn-danger">Delete</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <h3>Please add some pictures.</h3>
        @endif
    </div>
@stop
