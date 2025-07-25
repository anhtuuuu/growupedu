<!DOCTYPE html>
<html>

<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8">
    <title>C Programming Tutorial | Study Glance</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content=" " />
    <meta property="og:title" content="HTML Introduction | Study Glance" />
    <meta property="og:description" content="" />
    <meta property="og:url" content="../html/index-2.html" />
    <link rel="icon" href="../images/logo1.png" type="image/x-icon" />
    <link rel="bookmark" href="../images/logo1.png" />
    <!-- site css -->

    <!--nav-->
    <link rel="stylesheet" href={{ URL::to(config('asset.css_path') . 'site.min.css') }}>
    <link
        href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,800,700,400italic,600italic,700italic,800italic,300italic"
        rel="stylesheet" type="text/css">

    <link href="https://bootstrapmade.com/content/vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href={{ URL::to(config('asset.css_path') . 'custom.css') }}>
    <link href="https://vjs.zencdn.net/8.22.0/video-js.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src={{ URL::to(config('asset.js_path') . 'site.min.js') }}></script>
    <script type="text/javascript" src={{ URL::to(config('asset.js_path') . 'prism.js') }}></script>
    <script>
        function myFunction() {
            var x = document.getElementById("myTopnav");
            if (x.className === "topnav") {
                x.className += " responsive";
            } else {
                x.className = "topnav";
            }
        }
    </script>
    <script async src="../../pagead2.googlesyndication.com/pagead/js/f9b65.txt?client=ca-pub-8096140274719176"
        crossorigin="anonymous"></script>
</head>

<body>
    {{-- header start --}}
    @include('site.header')
    {{-- header end --}}
    <!--body container-->
    <div class="container-fluid mt-4">
        <div class="row row-offcanvas row-offcanvas-left">
            <!-- Side Menu-->
            <?php if(isset($left_side_none) && isset($type_side_none)):?>
            @include('site.left-side', compact('left_side_none', 'type_side_none'))
            <?php endif;  ?>
            <!-- End side Menu-->
            <!-- content -->
            @yield('content')

        </div>
        <!-- end content -->
    </div>
    @yield('javascript')
    {{-- footer start --}}
    			<div class="pb-5"></div>
    @include('site.footer')
    {{-- footer end --}}

    </div>
    <!--end body container-->
    <script src="https://vjs.zencdn.net/8.22.0/video.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/videojs-youtube/2.6.1/Youtube.min.js"></script>
    <script type="text/javascript" src={{ URL::to(config('asset.js_path') . 'custom.js') }}></script>

</body>

</html>
