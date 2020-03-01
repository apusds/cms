@extends('layouts.admin')

@section('title', 'My Profile')

@section('content')
<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="text-center">
            <a class="btn btn-primary" href="{{ route('admin.dashboard') }}">Go Back</a>
        </div>
        <hr />

        <div class="card">
            <div class="card-body card-block">
                <form method="post" action="{{ route('admin.dashboard.profile') }}" class="form-horizontal">
                    {{ csrf_field() }}

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="password-input" class=" form-control-label">Password</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="password" id="password-input" name="password" placeholder="Enter Password" class="form-control">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="password-input" class=" form-control-label">Confirm Password</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="password" id="password-input" name="confirm" placeholder="Confirm Password" class="form-control">
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
