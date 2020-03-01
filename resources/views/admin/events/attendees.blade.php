@extends('layouts.admin')

@section('title', 'Event Attendees')

@section('content')
<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="text-center">
            <a class="btn btn-primary" href="{{ route('admin.dashboard.events') }}">Go Back</a>
{{--            <a class="btn btn-success float-right" data-toggle="modal" href="" data-target="#myModal">New Attendee</a>--}}
        </div>
        <hr />

        <input type="text" id="myInput" class="form-control border border-info" placeholder="Filter here..">
        <br>

        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th>Student Name</th>
                <th>Student ID</th>
                <th>Time</th>
            </tr>
            </thead>
            <tbody id="myTable">
            @foreach ($data as $d)
                <tr>
                    <td>{{ \App\Member::all()->where('student_id', '=', $d->student_id)->first()->name ?? 'Deleted Member (' . $d->student_id . ")" }}</td>
                    <td>{{ $d->student_id }}</td>
                    <td>{{ \Carbon\Carbon::parse($d->created_at)->timezone('Asia/Kuala_Lumpur')->diffForHumans() }} ({{ \Carbon\Carbon::parse($d->created_at)->timezone('Asia/Kuala_Lumpur')->format('h:m A') }})</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
@stop
