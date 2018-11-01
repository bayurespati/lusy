@extends('layouts.admin_master')

@push('title')
	<title>Admin-Gallery-List</title>
@endpush

@push('additional_css')
<link href="{{ asset('css/animation.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.5.0/croppie.min.css"/>
@endpush

@section('content')
	<div id="gallery">
		<gallery> </gallery>
		<flash> </flash>
	</div>		
@endsection

@push('additional_js')
	<script src="{{ asset('js/admin/gallery/list.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.5.0/croppie.min.js"></script>
@endpush