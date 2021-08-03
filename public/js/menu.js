$(document).ready(function () {
    $('.menu-bar').click(function () {
        if ($('#search-box').hasClass('d-none')) {
            $('#search-box').removeClass('d-none');
            $('#account-box').removeClass('d-none');
        } else {
            $('#search-box').addClass('d-none');
            $('#account-box').addClass('d-none');
        }
    });
});
