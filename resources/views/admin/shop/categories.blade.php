@extends('layouts.admin_master')

@push('title')
	<title>Admin-Shop-Category</title>
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
	<script src="{{ asset('js/admin/shop/categories.js') }}"></script>
@endpush