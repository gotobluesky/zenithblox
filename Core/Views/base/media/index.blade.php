@extends('core::base.layouts.master')
@section('title')
    {{ translate('Media') }}
@endsection
@section('custom_css')
    <link rel="stylesheet" href="{{ asset('/public/backend/assets/plugins/dropzone/dropzone.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/public/backend/assets/plugins/daterangepicker/daterangepicker.css') }}">
@endsection
@section('main_content')
    <div class="border-bottom2 pb-3 mb-4">
        <h4><i class="icofont-multimedia"></i> {{ translate('Media') }} </h4>
    </div>
    <!-- Media List -->
    <div>
        @include('core::base.media.partial.media_list')
    </div>
    <!-- /Media List -->


    <div class="modal fade" id="browseImgPrev" tabindex="-1" role="dialog" aria-labelledby="browseImgPrevLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-full" role="document">
            <div class="modal-content">
                <div class="modal-header align-items-center">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                        {{ translate('Attachment details') }}
                    </h5>
                    <div class="media-nav-wrap d-flex align-items-center" id="media_slide">
                        <span class="media-prev mr-1" onclick=""><i class="icofont-simple-left"></i></span>
                        <span class="media-next" onclick=""><i class="icofont-simple-right"></i></span>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="media-img-single-preview">
                        <div class="thumbnail preview-image">
                            <img id='preview_image' class="media_preview_image" src="" alt="" />
                        </div>
                        <div class="attachment-meta-wrap mt-30 mt-md-0">
                            <div class="details mb-3 pb-3 border-bottom2">
                                <div class="word-break">
                                    <span class="font-weight-bolder">{{ translate('File Name:') }} </span>
                                    <span id="file_name"></span>
                                </div>
                                <div class="word-break">
                                    <span class="font-weight-bolder">{{ translate('File URL:') }} </span>
                                    <input class="theme-input-style" id="file_url" type="text" value="" readonly>
                                </div>
                                <div>
                                    <span class="font-weight-bolder">{{ translate('File Type:') }} </span>
                                    <span id="file_type"></span>
                                </div>
                                <div>
                                    <span class="font-weight-bolder">{{ translate('File Size:') }} </span>
                                    <span id="file_size"></span>
                                </div>
                                <div>
                                    <span class="font-weight-bolder">{{ translate('Uploaded By:') }} </span>
                                    <span id="uploaded_by"></span>
                                </div>
                                <div>
                                    <span class="font-weight-bolder">{{ translate('Created At:') }} </span>
                                    <span id="creaated_at"></span>
                                </div>
                                <div>
                                    <span class="font-weight-bolder">{{ translate('Updated At:') }} </span>
                                    <span id="updated_at"></span>
                                </div>
                                <div class="d-flex gap-10 justify-content-end flex-wrap mt-2">
                                    <a type="button" id="download_file" target="_blank" href="" class="btn sm "
                                        data-clipboard-target="#attachment-details-copy-link">
                                        {{ translate('Download') }}
                                    </a>
                                    <button type="button" class="btn sm" id="copy-link-btn">
                                        {{ translate('Copy URL to clipboard') }}
                                    </button>
                                </div>
                            </div>
                            <form>
                                <input type="hidden" name="id" id="media_id">
                                <div class="settings-wrap pb-3 mb-3 border-bottom2">
                                    <span class="setting mb-10 has-description">
                                        <label for="attachment-details-alt-text"
                                            class="name">{{ translate('Alt Text') }}</label>
                                        <input type="text" id="attachment-details-alt-text" name="alt"
                                            class="theme-input-style" />
                                        <div class="invalid-input" id="alt_update_error"></div>
                                    </span>
                                    <span class="setting mb-10">
                                        <label for="attachment-details-title"
                                            class="name">{{ translate('Title') }}</label>
                                        <input type="text" id="attachment-details-title" name="title"
                                            class="theme-input-style" />
                                        <div class="invalid-input" id="title_update_error"></div>
                                    </span>
                                    <span class="setting mb-10">
                                        <label for="attachment-details-caption"
                                            class="name">{{ translate('Caption') }}</label>
                                        <textarea id="attachment-details-caption" name='caption' class="theme-input-style"></textarea>
                                        <div class="invalid-input" id="caption_update_error"></div>
                                    </span>
                                    <span class="setting mb-10">
                                        <label for="attachment-details-description"
                                            class="name">{{ translate('Description') }}</label>
                                        <textarea id="attachment-details-description" name="description" class="theme-input-style"></textarea>
                                        <div class="invalid-input" id="description_update_error"></div>
                                    </span>
                                </div>
                                <div class="d-flex gap-10 justify-content-end flex-wrap mt-2">
                                    <button type="button" class="btn sm copy-attachment-url"
                                        data-clipboard-target="#attachment-details-copy-link" onclick="updateMedia()">
                                        {{ translate('Save') }}
                                    </button>
                                    <button type="button" class="btn sm copy-attachment-url btn-danger"
                                        data-clipboard-target="#attachment-details-copy-link" onclick="deleteMediaFile()">
                                        {{ translate('Delete Permanently') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom_scripts')
    <script src="{{ asset('/public/backend/assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('/public/backend/assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('/public/backend//assets/plugins/datepicker/datepicker.min.js') }}"></script>
    <script src="{{ asset('/public/backend/assets/plugins/datepicker/custom-form-datepicker.js') }}"></script>
    <script>
        (function($) {
            "use strict";
            initDropzone()
            $(document).ready(function() {
                enable_multiple_file_select = true
                filtermedia()
            })
        })(jQuery);
    </script>
@endsection
