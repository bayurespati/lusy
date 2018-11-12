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
            <div class="container-fluid no-padding page-banner" 
            style="background-image: url({{ $aboutBanner  }})">
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

            <!-- Classes Showcase Section -->
            @if(count($classes) > 0)
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
                                        
                                        <button class="general-btn transitioned-btn"
                                                data-toggle="modal"
                                                data-target="#member-register"
                                                onclick="setIdClass('{{ $classes[$i]->id }}')" >
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
            @endif
            <!-- Classes Showcase Section /- -->

        </main>
        
        <!-- Modal -->
        <div class="modal fade" id="member-register" tabindex="-1" 
             role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" text-center p-0" style="border: none">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="modal-body-header text-center pr-6 pl-6 mb-5">
                      <p class="m-0" style="font-size: 20px">
                        Please fill in the form below
                      </p>
                    </div>

                    <form action="member" method="post" enctype="multipart/form-data">
                        @csrf

                      <div class="form-group form-control-sm text-center">
                          <div class="radio">
                            <label><input type="radio" name="gender" value="1" checked>Male</label>
                          </div>
                          <div class="radio ml-4">
                            <label>
                                <input type="radio" value="0" name="gender">Female
                            </label>
                        </div>
                      </div>
                      <div class="form-group form-control-sm">
                            <label for="buyer_name">Name</label>
                            <input type="text" class="form-control" 
                                    name="name" id="name" placeholder="Name" required>
                      </div>
                      <div class="form-group form-control-sm">
                            <input type="text" class="form-control" 
                                    name="place_of_birth" id="place_of_birth" placeholder="Place of birth" required>
                      </div>
                      <div class="form-group form-control-sm">
                            <input type='text' name="date_of_birth" class="form-control" id="date-of-birth" placeholder="Date of birth : MM/DD/YYYY" />
                      </div>
                      <div class="form-group form-control-sm">
                            <input type="email" class="form-control" 
                                   name="email" id="email" placeholder="Email" required>
                      </div>
                      <div class="form-group form-control-sm">
                            <!-- <label for="city">Telephone number</label> -->
                            <input type="text" class="form-control" 
                                   name="telephone" id="telephone" placeholder="Telephone Number" required>
                      </div>
                      <div class="form-group form-control-sm">
                            <!-- <label for="city">Mobile number</label> -->
                            <input type="text" class="form-control" 
                                   name="mobile" id="mobile" placeholder="Mobile Number" required>
                      </div>

                      <div class="form-group form-control-sm">
                            <!-- <label for="city">Fax number</label> -->
                            <input type="text" class="form-control" 
                                   name="fax" id="fax" placeholder="Fax Number" required>
                      </div>


                      <div hidden=""> <input  type="text" name="class_id" id="about_contents_id"> </div>

                      <button type="submit" class="btn btn-primary">Submit</button>
                      <button type="submit" class="btn btn-warning" data-dismiss="modal">close</button>
                    </form>
                  </div>
                </div>
            </div>
        </div>

        <!-- Footer Section -->
        @include('partials.footer')
        <!-- Footer Section /- -->
        
    </div>
</body>

@endsection

@push('additional_js')
<script>
    function setIdClass($param){
        document.getElementById('about_contents_id').value = $param;
    }
    
    var date = document.getElementById('date-of-birth');

        function checkValue(str, max) {
          if (str.charAt(0) !== '0' || str == '00') {
            var num = parseInt(str);
            if (isNaN(num) || num <= 0 || num > max) num = 1;
            str = num > parseInt(max.toString().charAt(0)) && num.toString().length == 1 ? '0' + num : num.toString();
          };
          return str;
        };

    date.addEventListener('input', function(e) {
        this.type = 'text';
        var input = this.value;

        if (/\D\/$/.test(input)) input = input.substr(0, input.length - 3);
          var values = input.split('/').map(function(v) {
            return v.replace(/\D/g, '')
          });
          if (values[0]) values[0] = checkValue(values[0], 12);
          if (values[1]) values[1] = checkValue(values[1], 31);
          var output = values.map(function(v, i) {
            return v.length == 2 && i < 2 ? v + ' / ' : v;
          });
          this.value = output.join('').substr(0, 14);
    });

</script>
@endpush