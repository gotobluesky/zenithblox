@extends('core::base.layouts.master')

@section('title')
    {{ translate('Generate Site Map') }}
@endsection

@section('custom_css')
@endsection

@section('main_content')
    <!-- Main Content -->
    <form class="form-horizontal my-4 mb-4" action="{{ route('core.admin.generate.sitemap') }}" method="GET" id="sitemapForm">
        @csrf
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card card-body p-4">
                    <h3>{{ translate('Generate Site Map') }}</h3>
                    <div class="ml-1 mt-40 row">
                        <button type="submit"
                            class="btn btn-info btn-square generate-btn">{{ translate('Generate') }}</button>
                        <div class="mt-4">
                            <img src="{{ asset('/public/loader.svg') }}" alt="loader" class="loader d-none" width="45px"
                                height="auto">
                            <p class="text-danger generate-text d-inline"></p>
                        </div>
                    </div>
                    @if (file_exists(public_path('sitemap.xml')))
                        <div class="mt-4 row download-box">
                            <div class="col-8">
                                {{ asset('public/sitemap.xml') }}
                                <span class="mt-2 d-block sitemap-time">Last Update -
                                    {{ date('F d Y H:i:s', filemtime(public_path('sitemap.xml'))) }}</span>
                            </div>
                            <div class="col-3">
                                <a class="btn sm" href="{{ asset('public/sitemap.xml') }}" download="">Download</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </form>
@endsection


@section('custom_scripts')
    <script>
        (function($) {
            'use strict';
            $(document).on('submit', '#sitemapForm', function(e) {
                e.preventDefault();
                $('.generate-btn').prop('disabled', true);
                $('.generate-text').text(
                    'Site map generating started. It will take some time, Dont close or reload the page');
                $('.loader').removeClass('d-none');

                $.ajax({
                    type: "get",
                    url: "{{ route('core.admin.generate.sitemap') }}",
                    success: function(response) {
                        toastr.success(response.message, 'Success');
                        window.location.reload();
                    },
                    error: function(xhr, status, error) {
                        let message = "{{ translate('Sitemap Generating Request Failed') }}";
                        if (xhr.responseJSON) {
                            message = xhr.responseJSON.message;
                        }
                        toastr.error(message, 'ERROR!!');
                    }
                });

            });

        })(jQuery);
    </script>
@endsection
