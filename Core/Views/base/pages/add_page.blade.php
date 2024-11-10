@extends('core::base.layouts.master')

@section('title')
    {{ translate('Add Page') }}
@endsection

@section('custom_css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('/public/backend/assets/plugins/select2/select2.min.css') }}">
    <!--  End select2  -->
    <!--Editor-->
    <link href="{{ asset('/public/backend/assets/plugins/summernote/summernote-lite.css') }}" rel="stylesheet" />
    <!--End editor-->

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
    </style>
@endsection

@section('main_content')
    <!-- Main Content -->

    <form class="form-horizontal my-4 mb-4" id="page_form" action="{{ route('core.page.store') }}" method="post"
        enctype="multipart/form-data">
        @csrf

        <input type="hidden" id="page_id" name="id" value="">
        <div class="row">
            <div class="col-md-8">
                <div class="mb-3">
                    <p class="alert alert-info">You are inserting
                        <strong>"{{ getLanguageNameByCode(getDefaultLang()) }}"</strong> version
                    </p>
                </div>
                <div class="card mb-30">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-center">
                            <h4 class="font-20">{{ translate('Add Page') }}</h4>
                        </div>
                        {{-- Title Field --}}
                        <div class="form-group row my-4">
                            <label for="title"
                                class="col-sm-2 font-14 bold black mb-2">{{ translate('Page Title') }}<span
                                    class="text-danger"> * </span>
                            </label>
                            <div class="col-sm-10">
                                <input type="text" name="title" id="title" class="form-control page_title"
                                    value="{{ old('title') }}" placeholder="{{ translate('Add Title') }}" required>
                                <input type="hidden" name="permalink" id="permalink_input_field" required
                                    value="{{ old('permalink') }}">
                                @if ($errors->has('title'))
                                    <p class="text-danger">{{ $errors->first('title') }}</p>
                                @endif
                            </div>
                        </div>
                        {{-- Title Field End --}}
                        <!--Permalink-->
                        <div
                            class="form-row my-4 permalink-input-group d-none @if ($errors->has('permalink')) d-flex @endif">
                            <div class="col-sm-2">
                                <label class="font-14 bold black">{{ translate('Permalink') }} </label>
                            </div>
                            <div class="col-sm-10">
                                <a href="#" onclick="pagePreviewDraft('preview')">{{ url('') }}/page/<span
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

                        {{-- Content Field --}}
                        <div class="form-row mt-5">
                            <label class="col-sm-2 font-14 bold black">{{ translate('Content') }} <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <div class="editor-wrap">
                                    <textarea name="content" id="page_content">{{ old('content') }}</textarea>
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

            {{-- Add Page Side Field --}}
            <div class="col-md-4">
                <div class="row px-3">
                    {{-- Publish Section --}}
                    <div class="card card-body col-12 order-last order-md-first mt-5 mt-md-0">
                        <h4 class="font-16">{{ translate('Publish') }}</h4>
                        {{-- Draft,previe,pending button --}}
                        <div class="row my-4 mx-1 justify-content-between ">
                            <div>
                                <a href="#" class="btn btn-dark sm mr-2"
                                    onclick="pagePreviewDraft('draft')">{{ translate('Draft') }}</a>
                            </div>
                            <a href="#" class="btn btn-info sm mr-2"
                                onclick="pagePreviewDraft('preview')">{{ translate('Preview') }}</a>
                        </div>

                        {{-- visibility part --}}
                        <div class="row my-2 mx-1 page-visibility">
                            <i class="icofont-eye icofont-1x"></i>
                            <span class="font-14 black ml-1">{{ translate('Visibility') }} :</span>
                            <span class="font-14 bold black ml-2"
                                id="current_visibility">{{ translate('Public') }}</span>
                            <a href="#" class="btn custom-btn ml-2"
                                id="visibility_edit_button">{{ translate('Edit') }}</a>
                            @if ($errors->has('visibility'))
                                <div class="invalid-input">{{ $errors->first('visibility') }}</div>
                            @endif
                        </div>
                        <div class="mx-1 my-2 d-none page-visibility" id="visibility_form">
                            <input type="radio" checked name="visibility" id="visibility-radio-public"
                                value="public" />
                            <label for="visibility-radio-public" class="selectit">{{ translate('Public') }}</label>
                            <br />

                            <input type="radio" name="visibility" id="visibility-radio-password" value="password" />
                            <label for="visibility-radio-password"
                                class="selectit">{{ translate('Password protected') }}</label>
                            <br />
                            <span id="password-span" class="ml-4">
                                <input type="text" name="page_password" id="page_password" value=""
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
                            <span class="font-14 black ml-1 mt-2">{{ translate('Publish') }} :</span>
                            <input type="datetime-local" name="publish_at" class="theme-input-style w-75 ml-2 py-0"
                                value="{{ old('publish_at') }}">
                        </div>
                        {{-- publish schedule part end --}}

                        {{-- Page Builder Part Start --}}
                        @if (isActivePluging('pagebuilder'))
                            <div class="row my-2 mx-1">
                                <i class="icofont-building icofont-1x mt-2"></i>
                                <span class="font-14 black ml-1 mt-2">{{ translate('Make with Builder') }} :</span>
                                <label class="switch success ml-3">
                                    <input type="checkbox" name="page_type_builder" id="page_type_builder"
                                        value="builder">
                                    <span class="control" id="page_type_builder_switch">
                                        <span class="switch-off">{{ translate('Disable') }}</span>
                                        <span class="switch-on">{{ translate('Enable') }}</span>
                                    </span>
                                </label>
                            </div>
                        @endif
                        {{-- Page Builder Part End --}}

                        <div class="row mx-1 mt-4">
                            <button type="submit" class="btn sm">{{ translate('Save') }}</button>
                        </div>
                    </div>
                    {{-- Publish Section End --}}

                    {{-- Page Attributes --}}
                    <div class="card card-body mt-5 mt-md-5 col-12">
                        <h4 class="font-16 mb-2">{{ translate('Page Attributes') }}</h4>
                        <div class="form-group row my-2">
                            <label for="page_parent" class="col-sm-4 font-14 bold black">{{ translate('Parents') }}
                            </label>
                            <div class="col-sm-8">
                                <select class="form-control" name="page_parent" id="page_parent">
                                    <option value="">{{ translate('Select a Parent Page') }}</option>
                                    @foreach ($pages as $page)
                                        <option value="{{ $page->id }}">
                                            @php
                                                $tlpage = Core\Models\TlPage::where('id', $page->id)->first();
                                            @endphp
                                            {{ $tlpage->translation('title', getLocale()) }}
                                        </option>
                                        @if (count($tlpage->childs))
                                            @include(
                                                'core::base.pages.includes.page_child',
                                                [
                                                    'child_page' => $tlpage->childs,
                                                    'label' => 1,
                                                    'parent' => null,
                                                ]
                                            )
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('page_parent'))
                                <p class="text-danger">{{ $errors->first('page_parent') }}</p>
                            @endif
                        </div>
                    </div>
                    {{-- Page Attributes End --}}

                    {{-- Featured Image --}}
                    <div class="card card-body mt-5 col-12 page_image">
                        <h4 class="font-16">{{ translate('Featured Image') }}</h4>
                        <div class="form-group row justify-content-center align-items-center mt-4">
                            <div class="col-sm-4">
                                @include('core::base.includes.media.media_input', [
                                    'input' => 'page_image',
                                    'data' => old('page_image'),
                                ])
                                @if ($errors->has('page_image'))
                                    <p class="text-danger">{{ $errors->first('page_image') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    {{-- Page Image End --}}
                </div>
            </div>
            {{-- Add Page Side Field End --}}
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

                // SUMMERNOTE INIT
                $('#page_content').summernote({
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
                        ["insert", ["link", "picture", "video"]],
                        ["view", ["fullscreen", "codeview", "help"]],
                    ],
                    placeholder: 'Page Content',
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

                $('#page_parent').select2({
                    theme: "classic",
                });

                // Build with builder switch make content and image field show/hide
                $(document).on('click', '#page_type_builder', function() {
                    if ($(this).is(':checked')) {
                        $('#page_content').parents(':eq(2)').addClass('d-none');
                        $('.page_image').addClass('d-none');
                        $('.page-visibility').addClass('d-none');
                    } else {
                        $('#page_content').parents(':eq(2)').removeClass('d-none');
                        $('.page_image').removeClass('d-none');
                        $('.page-visibility').removeClass('d-none');
                    }
                })
            });

            /*Generate permalink*/
            $(".page_title").change(function(e) {
                e.preventDefault();
                let name = $(".page_title").val();
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
                .replace(/-+/g, "-"); // collapse dashes

            return str;
        }

        // page preview and draft
        function pagePreviewDraft(action) {
            "use strict";
            var formData = $('#page_form').serializeArray();
            formData.push({
                name: "action",
                value: action
            });

            $.ajax({
                method: 'POST',
                url: '{{ route('core.page.draft.preview') }}',
                dataType: 'json',
                data: formData
            }).done(function(response) {
                if (response.error) {
                    toastr.error(response.error, "Error!");
                } else {
                    switch (action) {
                        case 'draft':
                            $('#page_id').val(response.id);
                            toastr.success(response.success, "Success!");
                            break;
                        case 'preview':
                            $('#page_id').val(response.id);
                            window.open('{{ route('core.page.preview') }}?page=' + response.permalink);
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
            let imageUploadUrl = '{{ route('core.page.content.image') }}';
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
                        $('#page_content').summernote("insertNode", image[0]);
                    } else {
                        toastr.error(data.error, "Error!");
                    }
                },
                error: function(data) {
                    toastr.error('Image Upload Failed', "Error!");
                }
            });
        }
    </script>
@endsection
