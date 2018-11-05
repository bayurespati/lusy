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
                                    <i><img src="{{ $shopItem->poster }}" alt="{{ $shopItem->title }}" /></i>
                                </div>

                                <!-- <div class="portfolio-section" style="padding-top: 8px"> -->
                                    <!-- <div class="portfolio-list"> -->
                                        <!-- <div class="portfolio-box col-md-3 col-sm-3 no-padding vintage"> -->
                                            <!-- <a href="{{ asset('img/portfolio-2.jpg') }}"> -->
                                                <!-- <img src="{{ asset('img/portfolio-2.jpg') }}" alt="Portfolio" /> -->
                                                <!-- <div class="portfolio-content"> -->
                                                    <!-- <span>Title</span> -->
                                                <!-- </div> -->
                                            <!-- </a> -->
                                        <!-- </div> -->
                                        <!-- <div class="portfolio-box col-md-3 col-sm-3 no-padding vintage"> -->
                                            <!-- <a href="{{ asset('img/portfolio-2.jpg') }}"> -->
                                                <!-- <img src="{{ asset('img/portfolio-2.jpg') }}" alt="Portfolio" /> -->
                                                <!-- <div class="portfolio-content"> -->
                                                    <!-- <span>Title</span> -->
                                                <!-- </div> -->
                                            <!-- </a> -->
                                        <!-- </div> -->
                                        <!-- <div class="portfolio-box col-md-3 col-sm-3 no-padding vintage"> -->
                                            <!-- <a href="{{ asset('img/portfolio-2.jpg') }}"> -->
                                                <!-- <img src="{{ asset('img/portfolio-2.jpg') }}" alt="Portfolio" /> -->
                                                <!-- <div class="portfolio-content"> -->
                                                    <!-- <span>Title</span> -->
                                                <!-- </div> -->
                                            <!-- </a> -->
                                        <!-- </div> -->
                                        <!-- <div class="portfolio-box col-md-3 col-sm-3 no-padding vintage"> -->
                                            <!-- <a href="{{ asset('img/portfolio-2.jpg') }}"> -->
                                                <!-- <img src="{{ asset('img/portfolio-2.jpg') }}" alt="Portfolio" /> -->
                                                <!-- <div class="portfolio-content"> -->
                                                    <!-- <span>Title</span> -->
                                                <!-- </div> -->
                                            <!-- </a> -->
                                        <!-- </div> -->
                                    <!-- </div> -->

                                    <!-- <div class="padding-20"></div> -->

                                    <!-- <nav class="ow-pagination text-center"> -->
                                        <!-- <ul class="pagination"> -->
                                            <!-- <li><a href="#"><i class="fa fa-angle-double-left"></i></a></li> -->
                                            <!-- <li><a href="#">1</a></li> -->
                                            <!-- <li><a href="#">2</a></li> -->
                                            <!-- <li><a href="#">3</a></li> -->
                                            <!-- <li><a href="#"><i class="fa fa-angle-double-right"></i></a></li> -->
                                        <!-- </ul> -->
                                    <!-- </nav> -->
                                <!-- </div> -->
                            </div>

                            <div class="col-md-6 col-sm-6 content-block-custom">
                                 <!-- Section Header -->
                                 <div class="section-header">
                                    <div class="section-title-border">
                                        <span>{{ $shopItem->sub_title }}</span>
                                        <h2>{{ $shopItem->title }}</h2> 
                                    </div>
                                </div>
                                <!-- Section Header /- -->
                                <span class="item-price-detail">IDR {{ $shopItem->price }}</span>

                                <p>
                                    {!! nl2br(e($shopItem->description)) !!}
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