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
                    <h3>Shop</h3>
                </div>
                <!-- Container /- -->
            </div>
            <!-- Page Banner /- -->

            <!-- Shop Items /- -->
            <div class="container-fluid no-padding shop-items-section">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 shop-item-wrapper">
                            <a href="shop/item">
                                <div class="shop-item">
                                    <div class="item-pic-frame">
                                        <img class="item-pic" src="{{ asset('img/shop-item.gif') }}" alt="Bows by Lusy Wahyudi" title="Bows by Lusy Wahyudi">
                                    </div>

                                    <div class="item-details">
                                        <p class="item-description" href="#">Bows</p>
                                        <p class="item-price">Rp 399.000</p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 shop-item-wrapper">
                            <a href="shop/item">
                                <div class="shop-item">
                                    <div class="item-pic-frame">
                                        <img class="item-pic" src="{{ asset('img/shop-item.gif') }}" alt="Bows by Lusy Wahyudi" title="Bows by Lusy Wahyudi">
                                    </div>

                                    <div class="item-details">
                                        <p class="item-description" href="#">Bows</p>
                                        <p class="item-price">Rp 399.000</p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 shop-item-wrapper">
                            <a href="shop/item">
                                <div class="shop-item">
                                    <div class="item-pic-frame">
                                        <img class="item-pic" src="{{ asset('img/shop-item.gif') }}" alt="Bows by Lusy Wahyudi" title="Bows by Lusy Wahyudi">
                                    </div>

                                    <div class="item-details">
                                        <p class="item-description" href="#">Bows</p>
                                        <p class="item-price">Rp 399.000</p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 shop-item-wrapper">
                            <a href="shop/item">
                                <div class="shop-item">
                                    <div class="item-pic-frame">
                                        <img class="item-pic" src="{{ asset('img/shop-item.gif') }}" alt="Bows by Lusy Wahyudi" title="Bows by Lusy Wahyudi">
                                    </div>

                                    <div class="item-details">
                                        <p class="item-description" href="#">Bows</p>
                                        <p class="item-price">Rp 399.000</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 shop-item-wrapper">
                            <a href="shop/item">
                                <div class="shop-item">
                                    <div class="item-pic-frame">
                                        <img class="item-pic" src="{{ asset('img/shop-item.gif') }}" alt="Bows by Lusy Wahyudi" title="Bows by Lusy Wahyudi">
                                    </div>

                                    <div class="item-details">
                                        <p class="item-description" href="#">Bows</p>
                                        <p class="item-price">Rp 399.000</p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 shop-item-wrapper">
                            <a href="shop/item">
                                <div class="shop-item">
                                    <div class="item-pic-frame">
                                        <img class="item-pic" src="{{ asset('img/shop-item.gif') }}" alt="Bows by Lusy Wahyudi" title="Bows by Lusy Wahyudi">
                                    </div>

                                    <div class="item-details">
                                        <p class="item-description" href="#">Bows</p>
                                        <p class="item-price">Rp 399.000</p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 shop-item-wrapper">
                            <a href="shop/item">
                                <div class="shop-item">
                                    <div class="item-pic-frame">
                                        <img class="item-pic" src="{{ asset('img/shop-item.gif') }}" alt="Bows by Lusy Wahyudi" title="Bows by Lusy Wahyudi">
                                    </div>

                                    <div class="item-details">
                                        <p class="item-description" href="#">Bows</p>
                                        <p class="item-price">Rp 399.000</p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 shop-item-wrapper">
                            <a href="shop/item">
                                <div class="shop-item">
                                    <div class="item-pic-frame">
                                        <img class="item-pic" src="{{ asset('img/shop-item.gif') }}" alt="Bows by Lusy Wahyudi" title="Bows by Lusy Wahyudi">
                                    </div>

                                    <div class="item-details">
                                        <p class="item-description" href="#">Bows</p>
                                        <p class="item-price">Rp 399.000</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="padding-40"></div>

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
            <!-- End of Shop Items - /-->

        </main>

        <!-- Footer Section -->
        @include('partials.footer')
        <!-- Footer Section /- -->
        
    </div>
</body>

@endsection