@extends('core::base.layouts.master')
@section('title')
    {{ translate('Install Plugin') }}
@endsection
@section('custom_css')
@endsection
@section('main_content')
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="form-element py-30 mb-30">
                <h4 class="font-20 mb-30">{{ translate('Install Plugin') }}</h4>
                @if ($errors->has('error'))
                    <p class="alert alert-danger">{{ $errors->first('error') }}</p>
                @endif
                <form action="{{ route('core.plugins.install') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row mb-20">
                        <div class="col-sm-4">
                            <label class="font-14 bold black">{{ translate('Zip File') }}</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="file" name="zip_file">
                            @if ($errors->has('zip_file'))
                                <div class="invalid-input">{{ $errors->first('zip_file') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-12 text-right">
                            <button type="submit" class="btn long">{{ translate('Install') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('custom_scripts')
@endsection
