@extends('layouts.admin')

@section('title', 'Teams')

@section('content')
    <div class="container">
        <div>
            <a class="btn btn-primary float-right" href="{{ route('admin.dashboard.teams.create') }}">New</a>
        </div>

        <div class="row">
            @if (count(\App\Committee::all()) > 0)
                @foreach (\App\Committee::all() as $committee)
                    <div class="col-sm-12 col-lg-3" style="width: 18rem;">
                        <div class="card" style="width: 350px !important;">
                            <img class="card-img-top img-fluid" src="{{ asset('storage' . '/committee/' . $committee->file) }}" alt="Image not loaded" style="height: 350px !important;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $committee->name }}</h5>
                                <p class="card-text">{{ $committee->role }}</p>
                                <a href="{{ route('admin.dashboard.teams.delete', ['id' => $committee->id]) }}" class="btn btn-danger">Delete</a>
                                <a href="{{ route('admin.dashboard.teams.edit', ['id' => $committee->id]) }}" class="btn btn-primary">Edit</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <h3>Please add some pictures.</h3>
            @endif
        </div>
    </div>
@stop
