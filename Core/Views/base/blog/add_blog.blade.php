@php
    $default_language = getDefaultLang();
@endphp
@extends('core::base.layouts.master')

@section('title')
    {{ translate('Add Blog') }}
@endsection

@section('custom_css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('/public/backend/assets/plugins/select2/select2.min.css') }}">
    <!--  End select2  -->
    <!--Editor-->
    <link href="{{ asset('/public/backend/assets/plugins/summernote/summernote-lite.css') }}" rel="stylesheet" />
    <!--End editor-->
    <style>
        .note-frame {
            font-family: "PT Sans", sans-serif;
        }
    </style>
@endsection

@section('main_content')
    <!-- Main Content -->
    <form class="form-horizontal my-4 mb-4" id="blog_form" action="{{ route('core.store.blog') }}" method="post"
        enctype="multipart/form-data">
        @csrf

        <input type="hidden" id="blog_id" name="id" value="">
        <div class="row">
            <div class="col-md-8">
                <div class="mb-3">
                    <p class="alert alert-info">You are inserting
                        <strong>"{{ getLanguageNameByCode(getDefaultLang()) }}"</strong> version
                    </p>
                </div>
                {{-- AI Assistent --}}
                <div class="card mb-30">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-center">
                            <h4 class="font-20">{{ translate('AI Assistent') }}</h4>
                        </div>
                        {{-- Language --}}
                        <div class="form-group row my-4">
                            <label for="editorial_tone" class="col-sm-4 font-14 bold black">{{ translate('Language') }}<span
                                    class="text-danger"> * </span>
                            </label>
                            <div class="col-sm-8">
                                <select class="theme-input-style" id="language" name="language">
                                    <option value="-1"> {{ translate('Select Language') }}</option>
                                    <option value="ar" {{ $default_language == 'ar' ? 'selected' : '' }}>
                                        {{ translate('Arabic') }}</option>
                                    <option value="bg" {{ $default_language == 'bg' ? 'selected' : '' }}>
                                        {{ translate('Bulgarian') }}</option>
                                    <option value="zh" {{ $default_language == 'zh' ? 'selected' : '' }}>
                                        {{ translate('Chinese (Simplified)') }}</option>
                                    <option value="zh-TW" {{ $default_language == 'zh-TW' ? 'selected' : '' }}>
                                        {{ translate('Chinese (Traditional)') }}</option>
                                    <option value="hr" {{ $default_language == 'hr' ? 'selected' : '' }}>
                                        {{ translate('Croatian') }}</option>
                                    <option value="cs" {{ $default_language == 'cs' ? 'selected' : '' }}>
                                        {{ translate('Czech') }}</option>
                                    <option value="da" {{ $default_language == 'da' ? 'selected' : '' }}>
                                        {{ translate('Danish') }}</option>
                                    <option value="nl" {{ $default_language == 'nl' ? 'selected' : '' }}>
                                        {{ translate('Dutch') }}</option>
                                    <option value="en" {{ $default_language == 'en' ? 'selected' : '' }}>
                                        {{ translate('English') }}</option>
                                    <option value="et" {{ $default_language == 'et' ? 'selected' : '' }}>
                                        {{ translate('Estonian') }}</option>
                                    <option value="fi" {{ $default_language == 'fi' ? 'selected' : '' }}>
                                        {{ translate('Finnish') }}</option>
                                    <option value="fr" {{ $default_language == 'fr' ? 'selected' : '' }}>
                                        {{ translate('French') }}</option>
                                    <option value="de" {{ $default_language == 'de' ? 'selected' : '' }}>
                                        {{ translate('German') }}</option>
                                    <option value="el" {{ $default_language == 'el' ? 'selected' : '' }}>
                                        {{ translate('Greek') }}</option>
                                    <option value="he" {{ $default_language == 'he' ? 'selected' : '' }}>
                                        {{ translate('Hebrew') }}</option>
                                    <option value="hi" {{ $default_language == 'hi' ? 'selected' : '' }}>
                                        {{ translate('Hindi') }}</option>
                                    <option value="hu" {{ $default_language == 'hu' ? 'selected' : '' }}>
                                        {{ translate('Hungarian') }}</option>
                                    <option value="is" {{ $default_language == 'is' ? 'selected' : '' }}>
                                        {{ translate('Icelandic') }}</option>
                                    <option value="id" {{ $default_language == 'id' ? 'selected' : '' }}>
                                        {{ translate('Indonesian') }}</option>
                                    <option value="it" {{ $default_language == 'it' ? 'selected' : '' }}>
                                        {{ translate('Italian') }}</option>
                                    <option value="ja" {{ $default_language == 'ja' ? 'selected' : '' }}>
                                        {{ translate('Japanese') }}</option>
                                    <option value="ko" {{ $default_language == 'ko' ? 'selected' : '' }}>
                                        {{ translate('Korean') }}</option>
                                    <option value="lt" {{ $default_language == 'lt' ? 'selected' : '' }}>
                                        {{ translate('Lithuanian') }}</option>
                                    <option value="ms" {{ $default_language == 'ms' ? 'selected' : '' }}>
                                        {{ translate('Malay') }}</option>
                                    <option value="no" {{ $default_language == 'no' ? 'selected' : '' }}>
                                        {{ translate('Norwegian') }}</option>
                                    <option value="pl" {{ $default_language == 'pl' ? 'selected' : '' }}>
                                        {{ translate('Polish') }}</option>
                                    <option value="pt" {{ $default_language == 'pt' ? 'selected' : '' }}>
                                        {{ translate('Portuguese') }}</option>
                                    <option value="ro" {{ $default_language == 'ro' ? 'selected' : '' }}>
                                        {{ translate('Romanian') }}</option>
                                    <option value="ru" {{ $default_language == 'ru' ? 'selected' : '' }}>
                                        {{ translate('Russian') }}</option>
                                    <option value="sl" {{ $default_language == 'sl' ? 'selected' : '' }}>
                                        {{ translate('Slovenian') }}</option>
                                    <option value="es" {{ $default_language == 'es' ? 'selected' : '' }}>
                                        {{ translate('Spanish') }}</option>
                                    <option value="sw" {{ $default_language == 'sw' ? 'selected' : '' }}>
                                        {{ translate('Swahili') }}</option>
                                    <option value="sv" {{ $default_language == 'sv' ? 'selected' : '' }}>
                                        {{ translate('Swedish') }}</option>
                                    <option value="th" {{ $default_language == 'th' ? 'selected' : '' }}>
                                        {{ translate('Thai') }}</option>
                                    <option value="tr" {{ $default_language == 'tr' ? 'selected' : '' }}>
                                        {{ translate('Turkish') }}</option>
                                    <option value="uk" {{ $default_language == 'uk' ? 'selected' : '' }}>
                                        {{ translate('Ukrainian') }}</option>
                                    <option value="vi" {{ $default_language == 'vi' ? 'selected' : '' }}>
                                        {{ translate('Vietnamese') }}</option>
                                </select>
                                <p class="text-danger" id="language_error"></p>
                            </div>
                        </div>
                        {{-- Language --}}

                        {{-- Primary Focus --}}
                        <div class="form-group row my-4">
                            <label for="primary_focus"
                                class="col-sm-4 font-14 bold black">{{ translate('What is the primary focus of your blog') . ' ?' }}<span
                                    class="text-danger"> * </span>
                            </label>
                            <div class="col-sm-8">
                                <textarea name="primary_focus" id="primary_focus" class="form-control primary_focus" value="{{ old('primary_focus') }}"
                                    placeholder="{{ translate('Primary Focus') }}"></textarea>
                                <p class="text-danger" id="primary_focus_error"></p>
                            </div>
                        </div>
                        {{-- Primary Focus --}}

                        {{-- Priority Keywords --}}
                        <div class="form-group row my-4">
                            <label for="priority_keywords"
                                class="col-sm-4 font-14 bold black">{{ translate('Priority Keywords') }}<span
                                    class="text-danger"> * </span>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" name="priority_keywords" id="priority_keywords"
                                    class="form-control priority_keywords" value="{{ old('priority_keywords') }}"
                                    placeholder="{{ translate('Give priority kewords seperated by comma (,)') }}">
                                <p class="text-danger" id="priority_keywords_error"></p>
                            </div>
                        </div>
                        {{-- Primary Focus --}}

                        {{-- Level of creativity --}}
                        <div class="form-group row my-4">
                            <label for="creativity_level"
                                class="col-sm-4 font-14 bold black">{{ translate('Level of creativity') }}<span
                                    class="text-danger"> * </span>
                            </label>
                            <div class="col-sm-8">
                                <select class="theme-input-style" id="creativity_level" name="creativity_level">
                                    <option value="0.9">{{ translate('Extra Ordinary') }}</option>
                                    <option value="0.5">{{ translate('Ordinary') }}</option>
                                    <option value="0.1">{{ translate('Minimal') }}</option>
                                </select>
                            </div>
                        </div>
                        {{-- Level of creativity --}}

                        {{-- Editorial Tone --}}
                        <div class="form-group row my-4">
                            <label for="editorial_tone"
                                class="col-sm-4 font-14 bold black">{{ translate('Editorial tone') }}<span
                                    class="text-danger"> * </span>
                            </label>
                            <div class="col-sm-8">
                                <select class="theme-input-style" id="editorial_tone" name="editorial_tone">
                                    <option value="formal">{{ translate('Formal') }}</option>
                                    <option value="casual">{{ translate('Casual') }}</option>
                                    <option value="humorous">{{ translate('Humorous') }}</option>
                                    <option value="authoritative">{{ translate('Authoritative') }}</option>
                                    <option value="persuasive">{{ translate('Persuasive') }}</option>
                                    <option value="empathetic">{{ translate('Empathetic') }}</option>
                                    <option value="inspirational">{{ translate('Inspirational') }}</option>
                                    <option value="educational">{{ translate('Educational') }}</option>
                                    <option value="witty">{{ translate('Witty') }}</option>
                                    <option value="intimate">{{ translate('Intimate') }}</option>
                                </select>
                            </div>
                        </div>
                        {{-- Editorial Tone --}}

                        {{-- Choose Filed --}}
                        <div class="form-group row my-4">
                            <label
                                class="col-sm-4 font-14 bold black">{{ translate('Choose What You Want To Generate') }}<span
                                    class="text-danger"> * </span>
                            </label>
                            <div class="col-sm-8">
                                <div class="d-flex d-sm-inline-flex align-items-center mr-sm-5 mb-3">
                                    <label class="custom-checkbox position-relative mr-2">
                                        <input type="checkbox" id="blog_title" name="blog_title" class="options">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label for="blog_title">{{ translate('Blog Title') }} </label>
                                </div>
                                <div class="d-flex d-sm-inline-flex align-items-center mr-sm-5 mb-3">
                                    <label class="custom-checkbox position-relative mr-2">
                                        <input type="checkbox" id="short_details" name="short_details" class="options">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label for="short_details">
                                        {{ translate('Blog Short Description') }}
                                    </label>
                                </div>
                                <div class="d-flex d-sm-inline-flex align-items-center">
                                    <label class="custom-checkbox position-relative mr-2">
                                        <input type="checkbox" id="blog_details" name="blog_details" class="options">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label for="blog_details">
                                        {{ translate('Blog Content') }}
                                    </label>
                                </div>
                                <p class="text-danger" id="request_type_error"></p>
                            </div>
                        </div>
                        {{-- Choose Filed --}}

                        {{-- Title Length --}}
                        <div class="form-group row my-4 d-none">
                            <label for="blog_title_length"
                                class="col-sm-4 font-14 bold black">{{ translate('Title Length') }}<span
                                    class="text-danger"> * </span>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" name="blog_title_length" id="blog_title_length"
                                    class="form-control blog_title_length" value="{{ old('blog_title_length') }}"
                                    placeholder="{{ translate('Title Length') }}">
                                <p class="text-danger" id="blog_title_length_error"></p>
                            </div>
                        </div>
                        {{-- Title Length --}}

                        {{-- Short Description Length --}}
                        <div class="form-group row my-4 d-none">
                            <label for="short_details_length"
                                class="col-sm-4 font-14 bold black">{{ translate('Short Details Length') }}<span
                                    class="text-danger"> * </span>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" name="short_details_length" id="short_details_length"
                                    class="form-control short_details_length" value="{{ old('short_details_length') }}"
                                    placeholder="{{ translate('Short Details Length') }}">
                                <p class="text-danger" id="short_details_length_error"></p>
                            </div>
                        </div>
                        {{-- Short Description Length --}}

                        {{-- Content Length --}}
                        <div class="form-group row my-4 d-none">
                            <label for="blog_details_length"
                                class="col-sm-4 font-14 bold black">{{ translate('Content Length') }}<span
                                    class="text-danger"> * </span>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" name="blog_details_length" id="blog_details_length"
                                    class="form-control blog_details_length" value="{{ old('blog_details') }}"
                                    placeholder="{{ translate('Content Length') }}">
                                <p class="text-danger" id="blog_details_length_error"></p>
                            </div>
                        </div>
                        {{-- Content Length --}}

                        <div class="row mx-1 mt-4">
                            <div class="col-sm-3 offset-9 text-right">
                                <img src="{{ asset('/public/loader.svg') }}" alt="loader" class="loader d-none"
                                    width="45px" height="auto">
                                <button type="button" class="btn sm" onclick="generateBlogPost()">
                                    {{ translate('Generate') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- AI Assistent --}}

                <div class="card mb-30">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-center">
                            <h4 class="font-20">{{ translate('Add Blog') }}</h4>
                        </div>

                        {{-- Name Field --}}
                        <div class="form-group row my-4">
                            <label for="name" class="col-sm-2 font-14 bold black">{{ translate('Name') }}<span
                                    class="text-danger"> * </span>
                            </label>
                            <div class="col-sm-10">
                                <input type="text" name="name" id="name" class="form-control blog_name"
                                    value="{{ old('name') }}" placeholder="{{ translate('Name') }}" required>
                                <input type="hidden" name="permalink" id="permalink_input_field" required
                                    value="{{ old('permalink') }}">
                                @if ($errors->has('name'))
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                @endif
                            </div>
                        </div>
                        {{-- Name Field End --}}
                        <!--Permalink-->
                        <div
                            class="form-row my-4 permalink-input-group d-none @if ($errors->has('permalink')) d-flex @endif">
                            <div class="col-sm-2">
                                <label class="font-14 bold black">{{ translate('Permalink') }} </label>
                            </div>
                            <div class="col-sm-10">
                                <a href="#" onclick="blogPreviewDraft('preview')">{{ url('') }}/blog/<span
                                        id="permalink">{{ old('permalink') }}</span><span
                                        class="btn custom-btn ml-1 permalink-edit-btn">{{ translate('Edit') }}</span></a>
                                @if ($errors->has('permalink'))
                                    <p class="text-danger">{{ $errors->first('permalink') }}</p>
                                @endif
                                <div class="permalink-editor d-none">
                                    <input type="text" class="theme-input-style" id="permalink-updated-input"
                                        placeholder="{{ translate('Type here') }}" value="{{ old('permalink') }}">
                                    <button type="button" class="btn long mt-2 btn-danger permalink-cancel-btn"
                                        data-dismiss="modal">{{ translate('Cancel') }}</button>
                                    <button type="button"
                                        class="btn long mt-2 permalink-save-btn">{{ translate('Save') }}</button>
                                </div>
                            </div>
                        </div>
                        <!--Permalink End-->

                        {{-- Short Description Field --}}
                        <div class="form-row mt-5">
                            <label for="short_description"
                                class="col-sm-2 font-14 bold black">{{ translate('Short Description') }}</label>
                            <div class="col-sm-10">
                                <textarea name="short_description" id="short_description" class="theme-input-style h-100"
                                    placeholder="{{ translate('Short Description') }}">{{ old('short_description') }}</textarea>
                            </div>
                        </div>
                        {{-- Short Description Field End --}}

                        {{-- Content Field --}}
                        <div class="form-row mt-5">
                            <label class="col-sm-2 font-14 bold black">{{ translate('Content') }}<span
                                    class="text-danger">
                                    * </span></label>
                            <div class="col-sm-10">
                                <div class="editor-wrap">
                                    <textarea name="content" id="blog_content">{{ old('content') }}</textarea>
                                </div>
                                @if ($errors->has('content'))
                                    <p class="text-danger mt-2"> {{ $errors->first('content') }} </p>
                                @endif
                            </div>
                        </div>
                        {{-- Content Field End --}}

                    </div>
                </div>

                {{-- Seo Information --}}
                <div class="card card-body mb-4">
                    <h4 class="mb-5 font-20">{{ translate('Seo Meta Tags') }}</h4>

                    <div class="form-row mb-20">
                        <div class="col-sm-2">
                            <label class="font-14 bold black ">{{ translate('Meta Title') }} </label>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" name="meta_title" class="theme-input-style"
                                placeholder="{{ translate('Type here') }}" value="{{ old('meta_title') }}">
                        </div>
                    </div>
                    <div class="form-row mb-20">
                        <div class="col-sm-2">
                            <label class="font-14 bold black ">{{ translate('Meta Description') }} </label>
                        </div>
                        <div class="col-sm-10">
                            <textarea class="theme-input-style" name="meta_description">{{ old('meta_description') }}</textarea>
                        </div>
                    </div>
                    <div class="form-row mb-20">
                        <div class="col-sm-2">
                            <label class="font-14 bold black ">{{ translate('Meta Image') }} </label>
                        </div>
                        <div class="col-sm-10">
                            @include('core::base.includes.media.media_input', [
                                'input' => 'meta_image',
                                'data' => old('meta_image'),
                            ])
                            @if ($errors->has('meta_image'))
                                <p class="text-danger">{{ $errors->first('meta_image') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                {{-- Seo Information End --}}

            </div>

            {{-- Add Blog Side Field --}}
            <div class="col-md-4">
                <div class="row px-3">
                    {{-- Publish Section --}}
                    <div class="card card-body col-12 order-last order-md-first mt-5 mt-md-0">
                        <h4 class="font-16">{{ translate('Publish') }}</h4>
                        {{-- Draft,previe,pending button --}}
                        <div class="row my-4 mx-1 justify-content-between ">
                            <div>
                                <a href="#" class="btn btn-dark sm mr-2"
                                    onclick="blogPreviewDraft('draft')">{{ translate('Draft') }}</a>
                                <a href="#" class="btn btn-info sm mr-2"
                                    onclick="blogPreviewDraft('pending')">{{ translate('Pending') }}</a>
                            </div>
                            <a href="#" class="btn sm mr-2"
                                onclick="blogPreviewDraft('preview')">{{ translate('Preview') }}</a>
                        </div>

                        {{-- visibility part --}}
                        <div class="row my-2 mx-1">
                            <i class="icofont-eye icofont-1x"></i>
                            <span class="font-14 black ml-1">{{ translate('Visibility') }} :</span>
                            <span class="font-14 bold black ml-2"
                                id="current_visibility">{{ translate('Public') }}</span>
                            <a href="#" class="btn custom-btn ml-2"
                                id="visibility_edit_button">{{ translate('Edit') }}</a>
                            @if ($errors->has('visibility'))
                                <p class="text-danger">{{ $errors->first('visibility') }}</p>
                            @endif
                        </div>
                        <div class="mx-1 my-2 d-none" id="visibility_form">
                            <input type="radio" checked name="visibility" id="visibility-radio-public"
                                value="public" />
                            <label for="visibility-radio-public" class="selectit">{{ translate('Public') }}</label>
                            <br />

                            <span id="sticky-span" class="ml-4">
                                <input id="sticky" name="sticky" type="checkbox"value="sticky" />
                                <label for="sticky"
                                    class="selectit">{{ translate('Stick this post to the front of blog list page') }}</label><br />
                            </span>

                            <input type="radio" name="visibility" id="visibility-radio-password" value="password" />
                            <label for="visibility-radio-password"
                                class="selectit">{{ translate('Password protected') }}</label>
                            <br />
                            <span id="password-span" class="ml-4">
                                <input type="text" name="blog_password" id="blog_password" value=""
                                    maxlength="10" /><br />
                                <span
                                    class="text-danger my-1 ml-3 font-12 d-block">{{ translate('If Password Field is remain Empty then visibility will be saved as Public.') }}</span>
                            </span>

                            <input type="radio" name="visibility" id="visibility-radio-private" value="private" />
                            <label for="visibility-radio-private"
                                class="selectit">{{ translate('Private') }}</label><br />
                        </div>
                        {{-- visibility part end --}}

                        {{-- publish schedule part --}}
                        <div class="row my-2 mx-1">
                            <i class="icofont-ui-calendar icofont-1x mt-2"></i>
                            <label for="publish_at" class="font-14 black ml-1 mt-2">{{ translate('Publish') }} :</label>
                            <input type="datetime-local" name="publish_at" id="publish_at"
                                class="theme-input-style w-75 ml-2 py-0" value="{{ old('start_date') }}">
                        </div>
                        {{-- publish schedule part end --}}

                        <div class="row mx-1 mt-4">
                            <button type="submit" class="col-sm-4 btn sm">{{ translate('Publish') }}</button>
                        </div>
                    </div>
                    {{-- Publish Section End --}}

                    {{-- Select Formate --}}
                    <div class="card card-body mt-md-5  col-12">
                        <h4 class="font-16">{{ translate('Formate') }}</h4>
                        <div class="mx-1 mt-2">
                            <input type="radio" checked name="formate" id="formate-standard" value="standard" />
                            <label for="formate-standard" class="mb-1">{{ translate('Standard') }}</label>
                            <br />
                            <input type="radio" name="formate" id="formate-video" value="video" />
                            <label for="formate-video" class="mb-1">{{ translate('Video') }}</label>
                            <br />
                            <input type="radio" name="formate" id="formate-audio" value="audio" />
                            <label for="formate-audio" class="mb-1">{{ translate('Audio') }}</label>
                            <br />
                            <input type="radio" name="formate" id="formate-gallery" value="gallery" />
                            <label for="formate-gallery" class="mb-1">{{ translate('Gallery') }}</label>
                        </div>
                    </div>
                    {{-- Select Formate End --}}

                    {{-- Select Category --}}
                    <div class="card card-body mt-5  col-12">
                        <div id="category_select_load">
                            {{-- Ajax Html Load Category --}}
                        </div>
                        @if ($errors->has('categories'))
                            <p class="text-danger my-3 px-3">{{ $errors->first('categories') }}</p>
                        @endif
                    </div>
                    {{-- Select Category End --}}

                    {{-- Select Tags --}}
                    <div class="card card-body mt-5  col-12">
                        <div id="tag_select_load">
                            {{-- Ajax Html Load --}}
                        </div>
                    </div>
                    {{-- Select Tags End --}}

                    {{-- Blog Image --}}
                    <div class="card card-body mt-5  col-12">
                        <h4 class="font-16">{{ translate('Blog Image') }}</h4>
                        <span
                            class="font-14">{{ translate('Preferred size for thumnail image is 1110 × 578 px') }}</span>
                        <div class="form-group row justify-content-center align-items-center mt-4 mx-auto">
                            <div class="col-sm-12">
                                @include('core::base.includes.media.media_input', [
                                    'input' => 'blog_image',
                                    'data' => old('blog_image'),
                                ])
                                @if ($errors->has('blog_image'))
                                    <p class="text-danger">{{ $errors->first('blog_image') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    {{-- Blog Image End --}}

                    {{-- Blog Gallery Image --}}
                    <div class="card card-body mt-5 col-12 d-none" id="galler-images">
                        <h4 class="font-16">{{ translate('Gallery') }}</h4>
                        <span
                            class="font-14">{{ translate('Preferred size for gallery images is 1110 × 578 px') }}</span>
                        <div class="form-group row justify-content-center align-items-center mt-4 mx-auto">
                            <div>
                                @include('core::base.includes.media.media_input_multi_select', [
                                    'input' => 'gallery_images',
                                    'data' => old('gallery_images'),
                                    'indicator' => 1,
                                    'container_id' => '#multi_input_1',
                                ])
                                @if ($errors->has('gallery_images'))
                                    <p class="text-danger">{{ $errors->first('gallery_images') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    {{-- Blog Gallery Image End --}}

                    {{-- Blog Status --}}
                    <div class="card card-body mt-5  col-12">
                        <h4 class="font-16 mb-2">{{ translate('Blog Status') }}</h4>
                        <div class="form-group row my-2">
                            <label for="is_featured"
                                class="col-sm-6 font-14 bold black">{{ translate('Featured Status') }}
                            </label>
                            <div class="col-sm-6">
                                <label class="switch glow primary medium">
                                    <input type="checkbox" name="is_featured">
                                    <span class="control"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    {{-- Blog Status End --}}
                </div>
            </div>
            {{-- Add Blog Side Field End --}}

        </div>

    </form>
    @include('core::base.media.partial.media_modal')
    <!-- End Main Content -->
@endsection


@section('custom_scripts')
    <!--Select2-->
    <script src="{{ asset('/public/backend/assets/plugins/select2/select2.min.js') }}"></script>
    <!--End Select2-->
    <!--Editor-->
    <script src="{{ asset('/public/backend/assets/plugins/summernote/summernote-lite.js') }}"></script>
    <!--End Editor-->

    <script>
        (function($) {
            "use strict";
            initDropzone()
            $(document).ready(function() {
                is_for_browse_file = true
                filtermedia()

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                //Visibility Edit button toggle
                ButtonToggle('#visibility_edit_button', '#visibility_form');
                // Visibility input load
                let visibility = $("input:radio:checked").val();
                updateVisibility(visibility);
                // checked visibility as current
                $('input:radio').click(function() {
                    let visibility = $(this).val();
                    let visibility_text = '';
                    updateVisibility(visibility);
                });

                // category load via ajax
                $.ajax({
                    type: "post",
                    url: '{{ route('core.blog.category.load') }}',
                    success: function(res) {
                        $('#category_select_load').html(res.view);
                        selectPlugin('#category-select'); //select plugin add
                        ButtonToggle('#add_new_category_button', '.category-create-form');

                        $('#add_category_button').on('click', function() {
                            saveCategory();
                        });
                    },
                    error: function(data, textStatus, jqXHR) {
                        toastr.error('Category Loading Failed' + data + textStatus + jqXHR,
                            'ERROR!!');
                    }
                });

                // save category via ajax
                function saveCategory() {
                    let category = $('#category_input').val();
                    if (category == '') {
                        return false;
                    }
                    let permalink = string_to_slug(category);
                    let parent = $('.parentCategorySelect option:selected').val();
                    let selected_categories = $('#category-select').val();

                    $.ajax({
                        type: "post",
                        url: '{{ route('core.blog.category.load') }}',
                        data: {
                            category: category,
                            permalink: permalink,
                            parent: parent,
                        },
                        success: function(res) {
                            if (res.error) {
                                toastr.error(res.error, 'ERROR!!');
                            } else {
                                $('#category_select_load').html(res.view);
                                $('.category-create-form').removeClass('d-none');

                                if (res.id != null) {
                                    selected_categories.push(res.id);
                                    $('#category-select').val(selected_categories);
                                    selectPlugin('#category-select'); //select plugin add
                                }

                                $('#add_category_button').on('click', function() {
                                    saveCategory();
                                });
                                ButtonToggle('#add_new_category_button', '.category-create-form');
                            }
                        },
                        error: function(data, textStatus, jqXHR) {
                            toastr.error('Category Loading Failed', 'ERROR!!');
                        }
                    });
                }

                // tag load via ajax
                $.ajax({
                    type: "post",
                    url: '{{ route('core.blog.tag.load') }}',
                    success: function(res) {

                        $('#tag_select_load').html(res.view);
                        selectPlugin('#tag-select'); //select plugin add
                        ButtonToggle('#add_new_tag_button', '.tag-create-form');

                        $('#add_tag_button').on('click', function() {
                            saveTag();
                        });
                    },
                    error: function(data, textStatus, jqXHR) {
                        toastr.error('Tag Loading Failed', 'ERROR!!');
                    }
                });

                // save Tag via ajax
                function saveTag() {
                    let tag = $('#tag_input').val();
                    if (tag == '') {
                        return false;
                    }
                    let permalink = string_to_slug(tag);
                    let selected_tags = $('#tag-select').val();

                    $.ajax({
                        type: "post",
                        url: '{{ route('core.blog.tag.load') }}',
                        data: {
                            tag: tag,
                            permalink: permalink,
                        },
                        success: function(res) {
                            if (res.error) {
                                toastr.error(res.error, 'ERROR!!');
                            } else {
                                $('#tag_select_load').html(res.view);
                                $('.tag-create-form').removeClass('d-none');

                                if (res.id != null) {
                                    selected_tags.push(res.id);
                                    $('#tag-select').val(selected_tags);
                                    selectPlugin('#tag-select'); //select plugin add
                                }

                                $('#add_tag_button').on('click', function() {
                                    saveTag();
                                });
                                ButtonToggle('#add_new_tag_button', '.tag-create-form');
                            }
                        },
                        error: function(data, textStatus, jqXHR) {
                            toastr.error('Tag Loading Failed', 'ERROR!!');
                        }
                    });
                }

                // SUMMERNOTE INIT
                $('#blog_content').summernote({
                    tabsize: 2,
                    height: 400,
                    fontNames: ['serif'],
                    codeviewIframeFilter: false,
                    codeviewFilter: true,
                    codeviewFilterRegex: /<\/*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|ilayer|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|t(?:itle|extarea)|xml)[^>]*>|on\w+\s*=\s*"[^"]*"|on\w+\s*=\s*'[^']*'|on\w+\s*=\s*[^\s>]+/gi,
                    toolbar: [
                        ["style", ["style"]],
                        ["font", ["bold", "underline", "clear"]],
                        ["color", ["color"]],
                        ["para", ["ul", "ol", "paragraph"]],
                        ["table", ["table"]],
                        ["insert", ["link", "picture", "video"]],
                        ["view", ["fullscreen", "codeview", "help"]],
                    ],
                    placeholder: 'Blog Content',
                    callbacks: {
                        onImageUpload: function(images, editor, welEditable) {
                            sendFile(images[0], editor, welEditable);
                        },
                        onChangeCodeview: function(contents, $editable) {
                            let code = $(this).summernote('code')
                            code = code.replace(
                                /<\/*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|ilayer|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|t(?:itle|extarea)|xml)[^>]*>|on\w+\s*=\s*"[^"]*"|on\w+\s*=\s*'[^']*'|on\w+\s*=\s*[^\s>]+/gi,
                                '')
                            $(this).val(code)
                        }
                    }
                });

                // selectplugin in language list
                selectPlugin('#language');
            });

            // Gallery Image Field
            $(document).on('click', 'input[name="formate"]', function() {
                let formate = $(this).val();
                if (formate === 'gallery') {
                    $('#galler-images').removeClass('d-none');
                } else {
                    $('#galler-images').addClass('d-none');
                }
            });


            // Option select and field appear
            $(document).on('change', '.options', function() {
                let option = $(this).attr('id');
                if ($(this).is(':checked')) {
                    $('#' + option + '_length').parents(':eq(1)').removeClass('d-none');
                } else {
                    $('#' + option + '_length').val('');
                    $('#' + option + '_length').parents(':eq(1)').addClass('d-none');
                }
            })

            /*Generate permalink*/
            $(".blog_name").change(function(e) {
                e.preventDefault();
                let name = DOMPurify.sanitize($(".blog_name").val());
                let permalink = string_to_slug(name);
                $("#permalink").html(permalink);
                $("#permalink_input_field").val(permalink);
                $(".permalink-input-group").removeClass("d-none");
                $(".permalink-editor").addClass("d-none");
                $(".permalink-edit-btn").removeClass("d-none");
            });
            /*edit permalink*/
            $(".permalink-edit-btn").on("click", function(e) {
                e.preventDefault();
                let permalink = $("#permalink").html();
                $("#permalink-updated-input").val(permalink);
                $(".permalink-edit-btn").addClass("d-none");
                $(".permalink-editor").removeClass("d-none");
            });
            /*Cancel permalink edit*/
            $(".permalink-cancel-btn").on("click", function(e) {
                e.preventDefault();
                $("#permalink-updated-input").val();
                $(".permalink-editor").addClass("d-none");
                $(".permalink-edit-btn").removeClass("d-none");
            });
            /*Update permalink*/
            $(".permalink-save-btn").on("click", function(e) {
                e.preventDefault();
                let input = $("#permalink-updated-input").val();
                let updated_permalnk = string_to_slug(input);
                $("#permalink_input_field").val(updated_permalnk);
                $("#permalink").html(updated_permalnk);
                $(".permalink-editor").addClass("d-none");
                $(".permalink-edit-btn").removeClass("d-none");
            });
        })(jQuery);

        /**
         * Generate slug
         *
         */
        function string_to_slug(str) {
            "use strict";
            str = str.replace(/^\s+|\s+$/g, ""); // trim
            str = str.toLowerCase();
            // remove accents, swap ñ for n, etc
            var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
            var to = "aaaaeeeeiiiioooouuuunc------";
            for (var i = 0, l = from.length; i < l; i++) {
                str = str.replace(new RegExp(from.charAt(i), "g"), to.charAt(i));
            }

            str = str
                .replace(/\s+/g, "-") // collapse whitespace and replace by -
                .replace(/-+/g, "-") // collapse dashes
                .replace(/[^\w\s\d\u00C0-\u1FFF\u2C00-\uD7FF\-\_]/g, "-");

            return str;
        }

        // select plugin -- function
        function selectPlugin(element) {
            "use strict";
            $(element).select2({
                theme: "classic",
                placeholder: '{{ translate('No Option Selected') }}',
            });
        }

        // add new buttonn toogle -- function
        function ButtonToggle(button, form) {
            "use strict";
            $(button).on('click', function() {
                $(form).toggleClass('d-none');
            });
        }

        // Visibility Input dynamic
        function updateVisibility(visibility) {
            "use strict";
            // Show sticky for public posts.
            if (visibility != 'public') {
                $('#sticky').prop('checked', false);
                $('#sticky-span').hide();
            } else {
                $('#sticky-span').show();
            }
            // Show password input field for password protected post.
            if (visibility != 'password') {
                $('#password-span').hide();
            } else {
                $('#password-span').show();
            }
            let visibility_text;
            switch (visibility) {
                case 'public':
                    visibility_text = '{{ translate('Public') }}';
                    break;
                case 'private':
                    visibility_text = '{{ translate('Private') }}';
                    break;
                case 'password':
                    visibility_text = '{{ translate('Password') }}';
                    break;
            }
            $('#current_visibility').text(visibility_text);
        }


        // Blog preview and draft
        function blogPreviewDraft(action) {
            "use strict";
            var formData = $('#blog_form').serializeArray();
            formData.push({
                name: "action",
                value: action
            });

            $.ajax({
                method: 'POST',
                url: '{{ route('core.blog.draft.preview') }}',
                dataType: 'json',
                data: formData
            }).done(function(response) {
                if (response.error) {
                    toastr.error(response.error, "Error!");
                } else {
                    switch (action) {
                        case 'draft':
                            $('#blog_id').val(response.id);
                            toastr.success(response.success, "Success!");
                            break;

                        case 'preview':
                            $('#blog_id').val(response.id);
                            window.open('{{ route('core.blog.preview') }}?name=' + response.permalink);
                            break;

                        case 'pending':
                            $('#blog_id').val(response.id);
                            toastr.info(response.success, "Success!");
                            break;

                        default:
                            toastr.error(response.error, "Error!");
                            break;
                    }
                }
            });
        }

        // send file function summernote
        function sendFile(image, editor, welEditable) {
            "use strict";
            let imageUploadUrl = '{{ route('core.blog.content.image') }}';
            let data = new FormData();
            data.append("image", image);

            $.ajax({
                data: data,
                type: "POST",
                url: imageUploadUrl,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {

                    if (data.url) {
                        var image = $('<img>').attr('src', data.url);
                        $('#blog_content').summernote("insertNode", image[0]);
                    } else {
                        toastr.error(data.error, "Error!");
                    }

                },
                error: function(data) {
                    toastr.error('Image Upload Failed', "Error!");
                }
            });
        }

        /**
         *  Will request ai to generate blog post 
         */
        function generateBlogPost() {
            "use strict";
            flash();
            $('.loader').removeClass('d-none').next().attr('disabled', true);

            let primary_focus = DOMPurify.sanitize($('#primary_focus').val());
            let priority_keywords = DOMPurify.sanitize($('#priority_keywords').val());
            let creativity_level = DOMPurify.sanitize($('#creativity_level').val());
            let editorial_tone = DOMPurify.sanitize($('#editorial_tone').val());
            let blog_title = $('#blog_title').is(':checked');
            let short_details = $('#short_details').is(':checked');
            let blog_details = $('#blog_details').is(':checked');
            let title_length = $('#blog_title_length').val();
            let short_details_length = $('#short_details_length').val();
            let content_length = $('#blog_details_length').val();
            let default_lang = $('#language').val();

            $.ajax({
                data: {
                    '_token': '{{ csrf_token() }}',
                    'primary_focus': primary_focus,
                    'priority_keywords': priority_keywords,
                    'creativity_level': creativity_level,
                    'editorial_tone': editorial_tone,
                    'blog_title': blog_title,
                    'short_details': short_details,
                    'blog_details': blog_details,
                    'title_length': title_length,
                    'short_details_length': short_details_length,
                    'content_length': content_length,
                    'lang': default_lang
                },
                type: "POST",
                url: '{{ route('core.blog.generate.content.with.ai') }}',
                success: function(response) {
                    if (response.success) {
                        if (blog_details == true) {
                            let content = response.blog_details.replace(/^\n+/g, "").replace(/\n/g, '<br>')
                                .trim();
                            $('#blog_content').summernote('code', content);
                        }
                        if (short_details == true) {
                            let content = response.short_details
                            $('#short_description').val(content);
                        }
                        if (blog_title == true) {
                            let content = response.blog_title
                            $('#name').val(content);
                        }
                    }
                },
                error: function(xhr, status, error) {
                    let response = xhr.responseJSON
                    if (!response.hasOwnProperty('errors')) {
                        toastr.error(response.message, "Error!");
                    } else {
                        let errors = response.errors;
                        for (var field in errors) {
                            if (field == 'primary_focus') {
                                var message = errors[field][0];
                                $('#primary_focus_error').html(message)
                            }
                            if (field == 'priority_keywords') {
                                var message = errors[field][0];
                                $('#priority_keywords_error').html(message)
                            }
                            if (field == 'content_length') {
                                $('#blog_details_length_error').html(errors[field][0])
                            }
                            if (field == 'title_length') {
                                $('#blog_title_length_error').html(errors[field][0])
                            }
                            if (field == 'short_details_length') {
                                $('#short_details_length_error').html(errors[field][0])
                            }
                            if (field == 'request_type') {
                                var message = errors[field][0];
                                $('#request_type_error').html(message)
                            }
                            if (field == 'language') {
                                var message = errors[field][0];
                                $('#language_error').html(message)
                            }
                        }
                        toastr.error('Unable to generate content', "Error!");
                    }
                },
                complete: function(param) {
                    $('.loader').addClass('d-none').next().attr('disabled', false);
                }
            });
        }

        /**
         * Flush error records
         */
        function flash() {
            'use strict'
            $('#primary_focus_error').html('')
            $('#priority_keywords_error').html('')
            $('#blog_details_length_error').html('')
            $('#blog_title_length_error').html('')
            $('#short_details_length_error').html('')
            $('#request_type_error').html('')
            $('#language_error').html('')
        }
    </script>
@endsection
