@extends('layouts.master')

@push('title')
<title>Lusy Wahyudi</title>
@endpush

@section('content')

<body data-offset="200" data-spy="scroll" data-target=".ow-navigation">
    <div class="main-container">
        <!-- Loader -->
        <div id="site-loader" class="load-complete">
            <div class="loader">
                <div class="loader-inner ball-clip-rotate">
                    <div></div>
                </div>
            </div>
        </div><!-- Loader /- -->    
        <!-- Header Section -->
        <header id="header" class="header-section container-fluid no-padding">
            <!-- Top Header -->
            <div class="top-header container-fluid no-padding">
                <div class="col-md-7 col-sm-12 col-xs-12 top-content no-padding">
                    <a href="tel:1800234567890"><i class="fa fa-phone"></i><b>1-800-23-456-7890</b></a>
                    <div class="top-icons">
                        <ul>
                            <li><a href="#" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#" title="Google+"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                        <h5><span>OPENING HOURS:</span> MONDAY - SUNDAY: 10.00AM TO 8.00PM</h5>
                    </div>
                </div>
            </div><!-- Top Header /- -->
            <!-- Container -->
            <div class="container">     
                <!-- nav -->
                <nav class="navbar navbar-default ow-navigation">
                    <div class="navbar-header">
                        <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a href="index.html" class="navbar-brand"><img src="{{ asset('img/logo.png') }}" alt="Logo" /></a>
                    </div>
                    <!-- Menu Icon -->
                    <div class="menu-icon">
                        <div class="search">    
                            <a href="#" id="search" title="Search"><i class="icon icon-Search"></i></a>
                        </div>
                    </div><!-- Menu Icon /- -->
                    <div class="navbar-collapse collapse navbar-right" id="navbar">
                        <ul class="nav navbar-nav">
                            <li class="active dropdown">
                                <a href="index.html" title="Home" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false">Home</a>
                                <i class="ddl-switch fa fa-angle-down"></i>
                                <ul class="dropdown-menu">              
                                    <li><a href="index.html" title="homepage 1">homepage 1</a></li>
                                    <li><a href="index2.html" title="homepage 2">homepage 2</a></li>
                                </ul>
                            </li>
                            <li><a href="about.html" title="About">About</a></li>
                            <li class="dropdown">
                                <a href="events.html" title="EVENTS" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false">EVENTS</a>
                                <i class="ddl-switch fa fa-angle-down"></i>
                                <ul class="dropdown-menu">              
                                    <li><a href="event-single.html" title="events 01">EVENTS Single</a></li>
                                </ul>
                            </li>
                            <li><a href="gallery.html" title="Gallery">Gallery</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false" title="Pages">Pages</a>
                                <i class="ddl-switch fa fa-angle-down"></i>
                                <ul class="dropdown-menu">
                                    <li><a href="blog.html" title="Blog Single">Blog</a></li>
                                    <li><a href="blog-single.html" title="Blog Single">Blog Single</a></li>
                                    <li><a href="404.html" title="404">404</a></li>
                                </ul>
                            </li>
                            <li><a href="contactus.html" title="Contact">Contact</a></li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </nav><!-- nav /- -->
                <!-- Search Box -->
                <div class="search-box">
                    <span><i class="icon_close"></i></span>
                    <form><input type="text" class="form-control" placeholder="Enter a keyword and press enter..." /></form>
                </div><!-- Search Box /- -->
            </div><!-- Container /- -->     
        </header><!-- Header Section /- -->

        <main>
        
            <!-- Slider Section -->
            <div id="home-revslider" class="slider-section container-fluid no-padding ">
                <!-- START REVOLUTION SLIDER 5.0 -->
                <div class="rev_slider_wrapper">
                    <div id="home-slider1" class="rev_slider" data-version="5.0">
                        <ul> 
                            <li data-transition="zoomout" data-slotamount="default"  data-easein="easeInOut" data-easeout="easeInOut" data-masterspeed="2000" data-rotate="0"  data-fstransition="fade" data-fsmasterspeed="1500" data-fsslotamount="7">
                                <!-- MAIN IMAGE -->
                                <img src="{{ asset('img/slider-1.jpg') }}" alt="slider" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10" class="rev-slidebg" data-no-retina>
                                <!-- LAYERS -->

                                <!-- LAYER NR. 1 -->
                                <div class="tp-caption NotGeneric-Title tp-resizeme rs-parallaxlevel-0" id="slide-layer-1" 
                                    data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" 
                                    data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']" 
                                    data-fontsize="['70','70','70','45']"
                                    data-lineheight="['100','70','70','60']"
                                    data-width="none"
                                    data-height="none"
                                    data-whitespace="nowrap"
                                    data-transform_idle="o:1;"
                                    data-transform_in="x:[105%];z:0;rX:45deg;rY:0deg;rZ:90deg;sX:1;sY:1;skX:0;skY:0;s:2000;e:Power4.easeInOut;" 
                                    data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
                                    data-mask_in="x:0px;y:0px;s:inherit;e:inherit;" 
                                    data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" 
                                    data-start="1000" 
                                    data-splitin="chars" 
                                    data-splitout="none" 
                                    data-responsive_offset="on"
                                    data-elementdelay="0.05" 
                                    style="z-index: 5; white-space: nowrap; position:relative; color:#fff; font-weight:700; letter-spacing: 3.15px; font-family: 'PT Serif', serif; text-transform: uppercase;">Ideas Shape the real Course
                                </div>

                                <!-- LAYER NR. 2 -->
                                <div class="tp-caption NotGeneric-SubTitle tp-resizeme rs-parallaxlevel-0" id="slide-layer-2" 
                                    data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" 
                                    data-y="['middle','middle','middle','middle']" data-voffset="['90','90','90','90']" 
                                    data-fontsize="['70','70','70','45']"
                                    data-lineheight="['100','70','70','60']"
                                    data-width="none"
                                    data-height="none"
                                    data-whitespace="nowrap"
                                    data-transform_idle="o:1;"
                                    data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" 
                                    data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
                                    data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;" 
                                    data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" 
                                    data-start="1500" 
                                    data-splitin="none" 
                                    data-splitout="none" 
                                    data-responsive_offset="on" 
                                    style="z-index: 6; white-space: nowrap; position:relative; color:#fff; font-weight:700; letter-spacing: 3.15px; font-family: 'PT Serif', serif; text-transform: uppercase;">of History 
                                </div>

                                <!-- LAYER NR. 3 -->
                                <div class="tp-caption NotGeneric-Title tp-resizeme rs-parallaxlevel-0 slide-btn" id="slide-layer-3" 
                                    data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" 
                                    data-y="['top','top','top','top']"  data-voffset="['625','625','625','625']"
                                    data-fontsize="['70','70','70','12']"
                                    data-lineheight="['70','70','70','90']"
                                    data-width="none"
                                    data-height="none"
                                    data-whitespace="noraml"
                                    data-transform_idle="o:1;"
                                    data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" 
                                    data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
                                    data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;" 
                                    data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" 
                                    data-start="1500" 
                                    data-splitin="none" 
                                    data-splitout="none"                            
                                    data-responsive_offset="on"                         
                                    style="z-index:6; position:relative;">
                                    <a style="font-weight: 700; padding: 12px 37px; font-family: 'Poppins', sans-serif;" href="#" title="Purchase Now">Purchase Now</a>
                                </div>
                                <div class="tp-caption NotGeneric-Icon tp-resizeme rs-parallaxlevel-1 icon-img" id="slide-layer-4" 
                                    data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" 
                                    data-y="['middle','middle','middle','middle']" data-voffset="['-90','-90','-90','-90']"
                                    data-fontsize="['20','60','60','60']"
                                    data-lineheight="['70','70','70','90']"
                                    data-width="none"
                                    data-height="none"
                                    data-whitespace="nowrap"
                                    data-transform_idle="o:1;"
                                    data-style_hover="cursor:default;"
                                    data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:1500;e:Power4.easeInOut;" 
                                    data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
                                    data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;" 
                                    data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" 
                                    data-start="2000" 
                                    data-splitin="none" 
                                    data-splitout="none" 
                                    data-responsive_offset="on" 
                                    style="z-index: 7; white-space: nowrap; font-weight: 500; color:#fff; letter-spacing: 1.4px; font-family: 'Poppins', sans-serif; text-transform: uppercase; line-height: 30px;">
                                    <span>estd<img src="{{ asset('img/slider.png') }}" alt="slider">1980</span>
                                </div>
                            </li>
                            <li data-transition="zoomout" data-slotamount="default"  data-easein="easeInOut" data-easeout="easeInOut" data-masterspeed="2000" data-rotate="0"  data-fstransition="fade" data-fsmasterspeed="1500" data-fsslotamount="7">
                                <!-- MAIN IMAGE -->
                                <img src="{{ asset('img/slider-1.jpg') }}" alt="slider" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10" class="rev-slidebg" data-no-retina>
                                <!-- LAYERS -->

                                <!-- LAYER NR. 1 -->
                                <div class="tp-caption NotGeneric-Title tp-resizeme rs-parallaxlevel-0" id="slide-layer-5" 
                                    data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" 
                                    data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']" 
                                    data-fontsize="['70','70','70','45']"
                                    data-lineheight="['100','70','70','60']"
                                    data-width="none"
                                    data-height="none"
                                    data-whitespace="nowrap"
                                    data-transform_idle="o:1;"
                                    data-transform_in="x:[105%];z:0;rX:45deg;rY:0deg;rZ:90deg;sX:1;sY:1;skX:0;skY:0;s:2000;e:Power4.easeInOut;" 
                                    data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
                                    data-mask_in="x:0px;y:0px;s:inherit;e:inherit;" 
                                    data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" 
                                    data-start="1000" 
                                    data-splitin="chars" 
                                    data-splitout="none" 
                                    data-responsive_offset="on"
                                    data-elementdelay="0.05" 
                                    style="z-index: 5; white-space: nowrap; position:relative; color:#fff; font-weight:700; letter-spacing: 3.15px; font-family: 'PT Serif', serif; text-transform: uppercase;">Ideas Shape the real Course
                                </div>

                                <!-- LAYER NR. 2 -->
                                <div class="tp-caption NotGeneric-SubTitle tp-resizeme rs-parallaxlevel-0" id="slide-layer-6" 
                                    data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" 
                                    data-y="['middle','middle','middle','middle']" data-voffset="['90','90','90','90']" 
                                    data-fontsize="['70','70','70','45']"
                                    data-lineheight="['100','70','70','60']"
                                    data-width="none"
                                    data-height="none"
                                    data-whitespace="nowrap"
                                    data-transform_idle="o:1;"
                                    data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" 
                                    data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
                                    data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;" 
                                    data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" 
                                    data-start="1500" 
                                    data-splitin="none" 
                                    data-splitout="none" 
                                    data-responsive_offset="on" 
                                    style="z-index: 6; white-space: nowrap; position:relative; color:#fff; font-weight:700; letter-spacing: 3.15px; font-family: 'PT Serif', serif; text-transform: uppercase;">of History 
                                </div>

                                <!-- LAYER NR. 3 -->
                                <div class="tp-caption NotGeneric-Title tp-resizeme rs-parallaxlevel-0 slide-btn" id="slide-layer-7" 
                                    data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" 
                                    data-y="['top','top','top','top']"  data-voffset="['625','625','625','625']"
                                    data-fontsize="['70','70','70','12']"
                                    data-lineheight="['70','70','70','90']"
                                    data-width="none"
                                    data-height="none"
                                    data-whitespace="noraml"
                                    data-transform_idle="o:1;"
                                    data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" 
                                    data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
                                    data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;" 
                                    data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" 
                                    data-start="1500" 
                                    data-splitin="none" 
                                    data-splitout="none"                            
                                    data-responsive_offset="on"                         
                                    style="z-index:6; position:relative;">
                                    <a style="font-weight: 700; padding: 12px 37px; font-family: 'Poppins', sans-serif;" href="#" title="Purchase Now">Purchase Now</a>
                                </div>
                                <div class="tp-caption NotGeneric-Icon tp-resizeme rs-parallaxlevel-1 icon-img" id="slide-layer-8" 
                                    data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" 
                                    data-y="['middle','middle','middle','middle']" data-voffset="['-90','-90','-90','-90']"
                                    data-fontsize="['20','60','60','60']"
                                    data-lineheight="['70','70','70','90']"
                                    data-width="none"
                                    data-height="none"
                                    data-whitespace="nowrap"
                                    data-transform_idle="o:1;"
                                    data-style_hover="cursor:default;"
                                    data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:1500;e:Power4.easeInOut;" 
                                    data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
                                    data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;" 
                                    data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" 
                                    data-start="2000" 
                                    data-splitin="none" 
                                    data-splitout="none" 
                                    data-responsive_offset="on" 
                                    style="z-index: 7; white-space: nowrap; font-weight: 500; color:#fff; letter-spacing: 1.4px; font-family: 'Poppins', sans-serif; text-transform: uppercase; line-height: 30px;">
                                    <span>estd<img src="{{ asset('img/slider.png') }}" alt="slider">1980</span>
                                </div>
                            </li>
                        </ul>
                    </div><!-- END REVOLUTION SLIDER -->
                </div><!-- END OF SLIDER WRAPPER -->
                <span class="goto-next"><a href="#welcome-section"><i class="icon icon-Mouse bounce" aria-hidden="true"></i></a></span>
            </div><!-- Slider Section /- -->
            
            <!-- Welcome Section -->
            <div id="welcome-section" class="container-fluid no-padding welcome-section">
                <!-- Container -->
                <div class="container">
                    <!-- Section Header -->
                    <div class="section-header">
                        <div class="section-title-border">
                            <span>Welcome to</span>
                            <h2>Museum History</h2>
                        </div>
                    </div><!-- Section Header /- -->
                    <!-- Row -->
                    <div class="row">
                        <div id="welcome-carousel" class="carousel slide" data-ride="carousel">
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="listbox">
                                <div class="item active">
                                    <div class="col-md-6 col-sm-6 content-block">
                                        <p>Then one day he was shooting at some food and up through the ground came a bubbling crude oil that is so lets make the most of this beautiful day since we are together space the final frontier these are the voyages of the Starship Enterprise today still wanted by the government they survive as soldiers of fortune would not you like to get away sometimes you want to go where everybody knows your name.</p>
                                        <p>Then one day he was shooting at some food and up through the ground came a bubbling crude oil that is so lets make the most of this beautiful together space the final frontier.</p>
                                        <a href="#" title="Read More">Read More</a>
                                    </div>
                                    <div class="col-md-6 col-sm-6 img-block">
                                        <i><img src="{{ asset('img/welcome-1.jpg') }}" alt="Welcome" /></i>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="col-md-6 col-sm-6 content-block">
                                        <p>Then one day he was shooting at some food and up through the ground came a bubbling crude oil that is so lets make the most of this beautiful day since we are together space the final frontier these are the voyages of the Starship Enterprise today still wanted by the government they survive as soldiers of fortune would not you like to get away sometimes you want to go where everybody knows your name.</p>
                                        <p>Then one day he was shooting at some food and up through the ground came a bubbling crude oil that is so lets make the most of this beautiful together space the final frontier.</p>
                                        <a href="#" title="Read More">Read More</a>
                                    </div>
                                    <div class="col-md-6 col-sm-6 img-block">
                                        <i><img src="{{ asset('img/welcome-1.jpg') }}" alt="Welcome" /></i>
                                    </div>
                                </div>
                            </div>
                            <!-- Controls -->
                            <div class="wc-controls">
                                <a class="left carousel-control" href="#welcome-carousel" role="button" data-slide="prev">
                                    <span></span>
                                </a>
                                <a class="right carousel-control" href="#welcome-carousel" role="button" data-slide="next">
                                    <span></span>
                                </a>
                            </div>
                        </div>
                    </div><!-- Row /- -->
                </div><!-- Container /- -->
            </div><!-- Welcome Section /- -->
            
            <!-- Onview Section -->
            <div class="container-fluid no-padding onview-section">
                <!-- Container -->
                <div class="container">
                    <div class="col-md-5 col-sm-5 col-xs-12 img-block">
                        <img src="{{ asset('img/onview-1.png') }}" alt="onview" />
                    </div>
                    <div class="col-md-7 col-sm-7 col-xs-12 onview-content">
                        <!-- Section Header -->
                        <div class="section-header">
                            <div class="section-title-border">
                                <span>About us</span>
                                <h2>on view</h2>
                            </div>
                        </div><!-- Section Header /- -->
                        <p>Then one day he was shooting at some food and up through the ground came a bubbling crude oil that is so lets make the most of this beautiful day since we are together space the final frontier these are the voyages of the Starship Enterprise.</p>
                        <ul>
                            <li class="col-md-4 col-sm-6 col-xs-6">Arts of Global Africa</li>
                            <li class="col-md-4 col-sm-6 col-xs-6">Decorative Art</li>
                            <li class="col-md-4 col-sm-6 col-xs-6">Decorative Art</li>
                            <li class="col-md-4 col-sm-6 col-xs-6">American Art</li>
                            <li class="col-md-4 col-sm-6 col-xs-6">Gardens</li>
                            <li class="col-md-4 col-sm-6 col-xs-6">Gardens</li>
                            <li class="col-md-4 col-sm-6 col-xs-6">Arts of Asia</li>
                            <li class="col-md-4 col-sm-6 col-xs-6">War History</li>
                            <li class="col-md-4 col-sm-6 col-xs-6">War History</li>
                            <li class="col-md-4 col-sm-6 col-xs-6">Classical Art</li>
                            <li class="col-md-4 col-sm-6 col-xs-6">Kings of History</li>
                            <li class="col-md-4 col-sm-6 col-xs-6">Kings of History</li>
                            <li class="col-md-4 col-sm-6 col-xs-6">German Arts</li>
                            <li class="col-md-4 col-sm-6 col-xs-6">Vintage Arts</li>
                            <li class="col-md-4 col-sm-6 col-xs-6">Vintage Arts</li>
                        </ul>
                    </div>
                </div><!-- Container /- -->
            </div><!-- Onview Section /- -->
            <div class="padding-50"></div>
            <!-- Testimonial Section -->
            <div class="testimonial-section container-fluid no-padding">
                <!-- Container -->
                <div class="container">
                    <div class="col-md-8">
                        <div class="testimonial-slider">
                            <div class="mis-stage"> 
                                <ol class="mis-slider">
                                    <li id="mis_slide-1" class="mis-slide" data-slide="1">
                                        <a href="#" class="mis-container">
                                            <img src="{{ asset('img/testi-1.jpg') }}" alt="testimonial" />
                                        </a>
                                    </li>
                                    <li id="mis_slide-2" class="mis-slide" data-slide="2">
                                        <a href="#" class="mis-container">
                                            <img src="{{ asset('img/testi-2.jpg') }}" alt="testimonial" />
                                        </a>
                                    </li>
                                    <li id="mis_slide-3" class="mis-slide" data-slide="3">
                                        <a href="#" class="mis-container">
                                            <img src="{{ asset('img/testi-3.jpg') }}" alt="testimonial" />
                                        </a>
                                    </li>
                                    <li id="mis_slide-4" class="mis-slide" data-slide="4">
                                        <a href="#" class="mis-container">
                                            <img src="{{ asset('img/testi-1.jpg') }}" alt="testimonial" />
                                        </a>
                                    </li>
                                    <li id="mis_slide-5" class="mis-slide" data-slide="5">
                                        <a href="#" class="mis-container">
                                            <img src="{{ asset('img/testi-2.jpg') }}" alt="testimonial" />
                                        </a>
                                    </li>
                                </ol>
                                
                                <div class="mis-content-block">
                                    <div id="mis_slide_content-1">
                                        <p>"Then one day he was shooting at some food and up through the ground came a bubbling crude oil that is so lets make the most of this beautiful day since we are together space the final frontier these are the voyage"</p>
                                        <i class="icon icon-MessageRight"></i>
                                        <h3>antony fernandez</h3>
                                        <span>ceo, design hub</span>
                                    </div>
                                    <div id="mis_slide_content-2">
                                        <p>"Then one day he was shooting at some food and up through the ground came a bubbling crude oil that is so lets make the most of this beautiful day since we are together space the final frontier these are the voyage"</p>
                                        <i class="icon icon-MessageRight"></i>
                                        <h3>antony fernandez</h3>
                                        <span>ceo, design hub</span>
                                    </div>
                                    <div id="mis_slide_content-3">
                                        <p>"Then one day he was shooting at some food and up through the ground came a bubbling crude oil that is so lets make the most of this beautiful day since we are together space the final frontier these are the voyage"</p>
                                        <i class="icon icon-MessageRight"></i>
                                        <h3>antony fernandez</h3>
                                        <span>ceo, design hub</span>
                                    </div>
                                    <div id="mis_slide_content-4">
                                        <p>"Then one day he was shooting at some food and up through the ground came a bubbling crude oil that is so lets make the most of this beautiful day since we are together space the final frontier these are the voyage"</p>
                                        <i class="icon icon-MessageRight"></i>
                                        <h3>antony fernandez</h3>
                                        <span>ceo, design hub</span>
                                    </div>
                                    <div id="mis_slide_content-5">
                                        <p>"Then one day he was shooting at some food and up through the ground came a bubbling crude oil that is so lets make the most of this beautiful day since we are together space the final frontier these are the voyage"</p>
                                        <i class="icon icon-MessageRight"></i>
                                        <h3>antony fernandez</h3>
                                        <span>ceo, design hub</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- Container /-  -->
            </div><!-- Testimonial Section /- -->
            
            <!-- Client Section -->
            <div class="container-fluid no-padding client-section">
                <div class="client-carousel">
                    <div class="item">
                        <a href="#"><img src="{{ asset('img/client-1.png') }}" alt="Client" /></a>
                    </div>
                    <div class="item item-bg">
                        <a href="#"><img src="{{ asset('img/client-2.png') }}" alt="Client" /></a>
                    </div>
                    <div class="item">
                        <a href="#"><img src="{{ asset('img/client-3.png') }}" alt="Client" /></a>
                    </div>
                    <div class="item item-bg">
                        <a href="#"><img src="{{ asset('img/client-4.png') }}" alt="Client" /></a>
                    </div>
                    <div class="item">
                        <a href="#"><img src="{{ asset('img/client-5.png') }}" alt="Client" /></a>
                    </div>
                </div>
            </div><!-- Client Section /- -->
            
            <!-- Upcoming Events -->
            <div class="container-fluid no-padding upcoming-event">
                <div class="section-padding"></div>
                <!-- Container -->
                <div class="container">
                    <!-- Section Header -->
                    <div class="section-header">
                        <div class="section-title-border">
                            <span>Exhibitions</span>
                            <h2>UPCOMING EVENTS</h2>
                        </div>
                    </div><!-- Section Header /- -->
                    <div class="col-md-8 col-sm-12 col-xs-12 no-padding">
                        <!-- Event Block -->
                        <div class="col-md-12 col-sm-12 col-xs-12 no-padding event-block">
                            <div class="col-md-12 col-sm-12 col-xs-12 event-content">
                                <div class="post-date">
                                    <span>26</span>
                                    <span>may</span>
                                </div>
                                <h3><a href="#" title="British Museum">HEAVEN MUSEUM</a></h3>
                                <h4><a href="#" title="Melbourne, Australia"><i class="fa fa-map-marker"></i>Melbourne, Australia</a> <a href="#"><i class="fa fa-clock-o"></i>MON: 10AM - 6PM</a></h4>
                                <p>Then one day he was shooting at some food and up through the ground came a bubbling crude oil that is so lets make the most of this beautiful day the ground.</p>
                            </div>
                        </div><!-- Event Block /- -->
                        <!-- Event Block -->
                        <div class="col-md-12 col-sm-12 col-xs-12 no-padding event-block">
                            <div class="event-cover"><a href="#"><img src="{{ asset('img/upcoming-event1.jpg') }}" alt="Events" /></a></div>
                            <div class="col-md-12 col-sm-12 col-xs-12 event-content">
                                <div class="post-date">
                                    <span>05</span>
                                    <span>jun</span>
                                </div>
                                <h3><a href="#" title="Forge Museum">Forge Museum</a></h3>
                                <h4><a href="#" title="London, England"><i class="fa fa-map-marker"></i>London, England</a> <a href="#"><i class="fa fa-clock-o"></i>Sunday 10AM - 6PM</a></h4>
                                <p>Then one day he was shooting at some food and up through the ground came a bubbling crude oil that is so lets make the most of this beautiful day the ground.</p>
                            </div>
                        </div><!-- Event Block /- -->
                        <a href="#" title="View all events">VIEW ALL EVENTS</a>
                    </div>
                </div><!-- Container /- -->
                
                <div class="section-padding"></div>
            </div><!-- Upcoming Events /- -->
            
            <!-- Latest Blog -->
            <div class="container-fluid no-padding latest-blog">
                <div class="section-padding"></div>
                <!-- Container -->
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <!-- Section Header -->
                            <div class="section-header">
                                <div class="section-title-border">
                                    <span>What Our Client Says</span>
                                    <h2>LATEST NEWS</h2>
                                </div>
                            </div><!-- Section Header /- -->
                        </div>
                        <div class="col-md-6">
                            <p>Then one day he was shooting at some food and up through the ground came a bubbling crude oil that is so lets make the most of this beautiful day the ground then one day he was shooting at some food and up through the ground came a bubbling.</p>
                        </div>
                        <div class="col-md-2">
                            <div class="wc-controls">
                                <a href="javascript:void(0)" class="left"><span></span></a>
                                <a href="javascript:void(0)" class="right"><span></span></a>
                            </div>
                        </div>
                        <div class="blog-carousel col-md-12 no-padding">
                            <article class="type-post">
                                <div class="col-md-6">
                                    <div class="entry-cover"><a href="#"><img src="{{ asset('img/latest-blog1.jpg') }}" alt="Blog" /></a></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="entry-header">
                                        <div class="post-date"> 
                                            <b>05</b>
                                            <span>April</span>
                                            <span>2016</span>
                                        </div>
                                        <h3 class="entry-title"><a href="#" title="Beautiful day the ground then one day">beautiful day the ground then one day</a></h3>
                                    </div>
                                    <div class="entry-content">
                                        <p>Then one day he was shooting at some food and up through the ground came a crude oil that is so lets bubbling  make the most of this beautiful day.</p>
                                        <div class="entry-meta">
                                            <div class="byline"><a href="#" title="Thomas Antony">Thomas Antony</a></div>
                                            <div class="post-comment"><a href="#"><i class="fa fa-commenting-o"></i>17 Comments</a></div>
                                        </div>
                                        <a href="#" title="Read More">Read More</a>
                                    </div>
                                </div>
                            </article>
                            
                            <article class="type-post">
                                <div class="col-md-6">
                                    <div class="entry-cover"><a href="#"><img src="{{ asset('img/latest-blog1.jpg') }}" alt="Blog" /></a></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="entry-header">
                                        <div class="post-date"> 
                                            <b>05</b>
                                            <span>April</span>
                                            <span>2016</span>
                                        </div>
                                        <h3 class="entry-title"><a href="#" title="Beautiful day the ground then one day">beautiful day the ground then one day</a></h3>
                                    </div>
                                    <div class="entry-content">
                                        <p>Then one day he was shooting at some food and up through the ground came a crude oil that is so lets bubbling  make the most of this beautiful day.</p>
                                        <div class="entry-meta">
                                            <div class="byline"><a href="#" title="Thomas Antony">Thomas Antony</a></div>
                                            <div class="post-comment"><a href="#"><i class="fa fa-commenting-o"></i>17 Comments</a></div>
                                        </div>
                                        <a href="#" title="Read More">Read More</a>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                </div><!-- Container /- -->
                <div class="section-padding"></div>
            </div><!-- Latest Blog /- -->
            
            
            <!-- Portfolio Section -->
            <div class="container-fluid no-padding portfolio-section">
                <!-- Container -->
                <div class="container">
                    <div class="row">
                        <div class="col-md-5">
                            <!-- Section Header -->
                            <div class="section-header">
                                <div class="section-title-border">
                                    <span>Its Our Great Flows</span>
                                    <h2>our gallery</h2>
                                </div>
                            </div><!-- Section Header /- -->
                        </div>
                        <div class="col-md-7 portfolio-categories">
                            <ul id="filters">
                                <li><a data-filter="*" class="active" href="#">ALL</a></li>
                                <li><a data-filter=".modern" href="#">MODERN ART</a></li>
                                <li><a data-filter=".vintage" href="#">VINTAGE ART</a></li>
                                <li><a data-filter=".statue" href="#">ANCIENT STATUE</a></li>
                                <li><a data-filter=".others" href="#">OTHERS</a></li>
                            </ul>
                        </div>
                    </div>
                    
                </div><!-- Container /- -->
                <div class="portfolio-list">
                    <div class="portfolio-box col-md-6 col-sm-6 no-padding modern statue">
                        <a href="{{ asset('img/portfolio-1.jpg') }}">
                            <img src="{{ asset('img/portfolio-1.jpg') }}" alt="Portfolio" />
                            <div class="portfolio-content">
                                <i class="icon icon-Search"></i>
                                <h3>spral cloud</h3>
                                <span>Photography</span>
                            </div>
                        </a>
                    </div>
                    <div class="portfolio-box col-md-3 col-sm-3 no-padding vintage">
                        <a href="{{ asset('img/portfolio-2.jpg') }}">
                            <img src="{{ asset('img/portfolio-2.jpg') }}" alt="Portfolio" />
                            <div class="portfolio-content">
                                <i class="icon icon-Search"></i>
                                <h3>spral cloud</h3>
                                <span>Photography</span>
                            </div>
                        </a>
                    </div>
                    <div class="portfolio-box col-md-3 col-sm-3 no-padding statue others">
                        <a href="{{ asset('img/portfolio-3.jpg') }}">
                            <img src="{{ asset('img/portfolio-3.jpg') }}" alt="Portfolio" />
                            <div class="portfolio-content">
                                <i class="icon icon-Search"></i>
                                <h3>spral cloud</h3>
                                <span>Photography</span>
                            </div>
                        </a>
                    </div>
                    <div class="portfolio-box col-md-3 col-sm-3 no-padding others">
                        <a href="{{ asset('img/portfolio-4.jpg') }}">
                            <img src="{{ asset('img/portfolio-4.jpg') }}" alt="Portfolio" />
                            <div class="portfolio-content">
                                <i class="icon icon-Search"></i>
                                <h3>spral cloud</h3>
                                <span>Photography</span>
                            </div>
                        </a>
                    </div>
                    <div class="portfolio-box col-md-3 col-sm-3 no-padding modern">
                        <a href="{{ asset('img/portfolio-5.jpg') }}">
                            <img src="{{ asset('img/portfolio-5.jpg') }}" alt="Portfolio" />
                            <div class="portfolio-content">
                                <i class="icon icon-Search"></i>
                                <h3>spral cloud</h3>
                                <span>Photography</span>
                            </div>
                        </a>
                    </div>
                    <div class="portfolio-box col-md-6 col-sm-6 no-padding vintage modern">
                        <a href="{{ asset('img/portfolio-6.jpg') }}">
                            <img src="{{ asset('img/portfolio-6.jpg') }}" alt="Portfolio" />
                            <div class="portfolio-content">
                                <i class="icon icon-Search"></i>
                                <h3>spral cloud</h3>
                                <span>Photography</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div><!-- Portfolio Section /- -->
            
            <!-- Call To Action -->
            <div class="container-fluid no-padding cta-section">
                <!-- Container -->
                <div class="container">
                    <h3><img src="{{ asset('img/cta-logo.png') }}" alt="Logo" />here comes the best museum theme ever</h3>
                    <a href="#" title="PURCHASE NOW">PURCHASE NOW</a>
                </div>
                <!-- Container /- -->
            </div><!-- Call To Action /- -->
            
        </main>

        <!-- Footer Section -->
        <footer class="footer-main container-fluid no-padding">
            <!-- Container -->
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-xs-6">
                        <!-- Widget About -->
                        <aside class="ftr-widget widget_about">
                            <a title="Logo" href="index.html" class="navbar-brand"><img src="{{ asset('img/logo-1.png') }}" alt="logo" /></a>
                            <p>Then one day he was shooting at some food and up the ground came a crude oil day he was shooting at some food.</p>
                            <ul>
                                <li><a href="#" title="Facebbok"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#" title="Google"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#" title="Instagram"><i class="fa fa-instagram"></i></a></li>
                                <li><a href="#" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </aside><!-- Widget About /- -->    
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-6">
                        <!-- Widget Link -->
                        <aside class="ftr-widget widget_link">
                            <h3 class="widget-title">INFORMATION</h3>
                            <ul>
                                <li class="col-md-6 col-sm-6 col-xs-6"><a href="about.html" title="About">About</a></li>
                                <li class="col-md-6 col-sm-6 col-xs-6"><a href="#" title="On View">On View</a></li>
                                <li class="col-md-6 col-sm-6 col-xs-6"><a href="#" title="History">History</a></li>
                                <li class="col-md-6 col-sm-6 col-xs-6"><a href="gallery.html" title="Gallery">Gallery</a></li>
                                <li class="col-md-6 col-sm-6 col-xs-6"><a href="#" title="Services">Services</a></li>
                                <li class="col-md-6 col-sm-6 col-xs-6"><a href="contactus.html" title="Contact">Contact</a></li>
                            </ul>
                        </aside><!-- Widget Link /- -->
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-6">
                        <!-- Widget Link -->
                        <aside class="ftr-widget widget_link">
                            <h3 class="widget-title">resources</h3>
                            <ul>
                                <li><a href="#" title="Terms of Use">Terms of Use</a></li>
                                <li><a href="#" title="Privacy Policy">Privacy Policy</a></li>
                                <li><a href="#" title="Sitemaps">Sitemaps</a></li>
                            </ul>
                        </aside><!-- Widget Link /- -->
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-6">
                        <!-- Widget Link -->
                        <aside class="ftr-widget widget_subscribe">
                            <h3 class="widget-title">newsletter</h3>
                            <input type="text" class="form-control" placeholder="Your Email id">
                            <button type="button" title="Subcribe" class="btn btn-default">Subcribe</button>
                        </aside><!-- Widget Link /- -->
                    </div>
                </div>
            </div><!-- Container /- -->
            
            <!-- Copyright -->
            <div class="container-fluid no-padding copyright">
                <p>copyrights <i class="fa fa-copyright"></i> 2016. all rights reserved</p>
            </div><!-- Copyright /- -->
        </footer><!-- Footer Section /- -->
        
    </div>
</body>

@endsection