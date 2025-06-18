@extends('site.layout')
@section('content')
    <?php if(isset($row) && !empty($row)): ?>
    <div class="col-xs-12 col-sm-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><a href="javascript:void(0);" class="toggle-sidebar"><span
                            class="fa fa-angle-double-left" data-toggle="offcanvas" title="Maximize Panel"></span></a>Menu</h3>
            </div>
            <!--panel-Body-->
            <div class="panel-body">
                <div class="content-row">
                    <center>
                        <h1>{{ $row->tieu_de }}</h1>
                    </center>
                    <hr>
                    <p>{{ $row->mo_ta }}</p>
                    <br>

                    <p>{{ $row->noi_dung }}</P>
                    <br>
                    <h2 style="color:#ff9900;"><img src="../images/clogo.png" width="40" alt="">&nbsp;Video bài
                        học:</h2><br>
                    <video id="my-video" class="video-js" controls preload="auto" width="640" height="264"
                        poster="MY_VIDEO_POSTER.jpg" data-setup="{}">
                        <source src="https://vjs.zencdn.net/v/oceans.mp4" type="video/mp4" />
                        {{-- <source src="https://www.youtube.com/watch?v=J-Z-XvH2wiM" type="video/webm" /> --}}
                        <p class="vjs-no-js">
                            To view this video please enable JavaScript, and consider upgrading to a
                            web browser that
                            <a href="https://www.youtube.com/watch?v=J-Z-XvH2wiM" target="_blank">supports HTML5 video</a>
                        </p>
                    </video>
                    <div class="row">
                        <div class="col-md-6" style="padding-left:10px;">

                            <ul>
                                <li class="list-group-item"><img src="images/clogo.png" width="20"
                                        alt="">&nbsp;&nbsp; <b>Computer Basics </b></li>
                                <li><a href="displayf6d0.html?tno=1&amp;topic=Introduction" class="atopic">Introduction</a>
                                </li>
                                <li><a href="display182b.html?tno=2&amp;topic=Computer-Languages" class="atopic">Computer
                                        Languages</a></li>
                                <li><a href="display3303.html?tno=3&amp;topic=Creating-and-Running" class="atopic">Creating
                                        and Running</a></li>
                                <li><a href="display3200.html?tno=4&amp;topic=Program-Development-steps"
                                        class="atopic">Program Development steps</a></li>
                                <li><a href="display12ff.html?tno=5&amp;topic=Algorithms-and-Flow-Chart"
                                        class="atopic">Algorithms and Flow Chart</a></li>
                                <li class="list-group-item"><img src="images/clogo.png" width="20"
                                        alt="">&nbsp;&nbsp; <b>C - Basics </b></li>
                                <li><a href="display9f49.html?tno=6&amp;topic=Introduction-to-C" class="atopic">Introduction
                                        to C</a></li>
                                <li><a href="displayc545.html?tno=7&amp;topic=C-Program-Structure" class="atopic">C Program
                                        Structure</a></li>
                                <li><a href="display698b.html?tno=8&amp;topic=The-C-Character-Set" class="atopic">The C
                                        Character Set</a></li>
                                <li><a href="display7fb8.html?tno=9&amp;topic=Variables" class="atopic">Variables</a></li>
                                <li><a href="displayc77b.html?tno=10&amp;topic=Datatypes" class="atopic">Datatypes</a></li>
                                <li><a href="displaya24d.html?tno=11&amp;topic=First-C-Program" class="atopic">First C
                                        Program</a></li>
                                <li><a href="display8c54.html?tno=12&amp;topic=Expression" class="atopic">Expression</a>
                                </li>
                                <li><a href="display52f7.html?tno=13&amp;topic=Operators" class="atopic">Operators</a></li>
                                <li><a href="display2193.html?tno=14&amp;topic=Expression-Evaluation"
                                        class="atopic">Expression Evaluation</a></li>
                                <li><a href="display3ba5.html?tno=15&amp;topic=Type-Casting" class="atopic">Type
                                        Casting</a></li>
                                <li class="list-group-item"><img src="images/clogo.png" width="20"
                                        alt="">&nbsp;&nbsp; <b>Control Statements </b></li>
                                <li><a href="display3f3b.html?tno=16&amp;topic=Introduction-to-Control-Structures"
                                        class="atopic">Introduction to Control Structures</a></li>
                                <li><a href="display3f2b.html?tno=17&amp;topic=Decision-Statements" class="atopic">Decision
                                        Statements</a></li>
                                <li><a href="display2891.html?tno=18&amp;topic=Loop-Statements" class="atopic">Loop
                                        Statements</a></li>
                                <li><a href="display8373.html?tno=19&amp;topic=Jump-Statements" class="atopic">Jump
                                        Statements</a></li>
                            </ul>
                        </div>
                        <div class="col-md-6" style="padding-left:10px;">
                        </div>
                    </div>


                </div>
            </div>


            <!-- end panel body -->
        </div>
    </div>
    <?php endif; ?>
@endsection
