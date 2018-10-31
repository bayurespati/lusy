@extends('layouts.master')

@push('title')
<title>Lusy Wahyudi - Shop</title>
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
                    <h3>Shop</h3>
                </div>
                <!-- Container /- -->
            </div>
            <!-- Page Banner /- -->

            <!-- Item Section -->
            <div class="container-fluid no-padding welcome-section2">
                <!-- Container -->
                <div class="container">
                    <!-- Row -->
                    <div class="row">           
                         <div class="item">
                            <div class="col-md-6 col-sm-6">
                                <div class="img-block">
                                    <i><img src="{{ asset('img/welcome-1.jpg') }}" alt="Welcome" /></i>
                                </div>

                                <div class="portfolio-section" style="padding-top: 8px">
                                    <div class="portfolio-list">
                                        <div class="portfolio-box col-md-3 col-sm-3 no-padding vintage">
                                            <a href="{{ asset('img/portfolio-2.jpg') }}">
                                                <img src="{{ asset('img/portfolio-2.jpg') }}" alt="Portfolio" />
                                                <div class="portfolio-content">
                                                    <span>Title</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="portfolio-box col-md-3 col-sm-3 no-padding vintage">
                                            <a href="{{ asset('img/portfolio-2.jpg') }}">
                                                <img src="{{ asset('img/portfolio-2.jpg') }}" alt="Portfolio" />
                                                <div class="portfolio-content">
                                                    <span>Title</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="portfolio-box col-md-3 col-sm-3 no-padding vintage">
                                            <a href="{{ asset('img/portfolio-2.jpg') }}">
                                                <img src="{{ asset('img/portfolio-2.jpg') }}" alt="Portfolio" />
                                                <div class="portfolio-content">
                                                    <span>Title</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="portfolio-box col-md-3 col-sm-3 no-padding vintage">
                                            <a href="{{ asset('img/portfolio-2.jpg') }}">
                                                <img src="{{ asset('img/portfolio-2.jpg') }}" alt="Portfolio" />
                                                <div class="portfolio-content">
                                                    <span>Title</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="padding-20"></div>

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
                            </div>

                            <div class="col-md-6 col-sm-6 content-block-custom">
                                 <!-- Section Header -->
                                 <div class="section-header">
                                    <div class="section-title-border">
                                        <span>VOL 1 - THE ART OF IKENOBO IKEBANA</span>
                                        <h2>Perfect Imperfection</h2> 
                                    </div>
                                </div>
                                <!-- Section Header /- -->
                                <span class="item-price-detail">IDR 1.250.000</span>

                                <p>
                                    A brief history about Ikenobo, the oldest school of Ikebana in Japan. Understanding the design principles and elements of Ikebana Ikenobo for Rikka arrangement, Rikka Shofutai and Rikka Shimputai.

                                    A step by step guide to create an Ikebana Ikenobo Rikka arrangement, contains more than a hundred of Ikebana Ikenobo Rikka arrangement photographs by author.

                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.

                                    ISBN : 978-602-6202-07-9
                                    Published : April, 2017
                                    Language: English
                                    Pages : 207 pages
                                    Dimensions: 250 mm x 310 mm
                                </p>

                                <div>
                                    <button class="general-btn transitioned-btn">Overseas Inquiry</button>
                                    <button class="general-btn transitioned-btn ml-2">Buy Now</button>
                                </div>
                            </div>
                        </div>
                    </div><!-- Row /- -->
                </div><!-- Container /- -->
            </div>
            <!-- Item Section /- -->

        </main>

        <!-- Footer Section -->
        @include('partials.footer')
        <!-- Footer Section /- -->
        
    </div>
</body>

@endsection