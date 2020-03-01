@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <!-- WELCOME-->
    <section class="welcome p-t-10">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="title-4">Welcome back,
                        <span>{{ auth()->user()->username }}!</span>
                    </h1>
                    <hr class="line-seprate">
                </div>
            </div>
        </div>
    </section>
    <!-- END WELCOME-->

    <!-- STATISTIC-->
    <section class="statistic statistic2">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <div class="statistic__item statistic__item--red">
                        <h2 class="number">{{ count(\App\Member::all()) }}</h2>
                        <span class="desc">total member(s)</span>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="statistic__item statistic__item--orange">
                        <h2 class="number">{{ count($joinedToday) }}</h2>
                        <span class="desc">joined today ({{ date('d/m/y') }})</span>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="statistic__item statistic__item--red">
                        <h2 class="number">{{ count(\App\Event::all()) }}</h2>
                        <span class="desc">total event(s)</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END STATISTIC-->

    <!-- DATA TABLE-->
    <section class="p-t-20">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="title-5 m-b-35">Upcoming Events</h3>
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                            <tr>
                                <th>title</th>
                                <th>organisation</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (count($activeEvents) > 0)
                                @foreach ($activeEvents as $event)
                                    <tr class="tr-shadow">
                                        <td>{{ $event->title }}</td>
                                        <td>
                                            <span class="block-email" style="color: red;">{{ strtoupper($event->organisation) }}</span>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($event->expiry)->diffForHumans() < 3 ? \Carbon\Carbon::parse($event->expiry)->format('d/m/Y H:i') . " (Ended)" : \Carbon\Carbon::parse($event->expiry)->format('d/m/Y H:i') }}</td>
                                        <td><a href="{{ route('admin.dashboard.events') }}" class="btn btn-success">View</a></td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                @endforeach
                            @else
                                <tr class="tr-shadow">
                                    <td>No Event</td>
                                    <td>
                                        <span class="block-email" style="color: red;">-</span>
                                    </td>
                                    <td>-</td>
                                    <td><a href="{{ route('admin.dashboard.events') }}" class="btn btn-success disabled">View</a></td>
                                </tr>
                                <tr class="spacer"></tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END DATA TABLE-->

    <!-- DATA TABLE-->
    <section class="p-t-20">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="title-5 m-b-35">Past Events</h3>
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                            <tr>
                                <th>title</th>
                                <th>organisation</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (count($pastEvents) > 0)
                                @foreach ($pastEvents as $event)
                                    <tr class="tr-shadow">
                                        <td>{{ $event->title }}</td>
                                        <td>
                                            <span class="block-email" style="color: red;">{{ strtoupper($event->organisation) }}</span>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($event->expiry)->diffForHumans() < 3 ? \Carbon\Carbon::parse($event->expiry)->format('d/m/Y H:i') . " (Ended)" : \Carbon\Carbon::parse($event->expiry)->format('d/m/Y H:i') }}</td>
                                        <td><a href="{{ route('admin.dashboard.events') }}" class="btn btn-success">View</a></td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                @endforeach
                            @else
                                <tr class="tr-shadow">
                                    <td>No Event</td>
                                    <td>
                                        <span class="block-email" style="color: red;">-</span>
                                    </td>
                                    <td>-</td>
                                    <td><a href="{{ route('admin.dashboard.events') }}" class="btn btn-success disabled">View</a></td>
                                </tr>
                                <tr class="spacer"></tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END DATA TABLE-->
@stop
