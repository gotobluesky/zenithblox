@extends('install.layouts.master')
@section('template_title')
    User Registration
@endsection
@section('title')
    User Registration
@endsection

@section('container')
    <div class="database-form">
        <form method="POST" action="{{ route('install.user.registration.complete') }}">
            @csrf
            <div class="form-group">
                <input type="text" class="form-controll" name="system_name" value="{{ old('system_name') }}"
                    placeholder="System Name">
                @if ($errors->has('system_name'))
                    <div class="invalid-input">{{ $errors->first('system_name') }}</div>
                @endif
            </div>
            <div class="form-group">
                <input type="text" class="form-controll" name="name" value="{{ old('name') }}"
                    placeholder="User name">
                @if ($errors->has('name'))
                    <div class="invalid-input">{{ $errors->first('name') }}</div>
                @endif
            </div>
            <div class="form-group">
                <input type="text" class="form-controll" name="email" value="{{ old('email') }}" placeholder="Email">
                @if ($errors->has('email'))
                    <div class="invalid-input">{{ $errors->first('email') }}</div>
                @endif
            </div>
            <div class="form-group">
                <input type="password" class="form-controll" name="password" value="{{ old('password') }}"
                    placeholder="Password">
                @if ($errors->has('password'))
                    <div class="invalid-input">{{ $errors->first('password') }}</div>
                @endif
            </div>
            <div class="form-group">
                <input type="password" class="form-controll" name="password_confirmation" placeholder="Confirm Password">
            </div>
            <div class="buttons">
                <button class="button process-btn">
                    Submit & Finish
                </button>
            </div>
        </form>
    </div>
@endsection
