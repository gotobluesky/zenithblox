@extends('core::base.layouts.master')

@section('title')
    {{ translate('Tag') }}
@endsection

@section('custom_css')
    <!-- ======= Data-Tables Styles ======= -->
    @include('core::base.includes.data_table.css')
    <!-- ======= Data-Tables Styles Endd ======= -->
@endsection

@section('main_content')
    <!-- Main Content -->
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-30">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="font-24">{{ translate('Tags') }}</h3>
                        <div class="d-flex flex-wrap">
                            <a href="{{ route('core.add.tag') }}" class="btn long">{{ translate('Add Tag') }}</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {{-- Tag Filter Buttons --}}
                    <div class="filter_button row mb-4 pl-3">
                        @php
                            $count = ['tl_blog_tags.id', '!=', null];
                            if (request()->search) {
                                $if_search = '&search=' . request()->search;
                                $all_blog_request = '?status=search_text&search=' . request()->search;
                                $search = request()->search;
                            } else {
                                $if_search = '';
                                $all_blog_request = '';
                                $search = '';
                            }
                        @endphp
                        <a href="{{ route('core.tag') . $all_blog_request }}" class="btn sm btn-dark sm mx-1">
                            {{ translate('All') }}({{ count(getTag(null, $search)) }})</a>

                        <a href="{{ route('core.tag') . '?status=publish' . $if_search }}"
                            class="btn sm btn-primary sm mx-1">
                            {{ translate('Publish') }}({{ count(getTag([['is_publish', '1']], $search)) }})</a>

                        @if (request()->input('search'))
                            <span class="ml-3 h4 mt-3">{{ translate('Result For') }} :
                                ({{ request()->input('search') }})</span>
                        @endif
                    </div>
                    <div class="table-responsive">
                        <table class="hoverable text-nowrap border-top2 " id="tag_table">
                            <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" name="select-all" class="select-all" onchange="selectAll()">
                                    </th>
                                    <th>{{ translate('Name') }}</th>
                                    <th>{{ translate('Published') }}</th>
                                    <th>{{ translate('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $key = 1;
                                @endphp
                                @foreach ($tags as $tag)
                                    <tr>
                                        <th width="8%">
                                            <input type="checkbox" class="tag_id" name="tag_id[]"
                                                value="{{ $tag->id }}">
                                        </th>
                                        <td>
                                            <strong>{{ $tag->translation('name', getLocale()) }}</strong>
                                        </td>
                                        <td>
                                            <label class="switch glow primary medium">
                                                <input type="checkbox" class="change_publish"
                                                    {{ $tag->is_publish == '1' ? 'checked' : '' }} name="is_publish"
                                                    data-tag="{{ $tag->id }}">
                                                <span class="control"></span>
                                            </label>
                                        </td>
                                        <td width="18%">
                                            <div class="dropdown-button">
                                                <a href="#" class="d-flex align-items-center" data-toggle="dropdown">
                                                    <div class="menu-icon style--two mr-0">
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                    </div>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a
                                                        href="{{ route('core.edit.tag', ['id' => $tag->id, 'lang' => getDefaultLang()]) }}">{{ translate('Edit') }}</a>
                                                    <a href="#"
                                                        onclick="deleteConfirmation('{{ $tag->id }}')">{{ translate('Delete') }}</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @php
                                        $key++;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if (!(request()->input('page') && request()->input('page') > $tags->lastPage()))
                        <div class="row mt-2 justify-content-between">
                            {{-- Blog Page Count Info --}}
                            <div class="col-md-4">
                                <p>{{ translate('Showing') }}
                                    @if (!request()->input('page') || request()->input('page') == 1)
                                        1 to {{ count($tags) }}
                                    @else
                                        @php
                                            if (request()->input('per_page')) {
                                                $per_page_count = request()->input('per_page');
                                            } else {
                                                $per_page_count = 10;
                                            }
                                            
                                            $start_count = ((int) request()->input('page') - 1) * $per_page_count + 1;
                                            if (request()->input('page') == $tags->lastPage()) {
                                                $end_count = $tags->total();
                                            } else {
                                                $end_count = (int) request()->input('page') * $per_page_count;
                                            }
                                        @endphp
                                        {{ $start_count . ' to ' . $end_count }}
                                    @endif
                                    {{ translate('items of') }} {{ $tags->total() }}
                                </p>
                            </div>

                            <div class="col-md-4">
                                <!-- Pagination -->
                                <div class="pagination d-flex flex-column align-items-center">
                                    @php
                                        $url = route('core.tag');
                                        if (request()->input('status')) {
                                            if (request()->input('per_page')) {
                                                if (request()->input('search')) {
                                                    $route = $url . '?status=' . request()->input('status') . '&search=' . request()->input('search') . '&per_page=' . request()->input('per_page');
                                                } else {
                                                    $route = $url . '?status=' . request()->input('status') . '&per_page=' . request()->input('per_page');
                                                }
                                            } else {
                                                if (request()->input('search')) {
                                                    $route = $url . '?status=' . request()->input('status') . '&search=' . request()->input('search');
                                                } else {
                                                    $route = $url . '?status=' . request()->input('status');
                                                }
                                            }
                                        } else {
                                            if (request()->input('per_page')) {
                                                $route = $url . '?per_page=' . request()->input('per_page');
                                            } else {
                                                $route = $url . '?tag-list';
                                            }
                                        }
                                        
                                        $last_page = $tags->lastPage();
                                        $current_page = request()->input('page') ? request()->input('page') : 1;
                                    @endphp

                                    <ul class="list-inline d-inline-flex align-items-center mb-2">
                                        <li>
                                            {{-- Previous Button --}}
                                            <a href="{{ $route . '&page=' . request()->input('page') - 1 }}"
                                                style="{{ !request()->input('page') || request()->input('page') == 1 ? 'pointer-events: none' : '' }}">
                                                <i class="icofont-arrow-left"></i>
                                            </a>
                                            {{-- Previous Button End --}}
                                        </li>
                                        {{-- Pagination Number Start --}}
                                        @if ($current_page - 3 > 1)
                                            <li>
                                                <a href="{{ $route . '&page=' . 1 }}">1</a>
                                            </li>
                                            <li>
                                                <a>...</a>
                                            </li>
                                        @endif

                                        @if ($current_page - 3 == 1)
                                            <li>
                                                <a href="{{ $route . '&page=' . 1 }}">1</a>
                                            </li>
                                        @endif

                                        @if ($current_page - 2 > 0)
                                            <li>
                                                <a href="{{ $route . '&page=' . $current_page - 2 }}">
                                                    {{ $current_page - 2 }}</a>
                                            </li>
                                        @endif

                                        @if ($current_page - 1 > 0)
                                            <li>
                                                <a href="{{ $route . '&page=' . $current_page - 1 }}">
                                                    {{ $current_page - 1 }}</a>
                                            </li>
                                        @endif

                                        <li class="current">
                                            <a href="#" style="pointer-events: none;">{{ $current_page }}</a>
                                        </li>

                                        @if ($current_page + 1 <= $last_page)
                                            <li>
                                                <a href="{{ $route . '&page=' . $current_page + 1 }}">
                                                    {{ $current_page + 1 }}</a>
                                            </li>
                                        @endif

                                        @if ($current_page + 2 == $last_page)
                                            <li>
                                                <a href="{{ $route . '&page=' . $current_page + 2 }}">
                                                    {{ $current_page + 2 }}</a>
                                            </li>
                                        @endif

                                        @if ($current_page < $last_page - 2)
                                            <li>
                                                <a>...</a>
                                            </li>
                                            <li>
                                                <a href="{{ $route . '&page=' . $last_page }}">{{ $last_page }}</a>
                                            </li>
                                        @endif
                                        {{-- Pagination Number Start end --}}
                                        <li>
                                            @if (request()->input('page'))
                                                <a href="{{ $route . '&page=' . request()->input('page') + 1 }}"
                                                    style="{{ request()->input('page') == $tags->lastPage() ? 'pointer-events: none' : '' }}"><i
                                                        class="icofont-arrow-right"></i></a>
                                            @else
                                                <a href="{{ $route . '&page=2' }}"
                                                    style="{{ 1 == $tags->lastPage() ? 'pointer-events: none' : '' }}"><i
                                                        class="icofont-arrow-right"></i></a>
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                                <!-- End Pagination -->
                            </div>

                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- End Main Content -->


    <!-- Tag Bulk Delete Modal-->
    <div id="tagbulkdelete-modal" class="bulkdelete-modal modal fade show" aria-modal="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title h6">{{ translate('Delete Confirmation') }}</h4>
                </div>
                <div class="modal-body text-center">
                    <p class="mt-1">{{ translate('Are you sure to delete this') }}?</p>
                    <button type="button" class="btn long mt-2  btn-danger"
                        data-dismiss="modal">{{ translate('cancel') }}</button>
                    <button class="btn long mt-2" onclick="bulkAction()">{{ translate('Delete') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!--Tag Bulk Delete Modal End-->

    <!-- Tag Each Delete Modal-->
    <div id="delete-modal" class="delete-modal modal fade show" aria-modal="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title h6">{{ translate('Delete Confirmation') }}</h4>
                </div>
                <div class="modal-body text-center">
                    <p class="mt-1">{{ translate('Are you sure to delete this') }}?</p>
                    <form method="POST" action="{{ route('core.delete.tag') }}">
                        @csrf
                        <input type="hidden" id="tag_id" name="id">
                        <button type="button" class="btn long mt-2  btn-danger"
                            data-dismiss="modal">{{ translate('cancel') }}</button>
                        <button type="submit" class="btn long mt-2">{{ translate('Delete') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Tag Each Delete Modal End-->
@endsection

@section('custom_scripts')
    <!-- ======= Data-Tables Scripts ======= -->
    @include('core::base.includes.data_table.script')
    <!-- ======= Data-Tables Scripts Ends ======= -->

    <script  type="application/javascript">
        (function($) {
            "use strict";
            $(document).ready(function() {

                /**
                 * Set DataTable to Blog Table and append Bulk Selection
                **/
                let table = $("#tag_table").DataTable({
                    responsive: false,
                    scrollX:true,
                    lengthChange: true,
                    autoWidth: false,
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, 'All'],
                    ],
                });

                // Show Entry Count on Per Page
                if('{{ request()->per_page }}'){
                    if('{{ request()->per_page }}' == '{{ $tags->total() }}'){
                        table.page.len(-1).draw();
                    }else{
                        table.page.len('{{ request()->per_page }}').draw();
                    }
                }else{
                    table.page.len(10).draw();
                }

                // show search text 
                if('{{ request()->search }}'){
                    table.search('{{ request()->search }}');
                }

                // Hiding The Default Pagination
                $('#tag_table_paginate').closest(".row").hide();

                // Show Entry On Chnage
                $('#tag_table').on( 'length.dt', function ( e, settings, len ) {
                    let count = '';
                    if(len == '-1'){
                        count = '{{ $tags->total() }}';
                    }else{
                        count = len;
                    }

                    if('{{ request()->status }}'){
                        if('{{ request()->search }}'){
                            window.location.replace('{{ route('core.tag') }}?status='+'{{ request()->status }}'+'&search='+'{{ request()->search }}'+'&per_page='+count);
                        }else{
                            window.location.replace('{{ route('core.tag') }}?status='+'{{ request()->status }}'+'&per_page='+count);
                        }
                    } else{
                        window.location.replace('{{ route('core.tag') }}?per_page='+count);
                    }
                } );

                // Search Form 
                $('.dataTables_filter input').unbind().keyup(function(e) {
                    var value = $(this).val();
                    if(e.which === 13){
                        if('{{ request()->status }}'){
                            window.location.replace('{{ route('core.tag') }}?status='+'{{ request()->status }}'+'&search='+value);
                        } else{
                            window.location.replace('{{ route('core.tag') }}?status=search_text&search='+value);
                        }
                    }
                });
                    // Bulk section added
                    var bulk_actions_dropdown =
                        `<div id="bulk-action" class="dataTables_length d-flex">
                            
                            <select class="theme-input-style bulk-action-selection mr-3">
                                <option value="">{{ translate('Bulk Action') }}</option>
                                <option value="delete_all">{{ translate('Delete selection') }}</option>
                            </select>
                            <button class="btn sm" onclick="bulkDeleteConfirmation()">{{ translate('Apply') }}</button>
                        </div>`;

                    $(bulk_actions_dropdown).insertAfter("#tag_table_wrapper #tag_table_length");
            });

            /**
             * Change Publish  status 
             * */
            $('.change_publish').on('click', function(e)
            {
                e.preventDefault();
                let $this = $(this);
                let id = $this.data('tag');
                $.post('{{ route('core.update.tag.publish.status') }}', {
                    _token: '{{ csrf_token() }}',
                    id: id
                }, function(data) {

                    if(data.success){
                            switch (data.result) {
                            case 'on':
                                $this.prop('checked', true);
                                break;
                            case 'of':
                                $this.prop('checked', false);
                                break;
                        }
                        toastr.success( data.success, "Success!");
                    } else{
                        toastr.error( data.error, "Error!");
                    }
                })
            });
        })(jQuery);

        /**
        * show bulk delete confirmation modal
        */
        function bulkDeleteConfirmation() {
            "use strict";
            let action = $('.bulk-action-selection').val();
            if (action === 'delete_all') {

                $('#tagbulkdelete-modal').modal('show');

            } else {
                toastr.error('{{ translate('No Action Selected') }}', "Error!");
            }
         }

        /**
        * Bulk Delete For selected Tag
        **/
        function bulkAction() {
            "use strict";
            var selected_items = [];
            $('input[name^="tag_id"]:checked').each(function() {
                selected_items.push($(this).val());
            });

            if (selected_items.length > 0) {
                $.post('{{ route('core.bulk.delete.tag') }}', {
                    _token: '{{ csrf_token() }}',
                    data: selected_items
                }, function(data) {
                    if (data.demo_mode) {
                        toastr.error(data.message, "Alert!");
                    } else {
                        $(".tag_id").prop("checked", false);
                        location.reload();
                    }
                });

            } else {
                toastr.error('{{ translate('No Item Selected') }}', "Error!");
            }
        }

        /**
         * Select all Tag
         **/
         function selectAll() {
            "use strict";
            if ($('.select-all').is(":checked")) {
                $(".tag_id").prop("checked", true);
            } else {
                $(".tag_id").prop("checked", false);
            }
        }

        /**
        * show Tag delete confirmation modal
        */
        function deleteConfirmation(tag_id) {
            "use strict";
            $("#tag_id").val(tag_id);
            $('#delete-modal').modal('show');
         }
    </script>
@endsection
