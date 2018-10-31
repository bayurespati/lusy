@extends('layouts.master')

@push('title')
<title>Lusy Wahyudi - Event</title>
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
            <div class="page-banner">
                <!-- Container -->
                <div class="container">
                    <h3>Events & Activities</h3>
                </div>
                <!-- Container /- -->
            </div>
            <!-- Page Banner /- -->
            
            <div class="section-padding"></div>
            
            <div class="container-fluid no-padding events-listing">
                <!-- Container -->
                <div class="container">
                    <div class="row">
                        <!-- Content Area -->
                        <div class="col-md-9 col-sm-7 col-xs-7 content-area">
                            <!-- Event Block -->
                            <div class="col-md-12 col-sm-12 col-xs-12 no-padding event-block">
                                <div class="col-md-6 col-sm-12 col-xs-12 event-cover">
                                    <a href="event-single.php"><img src="{{ asset('img/events1.jpg') }}" alt="Events" /></a>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12 event-content">
                                    <div class="post-date">
                                        <span>26</span>
                                        <span>may</span>
                                    </div>
                                    <h3><a href="event-single.php" title="British Museum">British Museum</a></h3>
                                    <h4><a href="#" title="London"><i class="fa fa-map-marker"></i>London</a> <a href="#"><i class="fa fa-clock-o"></i>MON: 10AM - 6PM</a></h4>
                                    <p>Then one day he was shooting at some food and up through the ground came a bubbling crude oil that is so lets make the most of this beautiful day the ground one day he was shooting at some food and up through the crude oil of this beautiful day.</p>
                                    <a href="event-single.php" title="Book Now">Book Now</a>
                                </div>
                            </div>
                            <!-- Event Block /- -->
                            
                            <!-- Event Block -->
                            <div class="col-md-12 col-sm-12 col-xs-12 no-padding event-block">
                                <div class="col-md-6 col-sm-12 col-xs-12 event-cover">
                                    <a href="event-single.php"><img src="{{ asset('img/events2.jpg') }}" alt="Events" /></a>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12 event-content">
                                    <div class="post-date">
                                        <span>30</span>
                                        <span>may</span>
                                    </div>
                                    <h3><a href="event-single.php" title="Guissum Museum">Guissum Museum</a></h3>
                                    <h4><a href="#" title="London"><i class="fa fa-map-marker"></i>Spain</a> <a href="#"><i class="fa fa-clock-o"></i>SAT: 8AM - 6PM</a></h4>
                                    <p>Then one day he was shooting at some food and up through the ground came a bubbling crude oil that is so lets make the most of this beautiful day the ground one day he was shooting at some food and up through the crude oil of this beautiful day.</p>
                                    <a href="event-single.php" title="Book Now">Book Now</a>
                                </div>
                            </div>
                            <!-- Event Block /- -->
                            
                            <!-- Event Block -->
                            <div class="col-md-12 col-sm-12 col-xs-12 no-padding event-block">
                                <div class="col-md-6 col-sm-12 col-xs-12 event-cover">
                                    <a href="event-single.php"><img src="{{ asset('img/events3.jpg') }}" alt="Events" /></a>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12 event-content">
                                    <div class="post-date">
                                        <span>02</span>
                                        <span>Jun</span>
                                    </div>
                                    <h3><a href="event-single.php" title="Universal Museum">Universal Museum</a></h3>
                                    <h4><a href="event-single.php" title="London"><i class="fa fa-map-marker"></i>Italy</a> <a href="#"><i class="fa fa-clock-o"></i>SUN: 10AM - 6PM</a></h4>
                                    <p>Then one day he was shooting at some food and up through the ground came a bubbling crude oil that is so lets make the most of this beautiful day the ground one day he was shooting at some food and up through the crude oil of this beautiful day.</p>
                                    <a href="event-single.php" title="Book Now">Book Now</a>
                                </div>
                            </div>
                            <!-- Event Block /- -->
                            
                            <!-- Event Block -->
                            <div class="col-md-12 col-sm-12 col-xs-12 no-padding event-block">
                                <div class="col-md-6 col-sm-12 col-xs-12 event-cover">
                                    <a href="event-single.php"><img src="{{ asset('img/events4.jpg') }}" alt="Events" /></a>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12 event-content">
                                    <div class="post-date">
                                        <span>13</span>
                                        <span>Jul</span>
                                    </div>
                                    <h3><a href="event-single.php" title="Heaven Museum">Heaven Museum</a></h3>
                                    <h4><a href="#" title="Paris"><i class="fa fa-map-marker"></i>Paris</a> <a href="#"><i class="fa fa-clock-o"></i>MON: 10AM - 6PM</a></h4>
                                    <p>Then one day he was shooting at some food and up through the ground came a bubbling crude oil that is so lets make the most of this beautiful day the ground one day he was shooting at some food and up through the crude oil of this beautiful day.</p>
                                    <a href="event-single.php" title="Book Now">Book Now</a>
                                </div>
                            </div>
                            <!-- Event Block /- -->
                            
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
                        <!-- Content Area /- -->
                        
                        <!-- Widget Area -->
                        <div class="col-md-3 col-sm-5 col-xs-5 widget-area">
                            <!-- Widget : Search -->
                            <aside class="widget widget_search">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search  . . .">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                                    </span>
                                </div>
                            </aside>
                            <!-- Widget : Search /- -->
                            <!-- Widget : Categories -->
                            <aside class="widget widget_categories">
                                <h3 class="widget-title">categories</h3>
                                <ul>
                                    <li><a href="#" title="Museum"><span>09</span>Museum</a></li>
                                    <li><a href="#" title="Ancient Age Gallery"><span>10</span>Ancient Age Gallery</a></li>
                                    <li><a href="#" title="Martial Arts Snaps"><span>07</span>Martial Arts Snaps</a></li>
                                    <li><a href="#" title="Stone Age Stuffs"><span>11</span>Stone Age Stuffs</a></li>
                                    <li><a href="#" title="Art Portfolio"><span>13</span>Art Portfolio</a></li>
                                    <li><a href="#" title="History of Statues"><span>07</span>History of Statues</a></li>
                                </ul>
                            </aside>
                            <!-- Widget : Categories /- -->
                            <!-- Widget : Latest Post -->
                            <aside class="widget widget_latestpost">
                                <h3 class="widget-title">latest posts</h3>
                                <div class="latestpost-content">
                                    <a href="#" title="Post Cover"><img src="{{ asset('img/latest-post1.jpg') }}" alt="Post"></a>
                                    <h3><a href="#" title="goodness lemur save much alas crud dear">goodness lemur save much alas crud dear</a></h3>
                                    <span>09 jul 2015</span>
                                </div>
                                <div class="latestpost-content">
                                    <a href="#" title="Post Cover"><img src="{{ asset('img/latest-post2.jpg') }}" alt="Post"></a>
                                    <h3><a href="#" title="However much enormous merrily jeez">However much enormous merrily jeez</a></h3>
                                    <span>09 jul 2015</span>
                                </div>
                                <div class="latestpost-content">
                                    <a href="#" title="Post Cover"><img src="{{ asset('img/latest-post3.jpg') }}" alt="Post"></a>
                                    <h3><a href="#" title="Flinched more mammoth this pompously">Flinched more mammoth this pompously</a></h3>
                                    <span>09 jul 2015</span>
                                </div>
                            </aside>
                            <!-- Widget : Latest Post /- -->
                            <!-- Widget : Tags -->
                            <aside class="widget widget_tag">
                                <h3 class="widget-title">Populer tags</h3>
                                <div class="tags">
                                    <a href="#" title="Amazing">Amazing</a>
                                    <a href="#" title="Statues">Statues</a>
                                    <a href="#" title="Themes">Themes</a>
                                    <a href="#" title="Clean">Clean</a>
                                    <a href="#" title="Responsiveness">Responsiveness</a>
                                    <a href="#" title="art">art</a>
                                    <a href="#" title="modern">modern</a>
                                    <a href="#" title="ios">ios</a>
                                    <a href="#" title="flat">flat</a>
                                    <a href="#" title="Design">Design</a>
                                </div>
                            </aside>
                            <!-- Widget : Tags /- -->
                        </div>
                        <!-- Widget Area /- -->
                    </div>
                </div>
                <!-- Container /- -->
            </div>
            <div class="section-padding"></div>

        </main>

        <!-- Footer Section -->
        @include('partials.footer')
        <!-- Footer Section /- -->
        
    </div>
</body>

@endsection