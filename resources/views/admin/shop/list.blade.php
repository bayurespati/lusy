@extends('layouts.admin_master')

@push('title')
	<title>Admin-Shop-List</title>
@endpush

@push('additional_css')
<link href="{{ asset('css/animation.css') }}" rel="stylesheet">
@endpush

@section('content')
	<div id="shop-item">
		<shop-item> </shop-item>
		<flash> </flash>
	</div>		
@endsection

@push('additional_js')
	<script src="{{ asset('js/admin/shop/list.js') }}"></script>
@endpush