@extends('layouts.admin')

@section('title', 'Meetups')

@section('content')
    <div>
        <h2 class="float-left">Meetups</h2>
        @if (Auth::user()->hasAllowedRole())
            <a class="btn btn-primary float-right" href="{{ route('dashboard.meetups.create') }}">New</a>
        @endif
    </div>

    <br><br>

    <hr />

    <div class="row">
        @if (count(\App\Meetup::all()) > 0)
            @foreach(\App\Meetup::all() as $meetup)
                <div class="col-sm-12 col-lg-3" style="width: 18rem;">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-center">{{ $meetup->title }} </h5>
                            @if(Auth::user()->hasAllowedRole())
                                <div class="card-footer">
                                    <div class="text-center">
                                        <a href="{{ route('dashboard.meetups.edit', ['id' => $meetup->id]) }}" class="btn btn-primary">Edit Meetup</a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <h3>You have no Meetups</h3>
        @endif
    </div>
    <h2 class="float-left">Active Meetups</h2>
    <br><br>

    <div class="row">
        @if (\App\ActiveMeetup::first())
            <div class="col-sm-12 col-lg-3" style="width: 18rem;">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">{{ \App\ActiveMeetup::first()->meetup->title }} </h5>
                        @if(Auth::user()->hasAllowedRole())
                            <div class="card-footer">
                                <div class="text-center">
                                    <a href="{{ route('dashboard.meetups.edit', ['id' => \App\ActiveMeetup::first()->meetup->id]) }}" class="btn btn-primary">Edit Meetup</a>
                                    <a href="{{ route('dashboard.meetups.deactivate') }}" class="btn btn-danger">Unactive</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif

    </div>
@stop
