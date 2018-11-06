@extends('layouts.admin_master')

@push('title')
	<title>Admin-Shop-Category</title>
@endpush

@push('additional_css')
<link href="{{ asset('css/animation.css') }}" rel="stylesheet">
@endpush

@section('content')
	<div id="categories" class="container">
		<h3>Shop's Categories Master</h3>

		<p class="m-0">
			This is where you can customise categories used in Shop page.
		</p>
		<p>
			(caution: deleting a category will also deletes subcategories and items that belong to that category).
		</p>

		<categories> </categories>
		<flash> </flash>
	</div>		
@endsection

@push('additional_js')
	<script src="{{ asset('js/admin/shop/categories.js') }}"></script>
@endpush