@extends('layouts.admin')

@section('title', 'Create Page')

@section('content')
    <div>
        <h2 class="float-left">Pages | Create</h2>
        <div class="float-right">
            <a href="{{ route('dashboard.pages') }}" class="btn btn-danger">Back</a>
        </div>
    </div>

    <br><br>

    <hr />

    <form method="POST" action="{{ route('dashboard.pages.create') }}">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="inputURI">Page URI (<span class="red">*</span>)</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">page/</span>
                </div>
                <input type="text" class="form-control" id="inputURI" name="uri" placeholder="Enter URI" required>
            </div>
        </div>

        <hr />
        <h3><u>SEO (Page Meta)</u></h3>
        <br>

        <div class="form-group">
            <label for="inputTitle">Page Title (<span class="red">*</span>)</label>
            <input type="text" class="form-control" id="inputTitle" name="title" placeholder="Enter Page Title" required>
        </div>

        <div class="form-group">
            <label for="inputDesc">Page Description</label>
            <textarea class="form-control" rows="3" name="description" id="inputDesc" placeholder="Example: This site is very good, special thanks to SDS Team"></textarea>
        </div>

        <div class="form-group">
            <label for="inputKeyword">Keyword</label>
            <textarea class="form-control" rows="3" name="keyword" id="inputKeyword" placeholder="Example: CMS, SDS, Tech, Top notch"></textarea>
        </div>

        <hr />
        <h3><u>Page</u></h3>
        <br>

        <div class="form-group">
            <label for="selectTemplate">Page Template (<span class="red">*</span>)</label>
            <select class="form-control" id="selectTemplate" name="template" required>
                <option value="">Please select</option>
                @if (count(\App\Template::all()) > 0)
                    @foreach (\App\Template::all() as $template)
                        <option value="{{ $template->id }}">{{ $template->title }}</option>
                    @endforeach
                @else
                    <option value="" disabled>No templates found! Please add some.</option>
                @endif
            </select>
        </div>

        <div class="form-group">
            <label for="summer-note">Content (<span class="red">*</span>) - HTML Tags Supported</label>
            <textarea id="summer-note" class="form-control" rows="15" name="content" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('dashboard.pages.create') }}" class="btn btn-success">Reset Fields</a>
    </form>
@stop
