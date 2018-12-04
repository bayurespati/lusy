<header id="header" class="header-section container-fluid no-padding">
            <!-- Container -->
            <div class="container">     
                <!-- nav -->
                <nav class="navbar navbar-default ow-navigation" style="box-shadow: none;">
                    <div class="navbar-header">
                        <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a href="{{ route('home') }}" class="navbar-brand" style="margin: 0;"><img src="{{ asset('img/logo.png') }}" alt="Logo"/></a>
                    </div>

                    <!-- Menu Icon -->
                    @if(
                        request()->is('gallery') || 
                        request()->is('event') ||
                        request()->is('shop')
                    )
                    <div class="menu-icon">
                        <div class="search">    
                            <a id="search" title="Search" style="cursor: pointer;">
                                <i class="icon icon-Search transitioned-btn"></i>
                            </a>
                        </div>
                    </div>
                    @endif
                    <!-- Menu Icon /- -->

                    <div class="navbar-collapse collapse navbar-right" id="navbar">
                        <ul class="nav navbar-nav">
                            <li class="{{ request()->is('/') ? 'active' : '' }}"><a href="{{ route('home') }}" title="Home">Home</a></li>
                            <li class="{{ request()->is('about') || request()->is('about/*') ? 'active' : '' }}"><a href="{{ route('about.index') }}" title="About">About</a></li>
                            <li class="{{ request()->is('gallery') || request()->is('gallery/*') ? 'active' : '' }}"><a href="{{ route('gallery.index') }}" title="Gallery">Gallery</a></li>
                            <li class="{{ request()->is('event') || request()->is('event/*') ? 'active' : '' }}"><a href="{{ route('event.index') }}" title="Events & Activities">Events & Activities</a></li>
                            <li class="{{ request()->is('shop') || request()->is('shop/*') ? 'active' : '' }}"><a href="{{route('shop.index')}}" title="Shop">Shop</a></li>
                            <li class="{{ request()->is('contact') || request()->is('contact/*') ? 'active' : '' }}"><a href="{{route('contact.index')}}" title="Contact">Contact</a></li>
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </nav>
                <!-- nav /- -->
                
                <!-- Search Box -->
                @if(
                    request()->is('gallery') || 
                    request()->is('event') ||
                    request()->is('shop')
                )
                <div class="search-box">
                    <span><i class="icon_close"></i></span>
                    <form onsubmit="return false">
                        <input autofocus type="text" class="form-control" id="search-key"
                        placeholder="Enter a keyword and press enter..." />

                        <button hidden type="submit" onclick="searchFunction()"></button>
                    </form>
                </div>
                <!-- Search Box /- -->
                @endif
            </div>
            <!-- Container /- -->     
        </header>