@extends('layouts.admin_master')

@push('title')
	<title>Admin-Gallery-List</title>
@endpush

@push('additional_css')
<link href="{{ asset('css/croppie.css') }}" rel="stylesheet">
<link href="{{ asset('css/animation.css') }}" rel="stylesheet">
@endpush

@section('content')
	<div id="gallery">
		<gallery> </gallery>
		<flash> </flash>
	</div>		
@endsection

@push('additional_js')
	<script src="{{ asset('js/croppie.js') }}"></script>
	<script src="{{ asset('js/admin/gallery/list.js') }}"></script>
@endpush