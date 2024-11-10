@extends('install.layouts.master')
@section('template_title')
    Database Setup
@endsection
@section('title')
    Database Setup
@endsection
@section('container')
    <div class="database-form">
        @isset($not_connected)
            {{ $not_connected }}
        @endisset
        <form method="POST" action="{{ route('install.database.save') }}">
            @csrf
            <div class="form-group {{ $errors->has('host') ? 'has-error' : '' }}">
                <input type="text" class="form-controll" name="host"
                    value="{{ request()->has('check') && request()->get('check') == 'failed' ? env('DB_HOST') : old('host') }}"
                    placeholder="Host">
            </div>
            <div class="form-group {{ $errors->has('database_name') ? 'has-error' : '' }}">
                <input type="text" class="form-controll" name="database_name"
                    value="{{ request()->has('check') && request()->get('check') == 'failed' ? env('DB_DATABASE') : old('database_name') }}"
                    placeholder="Database name">
            </div>
            <div class="form-group {{ $errors->has('database_user_name') ? 'has-error' : '' }}">
                <input type="text" class="form-controll" name="database_user_name"
                    value="{{ request()->has('check') && request()->get('check') == 'failed' ? env('DB_USERNAME') : old('database_user_name') }}"
                    placeholder="Database username">
            </div>
            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                <input type="password" class="form-controll" name="password"
                    value="{{ request()->has('check') && request()->get('check') == 'failed' ? env('DB_PASSWORD') : old('password') }}"
                    placeholder="Password">
            </div>
            <div class="form-group {{ $errors->has('port') ? 'has-error' : '' }}">
                <input type="text" class="form-controll" name="port"
                    value="{{ request()->has('check') && request()->get('check') == 'failed' ? env('DB_PORT') : old('port') }}"
                    placeholder="Port">
            </div>
            <div class="buttons">
                <button class="button process-btn">
                    Submit & Continue
                </button>
            </div>
        </form>
    </div>
@endsection
