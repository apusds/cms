@extends('layouts.admin')

@section('title', 'Templates')

@section('content')
    <div>
        <h2 class="float-left">Templates</h2>
    </div>

    <br><br>

    <hr />

    <div class="row">
        @if (count(\App\Template::all()) > 0)
            @foreach (\App\Template::all() as $template)
                <div class="col-sm-12 col-lg-3">
                    <div class="card">
                        <div class="card-header {{ $template->user->id === Auth::user()->id ? 'bg-danger' : 'bg-success'}}"></div>
                        <div class="card-body">
                            Template Name: <b>{{ $template->title }}</b>
                            <br>
                            Template File: <b>{{ $template->template }}</b>
                            <br>
                            Added by: <b>{{ $template->user->username === Auth::user()->username ? "{$template->user->username} (You)" : $template->user->username }}</b>
                        </div>
                        <div class="card-footer">
                            <div class="text-center">
                                <a href="{{ route('dashboard.templates.edit', ['id' => $template->id]) }}" class="btn btn-primary">Edit</a>
                                @if (Auth::user()->isSuperAdmin())
                                    <a href="{{ route('dashboard.templates.delete', ['id' => $template->id]) }}" class="btn btn-danger">Delete</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <h3>Eh! Make a Template. </h3>
        @endif
    </div>

    <br><br>
    <h3> Add Template </h3>
    <hr />

    <form method="POST" action="{{ route('dashboard.templates.create') }}">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="title">Template Title (<span class="red">*</span>)</label>
            <input class="form-control" id="title" name="title" placeholder="The title for your Template" required>
        </div>

        <div class="form-group">
            <label for="template">Template File Name (<span class="red">*</span>)</label>
            <input class="form-control" id="template" name="template" placeholder="Example: event.blade.php" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@stop
