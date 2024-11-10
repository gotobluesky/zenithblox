@php
    $roles = getAllRoleForAssign();
    
    $placeholder_info = getPlaceHolderImage();
    $placeholder_image = '';
    $placeholder_image_alt = '';
    
    if ($placeholder_info != null) {
        $placeholder_image = $placeholder_info->placeholder_image;
        $placeholder_image_alt = $placeholder_info->placeholder_image_alt;
    }
    $socials = null;
    $bio = '';
    $social_enable = false;
    if ($user->info) {
        $bio = $user->info->bio;
        if($user->info->custom_social != 0){
            $socials = json_decode($user->info->social);
            $social_enable = true;
        }
    }
@endphp
@extends('core::base.layouts.master')
@section('title')
    {{ translate('Update User') }}
@endsection
@section('custom_css')
    <!--==== Font-Awesome css file ====-->
    <link rel="stylesheet" href="{{ asset('themes/default/public/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/default/public/assets/dist/css/fontawesome-iconpicker.min.css') }}">
    {{-- Jqueey UI CSS --}}
    <link href="{{ asset('/public/backend/assets/plugins/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet">
    <style>
        /* Switch styles change and over wrrite for text inside */
        .switch {
            width: 100px !important;
        }

        .switch .control {
            height: 35px !important;
            width: 100px !important;
            padding-top: 6px !important;
        }

        .switch .control .switch-on {
            display: none !important;
        }

        .switch .control .switch-off {
            margin-left: 40px !important;
            font-weight: 800 !important;
            color: #FFFFFF !important;
        }

        .switch .control:after {
            width: 35px !important;
            height: 35px !important;
        }

        .switch input:checked~.control:after {
            width: 35px !important;
            height: 35px !important;
        }

        .switch input:checked~.control .switch-off {
            display: none !important;
        }

        .switch input:checked~.control .switch-on {
            display: block !important;
            margin-left: 20px !important;
            font-weight: 800 !important;
            color: #1d1c1c !important;
        }

        .switch input:checked~.control:after {
            left: 75px !important;
        }


        /* Social Style */
        .iconpicker-container .fade.in {
            opacity: 1;
        }

        .social-slide-placeholder {
            height: 40px;
            background: #fad390;
        }

        .ui-accordion .ui-accordion-content {
            overflow: visible;
        }

        .ui-widget-content {
            background: #FFFFFF;
        }

        .ui-state-default {
            background: #FFFFFF;
        }

        /* Social Style End*/
    </style>
