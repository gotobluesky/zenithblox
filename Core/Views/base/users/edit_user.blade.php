@php
    $roles = getAllRoleForAssign();
    
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
    {{ translate('Update User') }}
@endsection
@section('custom_css')
    <link rel="stylesheet" href="{{ asset('/public/backend/assets/plugins/select2/select2.min.css') }}">
@endsection
@section('main_content')
    <div class="row">
        <div class="col-md-7 mb-30">
            <!-- Add new user-->
            <div class="card">
                <div class="card-body">
                    <div class="post-head d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center">
                            <div class="content">
                                <h4 class="mb-1">{{ translate('Update User') }}</h4>
                            </div>
                        </div>
                    </div>

                    <div>
                        <form action="{{ route('core.update.user') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <div class="form-row mb-20">
                                <div class="col-md-4">
                                    <label class="font-14 bold black">{{ translate('Profile Picture') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="hidden" name="pro_pic" id="pro_pic_id" value="{{ $user->pro_pic_id }}">
                                    <div class="image-box">
                                        <div class="d-flex flex-wrap gap-10 mb-3">
                                            @if (isset($user->pro_pic))
                                                <div class="preview-image-wrapper">
                                                    <img src="{{ project_asset($user->pro_pic) }}"
                                                        alt="{{ $user->pro_pic_alt }}" width="150" class="preview_image"
                                                        id="pro_pic_preview" />
                                                    <button type="button" title="Remove image"
                                                        class="remove-btn style--three" id="pro_pic_remove"
                                                        onclick="removeSelection('#pro_pic_preview,#pro_pic_id,#pro_pic_remove')"><i
                                                            class="icofont-close"></i></button>
                                                </div>
                                            @else
                                                <div class="preview-image-wrapper">
                                                    <img src="{{ project_asset($placeholder_image) }}" width="150"
                                                        class="preview_image" id="pro_pic_preview" />
                                                    <button type="button" title="Remove image"
                                                        class="remove-btn style--three d-none" id="pro_pic_remove"
                                                        onclick="removeSelection('#pro_pic_preview,#pro_pic_id,#pro_pic_remove')"><i
                                                            class="icofont-close"></i></button>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="image-box-actions">
                                            <button type="button" class="btn-link" data-toggle="modal"
                                                data-target="#mediaUploadModal" id="pro_pic_choose"
                                                onclick="setDataInsertableIds('#pro_pic_preview,#pro_pic_id,#pro_pic_remove')">
                                                {{ translate('Choose image') }}
                                            </button>
                                        </div>
                                    </div>
                                    @if ($errors->has('pro_pic'))
                                        <div class="invalid-input">{{ $errors->first('pro_pic') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-row mb-20">
                                <div class="col-md-4">
                                    <label class="font-14 bold black">{{ translate('Name') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="name" class="theme-input-style"
                                        value="{{ $user->name }}" placeholder="{{ translate('Give your name') }}">
                                    @if ($errors->has('name'))
                                        <div class="invalid-input">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-row mb-20">
                                <div class="col-sm-4">
                                    <label class="font-14 bold black">{{ translate('Email') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="email" name="email" class="theme-input-style"
                                        value="{{ $user->email }}"
                                        placeholder="{{ translate('Give your email address') }}">
                                    @if ($errors->has('email'))
                                        <div class="invalid-input">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                            </div>

                            @if (!$user->hasRole('Super Admin'))
                                <div class="form-row mb-20">
                                    <div class="col-md-4">
                                        <label class="font-14 bold black">{{ translate('Assign Role') }}</label>
                                    </div>
                                    <div class="col-md-8">
                                        <select id='seectRole' name="role[]" class="theme-input-style" multiple>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}" class="text-uppercase"
                                                    {{ userHasRole($user->id, $role->id) ? 'selected' : '' }}>
                                                    {{ $role->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('role'))
                                            <div class="invalid-input">{{ $errors->first('role') }}</div>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            @if (!$user->hasRole('Super Admin'))
                                <div class="form-row mb-20">
                                    <div class="col-md-4">
                                        <label class="font-14 bold black">{{ translate('Status') }}</label>
                                    </div>
                                    <div class="col-md-8">
                                        <label class="switch success">
                                            <input type="checkbox" {{ $user->status == 1 ? 'checked' : '' }}
                                                name="status">
                                            <span class="control"></span>
                                        </label>
                                    </div>
                                </div>
                            @endif

                            <div class="form-row">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn long">{{ translate('Update') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /Add new user-->
        </div>
        @include('core::base.media.partial.media_modal')
    </div>
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


                $('#seectRole').select2({
                    theme: "classic",
                    placeholder: "{{ translate('Select a Role') }}"
                });
            });
        })(jQuery);
    </script>
@endsection
