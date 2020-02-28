@extends('layouts.admin')

@section('title', 'Events')

@section('content')
    <div>
        <h2 class="float-left">Events</h2>
        <a class="btn btn-primary float-right" href="{{ route('admin.dashboard.events.create') }}">New</a>
    </div>

    <br><br>

    <hr />

    <div class="row">
        @if (count(\App\Event::all()) > 0)
            @foreach(\App\Event::all() as $event)
                <div class="col-sm-12 col-lg-3" style="width: 18rem;">
                    <div class="card">
                        <img class="card-img-top" src="{{ asset('storage' . '/posters/' . $event->file) }}" alt="Image is broken">
                        <div class="card-body">
                            <h5 class="card-title">{{ $event->title }} ({{ strtoupper($event->organisation) }})</h5>
                            <p class="card-text">Expiry: <span class="red">{{ \Carbon\Carbon::parse($event->expiry)->diffForHumans() }} ({{ $event->expiry }})</span></p>
                            <p class="card-text">Form Enabled: <span class="red">{{ $event->attendance == '1' ? 'Yes' : 'No' }}</span></p>
                            <p class="card-text">Created By: <span class="red">{{ $event->created_by == Auth::user()->id ? 'You' : \App\User::all()->find($event->created_by)->username }}</span></p>
                            @if (\Carbon\Carbon::parse($event->expiry)->diffInHours() < 3)
                                <b class="red">Note: This event will end soon.</b>
                            @endif
{{--                            @if(Auth::user()->hasAllowedRole())--}}
                                <div class="text-center">
                                    <a href="{{ route('admin.dashboard.events.edit', ['id' => $event->id]) }}" class="btn btn-primary">Edit Event</a>
                                    <a href="{{ route('admin.dashboard.events.qr', ['id' => $event->id]) }}" class="btn btn-primary">Generate QR</a>
                                    <a href="{{ route('admin.dashboard.events.attendees', ['id' => $event->id]) }}" class="btn btn-danger">Attendees</a>
                                </div>
{{--                            @endif--}}
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <h3>You have no Events</h3>
        @endif
    </div>
@stop
