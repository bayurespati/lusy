@extends('layouts.admin_master')

@push('title')
	<title>Admin-Gallery-Category</title>
@endpush

@push('additional_css')
<link href="{{ asset('css/animation.css') }}" rel="stylesheet">
@endpush

@section('content')
	<div id="categories">
		<categories> </categories>
		<flash> </flash>
	</div>		
@endsection

@push('additional_js')
	<script src="{{ asset('js/admin/gallery/categories.js') }}"></script>
@endpush