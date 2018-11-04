@extends('layouts.admin_master')

@push('title')
	<title>Admin-Shop-List-image</title>
@endpush

@push('additional_css')
<link href="{{ asset('css/croppie.css') }}" rel="stylesheet">
<link href="{{ asset('css/animation.css') }}" rel="stylesheet">
@endpush

@section('content')
	<div id="image-list">
		<image-list> </image-list>
		<flash> </flash>
	</div>
@endsection

@push('additional_js')
<script>
    const $param = {!! json_encode($param) !!};
</script>
	<script src="{{ asset('js/croppie.js') }}"></script>
	<script src="{{ asset('js/admin/shop/image.js') }}"></script>
@endpush