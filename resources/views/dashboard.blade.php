@extends('layouts.master')

@push('title')
<title>Dashboard</title>
@endpush

@section('content')
	<div id="admin">
		<dashboard> </dashboard>
	</div>
@endsection

@push('additional_js')
	<script src="{{ asset('js/admin/dashboard.js') }}"></script>
@endpush