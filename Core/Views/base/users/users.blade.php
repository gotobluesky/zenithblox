@extends('core::base.layouts.master')
@section('title')
    {{ translate('Users') }}
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
    <!-- ======= END BEGIN PAGE LEVEL PLUGINS STYLES ======= -->
@endsection
@section('main_content')
    <div class="row">
        <!-- User List-->
        <div class="col-md-12">
            <div class="card mb-30">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="font-20">{{ translate('Users') }}</h4>
                        @if (auth()->user()->can('Create User'))
                            <div class="d-flex flex-wrap">
                                <a href="{{ route('core.add.user') }}" class="btn long">{{ translate('Add New User') }}</a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="hoverable text-nowrap border-top2 " id="user_table">
                        <thead>
                            <tr>
                                <th>#
                                <th>{{ translate('Image') }}</th>
                                <th>{{ translate('UID') }}</th>
                                <th>{{ translate('Name') }} </th>
                                <th>{{ translate('Email') }}</th>
                                <th>{{ translate('Roles') }}</th>
                                @if (auth()->user()->can('Edit User'))
                                    <th>{{ translate('Status') }}</th>
                                @endif
                                @if (auth()->user()->can('Edit User') ||
                                        auth()->user()->can('Delete User'))
                                    <th>{{ translate('Actions') }}</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $key = 1;
                            @endphp
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $key }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="img img-45">
                                                <img src="{{ asset(getFilePath($user->image)) }}"
                                                    alt="{{ $user->alt }}" class="img-45">
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $user->uid }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ implode(',', $user->roles) }}</td>
                                    @if (auth()->user()->can('Edit User'))
                                        <td>
                                            @if (!in_array('Super Admin' , $user->roles))
                                                <label class="switch success medium">
                                                    <input type="checkbox" class="user_status"
                                                        id="user_status_{{ $user->id }}" name="status"
                                                        {{ $user->status == 1 ? 'checked' : '' }}
                                                        onchange="updateUserStatus('{{ $user->id }}')">
                                                    <span class="control"></span>
                                                </label>
                                            @endif
                                        </td>
                                    @endif
                                    @if (auth()->user()->can('Edit User') ||
                                            auth()->user()->can('Delete User'))
                                        <td>
                                            <div class="dropdown-button">
                                                <a href="#" class="d-flex align-items-center" data-toggle="dropdown">
                                                    <div class="menu-icon style--two mr-0">
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                    </div>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    @if (auth()->user()->can('Edit User'))
                                                        <a href="{{ route('core.edit.user', $user->id) }}">Edit</a>
                                                    @endif
                                                    @if (auth()->user()->can('Delete User'))
                                                        <a href="#"
                                                            onclick="deleteConfirmation('{{ $user->id }}')">Delete</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                                @php
                                    $key++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- User List-->

        <!--Delete Modal-->
        <div id="delete-modal" class="delete-modal modal fade show" aria-modal="true">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title h6">{{ translate('Delete Confirmation') }}</h4>
                    </div>
                    <div class="modal-body text-center">
                        <p class="mt-1">{{ translate('Are you sure to delete this') }}?</p>
                        <form method="POST" action="{{ route('core.user.delete') }}">
                            @csrf
                            <input type="hidden" id="user_id" name="id">
                            <button type="button" class="btn long mt-2"
                                data-dismiss="modal">{{ translate('cancel') }}</button>
                            <button type="submit" class="btn long mt-2">{{ translate('Delete') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--Delete Modal-->
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

    <script type="application/javascript">
        (function($) {
            "use strict";
            $("#user_table").DataTable();
        })(jQuery);

        /**
         * Will request to update user status
         */
        function updateUserStatus(user_id) {
            "use strict";
            let status = 2
            if ($('#user_status_' + user_id).is(":checked")) {
                status = 1
            }
            $.post("{{ route('core.update.user.status') }}", {
                    _token: '{{ csrf_token() }}',
                    id: user_id,
                    status: status
                },
                function(data, status) {
                    toastr.success("User status updated successfully", "Success!");
                }).fail(function(xhr, status, error) {
                toastr.error("Unable to update user status", "!");
            });
        }

        /**
         * show delete confirmation modal
         */
        function deleteConfirmation(user_id) {
            "use strict";
            $("#user_id").val(user_id);
            $('#delete-modal').modal('show');
        }
</script>
@endsection
