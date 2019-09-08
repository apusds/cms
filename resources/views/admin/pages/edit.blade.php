@extends('layouts.admin')

@section('title', 'Edit Page')

@section('content')
    <div>
        <h2 class="float-left">Pages | Edit</h2>
        <div class="float-right">
            <a href="{{ route('dashboard.pages') }}" class="btn btn-danger">Back</a>
        </div>
    </div>

    <br><br>

    <hr />

    <form method="POST" action="{{ route('dashboard.pages.edit', ['id' => $page->id]) }}">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="inputURI">Page URI (<span class="red">*</span>)</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">page/</span>
                </div>
                <input type="text" class="form-control" id="inputURI" name="uri" placeholder="Enter URI" value="{{ $page->uri }}" required>
            </div>
            <div id="uriStatus"></div>
        </div>

        <hr />
        <h3><u>SEO (Page Meta)</u></h3>
        <br>

        <div class="form-group">
            <label for="inputTitle">Page Title (<span class="red">*</span>)</label>
            <input type="text" class="form-control" id="inputTitle" name="title" placeholder="Enter Page Title" value="{{ $page->title }}" required>
        </div>

        <div class="form-group">
            <label for="inputDesc">Page Description</label>
            <textarea class="form-control" rows="3" name="description" id="inputDesc" placeholder="Example: This site is very good, special thanks to SDS Team">{{ $page->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="inputKeyword">Keyword</label>
            <textarea class="form-control" rows="3" name="keyword" id="inputKeyword" placeholder="Example: CMS, SDS, Tech, Top notch">{{ $page->keyword }}</textarea>
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
                        <option value="{{ $template->id }}" {{ $page->template->id == $template->id ? 'selected' : '' }}>{{ $template->title }}</option>
                    @endforeach
                @else
                    <option value="" disabled>No templates found! Please add some.</option>
                @endif
            </select>
        </div>

        <div class="form-group">
            <label for="summer-note">Content (<span class="red">*</span>) - HTML Tags Supported</label>
            <textarea id="summer-note" class="form-control" rows="15" name="content" required>{{ $page->content }}</textarea>
        </div>

        <button type="submit" id="submitBtn" class="btn btn-success">Update</button>
    </form>
@stop
