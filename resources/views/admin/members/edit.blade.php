@extends('layouts.admin')

@section('title', 'Members')

@section('content')
    <div>
        <h2 class="float-left">Members | Edit</h2>
        <a class="btn btn-primary float-right" href="{{ route('dashboard.members') }}">Back</a>
        <a class="btn btn-danger float-right" href="{{ route('dashboard.members.delete', ['id' => $data->id]) }}">Delete</a>
    </div>

    <br><br>

    <hr />

    <form method="POST" action="{{ route('dashboard.members.edit', ['id' => $data->id]) }}">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="email">Email address (<span class="red">*</span>)</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $data->email }}" placeholder="Enter email" required>
        </div>

        <hr />

        <div class="form-group">
            <label for="name">Name (<span class="red">*</span>)</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $data->name }}" placeholder="Enter Name" required>
        </div>

        <hr />

        <div class="form-group">
            <label for="mobile">Mobile Number (<span class="red">*</span>)</label>
            <input type="text" class="form-control" id="mobile" name="mobile" value="{{ $data->mobile }}" placeholder="Enter Mobile" required>
        </div>

        <hr />

        <div class="form-group">
            <label for="tp">TP Number (<span class="red">*</span>)</label>
            <h6><span class="red">Example: TP055641</span></h6>
            <input type="text" class="form-control" id="tp" name="tp" value="{{ $data->student_id }}" placeholder="Enter TP Number" required>
        </div>

        <hr />

        <div class="form-group">
            <label for="intake">Intake Code (<span class="red">*</span>)</label>
            <h6><span class="red">Example: UC3F1906CS(DA)</span></h6>
            <input type="text" class="form-control" id="intake" name="intake" value="{{ $data->intake }}" placeholder="Enter Intake" required>
        </div>

        <hr />
        <div class="form-group">
            <label for="gender">Gender (<span class="red">*</span>)</label>
            <br>
            <h6 class="red">{{ $data->gender == null ? "This person has not set their Gender yet, mind setting for them? ;P" : "" }}</h6>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="male" value="male" {{ $data->gender === "male" ? "checked" : "" }}>
                <label class="form-check-label" for="male">
                    Male
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="female" value="female" {{ $data->gender === "female" ? "checked" : "" }}>
                <label class="form-check-label" for="female">
                    Female
                </label>
            </div>
        </div>

        <hr />

        <div class="form-group">
            <label for="gender">Skills (<span class="red">*</span>)</label>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="skills[]" id="beginner" value="beginner" {{ strpos(strtolower($data->skills), "beginner") !== false ? "checked" : "" }}>
                <label class="form-check-label" for="beginner">
                    Beginner
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="skills[]" id="backend" value="backend" {{ strpos(strtolower($data->skills), "backend") !== false ? "checked" : "" }}>
                <label class="form-check-label" for="backend">
                    Backend
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="skills[]" id="deployment" value="deployment" {{ strpos(strtolower($data->skills), "deployment") !== false ? "checked" : "" }}>
                <label class="form-check-label" for="deployment">
                    Deployment
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="skills[]" id="networking" value="networking" {{ strpos(strtolower($data->skills), "networking") !== false ? "checked" : "" }}>
                <label class="form-check-label" for="networking">
                    Networking
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="skills[]" id="web dev" value="web dev" {{ strpos(strtolower($data->skills), "web dev") !== false ? "checked" : "" }}>
                <label class="form-check-label" for="web dev">
                    Web Dev
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="skills[]" id="android" value="android" {{ strpos(strtolower($data->skills), "android") !== false ? "checked" : "" }}>
                <label class="form-check-label" for="android">
                    Android
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="skills[]" id="database" value="database" {{ strpos(strtolower($data->skills), "database") !== false ? "checked" : "" }}>
                <label class="form-check-label" for="database">
                    Database
                </label>
            </div>
        </div>

        <hr />
        <div class="form-group">
            <label for="find-us">How did you found us (<span class="red">*</span>)</label>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="check" id="facebook" value="0" {{ strtolower($data->found_us) === "facebook" ? "checked" : "" }}>
                <label class="form-check-label" for="facebook">
                    Social Media
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="check" id="heard" value="1" {{ strtolower($data->found_us) === "heard from friend" ? "checked" : "" }}>
                <label class="form-check-label" for="heard">
                    Heard From Friend
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="check" id="attended" value="2" {{ strtolower($data->found_us) === "attended our event" ? "checked" : "" }}>
                <label class="form-check-label" for="attended">
                    Attended our Event/Workshop
                </label>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>
@stop
