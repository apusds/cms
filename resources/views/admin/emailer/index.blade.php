@extends('layouts.old')

@section('title', 'Emailer')

@section('content')
    <div>
        <h2 class="float-left">Emailer (Sends Email to all Members)</h2>
    </div>

    <br><br>

    <hr />

    <form method="POST" action="{{ route('dashboard.emailer') }}">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="title">Email Title (<span class="red">*</span>)</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" required>
        </div>

        <div class="form-group">
            <label for="summer-note">Email Body (<span class="red">*</span>)</label>
            <textarea id="summer-note" name="body" required></textarea>
        </div>

        <button class="btn btn-success" type="submit">Send</button>
    </form>
@stop
