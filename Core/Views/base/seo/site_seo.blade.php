@extends('core::base.layouts.master')
@section('title')
    {{ translate('Site Seo  Settings') }}
@endsection
@section('custom_css')
@endsection
@section('main_content')
    <!-- General settings form -->
    <div class="row">
        <div class="col-md-7 mb-30 mx-auto">
            <div class="card">
                <div class="card-header bg-white border-bottom2 pb-0">
                    <div class="post-head d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center">
                            <div class="content">
                                <h4>{{ translate('Site Seo  Settings') }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div>
                        <form action="{{ route('core.seo.settings.update') }}" method="POST">
                            @csrf
                            <div class="form-row mb-20">
                                <div class="col-md-4">
                                    <label class="font-14 bold black">{{ translate('Meta title') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="site_meta_title" class="theme-input-style"
                                        value="{{ getGeneralSetting('site_meta_title') }}"
                                        placeholder="{{ translate('Meta Title') }}">
                                    @if ($errors->has('site_meta_title'))
                                        <div class="invalid-input">{{ $errors->first('site_meta_title') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-row mb-20">
                                <div class="col-md-4">
                                    <label class="font-14 bold black">{{ translate('Meta description') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <textarea name="site_meta_description" class="theme-input-style">{{ getGeneralSetting('site_meta_description') }}</textarea>
                                    @if ($errors->has('site_meta_description'))
                                        <div class="invalid-input">{{ $errors->first('site_meta_description') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-row mb-20">
                                <div class="col-md-4">
                                    <label class="font-14 bold black">{{ translate('Meta keywords') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <textarea name="site_meta_keywords" class="theme-input-style">{{ getGeneralSetting('site_meta_keywords') }}</textarea>
                                    @if ($errors->has('site_meta_keywords'))
                                        <div class="invalid-input">{{ $errors->first('site_meta_keywords') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-row mb-20">
                                <div class="col-md-4">
                                    <label class="font-14 bold black">{{ translate('Meta image') }}</label>
                                </div>
                                <div class="col-md-8">
                                    @include('core::base.includes.media.media_input', [
                                        'input' => 'site_meta_image',
                                        'data' => getGeneralSetting('site_meta_image'),
                                    ])
                                    @if ($errors->has('site_meta_image'))
                                        <div class="invalid-input">{{ $errors->first('site_meta_image') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn long">{{ translate('Save Changes') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('core::base.media.partial.media_modal')
    </div>
    <!-- /General settings form -->
@endsection
@section('custom_scripts')
    <script>
        (function($) {
            "use strict";
            initDropzone()
            $(document).ready(function() {
                is_for_browse_file = true
                filtermedia()
            })
        })(jQuery);
    </script>
@endsection
