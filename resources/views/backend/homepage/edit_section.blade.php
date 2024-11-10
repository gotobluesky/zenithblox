@extends('core::base.layouts.master')
@section('title')
    {{ translate('Update Section') }}
@endsection
@section('custom_css')
    <style>
        .color-picker {
            width: 50px !important;
        }

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
        <form action="{{ route('theme.default.homePageSection.update') }}" method="POST" class="row">
            @csrf
            <div class="col-lg-8">
                <div class="card mb-30">
                    <div class="card-header bg-white border-bottom2">
                        <div class="d-sm-flex justify-content-between align-items-center">
                            <h4>{{ translate('Section') }}</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-row mb-20">
                            <div class="col-sm-12">
                                <select class="area-disabled layout theme-input-style" id="layout"
                                    onchange="selectLayout()" readonly>
                                    <option value="slider" @selected(getHomePageSectionProperties($section_details->id, 'layout') == 'slider')>{{ translate('Banner Slider') }}
                                    </option>
                                    <option value="ads" @selected(getHomePageSectionProperties($section_details->id, 'layout') == 'ads')>{{ translate('Ads') }}</option>
                                    <option value="new_blog" @selected(getHomePageSectionProperties($section_details->id, 'layout') == 'new_blog')>{{ translate('Latest Blogs') }}
                                    </option>
                                    <option value="featured_blog" @selected(getHomePageSectionProperties($section_details->id, 'layout') == 'featured_blog')>
                                        {{ translate('Featured Blogs') }}</option>
                                    <option value="most_viewed_blog" @selected(getHomePageSectionProperties($section_details->id, 'layout') == 'most_viewed_blog')>
                                        {{ translate('Most Viewed Blog') }}</option>
                                    <option value="trending_blog" @selected(getHomePageSectionProperties($section_details->id, 'layout') == 'trending_blog')>
                                        {{ translate('Trending Blog') }}</option>
                                    <option value="category_wise" @selected(getHomePageSectionProperties($section_details->id, 'layout') == 'category_wise')>
                                        {{ translate('Category Wise') }}</option>
                                </select>
                                @if ($errors->has('layout'))
                                    <div class="invalid-input">{{ $errors->first('layout') }}</div>
                                @endif
                            </div>
                            <div class="col-sm-12 mt-10">
                                <div
                                    class="section_layout {{ getHomePageSectionProperties($section_details->id, 'layout') == 'slider' ? 'slider' : 'd-none' }}">
                                    <img src="{{ asset('/public/themes/default/banner_slider.png') }}">
                                </div>
                                <div
                                    class="section_layout {{ getHomePageSectionProperties($section_details->id, 'layout') == 'ads' ? 'ads' : 'd-none' }}">
                                    <div class="selected_ads_layout row m-0">
                                        @include(
                                            'theme/default::backend.homepage.ads_layout_options_edit',
                                            [
                                                'layout' => getHomePageSectionProperties(
                                                    $section_details->id,
                                                    'content'),
                                                'details' => $section_details,
                                            ]
                                        )
                                    </div>
                                </div>
                                <div
                                    class="section_layout text-center {{ getHomePageSectionProperties($section_details->id, 'layout') == 'new_blog' ? 'new_blog' : 'd-none' }}">
                                    <img src="{{ asset('/public/themes/default/new_post.png') }}">
                                </div>
                                <div
                                    class="section_layout text-center {{ getHomePageSectionProperties($section_details->id, 'layout') == 'featured_blog' ? 'featured_blog' : 'd-none' }}">
                                    <img src="{{ asset('/public/themes/default/featured_post.png') }}">
                                </div>
                                <div
                                    class="section_layout text-center {{ getHomePageSectionProperties($section_details->id, 'layout') == 'most_viewed_blog' ? 'most_viewed_blog' : 'd-none' }}">
                                    <img src="{{ asset('/public/themes/default/most_viewed_post.png') }}">
                                </div>
                                <div
                                    class="section_layout text-center {{ getHomePageSectionProperties($section_details->id, 'layout') == 'trending_blog' ? 'trending_blog' : 'd-none' }}">
                                    <img src="{{ asset('/public/themes/default/trending_post.png') }}">
                                </div>
                                <div
                                    class="section_layout text-center {{ getHomePageSectionProperties($section_details->id, 'layout') == 'category_wise' ? 'category_wise' : 'd-none' }}">
                                    <img src="{{ asset('/public/themes/default/category_post.png') }}">
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
                            @if (getHomePageSectionProperties($section_details->id, 'layout') == 'new_blog')
                                @include('theme/default::backend.homepage.new_blog_edit', [
                                    'details' => $section_details,
                                ])
                            @elseif(getHomePageSectionProperties($section_details->id, 'layout') == 'slider')
                                @include('theme/default::backend.homepage.slider_edit', [
                                    'details' => $section_details,
                                ])
                            @elseif(getHomePageSectionProperties($section_details->id, 'layout') == 'featured_blog')
                                @include('theme/default::backend.homepage.featured_blog_edit', [
                                    'details' => $section_details,
                                ])
                            @elseif(getHomePageSectionProperties($section_details->id, 'layout') == 'most_viewed_blog')
                                @include('theme/default::backend.homepage.most_viewed_blog_edit', [
                                    'details' => $section_details,
                                ])
                            @elseif(getHomePageSectionProperties($section_details->id, 'layout') == 'trending_blog')
                                @include('theme/default::backend.homepage.trending_blog_edit', [
                                    'details' => $section_details,
                                ])
                            @elseif(getHomePageSectionProperties($section_details->id, 'layout') == 'category_wise')
                                @include('theme/default::backend.homepage.category_wise_edit', [
                                    'details' => $section_details,
                                ])
                            @elseif(getHomePageSectionProperties($section_details->id, 'layout') == 'ads')
                                @include('theme/default::backend.homepage.ads_option_edit', [
                                    'details' => $section_details,
                                ])
                            @endif
                        </div>
                        <input type="hidden" name="layout" class="layout-input"
                            value="{{ getHomePageSectionProperties($section_details->id, 'layout') }}">
                        <input type="hidden" name="id" class="layout-input" value="{{ $section_details->id }}">
                        <div class="form-row">
                            <div class="col-12 text-right">
                                <button type="submit" class="btn long">{{ translate('Save Changes') }}</button>
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
                filtermedia();
                if ($('#blogPostStyle').length > 0) {
                    selectPostStyleOption(
                        "{{ getHomePageSectionProperties($section_details->id, 'layout') }}");
                    postColum();
                }
            });
        })(jQuery);


        // post style type
        function selectPostStyleOption(section) {
            'use strict';
            let selected_style = $("select#blogPostStyle option").filter(":selected").val();
            if (selected_style != '') {
                let image_source = "{{ asset('themes/default/public/assets/images/layout/variation-') }}" +
                    selected_style + ".png";
                $('.' + section + ' ' + 'img').attr("src", image_source);
            } else {
                $('.' + section).html(
                    `<p class="alert alert-danger">{{ translate('Please select a style') }}</p>`);
            }
        }

        // select color
        function selectColor(e, color) {
            'use strict';
            let target = e.target;
            $(target).closest('.addon').find('.color-input').val(color);
        }

        // select ads layout
        function selectAdsLayout() {
            'use strict';
            let selected_ads_layout = $("select#adsLayout option").filter(":selected").val();;
            let data = {
                'layout': selected_ads_layout,
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                type: "POST",
                data: data,
                url: '{{ route('theme.default.homePageSection.ads.layout.options') }}',
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
