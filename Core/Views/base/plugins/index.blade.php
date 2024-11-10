@extends('core::base.layouts.master')
@section('title')
    {{ translate('Plugings') }}
@endsection
@section('custom_css')
@endsection
@section('main_content')
    <div class="align-items-center border-bottom2 d-flex flex-wrap gap-10 justify-content-between mb-4 pb-3">
        <h4><i class="icofont-plugin"></i> {{ translate('Plugings') }}</h4>
        <div class="d-flex align-items-center gap-10 flex-wrap">
            <a href="https://documentation.cmslooks.themelooks.us/blog/how-to-make-plugin-for-cmslooks">{{ translate('Plugin Creating Guide') }}</a>
            <a href="{{ route('core.plugins.create') }}" class="btn long">{{ translate('Install Plugin') }}</a>
        </div>
    </div>
    <div class="app-items">
        <div class="row">
            @foreach ($plugins as $plugin)
                <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 mb-30">
                    <div class="app-item">
                        <div class="app-icon">
                            <img src="{{ asset('/plugins' . '/' . $plugin['location'] . '/banner.png') }}"
                                alt="{{ $plugin['name'] }}" />
                        </div>
                        <div class="app-details">
                            <h4 class="app-name">
                                {{ $plugin['name'] }}
                                @if ($plugin['license'] && $plugin['is_verified'])
                                    <img src="{{ asset('/public/verified.png') }}" alt="verified" width="16px" height="16px" class="ml-1" title="Verified">
                                @endif
                            </h4>
                        </div>
                        <div class="app-footer">
                            <div class="app-description" title="{{ $plugin['name'] }}">
                                {{ $plugin['description'] }}
                            </div>
                            <div class="app-author">
                                By:
                                <a href="{{ $plugin['url'] }}" target="_blank">{{ $plugin['author'] }}</a>
                            </div>
                            <div class="app-version">{{ translate('Version') }}: {{ $plugin['version'] }}</div>
                            <div class="app-actions">
                                @if ($plugin['is_activated'] == config('settings.general_status.active'))
                                    <button class="btn sm btn-warning btn-trigger-change-status deactive-plugin"
                                        data-plugin="{{ $plugin['id'] }}">
                                        {{ translate('Deactivate') }}
                                    </button>
                                @else
                                    <button class="btn sm btn-info btn-trigger-change-status active-plugin"
                                        data-plugin="{{ json_encode($plugin) }}">
                                        {{ translate('Activate') }}
                                    </button>
                                @endif
                                <button class="btn sm btn-danger delete-plugin ml-3" data-plugin="{{ route('core.plugins.delete', $plugin['id']) }}">
                                    {{ translate('Delete') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

    <!--Deactive Modal-->
    <div id="deactive-modal" class="delete-modal modal fade show" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title h6">{{ translate('Deactive Confirmation') }}</h4>
                </div>
                <div class="modal-body text-center">
                    <p class="mt-1">{{ translate('Are you sure to deactive this plugin') }}?</p>
                    <form method="POST" action="{{ route('core.plugins.inactive') }}">
                        @csrf
                        <input type="hidden" id="deactive-plugin-id" name="id">
                        <button type="button" class="btn long mt-2 btn-danger"
                            data-dismiss="modal">{{ translate('Cancel') }}</button>
                        <button type="submit" class="btn long mt-2">{{ translate('Deactivate') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--End Deactive  Modal-->

    <!--Active Modal-->
    <div id="active-modal" class="delete-modal modal fade show" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title h6">{{ translate('Activate Confirmation') }}</h4>
                </div>
                <div class="modal-body text-center">
                    <p class="mt-1">{{ translate('Are you sure to active this plugin') }}?</p>
                    <form method="POST" action="{{ route('core.plugins.active') }}">
                        @csrf
                        <input type="hidden" id="active-plugin-id" name="id">
                        <button type="button" class="btn long mt-2 btn-danger"
                            data-dismiss="modal">{{ translate('Cancel') }}</button>
                        <button type="submit" class="btn long mt-2">{{ translate('Activate') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--End Active  Modal-->

    <!-- Purchase Key Modal-->
    <div id="verify-purchase-modal" class="verify-purchase-modal modal fade show" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title h6">{{ translate('Active Confirmation') }}</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('core.plugins.purchase.verify') }}">
                        @csrf
                        <input type="hidden" id="plugin-location" name="plugin-location">
                        <input type="hidden" id="license_api" name="license_api">
                        <label for="purchase_key" class="black bold font-14 mb-1">{{ translate('Purchase Key') }}</label>
                        <input type="text" id="purchase_key" name="purchase_key" class="form-control mb-2"
                            placeholder="{{ translate('Give Purchase Key To Activate This Plugin') }}">
                        <button type="button" class="btn long mt-2 btn-danger"
                            data-dismiss="modal">{{ translate('Cancel') }}</button>
                        <button type="submit" class="btn long mt-2">{{ translate('Activate') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Purchase Key Modal-->

    <!-- Delete Modal-->
    <div id="delete-modal" class="delete-modal modal fade show" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title h6">{{ translate('Delete Confirmation') }}</h4>
                </div>
                <div class="modal-body text-center">
                    <p class="mt-1">{{ translate('Are you sure to delete this plugin') }}?</p>
                    <form method="POST" action="" id="delete-form">
                        @csrf
                        @method('delete')
                        <input type="hidden" id="plugin-id" name="plugin-id">
                        <button type="button" class="btn long mt-2 btn-danger"
                            data-dismiss="modal">{{ translate('Cancel') }}</button>
                        <button type="submit" class="btn long mt-2">{{ translate('Delete') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Modal-->
@endsection
@section('custom_scripts')
    <script>
        (function($) {
            'use strict';

            /**
             * Deactive plugin
             * */
            $('.deactive-plugin').on('click', function(e) {
                e.preventDefault();
                let $this = $(this);
                let id = $this.data('plugin');
                $("#deactive-plugin-id").val(id);
                $('#deactive-modal').modal('show');
            });

            /**
             * Activate plugin
             * */
            $('.active-plugin').on('click', function(e) {
                e.preventDefault();
                let plugin = $(this).data('plugin');

                if (plugin.license && !plugin.is_verified) {
                    $("#plugin-location").val(plugin.location);
                    $("#license_api").val(plugin.license_api);
                    $('#verify-purchase-modal').modal('show');
                } else {
                    $("#active-plugin-id").val(plugin.id);
                    $('#active-modal').modal('show');
                }
            });

            /**
             * Delete plugin
             * */
            $('.delete-plugin').on('click', function(e) {
                e.preventDefault();
                let plugin_url = $(this).data('plugin');
                $("#delete-form").attr('action', plugin_url);
                $('#delete-modal').modal('show');
            });

        })(jQuery);
    </script>
@endsection
