@php
    $fonts = getAllFonts();
@endphp
{{-- Page Header --}}
<h3 class="black mb-3">{{ translate('Page') }}</h3>
<input type="hidden" name="option_name" value="page">

{{-- Custom Sidebar Switch Start --}}
<div class="form-group row py-4 border-bottom">
    <div class="col-xl-3">
        <label class="font-16 bold black">{{ translate('Custom Page Style') }}
        </label>
        <span class="d-block">{{ translate('set custom page style.') }}</span>
    </div>
    <div class="col-xl-6 offset-xl-1">
        <label class="switch success">
            <input type="hidden" name="custom_page_c" value="0">
            <input type="checkbox"
                {{ isset($option_settings['custom_page_c']) && $option_settings['custom_page_c'] == 1 ? 'checked' : '' }}
                name="custom_page_c" id="custom_page" value="1">
            <span class="control" id="custom_page_switch">
                <span class="switch-off">{{ translate('Disable') }}</span>
                <span class="switch-on">{{ translate('Enable') }}</span>
            </span>
        </label>
    </div>
</div>
{{-- Custom Sidebar Switch End --}}

{{-- Custom Page Switch On Field Start --}}
<div id="custom_page_switch_on_field">
    {{-- Page Select layout Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4">
            <label class="font-16 bold black">{{ translate('Select layout') }}
            </label>
            <span
                class="d-block">{{ translate('Choose your page layout. If you use this option then you will able to choose three type of page layout ( Default no sidebar ).') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1 row" id="page_layout_c_image_field">
            <div class="col-4">
                <div class="input-group col-xl-5">
                    <input type="radio" class="d-none"
                        {{ isset($option_settings['page_layout_c']) && $option_settings['page_layout_c'] == 'no_sidebar' ? 'checked' : '' }}
                        name="page_layout_c" id="no_sidebar" value="no_sidebar">
                    <label for="no_sidebar">
                        <img src="{{ asset('themes/default/public/assets/images/layout/no-sideber.png') }}"
                            title="1 layout" alt="1 layout" class="layout_img">
                    </label>
                </div>
            </div>
            <div class="col-4">
                <div class="input-group col-xl-5">
                    <input type="radio" class="d-none"
                        {{ isset($option_settings['page_layout_c']) && $option_settings['page_layout_c'] == 'left_sidebar' ? 'checked' : '' }}
                        name="page_layout_c" id="left_sidebar" value="left_sidebar">
                    <label for="left_sidebar">
                        <img src="{{ asset('themes/default/public/assets/images/layout/left-sideber.png') }}"
                            title="2 layout" alt="2 layout" class="layout_img">
                    </label>
                </div>
            </div>
            <div class="col-4">
                <div class="input-group col-xl-5">
                    <input type="radio" class="d-none"
                        {{ isset($option_settings['page_layout_c']) && $option_settings['page_layout_c'] == 'right_sidebar' ? 'checked' : '' }}
                        name="page_layout_c" id="right_sidebar" value="right_sidebar">
                    <label for="right_sidebar">
                        <img src="{{ asset('themes/default/public/assets/images/layout/right-sideber.png') }}"
                            title="3 layout" alt="3 layout" class="layout_img">
                    </label>
                </div>
            </div>

        </div>
    </div>
    {{-- Page Select layout Field End --}}

    {{-- Page layout Sidebar Field Start --}}
    <div class="form-group row py-4 border-bottom" id="page_sidebar_setting_field">
        <div class="col-xl-4">
            <label class="font-16 bold black">{{ translate('Sidebar Settings') }}
            </label>
            <span
                class="d-block">{{ translate('Set page sidebar. If you use this option then you will able to set three type of sidebar ( Default no sidebar ).') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-light sm">
                    <input type="radio" class="d-none"
                        {{ isset($option_settings['page_sidebar_setting_c']) && $option_settings['page_sidebar_setting_c'] == 'page_sidebar' ? 'checked' : '' }}
                        name="page_sidebar_setting_c" id="page_sidebar" value="page_sidebar">
                    {{ translate('Page Sidebar') }}
                </label>
                <label class="btn btn-light sm">
                    <input type="radio" class="d-none"
                        {{ isset($option_settings['page_sidebar_setting_c']) && $option_settings['page_sidebar_setting_c'] == 'blog_sidebar' ? 'checked' : '' }}
                        name="page_sidebar_setting_c" id="blog_sidebar" value="blog_sidebar">
                    {{ translate('Blog Sidebar') }}
                </label>
            </div>
        </div>
    </div>
    {{-- Page layout Sidebar Field End --}}

    {{-- Page Title Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4">
            <label class="font-16 bold black">{{ translate('Title') }}
            </label>
            <span
                class="d-block">{{ translate('Switch enabled to display page title. Fot this option you will able to show / hide page title. Default setting Enabled') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <label class="switch success">
                <input type="hidden" name="page_title_c" value="0">
                <input type="checkbox"
                    {{ isset($option_settings['page_title_c']) && $option_settings['page_title_c'] == 1 ? 'checked' : '' }}
                    name="page_title_c" id="page_title" value="1">
                <span class="control" id="page_title_switch">
                    <span class="switch-off">{{ translate('Disable') }}</span>
                    <span class="switch-on">{{ translate('Enable') }}</span>
                </span>
            </label>
        </div>
    </div>
    {{-- Page Title Field End --}}

    {{-- Page Title Switch On Field Start --}}
    <div id="page_title_switch_on_field">
        {{-- Page Title Tag Field Start --}}
        <div class="form-group row py-4 border-bottom">
            <div class="col-xl-4">
                <label class="font-16 bold black">{{ translate('Title Tag') }}
                </label>
                <span
                    class="d-block">{{ translate('Select page title tag. If you use this option then you can able to change title tag H1 - H6 ( Default tag H1 )') }}</span>
            </div>
            <div class="col-xl-6 offset-xl-1">
                <select name="page_title_tag_s" id="page_title_tag_s" class="form-control select">
                    <option value="h1"
                        {{ isset($option_settings['page_title_tag_s']) && $option_settings['page_title_tag_s'] == 'h1' ? 'selected' : '' }}>
                        H1</option>
                    <option value="h2"
                        {{ isset($option_settings['page_title_tag_s']) && $option_settings['page_title_tag_s'] == 'h2' ? 'selected' : '' }}>
                        H2</option>
                    <option value="h3"
                        {{ isset($option_settings['page_title_tag_s']) && $option_settings['page_title_tag_s'] == 'h3' ? 'selected' : '' }}>
                        H3</option>
                    <option value="h4"
                        {{ isset($option_settings['page_title_tag_s']) && $option_settings['page_title_tag_s'] == 'h4' ? 'selected' : '' }}>
                        H4</option>
                    <option value="h5"
                        {{ isset($option_settings['page_title_tag_s']) && $option_settings['page_title_tag_s'] == 'h5' ? 'selected' : '' }}>
                        H5</option>
                    <option value="h6"
                        {{ isset($option_settings['page_title_tag_s']) && $option_settings['page_title_tag_s'] == 'h6' ? 'selected' : '' }}>
                        H6</option>
                </select>
            </div>
        </div>
        {{-- Page Title Tag Field End --}}

        {{-- Page Title Font Settings Field Start --}}
        <div class="form-group row py-4 border-bottom">
            <div class="col-xl-3">
                <label class="font-16 bold black">{{ translate('Font Settings') }}
                </label>
                <span
                    class="d-block">{{ translate('Select font setting for page title. If you use this options then you will able to change Font Weight, Text Align, Text Transform, Font Size, Line Height, Word Spacing, Letter Spacing.') }}</span>
            </div>
            <div class="col-xl-8 offset-xl-1">
                <input type="hidden" name="page_title_typography_google_link_s"
                    id="page_title_typography_google_link_s"
                    value="{{ isset($option_settings['page_title_typography_google_link_s']) ? $option_settings['page_title_typography_google_link_s'] : '' }}">
                <input type="hidden" name="page_title_typography_css_i" id="page_title_typography_css"
                    value="{{ isset($option_settings['page_title_typography_css_i']) ? $option_settings['page_title_typography_css_i'] : '' }}">
                <input type="hidden" name="page_title_font_unit_i" value="px">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label>{{ translate('Font Family') }}</label>
                            <select name="page_title_font_font-family" class="form-control select font_family"
                                id="page_title_font_family" data-section="page_title">
                                <option value=""
                                    {{ isset($option_settings['page_title_font_font-family']) ? '' : 'selected' }}>
                                    {{ translate('Select  Fonts') }}</option>
                                <optgroup label="{{ translate('Custom Fonts') }}">
                                    <option value="custom-font-1,sans-serif"
                                        {{ isset($option_settings['page_title_font_font-family']) && $option_settings['page_title_font_font-family'] == 'custom-font-1,sans-serif' ? 'selected' : '' }}
                                        data-subsets="" data-variations="">
                                        {{ translate('Custom Font 1') }}</option>

                                    <option value="custom-font-2,sans-serif"
                                        {{ isset($option_settings['page_title_font_font-family']) && $option_settings['page_title_font_font-family'] == 'custom-font-2,sans-serif' ? 'selected' : '' }}
                                        data-subsets="" data-variations="">
                                        {{ translate('Custom Font 2') }}</option>
                                </optgroup>
                                <optgroup label="{{ translate('Google Web Fonts') }}">
                                    @foreach ($fonts as $font)
                                        <option value="{{ $font['family'] . ',sans-serif' }}"
                                            {{ isset($option_settings['page_title_font_font-family']) && $option_settings['page_title_font_font-family'] == $font['family'] . ',sans-serif' ? 'selected' : '' }}
                                            data-subsets="{{ $font['subsets'] }}"
                                            data-variations="{{ $font['variants'] }}">
                                            {{ $font['family'] }}
                                        </option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label>{{ translate('Font Weight & Style') }}</label>
                            <input type="hidden" name="page_title_font_font-style" id="page_title_font_style"
                                value="{{ isset($option_settings['page_title_font_font-style']) ? $option_settings['page_title_font_font-style'] : '' }}">

                            <input type="hidden" name="page_title_font_font-weight" id="page_title_font_weight"
                                value="{{ isset($option_settings['page_title_font_font-weight']) ? $option_settings['page_title_font_font-weight'] : '' }}">

                            <select name="page_title_font_weight_style_i" class="form-control select"
                                id="page_title_font_weight_style_i"
                                data-value="{{ isset($option_settings['page_title_font_weight_style_i']) ? $option_settings['page_title_font_weight_style_i'] : null }}"
                                onchange="createUrl('page_title')">
                                <option value=""
                                    {{ isset($option_settings['page_title_font_weight_style_i']) ? '' : 'selected' }}>
                                    {{ translate('Select Weight & Style') }}</option>
                                <option value="400"
                                    {{ isset($option_settings['page_title_font_weight_style_i']) && $option_settings['page_title_font_weight_style_i'] == '400' ? 'selected' : '' }}>
                                    Normal 400</option>
                                <option value="700"
                                    {{ isset($option_settings['page_title_font_weight_style_i']) && $option_settings['page_title_font_weight_style_i'] == '700' ? 'selected' : '' }}>
                                    Bold 700</option>
                                <option value="400italic"
                                    {{ isset($option_settings['page_title_font_weight_style_i']) && $option_settings['page_title_font_weight_style_i'] == '400italic' ? 'selected' : '' }}>
                                    Normal 400 Italic</option>
                                <option value="700italic"
                                    {{ isset($option_settings['page_title_font_weight_style_i']) && $option_settings['page_title_font_weight_style_i'] == '700italic' ? 'selected' : '' }}>
                                    Bold 700 Italic</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label>{{ translate('Font Subsets') }}</label>
                            <select name="page_title_font_font-subsets_i" class="form-control select"
                                id="page_title_font_subsets"
                                data-value="{{ isset($option_settings['page_title_font_font-subsets_i']) ? $option_settings['page_title_font_font-subsets_i'] : null }}"
                                onchange="createUrl('page_title')">
                                <option value=""
                                    {{ isset($option_settings['page_title_font_font-subsets_i']) ? '' : 'selected' }}>
                                    {{ translate('Select Font Subsets') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label>{{ translate('Text Align') }}</label>
                            <select name="page_title_font_text-align" class="form-control select"
                                id="page_title_text_align" onchange="createFontCss('page_title')">
                                <option value="" disabled
                                    {{ isset($option_settings['page_title_font_text-align']) ? '' : 'selected' }}>
                                    {{ translate('Text Align') }}</option>
                                <option value="inherit"
                                    {{ isset($option_settings['page_title_font_text-align']) && $option_settings['page_title_font_text-align'] == 'inherit' ? 'selected' : '' }}>
                                    Inherit</option>
                                <option value="left"
                                    {{ isset($option_settings['page_title_font_text-align']) && $option_settings['page_title_font_text-align'] == 'left' ? 'selected' : '' }}>
                                    Left</option>
                                <option value="right"
                                    {{ isset($option_settings['page_title_font_text-align']) && $option_settings['page_title_font_text-align'] == 'right' ? 'selected' : '' }}>
                                    Right</option>
                                <option value="center"
                                    {{ isset($option_settings['page_title_font_text-align']) && $option_settings['page_title_font_text-align'] == 'center' ? 'selected' : '' }}>
                                    Center</option>
                                <option value="justify"
                                    {{ isset($option_settings['page_title_font_text-align']) && $option_settings['page_title_font_text-align'] == 'justify' ? 'selected' : '' }}>
                                    Justify</option>
                                <option value="initial"
                                    {{ isset($option_settings['page_title_font_text-align']) && $option_settings['page_title_font_text-align'] == 'initial' ? 'selected' : '' }}>
                                    Initial</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label>{{ translate('Text Transform') }}</label>
                            <select name="page_title_font_text-transform" class="form-control select"
                                id="page_title_text_transform" onchange="createFontCss('page_title')">
                                <option value="" disabled
                                    {{ isset($option_settings['page_title_font_text-transform']) ? '' : 'selected' }}>
                                    {{ translate('Text Transform') }}</option>
                                <option value="none"
                                    {{ isset($option_settings['page_title_font_text-transform']) && $option_settings['page_title_font_text-transform'] == 'none' ? 'selected' : '' }}>
                                    None</option>
                                <option value="capitalize"
                                    {{ isset($option_settings['page_title_font_text-transform']) && $option_settings['page_title_font_text-transform'] == 'capitalize' ? 'selected' : '' }}>
                                    Capitalize</option>
                                <option value="uppercase"
                                    {{ isset($option_settings['page_title_font_text-transform']) && $option_settings['page_title_font_text-transform'] == 'uppercase' ? 'selected' : '' }}>
                                    Uppercase</option>
                                <option value="lowercase"
                                    {{ isset($option_settings['page_title_font_text-transform']) && $option_settings['page_title_font_text-transform'] == 'lowercase' ? 'selected' : '' }}>
                                    Lowercase</option>
                                <option value="initial"
                                    {{ isset($option_settings['page_title_font_text-transform']) && $option_settings['page_title_font_text-transform'] == 'initial' ? 'selected' : '' }}>
                                    Initial</option>
                                <option value="inherit"
                                    {{ isset($option_settings['page_title_font_text-transform']) && $option_settings['page_title_font_text-transform'] == 'inherit' ? 'selected' : '' }}>
                                    Inherit</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-6 row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label>{{ translate('Font Size') }}</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="page_title_font_u_font-size"
                                        id="page_title_font_size" placeholder="{{ translate('Size') }}"
                                        value="{{ isset($option_settings['page_title_font_u_font-size']) ? $option_settings['page_title_font_u_font-size'] : '' }}"
                                        onkeyup="createFontCss('page_title')">
                                    <div class="input-group-append">
                                        <div class="input-group-text">px</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label>{{ translate('Line Height') }}</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="page_title_font_u_line-height"
                                        id="page_title_line_height" placeholder="{{ translate('Height') }}"
                                        value="{{ isset($option_settings['page_title_font_u_line-height']) ? $option_settings['page_title_font_u_line-height'] : '' }}"
                                        onkeyup="createFontCss('page_title')">
                                    <div class="input-group-append">
                                        <div class="input-group-text">px</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 row">
                        <div class="col-xl-4">
                            <div class="form-group">
                                <label>{{ translate('Word Spacing') }}</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="page_title_font_u_word-spacing"
                                        id="page_title_word_spacing" placeholder="{{ translate('Word Spacing') }}"
                                        value="{{ isset($option_settings['page_title_font_u_word-spacing']) ? $option_settings['page_title_font_u_word-spacing'] : '' }}"
                                        onkeyup="createFontCss('page_title')">
                                    <div class="input-group-append">
                                        <div class="input-group-text">px</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4">
                            <div class="form-group">
                                <label>{{ translate('Letter Spacing') }}</label>
                                <div class="input-group">
                                    <input type="number" class="form-control"
                                        name="page_title_font_u_letter-spacing" id="page_title_letter_spacing"
                                        placeholder="{{ translate('Letter Spacing') }}"
                                        value="{{ isset($option_settings['page_title_font_u_letter-spacing']) ? $option_settings['page_title_font_u_letter-spacing'] : '' }}"
                                        onkeyup="createFontCss('page_title')">
                                    <div class="input-group-append">
                                        <div class="input-group-text">px</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4">
                            <label for="page_title_font_color">{{ translate('Select Color') }}</label>
                            <div class="color w-100">
                                <input type="text" class="form-control" name="page_title_font_color"
                                    value="{{ isset($option_settings['page_title_font_color']) ? $option_settings['page_title_font_color'] : '' }}">
                                <input type="color" class="" id="page_title_font_color"
                                    value="{{ isset($option_settings['page_title_font_color']) ? $option_settings['page_title_font_color'] : '#fafafa' }}"
                                    oninput="createFontCss('page_title')">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4 border p-4 typography_preview" id="page_title_typography_preview">
                    {{ translate('The Quick Brown Fox Jumps Over The Lazy Dog') }}
                </div>
            </div>
        </div>
        {{-- Page Title Font Settings Field End --}}
    </div>
    {{-- Page Title Switch On Field End --}}


    {{-- Page Background Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-3">
            <label class="font-16 bold black">{{ translate('Background') }}
            </label>
            <span
                class="d-block">{{ translate('Setting page header background. If you use this option then you will able to set Background Color, Background Image, Background Repeat, Background Size, Background Attachment, Background Position.') }}</span>
        </div>
        <div class="col-xl-8 offset-xl-1">
            <div class="row">
                <div class="col-xl-12 my-2">
                    <div class="row ml-1">
                        <div class="color">
                            <input type="text" class="form-control" name="page_background-color"
                                value="{{ isset($option_settings['page_background-color']) ? $option_settings['page_background-color'] : '' }}">
                            <input type="color" class="" id="page_background-color"
                                value="{{ isset($option_settings['page_background-color']) ? $option_settings['page_background-color'] : '#fafafa' }}"
                                oninput="pageHeaderBackgroundCss('page')">
                            <label for="page_background-color">{{ translate('Select Color') }}</label>
                        </div>
                        <div class="d-flex align-items-center">
                            <label class="custom-checkbox position-relative ml-2 mr-1">
                                <input type="hidden" name="page_background-color-transparent_i" value="0">
                                <input type="checkbox"
                                    {{ isset($option_settings['page_background-color-transparent_i']) && $option_settings['page_background-color-transparent_i'] == 1 ? 'checked' : '' }}
                                    name="page_background-color-transparent_i" id="page_background_color-transparent"
                                    value="1" onclick="pageHeaderBackgroundCss('page')">
                                <span class="checkmark"></span>
                            </label>
                            <label class="black font-16"
                                for="page_background_color-transparent">{{ translate('Transparent') }}</label>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 my-2">
                    <label class="col-form-label col-form-label-sm">{{ translate('Background Repeat') }}</label>
                    <select name="page_background-repeat" id="page_bg_repeat" class="form-control select"
                        onchange="pageHeaderBackgroundCss('page')">
                        <option value="" selected>{{ translate('Select Background Repeat') }}</option>
                        <option value="no-repeat"
                            {{ isset($option_settings['page_background-repeat']) && $option_settings['page_background-repeat'] == 'no-repeat' ? 'selected' : '' }}>
                            No Repeat</option>
                        <option value="repeat"
                            {{ isset($option_settings['page_background-repeat']) && $option_settings['page_background-repeat'] == 'repeat' ? 'selected' : '' }}>
                            Repeat All</option>
                        <option value="repeat-x"
                            {{ isset($option_settings['page_background-repeat']) && $option_settings['page_background-repeat'] == 'repeat-x' ? 'selected' : '' }}>
                            Repeat Horizontally</option>
                        <option value="repeat-y"
                            {{ isset($option_settings['page_background-repeat']) && $option_settings['page_background-repeat'] == 'repeat-y' ? 'selected' : '' }}>
                            Repeat Vertically</option>
                        <option value="inherit"
                            {{ isset($option_settings['page_background-repeat']) && $option_settings['page_background-repeat'] == 'inherit' ? 'selected' : '' }}>
                            Inherit</option>
                    </select>
                </div>
                <div class="col-xl-6 my-2">
                    <label class="col-form-label col-form-label-sm">{{ translate('Background Size') }}</label>
                    <select name="page_background-size" id="page_bg_size" class="form-control select"
                        onchange="pageHeaderBackgroundCss('page')">
                        <option value="" selected>{{ translate('Select Background Size') }}</option>
                        <option value="inherit"
                            {{ isset($option_settings['page_background-size']) && $option_settings['page_background-size'] == 'inherit' ? 'selected' : '' }}>
                            Inherit</option>
                        <option value="cover"
                            {{ isset($option_settings['page_background-size']) && $option_settings['page_background-size'] == 'cover' ? 'selected' : '' }}>
                            Cover</option>
                        <option value="contain"
                            {{ isset($option_settings['page_background-size']) && $option_settings['page_background-size'] == 'contain' ? 'selected' : '' }}>
                            Contain</option>
                    </select>
                </div>
                <div class="col-xl-6 my-2">
                    <label class="col-form-label col-form-label-sm">{{ translate('Background Attachment') }}</label>
                    <select name="page_background-attachment" id="page_bg_attachment" class="form-control select"
                        onchange="pageHeaderBackgroundCss('page')">
                        <option value="" selected>{{ translate('Select Background Attachment') }}</option>
                        <option value="fixed"
                            {{ isset($option_settings['page_background-attachment']) && $option_settings['page_background-attachment'] == 'fixed' ? 'selected' : '' }}>
                            Fixed</option>
                        <option value="scroll"
                            {{ isset($option_settings['page_background-attachment']) && $option_settings['page_background-attachment'] == 'scroll' ? 'selected' : '' }}>
                            Scroll</option>
                        <option value="inherit"
                            {{ isset($option_settings['page_background-attachment']) && $option_settings['page_background-attachment'] == 'inherit' ? 'selected' : '' }}>
                            Inherit</option>
                    </select>
                </div>
                <div class="col-xl-6 my-2">
                    <label class="col-form-label col-form-label-sm"
                        for="page_background-repeat">{{ translate('Background Position') }}</label>
                    <select name="page_background-position" id="page_bg_position" class="form-control select"
                        onchange="pageHeaderBackgroundCss('page')">
                        <option value="" selected>{{ translate('Select Background Position') }}</option>
                        <option value="left top"
                            {{ isset($option_settings['page_background-position']) && $option_settings['page_background-position'] == 'left top' ? 'selected' : '' }}>
                            Left Top</option>
                        <option value="left center"
                            {{ isset($option_settings['page_background-position']) && $option_settings['page_background-position'] == 'left center' ? 'selected' : '' }}>
                            Left Center</option>
                        <option value="left bottom"
                            {{ isset($option_settings['page_background-position']) && $option_settings['page_background-position'] == 'left bottom' ? 'selected' : '' }}>
                            Left Bottom</option>
                        <option value="center top"
                            {{ isset($option_settings['page_background-position']) && $option_settings['page_background-position'] == 'center top' ? 'selected' : '' }}>
                            Center Top</option>
                        <option value="center center"
                            {{ isset($option_settings['page_background-position']) && $option_settings['page_background-position'] == 'center center' ? 'selected' : '' }}>
                            Center Center</option>
                        <option value="center bottom"
                            {{ isset($option_settings['page_background-position']) && $option_settings['page_background-position'] == 'center bottom' ? 'selected' : '' }}>
                            Center Bottom</option>
                        <option value="right top"
                            {{ isset($option_settings['page_background-position']) && $option_settings['page_background-position'] == 'right top' ? 'selected' : '' }}>
                            Right Top</option>
                        <option value="right center"
                            {{ isset($option_settings['page_background-position']) && $option_settings['page_background-position'] == 'right center' ? 'selected' : '' }}>
                            Right Center</option>
                        <option value="right bottom"
                            {{ isset($option_settings['page_background-position']) && $option_settings['page_background-position'] == 'right bottom' ? 'selected' : '' }}>
                            Right Bottom</option>
                    </select>
                </div>
                <div class="col-xl-6 my-2">
                    <input type="hidden" name="page_background-image" id="page_background-image" value>
                    @include('core::base.includes.media.media_input', [
                        'input' => 'page_background_image_i',
                        'data' => isset($option_settings['page_background_image_i'])
                            ? $option_settings['page_background_image_i']
                            : null,
                    ])
                </div>
            </div>
            <div class="mt-4 page_background_preview" id="page_background_preview">
            </div>
        </div>
    </div>
    {{-- Page Background Field End --}}

    {{-- Page Overly Switch Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4">
            <label class="font-16 bold black">{{ translate('Overlay') }}
            </label>
            <span
                class="d-block">{{ translate('Check this check box to use overlay. If you use this option then you will able to use background overlay.') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1 row align-items-center">
            <label class="custom-checkbox solid position-relative">
                <input type="hidden" name="overlay_c" value="0">
                <input type="checkbox"
                    {{ isset($option_settings['overlay_c']) && $option_settings['overlay_c'] == 1 ? 'checked' : '' }}
                    name="overlay_c" id="overlay" value="1">
                <span class="checkmark" id="overlay_checkbox"></span>
            </label>
        </div>
    </div>
    {{-- Page Overly Switch Field End --}}

    {{-- Page Overly Switch On Field Start --}}
    <div id="overlay_checkbox_check_field">
        {{-- Page Overlay Bgcolor Field Start --}}
        <div class="form-group row py-4 border-bottom">
            <div class="col-xl-4">
                <label class="font-16 bold black">{{ translate('Overlay Background') }}
                </label>
                <span
                    class="d-block">{{ translate('Choose overlay background color. If you user this option then you will able to choose overlay background color.') }}</span>
            </div>
            <div class="col-xl-6 offset-xl-1">
                <div class="row ml-2">
                    <div class="color">
                        <input type="text" class="form-control" name="overlay_background-color"
                            value="{{ isset($option_settings['overlay_background-color']) ? $option_settings['overlay_background-color'] : '' }}">
                        <input type="color" class="" id="overlay_background_color"
                            value="{{ isset($option_settings['overlay_background-color']) ? $option_settings['overlay_background-color'] : '#fafafa' }}">
                        <label for="overlay_background_color">{{ translate('Select Color') }}</label>
                    </div>
                    <div class="d-flex align-items-center">
                        <label class="custom-checkbox position-relative ml-2 mr-1">
                            <input type="hidden" name="overlay_background-color-transparent_i" value="0">
                            <input type="checkbox"
                                {{ isset($option_settings['overlay_background-color-transparent_i']) && $option_settings['overlay_background-color-transparent_i'] == 1 ? 'checked' : '' }}
                                name="overlay_background-color-transparent_i"
                                id="overlay_background-color-transparent" value="1">
                            <span class="checkmark"></span>
                        </label>
                        <label class="black font-16"
                            for="overlay_background-color-transparent">{{ translate('Transparent') }}</label>
                    </div>
                </div>
            </div>
        </div>
        {{-- Page Overlay Bgcolor Field End --}}

        {{-- Page Overlay Opacity Field Start --}}
        <div class="form-group row py-4 border-bottom">
            <div class="col-xl-4">
                <label class="font-16 bold black">{{ translate('Opacity') }}
                </label>
                <span
                    class="d-block">{{ translate('Setting overlay opacity. If you use this option then you will able to show light to dark overlay background color ( Default opacity 0.5 ).') }}</span>
            </div>
            <div class="col-xl-6 offset-xl-1 row align-items-center">
                <input type="number" step="any" class="form-control col-xl-3" name="overlay_opacity"
                    id="overlay_opacity"
                    value="{{ isset($option_settings['overlay_opacity']) ? $option_settings['overlay_opacity'] : '' }}">

                <input type="range" class="col-xl-8" id="overlay_opacity_range" style="height: 30%;"
                    min="0" max="1" step="0.1"
                    value="{{ isset($option_settings['overlay_opacity']) ? $option_settings['overlay_opacity'] : '0.5' }}">
            </div>
        </div>
        {{-- Page Overlay Opacity Field End --}}
    </div>
    {{-- Page Overly Switch on Field End --}}

    {{-- Page Breadcrumb Hide/Show Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4">
            <label class="font-16 bold black">{{ translate('Breadcrumb Hide/Show') }}
            </label>
            <span
                class="d-block">{{ translate('Hide / Show breadcrumb from all pages and posts ( Default settings show ).') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <label class="switch success">
                <input type="hidden" name="breadcrumb_hide_show_c" value="0">
                <input type="checkbox"
                    {{ isset($option_settings['breadcrumb_hide_show_c']) && $option_settings['breadcrumb_hide_show_c'] == 1 ? 'checked' : '' }}
                    name="breadcrumb_hide_show_c" id="breadcrumb_hide_show" value="1">
                <span class="control" id="breadcrumb_hide_show_switch">
                    <span class="switch-off">{{ translate('Hide') }}</span>
                    <span class="switch-on">{{ translate('Show') }}</span>
                </span>
            </label>
        </div>
    </div>
    {{-- Page Breadcrumb Hide/Show Field End --}}

    {{-- Page Breadcrumb Hide/Show Switch On Field Start --}}
    <div id="breadcrumb_hide_show_switch_on_field">
        {{-- Page Breadcrumb Color Field Start --}}
        <div class="form-group row py-4 border-bottom">
            <div class="col-xl-4">
                <label class="font-16 bold black">{{ translate('Breadcrumb Color') }}
                </label>
                <span
                    class="d-block">{{ translate('Choose page header breadcrumb text color here.If you user this option then you will able to set page breadcrumb color.') }}</span>
            </div>
            <div class="col-xl-6 offset-xl-1">
                <div class="row ml-2">
                    <div class="color">
                        <input type="text" class="form-control" name="breadcrumb_color"
                            value="{{ isset($option_settings['breadcrumb_color']) ? $option_settings['breadcrumb_color'] : '' }}">

                        <input type="color" class="" id="breadcrumb_color"
                            value="{{ isset($option_settings['breadcrumb_color']) ? $option_settings['breadcrumb_color'] : '#fafafa' }}">
                        <label for="breadcrumb_color">{{ translate('Select Color') }}</label>
                    </div>
                    <div class="d-flex align-items-center">
                        <label class="custom-checkbox position-relative ml-2 mr-1">
                            <input type="hidden" name="breadcrumb_color-transparent_i" value="0">
                            <input type="checkbox"
                                {{ isset($option_settings['breadcrumb_color-transparent_i']) && $option_settings['breadcrumb_color-transparent_i'] == 1 ? 'checked' : '' }}
                                name="breadcrumb_color-transparent_i" id="breadcrumb_color-transparent"
                                value="1">
                            <span class="checkmark"></span>
                        </label>
                        <label class="black font-16"
                            for="breadcrumb_color-transparent">{{ translate('Transparent') }}</label>
                    </div>
                </div>
            </div>
        </div>
        {{-- Page Breadcrumb Color Field End --}}

        {{-- Page Breadcrumb Active Color Field Start --}}
        <div class="form-group row py-4 border-bottom">
            <div class="col-xl-4">
                <label class="font-16 bold black">{{ translate('Breadcrumb Active Color') }}
                </label>
                <span
                    class="d-block">{{ translate('Choose page header breadcrumb text active color here.If you user this option then you will able to set page breadcrumb active color.') }}</span>
            </div>
            <div class="col-xl-6 offset-xl-1">
                <div class="row ml-2">
                    <div class="color">
                        <input type="text" class="form-control" name="breadcrumb_activer_color"
                            value="{{ isset($option_settings['breadcrumb_activer_color']) ? $option_settings['breadcrumb_activer_color'] : '' }}">
                        <input type="color" class="" id="breadcrumb_activer_color"
                            value="{{ isset($option_settings['breadcrumb_activer_color']) ? $option_settings['breadcrumb_activer_color'] : '#fafafa' }}">
                        <label for="breadcrumb_activer_color">{{ translate('Select Color') }}</label>
                    </div>
                    <div class="d-flex align-items-center">
                        <label class="custom-checkbox position-relative ml-2 mr-1">
                            <input type="hidden" name="breadcrumb_activer_color-transparent_i" value="0">
                            <input type="checkbox"
                                {{ isset($option_settings['breadcrumb_activer_color-transparent_i']) && $option_settings['breadcrumb_activer_color-transparent_i'] == 1 ? 'checked' : '' }}
                                name="breadcrumb_activer_color-transparent_i"
                                id="breadcrumb_activer_color-transparent" value="1">
                            <span class="checkmark"></span>
                        </label>
                        <label class="black font-16"
                            for="breadcrumb_activer_color-transparent">{{ translate('Transparent') }}</label>
                    </div>
                </div>
            </div>
        </div>
        {{-- Page Breadcrumb Active Color Field End --}}

        {{-- Page Breadcrumb Divider Color Field Start --}}
        <div class="form-group row py-4 border-bottom">
            <div class="col-xl-4">
                <label class="font-16 bold black">{{ translate('Breadcrumb Divider Color') }}
                </label>
                <span
                    class="d-block">{{ translate('Choose breadcrumb divider color. If you use this option then you will able to use breadcrumb color ( Default color  )') }}</span>
            </div>
            <div class="col-xl-6 offset-xl-1">
                <div class="row ml-2">
                    <div class="color">
                        <input type="text" class="form-control" name="breadcrumb_divider_background-color"
                            value="{{ isset($option_settings['breadcrumb_divider_background-color']) ? $option_settings['breadcrumb_divider_background-color'] : '' }}">

                        <input type="color" class="" id="breadcrumb_divider_background-color"
                            value="{{ isset($option_settings['breadcrumb_divider_background-color']) ? $option_settings['breadcrumb_divider_background-color'] : '#fafafa' }}">

                        <label for="breadcrumb_divider_background-color">{{ translate('Select Color') }}</label>
                    </div>
                    <div class="d-flex align-items-center">
                        <label class="custom-checkbox position-relative ml-2 mr-1">
                            <input type="hidden" name="breadcrumb_divider_background-color-transparent_i"
                                value="0">
                            <input type="checkbox"
                                {{ isset($option_settings['breadcrumb_divider_background-color-transparent_i']) && $option_settings['breadcrumb_divider_background-color-transparent_i'] == 1 ? 'checked' : '' }}
                                name="breadcrumb_divider_background-color-transparent_i"
                                id="breadcrumb_divider_background_color-transparent" value="1">
                            <span class="checkmark"></span>
                        </label>
                        <label class="black font-16"
                            for="breadcrumb_divider_background_color-transparent">{{ translate('Transparent') }}</label>
                    </div>
                </div>
            </div>
        </div>
        {{-- Page Breadcrumb Divider Color Field End --}}
    </div>
    {{-- Page Breadcrumb Hide/Show Switch off Field Start --}}
</div>
{{-- Custom Page Switch On Field End --}}
