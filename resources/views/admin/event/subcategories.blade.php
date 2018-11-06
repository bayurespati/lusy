@extends('layouts.admin_master')

@push('title')
	<title>Admin-Event-Subcategories</title>
@endpush

@push('additional_css')
<link href="{{ asset('css/animation.css') }}" rel="stylesheet">
@endpush

@section('content')
	<div id="subcategories" class="container">
		<h3>Events' Subcategories Master</h3>

		<p class="m-0">
			This is where you can customise subcategories of categories used in Event page.
		</p>
		<p>
			(caution: deleting a subcategory will also deletes items that belong to that subcategory).
		</p>

		<subcategories> </subcategories>
		<flash> </flash>
	</div>		
@endsection

@push('additional_js')
	<script src="{{ asset('js/admin/event/subcategories.js') }}"></script>
@endpush