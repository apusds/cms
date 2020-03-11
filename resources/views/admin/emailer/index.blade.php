@extends('layouts.admin')

@section('title', 'Emailer')

@section('content')
    <div class="container">
        <form method="POST" action="{{ route('admin.dashboard.emailer') }}">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="title" style="margin-bottom: 0px;">Email Title (<span class="red">*</span>)</label>
                <br>
                <small style="color: red">Example: [APUSDS] Me is gae</small>
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" required>
            </div>

            <div class="form-group">
                <label for="recipient">To (<span class="red">*</span>)</label>
                <select class="form-control" id="recipient" name="recipient" required>
                    <option value="">Please select</option>
                    <option disabled>General Broadcast</option>
                    <option value="all-member">All Members</option>
                    @if (count(\App\Committee::all()) > 0)
                        <option value="all-committees">All Committees</option>
                        <option disabled>Specific Committee</option>
                        @foreach (\App\Committee::all() as $committee)
                            <option value="{{ $committee->email }}">{{ $member->name }}</option>
                        @endforeach
                    @endif
                    <option disabled>Specific Member</option>
                    @foreach (\App\Member::all() as $member)
                        <option value="{{ $member->email }}">{{ $member->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="summer-note">Email Body (<span class="red">*</span>)</label>
                <textarea id="summer-note" name="body" required></textarea>
            </div>

            <button class="btn btn-success" type="submit">Send</button>
        </form>
    </div>

    <br>
@stop
