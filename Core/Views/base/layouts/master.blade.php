@php
    $chink_size_object = getChunkSize();
    $chink_size = 256000000;
    if ($chink_size_object != null) {
        $chink_size = $chink_size_object->value;
    }
    
    $placeholder_info = getPlaceHolderImage();
    $placeholder_image = '';
    $placeholder_image_alt = '';
    
    if ($placeholder_info != null) {
        $placeholder_image = $placeholder_info->placeholder_image;
        $placeholder_image_alt = $placeholder_info->placeholder_image_alt;
    }
    
    $logo_details = getGeneralSettingsDetails();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Page Title -->
    <title>@yield('title') | {{ $logo_details['system_name'] }}</title>
    <meta name="_token" content="{{ csrf_token() }}">
    <!-- Meta Data -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicon -->
    <link rel="shortcut icon"
        href="{{ isset($logo_details['favicon']) ? project_asset($logo_details['favicon']) : '' }}">

    <!-- Web Fonts -->
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&display=swap" rel="stylesheet">

    <!-- ======= BEGIN GLOBAL MANDATORY STYLES ======= -->
    <link rel="stylesheet" href="{{ asset('/public/backend/assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/public/backend/assets/fonts/icofont/icofont.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('/public/backend/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.css') }}">
    <!-- ======= END BEGIN GLOBAL MANDATORY STYLES ======= -->

    <!-- ======= TOASTER CSS======= -->
    <link rel="stylesheet" href="{{ asset('/public/backend/assets/css/toaster.min.css') }}">
    <!-- ======= TOASTER CSS======= -->

    <!-- ======= BEGIN PAGE LEVEL PLUGINS STYLES ======= -->
    <link rel="stylesheet" href="{{ asset('/public/backend/assets/plugins/sweetalert2/sweetalert2.min.css') }}">
    <!-- ======= END BEGIN PAGE LEVEL PLUGINS STYLES ======= -->

    <!-- Dropzone-->
    <link rel="stylesheet" href="{{ asset('/public/backend/assets/plugins/dropzone/dropzone.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/public/backend/assets/plugins/daterangepicker/daterangepicker.css') }}">

    @yield('custom_css')
    <!-- ======= MAIN STYLES ======= -->
    <link rel="stylesheet" href="{{ asset('/public/backend/assets/css') }}/{{ $style_path }}/style.css">
    <link rel="stylesheet" href="{{ asset('/public/backend/assets/css/custom.css') }}">
    <!-- ======= END MAIN STYLES ======= -->
    @stack('head')
</head>

