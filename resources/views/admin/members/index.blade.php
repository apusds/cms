@extends('layouts.admin')

@section('title', 'Members')

@section('content')
    <!-- DATA TABLE-->
    <section class="p-t-20">
        <div class="container">
            <div class="text-center">
                <a class="btn btn-primary" href="{{ route('admin.dashboard') }}">Go Back</a>
                <a class="btn btn-danger" href="{{ route('admin.dashboard.members.export') }}" target="_blank">Export as CSV (Excel)</a>
            </div>

            <hr />

            <div class="row">
                <div class="col-md-12">
                    <input type="text" id="myInput" class="form-control" placeholder="Filter here.." autofocus>
                    <br>

                    <h3 class="title-5 m-b-35">Members ({{ count(\App\Member::all()) }})</h3>
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                            <tr>
                                <th>Email</th>
                                <th>Name</th>
                                <th>TP Number</th>
                                <th>Intake</th>
                                <th>Skills</th>
                                <th>Found us</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="myTable">
                            @foreach ($members as $member)
                                <tr class="tr-shadow">
                                    <td>
                                        <span class="block-email" style="color: red;">{{ $member->email }}</span>
                                    </td>
                                    <td><b>{{ $member->name }}</b></td>
                                    <td>{{ strtoupper($member->student_id) }}</td>
                                    <td>{{ strtoupper($member->intake) }}</td>
                                    <td>{{ $member->skills }}</td>
                                    <td>{{ $member->found_us }}</td>
                                    <td>
                                        <span class="block-email" style="color: red;">{{ $member->password == null ? 'Inactive' : 'Active' }}</span>
                                    </td>
                                    <td><a class="btn btn-primary" href="{{ route('admin.dashboard.members.edit', ['id' => $member->id]) }}">Edit</a></td>
                                </tr>
                                <tr class="spacer"></tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END DATA TABLE-->

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
