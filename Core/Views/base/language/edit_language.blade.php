@extends('core::base.layouts.master')
@section('title')
    {{ translate('Edit Language') }}
@endsection
@section('custom_css')
    <link rel="stylesheet" href="{{ asset('/public/backend/assets/plugins/select2/select2.min.css') }}">
@endsection
@section('main_content')
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="form-element py-30 mb-30">
                <h4 class="font-20 mb-30">{{ translate('Update Language Information') }}</h4>
                <form action="{{ route('core.language.update') }}" method="POST">
                    @csrf
                    <div class="form-row mb-20">
                        <div class="col-sm-4">
                            <label class="font-14 bold black">{{ translate('Name') }} </label>
                        </div>
                        <div class="col-sm-8">
                            <input type="hidden" name="id" value="{{ $lang->id }}">
                            <input type="text" name="name" class="theme-input-style" value="{{ $lang->name }}"
                                placeholder="{{ translate('Type Name') }}">
                            @if ($errors->has('name'))
                                <div class="invalid-input">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-row mb-20">
                        <div class="col-sm-4">
                            <label class="font-14 bold black">{{ translate('Native Name') }}</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" name="native_name" class="theme-input-style"
                                value="{{ $lang->native_name }}" placeholder="{{ translate('Type  Native Name') }}">
                            @if ($errors->has('native_name'))
                                <div class="invalid-input">{{ $errors->first('native_name') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-row mb-20">
                        <div class="col-sm-4">
                            <label class="font-14 bold black">{{ translate('Code') }}</label>
                        </div>
                        <div class="col-sm-8">
                            <select class="langCodeSelect form-control" name="code">
                                <option value="{{ $lang->code }}" data-image="{{ $lang->code }}">
                                    {{ $lang->code }}
                                </option>
                                @foreach (\File::files(base_path('public/flags')) as $path)
                                    <option value="{{ pathinfo($path)['filename'] }}"
                                        data-image="{{ pathinfo($path)['filename'] }}">
                                        {{ pathinfo($path)['filename'] }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('code'))
                                <div class="invalid-input">{{ $errors->first('code') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-12 text-right">
                            <button type="submit" class="btn long">{{ translate('Update') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('custom_scripts')
    <script src="{{ asset('/public/backend/assets/plugins/select2/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            "use strict";
            $('.langCodeSelect').select2({
                theme: "classic",
                templateResult: formatState,
                templateSelection: formatState
            });
        });

        //Generate language code select options
        function formatState(opt) {
            "use strict";
            var base_path = "{{ url('/') }}";
            if (!opt.id) {
                return opt.text.toUpperCase();
            }
            var image = $(opt.element).attr('data-image');
            var optimage = base_path + '/public/flags/' + image + '.png';
            if (!optimage) {
                return opt.text.toUpperCase();
            } else {
                var $opt = $(
                    '<span><img src="' + optimage + '" width="20px" class="mr-2" /> ' + opt.text
                    .toUpperCase() + '</span>'
                );
                return $opt;
            }
        };
    </script>
@endsection
