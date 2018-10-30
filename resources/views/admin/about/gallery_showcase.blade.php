@extends('layouts.admin_master')

@push('title')
	<title>Admin-About-Gallery Showcase</title>
@endpush

@push('additional_css')
<link href="{{ asset('css/animation.css') }}" rel="stylesheet">
@endpush

@section('content')
	<div id="gallery">
		<gallery> </gallery>
		<flash> </flash>
	</div>		
@endsection

@push('additional_js')
	<script src="{{ asset('js/admin/about/gallery_showcase.js') }}"></script>
@endpush