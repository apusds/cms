@extends('layouts.admin')

@section('title', 'Events')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <h3>More new stuffs will be added soon!</h3>
            <div class="text-center">
                <a class="btn btn-primary" href="{{ route('admin.dashboard.events.create') }}">Add</a>
            </div>
            <hr />

            <div class="row">
                @if (count(\App\Event::all()) > 0)
                    @foreach(\App\Event::all() as $event)
                        <div class="col-sm-12 col-lg-3">
                            <div class="card">
                                <img class="card-img-top" src="{{ asset('storage' . '/posters/' . $event->file) }}" alt="Image is broken">
                                <div class="card-body">
                                    <h4 class="card-title mb-3">{{ $event->title }} ({{ strtoupper($event->organisation) }})</h4>
                                    <p class="card-text">Expiry: <span style="color: red">{{ \Carbon\Carbon::parse($event->expiry)->diffForHumans() }} ({{ \Carbon\Carbon::parse($event->expiry)->format('d/m/Y H:i A') }})</span></p>
                                    <p class="card-text">Attendance Recording: <span style="color: red">{{ $event->attendance == '1' ? 'Yes' : 'No' }}</span></p>
                                    <p class="card-text">Created By: <span style="color: red">{{ $event->created_by == Auth::user()->id ? 'You' : \App\User::all()->find($event->created_by)->username }}</span></p>
                                </div>
                                <div class="card-footer">
                                    <div class="text-center">
                                        <a href="{{ route('admin.dashboard.events.edit', ['id' => $event->id]) }}" class="btn btn-primary">Edit Event</a>
                                        <a href="{{ route('admin.dashboard.events.qr', ['id' => $event->id]) }}" target="_blank" class="btn btn-success">Generate QR</a>
                                        <a href="{{ route('admin.dashboard.events.attendees', ['id' => $event->id]) }}" class="btn btn-danger">Attendees</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <h3>You have no Events</h3>
                @endif
            </div>
        </div>
    </div>
@stop
