@extends('layouts.member')

@section('title', 'Dashboard')

@section('content')
    <!-- WELCOME-->
    <section class="welcome p-t-10">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="title-4">Welcome back,
                        <span>{{ auth()->user()->name }}!</span>
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
                        <h2 class="number">{{ count(auth()->guard('member')->user()->events) }}/{{ count(\App\Event::all()) }}</h2>
                        <span class="desc">Attended Event(s)</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END STATISTIC-->

    <hr />

    <!-- DATA TABLE-->
    <section class="p-t-20">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="title-5 m-b-35">Upcoming Events ({{ count($activeEvents) }})</h3>
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                            <tr>
                                <th>title</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (count($activeEvents) > 0)
                                @foreach ($activeEvents as $event)
                                    <tr class="tr-shadow">
                                        <td>
                                            <span class="block-email" style="color: red;">{{ $event->title }}</span>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($event->expiry)->diffForHumans() < 3 ? \Carbon\Carbon::parse($event->expiry)->format('d/m/Y H:i') : \Carbon\Carbon::parse($event->expiry)->format('d/m/Y H:i') }}</td>
                                        <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">View Event</button></td>
                                    </tr>
                                    <tr class="spacer"></tr>

                                    <!-- The Modal -->
                                    <div class="modal fade" id="myModal">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">{{ $event->title }}</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    <img class="card-img-top" src="{{ asset('storage' . '/posters/' . $event->file) }}" alt="Image is broken">
                                                    <hr />

                                                    <h5>{!! $event->description !!}</h5>
                                                </div>

                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                    <a href="{{ $event->registration }}" target="_blank" type="button" class="btn btn-primary">Register</a>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <tr class="tr-shadow">
                                    <td>
                                        <span class="block-email" style="color: red;">-</span>
                                    </td>
                                    <td>-</td>
                                    <td><a href="#" class="btn btn-danger disabled">Aww :(</a></td>
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
                    <h3 class="title-5 m-b-35">Past Events ({{ count($pastEvents) }})</h3>
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                            <tr>
                                <th>title</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (count($pastEvents) > 0)
                                @foreach ($pastEvents as $event)
                                    <tr class="tr-shadow">
                                        <td>{{ $event->title }}</td>
                                        <td>{{ \Carbon\Carbon::parse($event->expiry)->diffForHumans() < 3 ? \Carbon\Carbon::parse($event->expiry)->format('d/m/Y H:i A') . " (Ended)" : \Carbon\Carbon::parse($event->expiry)->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                @endforeach
                            @else
                                <tr class="tr-shadow">
                                    <td>No Event</td>
                                    <td>-</td>
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
