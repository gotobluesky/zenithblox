@extends('core::base.layouts.master')
@section('title')
    {{ translate('New Section') }}
@endsection
@section('custom_css')
    <style>
        .img-layout {
            min-width: 130px;
            border-width: 4px;
            border-style: solid;
            border-color: #d9d9d9;
            cursor: pointer;
        }
    </style>
@endsection
@section('main_content')
    <div>
        <form action="{{ route('theme.default.homePageSection.store') }}" method="POST" class="row">
            @csrf
            <div class="col-lg-8">
                <div class="card mb-30">
                    <div class="card-header bg-white border-bottom2">
                        <div class="d-sm-flex justify-content-between align-items-center">
                            <h4>{{ translate('Select Section') }}</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-row mb-20">
                            <div class="col-sm-12">
                                <select class="theme-input-style layout" id="layout" name="layout"
                                    onchange="selectLayout()">
                                    @if (request()->input('section') && request()->input('section') == 'slider')
                                        <option value="slider" selected>{{ translate('Banner Slider') }}</option>
                                    @else
                                        <option value="">{{ translate('Select Layout') }}</option>
                                        <option value="ads">{{ translate('Ads') }}</option>
                                        <option value="new_blog">{{ translate('Latest Blogs') }}</option>
                                        <option value="featured_blog">{{ translate('Featured Blogs') }}</option>
                                        <option value="most_viewed_blog">{{ translate('Most Viewed Blog') }}</option>
                                        <option value="trending_blog">{{ translate('Trending Blog') }}</option>
                                        <option value="category_wise">{{ translate('Category Wise') }}
                                        </option>
                                    @endif
                                </select>
                                @if ($errors->has('layout'))
                                    <div class="invalid-input">{{ $errors->first('layout') }}</div>
                                @endif
                            </div>
                            <div class="col-sm-12 mt-10">
                                <div class="section_layout d-none slider">
                                    <img src="{{ asset('/public/themes/default/banner_slider.png') }}">
                                </div>
                                <div class="section_layout d-none ads">
                                    <div class="selected_ads_layout">
                                        <img src="{{ asset('/public/themes/default/ads.png') }}">
                                    </div>
                                </div>
                                <div class="section_layout text-center d-none new_blog">
                                    <img src="{{ asset('/public/themes/default/new_post.png') }}">
                                </div>
                                <div class="section_layout text-center d-none featured_blog">
                                    <img src="{{ asset('/public/themes/default/featured_post.png') }}">
                                </div>
                                <div class="section_layout text-center d-none most_viewed_blog">
                                    <img src="{{ asset('/public/themes/default/most_viewed_post.png') }}">
                                </div>
                                <div class="section_layout text-center d-none trending_blog">
                                    <img src="{{ asset('/public/themes/default/trending_post.png') }}">
                                </div>
                                <div class="section_layout text-center d-none category_wise">
                                    <img src="{{ asset('/public/themes/default/category_post.png') }}">
                                </div>
                                <div class="text-center d-none no-layout-select">
                                    <p class="alert alert-danger">{{ translate('Please select a style') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">

                <div class="card mb-30">
                    <div class="card-header bg-white border-bottom2">
                        <div class="d-sm-flex justify-content-between align-items-center">
                            <h4>{{ translate('Section Properties') }}</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="layout-options">

                        </div>
                        <div class="form-row d-none save-section">
                            <div class="col-12 text-right">
                                <button type="submit" class="btn long">{{ translate('Save') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @include('core::base.media.partial.media_modal')
@endsection
@section('custom_scripts')
    <script>
        (function($) {
            'use strict';
            initDropzone()
            $(document).ready(function() {
                is_for_browse_file = true
                filtermedia()
                if ("{{ request()->input('section') && request()->input('section') == 'slider' }}") {
                    selectLayout();
                };
            });
        })(jQuery);

        // section layout
        function selectLayout() {
            'use strict';
            $('.layout-input').val('');
            let layout = $("select#layout option").filter(":selected").val();
            $('.section_layout').addClass('d-none');
            $('.' + layout).removeClass('d-none');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                type: "POST",
                data: {
                    layout: layout
                },
                url: "{{ route('theme.default.homePageSection.layout.options') }}",
                success: function(data) {
                    $('.layout-options').html(data);
                    $('.save-section').removeClass('d-none');
                    if (layout != 'slider' && layout != 'adds') {
                        postColum();
                    }
                }
            });
        }

        // select Color
        function selectColor(e, color) {
            'use strict';
            let target = e.target;
            $(target).closest('.addon').find('.color-input').val(color);
        }

        // post style type
        function selectPostStyleOption(section) {
            'use strict';
            let selected_style = $("select#blogPostStyle option").filter(":selected").val();
            if (selected_style != '') {
                let image_source = "{{ asset('themes/default/public/assets/images/layout/variation-') }}" +
                    selected_style + ".png";
                $('.no-layout-select').addClass('d-none');
                $('.' + section).removeClass('d-none');
                $('.' + section + ' ' + 'img').attr("src", image_source);
            } else {
                $('.no-layout-select').removeClass('d-none');
                $('.' + section).addClass('d-none');
            }
        }

        // adds layout
        function selectAdsLayout() {
            'use strict';
            let selected_ads_layout = $("select#adsLayout option").filter(":selected").val();
            let data = {
                'layout': selected_ads_layout,
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                type: "POST",
                data: data,
                url: "{{ route('theme.default.homePageSection.ads.layout.options') }}",
                success: function(data) {
                    $('.selected_ads_layout').html(data);
                }
            });
        }

        // radio blog image colum
        function postColum() {
            'use strict';
            $('.layout_img').addClass('img-layout');
            let checked_image = $('input[name="blog_colum"]:checked').attr('id');
            $('label[for="' + checked_image + '"]').find('img').css({
                "border-color": "#0073aa"
            });

            // image click and set border color
            $('#blog_colum_image_field .layout_img').click(function() {
                $('#blog_colum_image_field .layout_img').each(function(index, element) {
                    $(this).css({
                        "border-color": "#d9d9d9",
                    })
                });
                $(this).css({
                    "border-color": "#0073aa"
                });
            });
        }
    </script>
@endsection
