@extends('core::base.layouts.master')

@section('title')
    {{ translate('Page') }}
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
                        <h3 class="font-24">{{ translate('All Pages') }}</h3>
                        @can('Create Page')
                            <div class="d-flex flex-wrap">
                                <a href="{{ route('core.page.add') }}" class="btn long">{{ translate('Add Page') }}</a>
                            </div>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    {{-- Page Filter Buttons --}}
                    <div class="filter_button row mb-4 pl-3">
                        @php
                            $count = ['tl_pages.id', '!=', null];
                            $search = request()->search ?? '';
                            $if_search = request()->search ? '&search=' . $search : '';
                            $all_page_request = request()->search ? '?status=search_text&search=' . $search : '';
                        @endphp

                        <a href="{{ route('core.page') . $all_page_request }}" class="btn sm btn-dark mx-1 my-2">
                            {{ translate('All') }}({{ count(getPage([$count], $search)) }})</a>

                        <a href="{{ route('core.page') . '?status=mine' . $if_search }}"
                            class="btn sm btn-dark sm mx-1 my-2">
                            {{ translate('Mine') }}({{ count(getPage([['tl_pages.user_id', '=', Auth::user()->id]], $search)) }})</a>

                        <a href="{{ route('core.page') . '?status=publish' . $if_search }}"
                            class="btn sm btn-success sm mx-1 my-2">
                            {{ translate('Published') }}({{ count(getPage([['tl_pages.publish_status', '=', config('settings.page_status.publish')], ['tl_pages.publish_at', '<', currentDateTime()]], $search)) }})</a>

                        <a href="{{ route('core.page') . '?status=schedule' . $if_search }}"
                            class="btn sm btn-info mx-1 my-2">
                            {{ translate('Scheduled') }}({{ count(getPage([['tl_pages.publish_at', '>', currentDateTime()]], $search)) }})</a>

                        <a href="{{ route('core.page') . '?status=draft' . $if_search }}"
                            class="btn sm btn-warning mx-1 my-2">
                            {{ translate('Drafts') }}({{ count(getPage([['tl_pages.publish_status', '=', config('settings.page_status.draft')]], $search)) }})</a>

                        <a href="{{ route('core.page') . '?status=trash' . $if_search }}"
                            class="btn sm btn-danger mx-1 my-2">
                            {{ translate('Trash') }}({{ count(getPage([['tl_pages.publish_status', '=', config('settings.page_status.trash')]], $search)) }})</a>

                        @if (request()->input('search'))
                            <span class="ml-3 h4 mt-2">{{ translate('Result For') }} :
                                ({{ request()->input('search') }})</span>
                        @endif
                    </div>
                    {{-- Page Filter Buttons End --}}
                    <div class="table-responsive">
                        <table class="hoverable text-nowrap border-top2 " id="page_table">
                            <thead>
                                <tr>
                                    @can('Delete Page')
                                        <th>
                                            <input type="checkbox" name="select-all" class="select-all" onchange="selectAll()">
                                        </th>
                                    @endcan
                                    <th>{{ translate('Title') }}</th>
                                    <th>{{ translate('Parent') }}</th>
                                    <th>{{ translate('Author') }}</th>
                                    <th>{{ translate('Date') }}</th>
                                    @if (isActivePluging('pagebuilder'))
                                        @can('Manage Page Builder')
                                            <th>{{ translate('Homepage') }}</th>
                                        @endcan
                                    @endif
                                    @canany(['Edit Page', 'Delete Page'])
                                        <th>{{ translate('Actions') }}</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $key = 1;
                                @endphp
                                @foreach ($pages as $page)
                                    <tr>
                                        @can('Delete Page')
                                            <td>
                                                <input type="checkbox" class="page_id" name="page_id[]"
                                                    value="{{ $page->id }}">
                                            </td>
                                        @endcan
                                        <td>
                                            @php
                                                $tlpage = Core\Models\TlPage::where('id', $page->id)->first();
                                                $parentUrl = getParentUrl($tlpage);
                                            @endphp
                                            @if ($page->publish_status == config('settings.page_status.publish'))
                                                <a href="{{ url('/') }}/page/{{ $parentUrl . $page->permalink }}"
                                                    target="_blank">{{ $tlpage->translation('title', getLocale()) }}</a>
                                            @else
                                                <a href="{{ url('/') . '/' . getAdminPrefix() }}/page-preview?page={{ $page->permalink }}"
                                                    target="_blank">{{ $tlpage->translation('title', getLocale()) }}</a>
                                            @endif
                                            —
                                            @if (isActivePluging('pagebuilder') && $page->page_type === 'builder')
                                                <span>{{ translate('Builder') }}</span>,
                                            @endif
                                            <span>{{ $page->visibility }}</span>
                                        </td>
                                        <td>
                                            @if ($tlpage->parentPage != null)
                                                {{ $tlpage->parentPage->translation('title', getLocale()) }}
                                            @endif
                                        </td>
                                        <td>{{ $page->user_name }}</td>
                                        <td width="15%">
                                            @if ($page->publish_status == config('settings.page_status.publish'))
                                                @if ($page->publish_at > currentDateTime())
                                                    <span
                                                        class="badge badge-primary mb-2">{{ translate('Schedule') }}</span>
                                                    <br>
                                                    <span>{{ date('d-m-Y h:m A', strtotime($page->updated_at)) }}</span>
                                                @else
                                                    <span
                                                        class="badge badge-success mb-2">{{ translate('Published') }}</span>
                                                    <br>
                                                    <span>{{ date('d-m-Y h:m A', strtotime($page->updated_at)) }}</span>
                                                @endif
                                                <br>
                                            @elseif ($page->publish_status == config('settings.page_status.draft'))
                                                <span class="badge badge-warning mb-2">{{ translate('Draft') }}</span>
                                                <br>
                                                <span>{{ translate('Last Modified') }}</span>
                                                <br>
                                                <span>{{ date('d-m-Y h:m A', strtotime($page->updated_at)) }}</span>
                                            @else
                                                <span class="badge badge-danger mb-2">{{ translate('Trash') }}</span>
                                            @endif
                                        </td>
                                        @if (isActivePluging('pagebuilder'))
                                            @can('Manage Page Builder')
                                                <td>
                                                    <a href="{{ route('core.page.make.homepage', $page->id) }}"
                                                        class="btn {{ $page->is_home == true ? 'btn-success' : 'btn-info' }} sm ml-2">
                                                        @if ($page->is_home == true)
                                                            {{ translate('Current Homepage') }}
                                                        @else
                                                            {{ translate('Make Homepage') }}
                                                        @endif
                                                    </a>
                                                </td>
                                            @endcan
                                        @endif
                                        @canany(['Edit Page', 'Delete Page'])
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
                                                        @can('Edit Page')
                                                            @if (request()->status == 'trash')
                                                                <form
                                                                    action="{{ route('core.page.status.change', ['permalink' => $page->permalink, 'status' => 'restore']) }}"
                                                                    method="post" id="changeStatus">
                                                                    @csrf
                                                                    <a href="javascript:;void(0)"
                                                                        onclick="document.getElementById('changeStatus').submit();">{{ translate('Restore') }}</a>
                                                                </form>
                                                            @else
                                                                <a
                                                                    href="{{ route('core.page.edit', ['permalink' => $page->permalink, 'lang' => getDefaultLang()]) }}">{{ translate('Edit') }}</a>
                                                                <form
                                                                    action="{{ route('core.page.status.change', ['permalink' => $page->permalink, 'status' => 'trash']) }}"
                                                                    method="post" id="changeStatus">
                                                                    @csrf
                                                                    <a href="javascript:;void(0)"
                                                                        onclick="document.getElementById('changeStatus').submit();">{{ translate('Trash') }}</a>
                                                                </form>
                                                            @endif
                                                        @endcan
                                                        @can('Delete Page')
                                                            <a href="#"
                                                                onclick="deleteConfirmation('{{ $page->permalink }}')">{{ translate('Delete') }}</a>
                                                        @endcan
                                                        @if (isActivePluging('pagebuilder') && $page->page_type === 'builder')
                                                            @can('Manage Page Builder')
                                                                <a
                                                                    href="{{ route('plugin.builder.pageSections', ['id' => $page->id, 'title' => $page->title, 'permalink' => $page->permalink]) }}">
                                                                    {{ translate('Page Builder') }}
                                                                </a>
                                                            @endcan
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                        @endcanany
                                    </tr>
                                    @php
                                        $key++;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if (!(request()->input('page') && request()->input('page') > $pages->lastPage()))
                        {{-- pagination --}}
                        <div class="row mt-2 justify-content-between">
                            {{-- Page Page Count Info --}}
                            <div class="col-md-4">
                                <p>{{ translate('Showing') }}
                                    @if (!request()->input('page') || request()->input('page') == 1)
                                        1 to {{ count($pages) }}
                                    @else
                                        @php
                                            if (request()->input('per_page')) {
                                                $per_page_count = request()->input('per_page');
                                            } else {
                                                $per_page_count = 10;
                                            }
                                            $start_count = ((int) request()->input('page') - 1) * $per_page_count + 1;
                                            if (request()->input('page') == $pages->lastPage()) {
                                                $end_count = $pages->total();
                                            } else {
                                                $end_count = (int) request()->input('page') * $per_page_count;
                                            }
                                        @endphp
                                        {{ $start_count . ' to ' . $end_count }}
                                    @endif
                                    {{ translate('items of') }} {{ $pages->total() }}
                                </p>
                            </div>

                            <div class="col-md-3">
                                <!-- Pagination -->
                                <div class="pagination d-flex flex-column align-items-center">
                                    @php
                                        $url = route('core.page');
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
                                                $route = $url . '?page-list';
                                            }
                                        }
                                        $last_page = $pages->lastPage();
                                        $current_page = request()->input('page') ? request()->input('page') : 1;
                                    @endphp

                                    <ul class="list-inline d-inline-flex align-items-center mb-2">
                                        {{-- Previous Button --}}
                                        <li>
                                            <a href="{{ $route . '&page=' . request()->input('page') - 1 }}"
                                                style="{{ !request()->input('page') || request()->input('page') == 1 ? 'pointer-events: none' : '' }}">
                                                <i class="icofont-arrow-left"></i>
                                            </a>
                                        </li>
                                        {{-- Previous Button End --}}

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

                                        {{-- Next Button --}}
                                        <li>
                                            @if (request()->input('page'))
                                                <a href="{{ $route . '&page=' . request()->input('page') + 1 }}"
                                                    style="{{ request()->input('page') == $pages->lastPage() ? 'pointer-events: none' : '' }}"><i
                                                        class="icofont-arrow-right"></i></a>
                                            @else
                                                <a href="{{ $route . '&page=2' }}"
                                                    style="{{ 1 == $pages->lastPage() ? 'pointer-events: none' : '' }}"><i
                                                        class="icofont-arrow-right"></i></a>
                                            @endif
                                        </li>
                                        {{-- Next Button end --}}

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

    <!-- page Bulk Delete Modal-->
    <div id="pagebulkdelete-modal" class="pagebulkdelete-modal modal fade show" aria-modal="true">
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
    <!--page Bulk Delete Modal End-->

    <!--Page Delete Modal-->
    <div id="delete-modal" class="delete-modal modal fade show" aria-modal="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title h6">{{ translate('Delete Confirmation') }}</h4>
                </div>
                <div class="modal-body text-center">
                    <p class="mt-1">{{ translate('Are you sure to delete this') }}?</p>
                    <form method="POST" action="{{ route('core.page.delete') }}">
                        @csrf
                        <input type="hidden" id="permalink" name="permalink">
                        <button type="button" class="btn long mt-2  btn-danger"
                            data-dismiss="modal">{{ translate('cancel') }}</button>
                        <button type="submit" class="btn long mt-2">{{ translate('Delete') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Page Delete Modal End-->
@endsection

@section('custom_scripts')
    <!-- ======= Data-Tables Scripts ======= -->
    @include('core::base.includes.data_table.script')
    <!-- ======= Data-Tables Scripts Ends ======= -->

    <script  type="application/javascript">
        $(document).ready(function() {
            "use strict";

            /**
             * Set DataTable to page Table and append Bulk Selection
            **/
            let table = $("#page_table").DataTable({
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
                if('{{ request()->per_page }}' == '{{ $pages->total() }}'){
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
            $('#page_table_paginate').closest(".row").hide();

            // Show Entry On Change
            $('#page_table').on( 'length.dt', function ( e, settings, len ) {
                let count = '';
                if(len == '-1'){
                    count = '{{ $pages->total() }}';
                }else{
                    count = len;
                }

                if('{{ request()->status }}'){
                    if('{{ request()->search }}'){
                        window.location.replace('{{ route('core.page') }}?status='+'{{ request()->status }}'+'&search='+'{{ request()->search }}'+'&per_page='+count);
                    }else{
                        window.location.replace('{{ route('core.page') }}?status='+'{{ request()->status }}'+'&per_page='+count);
                    }
                } else{
                    window.location.replace('{{ route('core.page') }}?per_page='+count);
                }
            } );

            // Search Form 
            $('.dataTables_filter input').unbind().keyup(function(e) {
                var value = $(this).val();
                if(e.which === 13){
                    if('{{ request()->status }}'){
                        window.location.replace('{{ route('core.page') }}?status='+'{{ request()->status }}'+'&search='+value);
                    } else{
                        window.location.replace('{{ route('core.page') }}?status=search_text&search='+value);
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

            let bulk_permission = '{{ auth()->user()->can("Delete Page") }}';
            if(bulk_permission){
                $(bulk_actions_dropdown).insertAfter("#page_table_wrapper #page_table_length");
            }
        });

        /**
        * show bulk delete confirmation modal
        */
        function bulkDeleteConfirmation()
        {
            "use strict";
            let action = $('.bulk-action-selection').val();
            if (action === 'delete_all') {
                $('#pagebulkdelete-modal').modal('show');

            } else {
                toastr.error('{{ translate('No Action Selected') }}', "Error!");
            }
        }

        /**
        * Bulk Delete For selected page
        **/
        function bulkAction()
        {
            "use strict";
            var selected_items = [];
            $('input[name^="page_id"]:checked').each(function() {
                selected_items.push($(this).val());
            });

            if (selected_items.length > 0) {
                $.post('{{ route('core.bulk.delete.page') }}', {
                    _token: '{{ csrf_token() }}',
                     data: selected_items
                }, function(data) {
                    if (data.demo_mode) {
                        toastr.error(data.message, "Alert!");
                    } else {
                        $(".category_id").prop("checked", false);
                        location.reload();
                    }
                });
            } else {
                toastr.error('{{ translate('No Item Selected') }}', "Error!");
            }
        }

        /**
        * Select all page
        **/
        function selectAll()
        {
            "use strict";
            let checked = $('.select-all').is(":checked");
            $(".page_id").prop("checked", checked);
        }

        /**
        * show page delete confirmation modal
        */
        function deleteConfirmation(permalink)
        {
            "use strict";
            $("#permalink").val(permalink);
            $('#delete-modal').modal('show');
        }

    </script>
@endsection
