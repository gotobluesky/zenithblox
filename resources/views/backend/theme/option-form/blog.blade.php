{{-- Blog Header --}}
<h3 class="black mb-3">{{ translate('Blog') }}</h3>
<input type="hidden" name="option_name" value="blog">

{{-- Default Or Custom Back To Top Button Switch Start --}}
<div class="form-group row py-3 border-bottom">
    <div class="col-xl-4">
        <label class="font-16 bold black">{{ translate('Custom Blog Style') }}
        </label>
        <span class="d-block">{{ translate('set custom blog style.') }}</span>
    </div>
    <div class="col-xl-6 offset-xl-1">
        <label class="switch success">
            <input type="hidden" name="custom_blog_style" value="0">
            <input type="checkbox"
                {{ isset($option_settings['custom_blog_style']) && $option_settings['custom_blog_style'] == 1 ? 'checked' : '' }}
                name="custom_blog_style" id="custom_blog_style" value="1">
            <span class="control" id="custom_blog_style_switch">
                <span class="switch-off">{{ translate('Default') }}</span>
                <span class="switch-on">{{ translate('Custom') }}</span>
            </span>
        </label>
    </div>
</div>
{{-- Default Or Custom Back To Top Button Switch End --}}

{{-- Custom Blog Style Switch on Field Start --}}
<div id="custom_blog_style_switch_on_field">
    {{-- Blog Layout Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-5">
            <label class="font-16 bold black">{{ translate('Layout') }}
            </label>
            <span
                class="d-block">{{ translate('Choose blog layout from here. If you use this option then you will able to change three type of blog layout ( Default Right Sidebar Layout ).') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1 row" id="blog_layout_image_field">
            <div class="col-4">
                <div class="input-group">
                    <input type="radio" class="d-none"
                        {{ isset($option_settings['blog_layout']) && $option_settings['blog_layout'] == 'full_layout' ? 'checked' : '' }}
                        name="blog_layout" id="full_layout" value="full_layout">
                    <label for="full_layout">
                        <img src="{{ asset('themes/default/public/assets/images/layout/no-sideber.png') }}"
                            title="no sidebar" alt="no sidebar" class="layout_img">
                    </label>
                </div>
            </div>
            <div class="col-4">
                <div class="input-group">
                    <input type="radio"
                        {{ isset($option_settings['blog_layout']) && $option_settings['blog_layout'] == 'left_sidebar_layout' ? 'checked' : '' }}
                        class="d-none" name="blog_layout" id="left_sidebar_layout" value="left_sidebar_layout">
                    <label for="left_sidebar_layout">
                        <img src="{{ asset('themes/default/public/assets/images/layout/left-sideber.png') }}"
                            title="left sidebar layout" alt="left sidebar layout" class="layout_img">
                    </label>
                </div>
            </div>
            <div class="col-4">
                <div class="input-group">
                    <input type="radio"
                        {{ isset($option_settings['blog_layout']) && $option_settings['blog_layout'] == 'right_sidebar_layout' ? 'checked' : '' }}
                        class="d-none" name="blog_layout" id="right_sidebar_layout" value="right_sidebar_layout">
                    <label for="right_sidebar_layout">
                        <img src="{{ asset('themes/default/public/assets/images/layout/right-sideber.png') }}"
                            title="right sidebar layout" alt="right sidebar layout" class="layout_img">
                    </label>
                </div>
            </div>
        </div>
    </div>
    {{-- Blog Layout Field End --}}

    {{-- Blog Column Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-5">
            <label class="font-16 bold black">{{ translate('Blog Column') }}
            </label>
            <span
                class="d-block">{{ translate('Select your blog post column from here. If you use this option then you will able to select three type of blog colum layout ( Default One Column ).') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1 row" id="blog_colum_image_field">
            <div class="col-4">
                <div class="input-group">
                    <input type="radio"
                        {{ isset($option_settings['blog_colum']) && $option_settings['blog_colum'] == 'blog_colum_1' ? 'checked' : '' }}
                        class="d-none" name="blog_colum" id="blog_colum_1" value="blog_colum_1">
                    <label for="blog_colum_1">
                        <img src="{{ asset('themes/default/public/assets/images/layout/1column.png') }}"
                            title="Blog Column 1" alt="Blog Column 1" class="layout_img">
                    </label>
                </div>
            </div>
            <div class="col-4">
                <div class="input-group">
                    <input type="radio"
                        {{ isset($option_settings['blog_colum']) && $option_settings['blog_colum'] == 'blog_colum_2' ? 'checked' : '' }}
                        class="d-none" name="blog_colum" id="blog_colum_2" value="blog_colum_2">
                    <label for="blog_colum_2">
                        <img src="{{ asset('themes/default/public/assets/images/layout/2column.png') }}"
                            title="Blog Column 2" alt="Blog Column 2" class="layout_img">
                    </label>
                </div>
            </div>
            <div class="col-4">
                <div class="input-group">
                    <input type="radio"
                        {{ isset($option_settings['blog_colum']) && $option_settings['blog_colum'] == 'blog_colum_3' ? 'checked' : '' }}
                        class="d-none" name="blog_colum" id="blog_colum_3" value="blog_colum_3">
                    <label for="blog_colum_3">
                        <img src="{{ asset('themes/default/public/assets/images/layout/3column.png') }}"
                            title="Blog Column 3" alt="Blog Column 3" class="layout_img">
                    </label>
                </div>
            </div>
        </div>
    </div>
    {{-- Blog Column Field End --}}

    {{-- Blog Post Style Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-5">
            <label for="back_to_top_button" class="font-16 bold black">{{ translate('Blog Post Style') }}
            </label>
            <span class="d-block">{{ translate('Select Blog Post Style.') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <select class="form-control select" name="blog_post_style" id="blog_post_style">
                <option value="s_one"
                    {{ isset($option_settings['blog_post_style']) && $option_settings['blog_post_style'] == 's_one' ? 'selected' : '' }}
                    data-image="s_one">Style One</option>
                <option value="s_two"
                    {{ isset($option_settings['blog_post_style']) && $option_settings['blog_post_style'] == 's_two' ? 'selected' : '' }}
                    data-image="s_two">Style Two</option>
                <option value="s_three"
                    {{ isset($option_settings['blog_post_style']) && $option_settings['blog_post_style'] == 's_three' ? 'selected' : '' }}
                    data-image="s_three">Style Three</option>
                <option value="s_four"
                    {{ isset($option_settings['blog_post_style']) && $option_settings['blog_post_style'] == 's_four' ? 'selected' : '' }}
                    data-image="s_four">Style Four</option>
                <option value="s_five"
                    {{ isset($option_settings['blog_post_style']) && $option_settings['blog_post_style'] == 's_five' ? 'selected' : '' }}
                    data-image="s_five">Style Five</option>
            </select>
        </div>
    </div>
    {{-- Style image --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-6 offset-xl-5">
            <img src="" id="blog_post_style_image">
        </div>
    </div>
    {{-- Blog Post Style Field End --}}

    {{-- Blog Page Title Show-Hide Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-5">
            <label class="font-16 bold black">{{ translate('Blog Page Title') }}
            </label>
            <span
                class="d-block">{{ translate('Control blog page title show / hide. If you use this option then you will able to show / hide your blog page title ( Default Setting Show ).') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <label class="switch success">
                <input type="hidden" name="blog_page_title" value="0">
                <input type="checkbox"
                    {{ isset($option_settings['blog_page_title']) && $option_settings['blog_page_title'] == 1 ? 'checked' : '' }}
                    name="blog_page_title" id="blog_page_title" value="1">
                <span class="control" id="blog_page_title_switch">
                    <span class="switch-off">{{ translate('Hide') }}</span>
                    <span class="switch-on">{{ translate('Show') }}</span>
                </span>
            </label>
        </div>
    </div>
    {{-- Blog Page Title Show-Hide Field End --}}

    {{-- Blog Page Title Show Field Start --}}
    <div id="blog_page_title_switch_on_field">
        {{-- Blog Page Title Setting Default-Custom Field Start --}}
        <div class="form-group row py-4 border-bottom">
            <div class="col-xl-5">
                <label class="font-16 bold black">{{ translate('Blog Page Title Setting') }}
                </label>
                <span
                    class="d-block">{{ translate('Control blog page title setting. If you use this option then you can able to show default or custom blog page title ( Default Blog ).') }}</span>
            </div>
            <div class="col-xl-6 offset-xl-1">
                <label class="switch success">
                    <input type="hidden" name="blog_page_title_setting" value="default">
                    <input type="checkbox"
                        {{ isset($option_settings['blog_page_title_setting']) && $option_settings['blog_page_title_setting'] == 'custom' ? 'checked' : '' }}
                        name="blog_page_title_setting" id="blog_page_title_setting" value="custom">
                    <span class="control" id="blog_page_title_setting_switch">
                        <span class="switch-off">{{ translate('Default') }}</span>
                        <span class="switch-on">{{ translate('Custom') }}</span>
                    </span>
                </label>
            </div>
        </div>
        {{-- Blog Page Title Setting Default-Custom Field End --}}

        {{-- Blog Page Title Custom Field Start --}}
        <div id="blog_page_title_setting_switch_on_field">
            <div class="form-group row py-4 border-bottom">
                <div class="col-xl-5">
                    <label for="blog_custom_title" class="font-16 bold black">{{ translate('Blog Custom Title') }}
                    </label>
                    <span
                        class="d-block">{{ translate('Set blog page custom title form here. If you use this option then you will able to set your won title text.') }}</span>
                </div>
                <div class="col-xl-6 offset-xl-1">
                    <input type="text" name="blog_custom_title" id="blog_custom_title" class="form-control"
                        value="{{ isset($option_settings['blog_custom_title']) ? $option_settings['blog_custom_title'] : '' }}">
                    <small>{{ translate('Transalate to another language') }} <a
                            href="{{ route('core.languages') }}">{{ translate('click here') }}.</a></small>
                </div>
            </div>
        </div>
        {{-- Blog Page Title Custom Field End- --}}
    </div>
    {{-- Blog Page Title Show Field End --}}

    {{-- Blog Post Excerpt Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-5">
            <label class="font-16 bold black">{{ translate('Blog Posts Excerpt') }}
            </label>
            <span
                class="d-block">{{ translate('Control the number of characters you want to show in the blog page for each post.. If you use this option then you can able to control your blog post characters from here.(default 50 character)') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1 row align-items-center">
            <input type="number" class="form-control col-xl-3" name="blog_posts_excerpt" id="blog_posts_excerpt"
                value="{{ isset($option_settings['blog_posts_excerpt']) ? $option_settings['blog_posts_excerpt'] : '0' }}">
            <input type="range" class="col-xl-8" id="blog_posts_excerpt_range" style="height: 30%;"
                min="0" max="100"
                value="{{ isset($option_settings['blog_posts_excerpt']) ? $option_settings['blog_posts_excerpt'] : '0' }}">
        </div>
    </div>
    {{-- Blog Post Excerpt Field End --}}

    {{-- Blog PerPage Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-5">
            <label class="font-16 bold black">{{ translate('Blog PerPage Number') }}
            </label>
            <span
                class="d-block">{{ translate('Control the number blogs to show on each page ( Default show 10 ).') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1 row align-items-center">
            <input type="number" class="form-control col-xl-3" name="blog_perpage" id="blog_perpage"
                value="{{ isset($option_settings['blog_perpage']) ? $option_settings['blog_perpage'] : '0' }}">
            <input type="range" class="col-xl-8" id="blog_perpage_range" style="height: 30%;" min="0"
                max="100"
                value="{{ isset($option_settings['blog_perpage']) ? $option_settings['blog_perpage'] : '0' }}">
        </div>
    </div>
    {{-- Blog PerPage Field End --}}

    {{-- Blog Read More Text Setting Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-5">
            <label class="font-16 bold black">{{ translate('Read More Text Setting') }}
            </label>
            <span class="d-block">{{ translate('Control read more text from here.') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <label class="switch success">
                <input type="hidden" name="read_more_text_setting" value="default">
                <input type="checkbox"
                    {{ isset($option_settings['read_more_text_setting']) && $option_settings['read_more_text_setting'] == 'custom' ? 'checked' : '' }}
                    name="read_more_text_setting" id="read_more_text_setting" value="custom">
                <span class="control" id="read_more_text_setting_switch">
                    <span class="switch-off">{{ translate('Default') }}</span>
                    <span class="switch-on">{{ translate('Custom') }}</span>
                </span>
            </label>
        </div>
    </div>
    {{-- Blog Read More Text Setting Field End --}}

    {{-- Blog Read More Text Setting Switch On Field Start --}}
    <div class="form-group row py-4 border-bottom" id="read_more_text_setting_switch_on_field">
        <div class="col-xl-5">
            <label for="read_more_text_setting" class="font-16 bold black">{{ translate('Read More Text') }}
            </label>
            <span
                class="d-block">{{ translate('Set read moer text here. If you use this option then you will able to set your won text.') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <input type="text" name="read_more_text" id="read_more_text" class="form-control"
                placeholder="{{ translate('Read More Text') }}"
                value="{{ isset($option_settings['read_more_text']) ? $option_settings['read_more_text'] : '' }}">
            <small>{{ translate('Transalate to another language') }} <a
                    href="{{ route('core.languages') }}">{{ translate('click here') }}.</a></small>
        </div>
    </div>
    {{-- Blog Read More Text Setting Switch On Field End --}}

    {{-- Blog Pagination Settings Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-5">
            <label class="font-16 bold black">{{ translate('Blog Pagination Settings') }}
            </label>
            <span class="d-block">{{ translate('Set blog pagination. Number Pagination or Link Pagination') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <label class="switch success">
                <input type="hidden" name="blog_pagination_setting" value="link">
                <input type="checkbox"
                    {{ isset($option_settings['blog_pagination_setting']) && $option_settings['blog_pagination_setting'] == 'number' ? 'checked' : '' }}
                    name="blog_pagination_setting" id="blog_pagination_setting" value="number">
                <span class="control" id="blog_pagination_setting_switch">
                    <span class="switch-off">Link</span>
                    <span class="switch-on">Number</span>
                </span>
            </label>
        </div>
    </div>
    {{-- Blog Pagination Settings Field End --}}

    {{-- Blog Pagination Settings Number Field Start --}}
    <div id="blog_pagination_setting_switch_on_field">
        {{-- Blog Pagination Number Settings Position Field Start --}}
        <div class="form-group row py-4 border-bottom">
            <div class="col-xl-5">
                <label class="font-16 bold black">{{ translate('Blog Pagination Position') }}
                </label>
                <span class="d-block">{{ translate('Set blog pagination Position.') }}</span>
            </div>
            <div class="col-xl-6 offset-xl-1">
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-light sm">
                        <input type="radio"
                            {{ isset($option_settings['blog_pagination_position']) && $option_settings['blog_pagination_position'] == 'left' ? 'checked' : '' }}
                            class="d-none" name="blog_pagination_position" id="left" value="left">
                        {{ translate('left') }}
                    </label>
                    <label class="btn btn-light sm">
                        <input type="radio"
                            {{ isset($option_settings['blog_pagination_position']) && $option_settings['blog_pagination_position'] == 'center' ? 'checked' : '' }}
                            class="d-none" name="blog_pagination_position" id="center" value="center">
                        {{ translate('center') }}
                    </label>
                    <label class="btn btn-light sm">
                        <input type="radio"
                            {{ isset($option_settings['blog_pagination_position']) && $option_settings['blog_pagination_position'] == 'right' ? 'checked' : '' }}
                            class="d-none" name="blog_pagination_position" id="right" value="right">
                        {{ translate('right') }}
                    </label>
                </div>
            </div>
        </div>
        {{-- Blog Pagination Number Settings Position Field End --}}

        {{-- Blog Pagination Number Settings  Active Color Field Start --}}
        <div class="form-group row py-4 border-bottom">
            <div class="col-xl-5">
                <label class="font-16 bold black">{{ translate('Blog Pagination Active Color') }}
                </label>
                <span class="d-block">{{ translate('Set Blog Pagination Active Color.') }}</span>
            </div>
            <div class="col-xl-6 offset-xl-1">
                <div class="row ml-2">
                    <div class="color">
                        <input type="text" class="form-control" name="blog_pagination_active_color"
                            value="{{ isset($option_settings['blog_pagination_active_color']) ? $option_settings['blog_pagination_active_color'] : '' }}">

                        <input type="color" class="" id="blog_pagination_active_color"
                            value="{{ isset($option_settings['blog_pagination_active_color']) ? $option_settings['blog_pagination_active_color'] : '#fafafa' }}">
                        <label for="blog_pagination_active_color">{{ translate('Select Color') }}</label>
                    </div>
                    <div class="d-flex align-items-center">
                        <label class="custom-checkbox position-relative ml-2 mr-1">
                            <input type="hidden" name="blog_pagination_active_color_transparent" value="0">
                            <input type="checkbox"
                                {{ isset($option_settings['blog_pagination_active_color_transparent']) && $option_settings['blog_pagination_active_color_transparent'] == 1 ? 'checked' : '' }}
                                name="blog_pagination_active_color_transparent"
                                id="blog_pagination_active_color_transparent" value="1">
                            <span class="checkmark"></span>
                        </label>
                        <label class="black font-16"
                            for="blog_pagination_active_color_transparent">{{ translate('Transparent') }}</label>
                    </div>
                </div>
            </div>
        </div>
        {{-- Blog Pagination Number Settings Active Color Field End --}}

        {{-- Blog Pagination Number Settings  Active Background Color Field Start --}}
        <div class="form-group row py-4 border-bottom">
            <div class="col-xl-5">
                <label class="font-16 bold black">{{ translate('Blog Pagination Active Background Color') }}
                </label>
                <span class="d-block">{{ translate('Set Blog Pagination Active Background Color.') }}</span>
            </div>
            <div class="col-xl-6 offset-xl-1">
                <div class="row ml-2">
                    <div class="color">
                        <input type="text" class="form-control" name="blog_pagination_active_bg_color"
                            value="{{ isset($option_settings['blog_pagination_active_bg_color']) ? $option_settings['blog_pagination_active_bg_color'] : '' }}">

                        <input type="color" class="" id="blog_pagination_active_bg_color"
                            value="{{ isset($option_settings['blog_pagination_active_bg_color']) ? $option_settings['blog_pagination_active_bg_color'] : '#fafafa' }}">
                        <label for="blog_pagination_active_bg_color">{{ translate('Select Color') }}</label>
                    </div>
                    <div class="d-flex align-items-center">
                        <label class="custom-checkbox position-relative ml-2 mr-1">
                            <input type="hidden" name="blog_pagination_active_bg_color_transparent" value="0">
                            <input type="checkbox"
                                {{ isset($option_settings['blog_pagination_active_bg_color_transparent']) && $option_settings['blog_pagination_active_bg_color_transparent'] == 1 ? 'checked' : '' }}
                                name="blog_pagination_active_bg_color_transparent"
                                id="blog_pagination_active_bg_color_transparent" value="1">
                            <span class="checkmark"></span>
                        </label>
                        <label class="black font-16"
                            for="blog_pagination_active_bg_color_transparent">{{ translate('Transparent') }}</label>
                    </div>
                </div>
            </div>
        </div>
        {{-- Blog Pagination Number Settings  Active Background Color Field End --}}
    </div>
    {{-- Blog Pagination Settings Number Field End --}}

    {{-- Blog Pagination Color Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-5">
            <label class="font-16 bold black">{{ translate('Blog Pagination Color') }}
            </label>
            <span class="d-block">{{ translate('Set Blog Pagination Color.') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <div class="row ml-2">
                <div class="color">
                    <input type="text" class="form-control" name="blog_pagination_color"
                        value="{{ isset($option_settings['blog_pagination_color']) ? $option_settings['blog_pagination_color'] : '' }}">

                    <input type="color" class="" id="blog_pagination_color"
                        value="{{ isset($option_settings['blog_pagination_color']) ? $option_settings['blog_pagination_color'] : '#fafafa' }}">
                    <label for="blog_pagination_color">{{ translate('Select Color') }}</label>
                </div>
                <div class="d-flex align-items-center">
                    <label class="custom-checkbox position-relative ml-2 mr-1">
                        <input type="hidden" name="blog_pagination_color_transparent" value="0">
                        <input type="checkbox"
                            {{ isset($option_settings['blog_pagination_color_transparent']) && $option_settings['blog_pagination_color_transparent'] == 1 ? 'checked' : '' }}
                            name="blog_pagination_color_transparent" id="blog_pagination_color_transparent"
                            value="1">
                        <span class="checkmark"></span>
                    </label>
                    <label class="black font-16"
                        for="blog_pagination_color_transparent">{{ translate('Transparent') }}</label>
                </div>
            </div>
        </div>
    </div>
    {{-- Blog Pagination Color Field End --}}

    {{-- Blog Pagination Background Color Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-5">
            <label class="font-16 bold black">{{ translate('Blog Pagination Background Color') }}
            </label>
            <span class="d-block">{{ translate('Set Blog Pagination Background Color.') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <div class="row ml-2">
                <div class="color">
                    <input type="text" class="form-control" name="blog_pagination_bg_color"
                        value="{{ isset($option_settings['blog_pagination_bg_color']) ? $option_settings['blog_pagination_bg_color'] : '' }}">

                    <input type="color" class="" id="blog_pagination_bg_color"
                        value="{{ isset($option_settings['blog_pagination_bg_color']) ? $option_settings['blog_pagination_bg_color'] : '#fafafa' }}">
                    <label for="blog_pagination_bg_color">{{ translate('Select Color') }}</label>
                </div>
                <div class="d-flex align-items-center">
                    <label class="custom-checkbox position-relative ml-2 mr-1">
                        <input type="hidden" name="blog_pagination_bg_color_transparent" value="0">
                        <input type="checkbox"
                            {{ isset($option_settings['blog_pagination_bg_color_transparent']) && $option_settings['blog_pagination_bg_color_transparent'] == 1 ? 'checked' : '' }}
                            name="blog_pagination_bg_color_transparent" id="blog_pagination_bg_color_transparent"
                            value="1">
                        <span class="checkmark"></span>
                    </label>
                    <label class="black font-16"
                        for="blog_pagination_bg_color_transparent">{{ translate('Transparent') }}</label>
                </div>
            </div>
        </div>
    </div>
    {{-- Blog Pagination Background Color Field End --}}

    {{-- Blog Pagination Hover Color Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-5">
            <label class="font-16 bold black">{{ translate('Blog Pagination Hover Color') }}
            </label>
            <span class="d-block">{{ translate('Set Blog Pagination Hover Color.') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <div class="row ml-2">
                <div class="color">
                    <input type="text" class="form-control" name="blog_pagination_hover_color"
                        value="{{ isset($option_settings['blog_pagination_hover_color']) ? $option_settings['blog_pagination_hover_color'] : '' }}">

                    <input type="color" class="" id="blog_pagination_hover_color"
                        value="{{ isset($option_settings['blog_pagination_hover_color']) ? $option_settings['blog_pagination_hover_color'] : '#fafafa' }}">
                    <label for="blog_pagination_hover_color">{{ translate('Select Color') }}</label>
                </div>
                <div class="d-flex align-items-center">
                    <label class="custom-checkbox position-relative ml-2 mr-1">
                        <input type="hidden" name="blog_pagination_hover_color_transparent" value="0">
                        <input type="checkbox"
                            {{ isset($option_settings['blog_pagination_hover_color_transparent']) && $option_settings['blog_pagination_hover_color_transparent'] == 1 ? 'checked' : '' }}
                            name="blog_pagination_hover_color_transparent"
                            id="blog_pagination_hover_color_transparent" value="1">
                        <span class="checkmark"></span>
                    </label>
                    <label class="black font-16"
                        for="blog_pagination_hover_color_transparent">{{ translate('Transparent') }}</label>
                </div>
            </div>
        </div>
    </div>
    {{-- Blog Pagination Hover Color Field End --}}

    {{-- Blog Pagination Hover Background Color Field End --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-5">
            <label class="font-16 bold black">{{ translate('Blog Pagination Hover Background Color') }}
            </label>
            <span class="d-block">{{ translate('Set Blog Pagination Hover Background Color.') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <div class="row ml-2">
                <div class="color">
                    <input type="text" class="form-control" name="blog_pagination_hover_bg_color"
                        value="{{ isset($option_settings['blog_pagination_hover_bg_color']) ? $option_settings['blog_pagination_hover_bg_color'] : '' }}">

                    <input type="color" class="" id="blog_pagination_hover_bg_color"
                        value="{{ isset($option_settings['blog_pagination_hover_bg_color']) ? $option_settings['blog_pagination_hover_bg_color'] : '#fafafa' }}">
                    <label for="blog_pagination_hover_bg_color">{{ translate('Select Color') }}</label>
                </div>
                <div class="d-flex align-items-center">
                    <label class="custom-checkbox position-relative ml-2 mr-1">
                        <input type="hidden" name="blog_pagination_hover_bg_color_transparent" value="0">
                        <input type="checkbox"
                            {{ isset($option_settings['blog_pagination_hover_bg_color_transparent']) && $option_settings['blog_pagination_hover_bg_color_transparent'] == 1 ? 'checked' : '' }}
                            name="blog_pagination_hover_bg_color_transparent"
                            id="blog_pagination_hover_bg_color_transparent" value="1">
                        <span class="checkmark"></span>
                    </label>
                    <label class="black font-16"
                        for="blog_pagination_hover_bg_color_transparent">{{ translate('Transparent') }}</label>
                </div>
            </div>
        </div>
    </div>
    {{-- Blog Pagination Hover Background Color Field End --}}
</div>
{{-- Custom Blog Style Switch on Field End --}}
