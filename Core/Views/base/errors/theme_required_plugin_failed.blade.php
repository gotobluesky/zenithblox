@extends('core::base.errors.error_master')
@section('error_title')
    {{ translate('error') }}
@endsection
@section('error_master')
    <h5 class="mxw-550 mb-30">{{ $message }}</h5>
    <img src="{{ asset('/public/backend/assets/img/error.png') }}" alt="plugin error">
@endsection
