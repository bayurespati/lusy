@extends('layouts.master')

@push('title')
<title>Lusy Wahyudi - Shop</title>
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

            <!-- Item Section -->
            <div class="container-fluid no-padding welcome-section2">
                <!-- Container -->
                <div class="container">
                    <!-- Row -->
                    <div class="row">           
                         <div class="item">
                            <div class="col-md-6 col-sm-6">
                                <div class="img-block">
                                    <i><img src="{{ $shopItem->poster }}" alt="{{ $shopItem->title }}" /></i>
                                </div>

                                <!-- <div class="portfolio-section" style="padding-top: 8px"> -->
                                    <!-- <div class="portfolio-list"> -->
                                        <!-- <div class="portfolio-box col-md-3 col-sm-3 no-padding vintage"> -->
                                            <!-- <a href="{{ asset('img/portfolio-2.jpg') }}"> -->
                                                <!-- <img src="{{ asset('img/portfolio-2.jpg') }}" alt="Portfolio" /> -->
                                                <!-- <div class="portfolio-content"> -->
                                                    <!-- <span>Title</span> -->
                                                <!-- </div> -->
                                            <!-- </a> -->
                                        <!-- </div> -->
                                        <!-- <div class="portfolio-box col-md-3 col-sm-3 no-padding vintage"> -->
                                            <!-- <a href="{{ asset('img/portfolio-2.jpg') }}"> -->
                                                <!-- <img src="{{ asset('img/portfolio-2.jpg') }}" alt="Portfolio" /> -->
                                                <!-- <div class="portfolio-content"> -->
                                                    <!-- <span>Title</span> -->
                                                <!-- </div> -->
                                            <!-- </a> -->
                                        <!-- </div> -->
                                        <!-- <div class="portfolio-box col-md-3 col-sm-3 no-padding vintage"> -->
                                            <!-- <a href="{{ asset('img/portfolio-2.jpg') }}"> -->
                                                <!-- <img src="{{ asset('img/portfolio-2.jpg') }}" alt="Portfolio" /> -->
                                                <!-- <div class="portfolio-content"> -->
                                                    <!-- <span>Title</span> -->
                                                <!-- </div> -->
                                            <!-- </a> -->
                                        <!-- </div> -->
                                        <!-- <div class="portfolio-box col-md-3 col-sm-3 no-padding vintage"> -->
                                            <!-- <a href="{{ asset('img/portfolio-2.jpg') }}"> -->
                                                <!-- <img src="{{ asset('img/portfolio-2.jpg') }}" alt="Portfolio" /> -->
                                                <!-- <div class="portfolio-content"> -->
                                                    <!-- <span>Title</span> -->
                                                <!-- </div> -->
                                            <!-- </a> -->
                                        <!-- </div> -->
                                    <!-- </div> -->

                                    <!-- <div class="padding-20"></div> -->

                                    <!-- <nav class="ow-pagination text-center"> -->
                                        <!-- <ul class="pagination"> -->
                                            <!-- <li><a href="#"><i class="fa fa-angle-double-left"></i></a></li> -->
                                            <!-- <li><a href="#">1</a></li> -->
                                            <!-- <li><a href="#">2</a></li> -->
                                            <!-- <li><a href="#">3</a></li> -->
                                            <!-- <li><a href="#"><i class="fa fa-angle-double-right"></i></a></li> -->
                                        <!-- </ul> -->
                                    <!-- </nav> -->
                                <!-- </div> -->
                            </div>

                            <div class="col-md-6 col-sm-6 content-block-custom">
                                 <!-- Section Header -->
                                 <div class="section-header">
                                    <div class="section-title-border">
                                        <span>{{ $shopItem->sub_title }}</span>
                                        <h2>{{ $shopItem->title }}</h2> 
                                    </div>
                                </div>
                                <!-- Section Header /- -->
                                <span class="item-price-detail">IDR {{ $shopItem->price }}</span>

                                <p>
                                    {!! nl2br(e($shopItem->description)) !!}
                                </p>

                                <div>
                                    <button 
                                            class="general-btn transitioned-btn" 
                                            type="button" 
                                            data-toggle="modal"
                                            data-target="#overseas">Overseas Inquiry</button>
                                    <button class="general-btn transitioned-btn ml-2">Buy Now</button>
                                </div>
                            </div>
                        </div>
                    </div><!-- Row /- -->
                </div><!-- Container /- -->
            </div>
            <!-- Item Section /- -->

        </main>

        <!-- Footer Section -->
        @include('partials.footer')
        <!-- Footer Section /- -->

        <!-- Modal -->
    <div class="modal fade" 
         id="overseas" 
         tabindex="-1" 
         role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Overseas Iquiry</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="/event/update/overseas/{{$shopItem->id}}" method="post" enctype="multipart/form-data">
                    @csrf
                  <div class="form-group form-control-sm">
                    <!-- <label for="buyer_name">Name</label> -->
                    <input type="text" class="form-control" 
                           name="buyer_name" id="buyer_name" placeholder="Name" minlength="2" required>
                  </div>
                  <div class="form-group form-control-sm">
                    <!-- <label for="gender">Gender</label> -->
                    <select class="form-control" name="gender" id="gender" required>
                        <option value="1">Man</option>
                        <option value="0">Women</option>
                    </select>
                  </div>
                  <div class="form-group form-control-sm">
                    <!-- <label for="address">Address</label> -->
                    <input type="text" class="form-control" 
                           name="address" id="address" placeholder="Address" minlength="10" required>
                  </div>
                  <div class="form-group form-control-sm">
                      <!-- <label for="email">Email</label> -->
                      <input type="email" class="form-control" 
                             name="email" id="email" placeholder="Email" required>
                  </div>
                  <div class="form-group form-control-sm">
                      <!-- <label for="city">City</label> -->
                      <input type="text" class="form-control" 
                             name="city" id="city" placeholder="City" minlength="2" required>
                  </div>
                  <div class="form-group form-control-sm">
                      <!-- <label for="state_province">State province</label> -->
                      <input type="text" class="form-control" 
                             name="state_province" id="state_province" 
                             placeholder="State Province" minlength="2" required>
                  </div>
                  <div class="form-group form-control-sm">
                      <!-- <label for="postal_code">Postal Code</label> -->
                      <input type="number" class="form-control" 
                             name="postal_code" id="postal_code" placeholder="Postal code" required>
                  </div>
                  <div class="form-group form-control-sm">
                      <!-- <label for="note">Notes</label> -->
                      <textarea class="form-control" 
                                name="notes" id="notes" placeholder="notes"></textarea>
                  </div>
                  <div class="form-group form-control-sm">
                      <!-- <label for="stock">Quantity</label> -->
                      <input type="number" class="form-control" 
                             name="quantity" id="quantity" placeholder="quantity" required>
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="submit" class="btn btn-warning" data-dismiss="modal">close</button>
                </form>
              </div>
            </div>
        </div>
    </div>
        
    </div>
</body>

@endsection