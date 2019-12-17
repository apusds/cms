@extends('layouts.admin')

@section('title', 'Members')

@section('content')
    <div>
        <h2 class="float-left">Members ({{ count(\App\Member::all()) }})</h2>
        <a class="btn btn-primary float-right" href="{{ route('dashboard.members.export') }}">Download</a>
    </div>

    <br><br>

    <hr />

    <br>
    <input type="text" id="myInput" class="form-control border border-info" placeholder="Filter here..">
    <br>
    @if (count($members) > 0)
    <div id="memberTableArea" style="position: relative;">
        @include('admin.members.load')
    </div>
    @else 
        <h1 class="text-muted text-center">No members</h1>
    @endif

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            const pageUrl = '{{ route('dashboard.members') }}';
            var $_perPage = {{ $perPage }};
            var $q = '{{ $q }}';
            var $_page = {{ $page }};
            
            // Get members on page change
            $('body').on('click', '.pagination a', function(e) {
                e.preventDefault();

                $_page = (new URL($(this).attr('href'))).searchParams.get('page');
                
                if ($q){
                    var url = pageUrl+'?page='+$_page+'&perPage='+$_perPage+'&q='+$q;
                } else {
                    var url = pageUrl+'?page='+$_page+'&perPage='+$_perPage;
                }

                getMembers(url);
            });

            // Live search
            // doneTyping function in custom.js
            $('#myInput').doneTyping(function(callback){
                $q = $(this).val().toLowerCase();

                if ($q){
                    var url = pageUrl+'?page=1&perPage='+$_perPage+'&q='+$q;
                } else {
                    var url = pageUrl+'?page=1&perPage='+$_perPage;
                }

                getMembers(url);
            });

            // Get members on number of rows change
            $('body').on('change', '#perPage', function() {
                $_perPage = $(this).val();
                $q = $('#myInput').val();

                if ($q){
                    var url = pageUrl+'?page=1&perPage='+$_perPage+'&q='+$q;
                } else {
                    var url = pageUrl+'?page=1&perPage='+$_perPage;
                }
                
                getMembers(url);
            });

            // AJAX function to load data from external file
            function getMembers(url) {
                window.history.pushState("", "", url);
                $.ajax({
                    url : url
                }).done(function (data) {
                    $('#memberTableArea').html(data);  
                }).fail(function () {
                    $('#memberTableArea').html('<h1 class="text-muted text-center">Failed to get members.</h1>');
                });
            }
        });
    </script>
@stop
