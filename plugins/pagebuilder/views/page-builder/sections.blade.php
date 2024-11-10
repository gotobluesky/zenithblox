@extends('core::base.layouts.master')

@section('title')
    {{ translate('Page Builder') }}
@endsection

@section('custom_css')
    <!-- Jquery UI -->
    <link href="{{ asset('/public/backend/assets/plugins/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet">
    <!-- Summernote -->
    <link href="{{ asset('/public/backend/assets/plugins/summernote/summernote-lite.css') }}" rel="stylesheet" />

    @include('plugin/pagebuilder::page-builder.includes.styles')
@endsection

@section('main_content')
    <div class="border-bottom2 pb-3 mb-4 d-flex justify-content-between align-items-center">
        <h4 class="mb-sm-2"><i class="icofont-building-alt mr-1"></i>{{ $data['title'] }}</h4>
        <a href="{{ Plugin\PageBuilder\Helpers\BuilderHelper::$preview_url . $data['permalink'] }}" target="_blank"
            class="btn btn-info long mr-5">Preview</a>
    </div>

    <div class="row">
        <div class="col-md-8">
            <!-- Page Section List Start -->
            <div class="card">
                <div class="card-header">
                    <h4>{{ translate('Sections') }}</h4>
                </div>
                <div class="card-body">
                    <div class="section-list mx-2">
                        @foreach ($sections as $section)
                            <div class="row" id="section_{{ $section->id }}">
                                <a href="#" class="black my-auto drag-layout">
                                    <i class="icofont-drag"></i>
                                </a>
                                <div class="row my-2 mx-0 col-11 bg-white layout-height">
                                    @foreach ($section->layouts as $layout)
                                        <div class="col-{{ $layout->col_value }} p-0 section-column"
                                            style="border:1px solid" data-section-layout-id="{{ $layout->id }}">
                                            <!-- Layout Widgets -->
                                            @if (count($layout->layout_widgets))
                                                @foreach ($layout->layout_widgets as $layout_widget)
                                                    <div class="section-widget"
                                                        data-widget="{{ $layout_widget->widget->name }}"
                                                        data-widget-id="{{ $layout_widget->widget->id }}"
                                                        data-layout-widget-id="{{ $layout_widget->id }}">
                                                        <div
                                                            class="card card-body flex-row justify-content-between px-3 py-3">
                                                            <span
                                                                class="font-14 black bold">{{ $layout_widget->widget->full_name }}</span>

                                                            <div class="widget-icons">
                                                                <a href="javascript:void(0);" class="black dragWidget"><i
                                                                        class="icofont-drag1"></i></a>
                                                                <a href="javascript:void(0);" class="black editWidget"><i
                                                                        class="icofont-options mx-1"></i></a>
                                                                <a href="javascript:void(0);" class="black removeWidget"><i
                                                                        class="icofont-trash"></i></a><a>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                                <a href="#" class="black my-auto edit-section">
                                    <i class="icofont-options"></i>
                                </a>
                                <a href="#" class="black my-auto ml-2 remove-section">
                                    <i class="icofont-trash"></i>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    @if (!count($sections))
                        <p class="alert alert-danger text-center">{{ translate('No Section Found') }}</p>
                    @endif
                </div>
                <div class="card-footer text-center">
                    <div class="btn btn-primary sm" id="add_new_section_btn">{{ translate('Add New Section') }}</div>
                </div>
            </div>
            <!-- Page Section List End -->
        </div>
        <div class="col-md-4 builder-sidebar">
            <!-- Section/Widget Properties Start -->
            <div class="card mb-30 d-none" id="properties-section">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>{{ translate('Section Properties') }}</h4>
                        <a href="#properties-body" data-toggle="collapse" aria-expanded="true"
                            aria-controls="properties-body"><i
                                class="icofont-rounded-right black bold font-16 d-inline-block"></i></a>
                    </div>
                </div>
                <div class="collapse show" id="properties-body">
                    <form action="javascript:void(0);" method="post" id="properties-form">
                        <div class="card-body">
                            <div class="property-fields">
                                {{-- Section/Widget Properties --}}
                            </div>
                            <div class="form-row save-section mt-3">
                                <input type="hidden" name="type_key">
                                <input type="hidden" name="section_id">
                                <input type="hidden" name="layout_has_widget_id">
                                <div class="col-12 text-right">
                                    <button type="submit" class="btn long">{{ translate('Save') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Section/Widget Properties End -->

            <!-- Widget List Start -->
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>{{ translate('Widgets') }}</h4>
                        <a href="#widget-list-body" data-toggle="collapse" aria-expanded="true"
                            aria-controls="widget-list-body"><i
                                class="icofont-rounded-right black bold font-16 d-inline-block"></i></a>
                    </div>
                </div>
                <div class="collapse show" id="widget-list-body">
                    <div class="card-body">
                        <input type="text" name="" id="widget-search" class="form-control mb-3"
                            placeholder="{{ translate('Search Widget') }}">
                        <div class="widget-list">
                            @foreach ($widgets as $widget)
                                <div class="widget-single mb-2" data-widget="{{ $widget['name'] }}"
                                    data-widget-id="{{ $widget['id'] }}">
                                    <div class="card card-body flex-row justify-content-between px-3 py-3">
                                        <span class="font-14 black bold widget-title">{{ $widget['full_name'] }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- Widget List End -->
        </div>
    </div>

    <!--Delete Modal-->
    <div id="delete-modal" class="delete-modal modal fade show" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title h6">{{ translate('Delete Confirmation') }}</h4>
                </div>
                <div class="modal-body text-center">
                    <p class="mt-1">{{ translate('Are you sure to delete this') }}?</p>
                    <input type="hidden" id="delete-id" name="id">
                    <input type="hidden" id="section-id" name="section-id">
                    <button type="button" class="btn long mt-2 btn-danger"
                        data-dismiss="modal">{{ translate('cancel') }}</button>
                    <button type="submit" class="btn long mt-2" id="delete-btn">{{ translate('Delete') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!--Delete Modal-->

    <!--Layout Select Modal-->
    @include('plugin/pagebuilder::page-builder.includes.layout-modal')
    <!--Layout Select Modal-->

    <!-- Media Modal-->
    @include('core::base.media.partial.media_modal')
    <!-- Media Modal-->
@endsection
@section('custom_scripts')
    <!-- Jquery Ui js -->
    <script src="{{ asset('/public/backend/assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Summernote js -->
    <script src="{{ asset('/public/backend/assets/plugins/summernote/summernote-lite.js') }}"></script>
    <script>
        (function($) {
            'use strict';
            initDropzone()

            $(document).ready(function() {
                is_for_browse_file = true
                filtermedia()
                
                // Initialize the ajax token
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                // Widget draggable initialise
                $('.widget-single').draggable({
                    revert: "invalid",
                    helper: "clone",
                    cursor: 'pointer',
                    zIndex: 10000,
                    start: function(event, ui) {
                        ui.helper.addClass("widget-placeholder");
                    }
                });

                // Sections sortable initialise
                $('.section-list').sortable({
                    cursor: "move",
                    revert: "invalid",
                    handle: '.drag-layout',
                    placeholder: 'widget-placeholder',
                    update: function(e, u) {
                        let data = $(this).sortable('serialize');
                        updateSectionOrder(data);
                    }
                });

                // Widget Dropable and Sortable initialise
                droppableAndSortableInit();

                // Add New Section Modal show
                $(document).on('click', '#add_new_section_btn', function() {
                    $('#layout-modal').modal('show');
                });

                // Select Layout
                $(document).on('change', 'input[name="section_layout"]', function() {
                    let layout = $('input[name="section_layout"]:checked').val();
                    if (layout) {
                        let order = $('.section-list').children().length + 1;
                        createNewSection(layout, order);
                        $('input[name="section_layout"]:checked').prop('checked', false);
                    }
                });

                // Remove Section Modal Show
                $(document).on('click', '.remove-section', function() {
                    $('#delete-modal').modal('show');
                    let section_id = $(this).parent().attr('id').replace('section_', '');
                    $('#delete-id').val(section_id);
                    $('#delete-btn').addClass('delete-section-btn');
                });

                // Remove Section button click
                $(document).on('click', '.delete-section-btn', function() {
                    let section_id = $('#delete-id').val();
                    removeSection(section_id);
                    $('#delete-btn').removeClass('delete-section-btn');
                });

                // Edit section button click
                $(document).on('click', '.edit-section', function() {
                    let section_id = $(this).parent().attr('id').replace('section_', '');
                    getSectionProperties(section_id);
                });

                // Remove Widget Modal Show
                $(document).on('click', '.removeWidget', function() {
                    $('#delete-modal').modal('show');
                    let layout_widget_id = $(this).parents(':eq(2)').data('layoutWidgetId');
                    let section_id = $(this).parents(':eq(5)').attr('id').replace('section_', '');

                    $('#delete-id').val(layout_widget_id);
                    $('#section-id').val(section_id);

                    $('#delete-btn').addClass('delete-widget-btn');
                });

                // Remove Widget button click
                $(document).on('click', '.delete-widget-btn', function() {
                    let layout_widget_id = $('#delete-id').val();
                    let section_id = $('#section-id').val();
                    let widget_name = $('[data-layout-widget-id="' + layout_widget_id + '"]').data(
                        'widget');

                    removeWidget(layout_widget_id, section_id, widget_name);
                    $('#delete-btn').removeClass('delete-widget-btn');
                });

                // Edit Widget button click
                $(document).on('click', '.editWidget', function() {
                    let widget = $(this).parents(':eq(2)').data('widget');
                    let section_id = $(this).parents(':eq(5)').attr('id').replace('section_', '');
                    let layout_widget_id = $(this).parents(':eq(2)').data('layoutWidgetId');
                    let lang = '{{ getDefaultLang() }}';

                    getWidgetProperties(widget, layout_widget_id, section_id, lang);
                });

                // Search Widget and filter widget list
                let all_widgets = $('.widget-list').children();
                $(document).on('keyup', '#widget-search', function() {
                    let text = $(this).val().toLowerCase();

                    let search_widgets = all_widgets.filter((index, widget) => {
                        let widget_name = $(widget).find('.widget-title').text().toLowerCase();
                        return widget_name.includes(text)
                    });

                    $('.widget-list').empty().append(search_widgets);

                    $('.widget-single').draggable({
                        revert: "invalid",
                        helper: "clone",
                        cursor: 'pointer',
                        zIndex: 10000,
                        start: function(event, ui) {
                            ui.helper.addClass("widget-placeholder");
                        }
                    });
                });

                // Widget Translate Form
                $(document).on('click', '.lang', function() {
                    let widget = $(this).data('widget');
                    let lang = $(this).data('lang');
                    let section_id = $('#properties-body').find('input[name="section_id"]').val();
                    let layout_widget_id = $('#properties-body').find(
                        'input[name="layout_has_widget_id"]').val();

                    getWidgetProperties(widget, layout_widget_id, section_id, lang);
                });

                // Submit properties form
                $(document).on('submit', '#properties-form', function(e) {
                    e.preventDefault();
                    let data = $(this).serializeArray();
                    var updated_data = {};

                    $.map(data, function(value) {
                        updated_data[value['name']] = value['value'];
                    });
                    updated_data.page = '{{ $data['id'] }}';
                    saveProperties(updated_data);
                });

                // Color Field Value
                $(document).on('input', '.color-picker', function(e) {
                    let target = e.target;
                    $(target).closest('.addon').find('.color-input').val($(this).val());
                });

                // Range Selector
                $(document).on('input', '.range-selector', function() {
                    let input_filed = $(this).attr('id').replace('range_', '');
                    $('input[name="' + input_filed + '"]').val($(this).val());
                });

            });

            //Create selected section and make layouts
            function createNewSection(layout, order) {
                $.ajax({
                    type: "post",
                    url: "{{ route('plugin.builder.pageSection.new') }}",
                    data: {
                        layout: layout,
                        page_id: '{{ $data['id'] }}',
                        order: order
                    },
                    success: function(response) {
                        toastr.success(response.message, 'Success');
                        makeLayout(layout, response.data.section_id, response.data.layout_ids);
                    },
                    error: function(xhr, status, error) {
                        let message = "{{ translate('Page Section Create Request Failed') }}";
                        if (xhr.responseJSON) {
                            message = xhr.responseJSON.message;
                        }
                        toastr.error(message, 'ERROR!!');
                    }
                });
            };

            //Remove selected sections
            function removeSection(section_id) {
                $.ajax({
                    type: "post",
                    url: "{{ route('plugin.builder.pageSection.remove') }}",
                    data: {
                        id: section_id,
                        page_id: '{{ $data['id'] }}',
                        page_permalink: '{{ $data['permalink'] }}'
                    },
                    success: function(response) {
                        toastr.success(response.message, 'Success');
                        $('#section_' + section_id).remove();
                        $('#delete-modal').modal('hide');
                        if ($('.section-list').children().length < 1) {
                            $('.section-list').after(
                                `<p class="alert alert-danger text-center">No Section Found</p>`);
                        }
                        if (!$('#properties-section').hasClass('d-none')) {
                            $('#properties-section').addClass('d-none');
                        }
                    },
                    error: function(xhr, status, error) {
                        let message = "{{ translate('Page Section Remove Request Failed') }}";
                        if (xhr.responseJSON) {
                            message = xhr.responseJSON.message;
                        }
                        toastr.error(message, 'ERROR!!');
                    }
                });
            };

            //Update Section Order
            function updateSectionOrder(data) {
                $.ajax({
                    type: 'post',
                    url: "{{ route('plugin.builder.pageSection.sorting') }}",
                    data: data,
                    success: function(response) {
                        toastr.success(response.message, 'Success');
                    },
                    error: function(xhr, status, error) {
                        let message = "{{ translate('Page Section Remove Request Failed') }}";
                        if (xhr.responseJSON) {
                            message = xhr.responseJSON.message;
                        }
                        toastr.error(message, 'ERROR!!');
                    }
                });
            };

            // Get Section Properties
            function getSectionProperties(section_id) {
                $.ajax({
                    type: "post",
                    url: "{{ route('plugin.builder.pageSection.get.properties') }}",
                    data: {
                        section_id: section_id
                    },
                    success: function(response) {
                        $('.property-fields').html(response.data);
                        $('#properties-section').removeClass('d-none');
                        $('#properties-section').find('h4').html("{{ translate('Section Properties') }}");
                        $('#properties-body').find('input[name="type_key"]').val('section_id');
                        $('#properties-body').find('input[name="section_id"]').val(section_id);
                        $('#properties-body').find('input[name="layout_has_widget_id"]').val('');
                    },
                    error: function(xhr, status, error) {
                        let message = "{{ translate('Section Edit Request Failed') }}";
                        if (xhr.responseJSON) {
                            message = xhr.responseJSON.message;
                        }
                        toastr.error(message, 'ERROR!!');
                    }
                });
            };

            // Make Layout
            function makeLayout(layout, section_id, layout_ids) {
                let colums = layout.split('_');
                let columns_markup = '';
                for (let i = 0; i < colums.length; i++) {
                    columns_markup +=
                        `<div class="col-${colums[i]} p-0 section-column" style="border:1px solid" data-section-layout-id="${layout_ids[i]}"></div>`;
                }
                let layout_markup = `
                        <div class ="row" id="section_${section_id}">
                            <a href="#" class="black my-auto drag-layout">
                                <i class="icofont-drag"></i>
                            </a>
                            <div class="row my-2 mx-0 col-11 bg-white layout-height">` + columns_markup + `</div>
                            <a href="#" class="black my-auto edit-section">
                                <i class="icofont-options"></i>
                            </a>
                            <a href="#" class="black my-auto ml-2 remove-section">
                                <i class="icofont-trash"></i>
                            </a>
                        </div>
                    `;

                $('.section-list').next().remove();
                $('.section-list').append(layout_markup);
                $('#layout-modal').modal('hide');
                droppableAndSortableInit();
            };

            // Save to widget to database
            function saveWidget(data, widget, section) {
                $.ajax({
                    type: "post",
                    url: "{{ route('plugin.builder.pageSection.widget.add') }}",
                    data: {
                        section_layout_id: data.section_layout_id,
                        widget_id: data.widget_id
                    },
                    success: function(response) {
                        toastr.success(response.message, 'Success');
                        appendWidgetToLayout(widget, section, response.data.id);
                        updateWidgetOrder(data.section_layout_id);
                    },
                    error: function(xhr, status, error) {
                        let message = "{{ translate('Widget Adding Request Failed') }}";
                        if (xhr.responseJSON) {
                            message = xhr.responseJSON.message;
                        }
                        toastr.error(message, 'ERROR!!');
                    }
                });
            };

            // Remove widget from layouts and database
            function removeWidget(layout_widget_id, section_id, widget_name) {
                $.ajax({
                    type: "post",
                    url: "{{ route('plugin.builder.pageSection.widget.remove') }}",
                    data: {
                        layout_widget_id: layout_widget_id,
                        section_id: section_id,
                        widget_name: widget_name,
                        page_permalink: '{{ $data['permalink'] }}'
                    },
                    success: function(response) {
                        toastr.success(response.message, 'Success');
                        let element = $('[data-layout-widget-id="' + layout_widget_id + '"]');
                        let layout_id = element.parent().data('sectionLayoutId');
                        element.remove();
                        $('#delete-modal').modal('hide');
                        updateWidgetOrder(layout_id);
                        if (!$('#properties-section').hasClass('d-none')) {
                            $('#properties-section').addClass('d-none');
                        }
                    },
                    error: function(xhr, status, error) {
                        let message = "{{ translate('Widget Removing Request Failed') }}";
                        if (xhr.responseJSON) {
                            message = xhr.responseJSON.message;
                        }
                        toastr.error(message, 'ERROR!!');
                    }
                });
            };

            // Update widget position by sorting widget
            function changeWidgetPosition(data) {
                $.ajax({
                    type: "post",
                    url: "{{ route('plugin.builder.pageSection.widget.updatePosition') }}",
                    data: {
                        ...data
                    },
                    success: function(response) {
                        toastr.success(response.message, 'Success');
                        updateWidgetOrder(data.new_layout_id);
                        if (!$('#properties-section').hasClass('d-none')) {
                            $('#properties-section').addClass('d-none');
                        }
                    },
                    error: function(xhr, status, error) {
                        let message = "{{ translate('Widget Position Update Request Failed') }}";
                        if (xhr.responseJSON) {
                            message = xhr.responseJSON.message;
                        }
                        toastr.error(message, 'ERROR!!');
                    }
                });
            };

            // Update Widget Order
            function updateWidgetOrder(layout_id) {
                $('.section-column').sortable("disable");
                let data = $('[data-section-layout-id="' + layout_id + '"]').children();
                let layout_widget_ids = [];
                data.each(function(index, element) {
                    layout_widget_ids.push($(element).data('layoutWidgetId'));
                });

                if (layout_widget_ids.length) {
                    $.ajax({
                        type: "post",
                        url: "{{ route('plugin.builder.pageSection.widget.order') }}",
                        data: {
                            layout_id: layout_id,
                            layout_widget_ids: layout_widget_ids
                        },
                        success: function(response) {
                            $('.section-column').sortable("enable");
                        },
                        error: function(xhr, status, error) {
                            let message = "{{ translate('Widget Order Request Failed') }}";
                            if (xhr.responseJSON) {
                                message = xhr.responseJSON.message;
                            }
                            toastr.error(message, 'ERROR!!');
                        }
                    });
                }
            };

            // Will initialise the droppable and sortable of widget
            function droppableAndSortableInit() {
                // Section column droppable for widgets initialise
                $('.section-column').droppable({
                    accept: ".widget-single",
                    drop: function(event, ui) {
                        let widget = $(ui.draggable).clone();
                        const data = {
                            widget_id: $(widget).data('widgetId'),
                            section_layout_id: $(this).data('sectionLayoutId')
                        };
                        saveWidget(data, widget, this);
                    },
                });

                // Section columns are sortable initialise
                $('.section-column').sortable({
                    cursor: "move",
                    revert: "invalid",
                    handle: '.dragWidget',
                    connectWith: ".section-column",
                    placeholder: 'widget-placeholder',
                    update: function(event, ui) {
                        let ownlist = ui.sender == null;
                        if (!ownlist) {
                            let data = {
                                widget_id: $(ui.item).data('widgetId'),
                                layout_widget_id: $(ui.item).data('layoutWidgetId'),
                                new_layout_id: $(this).data('sectionLayoutId'),
                                prev_layout_id: $(ui.sender).data('sectionLayoutId'),
                                new_section_id: $(this).parents(':eq(1)').attr('id').replace('section_',
                                    ''),
                                prev_section_id: $(ui.sender).parents(':eq(1)').attr('id').replace(
                                    'section_', ''),
                                page_permalink: '{{ $data['permalink'] }}'
                            };
                            changeWidgetPosition(data);
                        } else {
                            updateWidgetOrder($(this).data('sectionLayoutId'));
                        }
                    }
                });
            };

            // Append new widget to layout
            function appendWidgetToLayout(widget, section, id) {
                $(widget).removeClass('mb-2');
                $(widget).removeClass('widget-single').addClass('section-widget');
                $(widget).removeClass('ui-draggable');
                $(widget).removeClass('ui-draggable-handle');
                $(widget).attr('data-layout-widget-id', id);
                $(widget).appendTo(section);
                let actionMarkup = `
                            <div class="widget-icons">
                                <a href="javascript:void(0);" class="black dragWidget"><i class="icofont-drag1"></i></a>
                                <a href="javascript:void(0);" class="black editWidget"><i class="icofont-options mx-1"></i></a>
                                <a href="javascript:void(0);" class="black removeWidget"><i class="icofont-trash"></i><a>
                            </div>`;
                $(widget).find('.card').append(actionMarkup);
            };

            // Get Widget Properties Form
            function getWidgetProperties(widget, layout_widget_id, section_id, lang) {
                $.ajax({
                    type: "post",
                    url: "{{ route('plugin.builder.pageSection.widget.get.properties') }}",
                    data: {
                        widget_name: widget,
                        layout_widget_id: layout_widget_id,
                        lang: lang
                    },
                    success: function(response) {
                        $('.property-fields').html(response.data);
                        $('#properties-section').removeClass('d-none');
                        $('#properties-section').find('h4').html(widget.split('_').map((str) => str.charAt(
                                0).toUpperCase() + str.slice(1)).join(' ') + ' ' +
                            "{{ translate('Properties') }}");
                        $('#properties-body').find('input[name="type_key"]').val('layout_has_widget_id');
                        $('#properties-body').find('input[name="section_id"]').val(section_id);
                        $('#properties-body').find('input[name="layout_has_widget_id"]').val(
                            layout_widget_id);

                        // Dissable Fields if not default language
                        if (lang != "{{ getDefaultLang() }}") {
                            dissableNotTranslatedField();
                        }
                    },
                    error: function(xhr, status, error) {
                        let message = "{{ translate('Widget Edit Request Failed') }}";
                        if (xhr.responseJSON) {
                            message = xhr.responseJSON.message;
                        }
                        toastr.error(message, 'ERROR!!');
                    }
                });
            };

            // Save Section/Widget Properties
            function saveProperties(data) {
                let url = "{{ route('plugin.builder.pageSection.widget.update.properties') }}";
                if(data.type_key == 'section_id'){
                    url = "{{ route('plugin.builder.pageSection.update.properties') }}"
                }
                $.ajax({
                    type: "post",
                    url: url,
                    data: {
                        ...data
                    },
                    success: function(response) {
                        toastr.success(response.message, 'Success');
                    },
                    error: function(xhr, status, error) {
                        let message = "{{ translate('Properties Update Request Failed') }}";
                        if (xhr.responseJSON) {
                            message = xhr.responseJSON.message;
                        }
                        toastr.error(message, 'ERROR!!');
                    }
                });
            };

            // Dissable All Fields That Are Not For Translate
            function dissableNotTranslatedField() {

                $('#myTabContent .form-group, #myTabContent .form-row').each(function(index, element) {
                    if (!$(element).hasClass('translate-field')) {
                        $(element).addClass('area-disabled');
                    }
                });
            }

        })(jQuery);
    </script>
@endsection
