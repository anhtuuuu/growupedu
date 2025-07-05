<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>title</title>
    <link rel="icon" href={{ URL::to(config('asset.dist_admin_path') . 'favicon.ico') }} />
    <link href={{ URL::to(config('asset.dist_admin_path') . 'bootstrap/css/bootstrap.min.css') }} rel="stylesheet"
        type="text/css" />
    <link href={{ URL::to(config('asset.dist_admin_path') . 'font-awesome-4.3.0/css/font-awesome.min.css') }}
        rel="stylesheet" type="text/css" />
    <link href={{ URL::to(config('asset.dist_admin_path') . 'dist/css/AdminLTE.min.css') }} rel="stylesheet"
        type="text/css" />
    <link href={{ URL::to(config('asset.dist_admin_path') . 'dist/css/skins/_all-skins.min.css') }} rel="stylesheet"
        type="text/css" />
    <link href={{ URL::to(config('asset.dist_admin_path') . 'style.css') }} rel="stylesheet" type="text/css" />
    <link href={{ URL::to(config('asset.dist_admin_path') . 'custom.css') }} rel="stylesheet" type="text/css" />

</head>

<body class="skin-blue">
    <div class="wrapper">
        @include(config('asset.view_admin')('admin_header'))
        @include(config('asset.view_admin')('admin_left_side'))
        <div class="content-wrapper">
            <!-- Start Content Header (Page header) -->
            <section class="content-header">
                <h1>

                </h1>
                <ol class="breadcrumb">

                </ol>
            </section>
            <!-- End Content Header (Page header) -->
            @yield('content')
        </div>

        @include(config('asset.view_admin')('admin_footer'))
    </div>
    {{-- 
    <script src={{ URL::to(config('asset.dist_admin_path') . 'plugins/jQuery/jQuery-2.1.3.min.js') }}
        type="text/javascript"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src={{ URL::to(config('asset.dist_admin_path') . 'bootstrap/js/bootstrap.min.js') }} type="text/javascript">
    </script>
    <script src={{ URL::to(config('asset.dist_admin_path') . 'plugins/fastclick/fastclick.min.js') }}></script>
    <script src={{ URL::to(config('asset.dist_admin_path') . 'dist/js/app.min.js') }} type="text/javascript"></script>
    <script src={{ URL::to(config('asset.dist_admin_path') . 'dist/js/demo.js') }}></script>
    <script src={{ URL::to(config('asset.admin_path') . 'ckeditor/ckeditor.js') }}></script>
    {{-- <script>
        CKEDITOR.replace('editor', {
            language: 'vi',
            filebrowserBrowseUrl: '{{ URL::to(config('asset.admin_path')).'/ckeditor/kcfinder/browse.php?opener=ckeditor&type=files' }}',
            filebrowserImageBrowseUrl: '{{ URL::to(config('asset.admin_path')).'/ckeditor/kcfinder/browse.php?opener=ckeditor&type=images&dir=images/news'}}',
            filebrowserFlashBrowseUrl: '{{ URL::to(config('asset.admin_path')).'/ckeditor/kcfinder/browse.php?opener=ckeditor&type=flash'}}',
            filebrowserUploadUrl: '{{ URL::to(config('asset.admin_path')).'/ckeditor/kcfinder/upload.php?opener=ckeditor&type=files'}}',
            filebrowserImageUploadUrl: '{{ URL::to(config('asset.admin_path')).'/ckeditor/kcfinder/upload.php?opener=ckeditor&type=images&dir=images/news'}}',
            filebrowserFlashUploadUrl: '{{ URL::to(config('asset.admin_path')).'/ckeditor/kcfinder/upload.php?opener=ckeditor&type=flash'}}'
        });
    </script> --}}
    <script src={{ URL::to(config('asset.admin_path') . 'js/mammoth.browser.min.js') }}></script>
    <script>
        CKEDITOR.replace('editor');
        document.getElementById('upload-docx').addEventListener('change', function(event) {
            const reader = new FileReader();
            reader.onload = function(event) {
                const arrayBuffer = event.target.result;

                // Dùng Mammoth để chuyển đổi .docx sang HTML
                mammoth.convertToHtml({
                    arrayBuffer: arrayBuffer
                }, {
                    convertImage: mammoth.images.inline(function(image) {
                        return image.read("base64").then(function(imageBuffer) {
                            return {
                                src: "data:" + image.contentType + ";base64," +
                                    imageBuffer
                            };
                        });
                    })
                }).then(function(result) {
                    // Chèn HTML vào CKEditor
                    CKEDITOR.instances.editor.setData(result.value);
                    console.log("Messages:", result.messages);
                }).catch(function(err) {
                    console.error("Lỗi khi đọc file:", err);
                });
            };
            reader.readAsArrayBuffer(event.target.files[0]);
        });

        const htmlContent = CKEDITOR.instances.editor.getData();

        fetch("/them-bai", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("noi_dung")
            },
            body: JSON.stringify({
                content: htmlContent
            })
        });
    </script>


    <script type="text/javascript">
        var delay = (function() {
            var timer = 0;
            return function(callback, ms) {
                clearTimeout(timer);
                timer = setTimeout(callback, ms);
            };
        })();
        jQuery.each(jQuery('textarea[data-autoresize]'), function() {
            var offset = this.offsetHeight - this.clientHeight;

            var resizeTextarea = function(el) {
                jQuery(el).css('height', 'auto').css('height', el.scrollHeight + offset);
            };
            jQuery(this).on('keyup input', function() {
                resizeTextarea(this);
            }).removeAttr('data-autoresize');
        });
    </script>
    <script>
        if (($(window).height() + 100) < $(document).height()) {
            $('#top-link-block').removeClass('hidden').affix({
                offset: {
                    top: 100
                }
            });
        }

        function get_slug(str) {
            str = str.toLowerCase();
            str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
            str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
            str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
            str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
            str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
            str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
            str = str.replace(/đ/g, "d");
            str = str.replace(/[\W_]+/g, "-"); //thay thế các kí tự không thuộc alpha characters thành -
            str = str.replace(/-+-/g, "-"); //thay thế x- thành 1-
            str = str.replace(/^\-+|\-+$/g, ""); //cắt bỏ ký tự - ở đầu và cuối chuỗi
            return str;
        }

        function render_meta_seo(el, text_max, bool = true) {
            if (el.length) {
                var $this = el.closest('.form-group');
                $this.find('label').append(' - Tối đa ' + text_max + ' ký tự');
                $this.append('<span class="help-block"><strong class="count-characters">' + text_max +
                    '</strong> ký tự còn lại</span>');
                var text_length = el.val().length;
                if (text_length > text_max) {
                    $this.find('.count-characters').text(0);
                    $this.addClass('has-error');
                } else {
                    $this.find('.count-characters').text(text_max - text_length);
                }
                if (bool) {
                    el.attr('maxlength', text_max);
                }
            }

        }
        $(document).ready(function() {
            $('#top-link-block').on('click', function() {
                $('html,body').animate({
                    scrollTop: 0
                }, 'slow');
                return false;
            });

            render_meta_seo($('input[name=title_seo]'), data_meta_seo.title_seo);
            render_meta_seo($('textarea[name=keywords]'), data_meta_seo.keywords);
            render_meta_seo($('textarea[name=description]'), data_meta_seo.description);
            render_meta_seo($('input[name=h1_seo]'), data_meta_seo.h1_seo);
        });
        $(document).on('keyup blur', 'input[name=title_seo]', function() {
            var text_max = data_meta_seo.title_seo;
            var text_length = $(this).val().length;
            var text_remaining = text_max - text_length;
            var $this = $(this).closest('.form-group');
            if (text_remaining > 0) {
                $this.find('.count-characters').text(text_remaining);
                $this.removeClass('has-error');
            } else {
                $this.find('.count-characters').text(0);
                $this.addClass('has-error');
            }
        });

        $(document).on('keyup blur', 'textarea[name=keywords]', function() {
            var text_max = data_meta_seo.keywords;
            var text_length = $(this).val().length;
            var text_remaining = text_max - text_length;
            var $this = $(this).closest('.form-group');
            if (text_remaining > 0) {
                $this.find('.count-characters').text(text_remaining);
                $this.removeClass('has-error');
            } else {
                $this.find('.count-characters').text(0);
                $this.addClass('has-error');
            }
        });

        $(document).on('keyup blur', 'textarea[name=description]', function() {
            var text_max = data_meta_seo.description;
            var text_length = $(this).val().length;
            var text_remaining = text_max - text_length;
            var $this = $(this).closest('.form-group');
            if (text_remaining > 0) {
                $this.find('.count-characters').text(text_remaining);
                $this.removeClass('has-error');
            } else {
                $this.find('.count-characters').text(0);
                $this.addClass('has-error');
            }
        });

        $(document).on('keyup blur', 'input[name=h1_seo]', function() {
            var text_max = data_meta_seo.h1_seo;
            var text_length = $(this).val().length;
            var text_remaining = text_max - text_length;
            var $this = $(this).closest('.form-group');
            if (text_remaining > 0) {
                $this.find('.count-characters').text(text_remaining);
                $this.removeClass('has-error');
            } else {
                $this.find('.count-characters').text(0);
                $this.addClass('has-error');
            }
        });
    </script>
    <script src={{ URL::to(config('asset.admin_path') . 'js/custom.js') }}></script>

</body>

</html>
