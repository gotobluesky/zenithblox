@extends('core::base.layouts.master')
@section('title')
    {{ translate('Users login activity') }}
@endsection
@section('custom_css')
    <!-- ======= BEGIN PAGE LEVEL PLUGINS STYLES ======= -->
    <link rel="stylesheet" href="{{ asset('/public/backend/assets/plugins/data-table/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('/public/backend/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('/public/backend/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

    <link rel="stylesheet"
        href="{{ asset('/public/backend/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/public/backend/assets/plugins/fontawsome/css/all.min.css') }}">
    <!-- ======= END BEGIN PAGE LEVEL PLUGINS STYLES ======= -->
@endsection
@section('main_content')
    <div class="row">
        <!-- Login activity list -->
        <div class="col-12">
            <div class="card">
                <div class="card-body border-bottom2 mb-20">
                    <h4 class="font-20 ">{{ translate('Users Login Activity') }}</h4>
                </div>
                <div class="table-responsive">
                    <table id="login_activity" class="hoverable text-nowrap border-top2">
                        <thead>
                            <tr>
                                <th>
                                    <label class="position-relative mr-2">
                                        <input type="checkbox" name="select_all" class="select-all" onchange="selectAll()">
                                        <span class="checkmark"></span>
                                    </label>
                                </th>
                                <th>{{ translate('User') }}</th>
                                <th>{{ translate('Login At') }}</th>
                                <th>{{ translate('Logout At') }}</th>
                                <th>{{ translate('IP') }}</th>
                                <th>{{ translate('Operating System') }}</th>
                                <th>{{ translate('Browser') }}</th>
                                <th>{{ translate('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /Login activity list -->

        <!--Delete Modal-->
        <div id="delete-modal" class="delete-modal modal fade show" aria-modal="true">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title h6">{{ translate('Delete Confirmation') }}</h4>
                    </div>
                    <div class="modal-body text-center">
                        <p class="mt-1">{{ translate('Are you sure to delete this') }}?</p>
                        <form method="POST" action="{{ route('core.login.activity.delete') }}">
                            @csrf
                            <input type="hidden" id="login_activity_id" name="id">
                            <button type="button" class="btn long mt-2"
                                data-dismiss="modal">{{ translate('cancel') }}</button>
                            <button type="submit" class="btn btn-danger long mt-2">{{ translate('Delete') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--/Delete Modal-->
    </div>
@endsection
@section('custom_scripts')
    <script src="{{ asset('/public/backend/assets/plugins/data-table/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/public/backend/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/public/backend/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}">
    </script>
    <script src="{{ asset('/public/backend/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}">
    </script>

    <script src="{{ asset('/public/backend/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('/public/backend/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/public/backend/assets/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('/public/backend/assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('/public/backend/assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('/public/backend/assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('/public/backend/assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('/public/backend/assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            "use strict";
            //Datatable initialization
            var table = $('#login_activity').DataTable({
                processing: true,
                serverSide: true,
                dom: 'Blfrtip',
                responsfive: true,
                buttons: [{
                    extend: 'copyHtml5',
                    text: '<i class="icofont-copy-invert"></i>',
                    title: $("#logo_title").val(),
                    titleAttr: 'Copy',
                    exportOptions: {
                        columns: ':visible',
                        columns: ':not(:last-child)',
                    }
                }, {
                    extend: 'excelHtml5',
                    text: '<i class="icofont-file-excel"></i>',
                    titleAttr: 'Excel',
                    title: $("#logo_title").val(),
                    margin: [10, 10, 10, 0],
                    exportOptions: {
                        columns: ':visible',
                        columns: ':not(:last-child)',
                    },
                }, {
                    extend: 'csvHtml5',
                    text: '<i class="icofont-file-excel"></i>',
                    titleAttr: 'CSV',
                    exportOptions: {
                        columns: ':visible',
                        columns: ':not(:last-child)',
                    }
                }, {
                    extend: 'pdfHtml5',
                    text: '<i class="icofont-file-pdf"></i>',
                    title: $("#logo_title").val(),
                    titleAttr: 'PDF',
                    exportOptions: {
                        columns: ':visible',
                        columns: ':not(:last-child)',
                    },
                    orientation: 'landscape',
                    pageSize: 'A4',
                    margin: [0, 0, 0, 12],
                    alignment: 'center',
                    header: true,
                    customize: function(doc) {
                        doc.content.splice(1, 0, {
                            margin: [0, 0, 0, 12],
                            alignment: 'center',
                            image: "data:image/png;base64," + $("#logo_img").val()
                        });
                    }

                }, {
                    extend: 'print',
                    text: '<i class="icofont-printer"></i>',
                    titleAttr: 'Print',
                    title: $("#logo_title").val(),
                    exportOptions: {
                        columns: ':not(:last-child)',
                    }
                }, {
                    extend: 'colvis',
                    text: '<i class="fa fa-columns"></i>',
                    postfixButtons: ['colvisRestore']
                }],
                ajax: "{{ route('core.get.all.login.activity') }}",
                columns: [{
                        data: 'log_id',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return data ? '<div class="d-flex align-items-center">\n' +
                                '<label class="position-relative">\n' +
                                '<input type="checkbox" name="login_activity_id[]" class="login-activity-id mt-2" value="' +
                                data + '">\n' +
                                '<span class="checkmark"></span>\n' +
                                '</label>\n' +
                                '</div>' : '';
                        },
                    },
                    {
                        data: 'user_name',
                        label: 'User',
                        name: 'tl_users.name'
                    },
                    {
                        data: 'login_at',
                        name: 'admin_login_activity_log.login_at'
                    },
                    {
                        data: 'logout_at',
                        name: 'admin_login_activity_log.logout_at'
                    },
                    {
                        data: 'ip'
                    },
                    {
                        data: 'os',
                        label: 'Operating System'
                    },
                    {
                        data: 'browser'
                    },
                    {
                        data: null,
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return data ? '<div class="dropdown-button">\n' +
                                '<a href="#" class="d-flex align-items-center justify-content-end" data-toggle="dropdown">\n' +
                                '<div class="menu-icon mr-0">\n' +
                                '<span></span>\n' +
                                '<span></span>\n' +
                                '<span></span>\n' +
                                '</div>\n' +
                                '</a>\n' +
                                '<div class="dropdown-menu dropdown-menu-right">\n' +
                                '<a type="button" onclick="deleteLog(' + row.log_id +
                                ')">{{ translate('Delete') }}</a>\n' +
                                '</div>\n' +
                                '</div>' : '';
                        },
                    }
                ],
            });
            
            var bulk_actions_dropdown =
                '<div id="bulk-action" class="dataTables_length d-flex"><select class = "theme-input-style bulk-action-selection mr-3" > \n ' +
                '<option value="">{{ translate('
                        Bulk Action ') }}</option>\n' +
                '<option value="delete_all">{{ translate('
                        Delete selection ') }}</option>\n' +
                '</select><button class="btn long" onclick="bulkAction()">{{ translate('
                        Apply ') }}</button></div>\n';

            $(bulk_actions_dropdown).insertAfter("#login_activity_wrapper #login_activity_length");
        });

        /**
         * Showing activity log deleting modal
         */
        function deleteLog(log_id) {
            "use strict";
            $("#login_activity_id").val(log_id);
            $('#delete-modal').modal('show');
        }

        /**
         * Bulk activity log delete
         **/
        function bulkAction() {
            "use strict";
            let action = $('.bulk-action-selection').val();
            if (action === 'delete_all') {
                var selected_items = [];
                $('input[name^="login_activity_id"]:checked').each(function() {
                    selected_items.push($(this).val());
                });
                if (selected_items.length > 0) {
                    $.post('{{ route('core.login.activity.bulk.delete') }}', {
                            _token: '{{ csrf_token() }}',
                            data: selected_items
                        },
                        function(data) {
                            location.reload();
                        })
                } else {
                    toastr.error('{{ translate('No Item Selected ') }}', "Error!");
                }
            } else {
                toastr.error('{{ translate('No Action Selected ') }}', "Error!");
            }
        }

        /**
         * Select all table item
         **/
        function selectAll() {
            "use strict";
            if ($('.select-all').is(":checked")) {
                $(".login-activity-id").prop("checked", true);
            } else {
                $(".login-activity-id").prop("checked", false);
            }
        }
    </script>
@endsection
