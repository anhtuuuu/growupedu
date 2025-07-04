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

var index = 0;

$(document).ready(function () {    
    $('#add-question').on('click', function () {
        index = index + 1;
        var html = `<div class="question-item">
                        <div class="question">
                            <label for="label control-label">Tiêu đề câu hỏi</label>
                            <input type="text" class="form-control" name="label[]" id="label">
                        </div>
                        <div class="question">
                            <label for="">Đáp án A</label>
                            <input type="text" class="form-control" name="answer1[]" id="answer">
                        </div>
                        <div class="question">
                            <label for="">Đáp án B</label>
                            <input type="text" class="form-control" name="answer2[]" id="answer">
                        </div>
                        <div class="question">
                            <label for="">Đáp án C</label>
                            <input type="text" class="form-control" name="answer3[]" id="answer">
                        </div>
                        <div class="question">
                            <label for="">Đáp án D</label>
                            <input type="text" class="form-control" name="answer4[]" id="answer">
                        </div>
                        <div class="question">
                            <label for="" class="text-danger">ĐÁP ÁN ĐÚNG</label>
                            <select name="dap_an[]" class="form-control" id="dap_an">
                                <option value="1">A</option>
                                <option value="2">B</option>
                                <option value="3">C</option>
                                <option value="4">D</option>
                            </select>
                        </div>
                    </div>`;

        $('#questions').append(html);
    });
});

function confirmSubmit() {
    return confirm("Bạn có chắc chắn muốn xóa dữ liệu này?");
}

// $(document).ready(function () {
//     $('#filter').on('change', function () {
//         var filter_link = $(this).val();
//         $.ajax({
//             url: filter_link,
//             method: 'GET',
//             success: function (response) {
//                 $('#body_load').html(response);
//             },
//             error: function (xhr) {
//                 alert('Có lỗi xảy ra: ' + xhr.status);
//             }
//         });
//     });
// });

// $(document).ready(function () { 
//   $('#tuong-tac').on('submit', function(e) {
//     e.preventDefault(); 
//     $.ajax({
//       url: '/gui-tuong-tac',
//       method: 'POST',
//       data: $(this).serialize(),
//       success: function(response) {
//         $('#comment-list').append(response);
//       },
//       error: function(xhr) {
//         $('#message').html('Có lỗi xảy ra!');
//       }
//     });
//   });
// });
