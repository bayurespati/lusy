@extends('layouts.master')

@push('title')
<title>Lusy Wahyudi</title>
@endpush

@push('additional_css')
<style type="text/css">
    .cut-content {
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
    }

    .onview-section::before {
        background-color: unset;
    }

    .modal-body {
        max-width: 500px;
        margin: 0 auto;
    }

    .radio {
        display: inline-block !important;
    }

    .radio label {
        color: #999;
    }

    .modal-content {
        font-family: 'Poppins', sans-serif !important;
        border-radius: 0 !important;
    }

    .modal-body form {
        font-size: 18px;
    }

    .modal-body .form-control {
        height: 42px;
        font-size: 18px;
        border-radius: 0;
    }

    .modal-body textarea {
        height: auto !important;
    }

    ::-webkit-input-placeholder {
        text-align: center;
    }

    :-moz-placeholder { /* Firefox 18- */
        text-align: center;  
    }

    ::-moz-placeholder {  /* Firefox 19+ */
        text-align: center;  
    }

    :-ms-input-placeholder {  
        text-align: center; 
    }

    input {
        text-align: center;
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
        
            <!-- Slider Section -->
            <div id="home-revslider" class="slider-section container-fluid no-padding ">
                <!-- START REVOLUTION SLIDER 5.0 -->
                <div class="rev_slider_wrapper">
                    <div id="home-slider1" class="rev_slider" data-version="5.0">
                        <ul>
                            @if (count($imageSlider) > 0)
                                @for ($i = 0; $i < count($imageSlider); $i++)                        
                                <li data-transition="zoomout" data-slotamount="default"  data-easein="easeInOut" data-easeout="easeInOut" data-masterspeed="2000" data-rotate="0"  data-fstransition="fade" data-fsmasterspeed="1500" data-fsslotamount="7">
                                    <!-- MAIN IMAGE -->
                                    <img src="{{ $imageSlider[$i]->image_show }}" alt="slider" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10" class="rev-slidebg" data-no-retina>
                                </li>
                                @endfor
                            @else
                            <li data-transition="zoomout" data-slotamount="default"  data-easein="easeInOut" data-easeout="easeInOut" data-masterspeed="2000" data-rotate="0"  data-fstransition="fade" data-fsmasterspeed="1500" data-fsslotamount="7">
                                <!-- MAIN IMAGE -->
                                <img src="{{ asset('img/slider-1.jpg') }}" alt="slider" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10" class="rev-slidebg" data-no-retina>
                            </li>
                            @endif
                        </ul>
                    </div>
                    <!-- END REVOLUTION SLIDER -->
                </div>
                <!-- END OF SLIDER WRAPPER -->

            <!-- Slider Section /- -->

            <!-- About Us Section -->
            <div id="welcome-section" class="container-fluid no-padding welcome-section2" style="padding-top: 180px">
                <!-- Container -->
                <div class="container">
                    <!-- Row -->
                    <div class="row">           
                        <div class="col-md-6 col-sm-6 img-block">
                            <i><img src="{{ $introduction[0]->image_path }}" alt="{{ $introduction[0]->title }}" /></i>
                        </div>
                        <div class="col-md-6 col-sm-6 content-block">
                            <!-- Section Header -->
                            <div class="section-header2">
                                <i><img src="{{ asset('img/section-header2-1.png') }}" alt="Section Header" /></i>
                                <h2>{{ $introduction[0]->title }}</h2>
                            </div><!-- Section Header /- -->

                            <p>
                                {!! nl2br(e($introduction[0]->content)) !!}
                            </p>

                            <a href="{{ route('about.index') }}" title="Read More">Read More</a>
                        </div>
                    </div><!-- Row /- -->
                </div><!-- Container /- -->
            </div>
            <!-- About Us Section /- -->
            
            <!-- Portfolio Section -->
            <div class="container-fluid no-padding">
                <div class="row achievement-view">
                    @foreach($achievements as $achievement)
                    <div class="col-md-3 col-sm-6 col-xs-12 achievement-wrapper text-center">
                        <div class="achievement-border">
                            <div class="achievement-content">
                                <div class="icon">
                                    <span>
                                        <i class="{{ $achievement['logo'] }}"></i>
                                    </span>
                                </div>

                                <div class="value">
                                    <span>{{ $achievement['value'] }}</span>
                                </div>

                                <div class="title">
                                    <span>{{ $achievement['title'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <!-- Portfolio Section /- -->
            
            <!-- Upcoming Events Section -->
            @if(count($showcasedEvents) > 0)
            <div class="container-fluid no-padding upcoming-event" style="background-image: url({{ $eventBanner }})">
                <div class="section-padding"></div>
                <!-- Container -->
                <div class="container">
                    <!-- Section Header -->
                    <div class="section-header">
                        <div class="section-title-border">
                            <span>Proud to Presents</span>
                            <h2>OUR LATEST EVENTS</h2>
                        </div>
                    </div>
                    <!-- Section Header /- -->
                    <div class="col-md-8 col-sm-12 col-xs-12 no-padding">

                        @foreach($showcasedEvents as $event)
                        <div class="col-md-12 col-sm-12 col-xs-12 no-padding event-block">
                            <div class="col-md-12 col-sm-12 col-xs-12 event-content">
                                <div class="post-date">
                                    <span>{{ $event->dayDate }}</span>
                                    <span>{{ $event->month }}</span>
                                </div>
                                <h3><a href="/event/single/{{ $event->id }}" title="{{ $event->title }}">{{ $event->title }}</a></h3>
                                <h4><a href="/event/single/{{ $event->id }}" title="{{ $event->location }}"><i class="fa fa-map-marker"></i>{{ $event->location }}</a> <a href="/event/single/{{ $event->id }}"><i class="fa fa-clock-o"></i>{{ $event->day }}: {{ $event->startHour }} - {{ $event->endDay }}: {{ $event->endHour }}</a></h4>
                                <p class="cut-content">{{ $event->content }}</p>
                            </div>
                        </div>
                        @endforeach

                        <a href="{{ route('event.index') }}" title="View all events">VIEW ALL EVENTS</a>
                    </div>
                </div>
                <!-- Container /- -->
                
                <div class="section-padding"></div>
            </div>
            @endif
            <!-- Upcoming Events Section /- -->

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
                    @if($image->type == 1)
                    <div class="portfolio-box col-md-2 col-sm-2 no-padding vintage">
                    @endif
                    @if($image->type == 2)
                    <div class="portfolio-box col-md-3 col-sm-3 no-padding vintage">
                    @endif
                    @if($image->type == 3)
                    <div class="portfolio-box col-md-6 col-sm-6 no-padding vintage">
                    @endif
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
            @if(count($shopItems) > 0)
            <div class="container-fluid no-padding welcome-section custom-welcome">
                <!-- Container -->
                <div class="container">
                   
                    <!-- Row -->
                    <div class="row">
                        <div id="welcome-carousel" class="carousel slide" data-ride="carousel">
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="listbox">
                                @for ($i = 0; $i < count($shopItems); $i++)
                                <div class="item {{ $i === 0 ? 'active' : '' }}">
                                    <div class="section-header section-header-custom">
                                            <div class="section-title-border">
                                                <span>{{ $shopItems[$i]->sub_title }}</span>
                                                <h2>{{ $shopItems[$i]->title }}</h2> 
                                            </div>
                                        </div>

                                    <div class="col-md-6 col-sm-6">
                                        <div class="img-block">
                                            <i><img src="{{ $shopItems[$i]->poster }}" alt="{{ $shopItems[$i]->title }}" /></i>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 col-sm-6 content-block-custom">
                                        <span class="item-price-detail">
                                            IDR {{ $shopItems[$i]->price }}
                                        </span>

                                        <p>
                                            {!! (($shopItems[$i]->description)) !!}
                                        </p>

                                        <p class="m-0">
                                            Stock: {{ $shopItems[$i]->stock }}
                                        </p>

                                        <div>
                                            <button class="general-btn transitioned-btn" 
                                            type="button" data-toggle="modal"data-target="#overseas" onClick="setActionValue({{ $shopItems[$i]->id }}, '{{ $shopItems[$i]->title }}')">
                                                Overseas Inquiry
                                            </button>

                                            <a href="{{ $shopItems[$i]->store_link }}">
                                                <button class="general-btn transitioned-btn ml-2">
                                                    Buy Now
                                                </button>
                                            </a>
                                        </div>

                                        <div class="wc-controls" style="right: 0; left: unset;">
                                            <a class="left carousel-control" href="#welcome-carousel" role="button" data-slide="prev">
                                                <span></span>
                                            </a>

                                            <a class="right carousel-control" href="#welcome-carousel" role="button" data-slide="next">
                                                <span></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @endfor
                            </div>
                            <!-- Controls -->
                        </div>
                    </div>
                    <!-- Row /- -->
                </div>
                <!-- Container /- -->
            </div>
            @endif
            <!-- Shop Showcase Section /- -->
            
        </main>

        <!-- Footer Section -->
        @include('partials.footer')
        <!-- Footer Section /- -->

        <!-- Modal -->
        <div class="modal fade" id="overseas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center p-0" style="border: none">
                        <button type="button" class="close transitioned-btn" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="modal-body-header text-center pr-6 pl-6 mb-5">
                            <p id="modal-opening" class="m-0" style="font-size: 20px">
                                Please fill in the form below and we will be back to you as soon as possible.
                            </p>
                        </div>

                        <form id="action-modal" action="" method="post" enctype="multipart/form-data">

                            @csrf
                            <div class="form-group form-control-sm text-center">
                                <!-- <label for="gender">Gender</label> -->
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="gender" value="1" checked>
                                        Male
                                    </label>
                                </div>
                                <div class="radio ml-4">
                                    <label>
                                        <input type="radio" value="0" name="gender">
                                        Female
                                    </label>
                                </div>
                            </div>

                            <div class="form-group form-control-sm">
                                <!-- <label for="buyer_name">Name</label> -->
                                <input type="text" class="form-control" 
                                name="buyer_name" id="buyer_name" placeholder="Full Name*" minlength="2" required>
                            </div>

                            <div class="form-group form-control-sm">
                                <!-- <label for="address">Address</label> -->
                                <input type="text" class="form-control" 
                                name="address" id="address" placeholder="Address*" minlength="10" required>
                            </div>

                            <div class="form-group form-control-sm">
                                <!-- <label for="email">Email</label> -->
                                <input type="email" class="form-control" 
                                name="email" id="email" placeholder="Email*" required>
                            </div>

                            <div class="form-group form-control-sm">
                                <!-- <label for="city">City</label> -->
                                <input type="text" class="form-control" 
                                name="city" id="city" placeholder="City*" minlength="2" required>
                            </div>

                            <div class="form-group form-control-sm">
                                <!-- <label for="state_province">State province</label> -->
                                <input type="text" class="form-control" 
                                name="state_province" id="state_province" 
                                placeholder="State/Province*" minlength="2" required>
                            </div>

                            <div class="form-group form-control-sm">
                                <!-- <label for="postal_code">Postal Code</label> -->
                                <input type="number" class="form-control" 
                                name="postal_code" id="postal_code" placeholder="Postal Code*" required>
                            </div>

                            <div class="form-group form-control-sm">
                                <!-- <label for="note">Notes</label> -->
                                <textarea class="form-control" rows="6"
                                name="notes" id="notes" placeholder="Your Notes">
                                </textarea>
                            </div>

                            <div class="form-group form-control-sm">
                                <!-- <label for="stock">Quantity</label> -->
                                <input type="number" class="form-control" 
                                name="quantity" id="quantity" placeholder="Quantity*" required>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="general-btn transitioned-btn mb-3" style="width: 100%">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

@endsection

@push('additional_js')
<script type="text/javascript">
    let itemId = 0;

    function setActionValue(newItemId, title) {
        itemId = newItemId;

        document.getElementById('action-modal').action = '/shop/update/overseas/' + itemId;
        document.getElementById('modal-opening').innerHTML = 'Please fill in the form below to make an inquiry for <strong>' + title + '</strong> and we will be back to you as soon as possible.'
    }
</script>
@endpush