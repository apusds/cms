@extends('layouts.old')

@section('title', 'Website Editor')

@section('content')
    <div>
        <h2 class="float-left">Website Editor</h2>
    </div>

    <br><br>

    <hr />

    <form method="POST" action="{{ route('admin.dashboard.website') }}">
        {{ csrf_field() }}

        <h3><u>SEO (Page Meta)</u></h3>
        <br>

        <div class="form-group">
            <label for="title">Page Title (<span class="red">*</span>)</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Enter Page Title" value="{{ $data->title }}" required>
        </div>

        <div class="form-group">
            <label for="keyword">Keyword</label>
            <textarea class="form-control" rows="3" name="keyword" id="keyword" placeholder="Example: CMS, SDS, Tech, Top notch">{{ $data->keyword }}</textarea>
        </div>

        <hr />
        <h3><u>Page</u></h3>
        <br>

        <div class="form-group">
            <label for="announcement">Page Announcement (Will be on top of the Page)</label>
            <textarea class="form-control" rows="3" name="announcement" id="announcement" placeholder="Example: Our website will be in scheduled maintenance">{{ $data->announcement }}</textarea>
        </div>

        <div class="form-group">
            <label for="philosophy">Page Philosophy (<span class="red">*</span>)</label>
            <textarea class="form-control" rows="3" name="philosophy" id="philosophy" placeholder="Example: We levitate the Student's knowledge" required>{{ $data->philosophy }}</textarea>
        </div>

        <div class="form-group">
            <label for="about-us">About Us (<span class="red">*</span>)</label>
            <textarea class="form-control" rows="3" name="about-us" id="about-us" placeholder="Example: We are top notch!" required>{{ $data->about_us }}</textarea>
        </div>

        <div class="form-group">
            <label for="dsc">DSC (<span class="red">*</span>)</label>
            <textarea class="form-control" rows="3" name="dsc_apu" id="dsc" placeholder="Example: We are top notch!" required>{{ $data->dsc_apu }}</textarea>
        </div>

        <button type="submit" id="submitBtn" class="btn btn-primary">Submit</button>
        <a href="{{ route('admin.dashboard.website') }}" class="btn btn-success">Reset Fields</a>
    </form>
@stop
