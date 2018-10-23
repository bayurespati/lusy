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
                    <h3>gallery</h3>
                </div>
                <!-- Container /- -->
            </div>
            <!-- Page Banner /- -->
        
            <!-- Portfolio Section -->
            <div class="container-fluid no-padding portfolio-section">
                <!-- Container -->
                <div class="container">
                    <div class="col-md-12 col-sm-12 col-xs-12 no-padding portfolio-categories">
                        <ul id="filters">
                            <li><a data-filter="*" class="active" href="#">ALL</a></li>
                            <li><a data-filter=".modern" href="#">MODERN ART</a></li>
                            <li><a data-filter=".vintage" href="#">VINTAGE ART</a></li>
                            <li><a data-filter=".statue" href="#">ANCIENT STATUE</a></li>
                            <li><a data-filter=".others" href="#">OTHERS</a></li>
                        </ul>
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
                    <div class="portfolio-box col-md-3 col-sm-3 no-padding vintage">
                        <a href="{{ asset('img/portfolio-7.jpg') }}">
                            <img src="{{ asset('img/portfolio-7.jpg') }}" alt="Portfolio" />
                            <div class="portfolio-content">
                                <i class="icon icon-Search"></i>
                                <h3>spral cloud</h3>
                                <span>Photography</span>
                            </div>
                        </a>
                    </div>
                    <div class="portfolio-box col-md-3 col-sm-3 no-padding statue others">
                        <a href="{{ asset('img/portfolio-8.jpg') }}">
                            <img src="{{ asset('img/portfolio-8.jpg') }}" alt="Portfolio" />
                            <div class="portfolio-content">
                                <i class="icon icon-Search"></i>
                                <h3>spral cloud</h3>
                                <span>Photography</span>
                            </div>
                        </a>
                    </div>
                    <div class="portfolio-box col-md-3 col-sm-3 no-padding others">
                        <a href="{{ asset('img/portfolio-9.jpg') }}">
                            <img src="{{ asset('img/portfolio-9.jpg') }}" alt="Portfolio" />
                            <div class="portfolio-content">
                                <i class="icon icon-Search"></i>
                                <h3>spral cloud</h3>
                                <span>Photography</span>
                            </div>
                        </a>
                    </div>
                    <div class="portfolio-box col-md-3 col-sm-3 no-padding modern">
                        <a href="{{ asset('img/portfolio-10.jpg') }}">
                            <img src="{{ asset('img/portfolio-10.jpg') }}" alt="Portfolio" />
                            <div class="portfolio-content">
                                <i class="icon icon-Search"></i>
                                <h3>spral cloud</h3>
                                <span>Photography</span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="padding-80"></div>
                <nav class="ow-pagination text-center">
                    <ul class="pagination">
                        <li><a href="#"><i class="fa fa-angle-double-left"></i></a></li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#"><i class="fa fa-angle-double-right"></i></a></li>
                    </ul>
                </nav>
            </div>
            <!-- Portfolio Section /- -->
            
            <div class="section-padding"></div>

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
                        </aside><!-- Widget About /- -->    
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