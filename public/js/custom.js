$(document).ready(function() {
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

    $('#summer-note-template').summernote({
        focus: true,
        popover: {
            image: [],
            link: [],
            air: []
        },
        toolbar: [
            ['view', ['fullscreen', 'codeview']]
        ],
        height: 500,
        placeholder: 'Very hard to paste? Try our Code View!',
        codemirror: {
            theme: 'monokai'
        },
        callbacks: {
            onInit: function() {
                $("div.note-editor button.btn-codeview").click();
            }
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
