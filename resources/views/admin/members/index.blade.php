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
                <th>Joined</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                @foreach (\App\Member::all() as $member)
                    <td>{{ $member->email }}</td>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->student_id }}</td>
                    <td>{{ $member->intake }}</td>
                    <td>{{ $member->created_at->diffForHumans() }}</td>
                @endforeach
            </tr>
            </tbody>
        </table>
    </div>
@stop
