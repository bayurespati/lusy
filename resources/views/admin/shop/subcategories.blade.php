@extends('layouts.admin_master')

@push('title')
	<title>Admin-Shop-Subcategories</title>
@endpush

@push('additional_css')
<link href="{{ asset('css/animation.css') }}" rel="stylesheet">
@endpush

@section('content')
	<div id="subcategories">
		<subcategories> </subcategories>
		<flash> </flash>
	</div>		
@endsection

@push('additional_js')
	<script src="{{ asset('js/admin/shop/subcategories.js') }}"></script>
@endpush