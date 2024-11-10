@extends('core::base.layouts.master')

@section('title')
    {{ translate('Manage Widgets') }}
@endsection

@section('custom_css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('/public/backend/assets/plugins/select2/select2.min.css') }}">
    <!--  End select2  -->
    <!--Editor-->
    <link href="{{ asset('/public/backend/assets/plugins/summernote/summernote-lite.css') }}" rel="stylesheet" />
    <!--End editor-->
    {{-- Jqueey UI --}}
    <link href="{{ asset('/public/backend/assets/plugins/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet">
    {{-- End Jqueey UI --}}
    <style>
        .sidebar-widget-placeholder {
            border: 1px dotted black;
            height: 3.5rem;
            margin-bottom: 10px;
        }

        .widget-border {
            border-style: outset;
        }

        .card .collapse_arrow {
            transform: rotate(90deg);
            transition: 0.3s transform ease-in-out;
        }

        .card .collapsed .collapse_arrow {
            transform: rotate(0deg);
        }

        .dropdown_icon i {
            cursor: pointer;
            transition: 0.3s transform ease-in-out;
        }

        .dropdown_icon i.drop-menu {
            transform: rotate(90deg);
        }

        .selected {
            background: #2271b1 !important;
            color: #fff !important;
        }

        .selected::before {
            content: "";
            position: absolute;
            border-color: #fff;
            border-style: solid;
            border-width: 0 0.3em 0.25em 0;
            height: 1em;
            top: 2.0em;
            left: 0.6em;
            margin-top: -1em;
            transform: rotate(45deg);
            width: 0.5em;
        }

        .list-group-item {
            cursor: pointer;
        }
    </style>
@endsection

@section('main_content')
    <!-- Main Content -->

    <div class="row">
        <div class="col-md-5" id="widget-section">
            <div class="card p-0">
                <a href="#allWidgets" class="px-4 py-3 card-body d-flex justify-content-between" data-toggle="collapse"
                    aria-expanded="true" aria-controls="allWidgets">
                    <span class="black bold font-16">{{ translate('Available Widgets') }}</span>
                    <span class="collapse_icon"><i
                            class="icofont-arrow-right black bold font-16 d-inline-block collapse_arrow"></i></span>
                </a>
            </div>

            <div class="collapse show" id="allWidgets">
                <div class="row my-4">
                    @if (count($widgets) > 0)
                        @foreach ($widgets as $widget)
                            <div class="col-md-6 mb-2 widget-col">
                                <div class="row">
                                    <div class="col-sm-12 mb-2 widget">
                                        <div class="card card-body p-0">
                                            <div class="widget-info px-3 py-3 d-flex justify-content-between">
                                                <input type="hidden" name="id" value="{{ $widget->id }}">
                                                <input type="hidden" name="sidebar_has_widget_id">
                                                <span class="black bold font-14">{{ $widget->widget_name }}</span>
                                                <div>
                                                    <span class="dropdown_icon widget-dropdown"><i
                                                            class="icofont-arrow-right black bold d-inline-block font-14"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <small class="col-12">{{ $widget->widget_short_desc }}</small>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-7 mt-3 mt-sm-0">
            <div class="row">
                @php
                    $all_sidebar_attr_id = [];
                    $all_sidebar_name = [];
                @endphp
                @foreach ($sidebars as $sidebar)
                    @php
                        $sidebar_attr_id = str_replace(' ', '_', strtolower($sidebar->sidebar_name));
                        array_push($all_sidebar_attr_id, $sidebar_attr_id);
                        array_push($all_sidebar_name, $sidebar->sidebar_name);
                        $all_sidebar_widgets = getAllSidebarWidgets($sidebar->id);
                    @endphp
                    <div class="col-md-6 mb-5">
                        <div class="card p-0">
                            <a href="#{{ $sidebar_attr_id }}" class="card-header d-flex justify-content-between"
                                data-toggle="collapse" aria-expanded="true" aria-controls="{{ $sidebar_attr_id }}">
                                <span class="black bold font-16">{{ $sidebar->sidebar_name }}</span>
                                <span class="collapse_icon"><i
                                        class="icofont-arrow-right black bold font-16 d-inline-block collapse_arrow"></i></span>
                            </a>
                            <div class="collapse show mt-1 card-body sidebar-widget" id="{{ $sidebar_attr_id }}">
                                <input type="hidden" name="sidebar_id" value="{{ $sidebar->id }}">
                                @foreach ($all_sidebar_widgets as $widget)
                                    <div class="mb-2 widget-item widget-border">
                                        <div class="card card-body p-0">
                                            <div class="widget-info px-3 py-3 d-flex justify-content-between">
                                                <input type="hidden" name="id" value="{{ $widget->widget_id }}">
                                                <input type="hidden" name="sidebar_has_widget_id"
                                                    value="{{ $widget->sidebar_has_widget_id }}">
                                                <span class="black bold font-14">{{ $widget->widget_name }}</span>
                                                <div>
                                                    <span class="dropdown_icon sidebar-dropdown"><i
                                                            class="icofont-arrow-right black bold d-inline-block font-14"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        @if (!in_array(str_replace(' ', '_', strtolower($widget->widget_name)), ['author_widget', 'advertisement_widget']))
                                            <div class="p-1 lang-message d-none">
                                                <p class="alert alert-info">You are inserting
                                                    <strong>"{{ getLanguageNameByCode(getDefaultLang()) }}"</strong>
                                                    version
                                                </p>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
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
    <script src="{{ asset('/public/backend/assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

    {{-- Cookies Js --}}
    <script src="{{ asset('/public/backend/assets/plugins/js-cookie/js.cookie.min.js') }}"></script>

    <script>
        initDropzone();
        (function($) {
            "use strict";

            $(document).ready(function() {
                is_for_browse_file = true
                filtermedia();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                $('#closeForm').click(function() {
                    $('#collapse_button').click();
                });

                // widgets draggable to sidebar list
                $(".widget").draggable({
                    revert: "invalid",
                    helper: "clone",
                    cursor: 'pointer',
                    zIndex: 10000
                });

                // sidebar list sortable
                $('.sidebar-widget').sortable({
                    cursor: "move",
                    placeholder: 'sidebar-widget-placeholder',
                    revert: "invalid",
                    update: function(event, ui) {
                        let selectedSidebar = $(this).attr('id');
                        saveWidgetsOrder(selectedSidebar);
                        $('.sidebar-widget').sortable('refresh');
                    }
                });

                $('.sidebar-widget').droppable({
                    accept: ".widget",
                    drop: function(event, ui) {
                        let widget = $(ui.draggable).clone();
                        $(widget).removeClass('col-sm-12');
                        $(widget).removeClass('widget');
                        $(widget).addClass('widget-item');
                        $(widget).removeClass('ui-draggable');
                        $(widget).find('.widget-dropdown').removeClass('widget-dropdown').addClass(
                            'sidebar-dropdown');
                        $(widget).addClass('widget-border');
                        $(widget).appendTo(this);

                        let selectedSidebar = $(this).attr('id');
                        let widget_id = $(widget).find('input[name="id"]').val();
                        saveWidgetToSidebar(selectedSidebar, widget_id, widget);
                        $('.sidebar-widget').sortable('refresh');
                        $('.sidebar-dropdown').on('click', function() {
                            openSidebarDropMenu($(this));
                        });
                    },
                });
            });

            //clicking on dropdown icon
            $('.sidebar-dropdown').on('click', function() {
                openSidebarDropMenu($(this));
            });
            $('.widget-dropdown').on('click', function() {
                openDropMenu($(this));
            });
        })(jQuery);


        // Dropmenu function
        function openDropMenu(element) {
            "use strict";
            $(element).find('i').toggleClass('drop-menu');
            let sidebars = JSON.parse('<?php echo json_encode($all_sidebar_name); ?>');
            let sidebar_list = '';
            $.each(sidebars, function(index, value) {
                sidebar_list += '<li class="list-group-item black" onclick="selectForSidebar(this)" id="' +
                    value +
                    '">' +
                    value +
                    '</li>';
            });

            let html = `
                    <div class="col-12 my-3 select-sidebar">
                        <ul class="list-group">` +
                sidebar_list +
                `</ul>
                        <div class="button-group row justify-content-around mt-2">
                            <button class="btn btn-danger sm" onclick="cancelDropmenu(this)">{{ translate('Cancel') }}</button>
                            <button class="btn btn-primary sm" onclick="addWidget(this)">{{ translate('Add Widget') }}</button>
                        </div>
                    </div>
                `;

            let parentDiv = $(element).parents(':eq(5)');

            if ($(element).find('i').hasClass('drop-menu')) {
                parentDiv.append(html);
            } else {
                parentDiv.find('.select-sidebar').remove();
            }

            $(".widget-col").not(parentDiv).each(function(index) {
                $(this).toggleClass('area-disabled');
            });
        }

        // adding selected class for selected element
        function selectForSidebar(element) {
            "use strict";
            $('.list-group-item').each(function(index) {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                }
            })
            $(element).addClass('selected');
        }

        // cancel drop menu by trigger
        function cancelDropmenu(element) {
            "use strict";
            var dropdown_icon = $(element).parents(':eq(2)').find('.dropdown_icon');
            openDropMenu(dropdown_icon);
        }

        // add widget
        function addWidget(element) {
            "use strict";
            var idsOfSidebar = JSON.parse('<?php echo json_encode($all_sidebar_attr_id); ?>');

            var sidebar_item = $('.list-group .selected').attr('id');
            sidebar_item = sidebar_item.toLowerCase();
            sidebar_item = sidebar_item.replace(/ /g, "_");

            var widget = $(element).parents(':eq(2)').find('.widget');
            let idMatch = false;
            $.each(idsOfSidebar, function(index, value) {
                if (value == sidebar_item) {
                    idMatch = true;
                }
            });

            if (idMatch === true) {
                appendToSidebar(widget, sidebar_item);
            } else {
                toastr.error("{{ translate('Adding Widget To Sidebar Failed') }}", "Error!");
            }
            cancelDropmenu(element)
            $('.sidebar-widget').removeClass('no-widget');
        }

        // append widget to sidebar
        function appendToSidebar(widget, targetSidebar) {
            "use strict";
            var newWidget = $(widget).clone();
            let widget_id = $(newWidget).find('input[name="id"]').val();

            saveWidgetToSidebar(targetSidebar, widget_id, newWidget);
            $('.sidebar-widget').sortable('refresh');

            $(newWidget).removeClass('col-sm-12');
            $(newWidget).removeClass('widget');
            $(newWidget).addClass('widget-item');
            $(newWidget).removeClass('ui-draggable');
            $(newWidget).find('.widget-dropdown').removeClass('widget-dropdown').addClass('sidebar-dropdown');
            $(newWidget).find('i').removeClass('drop-menu');
            $(newWidget).addClass('widget-border');

            $(newWidget).appendTo('#' + targetSidebar)
            $('#' + targetSidebar).sortable('refresh');
            $('.sidebar-dropdown').on('click', function() {
                openSidebarDropMenu($(this));
            });
        }

        //sidebar Drop Menu
        function openSidebarDropMenu(element) {
            "use strict";
            $(element).find('i').toggleClass('drop-menu');
            let widget = $(element).parents(':eq(3)');
            let sidebar_has_widget_id = $(element).parents(':eq(2)').find('input[name="sidebar_has_widget_id"]')
                .val();
            let widget_id = $(element).parents(':eq(2)').find('input[name="id"]').val();

            if ($(element).find('i').hasClass('drop-menu')) {
                getSidebarHasWidgetField(sidebar_has_widget_id, widget_id, widget, '');
            } else {
                widget.find('.widget_input_field_form').remove();
                widget.find('.lang-message').addClass('d-none');
            }
        }

        // sidebar widgets field for translation
        function getSidebarWidgetTranslationField(element, sidebar_has_widget_id, widget_id, lang) {
            "use strict";
            let widget = $(element).parents(':eq(5)');
            getSidebarHasWidgetField(sidebar_has_widget_id, widget_id, widget, lang);
        }

        //get sidebar has widget field
        function getSidebarHasWidgetField(sidebar_has_widget_id, widget_id, widget, lang) {
            "use strict";
            $.ajax({
                type: "post",
                url: '{{ route('theme.default.widget.get_input_field') }}',
                data: {
                    widget_id: widget_id,
                    sidebar_has_widget_id: sidebar_has_widget_id,
                    lang: lang
                },
                success: function(res) {
                    if (res.error) {
                        toastr.error(res.error, "Error!");
                    } else {
                        let form = $(widget).find('form');
                        if (form.length === 0) {
                            $(res.html).appendTo(widget);
                        } else {
                            $(form).remove();
                            $(res.html).appendTo(widget);
                        }
                        widget.find('.lang-message').removeClass('d-none');
                        widget.find('.alert > strong').html('"' + res.lang_name + '"');
                    }
                },
                error: function(data, textStatus, jqXHR) {
                    toastr.error("{{ translate('Sidebar Widget Opening Failed') }}", "Error!");
                }
            });
        }

        // remove from sidebar list
        function removeFromSidebar(element) {
            "use strict";
            let selectedSidebar = $(element).parents(':eq(4)').attr('id');
            let widget = $(element).parents(':eq(3)');
            let sidebar_has_widget_id = $(widget).find('input[name="sidebar_has_widget_id"]').val();
            removeWidgeFromSidebar(selectedSidebar, sidebar_has_widget_id, widget);
            $('.sidebar-widget').sortable('refresh');
        }

        // close sidebar input menu list
        function closeSidebarDropMenu(element) {
            "use strict";
            var dropdown_icon = $(element).parents(':eq(3)').find('.dropdown_icon');
            openSidebarDropMenu(dropdown_icon);
        }

        // save widget to sidebar database
        function saveWidgetToSidebar(sidebar_attr_id, widget_id, element) {
            "use strict";
            let sidebar_id = $('#' + sidebar_attr_id).find('input[name="sidebar_id"]').val();

            $.ajax({
                type: "post",
                url: '{{ route('theme.default.widget.addToSidebar') }}',
                data: {
                    sidebar_id: sidebar_id,
                    widget_id: widget_id,
                },
                success: function(res) {
                    if (res.error) {
                        toastr.error(res.error, "Error!");
                        $('#' + sidebar_attr_id).find('input[value="' + widget_id + '"]').parents(
                                ':eq(2)')
                            .remove();
                    } else {
                        $(element).find('input[name="sidebar_has_widget_id"]').val(res
                            .sidebar_has_widget_id);
                        $('.sidebar-widget').sortable('refresh');
                        saveWidgetsOrder(sidebar_attr_id);
                        toastr.success(res.success, "Success!");
                    }
                },
                error: function(data, textStatus, jqXHR) {
                    toastr.error("{{ translate('Widget Added To Sidebar Failed') }}", "Error!");
                }
            });
        }

        // remove widget from sidebar database
        function removeWidgeFromSidebar(sidebar_attr_id, sidebar_has_widget_id, element) {
            "use strict";
            let sidebar_id = $('#' + sidebar_attr_id).find('input[name="sidebar_id"]').val();

            $.ajax({
                type: "post",
                url: '{{ route('theme.default.widget.removeFromSidebar') }}',
                data: {
                    sidebar_id: sidebar_id,
                    sidebar_has_widget_id: sidebar_has_widget_id,
                },
                success: function(res) {
                    if (res.demo_mode) {
                        toastr.error(res.message, "Alert!");
                    } else {
                        if (res.error) {
                            toastr.error(res.error, "Error!");
                            $('.sidebar-widget').sortable('refresh');
                        } else {
                            $(element).remove();
                            $('.sidebar-widget').sortable('refresh');
                            toastr.success(res.success, "Success!");
                            saveWidgetsOrder(sidebar_attr_id);
                        }
                    }
                },
                error: function(data, textStatus, jqXHR) {
                    toastr.error("{{ translate('Widget Added To Sidebar Failed') }}", "Error!");
                }
            });
        }

        //save sidebar widgets order
        function saveWidgetsOrder(sidebar_attr_id) {
            "use strict";
            let sidebar_id = $('#' + sidebar_attr_id).find('input[name="sidebar_id"]').val();
            let sidebar_widgets = $('#' + sidebar_attr_id).children().not('input[name="sidebar_id"]');
            let order = [];
            $(sidebar_widgets).each(function(index, element) {
                order.push({
                    id: $(this).find('input[name="sidebar_has_widget_id"]').val(),
                    position: index + 1
                });
            });

            if (order.length == 0) {
                return false;
            }

            $.ajax({
                type: "post",
                url: '{{ route('theme.default.widget.saveWidgetOrder') }}',
                data: {
                    order: order,
                    sidebar_id: sidebar_id,
                },
                success: function(res) {
                    if (res.error) {
                        toastr.error(res.error, "Error!");
                    }
                },
                error: function(data, textStatus, jqXHR) {
                    toastr.error("{{ translate('Widget Added To Sidebar Failed') }}", "Error!");
                }
            });
        }

        // save widget form button
        function widgetInputFormSubmit(element) {
            "use strict";
            let formData = $(element).serializeArray();
            let sidebar_has_widget_id = $(element).parent().find('input[name="sidebar_has_widget_id"]').val();

            $.ajax({
                type: "post",
                url: '{{ route('theme.default.widget.widgetSidebarForm') }}',
                data: {
                    data: formData,
                    sidebar_has_widget_id: sidebar_has_widget_id
                },
                success: function(res) {
                    if (res.error) {
                        toastr.error(res.error, "Error!");
                        $('.sidebar-widget').sortable('refresh');
                    } else {
                        location.reload();
                    }
                },
                error: function(data, textStatus, jqXHR) {
                    toastr.error("{{ translate('Widget Form Submit Failed Failed') }}", "Error!");
                }
            });
        }

        // author social link
        function authorSocialLink() {
            "use strict";
            var url = '{{ route('theme.default.options') }}';
            // set theme option cookies to social
            Cookies.set('theme-option', JSON.stringify({
                option: 'social',
                parent: null
            }), {
                expires: 1,
                path: '{{ env('APP_URL') }}'
            });
            window.location.href = url;
        }
    </script>
@endsection
