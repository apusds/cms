@extends('layouts.admin')

@section('title', 'Create Template')

@section('content')
    <div>
        <h2 class="float-left">Templates | Create</h2>
        <a class="btn btn-danger float-right" href="{{ route('dashboard.templates') }}">Back</a>
    </div>

    <br><br>

    <hr />

    <form method="POST" action="{{ route('dashboard.templates.create') }}">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="title">Template Title (<span class="red">*</span>)</label>
            <input class="form-control" id="title" name="title" placeholder="The title for your Template" required>
        </div>

        <div class="form-group">
            <label for="template">Template File Name (<span class="red">*</span>)</label>
            <input class="form-control" id="template" name="template" placeholder="Example: event.blade.php" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@stop
