<header id="header" class="header-section container-fluid no-padding">
            <!-- Top Header -->
            <!-- <div class="top-header container-fluid no-padding"> -->
                <!-- <div class="col-md-7 col-sm-12 col-xs-12 top-content"> -->
                    <!-- <div class="top-icons"> -->
                        <!-- <ul> -->
                            <!-- @if ($sosmed[2]->is_active === 1) -->
                            <!-- <li><a href="{{ $sosmed[2]->link }}" title="Instagram"><i class="fa fa-instagram"></i></a></li> -->
                            <!-- @endif -->
                            
                            <!-- @if ($sosmed[4]->is_active === 1) -->
                            <!-- <li><a href="{{ $sosmed[4]->link }}" title="Flickr"><i class="fa fa-flickr"></i></a></li> -->
                            <!-- @endif -->

                            <!-- @if ($sosmed[3]->is_active === 1) -->
                            <!-- <li><a href="{{ $sosmed[3]->link }}" title="Pinterest"><i class="fa fa-pinterest"></i></a></li> -->
                            <!-- @endif -->

                            <!-- @if ($sosmed[1]->is_active === 1) -->
                            <!-- <li><a href="{{ $sosmed[1]->link }}" title="Facebook"><i class="fa fa-facebook"></i></a></li> -->
                            <!-- @endif -->

                            <!-- @if ($sosmed[0]->is_active === 1) -->
                            <!-- <li><a href="{{ $sosmed[0]->link }}" title="Twitter"><i class="fa fa-twitter"></i></a></li> -->
                            <!-- @endif -->
                        <!-- </ul> -->
                    <!-- </div> -->
                <!-- </div> -->
            <!-- </div> -->
            <!-- Top Header /- -->
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
                        <a href="index.html" class="navbar-brand" style="margin: 0;"><img src="{{ asset('img/logo.png') }}" alt="Logo" style="width: 90px" /></a>
                    </div>
                    <div class="navbar-collapse collapse navbar-right" id="navbar">
                        <ul class="nav navbar-nav">
                            <li class="{{ request()->is('/') ? 'active' : '' }}"><a href="{{ route('home') }}" title="Home">Home</a></li>
                            <li class="{{ request()->is('about') || request()->is('about/*') ? 'active' : '' }}"><a href="{{ route('about.index') }}" title="About">About</a></li>
                            <li class="{{ request()->is('gallery') || request()->is('gallery/*') ? 'active' : '' }}"><a href="{{ route('gallery.index') }}" title="Gallery">Gallery</a></li>
                            <li class="{{ request()->is('event') || request()->is('event/*') ? 'active' : '' }}"><a href="{{ route('event.index') }}" title="Events & Activities">Events & Activities</a></li>
                            <li class="{{ request()->is('shop') || request()->is('shop/*') ? 'active' : '' }}"><a href="{{route('shop.index')}}" title="Shop">Shop</a></li>
                            <li class="{{ request()->is('contact') || request()->is('contact/*') ? 'active' : '' }}"><a href="{{route('contact.index')}}" title="Contact">Contact</a></li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </nav><!-- nav /- -->
            </div><!-- Container /- -->     
        </header>