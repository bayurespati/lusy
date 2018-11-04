@extends('layouts.master')

@push('title')
<title>Lusy Wahyudi - Event</title>
@endpush

@push('additional_css')
<style type="text/css">
    .event-image {
        position: relative;
    }

    .tag{
        top: 20px;
        text-transform: uppercase;
        position: absolute;
        padding: 10px 20px 10px 20px;
        background: crimson;
        color: white;
        font-weight: bold;
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
            <div class="page-banner">
                <!-- Container -->
                <div class="container">
                    <h3 class="text-uppercase">{{ $event->kategori }}</h3>
                </div>
                <!-- Container /- -->
            </div>
            <!-- Page Banner /- -->

            <div class="section-padding"></div>
            
            <div class="container-fluid no-padding events-single">
                <!-- Container -->
                <div class="container">
                    <div class="row">
                        <!-- Content Area -->
                        <div class="col-md-12 content-area">
                            <!-- Event Block -->
                            <div class="col-md-12 col-sm-12 col-xs-12 no-padding event-block">
                                <div class="col-md-12 col-sm-12 col-xs-12 no-padding event-cover">
                                    <img src="{{ $event->poster }}" alt="{{ $event->title }}" />
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12 event-content">
                                    <div class="post-date"><span>{{ $event->dayDate }}</span><span>{{ $event->month }}</span></div>
                                    <h3>{{ $event->title }}</h3>
                                    <h4><a title="{{ $event->location }}"><i class="fa fa-map-marker"></i>{{ $event->location }}</a> <a><i class="fa fa-clock-o"></i>{{ $event->day }}: {{ $event->startHour }} - {{ $event->endHour }}</a></h4>
                                    <p>
                                        {!! nl2br(e($event->content)) !!}
                                    </p>
                                </div>
                            </div><!-- Event Block /- -->
                        </div><!-- Content Area /- -->
                        
                    </div>
                </div><!-- Container /- -->
            </div>
            <div class="section-padding"></div>

        </main>

        <!-- Footer Section -->
        @include('partials.footer')
        <!-- Footer Section /- -->
        
    </div>
</body>

@endsection

@push('additional_js')
@endpush