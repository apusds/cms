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

        if (URI.trim() === "") {
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

    // Custom File Uploader
    $(".custom-file-input").on("change", function() {
        const fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    // Upload Field Add/Rm
    let btnAdd = $('#addField');
    let formField = $('#form-field');
    let i = $('#customFile div').size() + 1;

    btnAdd.on('click', function () {
        if (i <= 4) {
            $('<div class="main">\n' +
                '<br>' +
                '<div class="custom-file file-' + i + '">\n' +
                '<label class="custom-file-label" for="customFile">Choose file</label>\n' +
                '<input type="file" class="custom-file-input" id="customFile" name="file[]" required>\n' +
                '<a href="#" style="text-decoration: underline; color: blue; cursor: pointer" id="rm">Remove</a>' +
                '</div>' +
                '<div>/n').appendTo(formField);
            i++;
        } else {
            btnAdd.hide();
        }
        return false;
    });

    $(document).on('click', '#rm', function () {
        if (i > 1) {
            $(this).parents('div .main').remove();
            i--;

            btnAdd.show();
        }
        return false;
    })
});
