@php
    $image_types = getAllImageTypes();
    $placeholder_info = getPlaceHolderImage();
    $placeholder_image = '';
    $placeholder_image_alt = '';
    
    if ($placeholder_info != null) {
        $placeholder_image = $placeholder_info->placeholder_image;
        $placeholder_image_alt = $placeholder_info->placeholder_image_alt;
    }
    
@endphp
@extends('core::base.layouts.master')
@section('title')
    {{ translate('Media Settings') }}
@endsection
@section('custom_css')
    <link rel="stylesheet" href="{{ asset('/public/backend/assets/plugins/select2/select2.min.css') }}">
@endsection
@section('main_content')
    <!-- Image Settings -->
    <div class="row">
        <div class="col-md-8 mb-30">
            <div class="card">
                <div class="card-body">
                    <div class="post-head d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center">
                            <div class="content">
                                <h4 class="mb-1">{{ translate('Media Settings') }}</h4>
                            </div>
                        </div>
                    </div>

                    <div>
                        <form action="{{ route('core.store.media.settings') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-row mb-20">
                                <div class="col-md-4">
                                    <label class="font-14 bold black">{{ translate('Placeholder Image') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="hidden" name="placeholder_image" id="placeholder_image_id"
                                        value="{{ $data['placeholder_image_id'] }}">
                                    <div class="image-box">
                                        <div class="d-flex flex-wrap gap-10 mb-3">
                                            <div class="preview-image-wrapper">
                                                <img src="{{ project_asset($data['placeholder_image']) }}"
                                                    alt="{{ $data['placeholder_image_alt'] }}" width="150"
                                                    class="preview_image" id="placeholder_image_preview" />
                                                <button type="button" title="Remove image" class="remove-btn style--three"
                                                    id="placeholder_image_remove"
                                                    onclick="removeSelection('#placeholder_image_preview,#placeholder_image_id,#placeholder_image_remove')"><i
                                                        class="icofont-close"></i></button>
                                            </div>
                                        </div>
                                        <div class="image-box-actions">
                                            <button type="button" class="btn-link" data-toggle="modal"
                                                data-target="#mediaUploadModal" id="placeholder_image_choose"
                                                onclick="setDataInsertableIds('#placeholder_image_preview,#placeholder_image_id,#placeholder_image_remove')">
                                                {{ translate('Choose image') }}
                                            </button>
                                        </div>
                                    </div>
                                    @if ($errors->has('placeholder_image'))
                                        <div class="invalid-input">{{ $errors->first('placeholder_image') }}</div>
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <h4 class="mb-4">{{ translate('Media Thumbnails Sizes') }}</h4>
                            <div class="form-row mb-20">
                                <div class="col-md-4">
                                    <label class="font-14 bold black">{{ translate('Large Thumb Image Size') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="number" name="large_thumb_image_width" class="theme-input-style"
                                        value="{{ $data['large_thumb_image_width'] }}"
                                        placeholder="{{ translate('Large thumb image width') }}">
                                    @if ($errors->has('large_thumb_image_width'))
                                        <div class="invalid-input">{{ $errors->first('large_thumb_image_width') }}</div>
                                    @else
                                        <span>{{ translate('Large thumb image width') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <input type="number" name="large_thumb_image_height" class="theme-input-style"
                                        value="{{ $data['large_thumb_image_height'] }}"
                                        placeholder="{{ translate('Large thumb image height') }}">
                                    @if ($errors->has('large_thumb_image_height'))
                                        <div class="invalid-input">{{ $errors->first('large_thumb_image_height') }}
                                        </div>
                                    @else
                                        <span>{{ translate('Large thumb image height') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-row mb-20">
                                <div class="col-md-4">
                                    <label class="font-14 bold black">{{ translate('Medium Thumb Image Size') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="number" name="medium_thumb_image_width" class="theme-input-style"
                                        value="{{ $data['medium_thumb_image_width'] }}"
                                        placeholder="{{ translate('Medium thumb image width') }}">
                                    @if ($errors->has('medium_thumb_image_width'))
                                        <div class="invalid-input">{{ $errors->first('medium_thumb_image_width') }}
                                        </div>
                                    @else
                                        <span>{{ translate('Medium thumb image width') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <input type="number" name="medium_thumb_image_height" class="theme-input-style"
                                        value="{{ $data['medium_thumb_image_height'] }}"
                                        placeholder="{{ translate('Medium thumb image height') }}">
                                    @if ($errors->has('medium_thumb_image_height'))
                                        <div class="invalid-input">{{ $errors->first('medium_thumb_image_height') }}
                                        </div>
                                    @else
                                        <span>{{ translate('Medium thumb image height') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-row mb-20">
                                <div class="col-md-4">
                                    <label class="font-14 bold black">{{ translate('Small Thumb Image Size') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="number" name="small_thumb_image_width" class="theme-input-style"
                                        value="{{ $data['small_thumb_image_width'] }}"
                                        placeholder="{{ translate('Small thumb image width') }}">
                                    @if ($errors->has('small_thumb_image_width'))
                                        <div class="invalid-input">{{ $errors->first('small_thumb_image_width') }}</div>
                                    @else
                                        <span>{{ translate('Small thumb image width') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <input type="number" name="small_thumb_image_height" class="theme-input-style"
                                        value="{{ $data['small_thumb_image_height'] }}"
                                        placeholder="{{ translate('Small thumb image height') }}">
                                    @if ($errors->has('small_thumb_image_height'))
                                        <div class="invalid-input">{{ $errors->first('small_thumb_image_height') }}
                                        </div>
                                    @else
                                        <span>{{ translate('Small thumb image height') }}</span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-row">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn long">{{ translate('Submit') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('core::base.media.partial.media_modal')
    </div>
    <!-- /Image Settings -->
@endsection
@section('custom_scripts')
    <script src="{{ asset('/public/backend/assets/plugins/select2/select2.min.js') }}"></script>
    <script>
        (function($) {
            "use strict";
            initDropzone()
            $(document).ready(function() {
                is_for_browse_file = true
                filtermedia()

                if (!$('#chunk_size_upload').is(":checked")) {
                    $('#chunk_size_upload_settings').hide()
                }
            });
        })(jQuery);


        /**
         * Hide & show chunk size upload status 
         */
        function toggleChunkSizeUploadStatus() {
            "use strict";
            if (!$('#chunk_size_upload').is(":checked")) {
                $('#chunk_size_upload_settings').hide()
            } else {
                $('#chunk_size_upload_settings').show()
            }
        }
    </script>
@endsection
