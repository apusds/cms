$(document).ready(function() {
    const uriDiv = $('#uriStatus');
    uriDiv.hide();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#inputURI').keyup(function() {
        const URI = $("input[name=uri]").val();

        if (URI === "") {
            uriDiv.hide();
            return;
        }

        $.ajax({
            type: 'POST',
            url: '/api/uri/validate',
            data: {
                uri: URI
            },
            success: (data) => {
                if (data.status === 'OK') {
                    uriDiv.html("<span class='green'>URI Available</span>");
                    uriDiv.show();
                } else {
                    uriDiv.html("<span class='red'>URI Not available</span>");
                    uriDiv.show();
                }
            }
        });
    });

    $('#summer-note').summernote({
        popover: {
            image: [],
            link: [],
            air: []
        },
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['table', ['table']],
            ['insert', ['link', 'hr']],
            ['view', ['fullscreen', 'codeview']]
        ],
        height: 300,
        placeholder: 'Glory starts here!',
        codemirror: {
            theme: 'monokai'
        }
    });

    $("#sidebar").mCustomScrollbar({
        theme: "minimal"
    });

    $('#dismiss, .overlay').on('click', function () {
        $('#sidebar').removeClass('active');
        $('.overlay').removeClass('active');
    });

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').addClass('active');
        $('.overlay').addClass('active');
        $('.collapse.in').toggleClass('in');
        $('a[aria-expanded=true]').attr('aria-expanded', 'false');
    });
});
