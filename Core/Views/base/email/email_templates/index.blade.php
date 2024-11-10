@php
    $admin_email_templates = getEcommerceEmailTemplates();
    $html_array = [];
@endphp
@extends('core::base.layouts.master')
@section('title')
    {{ translate('Email Templates') }}
@endsection
@section('custom_css')
    <style>
        .et-iframe {
            min-height: 600px !important;
        }

        #editor {
            height: 450px;
            margin-bottom: 20px;
        }

        .table-scroll {
            overflow-x: auto;
        }
    </style>
@endsection
@section('main_content')
    <div class="row">
        <!-- Email Template List-->
        <div class="col-12">
            @foreach ($admin_email_templates as $key => $templates)
                @php
                    $template_name = implode(' ', explode('_', $key));
                @endphp
                <div class="card mb-30">
                    <div class="card-header bg-white border-bottom2 pb-0">
                        <div class="post-head d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex align-items-center">
                                <div class="content">
                                    <h4>{{ $template_name }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-scroll">
                            <table class="text-nowrap dh-table">
                                <thead>
                                    <tr>
                                        <th>{{ translate('No.') }}</th>
                                        <th>{{ translate('Template') }}</th>
                                        <th>{{ translate('Details') }}</th>
                                        <th>{{ translate('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $count = 0;
                                    @endphp
                                    @foreach ($templates as $template)
                                        @php
                                            $text = htmlentities($template['body'], ENT_QUOTES);
                                            $text = $text;
                                            $html_array[$key . '_' . $count] = $text;
                                        @endphp
                                        <tr>
                                            <td>{{ $count + 1 }}</td>
                                            <td>{{ $template['name'] }}</td>
                                            <td>{{ $template['details'] }}</td>
                                            <td>
                                                <div class="dropdown-button">
                                                    <a href="#" class="d-flex align-items-center"
                                                        data-toggle="dropdown">
                                                        <div class="menu-icon style--two mr-0">
                                                            <span></span>
                                                            <span></span>
                                                            <span></span>
                                                        </div>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="#"
                                                            onclick="getTemplateEditableForm(`{{ $template['name'] }}`,'{{ $template['template_id'] }}',`{{ $template['subject'] }}`,'{{ $key . '_' . $count }}')">
                                                            {{ translate('Update') }}
                                                        </a>
                                                        <a href="#"
                                                            onclick="getTemplateEditableForm(`{{ $template['name'] }}`,'{{ $template['template_id'] }}',`{{ $template['subject'] }}`,'{{ $key . '_' . $count }}')">
                                                            {{ translate('Preview') }}
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @php
                                            $count = $count + 1;
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Email Template List-->
        <!--Template preview modal-->
        <div id="template-preview-modal" class="template-preview-modal modal fade show" aria-modal="true">
            <div class="modal-dialog modal-xl mw-100 modal-dialog-top ml-2">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title bold black" id="template-name"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body content p-0">
                        <div class="row m-0">
                            <div class="col-lg-7 col-12">
                                <div class="card mb-lg-4" id="edit_template">
                                    <div class="card-body">
                                        <!--Email Subject-->
                                        <input type="hidden" name="template_id" id="template_id" value="">
                                        <div class="mb-20 form-row">
                                            <input type="text" name="subject" id="subject" class="theme-input-style"
                                                value="" placeholder="{{ translate('Enter email subject') }}">
                                            <div class="invalid-input" id="subject_update_error"></div>
                                        </div>
                                        <!--End Email Subject-->
                                        <!--Template Variables-->
                                        <div class="form-row mb-10">
                                            <div class="dropdown show">
                                                <a class="btn btn-secondary dropdown-toggle long rounded" href="#"
                                                    role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                                    aria-haspopup="true" onclick="getTemplateVariables()"
                                                    aria-expanded="false">
                                                    {{ translate('Variables') }}
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink"
                                                    id="variables">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row mb-10">
                                            <small class="black">NB: Plase use these variables to create this email
                                                template</small>
                                        </div>
                                        <!--End Template variables-->
                                        <!--Code here-->
                                        <div id="editor">
                                        </div>
                                        <!--Code here-->
                                        <!--Update and preview button-->
                                        <div class="form-row gap-10 justify-content-end">
                                            <button type="button" class="btn long btn-info"
                                                onclick="showIFrame()">{{ translate('Preview') }}</button>
                                            <button type="button" class="btn long"
                                                onclick="updateEmailTemplate()">{{ translate('Save Changes') }}</button>
                                        </div>
                                        <!--Ens update and preview button-->
                                    </div>
                                </div>
                            </div>
                            <!--Template preview-->
                            <div class="col-lg-5 col-12 mt-2">
                                <div class="card" id="preview_template">
                                    <div class="card-body">
                                        <iframe srcdoc="" class="et-iframe" id="iframe" width="100%"></iframe>
                                    </div>
                                </div>
                            </div>
                            <!--End template preview-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Template preview modal-->
    </div>
@endsection
@section('custom_scripts')
    <script src="https://unpkg.com/ace-builds@1.6.0/src-min-noconflict/ace.js"></script>
    <script src="{{ asset('/public/backend/assets/plugins/js-beautify/beautify-html.js') }}"></script>
    <script>
        /**
         * Get email template editable form
         */
        function getTemplateEditableForm(template_name, template_id, subject, key) {
            "use strict";
            //Beautify code
            let html_array = [<?php echo json_encode($html_array); ?>];
            let body = html_array[0][key];
            body = DOMPurify.sanitize(body);
            let content_after_beautification = beautyHtml(body);

            //Render preview
            let final_html = logoAndFooter(content_after_beautification);
            $('#iframe').attr('srcdoc', final_html)

            //Load code view
            $('#subject').val(subject)
            $('#template_id').val(template_id)
            $('#template-name').html(template_name);
            $('#template-preview-modal').modal('show');

            //Ace editor
            var editor = ace.edit("editor");
            editor.setValue(content_after_beautification, -1)
            editor.setOptions({
                fontSize: "16px"
            });

            editor.setTheme("ace/theme/terminal");
            editor.resize();
            editor.getSession().setMode("ace/mode/html");
        }
        /**
         * Preview html content inside I-frame 
         */
        function showIFrame() {
            "use strict";
            var editor = ace.edit("editor");
            var content = editor.getValue();
            content = DOMPurify.sanitize(content);
            let final_content = logoAndFooter(content);
            $('#iframe').attr('srcdoc', final_content)
        }
        /**
         * Update email template
         */
        function updateEmailTemplate() {
            "use strict";
            var editor = ace.edit("editor");
            var content = editor.getValue();
            content = DOMPurify.sanitize(content);
            let content_after_beautification = beautyHtml(content);
            let template_id = $('#template_id').val()
            let subject = $('#subject').val()

            $.post("{{ route('core.update.email.template') }}", {
                    _token: '{{ csrf_token() }}',
                    template_id: template_id,
                    subject: subject,
                    content: content_after_beautification
                },
                function(data, status) {
                    if (data.demo_mode) {
                        toastr.error(data.message, "Alert!");
                    } else {
                        toastr.success("Email template updated successfully");
                        location.reload();
                    }
                }).fail(function(xhr, status, error) {
                let error_response = JSON.parse(xhr.responseText);
                let error_message = error_response.message;
                let errors = {};
                if (error_response.hasOwnProperty('errors')) {
                    errors = error_response.errors;
                    if (errors.hasOwnProperty('subject') || errors.hasOwnProperty('content')) {
                        $('#subject_update_error').html(errors.subject);
                        $('#content_update_error').html(errors.content);
                    } else {
                        toastr.error(error_message);
                    }
                } else {
                    toastr.error(error_message);
                }

            });
        }
        /**
         * 
         **/
        function setTemplateVariable(variable_name) {
            "use strict";
            var editor = ace.edit("editor");
            editor.insert(variable_name);
        }
        /**
         * Will get template variables
         * 
         */
        function getTemplateVariables() {
            "use strict";
            let template_id = $('#template_id').val()
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                type: "POST",
                data: {
                    'template_id': template_id
                },
                url: '{{ route('core.get.email.template.variables') }}',
                success: function(response) {
                    $('#variables').html(response)
                },
                error: function(error) {}
            });
        }
        /**
         * Get logo and footer
         */
        function logoAndFooter(content) {
            "use strict";
            let system_logo = "{{ asset(getFilePath(getGeneralSetting('admin_logo'))) }}"
            let copyright_text = `{{ getGeneralSetting('copyright_text') }}`
            let site_url = `{{ URL::to('/') }}`

            let with_logo = content.replace('_system_logo_url_', system_logo);
            let with_footer = with_logo.replace('_footer_text_', copyright_text);
            let with_site_url = with_footer.replace('_site_link_', site_url);

            return with_site_url;
        }
        /**
         * Beautify contrnt
         */
        function beautyHtml(content) {
            "use strict";
            let result = content.replace(/&quot;/g, '"');
            let result2 = result.replace(/&apos;/g, "'");
            let result3 = result2.replace(/&nbsp;/g, " ");
            let result4 = result3.replace(/&lt;/g, "<");
            let result5 = result4.replace(/&gt;/g, ">");
            let result6 = result5.replace(/&amp;/g, "&");
            let result7 = result6.replace(/&copy;/g, "©");

            return result7;
        }
    </script>
@endsection
