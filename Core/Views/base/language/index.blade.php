@extends('core::base.layouts.master')
@section('title')
    {{ translate('Languages') }}
@endsection
@section('custom_css')
    @include('core::base.includes.data_table.css')
@endsection
@section('main_content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-30">
                <div class="card-body border-bottom2 mb-20">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="font-20">{{ translate('Languages') }}</h4>
                        <div class="d-flex flex-wrap">
                            <a href="{{ route('core.language.new') }}"
                                class="btn long">{{ translate('Add New Language') }}</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="example" class="hoverable text-nowrap border-top2">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ translate('Name') }}</th>
                                <th>{{ translate('Native Name') }}</th>
                                <th>{{ translate('Code') }}</th>
                                <th>{{ translate('Flag') }}</th>
                                <th>{{ translate('RTL') }} </th>
                                <th>{{ translate('Status') }}</th>
                                <th>{{ translate('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($languages as $key => $lang)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $lang->name }}</td>
                                    <td>{{ $lang->native_name }}</td>
                                    <td class="text-uppercase">{{ $lang->code }}</td>
                                    <td>
                                        <img src="{{ asset('/public/flags/') . '/' . $lang->code . '.png' }}"
                                            width="25px">
                                    </td>
                                    <td>
                                        <label class="switch glow primary medium">
                                            <input type="checkbox" class="change-rtl" data-lang="{{ $lang->id }}"
                                                {{ $lang->is_rtl == '1' ? 'checked' : '' }}>
                                            <span class="control"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="switch glow primary medium">
                                            <input type="checkbox" class="change-status" data-lang="{{ $lang->id }}"
                                                {{ $lang->status == '1' ? 'checked' : '' }}>
                                            <span class="control"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <div class="dropdown-button">
                                            <a href="#" class="d-flex align-items-center justify-content-end"
                                                data-toggle="dropdown">
                                                <div class="menu-icon mr-0">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                </div>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="{{ route('core.language.key.values', $lang->id) }}">
                                                    {{ translate('Backend Translations') }}
                                                </a>
                                                <a href="{{ route('core.language.frontend.translations', $lang->id) }}">
                                                    {{ translate('Frontend Translations') }}
                                                </a>
                                                <a href="{{ route('core.language.edit', $lang->id) }}">
                                                    {{ translate('Edit') }}
                                                </a>
                                                <a href="#" class="delete-lang"
                                                    data-lang="{{ $lang->id }}">{{ translate('Delete') }}</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!--Delete Modal-->
    <div id="delete-modal" class="delete-modal modal fade show" aria-modal="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title h6">{{ translate('Delete Confirmation') }}</h4>
                </div>
                <div class="modal-body text-center">
                    <p class="mt-1">{{ translate('Are you sure to delete this') }}?</p>
                    <form method="POST" action="{{ route('core.language.delete') }}">
                        @csrf
                        <input type="hidden" id="delete-language-id" name="id">
                        <button type="button" class="btn long mt-2"
                            data-dismiss="modal">{{ translate('Cencel') }}</button>
                        <button type="submit" class="btn btn-danger long mt-2">{{ translate('Delete') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Delete Modal-->
@endsection
@section('custom_scripts')
    @include('core::base.includes.data_table.script')
    <script>
        (function($) {
            "use strict";
            /**
             * Languages data table
             */
            $(function() {
                $("#example").DataTable({
                    "responsive": false,
                    "scrolX": true,
                    "lengthChange": true,
                    "autoWidth": false,
                }).buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
            });
            /**
             * 
             * Change language rtl  status 
             * 
             * */
            $('.change-rtl').on('click', function(e) {
                e.preventDefault();
                let $this = $(this);
                let id = $this.data('lang');
                $.post('{{ route('core.language.change.rtl') }}', {
                    _token: '{{ csrf_token() }}',
                    id: id
                }, function(data) {
                    location.reload();
                })

            });
            /**
             * 
             * Change language status 
             * 
             * */
            $('.change-status').on('click', function(e) {
                e.preventDefault();
                let $this = $(this);
                let id = $this.data('lang');
                $.post('{{ route('core.language.change.status') }}', {
                    _token: '{{ csrf_token() }}',
                    id: id
                }, function(data) {
                    location.reload();
                })
            });
            /**
             * 
             * Delete language
             * 
             * */
            $('.delete-lang').on('click', function(e) {
                e.preventDefault();
                let $this = $(this);
                let id = $this.data('lang');
                $("#delete-language-id").val(id);
                $('#delete-modal').modal('show');
            });
        })(jQuery);
    </script>
@endsection
