@extends('layouts.admin')

@section('title', 'Event Attendees')

@section('content')
    <div>
        <h2 class="float-left">Events | Attendees</h2>
        <a class="btn btn-primary float-right" href="{{ route('dashboard.events') }}">Back</a>
        <a class="btn btn-success float-right" data-toggle="modal" href="" data-target="#myModal">New Attendee</a>
    </div>

    <br><br>

    <hr />

    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th>Student Name</th>
            <th>TP Number</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($data as $d)
            <tr>
                <td>{{ $d->student_name }}</td>
                <td>{{ $d->student_id }}</td>
                <td>{{ $d->email }}</td>
                <td>
                    @if (!$d->has_checkin)
                        <a class="btn btn-success" href="{{ route('dashboard.events.attendees.mark', ['eid' => $d->event_id, 'uid' => $d->id]) }}">Mark Attendance</a>
                        @else
                        <a class="btn btn-danger disabled" href="">Mark Attendance</a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Attendee</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form method="POST" action="{{ route('dashboard.events.attendees.add', ['id' => $id]) }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name">Student Name (<span class="red">*</span>)</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required>
                        </div>

                        <div class="form-group">
                            <label for="tp">Student ID (<span class="red">*</span>)</label>
                            <input type="text" class="form-control" id="tp" name="tp" placeholder="Enter TP Number" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email (<span class="red">*</span>)</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
@stop
