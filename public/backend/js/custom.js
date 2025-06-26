$(document).ready(function () {
    $('#lessons').on('change', function () {
        var lesson_id = $(this).val();
        $.ajax({
            url: '/gets-chapter/' + lesson_id,
            method: 'GET',
            success: function (response) {
                $('#chapter').html(response);
            },
            error: function (xhr) {
                alert('Có lỗi xảy ra: ' + xhr.status);
            }
        });
    });
});

$(document).ready(function () {
    $('#roles').on('change', function () {
        var role = $(this).val();
        $.ajax({
            url: '/check-role/' + role,
            method: 'GET',
            success: function (response) {
                $('#subjects').html(response);
            },
            error: function (xhr) {
                alert('Có lỗi xảy ra: ' + xhr.status);
            }
        });
    });
});
