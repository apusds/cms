@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header" style="border-bottom: 2px solid green; width: 100%;"></div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title mb-0">Members (Total)</h4>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h2>{{ count(\App\Member::all()) }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header" style="border-bottom: 2px solid red; width: 100%;"></div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title mb-0">Joined Today (Total Member)</h4>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h2>{{ count($joinedToday) }}</h2>
                        <span class="float-right" style="padding-top: 7px;">Today's Date: {{ date('d/m/y') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header" style="border-bottom: 2px solid black; width: 100%;"></div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title mb-0">Events (Total)</h4>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h2>{{ count(\App\Event::all()) }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
