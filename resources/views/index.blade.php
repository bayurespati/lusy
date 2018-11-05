@extends('layouts.master')

@push('title')
<title>Lusy Wahyudi</title>
@endpush

@push('additional_css')
<style type="text/css">
    .cut-content {
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
    }
</style>
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
        @include('partials.header')
        <!-- Header Section /- -->

        <main>
        
            <!-- Slider Section -->
            <div id="home-revslider" class="slider-section container-fluid no-padding ">
                <!-- START REVOLUTION SLIDER 5.0 -->
                <div class="rev_slider_wrapper">
                    <div id="home-slider1" class="rev_slider" data-version="5.0">
                        <ul>
                            @if (count($imageSlider) > 0)
                                @for ($i = 0; $i < count($imageSlider); $i++)                        
                                <li data-transition="zoomout" data-slotamount="default"  data-easein="easeInOut" data-easeout="easeInOut" data-masterspeed="2000" data-rotate="0"  data-fstransition="fade" data-fsmasterspeed="1500" data-fsslotamount="7">
                                    <!-- MAIN IMAGE -->
                                    <img src="{{ $imageSlider[$i]->image_show }}" alt="slider" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10" class="rev-slidebg" data-no-retina>
                                </li>
                                @endfor
                            @else
                            <li data-transition="zoomout" data-slotamount="default"  data-easein="easeInOut" data-easeout="easeInOut" data-masterspeed="2000" data-rotate="0"  data-fstransition="fade" data-fsmasterspeed="1500" data-fsslotamount="7">
                                <!-- MAIN IMAGE -->
                                <img src="{{ asset('img/slider-1.jpg') }}" alt="slider" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10" class="rev-slidebg" data-no-retina>
                            </li>
                            @endif
                        </ul>
                    </div>
                    <!-- END REVOLUTION SLIDER -->
                </div>
                <!-- END OF SLIDER WRAPPER -->

            <!-- Slider Section /- -->

            <!-- About Us Section -->
            <div id="welcome-section" class="container-fluid no-padding welcome-section2" style="padding-top: 180px">
                <!-- Container -->
                <div class="container">
                    <!-- Row -->
                    <div class="row">           
                        <div class="col-md-6 col-sm-6 img-block">
                            <i><img src="{{ $introduction[0]->image_path }}" alt="{{ $introduction[0]->title }}" /></i>
                        </div>
                        <div class="col-md-6 col-sm-6 content-block">
                            <!-- Section Header -->
                            <div class="section-header2">
                                <i><img src="{{ asset('img/section-header2-1.png') }}" alt="Section Header" /></i>
                                <h2>{{ $introduction[0]->title }}</h2>
                            </div><!-- Section Header /- -->

                            <p>
                                {!! nl2br(e($introduction[0]->content)) !!}
                            </p>

                            <a href="{{ route('about.index') }}" title="Read More">Read More</a>
                        </div>
                    </div><!-- Row /- -->
                </div><!-- Container /- -->
            </div>
            <!-- About Us Section /- -->
            
            <!-- Portfolio Section -->
            <div class="container-fluid no-padding onview-section">
                <h1>PORTFOLIO SECTION</h1>
            </div>
            <!-- Portfolio Section /- -->
            
            <!-- Upcoming Events Section -->
            <div class="container-fluid no-padding upcoming-event">
                <div class="section-padding"></div>
                <!-- Container -->
                <div class="container">
                    <!-- Section Header -->
                    <div class="section-header">
                        <div class="section-title-border">
                            <span>Proud to Presents</span>
                            <h2>LATEST EVENTS</h2>
                        </div>
                    </div>
                    <!-- Section Header /- -->
                    <div class="col-md-8 col-sm-12 col-xs-12 no-padding">

                        @foreach($showcasedEvents as $event)
                        <div class="col-md-12 col-sm-12 col-xs-12 no-padding event-block">
                            <div class="col-md-12 col-sm-12 col-xs-12 event-content">
                                <div class="post-date">
                                    <span>{{ $event->dayDate }}</span>
                                    <span>{{ $event->month }}</span>
                                </div>
                                <h3><a href="/event/single/{{ $event->id }}" title="{{ $event->title }}">{{ $event->title }}</a></h3>
                                <h4><a href="/event/single/{{ $event->id }}" title="{{ $event->location }}"><i class="fa fa-map-marker"></i>{{ $event->location }}</a> <a href="/event/single/{{ $event->id }}"><i class="fa fa-clock-o"></i>{{ $event->dayComplete }} {{ $event->startHour }} - {{ $event->endHour }}</a></h4>
                                <p class="cut-content">{{ $event->content }}</p>
                            </div>
                        </div>
                        @endforeach

                        <a href="{{ route('event.index') }}" title="View all events">VIEW ALL EVENTS</a>
                    </div>
                </div>
                <!-- Container /- -->
                
                <div class="section-padding"></div>
            </div>
            <!-- Upcoming Events Section /- -->

            <!-- Gallery Showcase Section -->
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
                    </div>
                    
                </div><!-- Container /- -->
                <div class="portfolio-list">
                    @foreach($showedImage as $image)
                        <div class="portfolio-box col-md-3 col-sm-3 no-padding vintage">
                            <a href="{{ $image->image_path }}">

                                <img src="{{ $image->image_path }}" alt="{{ $image->title }}" />

                                <div class="portfolio-content">
                                    <i class="icon icon-Search"></i>
                                    <h3>{{ $image->title }}</h3>
                                    <span>{{ $image->creator }}</span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- Gallery Showcase Section /- -->

            <!-- Shop Showcase Section -->
            <div class="container-fluid no-padding welcome-section">
                <!-- Container -->
                <div class="container">
                   
                    <!-- Row -->
                    <div class="row">
                        <div id="welcome-carousel" class="carousel slide" data-ride="carousel">
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="listbox">
                                @for ($i = 0; $i < count($classes); $i++)
                                <div class="item {{ $i === 0 ? 'active' : '' }}">

                                     <!-- Section Header -->
                                    <div class="section-header">
                                        <div class="section-title-border">
                                            <span>Introducing</span>
                                            <h2>{{ $classes[$i]->title }}</h2> 
                                        </div>
                                    </div>
                                    <!-- Section Header /- -->
                                    <div class="col-md-6 col-sm-6 content-block-custom">
                                        <p>
                                            {!! $classes[$i]->content !!}
                                        </p>
                                        
                                        <button class="general-btn transitioned-btn">
                                            Register
                                        </button>
                                    </div>
                                    <div class="col-md-6 col-sm-6 img-block">
                                        <i><img src="{{ $classes[$i]->image_path }}" alt="{{ $classes[$i]->title }}" /></i>
                                    </div>
                                </div>
                                @endfor
                                
                            </div>
                            <!-- Controls -->
                            <div class="wc-controls wc-controls-custom">
                                <a class="left carousel-control" href="#welcome-carousel" role="button" data-slide="prev">
                                    <span></span>
                                </a>
                                <a class="right carousel-control" href="#welcome-carousel" role="button" data-slide="next">
                                    <span></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Row /- -->
                </div>
                <!-- Container /- -->
            </div>
            <!-- Shop Showcase Section /- -->
            
        </main>

        <!-- Footer Section -->
        @include('partials.footer')
        <!-- Footer Section /- -->
    </div>
</body>

@endsection