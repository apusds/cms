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
                            <b>Accessible @</b><a href="{{ Request::root() }}/pages/{{ $page->uri }}" target="_blank" class="href">{{ Request::root() }}/pages/{{ $page->uri }}</a>
                            <!-- To be routed -->
                            <br>
                            <b>Page Title:</b> {{ $page->title }}
                            <br>
                            <b>Description:</b> {{ $page->description == null ? 'Not specified' : $page->description }}
                            <br>
                            <b>Keyword:</b> {{ $page->keyword == null ? 'Not specified' : $page->keyword }}
                            <br>
                            <b>Template:</b> {{ $page->template->title }} ({{ $page->template->template }})
                            <br>
                            <b>Created:</b> {{ $page->created_at->diffForHumans() }}
                            <br>
                            <b>Edited:</b> {{ $page->updated_at != null ? $page->updated_at->diffForHumans() : "Never" }}
                            <br>
                            <b>By:</b> {{ $page->user->username === Auth::user()->username ? "{$page->user->username} (You)" : $page->user->username }}
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-center">
                            <a href="{{ route('dashboard.pages.edit', ['id' => $page->id]) }}" class="btn btn-primary">Edit</a>
                            <a href="{{ route('dashboard.pages.delete', ['id' => $page->id]) }}" class="btn btn-danger">Delete</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <h3>You have no Pages, consider making one.</h3>
        @endif
    </div>
@stop
