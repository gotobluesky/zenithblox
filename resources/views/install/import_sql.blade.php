@extends('install.layouts.master')

@section('template_title')
    Import Sql
@endsection
@section('title')
    Import Sql
@endsection

@section('container')
    <div class="text-center">
        <form method="POST" action="{{ route('install.database.import.ecommerce') }}">
            @csrf
            <div class="buttons">
                <button class="button process-btn">
                    Import Sql
                </button>
            </div>
        </form>
    </div>
@endsection
