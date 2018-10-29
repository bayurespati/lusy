<header id="header" class="header-section container-fluid no-padding">
            <!-- Top Header -->
            <div class="top-header container-fluid no-padding">
                <div class="col-md-7 col-sm-12 col-xs-12 top-content">
                    <div class="top-icons">
                        <ul>
                            <li><a href="#" title="Instagram"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="#" title="Flickr"><i class="fa fa-flickr"></i></a></li>
                            <li><a href="#" title="Pinterest"><i class="fa fa-pinterest"></i></a></li>
                            <li><a href="#" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                        </ul>
                        <!-- <h5><span>OPENING HOURS:</span> MONDAY - SUNDAY: 10.00AM TO 8.00PM</h5> -->
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
                    <div class="navbar-collapse collapse navbar-right" id="navbar">
                        <ul class="nav navbar-nav">
                            <li class="{{ request()->is('/') ? 'active' : '' }}"><a href="{{ route('home') }}" title="Home">Home</a></li>
                            <li class="{{ request()->is('about') || request()->is('about/*') ? 'active' : '' }}"><a href="{{ route('about.index') }}" title="About">About</a></li>
                            <li class="{{ request()->is('gallery') || request()->is('gallery/*') ? 'active' : '' }}"><a href="{{ route('gallery.index') }}" title="Gallery">Gallery</a></li>
                            <li class="{{ request()->is('event') || request()->is('event/*') ? 'active' : '' }}"><a href="{{ route('event.index') }}" title="Events & Activities">Events & Activities</a></li>
                            <li class="{{ request()->is('shop') || request()->is('shop/*') ? 'active' : '' }}"><a href="{{route('shop.index')}}" title="Shop">Shop</a></li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </nav><!-- nav /- -->
            </div><!-- Container /- -->     
        </header>