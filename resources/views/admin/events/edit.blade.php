@extends('layouts.admin')

@section('title', 'Edit Event')

@section('content')
<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="text-center">
            <a class="btn btn-primary" href="{{ route('admin.dashboard.events') }}">Go Back</a>
            <a class="btn btn-danger" href="{{ route('admin.dashboard.events.delete', ['id' => $data->id]) }}">Delete</a>
        </div>
        <hr />

        <div class="card">
            <div class="card-body card-block">
                <form method="post" class="form-horizontal" action="{{ route('admin.dashboard.events.edit', ['id' => $data->id]) }}">
                    {{ csrf_field() }}

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="selectSm" class=" form-control-label">Select Small</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <select class="form-control" id="selectSm" name="organisation" required>
                                <option value="">Please select</option>
                                <option value="sds" {{ $data->organisation == 'sds' ? 'selected' : '' }}>Student Developer Society</option>
                                <option value="dsc" {{ $data->organisation == 'dsc' ? 'selected' : '' }}>DSC APU</option>
                            </select>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="title-input" class=" form-control-label">Event Title</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" class="form-control" id="title-input" name="title" placeholder="Enter Title" value="{{ $data->title }}" required>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="registration-input" class=" form-control-label">Registration Form (Optional)</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" class="form-control" id="registration-input" name="registration" value="{{ $data->registration }}" placeholder="Paste Link">
                        </div>
                    </div>


                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="desc-input" class=" form-control-label">Description</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <textarea class="form-control" id="desc-input" name="description" placeholder="Enter Description" required rows="5">{{ $data->description }}</textarea>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="expiry-input" class=" form-control-label">Expires On</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="datetime-local" class="form-control" id="expiry-input" name="expiry" value="{{ \Carbon\Carbon::parse($data->expiry)->format('Y-m-d\TH:i') }}" required>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label class=" form-control-label">Others</label>
                        </div>
                        <div class="col col-md-9">
                            <div class="form-check">
                                <div class="checkbox">
                                    <label for="checkbox1" class="form-check-label">
                                        <input type="checkbox" value="1" name="attendance" {{ $data->attendance == '1' ? 'checked' : '' }}>Attendance
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fa fa-dot-circle-o"></i> Submit
                        </button>
                        <button type="reset" class="btn btn-danger btn-sm">
                            <i class="fa fa-ban"></i> Reset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
