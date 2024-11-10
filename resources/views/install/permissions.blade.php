@extends('install.layouts.master')

@section('template_title')
    Permissions
@endsection

@section('title')
    Permissions
@endsection

@section('container')
    <ul class="list">
        @foreach ($permissions['permissions'] as $permission)
            <li class="list__item list__item--permissions {{ $permission['isSet'] ? 'success' : 'error' }}">
                {{ $permission['folder'] }}
                <span>
                    <i class="fa fa-fw fa-{{ $permission['isSet'] ? 'check-circle-o' : 'exclamation-circle' }}"></i>
                    {{ $permission['permission'] }}
                </span>
            </li>
        @endforeach
    </ul>

    @if (!isset($permissions['errors']))
        <div class="buttons">
            <a href="{{ route('install.database') }}" class="button">
                Configure Database
            </a>
        </div>
    @else
    <div class="buttons">
        <a href="#" class="button cursor-none">
            Configure Database
        </a>
    </div>
    @endif
@endsection
