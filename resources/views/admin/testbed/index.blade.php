<h1>Your playground!</h1>

@foreach (\App\Meetup::all() as $mt)
    <!-- $mt->attendees is lazy loaded -->
    @foreach ($mt->attendees as $at)
        {{ dd($at->student_id) }}
    @endforeach
@endforeach
