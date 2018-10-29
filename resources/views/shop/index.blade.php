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