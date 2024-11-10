@extends('core::base.layouts.master')
@section('title')
    {{ translate('Plugin error') }}
@endsection
@section('main_content')
    <div class="justify-content-center row">
        <div class="col-lg-6 text-center">
            <h1 class="mb-20">Plugin Error</h1>
            <p class="mxw-550 mb-30">{{ $message }}</p>
            <img src="{{ asset('/public/backend/assets/img/error.png') }}" alt="plugin error">
        </div>
    </div>
@endsection
