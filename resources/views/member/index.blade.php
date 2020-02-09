@extends('layouts.member')

@section('title', 'Dashboard')

@section('content')
    <h2>Welcome, {{ auth()->guard('member')->user()->name }}!</h2>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header" style="border-bottom: 2px solid green; width: 100%;"></div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title mb-0">Attended Events</h4>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h2>{{ count(auth()->guard('member')->user()->events) }}/{{ count(\App\Event::all()) }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr />

    <h3>Events attended (Breakdown)</h3>
    @if (count(auth()->guard('member')->user()->events) > 0)
        @foreach (auth()->guard('member')->user()->events as $event)
            - {{ $event->meetup_title }}
        @endforeach
    @else
        <h4>- No Events</h4>
    @endif
@stop
