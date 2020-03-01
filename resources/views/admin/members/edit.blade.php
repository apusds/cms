@extends('layouts.admin')

@section('title', 'Members')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="text-center">
                <a class="btn btn-primary" href="{{ route('admin.dashboard.members') }}">Go Back</a>
                <a class="btn btn-danger" href="{{ route('admin.dashboard.members.delete', ['id' => $data->id]) }}">Delete</a>
            </div>
            <hr />
            <div class="card">
                <div class="card-body card-block">
                    <form method="post" action="{{ route('admin.dashboard.members.edit', ['id' => $data->id]) }}" class="form-horizontal">
                        {{ csrf_field() }}

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label class=" form-control-label">Status</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <p class="form-control-static" style="color: red;">{{ $data->password !== null ? 'Activated' : 'Yet to be activated' }}</p>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="email-input" class=" form-control-label">Email Address</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="email" id="email-input" name="email" placeholder="Email Address" value="{{ $data->email }}" class="form-control" required>
                            </div>
                        </div>

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
                                <label for="name-input" class=" form-control-label">Name</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="name-input" name="name" placeholder="Name" value="{{ $data->name }}" class="form-control">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="mobile-input" class=" form-control-label">Mobile Number</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="mobile-input" name="mobile" placeholder="Mobile Number" value="{{ $data->mobile }}" class="form-control" required>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="tp-input" class=" form-control-label">TP Number</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="tp-input" name="tp" placeholder="TP Number" value="{{ $data->student_id }}" class="form-control" required>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="intake-input" class=" form-control-label">Intake Code</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="intake-input" name="intake" placeholder="Intake Code" value="{{ $data->intake }}" class="form-control" required>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label class=" form-control-label">Gender</label>
                            </div>
                            <div class="col col-md-9">
                                <div class="form-check">
                                    <div class="radio">
                                        <label for="male" class="form-check-label ">
                                            <input type="radio" id="male" name="gender" value="male" class="form-check-input" {{ $data->gender === "male" ? "checked" : "" }}>Male
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label for="female" class="form-check-label ">
                                            <input type="radio" id="male" name="gender" value="female" class="form-check-input" {{ $data->gender === "female" ? "checked" : "" }}>Female
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label class=" form-control-label">Skills</label>
                            </div>
                            <div class="col col-md-9">
                                <div class="form-check">
                                    <div class="radio">
                                        <label for="beginner" class="form-check-label ">
                                            <input class="form-check-input" type="checkbox" name="skills[]" id="beginner" value="beginner" {{ strpos(strtolower($data->skills), "beginner") !== false ? "checked" : "" }}>Beginner
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label for="backend" class="form-check-label ">
                                            <input class="form-check-input" type="checkbox" name="skills[]" id="backend" value="backend" {{ strpos(strtolower($data->skills), "backend") !== false ? "checked" : "" }}>Backend
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label for="deployment" class="form-check-label ">
                                            <input class="form-check-input" type="checkbox" name="skills[]" id="deployment" value="deployment" {{ strpos(strtolower($data->skills), "deployment") !== false ? "checked" : "" }}>Deployment
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label for="networking" class="form-check-label ">
                                            <input class="form-check-input" type="checkbox" name="skills[]" id="networking" value="networking" {{ strpos(strtolower($data->skills), "networking") !== false ? "checked" : "" }}>Networking
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label for="web dev" class="form-check-label ">
                                            <input class="form-check-input" type="checkbox" name="skills[]" id="web dev" value="web dev" {{ strpos(strtolower($data->skills), "web dev") !== false ? "checked" : "" }}>Web Dev
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label for="android" class="form-check-label ">
                                            <input class="form-check-input" type="checkbox" name="skills[]" id="android" value="android" {{ strpos(strtolower($data->skills), "android") !== false ? "checked" : "" }}>Android
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label for="backend" class="form-check-label ">
                                            <input class="form-check-input" type="checkbox" name="skills[]" id="backend" value="backend" {{ strpos(strtolower($data->skills), "backend") !== false ? "checked" : "" }}>Backend
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label for="database" class="form-check-label ">
                                            <input class="form-check-input" type="checkbox" name="skills[]" id="database" value="database" {{ strpos(strtolower($data->skills), "database") !== false ? "checked" : "" }}>Database
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label class=" form-control-label">How did you found us</label>
                            </div>
                            <div class="col col-md-9">
                                <div class="form-check">
                                    <div class="radio">
                                        <label for="facebook" class="form-check-label ">
                                            <input class="form-check-input" type="radio" name="check" id="facebook" value="0" {{ strtolower($data->found_us) === "facebook" ? "checked" : "" }}>Social Media
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label for="heard" class="form-check-label ">
                                            <input class="form-check-input" type="radio" name="check" id="heard" value="1" {{ strtolower($data->found_us) === "heard from friend" ? "checked" : "" }}>Heard from Friend
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label for="attended" class="form-check-label ">
                                            <input class="form-check-input" type="radio" name="check" id="attended" value="2" {{ strtolower($data->found_us) === "attended our event" ? "checked" : "" }}>Attended our Event/Workshop
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
