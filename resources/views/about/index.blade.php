@extends('layouts.master')

@push('title')
<title>Lusy Wahyudi - About</title>
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

            <!-- Page Banner -->
            <div class="container-fluid no-padding page-banner">
                <!-- Container -->
                <div class="container">
                    <h3>about</h3>
                </div>
                <!-- Container /- -->
            </div>
            <!-- Page Banner /- -->

            <!-- About Us Section -->
            <div id="welcome-section" class="container-fluid no-padding welcome-section2">
                <!-- Container -->
                <div class="container">
                    <!-- Row -->
                    <div class="row">           
                        <div class="col-md-6 col-sm-6 img-block">
                            <i><img src="{{ $about[0]->image_path }}" alt="{{ $about[0]->title }}" /></i>
                        </div>
                        <div class="col-md-6 col-sm-6 content-block">
                            <!-- Section Header -->
                            <div class="section-header2">
                                <i><img src="{{ asset('img/section-header2-1.png') }}" alt="Section Header" /></i>
                                <h2>{{ $about[0]->title }}</h2>
                            </div>
                            <!-- Section Header /- -->
                            <p>
                                {!! $about[0]->content !!}
                            </p>
                        </div>
                    </div>
                    <!-- Row /- -->
                </div>
                <!-- Container /- -->
            </div>
            <!-- About Us Section /- -->
            
            <!-- Portfolio Section -->
            <div class="container-fluid no-padding onview-section">
                <h1>PORTFOLIO SECTION</h1>
            </div><!-- Portfolio Section /- -->
            

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
                    
                </div>

                <!-- Container /- -->
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