@extends('core::base.layouts.master')
@section('title')
    {{ translate('Updates') }}
@endsection
@section('custom_css')
@endsection
@section('main_content')
    <div class="border-bottom2 pb-3 mb-4">
        <h4><i class="icofont-pay"></i> {{ translate('Updates') }}</h4>
    </div>
    <h1>Update List</h1>
@endsection
@section('custom_scripts')
    <script>
        (function($) {
            "use strict";

        })(jQuery);
    </script>
@endsection
