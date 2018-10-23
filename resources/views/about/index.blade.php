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
                            <i><img src="{{ asset('img/welcome-2.png') }}" alt="Welcome" /></i>
                        </div>
                        <div class="col-md-6 col-sm-6 content-block">
                            <!-- Section Header -->
                            <div class="section-header2">
                                <i><img src="{{ asset('img/section-header2-1.png') }}" alt="Section Header" /></i>
                                <span>Welcome to</span>
                                <h2>Museum History</h2>
                            </div>
                            <!-- Section Header /- -->
                            <p>Then one day he was shooting at some food and up through the ground came a bubbling crude oil that is so lets make the most of this beautiful day since we are together space the final frontier these are the voyages of the Starship Enterprise today still wanted by the government they survive as soldiers of fortune would not you like to get away sometimes you want to go where everybody knows your name.</p>
                            <a href="#" title="Read More">Read More</a>
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
                                <div class="item active">

                                     <!-- Section Header -->
                                    <div class="section-header">
                                        <div class="section-title-border">
                                            <span>Welcome to</span>
                                            <h2>Ikebana Ikenobo</h2> 
                                        </div>
                                    </div>
                                    <!-- Section Header /- -->
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

                                     <!-- Section Header -->
                                    <div class="section-header">
                                        <div class="section-title-border">
                                            <span>Welcome to</span>
                                            <h2>Handcraft</h2> 
                                        </div>
                                    </div>
                                    <!-- Section Header /- -->
                                    <div class="col-md-6 col-sm-6 content-block-custom">
                                        <p>
                                            Then one day he was shooting at some food and up through the ground came a bubbling crude oil that is so lets make the most of this beautiful day since we are together space the final frontier these are the voyages of the Starship Enterprise today still wanted by the government they survive as soldiers of fortune would not you like to get away sometimes you want to go where everybody knows your name.

                                            Then one day he was shooting at some food and up through the ground came a bubbling crude oil that is so lets make the most of this beautiful together space the final frontier.
                                        </p>
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
                    </div>
                    <!-- Row /- -->
                </div>
                <!-- Container /- -->
            </div>
            <!-- Shop Showcase Section /- -->

        </main>

        <!-- Footer Section -->
        <footer class="footer-main container-fluid no-padding">
            <!-- Container -->
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <!-- Widget About -->
                        <aside class="ftr-widget widget_about">
                            <a title="Logo" href="index.html" class="navbar-brand"><img src="{{ asset('img/logo-1.png') }}" alt="logo" /></a>
                            <p>Ikebana is not just about sticking a flower into a vase: it is about  the love and need of the artist to create beautiful form. Ikebana is not just about flowers, it is about the person who arranges them.</p>
                            <ul>
                                <li><a href="#" title="Facebbok"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#" title="Google"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#" title="Instagram"><i class="fa fa-instagram"></i></a></li>
                                <li><a href="#" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </aside>
                        <!-- Widget About /- -->    
                    </div>
            </div>
            <!-- Container /- -->
            
            <!-- Copyright -->
            <div class="container-fluid no-padding copyright">
                <p>copyrights <i class="fa fa-copyright"></i> 2016. all rights reserved</p>
            </div>
            <!-- Copyright /- -->
        </footer>
        <!-- Footer Section /- -->
        
    </div>
</body>

@endsection