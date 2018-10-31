@extends('layouts.admin_master')

@push('title')
	<title>Admin-Home-Image Slider</title>
@endpush

@push('additional_css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.5.0/croppie.min.css"/>
<link href="{{ asset('css/animation.css') }}" rel="stylesheet">
@endpush

@section('content')
	<div id="image-slider">
		<image-slider> </image-slider>
		<flash> </flash>
	</div>		
@endsection

@push('additional_js')
	<script src="{{ asset('js/admin/slider.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.5.0/croppie.min.js"></script>
@endpush