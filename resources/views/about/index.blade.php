@extends('layouts.master')

@push('title')
<title>Lusy Wahyudi - About</title>
@endpush

@push('additional_css')
<style>
    .onview-section::before {
        background-color: unset;
    }
</style>
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
                    <h3>about</h3>
                </div>
                <!-- Container /- -->
            </div>
            <!-- Page Banner /- -->

            <!-- About Us Section -->
            <div id="welcome-section" class="container-fluid no-padding welcome-section2">
                <!-- Container -->
                <div class="container">
                    <!-- Row -->
                    <div class="row">           
                        <div class="col-md-6 col-sm-6 img-block">
                            <i><img src="{{ $about[0]->image_path }}" alt="{{ $about[0]->title }}" /></i>
                        </div>
                        <div class="col-md-6 col-sm-6 content-block">
                            <!-- Section Header -->
                            <div class="section-header2">
                                <i><img src="{{ asset('img/section-header2-1.png') }}" alt="Section Header" /></i>
                                <h2>{{ $about[0]->title }}</h2>
                            </div>
                            <!-- Section Header /- -->
                            <p>
                                {!! nl2br(e($about[0]->content)) !!}
                            </p>
                        </div>
                    </div>
                    <!-- Row /- -->
                </div>
                <!-- Container /- -->
            </div>
            <!-- About Us Section /- -->
            
            <!-- Portfolio Section -->
            <div class="container-fluid no-padding onview-section" style="background-color: unset;">
                <img src="{{ asset('img/portofolio-temp.png') }}" alt="" style="width: 100%">
            </div>
            <!-- Portfolio Section /- -->
            

            <!-- Gallery Showcase Section -->
            @if(count($showedImage) > 0) 
            <div class="container-fluid no-padding portfolio-section">
                <!-- Container -->
                <div class="container">
                    <div class="row">
                        <div class="col-md-5">
                            <!-- Section Header -->
                            <div class="section-header">
                                <div class="section-title-border">
                                    <span>Its Our Great Flows</span>
                                    <h2>our gallery</h2>
                                </div>
                            </div><!-- Section Header /- -->
                        </div>
                    </div>
                    
                </div><!-- Container /- -->
                <div class="portfolio-list">
                    @foreach($showedImage as $image)
                        <div class="portfolio-box col-md-3 col-sm-3 no-padding vintage">
                            <a href="{{ $image->image_path }}">

                                <img src="{{ $image->image_path }}" alt="{{ $image->title }}" />

                                <div class="portfolio-content">
                                    <i class="icon icon-Search"></i>
                                    <h3>{{ $image->title }}</h3>
                                    <span>{{ $image->creator }}</span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
            <!-- Gallery Showcase Section /- -->

              <!-- Shop Showcase Section -->
            <div class="container-fluid no-padding welcome-section">
                <!-- Container -->
                <div class="container">
                   
                    <!-- Row -->
                    <div class="row">
                        <div id="welcome-carousel" class="carousel slide" data-ride="carousel">
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="listbox">
                                @for ($i = 0; $i < count($classes); $i++)
                                <div class="item {{ $i === 0 ? 'active' : '' }}">

                                     <!-- Section Header -->
                                    <div class="section-header">
                                        <div class="section-title-border">
                                            <span>Introducing</span>
                                            <h2>{{ $classes[$i]->title }}</h2> 
                                        </div>
                                    </div>
                                    <!-- Section Header /- -->
                                    <div class="col-md-6 col-sm-6 content-block-custom">
                                        <p>
                                            {!! $classes[$i]->content !!}
                                        </p>
                                        
                                        <button class="general-btn transitioned-btn">
                                            Register
                                        </button>
                                    </div>
                                    <div class="col-md-6 col-sm-6 img-block">
                                        <i><img src="{{ $classes[$i]->image_path }}" alt="{{ $classes[$i]->title }}" /></i>
                                    </div>
                                </div>
                                @endfor
                                
                            </div>
                            <!-- Controls -->
                            <div class="wc-controls wc-controls-custom">
                                <a class="left carousel-control" href="#welcome-carousel" role="button" data-slide="prev">
                                    <span></span>
                                </a>
                                <a class="right carousel-control" href="#welcome-carousel" role="button" data-slide="next">
                                    <span></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Row /- -->
                </div>
                <!-- Container /- -->
            </div>
            <!-- Shop Showcase Section /- -->

        </main>

        <!-- Footer Section -->
        @include('partials.footer')
        <!-- Footer Section /- -->
        
    </div>
</body>

@endsection