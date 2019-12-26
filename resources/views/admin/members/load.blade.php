<div class="d-flex align-items-baseline">
    <div class="p-2">
        {{ $members->total() }} result(s).
    </div>
    <div class="p-2">
        {{ $members->links() }}
    </div>
    <div class="p-2">
        <select class="custom-select" name="perPage" id="perPage">
            @foreach (['20', '50', '100', '250'] as $rowsPerPage)
                <option @if ($rowsPerPage == $perPage) selected @endif value="{{ $rowsPerPage }}">{{ $rowsPerPage }} </option>
            @endforeach
        </select>
    </div>
</div>
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
    @foreach ($members as $member)
        <tr>
            <td>{{ $member->email }} <span style="color: red; text-decoration: underline" data-toggle="modal" data-target="#showEventsAttended-{{ $member->id }}">({{ count($member->events) }})</span></td>
            <td>{{ $member->name }}</td>
            <td>{{ $member->student_id }}</td>
            <td>{{ $member->intake }}</td>
            <td>{{ ucfirst($member->skills) }}</td>
            <td>{{ $member->found_us }}</td>
            <td><a class="btn btn-primary" href="{{ route('dashboard.members.edit', ['id' => $member->id]) }}">Edit</a></td>
        </tr>

        <div class="modal fade" id="showEventsAttended-{{ $member->id }}" tabindex="-1" role="dialog" aria-labelledby="showEventsAttendedLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="showEventsAttendedLabel">Attended Events</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @if (count($member->events) > 0)
                            @foreach ($member->events as $event)
                                <h5>- {{ $event->meetup_title }}</h5>
                            @endforeach
                        @else
                            <h5 class="text-muted text-center">No events attended.</h5>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    </tbody>
</table>
<div class="d-flex align-items-baseline">
    <div class="p-2">
        {{ $members->total() }} result(s).
    </div>
    <div class="p-2">
        {{ $members->links() }}
    </div>
    <div class="p-2">
        <select class="custom-select" name="perPage" id="perPage">
            @foreach (['20', '50', '100', '250'] as $rowsPerPage)
                <option @if ($rowsPerPage == $perPage) selected @endif value="{{ $rowsPerPage }}">{{ $rowsPerPage }} </option>
            @endforeach
        </select>
    </div>
</div>
