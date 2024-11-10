@php
    $permissions = getAllPermissions();
    $last_permission_id = getLastPermissionId();
    $permissionModules = getPermissionsModules();
@endphp
@extends('core::base.layouts.master')
@section('title')
    {{ translate('Roles') }}
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
    <style>
        .table-scroll {
            overflow-x: auto;
        }
    </style>
@endsection
@section('main_content')
    <div class="row">
        <!-- Role List-->
        <div class="col-md-5">
            <div class="card mb-30">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <h4 class="font-20">{{ translate('Roles') }}</h4>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="hoverable text-nowrap border-top2 " id="role_table">
                        <thead>
                            <tr>
                                <th>#
                                <th>{{ translate('Name') }}</th>
                                @if (auth()->user()->can('Edit Role') ||
                                        auth()->user()->can('Delete Role'))
                                    <th>{{ translate('Actions') }}</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $key = 1;
                            @endphp
                            @foreach ($roles as $role)
                                @if ($role->id != config('settings.roles.supper_admin'))
                                    <tr>
                                        <td>{{ $key }}</td>
                                        <td>{{ $role->name }}</td>
                                        @if (auth()->user()->can('Edit Role') ||
                                                auth()->user()->can('Delete Role'))
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
                                                        @if (auth()->user()->can('Edit Role'))
                                                            <a href="#"
                                                                onclick="showEditableForm('{{ $role->id }}')">Edit</a>
                                                        @endif
                                                        @if (auth()->user()->can('Delete Role'))
                                                            <a href="#"
                                                                onclick="deleteConfirmation('{{ $role->id }}')">Delete</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                    @php
                                        $key++;
                                    @endphp
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Role List-->

        @if (auth()->user()->can('Create Role') ||
                auth()->user()->can('Edit Role'))
            <div class="col-md-7 mb-30">
                @if (auth()->user()->can('Create Role'))
                    <!-- Add new role-->
                    <div class="card">
                        <div class="card-body">
                            <div class="post-head d-flex justify-content-between align-items-center mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="content">
                                        <h4 class="mb-1">{{ translate('Add Role') }}</h4>
                                    </div>
                                </div>
                                <div id="add_role_down_icon" class="icon" onclick="toggleRoleAddingForm()">
                                    <i class="icofont-simple-down"></i>
                                </div>
                                <div id="add_role_up_icon" class="icon" onclick="toggleRoleAddingForm()">
                                    <i class="icofont-simple-up"></i>
                                </div>
                            </div>

                            <div id="add_role">
                                <form action="{{ route('core.add.role') }}" method="POST">
                                    @csrf
                                    <div class="form-row mb-20">
                                        <div class="col-md-4">
                                            <label class="font-14 bold black">{{ translate('Name') }}</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" name="role_name" class="theme-input-style"
                                                value="{{ old('role_name') }}"
                                                placeholder="{{ translate('Give role name') }}">
                                            @if ($errors->has('role_name'))
                                                <div class="invalid-input">{{ $errors->first('role_name') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-row mb-20">
                                        <input type="hidden" name="permissions" id="permissions">
                                        <div class="col-sm-12 table-scroll">
                                            <h4 class="mb-3">{{ translate('Permissions') }}</h5>
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">{{ translate('Module') }}</th>
                                                            <th scope="col">{{ translate('Feature') }}</th>
                                                            <th scope="col">{{ translate('Show') }}</th>
                                                            <th scope="col">{{ translate('Create') }}</th>
                                                            <th scope="col">{{ translate('Edit') }}</th>
                                                            <th scope="col">{{ translate('Delete') }}</th>
                                                            <th scope="col">{{ translate('Manage') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @for ($i = 0; $i < sizeof($permissionModules); $i++)
                                                            @php
                                                                $permissions = getPermissionsOfModule($permissionModules[$i]->id);
                                                                $show_permission_id = hasPermissionInThisModule($permissionModules[$i]->id, translate('Show ') . ' ' . $permissionModules[$i]->module_name);
                                                                $create_permission_id = hasPermissionInThisModule($permissionModules[$i]->id, translate('Create ') . ' ' . $permissionModules[$i]->module_name);
                                                                $edit_permission_id = hasPermissionInThisModule($permissionModules[$i]->id, translate('Edit ') . ' ' . $permissionModules[$i]->module_name);
                                                                $delete_permission_id = hasPermissionInThisModule($permissionModules[$i]->id, translate('Delete ') . ' ' . $permissionModules[$i]->module_name);
                                                                $manage_permission_id = hasPermissionInThisModule($permissionModules[$i]->id, translate('Manage ') . ' ' . $permissionModules[$i]->module_name);
                                                            @endphp
                                                            <tr>
                                                                @if ($i == 0 || $permissionModules[$i]->parent_module != $permissionModules[$i - 1]->parent_module)
                                                                    <th>{{ $permissionModules[$i]->parent_module }}</th>
                                                                @else
                                                                    <th></th>
                                                                @endif
                                                                <td>{{ $permissionModules[$i]->module_name }}</td>
                                                                @if ($show_permission_id)
                                                                    <td>
                                                                        <label class="switch success small">
                                                                            <input type="checkbox"
                                                                                id="role_has_permissions_{{ $show_permission_id }}"
                                                                                onchange="setRemovePermissionsToRole('{{ $show_permission_id }}')">
                                                                            <span class="control"></span>
                                                                        </label>
                                                                    </td>
                                                                @else
                                                                    <td></td>
                                                                @endif
                                                                @if ($create_permission_id)
                                                                    <td>
                                                                        <label class="switch success small">
                                                                            <input type="checkbox"
                                                                                id="role_has_permissions_{{ $create_permission_id }}"
                                                                                onchange="setRemovePermissionsToRole('{{ $create_permission_id }}')">
                                                                            <span class="control"></span>
                                                                        </label>
                                                                    </td>
                                                                @else
                                                                    <td></td>
                                                                @endif
                                                                @if ($edit_permission_id)
                                                                    <td>
                                                                        <label class="switch success small">
                                                                            <input type="checkbox"
                                                                                id="role_has_permissions_{{ $edit_permission_id }}"
                                                                                onchange="setRemovePermissionsToRole('{{ $edit_permission_id }}')">
                                                                            <span class="control"></span>
                                                                        </label>
                                                                    </td>
                                                                @else
                                                                    <td></td>
                                                                @endif
                                                                @if ($delete_permission_id)
                                                                    <td>
                                                                        <label class="switch success small">
                                                                            <input type="checkbox"
                                                                                id="role_has_permissions_{{ $delete_permission_id }}"
                                                                                onchange="setRemovePermissionsToRole('{{ $delete_permission_id }}')">
                                                                            <span class="control"></span>
                                                                        </label>
                                                                    </td>
                                                                @else
                                                                    <td></td>
                                                                @endif
                                                                @if ($manage_permission_id)
                                                                    <td>
                                                                        <label class="switch success small">
                                                                            <input type="checkbox"
                                                                                id="role_has_permissions_{{ $manage_permission_id }}"
                                                                                onchange="setRemovePermissionsToRole('{{ $manage_permission_id }}')">
                                                                            <span class="control"></span>
                                                                        </label>
                                                                    </td>
                                                                @else
                                                                    <td></td>
                                                                @endif
                                                            </tr>
                                                        @endfor
                                                    </tbody>
                                                </table>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12 text-right">
                                            <button type="submit" class="btn long">{{ translate('Submit') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /Add new role-->
                @endif

                @if (auth()->user()->can('Edit Role'))
                    <!-- Update new role-->
                    <div class="card mt-4" id="update_role">
                        <div class="card-body">
                            <div class="post-head d-flex justify-content-between align-items-center mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="content">
                                        <h4 class="mb-1">{{ translate('Update Role') }}</h4>
                                    </div>
                                </div>
                                <div id="update_role_down_icon" class="icon" onclick="hideRoleUpdateForm()">
                                    <i class="icofont-close"></i>
                                </div>
                            </div>

                            <div>
                                <div>
                                    <input type="hidden" name="role_id" id="role_id">
                                    <div class="form-row mb-20">
                                        <div class="col-md-4">
                                            <label class="font-14 bold black">{{ translate('Name') }}</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" name="role_name" id="role_name"
                                                class="theme-input-style"
                                                placeholder="{{ translate('Give role name') }}">
                                            <div class="invalid-input" id="role_name_update_error"></div>
                                        </div>
                                    </div>

                                    <div class="form-row mb-20">
                                        <input type="hidden" name="permissions" id="edditable_permissions">
                                        <div class="col-sm-12 table-scroll">
                                            <div class="invalid-input" id="permissions_update_error"></div>
                                            <h4 class="mb-3">{{ translate('Permissions') }}</h5>
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">{{ translate('Module') }}</th>
                                                            <th scope="col">{{ translate('Feature') }}</th>
                                                            <th scope="col">{{ translate('Show') }}</th>
                                                            <th scope="col">{{ translate('Create') }}</th>
                                                            <th scope="col">{{ translate('Edit') }}</th>
                                                            <th scope="col">{{ translate('Delete') }}</th>
                                                            <th scope="col">{{ translate('Manage') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @for ($i = 0; $i < sizeof($permissionModules); $i++)
                                                            @php
                                                                $permissions = getPermissionsOfModule($permissionModules[$i]->id);
                                                                $show_permission_id = hasPermissionInThisModule($permissionModules[$i]->id, translate('Show ') . ' ' . $permissionModules[$i]->module_name);
                                                                $create_permission_id = hasPermissionInThisModule($permissionModules[$i]->id, translate('Create ') . ' ' . $permissionModules[$i]->module_name);
                                                                $edit_permission_id = hasPermissionInThisModule($permissionModules[$i]->id, translate('Edit ') . ' ' . $permissionModules[$i]->module_name);
                                                                $delete_permission_id = hasPermissionInThisModule($permissionModules[$i]->id, translate('Delete ') . ' ' . $permissionModules[$i]->module_name);
                                                                $manage_permission_id = hasPermissionInThisModule($permissionModules[$i]->id, translate('Manage ') . ' ' . $permissionModules[$i]->module_name);
                                                            @endphp
                                                            <tr>
                                                                @if ($i == 0 || $permissionModules[$i]->parent_module != $permissionModules[$i - 1]->parent_module)
                                                                    <th>{{ $permissionModules[$i]->parent_module }}</th>
                                                                @else
                                                                    <th></th>
                                                                @endif
                                                                <td>{{ $permissionModules[$i]->module_name }}</td>
                                                                @if ($show_permission_id)
                                                                    <td>
                                                                        <label class="switch success small">
                                                                            <input type="checkbox"
                                                                                id="edtable_role_has_permissions_{{ $show_permission_id }}"
                                                                                onchange="setRemovePermissionsToRoleOnEdit('{{ $show_permission_id }}')">
                                                                            <span class="control"></span>
                                                                        </label>
                                                                    </td>
                                                                @else
                                                                    <td></td>
                                                                @endif
                                                                @if ($create_permission_id)
                                                                    <td>
                                                                        <label class="switch success small">
                                                                            <input type="checkbox"
                                                                                id="edtable_role_has_permissions_{{ $create_permission_id }}"
                                                                                onchange="setRemovePermissionsToRoleOnEdit('{{ $create_permission_id }}')">
                                                                            <span class="control"></span>
                                                                        </label>
                                                                    </td>
                                                                @else
                                                                    <td></td>
                                                                @endif
                                                                @if ($edit_permission_id)
                                                                    <td>
                                                                        <label class="switch success small">
                                                                            <input type="checkbox"
                                                                                id="edtable_role_has_permissions_{{ $edit_permission_id }}"
                                                                                onchange="setRemovePermissionsToRoleOnEdit('{{ $edit_permission_id }}')">
                                                                            <span class="control"></span>
                                                                        </label>
                                                                    </td>
                                                                @else
                                                                    <td></td>
                                                                @endif
                                                                @if ($delete_permission_id)
                                                                    <td>
                                                                        <label class="switch success small">
                                                                            <input type="checkbox"
                                                                                id="edtable_role_has_permissions_{{ $delete_permission_id }}"
                                                                                onchange="setRemovePermissionsToRoleOnEdit('{{ $delete_permission_id }}')">
                                                                            <span class="control"></span>
                                                                        </label>
                                                                    </td>
                                                                @else
                                                                    <td></td>
                                                                @endif
                                                                @if ($manage_permission_id)
                                                                    <td>
                                                                        <label class="switch success small">
                                                                            <input type="checkbox"
                                                                                id="edtable_role_has_permissions_{{ $manage_permission_id }}"
                                                                                onchange="setRemovePermissionsToRoleOnEdit('{{ $manage_permission_id }}')">
                                                                            <span class="control"></span>
                                                                        </label>
                                                                    </td>
                                                                @else
                                                                    <td></td>
                                                                @endif
                                                            </tr>
                                                        @endfor
                                                    </tbody>
                                                </table>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-12 text-right">
                                            <button type="submit" class="btn long"
                                                onclick="updateRole()">{{ translate('Update') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Update new role-->
                @endif
            </div>
        @endif

        <!--Delete Modal-->
        <div id="delete-modal" class="delete-modal modal fade show" aria-modal="true">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title h6">{{ translate('Delete Confirmation') }}</h4>
                    </div>
                    <div class="modal-body text-center">
                        <input type="hidden" name="role_id" id="role_id" value="">
                        <p class="mt-1">{{ translate('Are you sure to delete this') }}?</p>
                        <button type="button" class="btn btn-danger long mt-2"
                            data-dismiss="modal">{{ translate('cancel') }}</button>
                        <button type="submit" class="btn long mt-2"
                            onclick="deleteRole()">{{ translate('Delete') }}</button>
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


    <script type="application/javascript">
        let role_has_permissions = [];
        let role_has_module_permissions = [];
        let editable_role_has_permissions = [];

        (function($) {
            "use strict";
            $('#role_table').DataTable();
            hideElement(['#add_role_up_icon', '#update_role']);
        })(jQuery);
        

        /**
         * Toggle role adding form
         */
        function toggleRoleAddingForm() {
            "use strict";
            toggleElement([
                '#add_role',
                '#add_role_down_icon',
                '#add_role_up_icon'
            ]);
        }

        /**
         * hiding role updating form
         */
        function hideRoleUpdateForm() {
            "use strict";
            $('#update_role').hide();
        }

        /**
         * Show role editable form with necessary information
         */
        function showEditableForm(role_id) {
            "use strict";
            flash()
            $('#update_role').show();
            $('#add_role').hide();
            $.get("{{ route('core.edit.role') }}", {
                    id: role_id
                },
                function(data, status) {
                    let response = JSON.parse(JSON.stringify(data))
                    let role = response.role
                    let permissions = response.permissions
                    let modules = response.modules
                    let last_permission_id = {{ $last_permission_id }}

                    for (let i = 0; i < modules.length; i++) {
                        if(modules[i].hasAllPermission == 1){
                            $('#editable_role_has_module_permissions_' + modules[i].id).prop('checked', true);
                        }
                        else{
                            $('#editable_role_has_module_permissions_' + modules[i].id).prop('checked', false);
                        }
                    }
                    for (let i = 1; i <= last_permission_id; i++) {
                        $('#edtable_role_has_permissions_' + i).prop('checked', false);
                    }
                    for (let i = 0; i < permissions.length; i++) {
                        $('#edtable_role_has_permissions_' + permissions[i]).prop('checked', true);
                        editable_role_has_permissions.push('' + permissions[i])
                    }
                    $('#role_name').val(role.name)
                    $('#role_id').val(role.id)
                }).fail(function(xhr, status, error) {
                let error_response = JSON.parse(xhr.responseText)
                let error_message = error_response.message
                toastr.error(error_message, "!");
            });
        }

        /**
         * Update role info 
         */
        function updateRole() {
            "use strict";
            let role_id = $('#role_id').val()
            let role_name = $('#role_name').val()
            let permissions = editable_role_has_permissions.join(',')

            $.post("{{ route('core.update.role') }}", {
                    _token: '{{ csrf_token() }}',
                    id: role_id,
                    role_name: role_name,
                    permissions: permissions
                },
                function(data, status) {
                    if(data.demo_mode){
                        toastr.error(data.message, "Alert!");
                    } else {
                        flash();
                        location.reload();
                        toastr.success("Role updated successfully", "Success!");
                    }
                }).fail(function(xhr, status, error) {
                let error_response = JSON.parse(xhr.responseText)
                let error_message = error_response.message
                let errors = {}

                if (error_response.hasOwnProperty('errors')) {
                    errors = objToArray(error_response.errors)
                    showFormErrorMessage(errors)
                } else {
                    toastr.error(error_message, "!");
                }
            });
        }

        /**
         * confirm before delete
         */
        function deleteConfirmation(role_id)
        {
            "use strict";
            $("#role_id").val(role_id);
            $('#delete-modal').modal('show');
        }

        /**
         * Delete role
         */
        function deleteRole() {
            "use strict";
            let role_id =  $("#role_id").val();
            $.post("{{ route('core.delete.role') }}", {
                    _token: '{{ csrf_token() }}',
                    id: role_id
                },
                function(data, status) {
                    if(data.demo_mode){
                        toastr.error(data.message, "Alert!");
                    } else {
                        flash()
                        location.reload()
                        toastr.success("Role deleted successfully", "Success!");
                    }
                }).fail(function(xhr, status, error) {
                let error_response = JSON.parse(xhr.responseText)
                let error_message = error_response.message
                toastr.error(error_message, "!");
            });
        }

        /**
         * set and remove permissions to role  
         */
        function setRemovePermissionsToRole(permission_id) {
            "use strict";
            if ($('#role_has_permissions_' + permission_id).is(":checked")) {
                role_has_permissions.push(''+permission_id)
            } else {
                let index = role_has_permissions.indexOf(''+permission_id);
                role_has_permissions.splice(index, 1);
            }
            $('#permissions').val(role_has_permissions.join(','))
        }
        
        /**
         * set and remove module permissions to role  
         */
        function setRemoveModulePermissionsToRole(module_id,permissionString) {
            "use strict";
            let permissions = JSON.parse(permissionString) 

            let last_permission_id = {{ $last_permission_id }}
            
            if ($('#role_has_module_permissions_' + module_id).is(":checked")) {
                for (let i = 0; i < permissions.length; i++) {
                    $('#role_has_permissions_' + permissions[i].id).prop('checked', true);
                    role_has_permissions.push('' + permissions[i].id)
                }
            }
            else{
                for (let i = 0; i < permissions.length; i++) {
                    $('#role_has_permissions_' + permissions[i].id).prop('checked', false);
                    let index = role_has_permissions.indexOf(''+permissions[i].id);
                    role_has_permissions.splice(index, 1);
                }
            }
            $('#permissions').val(role_has_permissions.join(','))
        }


        /**
         * set and remove permissions to role on edit 
         */
        function setRemovePermissionsToRoleOnEdit(permission_id) {
            "use strict";
            if ($('#edtable_role_has_permissions_' + permission_id).is(":checked")) {
                editable_role_has_permissions.push(''+permission_id)
            } else {
                let index = editable_role_has_permissions.indexOf(''+permission_id);
                editable_role_has_permissions.splice(index, 1);
            }
            $('#edditable_permissions').val(role_has_permissions.join(','))
        }

        /**
        * set and remove module permissions to role while editing  
        */
         function setRemoveModulePermissionsToRoleOnEdit(module_id,permissionString) {
            "use strict";
            let permissions = JSON.parse(permissionString) 
                       
            if ($('#editable_role_has_module_permissions_' + module_id).is(":checked")) {
                for (let i = 0; i < permissions.length; i++) {
                    $('#edtable_role_has_permissions_' + permissions[i].id).prop('checked', true);
                    editable_role_has_permissions.push('' + permissions[i].id)
                }
            }
            else{
                for (let i = 0; i < permissions.length; i++) {
                    $('#edtable_role_has_permissions_' + permissions[i].id).prop('checked', false);
                    let index = editable_role_has_permissions.indexOf(''+permissions[i].id);
                    if(index!=-1){
                        editable_role_has_permissions.splice(index, 1);
                    }
                }
            }
            $('#edditable_permissions').val(role_has_permissions.join(','))
        }

        /**
         * Flush data 
         */
        function flash() {
            "use strict";
            $('#role_name_update_error').html('')
            $('#permissions_update_error').html('')
            editable_role_has_permissions = []
        }
</script>
@endsection
