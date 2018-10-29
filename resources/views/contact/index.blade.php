@extends('layouts.master')

@push('title')
<title>Lusy Wahyudi</title>
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
					<h3>contact</h3>
				</div><!-- Container /- -->
			</div><!-- Page Banner /- -->
			
			<!-- Contact Section -->
			<div class="container-fluid no-padding contact-section">
				<!-- Container -->
				<div class="container">
					<div class="contact-form">
						<h3>Leave A Message</h3>
						<p>Feel free to contact us and find out more about what we do.</p>
						<p>We would love to hear from you.</p>
						<form>
							<div class="row">
								<div class="form-group col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="contact-fname" id="input_fname" required="" placeholder="First Name *" class="form-control">
									<input type="text" name="contact-lname" id="input_lname" required="" placeholder="Last Name *" class="form-control">
									<input type="text" name="contact-phone" id="input_subject" required="" placeholder="Phone Number" class="form-control">
									<input type="email" name="contact-email" id="input_email" required="" placeholder="Email Address *" class="form-control">
								</div>
								<div class="form-group col-md-6 col-sm-6 col-xs-12">
									<textarea name="contact-message" id="textarea_message" placeholder="Your message" rows="4" class="form-control"></textarea>
									<button id="btn_submit" class="transitioned-btn" type="submit" title="Send Your Message">Send Your Message</button>
								</div>
							</div>
							<div class="alert-msg" id="alert-msg"></div>
						</form>
					</div>
				</div>
			</div>
            
        </main>

        <!-- Footer Section -->
        @include('partials.footer')
        <!-- Footer Section /- -->
        
    </div>
</body>

@endsection