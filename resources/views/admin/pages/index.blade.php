@extends('layouts.admin')

@section('title', 'Create Page')

@section('content')
    <div>
        <h2 class="float-left">Pages</h2>
        <div class="float-right">
            <a href="{{ route('dashboard.pages.create') }}" class="btn btn-primary">New</a>
        </div>
    </div>

    <br><br>

    <hr />

    <div class="row">
        @if(count(\App\Page::all()) > 0)
            @foreach(\App\Page::all() as $page)
                <div class="col-sm-12 col-lg-3">
                    <div class="card">
                        <div class="card-header {{ $page->created_by == Auth::user()->id ? 'bg-primary' : 'bg-success' }}"></div>
                        <div class="card-body">
                            <b>Accessible @</b><a href="{{ Request::root() }}/pages/{{ $page->uri }}" target="_blank" class="href">{{ $page->uri }}</a>
                            <br>
                            <b>Page Title:</b> {{ $page->title }}
                            <br>
                            <b>Description:</b> {{ $page->description }}
                            <br>
                            <b>Keyword:</b> {{ $page->keyword }}
                            <br>
                            <b>Template:</b> {{ $page->template->title }} ({{ $page->template->template }})
                            <br>
                            <b>Created:</b> {{ $page->created_at->diffForHumans() }}
                            <br>
                            <b>Edited:</b> {{ $page->updated_at != null ? $event->updated_at->diffForHumans() : "Never" }}
                            <br>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <h3>You have no Pages, consider making one.</h3>
        @endif
    </div>
@stop
