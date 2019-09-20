@extends('layouts.admin')

@section('title', 'Members')

@section('content')
    <div>
        <h2 class="float-left">Members</h2>
    </div>


    <br><br>

    <hr />

    <div>
        <table class="table table-responsive-sm">
            <thead class="thead-dark">
            <tr>
                <th>Email</th>
                <th>Name</th>
                <th>TP</th>
                <th>Intake</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach (\App\Member::all() as $member)
                <tr>
                    <td>{{ $member->email }}</td>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->student_id }}</td>
                    <td>{{ $member->intake }}</td>
                    <td><button class="btn btn-primary" data-toggle="modal" data-target="#myModal-{{ $member->id }}">Details</button> </td>

                    <div class="modal fade" id="myModal-{{ $member->id }}">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h4 class="modal-title">Member Details</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <div class="modal-body">
                                    <b>Skills</b>: {{ $member->skills }}
                                    <br>
                                    <b>Found us:</b> {{ $member->found_us }}
                                    <br>
                                    <b>Joined:</b> {{ $member->created_at->diffForHumans() }}
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop
