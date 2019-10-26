@extends('layouts.admin')

@section('title', 'Meetup Attendees')

@section('content')
    <div>
        <h2 class="float-left">{{ $title }} Attendees ({{ \App\MeetupAttendee::where('meetup_title', $title)->count() }})</h2>
    </div>

    <br><br>

    <hr />

    <br>
    <input type="text" id="myInput" class="form-control border border-info" placeholder="Filter here..">
    <br>

    <div>
        <table class="table table-responsive-sm">
            <thead class="thead-dark">
            <tr>
                <th>Email</th>
                <th>Name</th>
                <th>TP</th>
                <th>Intake</th>
                <th>Skills</th>
                <th>Found us</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody id="myTable">
            @foreach (\App\MeetupAttendee::where('meetup_title', $title)->with('member')->get() as $member)
                <tr>
                    <td>{{ $member->member->email }}</td>
                    <td>{{ $member->member->name }}</td>
                    <td>{{ $member->member->student_id }}</td>
                    <td>{{ $member->member->intake }}</td>
                    <td>{{ ucfirst($member->member->skills) }}</td>
                    <td>{{ $member->member->found_us }}</td>
                    <td><a class="btn btn-primary" href="{{ route('dashboard.members.edit', ['id' => $member->id]) }}">Edit</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
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