@endsection
@section('main_content')
    <div class="row">
        <div class="col-md-8 mb-30 offset-md-2">
            <!-- User profile-->
            <div class="card">
                <div class="card-body">
                    <div class="post-head d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center">
                            <div class="content">
                                <h4 class="mb-1">{{ translate('Update Profile') }}</h4>
                            </div>
                        </div>
                    </div>

                    <div>
                        <form action="{{ route('core.update.profile') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <input type="hidden" name="is_for_profile" value="true">
                            <div class="form-row mb-20">
                                <div class="col-md-4">
                                    <label class="font-14 bold black">{{ translate('Profile Picture') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="hidden" name="pro_pic" id="pro_pic_id" value="{{ $user->pro_pic_id }}">
                                    <div class="image-box">
                                        <div class="d-flex flex-wrap gap-10 mb-3">
                                            @if ($user->pro_pic)
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
                                <div class="col-md-4">
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

                            <div class="form-row mb-20">
                                <div class="col-md-4">
                                    <label class="font-14 bold black">{{ translate('Biography') }}</label>
                                    <br>
                                    <small>{{ translate('Not more than 200 characters') }}</small>
                                </div>
                                <div class="col-md-8">
                                    <textarea name="bio" id="bio" class="theme-input-style style--two"
                                        placeholder="{{ translate('Give you biography') }}">{{ $bio }}</textarea>
                                        <small>{{ translate('Transalate to another language') }} <a
                                            href="{{ route('core.languages') }}">{{ translate('click here') }}.</a></small>
                                    @if ($errors->has('bio'))
                                        <div class="invalid-input">{{ $errors->first('bio') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-row mb-20">
                                <div class="col-md-4">
                                    <label class="font-14 bold black">{{ translate('Old Password') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="password" name="old_password" class="theme-input-style"
                                        placeholder="{{ translate('Old password') }}">
                                    @if ($errors->has('old_password'))
                                        <div class="invalid-input">{{ $errors->first('old_password') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-row mb-20">
                                <div class="col-md-4">
                                    <label class="font-14 bold black">{{ translate('Password') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="password" name="password" class="theme-input-style"
                                        placeholder="{{ translate('Give your password') }}">
                                    @if ($errors->has('password'))
                                        <div class="invalid-input">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-row mb-20">
                                <div class="col-md-4">
                                    <label class="font-14 bold black">{{ translate('Confirm Password') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="password" name="password_confirmation" class="theme-input-style"
                                        placeholder="{{ translate('Confirm your password') }}">
                                    @if ($errors->has('password_confirmation'))
                                        <div class="invalid-input">{{ $errors->first('password_confirmation') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row py-3 border-bottom">
                                <div class="col-md-4">
                                    <label class="font-16 bold black">{{ translate('Social Info') }}
                                    </label>
                                    <small
                                        class="d-block">{{ translate('Set the default social from theme option or make custom social.') }}</small>
                                </div>
                                <div class="col-md-6 offset-md-1">
                                    <label class="switch success">
                                        <input type="hidden" name="custom_author_social" value="0">
                                        <input type="checkbox" name="custom_author_social" id="custom_author_social"
                                            value="1" @checked($social_enable)>
                                        <span class="control" id="custom_author_social_switch">
                                            <span class="switch-off">Default</span>
                                            <span class="switch-on">Custom</span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row py-3" id="custom_author_social_switch_on_field">
                                <div class="col-md-8 offset-md-4">
                                    <div id="socialAccordion">
                                        {{-- if Social is empty a default slide will be here --}}
                                        @if (isset($socials))
                                            @foreach ($socials as $social)
                                                <div class="accordion-item my-2">
                                                    <h2 class="accordion-header" id="headingOne">
                                                        <button class="accordion-button  bg-transparent">
                                                            {{ $social->social_icon_title == '' ? translate('New Slide') : $social->social_icon_title }}
                                                        </button>
                                                    </h2>
                                                    <div class="accordion-body row">
                                                        <div class="col-md-12">
                                                            <input type="text" name="social_icon_title[]"
                                                                class="form-control icon_title my-3"
                                                                placeholder="{{ translate('Title') }}"
                                                                value="{{ $social->social_icon_title }}">

                                                            <input type="text" name="social_icon[]"
                                                                class="form-control icon-picker my-3"
                                                                placeholder="{{ translate('Icon(example: fa fa-facebook)') }}"
                                                                value="{{ $social->social_icon }}">

                                                            <input type="text" name="social_icon_url[]"
                                                                class="form-control my-3"
                                                                placeholder="{{ translate('Url') }}"
                                                                value="{{ $social->social_icon_url }}">
                                                        </div>
                                                        <div class="col-md-12 offset-md-10">
                                                            <button type="button"
                                                                class="btn btn-danger accordion-delete sm">{{ translate('Delete') }}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="accordion-item my-2">
                                                <h2 class="accordion-header" id="headingOne">
                                                    <button class="accordion-button  bg-transparent">
                                                        {{ translate('New Slide') }}
                                                    </button>
                                                </h2>
                                                <div class="accordion-body row">
                                                    <div class="col-md-12">
                                                        <input type="text" name="social_icon_title[]"
                                                            class="form-control icon_title my-3"
                                                            placeholder="{{ translate('Title') }}">

                                                        <input type="text" name="social_icon[]"
                                                            class="form-control icon-picker my-3"
                                                            placeholder="{{ translate('Icon(example: fa fa-facebook)') }}">

                                                        <input type="text" name="social_icon_url[]"
                                                            class="form-control my-3"
                                                            placeholder="{{ translate('Url') }}">
                                                    </div>
                                                    <div class="col-md-12 offset-md-10">
                                                        <button type="button"
                                                            class="btn btn-danger accordion-delete sm">{{ translate('Delete') }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="row justify-content-end mr-2 mt-4">
                                        <button type="button" id="addSlide"
                                            class="btn btn-dark sm">{{ translate('Add Slide') }}</button>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn long">{{ translate('Update') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /User profile-->

            @include('core::base.media.partial.media_modal')

        </div>
    </div>
@endsection
@section('custom_scripts')
    {{-- Jqueey UI Js --}}
    <script src="{{ asset('/public/backend/assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

    {{-- Fontawesome iconpicker js --}}
    <script src="{{ asset('themes/default/public/assets/dist/js/fontawesome-iconpicker.min.js') }}"></script>

    <script>
        (function($) {
            "use strict";
            initDropzone()
            $(document).ready(function() {

                is_for_browse_file = true
                enable_multiple_file_select = true
                filtermedia()

                $("#socialAccordion")
                    .accordion({
                        collapsible: true,
                        header: "> div > h2",
                        dropOnEmpty: true,
                        autoHeight: true,
                        active: false
                    })
                    .sortable({
                        axis: "y",
                        placeholder: 'social-slide-placeholder',
                        revert: "invalid",
                        update: function(event, ui) {
                            let selectedSidebar = $(this).attr('id');
                        }
                    });

                socialSlideEvent();

                $('#addSlide').click(function() {
                    let newSlide = newSocialSlide();
                    $('#socialAccordion').append(newSlide);
                    $('#socialAccordion').accordion("refresh");
                    $('#socialAccordion').sortable("refresh");
                    socialSlideEvent();
                });


                let field;
                if (!$('#custom_author_social').is(":checked")) {
                    field = $('#custom_author_social_switch_on_field').detach();
                }
                $('#custom_author_social_switch').click(function() {
                    if ($('#custom_author_social_switch_on_field').length == 1) {
                        field = $('#custom_author_social_switch_on_field').detach();
                    } else {
                        $('#custom_author_social_switch').parents(':eq(2)').after(field);
                    }
                });
            });
            // social slide append (social)
            function newSocialSlide() {
                let html = `
                        <div class="accordion-item my-2">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button bg-transparent">
                                    {{ translate('New Slide') }}
                                </button>
                            </h2>
                            <div class="accordion-body row">
                                <div class="col-md-12">
                                    <input type="text" name="social_icon_title[]" class="form-control icon_title my-3"
                                        placeholder="{{ translate('Title') }}">

                                    <input type="text" name="social_icon[]" class="form-control icon-picker my-3"
                                        placeholder="{{ translate('Icon(example: fa fa-facebook)') }}">

                                    <input type="text" name="social_icon_url[]" class="form-control my-3"
                                        placeholder="{{ translate('Url') }}">
                                </div>
                                <div class="col-md-12 offset-md-10">
                                    <button type="button"
                                        class="btn btn-danger accordion-delete sm">{{ translate('Delete') }}</button>
                                </div>
                            </div>
                        </div>
                        `;
                return html;
            }

            //initialize social slide events (social)
            function socialSlideEvent() {
                // icon picker init
                $('.icon-picker').iconpicker();
                $('.iconpicker-item').click(function(e) {
                    e.preventDefault();
                });

                $('.icon_title').on('input', function() {
                    let title = $(this).val();
                    $(this).parents(':eq(2)').find('.accordion-button').text(title);
                });

                $('.accordion-delete').click(function() {
                    if ($('.accordion-item').length == 1) {} else {
                        $(this).parents(':eq(2)').remove();
                    }
                });

                $('#socialAccordion').on('accordionactivate', function(event, ui) {
                    if (ui.newPanel.length) {
                        $('#socialAccordion').sortable('disable');
                    } else {
                        $('#socialAccordion').sortable('enable');
                    }
                });
            }

        })(jQuery);
    </script>
@endsection