<body>

    <!-- Offcanval Overlay -->
    <div class="offcanvas-overlay"></div>
    <!-- Offcanval Overlay -->

    <!-- Wrapper -->
    <div class="wrapper">
        <!-- Header -->
        @include('core::base.layouts.header')
        <!-- End Header -->

        <!-- Main Wrapper -->
        <div class="main-wrapper">
            <!-- Sidebar -->
            @include('core::base.layouts.navbar')
            <!-- End Sidebar -->

            <!-- Main Content -->
            <div class="main-content">
                <div class="container-fluid">
                    @yield('main_content')
                </div>
            </div>
            <!-- End Main Content -->
        </div>
        <!-- End Main Wrapper -->

        <!-- Footer -->
        @include('core::base.layouts.footer')
        <!-- End Footer -->
    </div>
    <!-- End wrapper -->

    <!-- ======= BEGIN GLOBAL MANDATORY SCRIPTS ======= -->
    <script src="{{ asset('/public/backend/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/public/backend/assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/public/backend/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('/public/backend/assets/plugins/moment/moment.min.js') }}"></script>

    <script src="{{ asset('/public/backend/assets/plugins/dropzone/dropzone.min.js') }}"></script>
    <!-- ======= BEGIN GLOBAL MANDATORY SCRIPTS ======= -->

    <!-- ======= Dom Purify ======= -->
    <script src="{{ asset('/public/backend/assets/plugins/dompurify/purify.min.js') }}"></script>
    <!-- ======= Dom Purify ======= -->

    <!-- ======= TOASTER ======= -->
    <script src="{{ asset('/public/backend/assets/js/toaster.min.js') }}"></script>
    {!! Toastr::message() !!}
    <!-- ======= TOASTER ======= -->

    <script>
        //media file initial per page
        let per_page = 30;
        let page = 1;
        let selected_file_location = [];
        let selected_file_id = [];
        let enable_multiple_file_select = false;
        let is_for_browse_file = false;

        (function($) {
            "use strict";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // message if a form validation fails
            if ("{{ session('form-error') }}") {
                toastr.error("{{ session('form-error') }}");
            };

            /**
             * Change language 
             */
            $('#lang-change .dropdown-item').each(function() {
                $(this).on('click', function(e) {
                    e.preventDefault();
                    var $this = $(this);
                    var locale = $this.data('lan');
                    $.post('{{ route('core.language.change') }}', {
                        _token: '{{ csrf_token() }}',
                        lang: locale
                    }, function(data) {
                        location.reload();
                    });
                });
            });

            /**
             * Change dark mood
             */
            $('.darklooks-mode-changer').on('click', function(e) {
                e.preventDefault();
                $.post('{{ route('core.mood.change') }}', {
                    _token: '{{ csrf_token() }}'
                }, function(data) {
                    location.reload();
                })
            });
        })(jQuery);

        /**
         * Hide specific element
         */
        function hideElement(el) {
            "use strict";
            for (let i = 0; i < el.length; i++) {
                $(el[i]).hide()
            }
        }

        /**
         * Show specific element
         */
        function showElement(el) {
            "use strict";
            for (let i = 0; i < el.length; i++) {
                $(el[i]).show()
            }
        }

        /**
         * Togle specific element
         */
        function toggleElement(el) {
            "use strict";
            for (let i = 0; i < el.length; i++) {
                $(el[i]).toggle()
            }
        }

        /**
         * Object to array conversion
         */
        function objToArray(objectLiteral) {
            "use strict";
            let piece1 = Object.keys(objectLiteral);
            let piece2 = Object.values(objectLiteral);
            let result = [];

            for (let i = 0; i < piece1.length; i++) {
                result[piece1[i]] = piece2[i]
            }
            return result;
        }

        /**
         * Showing form error messages 
         */
        function showFormErrorMessage(errors) {
            "use strict";
            for (let key in (errors)) {
                $('#' + key + '_update_error').html(errors[key])
            }
        }



        /***** Media Script Start****/

        /**
         * Initialize dropzone
         */
        function initDropzone() {
            "use strict";
            let total_files = 0
            let chunk_size = {{ $chink_size }}
            Dropzone.autoDiscover = false;
            $("#uploaded").dropzone({
                url: '{{ route('core.upload.media.file') }}',
                parallelUploads: 9,
                uploadMultiple: true,
                maxFilesize: 256,
                timeout: 3600000,
                accept: function(file, done) {
                    if (total_files <= 9) {
                        if (file.type != "image/jpeg" && file.type != "image/svg" && file.type != "image/jpg" &&
                            file.type != "image/png" &&
                            file
                            .type != "image/gif" && file.type != "application/zip" && file.type !=
                            "application/pdf" &&
                            file.type != "video/mp4") {
                            toastr.error("Please upload a file of type jpeg/jpg/svg/png/gif/pdf/zip/mp4",
                                "Error!");
                        } else {
                            done();
                        }
                    } else {
                        toastr.error("You cannot upload more than 9 files", "Error!");
                    }
                },
                success: function(file, response) {
                    if (response.demo_mode) {
                        toastr.error(response.message, "Alert!");
                    } else {
                        $('#upload-files-tab').removeClass('active')
                        $('#upload-files').removeClass('active show')
                        $('#media-library-tab').addClass('active')
                        $('#media-library').addClass('active show')
                        total_files = 0;
                        let total = response.total

                        if (total > 30) {
                            $('.load-more').removeAttr("disabled");
                        }
                        setTimeout(() => {
                            updateMediaPerPageOnUpload()
                            this.removeAllFiles(true);
                        }, 1000);
                    }
                },
                error: function(file, message) {
                    if (file.size > 256000000) {
                        toastr.error("Unable to upload file larger tha 20MB ", "Error!");
                    } else {
                        toastr.error(message, "Error!");
                    }
                    return false;
                },
                init: function() {
                    this.on("addedfile", function(file) {
                        total_files = total_files + 1
                    });
                }
            });
        }


        /**
         * Filter media file
         */
        function filtermedia() {
            "use strict";
            let file_type = $('#media-file-filters').val()
            let media_type = $('#media-type').val()
            let search_input = $('#media-search-input').val()
            let search_date = $('#media-date-filters').val()

            if (search_input != "") {
                page = 1
            }

            if (search_date != "all") {
                page = 1
            }

            $('#filtered_media').addClass('area-disabled')

            let param = {
                _token: '{{ csrf_token() }}',
                file_type: file_type,
                media_type: media_type,
                search_input: search_input,
                search_date: search_date,
                page: page,
                per_page: per_page
            }

            if (selected_file_id.length > 0) {
                param = {
                    _token: '{{ csrf_token() }}',
                    file_type: file_type,
                    media_type: media_type,
                    search_input: search_input,
                    search_date: search_date,
                    selected_media_files: selected_file_id.join(','),
                    page: page,
                    per_page: per_page
                }
            }

            $.post("{{ route('core.filter.media.list') }}", param,
                    function(data, status) {
                        let view = data.view
                        $('#filtered_media').removeClass('area-disabled')

                        if (search_input != "" || search_date != "all") {
                            $('#filtered_media').html(data.view)
                        } else {
                            if (page == 1) {
                                $('#filtered_media').html('')
                            }
                            $('#filtered_media').append(data.view);
                            $('.load-more-wrapper').removeClass('d-none');
                        }

                        let final_count = data.all_media.total
                        let current_count = data.all_media.to;
                        if (current_count == null) {
                            current_count = final_count;
                        }

                        $('#show_count').html("showing " + current_count + " of " + final_count + "media itmes")
                        if (current_count >= final_count) {
                            $('.load-more').attr('disabled', 'disabled');
                        } else {
                            $('.load-more').removeAttr("disabled");
                        }

                        for (let j = 0; j < selected_file_id.length; j++) {
                            $('#list_item_' + selected_file_id[j]).addClass("selected");
                        }

                    })
                .fail(function(xhr, status, error) {
                    let error_response = JSON.parse(xhr.responseText)
                    let error_message = error_response.message
                    toastr.error(error_message, "Error!");
                });

        }

        /**
         * Filter media file on delete
         */
        function filtermediaOonDelete() {
            "use strict";
            page = 1
            let file_type = $('#media-file-filters').val()
            let media_type = $('#media-type').val()
            let search_input = $('#media-search-input').val()
            let search_date = $('#media-date-filters').val()

            $('#filtered_media').addClass('area-disabled')

            let param = {
                _token: '{{ csrf_token() }}',
                file_type: file_type,
                media_type: media_type,
                search_input: search_input,
                search_date: search_date,
                page: page,
                per_page: per_page
            }

            if (selected_file_id.length > 0) {
                param = {
                    _token: '{{ csrf_token() }}',
                    file_type: file_type,
                    media_type: media_type,
                    search_input: search_input,
                    search_date: search_date,
                    selected_media_files: selected_file_id.join(','),
                    page: page,
                    per_page: per_page
                }
            }

            $.post("{{ route('core.filter.media.list') }}", param,
                function(data, status) {
                    let view = data.view
                    $('#filtered_media').removeClass('area-disabled')
                    $('#filtered_media').html(data.view)

                    let current_count = data.all_media.to
                    if (current_count == null) {
                        current_count = 0
                    }
                    let final_count = data.all_media.total

                    $('#show_count').html("showing " + current_count + " of " + final_count + "media itmes")
                    if (current_count >= final_count) {
                        $('.load-more').attr('disabled', 'disabled');
                    } else {
                        $('.load-more').removeAttr("disabled");
                    }

                    for (let j = 0; j < selected_file_id.length; j++) {
                        $('#list_item_' + selected_file_id[j]).addClass("selected");
                    }

                }).fail(function(xhr, status, error) {
                let error_response = JSON.parse(xhr.responseText)
                let error_message = error_response.message
                toastr.error(error_message, "Error!");
            });
        }

        /**
         * Filter media file on edit
         */
        function filtermediaOnEdit(selected_media_files, ids) {
            "use strict";
            page = 1
            let file_type = $('#media-file-filters').val()
            let media_type = $('#media-type').val()
            let search_input = $('#media-search-input').val()
            let search_date = $('#media-date-filters').val()
            $('#filtered_media').addClass('area-disabled')

            $.post("{{ route('core.filter.media.list') }}", {
                    _token: '{{ csrf_token() }}',
                    file_type: file_type,
                    media_type: media_type,
                    search_input: search_input,
                    search_date: search_date,
                    selected_media_files: selected_media_files,
                    page: page,
                    per_page: per_page
                },
                function(data, status) {
                    let view = data.view
                    $('#filtered_media').removeClass('area-disabled')
                    $('#filtered_media').html(data.view)

                    let current_count = data.all_media.to
                    if (current_count == null) {
                        current_count = 0
                    }
                    let final_count = data.all_media.total

                    $('#show_count').html("showing " + current_count + " of " + final_count + "media itmes")
                    if (current_count >= final_count) {
                        $('.load-more').attr('disabled', 'disabled');
                    } else {
                        $('.load-more').removeAttr("disabled");
                    }

                    let current_selected_files_id_array = selected_media_files.split(',')

                    for (let j = 0; j < current_selected_files_id_array.length; j++) {
                        $('#list_item_' + current_selected_files_id_array[j]).addClass("selected");
                    }

                    selected_file_id = current_selected_files_id_array
                    $('.insert_image').attr('onclick', 'getSeletedFiles("' + ids + '")')
                }).fail(function(xhr, status, error) {
                let error_response = JSON.parse(xhr.responseText)
                let error_message = error_response.message
                toastr.error(error_message, "Error!");
            });
        }

        /**
         * Filter media file on edit
         */
        function filtermediaOnEditForMultiSelect(selected_media_files, ids, indicator) {
            "use strict";
            page = 1
            let file_type = $('#media-file-filters').val()
            let media_type = $('#media-type').val()
            let search_input = $('#media-search-input').val()
            let search_date = $('#media-date-filters').val()
            $('#filtered_media').addClass('area-disabled')

            $.post("{{ route('core.filter.media.list') }}", {
                    _token: '{{ csrf_token() }}',
                    file_type: file_type,
                    media_type: media_type,
                    search_input: search_input,
                    search_date: search_date,
                    selected_media_files: selected_media_files,
                    page: page,
                    per_page: per_page
                },
                function(data, status) {
                    let all_files = data.all_media.data
                    let view = data.view
                    $('#filtered_media').removeClass('area-disabled')
                    $('#filtered_media').html(data.view)

                    let current_count = data.all_media.to
                    if (current_count == null) {
                        current_count = 0
                    }
                    let final_count = data.all_media.total

                    $('#show_count').html("showing " + current_count + " of " + final_count + "media itmes")

                    if (current_count >= final_count) {
                        $('.load-more').attr('disabled', 'disabled');
                    } else {
                        $('.load-more').removeAttr("disabled");
                    }


                    let current_selected_files_id_array = selected_media_files.split(',')

                    $("#attachment-list > li").removeClass("selected")
                    for (let j = 0; j < current_selected_files_id_array.length; j++) {
                        $('#list_item_' + current_selected_files_id_array[j]).addClass("selected");
                    }

                    if (current_selected_files_id_array != "") {
                        selected_file_id = current_selected_files_id_array
                    } else {
                        selected_file_id = []
                    }

                    for (let i = 0; i < all_files.length; i++) {
                        for (let j = 0; j < selected_file_id.length; j++) {
                            if (all_files[i].id == selected_file_id[j]) {
                                let path = '{{ project_asset('/') }}' + "/" + all_files[i].path
                                selected_file_location['file_' + selected_file_id[i]] = path
                            }
                        }
                    }


                    enable_multiple_file_select = true
                    $('.insert_image').attr('onclick', 'getSeletedFilesForMultiSelect("' + ids + '",' + indicator + ')')

                }).fail(function(xhr, status, error) {
                let error_response = JSON.parse(xhr.responseText)
                let error_message = error_response.message
                toastr.error(error_message, "Error!");
            });
        }

        /**
         * Updating per page item 
         */
        function updateMediaPerPage() {
            "use strict";
            page = page + 1
            filtermedia()
        }

        /**
         * Updating per page item after uploading file 
         */
        function updateMediaPerPageOnUpload() {
            "use strict";
            page = 1
            let file_type = $('#media-file-filters').val()
            let media_type = $('#media-type').val()
            let search_input = $('#media-search-input').val()
            let search_date = $('#media-date-filters').val()
            $('#filtered_media').addClass('area-disabled')

            $.post("{{ route('core.filter.media.list') }}", {
                    _token: '{{ csrf_token() }}',
                    file_type: file_type,
                    media_type: media_type,
                    search_input: search_input,
                    search_date: search_date,
                    page: page,
                    per_page: 30
                },
                function(data, status) {
                    let view = data.view
                    let all_media = data.all_media.data
                    let last_item_id = -1
                    if (all_media.length > 0) {
                        last_item_id = all_media[0].id
                        let str_media = JSON.stringify(data.all_media)
                        $('#filtered_media').removeClass('area-disabled')
                        $('#filtered_media').html(data.view)

                        let current_count = data.all_media.to
                        if (current_count == null) {
                            current_count = 0
                        }
                        let final_count = data.all_media.total

                        $('#show_count').html("showing " + current_count + " of " + final_count + "media itmes")
                        if (current_count >= final_count) {
                            $('.load-more').attr('disabled', 'disabled');
                        } else {
                            $('.load-more').removeAttr("disabled");
                        }
                    }
                }).fail(function(xhr, status, error) {
                let error_response = JSON.parse(xhr.responseText)
                let error_message = error_response.message
                toastr.error(error_message, "Error!");
            });
        }

        /**
         * Updating media file
         */
        function updateMedia() {
            "use strict";
            let media_id = $('#media_id').val()
            let alt = $('#attachment-details-alt-text').val()
            let title = $('#attachment-details-title').val()
            let caption = $('#attachment-details-caption').val()
            let description = $('#attachment-details-description').val()

            $.post("{{ route('core.update.media.file.info') }}", {
                    _token: '{{ csrf_token() }}',
                    media_id: media_id,
                    alt: alt,
                    title: title,
                    caption: caption,
                    description: description
                },
                function(data, status) {
                    if (!is_for_browse_file) {
                        $("#browseImgPrev").modal("hide");
                    }
                    if (is_for_browse_file && !enable_multiple_file_select) {
                        $(".media-sidebar").removeClass("active");
                    }
                    location.reload()
                }).fail(function(xhr, status, error) {
                let error_response = JSON.parse(xhr.responseText)
                let error_message = error_response.message
                let errors = {}
                if (error_response.hasOwnProperty('errors')) {
                    errors = objToArray(error_response.errors)
                    showFormErrorMessage(errors)
                } else {
                    toastr.error(error_message, "Error!");
                }
            });
        }

        /**
         * Go to next slide
         */
        function nextMediaSlide(e, media_id, id) {
            "use strict";
            let all_media_id = JSON.parse(media_id);
            $('#media_slide').addClass('area-disabled');
            $.post("{{ route('core.get.media.details.by.id') }}", {
                    _token: '{{ csrf_token() }}',
                    media_id: all_media_id.join(',')
                },
                function(data, status) {
                    $('#media_slide').removeClass('area-disabled')
                    let media_data = data.all_media
                    if (is_for_browse_file) {
                        let raw_media_data = media_data
                        let media = raw_media_data
                        let media_files = media

                        for (let i = 0; i < media_files.length; i++) {
                            if (media_files[i].id == id) {

                                let media_path = '{{ project_asset('path') }}';
                                media_path = media_path.replace('path', media_files[i].path)

                                $('#selected_media').attr('src', media_path)
                                $('#media_name').html(media_files[i].name)
                                $('#media_file_uploading_date').html(media_files[i].created_at)
                                $('#media_file_size').html((media_files[i].size / 1000) + ' kb')


                                $('#attachment-details-alt-text').html(media_files[i].alt)
                                $('#attachment-details-title').html(media_files[i].title)
                                $('#attachment-details-caption').html(media_files[i].caption)
                                $('#attachment-details-description').html(media_files[i].description)
                                $('#media_id').val(media_files[i].id)
                                if (media_files[i].file_type == 'pdf') {
                                    $('#selected_media').attr('src',
                                        '{{ project_asset('/backend/assets/img/pdf-placeholder.png') }}')
                                } else if (media_files[i].file_type == 'zip') {
                                    $('#selected_media').attr('src',
                                        '{{ project_asset('/backend/assets/img/zip-placeholder.png') }}')
                                } else if (media_files[i].file_type == 'mp4' || media_files[i].file_type == 'video') {
                                    $('#selected_media').attr('src',
                                        '{{ project_asset('/backend/assets/img/mp4-placeholder.png') }}')
                                }

                                if ($('#list_item_' + id).hasClass('selected')) {
                                    $(".media-sidebar").removeClass("active");
                                    $('#list_item_' + id).removeClass("selected");
                                    delete selected_file_location['file_' + id]

                                    let myIndex = selected_file_id.indexOf("" + id);
                                    selected_file_id.splice(myIndex, 1);
                                } else {
                                    if (!enable_multiple_file_select) {
                                        $("#attachment-list > li").removeClass("selected");
                                        selected_file_id = []
                                    }
                                    if (enable_multiple_file_select && e != null && e.ctrlKey) {
                                        $(".media-sidebar").removeClass("active");
                                    } else {
                                        $("#attachment-list > li").removeClass("selected");
                                        selected_file_id = []
                                        $(".media-sidebar").addClass("active");
                                    }
                                    $('#list_item_' + id).addClass("selected");
                                    selected_file_location['file_' + id] = '{{ project_asset('/') }}' + "/" +
                                        media_files[i].path

                                    selected_file_id.push(id)
                                }
                            }
                        }
                    } else {
                        let raw_media_data = media_data
                        let media = raw_media_data
                        let media_files = media
                        for (let i = 0; i < media_files.length; i++) {
                            if (media_files[i].id == id) {
                                $('#file_name').html(media_files[i].name)
                                $('#file_url').val('{{ project_asset('/') }}' + "\/" + media_files[i].path)
                                $('#download_file').attr('href', '{{ project_asset('/') }}' + "\/" + media_files[i]
                                    .path)
                                $('#file_type').html(media_files[i].file_type)
                                $('#file_size').html((media_files[i].size / 1000) + ' kb')
                                $('#uploaded_by').html(media_files[i].uploaded_by)
                                $('#creaated_at').html(media_files[i].created_at)
                                $('#updated_at').html(media_files[i].updated_at)
                                $('#preview_image').attr('src', '{{ project_asset('/') }}' + "\/" + media_files[i]
                                    .path)

                                $('#attachment-details-alt-text').val(media_files[i].alt)
                                $('#attachment-details-title').val(media_files[i].title)
                                $('#attachment-details-caption').val(media_files[i].caption)
                                $('#attachment-details-description').val(media_files[i].description)
                                $('#media_id').val(media_files[i].id)

                                if (i + 1 != media_files.length) {
                                    $('.media-next').attr('onclick', 'nextMediaSlide(event,' + JSON.stringify(
                                            media_id) +
                                        ',' + media_files[i + 1].id + ')')
                                }
                                if (i != 0) {
                                    $('.media-prev').attr('onclick', 'nextMediaSlide(event,' + JSON.stringify(
                                        media_id) + ',' + media_files[i - 1].id + ')')
                                }
                                if (media_files[i].file_type == 'pdf') {
                                    $('#preview_image').attr('src',
                                        '{{ project_asset('/backend/assets/img/pdf-placeholder.png') }}')
                                }
                                if (media_files[i].file_type == 'zip') {
                                    $('#preview_image').attr('src',
                                        '{{ project_asset('/backend/assets/img/zip-placeholder.png') }}')
                                }
                                if (media_files[i].file_type == 'mp4' || media_files[i].file_type == 'video') {
                                    $('#preview_image').attr('src',
                                        '{{ project_asset('/backend/assets/img/mp4-placeholder.png') }}')
                                }

                                if ($('#list_item_' + id).hasClass('selected')) {
                                    $("#browseImgPrev").modal("hide");
                                    $('#list_item_' + id).removeClass("selected");
                                    delete selected_file_location['file_' + id]

                                    let myIndex = selected_file_id.indexOf("" + id);
                                    selected_file_id.splice(myIndex, 1);
                                } else {
                                    if (!enable_multiple_file_select) {
                                        $("#attachment-list > li").removeClass("selected");
                                        selected_file_id = []
                                    }
                                    if (enable_multiple_file_select && e != null && e.ctrlKey) {
                                        $("#browseImgPrev").modal("hide");
                                    } else {
                                        $("#attachment-list > li").removeClass("selected");
                                        selected_file_id = []
                                        $("#browseImgPrev").modal("show");
                                    }

                                    $('#list_item_' + id).addClass("selected");
                                    selected_file_location['file_' + id] = "{{ project_asset('/') }}" + "/" +
                                        media_files[i].path
                                    selected_file_id.push(id)
                                }
                            }
                        }
                    }

                    if (selected_file_id.length > 0) {
                        $("#delete-media").prop("disabled", false);
                    } else {
                        $("#delete-media").prop("disabled", true);
                    }
                }).fail(function(xhr, status, error) {});
        }

        /**
         * Delete media
         */
        function deleteMediaFile() {
            "use strict";
            $.post("{{ route('core.delete.media.file') }}", {
                    _token: '{{ csrf_token() }}',
                    id: selected_file_id
                },
                function(data, status) {
                    if (data.demo_mode) {
                        toastr.error(data.message, "Alert!");
                    } else {
                        filtermediaOonDelete()
                        $("#browseImgPrev").modal("hide");
                        $(".media-sidebar").removeClass("active");
                        $("#delete-media").prop("disabled", true);
                        toastr.success("Media file deleted successfully", "Success!");
                    }
                }).fail(function(xhr, status, error) {
                let error_response = JSON.parse(xhr.responseText)
                let error_message = error_response.message
                toastr.error(error_message, "Error!");
            });
        }

        /**
         * Setup media gallery for single select 
         */
        function setDataInsertableIds(ids) {
            "use strict";
            let current_selected_files_id = ids.split(',')
            let current_selected_files_id_array = $(current_selected_files_id[1]).val().split(',')
            enable_multiple_file_select = false
            filtermediaOnEdit(current_selected_files_id_array.join(','), ids)
        }

        /**
         * Setup media gallery for multi select 
         */
        function setDataInsertableIdsForMultiSelect(ids, indicator) {
            "use strict";
            let id_array = ids.split(',')
            let current_selected_files_id = $(id_array[0] + '_' + indicator).val()
            let current_selected_files_id_array = current_selected_files_id.split(',')

            $(id_array[1] + ' img').each(function() {
                let selected_id = $(this).attr('id').split('_')
                selected_file_location['file_' + selected_id[selected_id.length - 1]] = $(this).attr('src')
            })
            filtermediaOnEditForMultiSelect(current_selected_files_id_array.join(','), ids, indicator)
        }

        /**
         * Setup input field for single select 
         */
        function getSeletedFiles(ids) {
            "use strict";
            let insertableIds = ids.split(',')
            for (let i = 0; i < selected_file_id.length; i++) {
                let splitted_file_location = selected_file_location['file_' + selected_file_id[i]].split('.')
                let splitted_file_extension = splitted_file_location[splitted_file_location.length - 1]

                if (splitted_file_extension == 'mp4') {
                    $(insertableIds[0]).attr('src', '{{ project_asset('/backend/assets/img/mp4-placeholder.png') }}')
                } else if (splitted_file_extension == 'zip') {
                    $(insertableIds[0]).attr('src', '{{ project_asset('/backend/assets/img/zip-placeholder.png') }}')
                } else if (splitted_file_extension == 'pdf') {
                    $(insertableIds[0]).attr('src', '{{ project_asset('/backend/assets/img/pdf-placeholder.png') }}')
                } else {
                    $(insertableIds[0]).attr('src', selected_file_location['file_' + selected_file_id[i]])
                }

                $(insertableIds[1]).val(selected_file_id[i])
                $(insertableIds[2]).removeClass('d-none')
            }
            $("#mediaUploadModal").modal("hide");
            $(".media-sidebar").removeClass("active");
            $(".media-sidebar").show();
            $(insertableIds[2]).show();
        }

        /**
         * Setup input field for multiple select
         */
        function getSeletedFilesForMultiSelect(ids, indicator) {
            "use strict";
            let container_id = ids.split(',')
            $("#multi_input_container_" + indicator).html('')
            for (let i = 0; i < selected_file_id.length; i++) {

                let html = `<div class="preview-image-wrapper p-1" id="div_preview_${indicator}_${selected_file_id[i]}" >
                            <img src="` + selected_file_location['file_' + selected_file_id[i]] + `" alt="" width="150" class="preview_image" 
                            id="preview_${indicator}_${selected_file_id[i]}"/>
                            <button type="button" title="Remove image" class="remove-btn style--three"
                                    id="remove_${indicator}_${selected_file_id[i]}"
                                    onclick="removeSelectionForMultiSelect('#preview_${indicator}_${selected_file_id[i]},${container_id[0]}_${indicator},#remove_${indicator}_${selected_file_id[i]},#div_preview_${indicator}_${selected_file_id[i]}',${selected_file_id[i]})"><i
                                    class="icofont-close"></i>
                            </button>
                        </div>`

                $("#multi_input_container_" + indicator).append(html)
            }
            $(container_id[0] + "_" + indicator).val(selected_file_id);
            $("#mediaUploadModal").modal("hide");
            $(".media-sidebar").removeClass("active");
            $(".media-sidebar").show();
        }

        /**
         * remove selection for single select
         */
        function removeSelection(ids) {
            "use strict";
            let rmoveableIds = ids.split(',')
            $(rmoveableIds[0]).attr('src', '{{ project_asset($placeholder_image) }}')
            $(rmoveableIds[1]).val('')
            $(rmoveableIds[2]).hide()
        }

        /**
         * remove selection for multi select
         */
        function removeSelectionForMultiSelect(ids, image_id) {
            "use strict";
            let rmoveableIds = ids.split(',')
            let current_selected_files = $(rmoveableIds[1]).val().split(',')
            let myIndex = current_selected_files.indexOf("" + image_id);
            current_selected_files.splice(myIndex, 1);
            if (current_selected_files.length != 0) {
                $(rmoveableIds[3]).hide()
            } else {
                $(rmoveableIds[0]).attr('src', '{{ project_asset($placeholder_image) }}')
            }
            $(rmoveableIds[1]).val(current_selected_files)
            $(rmoveableIds[2]).hide()
            if (current_selected_files.length > 0) {
                selected_file_id = current_selected_files
            } else {
                selected_file_id = []
            }
        }

        /**** Media Script End****/
    </script>
    @yield('custom_scripts')
    @yield('partial_scripts')
    @stack('script')
    <script src="{{ asset('/public/backend/assets/js/script.js') }}"></script>
</body>

</html>
