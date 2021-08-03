$(document).ready(function (e) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).on("change", ".upload", function (e) {
        e.preventDefault();
        var file = $(this).prop("files")[0];
        var formData = new FormData();
        var id = $(this).attr('id');
        formData.append("file", file);
        formData.append("id", id);
        $('<img src=' + $('meta[name="loading"]').attr('content') + ' />').insertAfter( $(this) );
        $.ajax({
            type: 'POST',
            url: $('meta[name="upload"]').attr('content'),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                $(this).next().remove();
                $(this).next().val(data);
            },
            error: function (data) {

            }
        });
    });
});
