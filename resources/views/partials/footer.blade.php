<footer class="footer-main container-fluid no-padding">
    <!-- Container -->
    <div class="container">
        <!-- <div class="row"> -->
            <!-- <div class="col-xs-12"> -->
                <!-- <a title="Logo" href="{{ route('home') }}" class="navbar-brand"> -->
                    <!-- <img src="{{ asset('img/logo-1.png') }}" alt="Lusy Wahyudi" style="width: 90px" /> -->
                <!-- </a> -->
            <!-- </div> -->
        <!-- </div> -->

        <div class="row">
            <div class="col-xs-offset-3 col-md-6 text-center">
                <blockquote class="senno">
                    Not only beautiful flowers but also buds and withered flowers have life, and each has its own beauty. By arranging flowers with reverence, one refines oneself.
                    <footer>Senno Ikenobo</footer>
                </blockquote>

                <div class="ftr-widget widget_about mt-4 mb-6">
                    <ul>
                        @if ($sosmed[2]->is_active === 1)
                        <li><a href="{{ $sosmed[2]->link }}" title="Instagram"><i class="fa fa-instagram"></i></a></li>
                        @endif
                            
                        @if ($sosmed[4]->is_active === 1)
                        <li><a href="{{ $sosmed[4]->link }}" title="Flickr"><i class="fa fa-flickr"></i></a></li>
                        @endif

                        @if ($sosmed[3]->is_active === 1)
                        <li><a href="{{ $sosmed[3]->link }}" title="Pinterest"><i class="fa fa-pinterest"></i></a></li>
                        @endif

                        @if ($sosmed[1]->is_active === 1)
                        <li><a href="{{ $sosmed[1]->link }}" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                        @endif

                        @if ($sosmed[0]->is_active === 1)
                        <li><a href="{{ $sosmed[0]->link }}" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <!-- Container /- -->

        <!-- Copyright -->
        <div class="container-fluid no-padding copyright">
            <p>copyrights <i class="fa fa-copyright"></i> 2016. all rights reserved</p>
        </div>
        <!-- Copyright /- -->
</footer>