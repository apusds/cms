@extends('layouts.admin')

@section('title', 'Templates')

@section('content')
    <div>
        <h2 class="float-left">Templates</h2>
        <a class="btn btn-primary float-right" href="{{ route('dashboard.templates.create') }}">Add</a>
    </div>

    <br><br>

    <hr />

    <div class="row">
        @if (count(\App\Template::all()) > 0)
            @foreach (\App\Template::all() as $template)
                <div class="col-sm-12 col-lg-3">
                    <div class="card">
                        <div class="card-header bg-success"></div>
                        <div class="card-body">
                            Template Name: <b>{{ $template->title }}</b>
                            <br>
                            Template File: <b>{{ $template->template }}</b>
                            <br>
                            Added by: <b>{{ $template->user->username }}</b>
                        </div>
                        <div class="card-footer">
                            <div class="text-center">
                                <a href="{{ route('dashboard.templates.edit', ['id' => $template->id]) }}" class="btn btn-primary">Edit</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <h3>Eh! Make a Template. </h3>
        @endif
    </div>
@stop
