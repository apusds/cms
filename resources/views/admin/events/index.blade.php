@extends('layouts.admin')

@section('title', 'Events')

@section('content')
    <div>
        <h2 class="float-left">Events</h2>
        @if (Auth::user()->hasAllowedRole())
            <a class="btn btn-primary float-right" href="{{ route('dashboard.events.create') }}">New</a>
        @endif
    </div>

    <br><br>

    <hr />

    <div class="row">
        @if (count(\App\Event::all()) > 0)
            @foreach(\App\Event::all() as $event)
                <div class="col-sm-12 col-lg-3">
                    <div class="card">
                        <div class="card-header {{ $event->created_by == Auth::user()->id ? 'bg-primary' : 'bg-success' }}"></div>
                        <div class="card-body">
                            <b>Event Name</b>: {{ $event->title }}
                            <br>
                            <b>Description</b>: {{ $event->description }}
                            <br>
                            <b>Created By</b>: {{ $event->created_by == Auth::user()->id ? 'You' : \App\User::all()->find($event->created_by)->username }}
                            <br>
                            <b>Created</b>: {{ $event->created_at->diffForHumans() }}
                            <br>
                            <b>Edited</b>: {{ $event->updated_at != null ? $event->updated_at->diffForHumans() : "Never" }}
                            <br>
                            <b>Expires in</b>: <span class="red">{{ \Carbon\Carbon::parse($event->expiry)->diffForHumans() }}</span>
                            @if (\Carbon\Carbon::parse($event->expiry)->diffInHours() < 3)
                                <br>
                                <b class="red">Note: This event will end soon.</b>
                            @endif
                        </div>
                        @if(Auth::user()->hasAllowedRole())
                            <div class="card-footer">
                                <div class="text-center">
                                    <a href="{{ route('dashboard.events.edit', ['id' => $event->id]) }}" class="btn btn-primary">Edit Event</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <h3>You have no Events</h3>
        @endif
    </div>
@stop
