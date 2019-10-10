@extends('layouts.admin')

@section('title', 'Members')

@section('content')
    <div>
        <h2 class="float-left">Members ({{ count(\App\Member::all()) }})</h2>
        <a class="btn btn-primary float-right" href="{{ route('dashboard.members.export') }}">Download</a>
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
            @foreach (\App\Member::all() as $member)
                <tr>
                    <td>{{ $member->email }}</td>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->student_id }}</td>
                    <td>{{ $member->intake }}</td>
                    <td>{{ ucfirst($member->skills) }}</td>
                    <td>{{ $member->found_us }}</td>
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
