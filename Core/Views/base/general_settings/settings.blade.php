@php
    $tzlist = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
    $active_langs = getAllLanguages();
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
    {{ translate('General Settings') }}
@endsection
@section('custom_css')
    <link rel="stylesheet" href="{{ asset('/public/backend/assets/plugins/select2/select2.min.css') }}">
    <link href="{{ asset('/public/backend/assets/plugins/summernote/summernote-lite.css') }}" rel="stylesheet" />
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
                                <h4>{{ translate('General Settings') }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div>
                        <form action="{{ route('core.store.general.settings') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-row mb-20">
                                <div class="col-md-4">
                                    <label class="font-14 bold black text-capitalize">{{ translate('Site Title') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="system_name" class="theme-input-style"
                                        value="{{ isset($data['system_name']) ? $data['system_name'] : '' }}"
                                        placeholder="{{ translate('Site Title') }}">
                                    @if ($errors->has('system_name'))
                                        <div class="invalid-input">{{ $errors->first('system_name') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-row mb-20">
                                <div class="col-md-4">
                                    <label class="font-14 bold black">{{ translate('Site Motto') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="site_moto" class="theme-input-style"
                                        value="{{ isset($data['site_moto']) ? $data['site_moto'] : '' }}"
                                        placeholder="{{ translate('Site Moto') }}">
                                    @if ($errors->has('site_moto'))
                                        <div class="invalid-input">{{ $errors->first('site_moto') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-row mb-20">
                                <div class="col-md-4">
                                    <label class="font-14 bold black">{{ translate('Logo') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="hidden" name="white_background_logo" id="white_background_logo_id"
                                        value="{{ isset($data['white_background_logo_id']) ? $data['white_background_logo_id'] : '' }}">
                                    <div class="image-box">
                                        <div class="d-flex flex-wrap gap-10 mb-3">
                                            @if (isset($data['white_background_logo']))
                                                <div class="preview-image-wrapper">
                                                    <img src="{{ project_asset($data['white_background_logo']) }}"
                                                        width="150" class="preview_image"
                                                        id="white_background_logo_preview" />
                                                    <button type="button" title="Remove image"
                                                        class="remove-btn style--three" id="white_background_logo_remove"
                                                        onclick="removeSelection('#white_background_logo_preview,#white_background_logo_id,#white_background_logo_remove')"><i
                                                            class="icofont-close"></i></button>
                                                </div>
                                            @else
                                                <div class="preview-image-wrapper">
                                                    <img src="{{ project_asset($placeholder_image) }}" width="150"
                                                        class="preview_image" id="white_background_logo_preview" />

                                                    <button type="button" title="Remove image"
                                                        class="remove-btn style--three d-none"
                                                        id="white_background_logo_remove"
                                                        onclick="removeSelection('#white_background_logo_preview,#white_background_logo_id,#white_background_logo_remove')"><i
                                                            class="icofont-close"></i></button>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="image-box-actions">
                                            <button type="button" class="btn-link" data-toggle="modal"
                                                data-target="#mediaUploadModal" id="white_background_logo_choose"
                                                onclick="setDataInsertableIds('#white_background_logo_preview,#white_background_logo_id,#white_background_logo_remove')">
                                                {{ translate('Choose image') }}
                                            </button>
                                        </div>
                                    </div>
                                    @if ($errors->has('white_background_logo'))
                                        <div class="invalid-input">{{ $errors->first('white_background_logo') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-row mb-20">
                                <div class="col-md-4">
                                    <label class="font-14 bold black">{{ translate('Logo (Mobile)') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="hidden" name="white_mobile_background_logo"
                                        id="white_mobile_background_logo_id"
                                        value="{{ isset($data['white_mobile_background_logo_id']) ? $data['white_mobile_background_logo_id'] : '' }}">
                                    <div class="image-box">
                                        <div class="d-flex flex-wrap gap-10 mb-3">
                                            @if (isset($data['white_mobile_background_logo']))
                                                <div class="preview-image-wrapper">
                                                    <img src="{{ project_asset($data['white_mobile_background_logo']) }}"
                                                        width="150" class="preview_image"
                                                        id="white_mobile_background_logo_preview" />
                                                    <button type="button" title="Remove image"
                                                        class="remove-btn style--three"
                                                        id="white_mobile_background_logo_remove"
                                                        onclick="removeSelection('#white_mobile_background_logo_preview,#white_mobile_background_logo_id,#white_mobile_background_logo_remove')"><i
                                                            class="icofont-close"></i></button>
                                                </div>
                                            @else
                                                <div class="preview-image-wrapper">
                                                    <img src="{{ project_asset($placeholder_image) }}" width="150"
                                                        class="preview_image" id="white_mobile_background_logo_preview" />
                                                    <button type="button" title="Remove image"
                                                        class="remove-btn style--three d-none"
                                                        id="white_mobile_background_logo_remove"
                                                        onclick="removeSelection('#white_mobile_background_logo_preview,#white_mobile_background_logo_id,#white_mobile_background_logo_remove')"><i
                                                            class="icofont-close"></i></button>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="image-box-actions">
                                            <button type="button" class="btn-link" data-toggle="modal"
                                                data-target="#mediaUploadModal" id="white_mobile_background_logo_choose"
                                                onclick="setDataInsertableIds('#white_mobile_background_logo_preview,#white_mobile_background_logo_id,#white_mobile_background_logo_remove')">
                                                {{ translate('Choose image') }}
                                            </button>
                                        </div>
                                    </div>
                                    @if ($errors->has('white_mobile_background_logo'))
                                        <div class="invalid-input">{{ $errors->first('white_mobile_background_logo') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-row mb-20">
                                <div class="col-md-4">
                                    <label class="font-14 bold black">{{ translate('Dark Logo') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="hidden" name="black_background_logo" id="black_background_logo_id"
                                        value="{{ isset($data['black_background_logo_id']) ? $data['black_background_logo_id'] : '' }}">
                                    <div class="image-box">
                                        <div class="d-flex flex-wrap gap-10 mb-3">
                                            @if (isset($data['black_background_logo']))
                                                <div class="preview-image-wrapper">
                                                    <img src="{{ project_asset($data['black_background_logo']) }}"
                                                        width="150" class="preview_image"
                                                        id="black_background_logo_preview" />
                                                    <button type="button" title="Remove image"
                                                        class="remove-btn style--three" id="black_background_logo_remove"
                                                        onclick="removeSelection('#black_background_logo_preview,#black_background_logo_id,#black_background_logo_remove')"><i
                                                            class="icofont-close"></i></button>
                                                </div>
                                            @else
                                                <div class="preview-image-wrapper">
                                                    <img src="{{ project_asset($placeholder_image) }}" width="150"
                                                        class="preview_image" id="black_background_logo_preview" />

                                                    <button type="button" title="Remove image"
                                                        class="remove-btn style--three d-none"
                                                        id="black_background_logo_remove"
                                                        onclick="removeSelection('#black_background_logo_preview,#black_background_logo_id,#black_background_logo_remove')"><i
                                                            class="icofont-close"></i></button>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="image-box-actions">
                                            <button type="button" class="btn-link" data-toggle="modal"
                                                data-target="#mediaUploadModal" id="black_background_logo_choose"
                                                onclick="setDataInsertableIds('#black_background_logo_preview,#black_background_logo_id,#black_background_logo_remove')">
                                                {{ translate('Choose image') }}
                                            </button>
                                        </div>
                                    </div>
                                    @if ($errors->has('black_background_logo'))
                                        <div class="invalid-input">{{ $errors->first('black_background_logo') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-row mb-20">
                                <div class="col-md-4">
                                    <label class="font-14 bold black">{{ translate('Dark Logo (Mobile)') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="hidden" name="black_mobile_background_logo"
                                        id="black_mobile_background_logo_id"
                                        value="{{ isset($data['black_mobile_background_logo_id']) ? $data['black_mobile_background_logo_id'] : '' }}">
                                    <div class="image-box">
                                        <div class="d-flex flex-wrap gap-10 mb-3">
                                            @if (isset($data['black_mobile_background_logo']))
                                                <div class="preview-image-wrapper">
                                                    <img src="{{ project_asset($data['black_mobile_background_logo']) }}"
                                                        width="150" class="preview_image"
                                                        id="black_mobile_background_logo_preview" />
                                                    <button type="button" title="Remove image"
                                                        class="remove-btn style--three"
                                                        id="black_mobile_background_logo_remove"
                                                        onclick="removeSelection('#black_mobile_background_logo_preview,#black_mobile_background_logo_id,#black_mobile_background_logo_remove')"><i
                                                            class="icofont-close"></i></button>
                                                </div>
                                            @else
                                                <div class="preview-image-wrapper">
                                                    <img src="{{ project_asset($placeholder_image) }}" width="150"
                                                        class="preview_image" id="black_mobile_background_logo_preview" />

                                                    <button type="button" title="Remove image"
                                                        class="remove-btn style--three d-none"
                                                        id="black_mobile_background_logo_remove"
                                                        onclick="removeSelection('#black_mobile_background_logo_preview,#black_mobile_background_logo_id,#black_mobile_background_logo_remove')"><i
                                                            class="icofont-close"></i></button>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="image-box-actions">
                                            <button type="button" class="btn-link" data-toggle="modal"
                                                data-target="#mediaUploadModal" id="black_mobile_background_logo_choose"
                                                onclick="setDataInsertableIds('#black_mobile_background_logo_preview,#black_mobile_background_logo_id,#black_mobile_background_logo_remove')">
                                                {{ translate('Choose image') }}
                                            </button>
                                        </div>
                                    </div>
                                    @if ($errors->has('black_mobile_background_logo'))
                                        <div class="invalid-input">{{ $errors->first('black_mobile_background_logo') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-row mb-20">
                                <div class="col-md-4">
                                    <label class="font-14 bold black">{{ translate('Sticky Logo') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="hidden" name="sticky_background_logo" id="sticky_background_logo_id"
                                        value="{{ isset($data['sticky_background_logo_id']) ? $data['sticky_background_logo_id'] : '' }}">
                                    <div class="image-box">
                                        <div class="d-flex flex-wrap gap-10 mb-3">
                                            @if (isset($data['sticky_background_logo']))
                                                <div class="preview-image-wrapper">
                                                    <img src="{{ project_asset($data['sticky_background_logo']) }}"
                                                        width="150" class="preview_image"
                                                        id="sticky_background_logo_preview" />
                                                    <button type="button" title="Remove image"
                                                        class="remove-btn style--three" id="sticky_background_logo_remove"
                                                        onclick="removeSelection('#sticky_background_logo_preview,#sticky_background_logo_id,#sticky_background_logo_remove')"><i
                                                            class="icofont-close"></i></button>
                                                </div>
                                            @else
                                                <div class="preview-image-wrapper">
                                                    <img src="{{ project_asset($placeholder_image) }}" width="150"
                                                        class="preview_image" id="sticky_background_logo_preview" />

                                                    <button type="button" title="Remove image"
                                                        class="remove-btn style--three d-none"
                                                        id="sticky_background_logo_remove d-none"
                                                        onclick="removeSelection('#sticky_background_logo_preview,#sticky_background_logo_id,#sticky_background_logo_remove')"><i
                                                            class="icofont-close"></i></button>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="image-box-actions">
                                            <button type="button" class="btn-link" data-toggle="modal"
                                                data-target="#mediaUploadModal" id="sticky_background_logo_choose"
                                                onclick="setDataInsertableIds('#sticky_background_logo_preview,#sticky_background_logo_id,#sticky_background_logo_remove')">
                                                {{ translate('Choose image') }}
                                            </button>
                                        </div>
                                    </div>
                                    @if ($errors->has('sticky_background_logo'))
                                        <div class="invalid-input">{{ $errors->first('sticky_background_logo') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-row mb-20">
                                <div class="col-md-4">
                                    <label class="font-14 bold black">{{ translate('Sticky Logo (Mobile)') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="hidden" name="sticky_mobile_background_logo"
                                        id="sticky_mobile_background_logo_id"
                                        value="{{ isset($data['sticky_mobile_background_logo_id']) ? $data['sticky_mobile_background_logo_id'] : '' }}">
                                    <div class="image-box">
                                        <div class="d-flex flex-wrap gap-10 mb-3">
                                            @if (isset($data['sticky_mobile_background_logo']))
                                                <div class="preview-image-wrapper">
                                                    <img src="{{ project_asset($data['sticky_mobile_background_logo']) }}"
                                                        width="150" class="preview_image"
                                                        id="sticky_mobile_background_logo_preview" />
                                                    <button type="button" title="Remove image"
                                                        class="remove-btn style--three"
                                                        id="sticky_mobile_background_logo_remove"
                                                        onclick="removeSelection('#sticky_mobile_background_logo_preview,#sticky_mobile_background_logo_id,#sticky_mobile_background_logo_remove')"><i
                                                            class="icofont-close"></i></button>
                                                </div>
                                            @else
                                                <div class="preview-image-wrapper">
                                                    <img src="{{ project_asset($placeholder_image) }}" width="150"
                                                        class="preview_image"
                                                        id="sticky_mobile_background_logo_preview" />
                                                    <button type="button" title="Remove image"
                                                        class="remove-btn style--three d-none"
                                                        id="sticky_mobile_background_logo_remove"
                                                        onclick="removeSelection('#sticky_mobile_background_logo_preview,#sticky_mobile_background_logo_id,#sticky_mobile_background_logo_remove')"><i
                                                            class="icofont-close"></i></button>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="image-box-actions">
                                            <button type="button" class="btn-link" data-toggle="modal"
                                                data-target="#mediaUploadModal" id="sticky_mobile_background_logo_choose"
                                                onclick="setDataInsertableIds('#sticky_mobile_background_logo_preview,#sticky_mobile_background_logo_id,#sticky_mobile_background_logo_remove')">
                                                {{ translate('Choose image') }}
                                            </button>
                                        </div>
                                    </div>
                                    @if ($errors->has('sticky_mobile_background_logo'))
                                        <div class="invalid-input">{{ $errors->first('sticky_mobile_background_logo') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-row mb-20">
                                <div class="col-md-4">
                                    <label class="font-14 bold black">{{ translate('Dark Sticky Logo') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="hidden" name="sticky_black_background_logo"
                                        id="sticky_black_background_logo_id"
                                        value="{{ isset($data['sticky_black_background_logo_id']) ? $data['sticky_black_background_logo_id'] : '' }}">
                                    <div class="image-box">
                                        <div class="d-flex flex-wrap gap-10 mb-3">
                                            @if (isset($data['sticky_black_background_logo']))
                                                <div class="preview-image-wrapper">
                                                    <img src="{{ project_asset($data['sticky_black_background_logo']) }}"
                                                        width="150" class="preview_image"
                                                        id="sticky_black_background_logo_preview" />
                                                    <button type="button" title="Remove image"
                                                        class="remove-btn style--three"
                                                        id="sticky_black_background_logo_remove"
                                                        onclick="removeSelection('#sticky_black_background_logo_preview,#sticky_black_background_logo_id,#sticky_black_background_logo_remove')"><i
                                                            class="icofont-close"></i></button>
                                                </div>
                                            @else
                                                <div class="preview-image-wrapper">
                                                    <img src="{{ project_asset($placeholder_image) }}" width="150"
                                                        class="preview_image" id="sticky_black_background_logo_preview" />

                                                    <button type="button" title="Remove image"
                                                        class="remove-btn style--three d-none"
                                                        id="sticky_black_background_logo_remove"
                                                        onclick="removeSelection('#sticky_black_background_logo_preview,#sticky_black_background_logo_id,#sticky_black_background_logo_remove')"><i
                                                            class="icofont-close"></i></button>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="image-box-actions">
                                            <button type="button" class="btn-link" data-toggle="modal"
                                                data-target="#mediaUploadModal" id="sticky_black_background_logo_choose"
                                                onclick="setDataInsertableIds('#sticky_black_background_logo_preview,#sticky_black_background_logo_id,#sticky_black_background_logo_remove')">
                                                {{ translate('Choose image') }}
                                            </button>
                                        </div>
                                    </div>
                                    @if ($errors->has('sticky_black_background_logo'))
                                        <div class="invalid-input">{{ $errors->first('sticky_black_background_logo') }}
                                        </div>
                                    @endif
                                </div>
                            </div>


                            <div class="form-row mb-20">
                                <div class="col-md-4">
                                    <label class="font-14 bold black">{{ translate('Dark Sticky Logo (Mobile)') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="hidden" name="sticky_black_mobile_background_logo"
                                        id="sticky_black_mobile_background_logo_id"
                                        value="{{ isset($data['sticky_black_mobile_background_logo_id']) ? $data['sticky_black_mobile_background_logo_id'] : '' }}">
                                    <div class="image-box">
                                        <div class="d-flex flex-wrap gap-10 mb-3">
                                            @if (isset($data['sticky_black_mobile_background_logo']))
                                                <div class="preview-image-wrapper">
                                                    <img src="{{ project_asset($data['sticky_black_mobile_background_logo']) }}"
                                                        width="150" class="preview_image"
                                                        id="sticky_black_mobile_background_logo_preview" />
                                                    <button type="button" title="Remove image"
                                                        class="remove-btn style--three"
                                                        id="sticky_black_mobile_background_logo_remove"
                                                        onclick="removeSelection('#sticky_black_mobile_background_logo_preview,#sticky_black_mobile_background_logo_id,#sticky_black_mobile_background_logo_remove')"><i
                                                            class="icofont-close"></i></button>
                                                </div>
                                            @else
                                                <div class="preview-image-wrapper">
                                                    <img src="{{ project_asset($placeholder_image) }}" width="150"
                                                        class="preview_image"
                                                        id="sticky_black_mobile_background_logo_preview" />

                                                    <button type="button" title="Remove image"
                                                        class="remove-btn style--three d-none"
                                                        id="sticky_black_mobile_background_logo_remove"
                                                        onclick="removeSelection('#sticky_black_mobile_background_logo_preview,#sticky_black_mobile_background_logo_id,#sticky_black_mobile_background_logo_remove')"><i
                                                            class="icofont-close"></i></button>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="image-box-actions">
                                            <button type="button" class="btn-link" data-toggle="modal"
                                                data-target="#mediaUploadModal"
                                                id="sticky_black_mobile_background_logo_choose"
                                                onclick="setDataInsertableIds('#sticky_black_mobile_background_logo_preview,#sticky_black_mobile_background_logo_id,#sticky_black_mobile_background_logo_remove')">
                                                {{ translate('Choose image') }}
                                            </button>
                                        </div>
                                    </div>
                                    @if ($errors->has('sticky_black_mobile_background_logo'))
                                        <div class="invalid-input">
                                            {{ $errors->first('sticky_black_mobile_background_logo') }}</div>
                                    @endif
                                </div>
                            </div>

                            <!-- Admin Logo-->
                            <div class="form-row mb-20">
                                <div class="col-md-4">
                                    <label class="font-14 bold black">{{ translate('Admin Logo') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="hidden" name="admin_logo" id="admin_logo_id"
                                        value="{{ isset($data['admin_logo_id']) ? $data['admin_logo_id'] : '' }}">
                                    <div class="image-box">
                                        <div class="d-flex flex-wrap gap-10 mb-3">
                                            @if (isset($data['admin_logo']))
                                                <div class="preview-image-wrapper">
                                                    <img src="{{ project_asset($data['admin_logo']) }}" width="150"
                                                        class="preview_image" id="admin_logo_preview" />
                                                    <button type="button" title="Remove image"
                                                        class="remove-btn style--three" id="admin_logo_remove"
                                                        onclick="removeSelection('#admin_logo_preview,#admin_logo_id,#admin_logo_remove')"><i
                                                            class="icofont-close"></i></button>
                                                </div>
                                            @else
                                                <div class="preview-image-wrapper">
                                                    <img src="{{ project_asset($placeholder_image) }}" width="150"
                                                        class="preview_image" id="admin_logo_preview" />

                                                    <button type="button" title="Remove image"
                                                        class="remove-btn style--three d-none" id="admin_logo_remove"
                                                        onclick="removeSelection('#admin_logo_preview,#admin_logo_id,#admin_logo_remove')"><i
                                                            class="icofont-close"></i></button>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="image-box-actions">
                                            <button type="button" class="btn-link" data-toggle="modal"
                                                data-target="#mediaUploadModal" id="admin_logo_choose"
                                                onclick="setDataInsertableIds('#admin_logo_preview,#admin_logo_id,#admin_logo_remove')">
                                                {{ translate('Choose image') }}
                                            </button>
                                        </div>
                                    </div>
                                    @if ($errors->has('admin_logo'))
                                        <div class="invalid-input">{{ $errors->first('admin_logo') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-row mb-20">
                                <div class="col-md-4">
                                    <label class="font-14 bold black">{{ translate('Admin Logo (Mobile)') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="hidden" name="admin_mobile_logo" id="admin_mobile_logo_id"
                                        value="{{ isset($data['admin_mobile_logo_id']) ? $data['admin_mobile_logo_id'] : '' }}">
                                    <div class="image-box">
                                        <div class="d-flex flex-wrap gap-10 mb-3">
                                            @if (isset($data['admin_mobile_logo']))
                                                <div class="preview-image-wrapper">
                                                    <img src="{{ project_asset($data['admin_mobile_logo']) }}"
                                                        width="150" class="preview_image"
                                                        id="admin_mobile_logo_preview" />
                                                    <button type="button" title="Remove image"
                                                        class="remove-btn style--three" id="admin_mobile_logo_remove"
                                                        onclick="removeSelection('#admin_mobile_logo_preview,#admin_mobile_logo_id,#admin_mobile_logo_remove')"><i
                                                            class="icofont-close"></i></button>
                                                </div>
                                            @else
                                                <div class="preview-image-wrapper">
                                                    <img src="{{ project_asset($placeholder_image) }}" width="150"
                                                        class="preview_image" id="admin_mobile_logo_preview" />

                                                    <button type="button" title="Remove image"
                                                        class="remove-btn style--three d-none"
                                                        id="admin_mobile_logo_remove"
                                                        onclick="removeSelection('#admin_mobile_logo_preview,#admin_mobile_logo_id,#admin_mobile_logo_remove')"><i
                                                            class="icofont-close"></i></button>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="image-box-actions">
                                            <button type="button" class="btn-link" data-toggle="modal"
                                                data-target="#mediaUploadModal" id="admin_mobile_logo_choose"
                                                onclick="setDataInsertableIds('#admin_mobile_logo_preview,#admin_mobile_logo_id,#admin_mobile_logo_remove')">
                                                {{ translate('Choose image') }}
                                            </button>
                                        </div>
                                    </div>
                                    @if ($errors->has('admin_mobile_logo'))
                                        <div class="invalid-input">{{ $errors->first('admin_mobile_logo') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-row mb-20">
                                <div class="col-md-4">
                                    <label class="font-14 bold black">{{ translate('Admin Dark Logo') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="hidden" name="admin_dark_logo" id="admin_dark_logo_id"
                                        value="{{ isset($data['admin_dark_logo_id']) ? $data['admin_dark_logo_id'] : '' }}">
                                    <div class="image-box">
                                        <div class="d-flex flex-wrap gap-10 mb-3">
                                            @if (isset($data['admin_dark_logo']))
                                                <div class="preview-image-wrapper">
                                                    <img src="{{ project_asset($data['admin_dark_logo']) }}"
                                                        width="150" class="preview_image"
                                                        id="admin_dark_logo_preview" />
                                                    <button type="button" title="Remove image"
                                                        class="remove-btn style--three" id="admin_dark_logo_remove"
                                                        onclick="removeSelection('#admin_dark_logo_preview,#admin_dark_logo_id,#admin_dark_logo_remove')"><i
                                                            class="icofont-close"></i></button>
                                                </div>
                                            @else
                                                <div class="preview-image-wrapper">
                                                    <img src="{{ project_asset($placeholder_image) }}" width="150"
                                                        class="preview_image" id="admin_dark_logo_preview" />

                                                    <button type="button" title="Remove image"
                                                        class="remove-btn style--three d-none" id="admin_dark_logo_remove"
                                                        onclick="removeSelection('#admin_dark_logo_preview,#admin_dark_logo_id,#admin_dark_logo_remove')"><i
                                                            class="icofont-close"></i></button>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="image-box-actions">
                                            <button type="button" class="btn-link" data-toggle="modal"
                                                data-target="#mediaUploadModal" id="admin_dark_logo_choose"
                                                onclick="setDataInsertableIds('#admin_dark_logo_preview,#admin_dark_logo_id,#admin_dark_logo_remove')">
                                                {{ translate('Choose image') }}
                                            </button>
                                        </div>
                                    </div>
                                    @if ($errors->has('admin_dark_logo'))
                                        <div class="invalid-input">{{ $errors->first('admin_dark_logo') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-row mb-20">
                                <div class="col-md-4">
                                    <label class="font-14 bold black">{{ translate('Admin Dark Logo (Mobile)') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="hidden" name="admin_dark_mobile_logo" id="admin_dark_mobile_logo_id"
                                        value="{{ isset($data['admin_dark_mobile_logo_id']) ? $data['admin_dark_mobile_logo_id'] : '' }}">
                                    <div class="image-box">
                                        <div class="d-flex flex-wrap gap-10 mb-3">
                                            @if (isset($data['admin_dark_mobile_logo']))
                                                <div class="preview-image-wrapper">
                                                    <img src="{{ project_asset($data['admin_dark_mobile_logo']) }}"
                                                        width="150" class="preview_image"
                                                        id="admin_dark_mobile_logo_preview" />
                                                    <button type="button" title="Remove image"
                                                        class="remove-btn style--three" id="admin_dark_mobile_logo_remove"
                                                        onclick="removeSelection('#admin_dark_mobile_logo_preview,#admin_dark_mobile_logo_id,#admin_dark_mobile_logo_remove')"><i
                                                            class="icofont-close"></i></button>
                                                </div>
                                            @else
                                                <div class="preview-image-wrapper">
                                                    <img src="{{ project_asset($placeholder_image) }}" width="150"
                                                        class="preview_image" id="admin_dark_mobile_logo_preview" />

                                                    <button type="button" title="Remove image"
                                                        class="remove-btn style--three d-none"
                                                        id="admin_dark_mobile_logo_remove d-none"
                                                        onclick="removeSelection('#admin_dark_mobile_logo_preview,#admin_dark_mobile_logo_id,#admin_dark_mobile_logo_remove')"><i
                                                            class="icofont-close"></i></button>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="image-box-actions">
                                            <button type="button" class="btn-link" data-toggle="modal"
                                                data-target="#mediaUploadModal" id="admin_dark_mobile_logo_choose"
                                                onclick="setDataInsertableIds('#admin_dark_mobile_logo_preview,#admin_dark_mobile_logo_id,#admin_dark_mobile_logo_remove')">
                                                {{ translate('Choose image') }}
                                            </button>
                                        </div>
                                    </div>
                                    @if ($errors->has('admin_dark_mobile_logo'))
                                        <div class="invalid-input">{{ $errors->first('admin_dark_mobile_logo') }}</div>
                                    @endif
                                </div>
                            </div>
                            <!-- /Admin Logo-->

                            <div class="form-row mb-20">
                                <div class="col-md-4">
                                    <label class="font-14 bold black">{{ translate('Favicon') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="hidden" name="favicon" id="favicon_id"
                                        value="{{ isset($data['favicon_id']) ? $data['favicon_id'] : '' }}">
                                    <div class="image-box">
                                        <div class="d-flex flex-wrap gap-10 mb-3">
                                            @if (isset($data['favicon']))
                                                <div class="preview-image-wrapper">
                                                    <img src="{{ project_asset($data['favicon']) }}" width="150"
                                                        class="preview_image" id="favicon_preview" />
                                                    <button type="button" title="Remove image"
                                                        class="remove-btn style--three" id="favicon_remove"
                                                        onclick="removeSelection('#favicon_preview,#favicon_id,#favicon_remove')"><i
                                                            class="icofont-close"></i></button>
                                                </div>
                                            @else
                                                <div class="preview-image-wrapper">
                                                    <img src="{{ project_asset($placeholder_image) }}" width="150"
                                                        class="preview_image" id="favicon_preview" />

                                                    <button type="button" title="Remove image"
                                                        class="remove-btn style--three d-none" id="favicon_remove"
                                                        onclick="removeSelection('#favicon_preview,#favicon_id,#favicon_remove')"><i
                                                            class="icofont-close"></i></button>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="image-box-actions">
                                            <button type="button" class="btn-link" data-toggle="modal"
                                                data-target="#mediaUploadModal" id="favicon_choose"
                                                onclick="setDataInsertableIds('#favicon_preview,#favicon_id,#favicon_remove')">
                                                {{ translate('Choose image') }}
                                            </button>
                                        </div>
                                    </div>
                                    @if ($errors->has('favicon'))
                                        <div class="invalid-input">{{ $errors->first('favicon') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-row mb-20">
                                <div class="col-md-4">
                                    <label class="font-14 bold black">{{ translate('Default Language') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <select class="default-language form-control" name="default_language"
                                        id="default_language" placeholder="{{ translate('Select default language') }}">
                                        @foreach ($active_langs as $lang)
                                            @if ($lang->status == config('settings.general_status.active'))
                                                <option value="{{ $lang->id }}"
                                                    {{ isset($data['default_language']) && $data['default_language'] == $lang->id ? 'selected' : '' }}>
                                                    {{ $lang->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @if ($errors->has('default_language'))
                                        <div class="invalid-input">{{ $errors->first('default_language') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-row mb-20">
                                <div class="col-md-4">
                                    <label class="font-14 bold black">{{ translate('Select Default Timezone') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <select class="default-timezone form-control" name="default_timezone"
                                        id="default_timezone" placeholder="{{ translate('Select Default Timezone') }}">
                                        @foreach ($tzlist as $tz)
                                            <option value="{{ $tz }}"
                                                {{ isset($data['default_timezone']) && $data['default_timezone'] == $tz ? 'selected' : '' }}>
                                                {{ $tz }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('default_timezone'))
                                        <div class="invalid-input">{{ $errors->first('default_timezone') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-row mb-20">
                                <div class="col-md-4">
                                    <label class="font-14 bold black">{{ translate('Copyright Text') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="editor-wrap">
                                        <textarea name="copyright_text" id="copyright_text">{{ isset($data['copyright_text']) ? $data['copyright_text'] : '' }}</textarea>
                                    </div>
                                    @if ($errors->has('copyright_text'))
                                        <div class="invalid-input">{{ $errors->first('copyright_text') }}</div>
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
    <!-- /General settings form -->
@endsection
@section('custom_scripts')
    <script src="{{ asset('/public/backend/assets/plugins/select2/select2.min.js') }}"></script>
    <!--Editor-->
    <script src="{{ asset('/public/backend/assets/plugins/summernote/summernote-lite.js') }}"></script>
    <!--End Editor-->
    <script type="application/javascript">
    (function($) {
        "use strict";
        initDropzone()
        $(document).ready(function() {
            is_for_browse_file = true
            filtermedia()
            /*Select default language*/
            $('.default-language').select2({
                theme: "classic",
            });
            /*Select default timezone*/
            $('.default-timezone').select2({
                theme: "classic",
            });
            /*Select default currency*/
            $('.default-currency').select2({
                theme: "classic",
            });
            /*Select currency position*/
            $('.currency-position').select2({
                theme: "classic",
            });

            $('#copyright_text').summernote({
                tabsize: 2,
                height: 200,
                codeviewIframeFilter: false,
                codeviewFilter: true,
                codeviewFilterRegex: /<\/*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|ilayer|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|t(?:itle|extarea)|xml)[^>]*>|on\w+\s*=\s*"[^"]*"|on\w+\s*=\s*'[^']*'|on\w+\s*=\s*[^\s>]+/gi,
                toolbar: [
                    ["style", ["style"]],
                    ["font", ["bold", "underline", "clear"]],
                    ["color", ["color"]],
                    ["para", ["ul", "ol", "paragraph"]],
                    ["table", ["table"]],
                    ["insert", ["link", "video"]],
                    ["view", ["fullscreen", "codeview","help"]],
                ],
                placeholder: 'Copyright text',
                callbacks: {
                    onChangeCodeview: function(contents, $editable) {
                        let code = $(this).summernote('code')
                        code = code.replace(
                            /<\/*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|ilayer|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|t(?:itle|extarea)|xml)[^>]*>|on\w+\s*=\s*"[^"]*"|on\w+\s*=\s*'[^']*'|on\w+\s*=\s*[^\s>]+/gi,
                            '')
                        $(this).val(code)
                    }
                }
            });
        })
    })(jQuery);
</script>
@endsection
