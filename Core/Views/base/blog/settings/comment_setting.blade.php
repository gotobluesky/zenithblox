@php
    $data = commentFormSettings();
@endphp
@extends('core::base.layouts.master')

@section('title')
    {{ translate('Comment Setting') }}
@endsection

@section('custom_css')
    <style>
        #small_field {
            width: 65px;
        }

        .small_select {
            width: 65px;
        }
    </style>
@endsection

@section('main_content')
    <form action="{{ route('core.blog.comment.setting.update') }}" method="post">
        @csrf
        <div class="card">
            <div class="card-header px-3 py-4">
                <h3 class="font-24">{{ translate('Comment Setting') }}</h3>
            </div>
            <div class="card-body">
                <div class="row mb-5">

                    {{-- Default Setting Section --}}
                    <div class="col-md-12 row my-3">
                        <div class="col-md-3 mb-2">
                            <span class="font-16 black bold">{{ translate('Default Blog settings') }}</span>
                        </div>
                        <div class="col-md-9">
                            <input type="checkbox" class="mb-2" name="default_comment_status" id="default_comment_status"
                                value="1" {{ $data['default_comment_status'] == 1 ? 'checked' : '' }}>
                            <label class="black mb-3 d-inline"
                                for="default_comment_status">{{ translate('Allow people to submit comments on new blogs') }}</label><br>
                        </div>
                    </div>
                    {{-- Default Setting Section End --}}


                    {{-- Other Comment Settings Section --}}
                    <div class="col-md-12 row my-3">
                        <div class="col-md-3 mb-2">
                            <span class="font-16 black bold">{{ translate('Other comment settings') }}</span>
                        </div>
                        <div class="col-md-9">
                            <div class="mb-3">
                                <input type="checkbox" class="" name="require_name_email" id="require_name_email"
                                    value="1" {{ $data['require_name_email'] == 1 ? 'checked' : '' }}>
                                <label for="require_name_email"
                                    class="black d-inline">{{ translate('Comment author must fill out name and email') }}</label>
                            </div>

                            <div class="mb-3">
                                <input type="checkbox" class="" name="comment_registration" id="comment_registration"
                                    value="1" {{ $data['comment_registration'] == 1 ? 'checked' : '' }}>
                                <label for="comment_registration"
                                    class="black d-inline">{{ translate('Users must be registered and logged in to comment') }}</label>
                            </div>

                            <div class="mb-3">
                                <input type="checkbox" class="" name="close_comments_for_old_blogs"
                                    id="close_comments_for_old_blogs" value="1"
                                    {{ $data['close_comments_for_old_blogs'] == 1 ? 'checked' : '' }}>
                                <label for="close_comments_for_old_blogs" class="black d-inline">
                                    {{ translate('Automatically close comments on blogs older than') }}
                                    <input type="number" name="close_comments_days_old" step="1" min="0"
                                        id="small_field" value="{{ $data['close_comments_days_old'] }}">
                                    {{ translate('days') }}
                                </label>
                                @if ($errors->has('close_comments_days_old'))
                                    <p class="text-danger my-1">{{ $errors->first('close_comments_days_old') }}</p>
                                @endif
                            </div>

                            <div class="mb-3">
                                <input type="checkbox" class="" name="thread_comments" id="thread_comments"
                                    value="1" {{ $data['thread_comments'] == 1 ? 'checked' : '' }}>
                                <label for="thread_comments"
                                    class="black d-inline">{{ translate('Enable threaded (nested) comments') }}
                                    <select name="thread_comments_level" id="" class="small_select black">
                                        <option value="2"
                                            {{ $data['thread_comments_level'] == '2' ? 'selected' : '' }}>2
                                        </option>
                                        <option value="3"
                                            {{ $data['thread_comments_level'] == '3' ? 'selected' : '' }}>3
                                        </option>
                                        <option value="4"
                                            {{ $data['thread_comments_level'] == '4' ? 'selected' : '' }}>4
                                        </option>
                                        <option value="5"
                                            {{ $data['thread_comments_level'] == '5' ? 'selected' : '' }}>5
                                        </option>
                                        <option value="6"
                                            {{ $data['thread_comments_level'] == '6' ? 'selected' : '' }}>6
                                        </option>
                                        <option value="7"
                                            {{ $data['thread_comments_level'] == '7' ? 'selected' : '' }}>7
                                        </option>
                                        <option value="8"
                                            {{ $data['thread_comments_level'] == '8' ? 'selected' : '' }}>8
                                        </option>
                                        <option value="9"
                                            {{ $data['thread_comments_level'] == '9' ? 'selected' : '' }}>9
                                        </option>
                                        <option value="10"
                                            {{ $data['thread_comments_level'] == '10' ? 'selected' : '' }}>
                                            10
                                        </option>
                                    </select>
                                    {{ translate('levels deep') }}
                                </label>
                                @if ($errors->has('thread_comments_level'))
                                    <p class="text-danger my-1">{{ $errors->first('thread_comments_level') }}</p>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="page_comments" class="black d-inline">
                                    <input type="checkbox" class="" name="page_comments" id="page_comments"
                                        value="1" {{ $data['page_comments'] == 1 ? 'checked' : '' }}>
                                    {{ translate('Break comments into pages with') }}
                                    <input type="number" name="comments_per_page" step="1" id="small_field"
                                        value="{{ $data['comments_per_page'] }}">
                                    {{ translate('top level comments per page and') }}
                                    <br>
                                    {{ translate('Comments should be displayed with the') }}
                                    <select name="comment_order" id="" class="small_select black">
                                        <option value="2" {{ $data['comment_order'] == '2' ? 'selected' : '' }}>
                                            {{ translate('older') }}</option>
                                        <option value="1" {{ $data['comment_order'] == '1' ? 'selected' : '' }}>
                                            {{ translate('newer') }}</option>
                                    </select>
                                    {{ translate('comments at the top of each page') }}
                                </label>
                                <br>
                                @if ($errors->has('comments_per_page'))
                                    <p class="text-danger my-1">{{ $errors->first('comments_per_page') }}</p>
                                @endif
                                @if ($errors->has('default_comments_page'))
                                    <p class="text-danger my-1">{{ $errors->first('default_comments_page') }}</p>
                                @endif
                                @if ($errors->has('comment_order'))
                                    <p class="text-danger my-1">{{ $errors->first('comment_order') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    {{-- Other Comment Settings Section End --}}

                    {{-- Email me whenever Section --}}
                    <div class="col-md-12 row my-3">
                        <div class="col-md-3 mb-2">
                            <span class="font-16 black bold">{{ translate('Email me whenever') }}</span>
                        </div>
                        <div class="col-md-9">
                            <input type="checkbox" class="mb-3" name="comments_notify_email" id="comments_notify_email"
                                value="1" {{ $data['comments_notify_email'] == 1 ? 'checked' : '' }}>
                            <label for="comments_notify_email"
                                class="black d-inline">{{ translate('Anyone posts a comment') }}</label><br>

                            <input type="checkbox" class="mb-2" name="comments_moderation_notify_email"
                                id="comments_moderation_notify_email" value="1"
                                {{ $data['comments_moderation_notify_email'] == 1 ? 'checked' : '' }}>
                            <label for="comments_moderation_notify_email"
                                class="black d-inline">{{ translate('A comment is held for moderation') }}</label><br>
                        </div>
                    </div>
                    {{-- Email me whenever Section End --}}

                    {{-- Before a Comment Appears Section --}}
                    <div class="col-md-12 row my-3">
                        <div class="col-md-3 mb-2">
                            <span class="font-16 black bold">{{ translate('Before a comment appears') }}</span>
                        </div>
                        <div class="col-md-9">
                            <input type="checkbox" class="mb-3" name="comment_moderation" id="comment_moderation"
                                value="1" {{ $data['comment_moderation'] == 1 ? 'checked' : '' }}>
                            <label for="comment_moderation"
                                class="black d-inline">{{ translate('Comment must be manually approved') }}</label><br>

                            <input type="checkbox" class="mb-2" name="comment_previously_approved"
                                id="comment_previously_approved" value="1"
                                {{ $data['comment_previously_approved'] == 1 ? 'checked' : '' }}>
                            <label for="comment_previously_approved"
                                class="black d-inline">{{ translate('Comment author must have a previously approved comment') }}</label><br>
                        </div>
                    </div>
                    {{-- Before a Comment Appears Section End --}}

                    {{-- Comment Moderation Section --}}
                    <div class="col-md-12 row mt-5">
                        <div class="col-md-3 mb-2">
                            <span class="font-16 black bold">{{ translate('Comment Moderation') }}</span>
                        </div>
                        <div class="col-md-9">
                            <p class="black mb-2">{{ translate('Hold a comment in the queue if it contains') }}
                                <input type="number" name="comment_max_links" step="1" id="small_field"
                                    value="{{ $data['comment_max_links'] }}">
                                {{ translate('or more links. (A common characteristic of comment spam is a large number of hyperlinks.)') }}
                            </p>
                            @if ($errors->has('comment_max_links'))
                                <p class="text-danger my-1">{{ $errors->first('comment_max_links') }}</p>
                            @endif
                            <p class="black">
                                {{ translate('When a comment contains any of these words in its content, author name, URL, email, IP address, or browser’s user agent string, it will be held in the ') }}<a
                                    href="{{ route('core.blog.comment') . '?status=pending' }}">{{ translate('pending queue') }}</a>
                                {{ translate('One word or IP address per line. It will match inside words, so “press” will match “WordPress”.') }}
                            </p>
                            <textarea name="comment_moderation_keys" id="comment_textarea" class="theme-input-style style--two" rows="5">{{ $data['comment_moderation_keys'] }}</textarea>
                        </div>
                    </div>
                    {{-- Comment Moderation Section End --}}

                    {{-- Disallowed Comment Keys Section --}}
                    <div class="col-md-12 row mt-5">
                        <div class="col-md-3 mb-2">
                            <span class="font-16 black bold">{{ translate('Disallowed Comment Keys') }}</span>
                        </div>
                        <div class="col-md-9">
                            <p class="black">
                                {{ translate('When a comment contains any of these words in its content, author name, URL, email, IP address, or browser’s user agent string, it will be put in the Trash. One word or IP address per line. It will match inside words, so “press” will match “WordPress”.') }}
                            </p>
                            <textarea name="comment_disallowed_keys" id="comment_textarea" class="theme-input-style style--two" rows="5">{{ $data['comment_disallowed_keys'] }}</textarea>
                        </div>
                    </div>
                    {{-- Disallowed Comment Keys Section End --}}

                    {{-- Avatar Section --}}
                    <div class="col-md-12 row my-4">
                        <div class="col-md-12">
                            <span class="font-16 black bold">{{ translate('Avatars') }}</span>
                            <p class="mt-4 black">
                                {{ translate('An avatar is an image that can be associated with a user across multiple websites. In this area, you can choose to display avatars of users who interact with the site.') }}
                            </p>
                        </div>
                    </div>
                    {{-- Avatar Section End --}}

                    {{-- Avatar Display Section --}}
                    <div class="col-md-12 row my-3">
                        <div class="col-md-3 mb-2">
                            <span class="font-16 black bold">{{ translate('Avatar Display') }}</span>
                        </div>
                        <div class="col-md-9">
                            <input type="checkbox" class="mb-3" name="show_avatars" id="show_avatars" value="1"
                                {{ $data['show_avatars'] == 1 ? 'checked' : '' }}>
                            <label for="show_avatars" class="black d-inline">{{ translate('Show Avatars') }}</label>
                        </div>
                    </div>
                    {{-- Avatar Display Section End --}}

                    {{-- Default Avatar Section --}}
                    <div class="col-md-12 row my-3 d-none" id="avatar_settings">
                        <div class="col-md-3 mb-2">
                            <span class="font-16 black bold">{{ translate('Default Avatar') }}</span>
                        </div>
                        <div class="col-md-9">
                            <p class="black">
                                {{ translate('For users without a custom avatar of their own, you can either display a generic logo or a generated one based on their email address.') }}
                            </p>
                            <!--Mystery Avatar -->
                            <div class="mb-2">
                                <input type="radio" class="mb-3" name="avatar_default" id="mystery"
                                    value="mystery" {{ $data['avatar_default'] == 'mystery' ? 'checked' : '' }}>
                                <img src="{{ asset('/public/comment-author-image/mystery.png') }}" alt="">
                                <label for="mystery" class="black">{{ translate('Mystery Person') }}</label><br>
                            </div>

                            <!--Blank Avatar -->
                            <div class="mb-2">
                                <input type="radio" class="mb-3" name="avatar_default" id="blank"
                                    value="blank" {{ $data['avatar_default'] == 'blank' ? 'checked' : '' }}>
                                <img src="{{ asset('/public/comment-author-image/blank.png') }}" alt="">
                                <label for="blank" class="black">{{ translate('Blank') }}</label><br>
                            </div>

                            <!--Gravatar Avatar -->
                            <div class="mb-2">
                                <input type="radio" class="mb-3" name="avatar_default" id="gravatar"
                                    value="gravatar" {{ $data['avatar_default'] == 'gravatar' ? 'checked' : '' }}>
                                <img src="{{ asset('/public/comment-author-image/gravatar.png') }}" alt="">
                                <label for="gravatar" class="black">{{ translate('Gravatar Logo') }}</label><br>
                            </div>

                            <!--Identicon Avatar -->
                            <div class="mb-2">
                                <input type="radio" class="mb-3" name="avatar_default" id="identicon"
                                    value="identicon" {{ $data['avatar_default'] == 'identicon' ? 'checked' : '' }}>
                                <img src="{{ asset('/public/comment-author-image/identicon.png') }}" alt="">
                                <label for="identicon"
                                    class="black">{{ translate('Identicon (Generated)') }}</label><br>
                            </div>

                            <!--Wavatar Avatar -->
                            <div class="mb-2">
                                <input type="radio" class="mb-3" name="avatar_default" id="wavatar"
                                    value="wavatar" {{ $data['avatar_default'] == 'wavatar' ? 'checked' : '' }}>
                                <img src="{{ asset('/public/comment-author-image/wavatar.png') }}" alt="">
                                <label for="wavatar" class="black">{{ translate('Wavatar (Generated)') }}</label><br>
                            </div>

                            <!--MonsterId Avatar -->
                            <div class="mb-2">
                                <input type="radio" class="mb-3" name="avatar_default" id="monsterid"
                                    value="monsterid" {{ $data['avatar_default'] == 'monsterid' ? 'checked' : '' }}>
                                <img src="{{ asset('/public/comment-author-image/monsterid.png') }}" alt="">
                                <label for="monsterid"
                                    class="black">{{ translate('MonsterID (Generated)') }}</label><br>
                            </div>

                            <!--Retro Avatar -->
                            <div class="">
                                <input type="radio" class="mb-3" name="avatar_default" id="retro"
                                    value="retro" {{ $data['avatar_default'] == 'retro' ? 'checked' : '' }}>
                                <img src="{{ asset('/public/comment-author-image/retro.png') }}" alt="">
                                <label for="retro" class="black">{{ translate('Retro (Generated)') }}</label><br>
                            </div>
                            @if ($errors->has('avatar_default'))
                                <p class="text-danger my-1">{{ $errors->first('avatar_default') }}</p>
                            @endif
                        </div>
                    </div>
                    {{-- Default Avatar Section --}}

                    <div class="col-md-12 row my-3">
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary sm">{{ translate('Save Changes') }}</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </form>
@endsection

@section('custom_scripts')
    <script>
        $(document).ready(function() {
            "use strict";
            if ($('#show_avatars').is(':checked')) {
                $('#avatar_settings').removeClass('d-none');
            }

            $('#show_avatars').on('change', function() {
                $('#avatar_settings').toggleClass('d-none');
            });
        });
    </script>
@endsection
