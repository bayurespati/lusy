@extends('layouts.admin')

@push('title')
<title>Home</title>
@endpush

@section('content')
	<div id="home">
		<home> </home>
	</div>
@endsection

@push('additional_js')
	<script src="{{ asset('js/admin/home.js') }}"></script>
@endpush