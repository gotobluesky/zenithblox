@php
    $fonts = getAllFonts();
@endphp
{{-- Sidebar Options Header --}}
<h3 class="black mb-3">{{ translate('Sidebar Options') }}</h3>
<input type="hidden" name="option_name" value="sidebar_options">

{{-- Blog sidebar Switch Start --}}
<div class="form-group row py-4 border-bottom">
    <div class="col-xl-3">
        <label class="font-16 bold black">{{ translate('Custom Sidebar Style') }}
        </label>
        <span class="d-block">{{ translate('Switch on for custom Sidebar style.') }}</span>
    </div>
    <div class="col-xl-6 offset-xl-1">
        <label class="switch success">
            <input type="hidden" name="custom_sidebar_c" value="0">
            <input type="checkbox"
                {{ isset($option_settings['custom_sidebar_c']) && $option_settings['custom_sidebar_c'] == 1 ? 'checked' : '' }}
                name="custom_sidebar_c" id="custom_sidebar" value="1">
            <span class="control" id="custom_sidebar_switch">
                <span class="switch-off">{{ translate('Disable') }}</span>
                <span class="switch-on">{{ translate('Enable') }}</span>
            </span>
        </label>
    </div>
</div>
{{-- Blog sidebar Switch End --}}

{{-- Custom Sidebar Style Switch On Field Start --}}
<div id="custom_sidebar_switch_on_field">
    {{-- Widgets Background Color Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-3">
            <label class="font-16 bold black">{{ translate('Widgets Background Color') }}
            </label>
        </div>
        <div class="col-xl-8 offset-xl-1">
            <div class="row ml-2">
                <div class="color">
                    <input type="text" class="form-control" name="widget_background-color"
                        value="{{ isset($option_settings['widget_background-color']) ? $option_settings['widget_background-color'] : '' }}">
                    <input type="color" class="" id="widget_background-color"
                        value="{{ isset($option_settings['widget_background-color']) ? $option_settings['widget_background-color'] : '#fafafa' }}">
                    <label for="widget_background-color">{{ translate('Select Color') }}</label>
                </div>
                <div class="d-flex align-items-center">
                    <label class="custom-checkbox position-relative ml-2 mr-1">
                        <input type="hidden" name="widget_background-color-transparent_i" value="0">
                        <input type="checkbox"
                            {{ isset($option_settings['widget_background-color-transparent_i']) && $option_settings['widget_background-color-transparent_i'] == 1 ? 'checked' : '' }}
                            name="widget_background-color-transparent_i" id="widget_background_color_transparent"
                            value="1">
                        <span class="checkmark"></span>
                    </label>
                    <label class="black font-16"
                        for="widget_background_color_transparent">{{ translate('Transparent') }}</label>
                </div>
            </div>
        </div>
    </div>
    {{-- Widgets Background Color Field End --}}

    {{-- Widgets Custom Box Shadow Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-3">
            <label class="font-16 bold black">{{ translate('Box Shadow') }}
            </label>
        </div>
        <div class="col-xl-8 offset-xl-1 row">
            <input type="hidden" name="widget_custom_box-shadow" id="widget_custom_box-shadow"
                value="{{ isset($option_settings['widget_custom_box-shadow']) ? $option_settings['widget_custom_box-shadow'] : '' }}">
            <div class="col-xl-3">
                <label class="col-form-label col-form-label-sm"
                    for="box_shadow_offset_x_i">{{ translate('Offset X') }}</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="icofont-arrow-up"></i>
                        </div>
                    </div>
                    <input type="number" class="form-control form-control-sm" name="box_shadow_offset_x_i"
                        id="box_shadow_offset_x" min="0"
                        value="{{ isset($option_settings['box_shadow_offset_x_i']) ? $option_settings['box_shadow_offset_x_i'] : '0' }}"
                        placeholder="X" onkeyup="boxShadowStyle();">
                </div>
            </div>

            <div class="col-xl-3">
                <label class="col-form-label col-form-label-sm"
                    for="box_shadow_offset_y_i">{{ translate('Offset Y') }}</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="icofont-arrow-up"></i>
                        </div>
                    </div>
                    <input type="number" class="form-control" name="box_shadow_offset_y_i" id="box_shadow_offset_y"
                        min="0"
                        value="{{ isset($option_settings['box_shadow_offset_y_i']) ? $option_settings['box_shadow_offset_y_i'] : '0' }}"
                        placeholder="Y" onkeyup="boxShadowStyle();">
                </div>
            </div>

            <div class="col-xl-3">
                <label class="col-form-label col-form-label-sm"
                    for="box_shadow_blur_radius_i">{{ translate('Blur Radius') }}</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="icofont-adjust"></i>
                        </div>
                    </div>
                    <input type="number" class="form-control" name="box_shadow_blur_radius_i"
                        id="box_shadow_blur_radius" min="0"
                        value="{{ isset($option_settings['box_shadow_blur_radius_i']) ? $option_settings['box_shadow_blur_radius_i'] : '0' }}"
                        pattern="Blur" onkeydown="boxShadowStyle();">
                </div>
            </div>

            <div class="col-xl-3">
                <label class="col-form-label col-form-label-sm"
                    for="box_shadow_spread_radius_i">{{ translate('Spread Radius') }}</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="icofont-bulb-alt"></i>
                        </div>
                    </div>
                    <input type="number" class="form-control" name="box_shadow_spread_radius_i"
                        id="box_shadow_spread_radius" min="0"
                        value="{{ isset($option_settings['box_shadow_spread_radius_i']) ? $option_settings['box_shadow_spread_radius_i'] : '0' }}"
                        pattern="Spread" onkeyup="boxShadowStyle();">
                </div>
            </div>

            <div class="col-xl-3 mt-3">
                <label for="box_shadow_opacity_i">{{ translate('Opcacity .1-1') }}</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="icofont-bulb-alt"></i>
                        </div>
                    </div>
                    <input type="number" class="form-control" name="box_shadow_opacity_i" step="any"
                        id="box_shadow_opacity"
                        value="{{ isset($option_settings['box_shadow_opacity_i']) ? $option_settings['box_shadow_opacity_i'] : '1' }}"
                        pattern="Opacity" onkeyup="boxShadowStyle();">
                </div>
            </div>

            <div class="col-xl-3 mt-2">
                <label class="col-form-label col-form-label-sm"
                    for="box_shadow_u_unit_i">{{ translate('Units') }}</label>
                <select class="form-control select" name="box_shadow_u_unit_i" id="box_shadow_unit"
                    onchange="boxShadowStyle();">
                    <option value="px"
                        {{ isset($option_settings['box_shadow_u_unit_i']) && $option_settings['box_shadow_u_unit_i'] == 'px' ? 'selected' : '' }}>
                        px</option>
                    <option value="em"
                        {{ isset($option_settings['box_shadow_u_unit_i']) && $option_settings['box_shadow_u_unit_i'] == 'em' ? 'selected' : '' }}>
                        em</option>
                    <option value="rem"
                        {{ isset($option_settings['box_shadow_u_unit_i']) && $option_settings['box_shadow_u_unit_i'] == 'rem' ? 'selected' : '' }}>
                        rem</option>
                    <option value="%"
                        {{ isset($option_settings['box_shadow_u_unit_i']) && $option_settings['box_shadow_u_unit_i'] == '%' ? 'selected' : '' }}>
                        %</option>
                </select>
            </div>

            <div class="col-xl-4 mt-2">
                <label class="col-form-label col-form-label-sm"
                    for="box_shadow_color_i">{{ translate('Shadow Color') }}</label>
                <div class="color w-100">
                    <input type="text" class="form-control" name="box_shadow_color_i"
                        value="{{ isset($option_settings['box_shadow_color_i']) ? $option_settings['box_shadow_color_i'] : '' }}">
                    <input type="color" id="box_shadow_color"
                        value="{{ isset($option_settings['box_shadow_color_i']) ? $option_settings['box_shadow_color_i'] : '#fafafa' }}"
                        oninput="boxShadowStyle();">
                </div>
            </div>

            <div class="col-xl-3 mt-2">
                <label class="col-form-label col-form-label-sm"
                    for="box_shadow_type_i">{{ translate('Shadow Type') }}</label>
                <select class="form-control select" name="box_shadow_type_i" id="box_shadow_type"
                    onchange="boxShadowStyle();">
                    <option value="outside"
                        {{ isset($option_settings['box_shadow_type_i']) && $option_settings['box_shadow_type_i'] == 'outside' ? 'selected' : '' }}>
                        Outside</option>
                    <option value="inset"
                        {{ isset($option_settings['box_shadow_type_i']) && $option_settings['box_shadow_type_i'] == 'inset' ? 'selected' : '' }}>
                        Inset</option>
                </select>
            </div>

            <div class="col-xl-10" id="shadow_previewer">
                <div class="shadow-previewer-inner"
                    style="{{ isset($option_settings['widget_custom_box-shadow']) ? 'box-shadow:' . $option_settings['widget_custom_box-shadow'] : '' }}">
                </div>
            </div>
        </div>
    </div>
    {{-- Widgets Custom Box Shadow Field End --}}

    {{-- Widgets Custom Margin Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-3">
            <label class="font-16 bold black">{{ translate('Widget Margin') }}
            </label>
        </div>
        <div class="col-xl-8 offset-xl-1 row">
            <div class="input-group col-xl-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-arrow-up"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="widget_margin_u_margin-top"
                    id="widget_margin_u_margin-top"
                    value="{{ isset($option_settings['widget_margin_u_margin-top']) ? $option_settings['widget_margin_u_margin-top'] : '' }}"
                    placeholder="{{ translate('Top') }}">
            </div>
            <div class="input-group col-xl-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-arrow-right"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="widget_margin_u_margin-right"
                    id="widget_margin_u_margin-right"
                    value="{{ isset($option_settings['widget_margin_u_margin-right']) ? $option_settings['widget_margin_u_margin-right'] : '' }}"
                    placeholder="{{ translate('Right') }}">
            </div>
            <div class="input-group col-xl-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-arrow-down"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="widget_margin_u_margin-bottom"
                    id="widget_margin_u_margin-bottom"
                    value="{{ isset($option_settings['widget_margin_u_margin-bottom']) ? $option_settings['widget_margin_u_margin-bottom'] : '' }}"
                    placeholder="{{ translate('Bottom') }}">
            </div>
            <div class="input-group col-xl-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-arrow-left"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="widget_margin_u_margin-left"
                    id="widget_margin_u_margin-left"
                    value="{{ isset($option_settings['widget_margin_u_margin-left']) ? $option_settings['widget_margin_u_margin-left'] : '' }}"
                    placeholder="{{ translate('Left') }}">
            </div>
            <div class="input-group col-xl-3 mt-2">
                <select class="form-control select" name="widget_margin_unit_i" id="widget_margin_unit_i">
                    <option value="px"
                        {{ isset($option_settings['widget_margin_unit_i']) && $option_settings['widget_margin_unit_i'] == 'px' ? 'selected' : '' }}>
                        px</option>
                    <option value="em"
                        {{ isset($option_settings['widget_margin_unit_i']) && $option_settings['widget_margin_unit_i'] == 'em' ? 'selected' : '' }}>
                        em</option>
                </select>
            </div>
        </div>
    </div>
    {{-- Widgets Custom Margin Field Start --}}

    {{-- Widgets Custom Padding Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-3">
            <label class="font-16 bold black">{{ translate('Widget Padding') }}
            </label>
        </div>
        <div class="col-xl-8 offset-xl-1 row">
            <div class="input-group col-xl-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-arrow-up"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="widget_padding_u_padding-top"
                    id="widget_padding_u_padding_u_padding-top"
                    value="{{ isset($option_settings['widget_padding_u_padding-top']) ? $option_settings['widget_padding_u_padding-top'] : '' }}"
                    placeholder="{{ translate('Top') }}">
            </div>
            <div class="input-group col-xl-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-arrow-right"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="widget_padding_u_padding-right"
                    id="widget_padding_u_padding-right"
                    value="{{ isset($option_settings['widget_padding_u_padding-right']) ? $option_settings['widget_padding_u_padding-right'] : '' }}"
                    placeholder="{{ translate('Right') }}">
            </div>
            <div class="input-group col-xl-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-arrow-down"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="widget_padding_u_padding-bottom"
                    id="widget_padding_u_padding-bottom"
                    value="{{ isset($option_settings['widget_padding_u_padding-bottom']) ? $option_settings['widget_padding_u_padding-bottom'] : '' }}"
                    placeholder="{{ translate('Bottom') }}">
            </div>
            <div class="input-group col-xl-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-arrow-left"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="widget_padding_u_padding-left"
                    id="widget_padding_u_padding-left"
                    value="{{ isset($option_settings['widget_padding_u_padding-left']) ? $option_settings['widget_padding_u_padding-left'] : '' }}"
                    placeholder="{{ translate('Left') }}">
            </div>
            <div class="input-group col-xl-3 mt-2">
                <select class="form-control select" name="widget_padding_unit_i" id="widget_padding_unit_i">
                    <option value="px"
                        {{ isset($option_settings['widget_padding_unit_i']) && $option_settings['widget_padding_unit_i'] == 'px' ? 'selected' : '' }}>
                        px</option>
                    <option value="em"
                        {{ isset($option_settings['widget_padding_unit_i']) && $option_settings['widget_padding_unit_i'] == 'em' ? 'selected' : '' }}>
                        em</option>
                </select>
            </div>
        </div>
    </div>
    {{-- Widgets Custom Padding Field Start --}}

    {{-- Widgets Custom Border Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-3">
            <label class="font-16 bold black">{{ translate('Widget Border') }}
            </label>
        </div>
        <div class="col-xl-8 offset-xl-1 row">
            <input type="hidden" name="widget_border_unit_i" value="px">
            <div class="input-group col-xl-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-arrow-up"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="widget_border_u_border-top"
                    id="widget_border_u_border-top"
                    value="{{ isset($option_settings['widget_border_u_border-top']) ? $option_settings['widget_border_u_border-top'] : '' }}"
                    placeholder="{{ translate('Top') }}">
            </div>
            <div class="input-group col-xl-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-arrow-right"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="widget_border_u_border-right"
                    id="widget_border_u_border-right"
                    value="{{ isset($option_settings['widget_border_u_border-right']) ? $option_settings['widget_border_u_border-right'] : '' }}"
                    placeholder="{{ translate('Right') }}">
            </div>
            <div class="input-group col-xl-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-arrow-down"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="widget_border_u_border-bottom"
                    id="widget_border_u_border-bottom"
                    value="{{ isset($option_settings['widget_border_u_border-bottom']) ? $option_settings['widget_border_u_border-bottom'] : '' }}"
                    placeholder="{{ translate('Bottom') }}">
            </div>
            <div class="input-group col-xl-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-arrow-left"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="widget_border_u_border-left"
                    id="widget_border_u_border-left"
                    value="{{ isset($option_settings['widget_border_u_border-left']) ? $option_settings['widget_border_u_border-left'] : '' }}"
                    placeholder="{{ translate('Left') }}">
            </div>
            <div class="input-group col-xl-3 mt-2">
                <select class="form-control select" name="widget_border_border-style"
                    id="widget_border_border-style">
                    <option value="solid"
                        {{ isset($option_settings['widget_border_border-style']) && $option_settings['widget_border_border-style'] == 'solid' ? 'selected' : '' }}>
                        Solid</option>
                    <option value="dashed"
                        {{ isset($option_settings['widget_border_border-style']) && $option_settings['widget_border_border-style'] == 'dashed' ? 'selected' : '' }}>
                        Dashed</option>
                    <option
                        value="dotted"{{ isset($option_settings['widget_border_border-style']) && $option_settings['widget_border_border-style'] == 'dotted' ? 'selected' : '' }}>
                        Dotted</option>
                    <option value="double"
                        {{ isset($option_settings['widget_border_border-style']) && $option_settings['widget_border_border-style'] == 'double' ? 'selected' : '' }}>
                        Double</option>
                    <option value="none"
                        {{ isset($option_settings['widget_border_border-style']) && $option_settings['widget_border_border-style'] == 'none' ? 'selected' : '' }}>
                        None</option>
                </select>
            </div>
            <div class="input-group col-xl-5 mt-2">
                <div class="color">
                    <input type="text" class="form-control" name="widget_border_border-color"
                        value="{{ isset($option_settings['widget_border_border-color']) ? $option_settings['widget_border_border-color'] : '' }}">
                    <input type="color" class="" id="widget_border_border-color"
                        value="{{ isset($option_settings['widget_border_border-color']) ? $option_settings['widget_border_border-color'] : '#fafafa' }}">
                    <label for="widget_border_border-color">{{ translate('Select Color') }}</label>
                </div>
            </div>
        </div>
    </div>
    {{-- Widgets Custom Border Field End --}}

    {{-- Widget Title Tag Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-3">
            <label class="font-16 bold black">{{ translate('Widget Title Tag') }}
            </label>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <select name="widget_title_tag_s" id="widget_title_tag_s" class="form-control select">
                <option value="h1"
                    {{ isset($option_settings['widget_title_tag_s']) && $option_settings['widget_title_tag_s'] == 'h1' ? 'selected' : '' }}>
                    H1</option>
                <option value="h2"
                    {{ isset($option_settings['widget_title_tag_s']) && $option_settings['widget_title_tag_s'] == 'h2' ? 'selected' : '' }}>
                    H2</option>
                <option value="h3"
                    {{ isset($option_settings['widget_title_tag_s']) && $option_settings['widget_title_tag_s'] == 'h3' ? 'selected' : '' }}>
                    H3</option>
                <option value="h4"
                    {{ isset($option_settings['widget_title_tag_s']) && $option_settings['widget_title_tag_s'] == 'h4' ? 'selected' : '' }}>
                    H4</option>
                <option value="h5"
                    {{ isset($option_settings['widget_title_tag_s']) && $option_settings['widget_title_tag_s'] == 'h5' ? 'selected' : '' }}>
                    H5</option>
                <option value="h6"
                    {{ isset($option_settings['widget_title_tag_s']) && $option_settings['widget_title_tag_s'] == 'h6' ? 'selected' : '' }}>
                    H6</option>
            </select>
        </div>
    </div>
    {{-- Widget Title Tag Field End --}}

    {{-- Widget Title Typography Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-3">
            <label for="widgets_title_typography"
                class="font-16 bold black">{{ translate('Widget Title Typography') }}
            </label>
        </div>
        <div class="col-xl-8 offset-xl-1">
            <input type="hidden" name="widget_title_typography_google_link_s"
                id="widget_title_typography_google_link_s"
                value="{{ isset($option_settings['widget_title_typography_google_link_s']) ? $option_settings['widget_title_typography_google_link_s'] : '' }}">
            <input type="hidden" name="widget_title_typography_css_i" id="widget_title_typography_css"
                value="{{ isset($option_settings['widget_title_typography_css_i']) ? $option_settings['widget_title_typography_css_i'] : '' }}">
            <input type="hidden" name="widget_title_font_unit_i" value="px">
            <div class="row">
                <div class="col-xl-6">
                    <div class="form-group">
                        <label>{{ translate('Font Family') }}</label>
                        <select name="widget_title_font_font-family" class="form-control select font_family"
                            id="widget_title_font_family" data-section="widget_title">
                            <option value=""
                                {{ isset($option_settings['widget_title_font_font-family']) ? '' : 'selected' }}>
                                {{ translate('Select  Fonts') }}</option>
                            <optgroup label="{{ translate('Custom Fonts') }}">
                                <option value="custom-font-1,sans-serif"
                                    {{ isset($option_settings['widget_title_font_font-family']) && $option_settings['widget_title_font_font-family'] == 'custom-font-1,sans-serif' ? 'selected' : '' }}
                                    data-subsets="" data-variations="">
                                    {{ translate('Custom Font 1') }}</option>

                                <option value="custom-font-2,sans-serif"
                                    {{ isset($option_settings['widget_title_font_font-family']) && $option_settings['widget_title_font_font-family'] == 'custom-font-2,sans-serif' ? 'selected' : '' }}
                                    data-subsets="" data-variations="">
                                    {{ translate('Custom Font 2') }}</option>
                            </optgroup>
                            <optgroup label="{{ translate('Google Web Fonts') }}">
                                @foreach ($fonts as $font)
                                    <option value="{{ $font['family'] . ',sans-serif' }}"
                                        {{ isset($option_settings['widget_title_font_font-family']) && $option_settings['widget_title_font_font-family'] == $font['family'] . ',sans-serif' ? 'selected' : '' }}
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
                        <input type="hidden" name="widget_title_font_font-style" id="widget_title_font_style"
                            value="{{ isset($option_settings['widget_title_font_font-style']) ? $option_settings['widget_title_font_font-style'] : '' }}">
                        <input type="hidden" name="widget_title_font_font-weight" id="widget_title_font_weight"
                            value="{{ isset($option_settings['widget_title_font_font-weight']) ? $option_settings['widget_title_font_font-weight'] : '' }}">

                        <select name="widget_title_font_weight_style_i" class="form-control select"
                            id="widget_title_font_weight_style_i"
                            data-value="{{ isset($option_settings['widget_title_font_weight_style_i']) ? $option_settings['widget_title_font_weight_style_i'] : null }}"
                            onchange="createUrl('widget_title')">
                            <option value=""
                                {{ isset($option_settings['widget_title_font_weight_style_i']) ? '' : 'selected' }}>
                                {{ translate('Select Weight & Style') }}</option>
                            <option value="400"
                                {{ isset($option_settings['widget_title_font_weight_style_i']) && $option_settings['widget_title_font_weight_style_i'] == '400' ? 'selected' : '' }}>
                                Normal 400</option>
                            <option value="700"
                                {{ isset($option_settings['widget_title_font_weight_style_i']) && $option_settings['widget_title_font_weight_style_i'] == '700' ? 'selected' : '' }}>
                                Bold 700</option>
                            <option value="400italic"
                                {{ isset($option_settings['widget_title_font_weight_style_i']) && $option_settings['widget_title_font_weight_style_i'] == '400italic' ? 'selected' : '' }}>
                                Normal 400 Italic</option>
                            <option value="700italic"
                                {{ isset($option_settings['widget_title_font_weight_style_i']) && $option_settings['widget_title_font_weight_style_i'] == '700italic' ? 'selected' : '' }}>
                                Bold 700 Italic</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="form-group">
                        <label>{{ translate('Font Subsets') }}</label>
                        <select name="widget_title_font_font-subsets_i" class="form-control select"
                            id="widget_title_font_subsets"
                            data-value="{{ isset($option_settings['widget_title_font_font-subsets_i']) ? $option_settings['widget_title_font_font-subsets_i'] : null }}"
                            onchange="createUrl('widget_title')">
                            <option value=""
                                {{ isset($option_settings['widget_title_font_font-subsets_i']) ? '' : 'selected' }}>
                                {{ translate('Select Font Subsets') }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="form-group">
                        <label>{{ translate('Text Align') }}</label>
                        <select name="widget_title_font_text-align" class="form-control select"
                            id="widget_title_text_align" onchange="createFontCss('widget_title')">
                            <option value="" disabled
                                {{ isset($option_settings['widget_title_font_text-align']) ? '' : 'selected' }}>
                                {{ translate('Text Align') }}</option>
                            <option value="inherit"
                                {{ isset($option_settings['widget_title_font_text-align']) && $option_settings['widget_title_font_text-align'] == 'inherit' ? 'selected' : '' }}>
                                Inherit</option>
                            <option value="left"
                                {{ isset($option_settings['widget_title_font_text-align']) && $option_settings['widget_title_font_text-align'] == 'left' ? 'selected' : '' }}>
                                Left</option>
                            <option value="right"
                                {{ isset($option_settings['widget_title_font_text-align']) && $option_settings['widget_title_font_text-align'] == 'right' ? 'selected' : '' }}>
                                Right</option>
                            <option value="center"
                                {{ isset($option_settings['widget_title_font_text-align']) && $option_settings['widget_title_font_text-align'] == 'center' ? 'selected' : '' }}>
                                Center</option>
                            <option value="justify"
                                {{ isset($option_settings['widget_title_font_text-align']) && $option_settings['widget_title_font_text-align'] == 'justify' ? 'selected' : '' }}>
                                Justify</option>
                            <option value="initial"
                                {{ isset($option_settings['widget_title_font_text-align']) && $option_settings['widget_title_font_text-align'] == 'initial' ? 'selected' : '' }}>
                                Initial</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="form-group">
                        <label>{{ translate('Text Transform') }}</label>
                        <select name="widget_title_font_text-transform" class="form-control select"
                            id="widget_title_text_transform" onchange="createFontCss('widget_title')">
                            <option value="" disabled
                                {{ isset($option_settings['widget_title_font_text-transform']) ? '' : 'selected' }}>
                                {{ translate('Text Transform') }}</option>
                            <option value="none"
                                {{ isset($option_settings['widget_title_font_text-transform']) && $option_settings['widget_title_font_text-transform'] == 'none' ? 'selected' : '' }}>
                                None</option>
                            <option value="capitalize"
                                {{ isset($option_settings['widget_title_font_text-transform']) && $option_settings['widget_title_font_text-transform'] == 'capitalize' ? 'selected' : '' }}>
                                Capitalize</option>
                            <option value="uppercase"
                                {{ isset($option_settings['widget_title_font_text-transform']) && $option_settings['widget_title_font_text-transform'] == 'uppercase' ? 'selected' : '' }}>
                                Uppercase</option>
                            <option value="lowercase"
                                {{ isset($option_settings['widget_title_font_text-transform']) && $option_settings['widget_title_font_text-transform'] == 'lowercase' ? 'selected' : '' }}>
                                Lowercase</option>
                            <option value="initial"
                                {{ isset($option_settings['widget_title_font_text-transform']) && $option_settings['widget_title_font_text-transform'] == 'initial' ? 'selected' : '' }}>
                                Initial</option>
                            <option value="inherit"
                                {{ isset($option_settings['widget_title_font_text-transform']) && $option_settings['widget_title_font_text-transform'] == 'inherit' ? 'selected' : '' }}>
                                Inherit</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-6 row">
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="widget_title_font_u_font-size">{{ translate('Font Size') }}</label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="widget_title_font_u_font-size"
                                    id="widget_title_font_size" placeholder="{{ translate('Size') }}"
                                    value="{{ isset($option_settings['widget_title_font_u_font-size']) ? $option_settings['widget_title_font_u_font-size'] : '' }}"
                                    onkeyup="createFontCss('widget_title')">
                                <div class="input-group-append">
                                    <div class="input-group-text">px</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="widget_title_font_u_line-height">{{ translate('Line Height') }}</label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="widget_title_font_u_line-height"
                                    id="widget_title_line_height" placeholder="{{ translate('Height') }}"
                                    value="{{ isset($option_settings['widget_title_font_u_line-height']) ? $option_settings['widget_title_font_u_line-height'] : '' }}"
                                    onkeyup="createFontCss('widget_title')">
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
                            <label for="widget_title_font_u_word-spacing">{{ translate('Word Spacing') }}</label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="widget_title_font_u_word-spacing"
                                    id="widget_title_word_spacing" placeholder="{{ translate('Word Spacing') }}"
                                    value="{{ isset($option_settings['widget_title_font_u_word-spacing']) ? $option_settings['widget_title_font_u_word-spacing'] : '' }}"
                                    onkeyup="createFontCss('widget_title')">
                                <div class="input-group-append">
                                    <div class="input-group-text">px</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4">
                        <div class="form-group">
                            <label for="widget_title_font_u_letter-spacing">{{ translate('Letter Spacing') }}</label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="widget_title_font_u_letter-spacing"
                                    id="widget_title_letter_spacing" placeholder="{{ translate('Letter Spacing') }}"
                                    value="{{ isset($option_settings['widget_title_font_u_letter-spacing']) ? $option_settings['widget_title_font_u_letter-spacing'] : '' }}"
                                    onkeyup="createFontCss('widget_title')">
                                <div class="input-group-append">
                                    <div class="input-group-text">px</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4">
                        <label for="widget_title_font_color">{{ translate('Select Color') }}</label>
                        <div class="color w-100">
                            <input type="text" class="form-control" name="widget_title_font_color"
                                value="{{ isset($option_settings['widget_title_font_color']) ? $option_settings['widget_title_font_color'] : '' }}">
                            <input type="color" class="" id="widget_title_font_color"
                                value="{{ isset($option_settings['widget_title_font_color']) ? $option_settings['widget_title_font_color'] : '#fafafa' }}"
                                oninput="createFontCss('widget_title')">
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-4 border p-4 typography_preview" id="widget_title_typography_preview">
                {{ translate('The Quick Brown Fox Jumps Over The Lazy Dog') }}
            </div>
        </div>
    </div>
    {{-- Widget Title Typography Field End --}}

    {{-- Widget Title Margin Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-3">
            <label class="font-16 bold black">{{ translate('Widget Title Margin') }}
            </label>
        </div>
        <div class="col-xl-8 offset-xl-1 row">
            <div class="input-group col-xl-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-arrow-up"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="widget_title_margin_u_margin-top"
                    id="widget_title_margin_u_margin-top"
                    value="{{ isset($option_settings['widget_title_margin_u_margin-top']) ? $option_settings['widget_title_margin_u_margin-top'] : '' }}"
                    placeholder="{{ translate('Top') }}">
            </div>
            <div class="input-group col-xl-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-arrow-right"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="widget_title_margin_u_margin-right"
                    id="widget_title_margin_u_margin-right"
                    value="{{ isset($option_settings['widget_title_margin_u_margin-right']) ? $option_settings['widget_title_margin_u_margin-right'] : '' }}"
                    placeholder="{{ translate('Right') }}">
            </div>
            <div class="input-group col-xl-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-arrow-down"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="widget_title_margin_u_margin-bottom"
                    id="widget_title_margin_u_margin-bottom"
                    value="{{ isset($option_settings['widget_title_margin_u_margin-bottom']) ? $option_settings['widget_title_margin_u_margin-bottom'] : '' }}"
                    placeholder="{{ translate('Bottom') }}">
            </div>
            <div class="input-group col-xl-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-arrow-left"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="widget_title_margin_u_margin-left"
                    id="widget_title_margin_u_margin-left"
                    value="{{ isset($option_settings['widget_title_margin_u_margin-left']) ? $option_settings['widget_title_margin_u_margin-left'] : '' }}"
                    placeholder="{{ translate('Left') }}">
            </div>
            <div class="input-group col-xl-3 mt-2">
                <select class="form-control select" name="widget_title_margin_unit_i"
                    id="widget_title_margin_unit_i">
                    <option value="px"
                        {{ isset($option_settings['widget_title_margin_unit_i']) && $option_settings['widget_title_margin_unit_i'] == 'px' ? 'selected' : '' }}>
                        px</option>
                    <option value="em"
                        {{ isset($option_settings['widget_title_margin_unit_i']) && $option_settings['widget_title_margin_unit_i'] == 'em' ? 'selected' : '' }}>
                        em</option>
                </select>
            </div>
        </div>
    </div>
    {{-- Widget Title Margin Field End --}}

    {{-- Widget Title Padding Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-3">
            <label class="font-16 bold black">{{ translate('Widget Title Padding') }}
            </label>
        </div>
        <div class="col-xl-8 offset-xl-1 row">
            <div class="input-group col-xl-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-arrow-up"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="widget_title_padding_u_padding-top"
                    id="widget_title_padding_u_padding-top"
                    value="{{ isset($option_settings['widget_title_padding_u_padding-top']) ? $option_settings['widget_title_padding_u_padding-top'] : '' }}"
                    placeholder="{{ translate('Top') }}">
            </div>
            <div class="input-group col-xl-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-arrow-right"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="widget_title_padding_u_padding-right"
                    id="widget_title_padding_u_padding-right"
                    value="{{ isset($option_settings['widget_title_padding_u_padding-right']) ? $option_settings['widget_title_padding_u_padding-right'] : '' }}"
                    placeholder="{{ translate('Right') }}">
            </div>
            <div class="input-group col-xl-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-arrow-down"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="widget_title_padding_u_padding-bottom"
                    id="widget_title_padding_u_padding-bottom"
                    value="{{ isset($option_settings['widget_title_padding_u_padding-bottom']) ? $option_settings['widget_title_padding_u_padding-bottom'] : '' }}"
                    placeholder="{{ translate('Bottom') }}">
            </div>
            <div class="input-group col-xl-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-arrow-left"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="widget_title_padding_u_padding-left"
                    id="widget_title_padding_u_padding-left"
                    value="{{ isset($option_settings['widget_title_padding_u_padding-left']) ? $option_settings['widget_title_padding_u_padding-left'] : '' }}"
                    placeholder="{{ translate('Left') }}">
            </div>
            <div class="input-group col-xl-3 mt-2">
                <select class="form-control select" name="widget_title_padding_unit_i"
                    id="widget_title_padding_unit_i">
                    <option value="px"
                        {{ isset($option_settings['widget_title_padding_unit_i']) && $option_settings['widget_title_padding_unit_i'] == 'px' ? 'selected' : '' }}>
                        px</option>
                    <option value="em"
                        {{ isset($option_settings['widget_title_padding_unit_i']) && $option_settings['widget_title_padding_unit_i'] == 'em' ? 'selected' : '' }}>
                        em</option>
                </select>
            </div>
        </div>
    </div>
    {{-- Widget Title Padding Field End --}}

    {{-- Widget Title Color Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-3">
            <label class="font-16 bold black">{{ translate('Widget Title Color') }}
            </label>
            <span class="d-block">{{ translate('Set Widget Title Color.') }}</span>
        </div>
        <div class="col-xl-8 offset-xl-1">
            <div class="row ml-2">
                <div class="color">
                    <input type="text" class="form-control" name="widget_title_color"
                        value="{{ isset($option_settings['widget_title_color']) ? $option_settings['widget_title_color'] : '' }}">
                    <input type="color" class="" id="widget_title_color"
                        value="{{ isset($option_settings['widget_title_color']) ? $option_settings['widget_title_color'] : '#fafafa' }}">
                    <label for="widget_title_color">{{ translate('Select Color') }}</label>
                </div>
                <div class="d-flex align-items-center">
                    <label class="custom-checkbox position-relative ml-2 mr-1">
                        <input type="hidden" name="widget_title_color-transparent_i" value="0">
                        <input type="checkbox"
                            {{ isset($option_settings['widget_title_color-transparent_i']) && $option_settings['widget_title_color-transparent_i'] == 1 ? 'checked' : '' }}
                            name="widget_title_color-transparent_i" id="widget_title_color-transparent_i"
                            value="1">
                        <span class="checkmark"></span>
                    </label>
                    <label class="black font-16"
                        for="widget_title_color-transparent_i">{{ translate('Transparent') }}</label>
                </div>
            </div>
        </div>
    </div>
    {{-- Widget Title Color Field End --}}

    {{-- Widget Text Color Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-3">
            <label class="font-16 bold black">{{ translate('Widget Text Color') }}
            </label>
            <span class="d-block">{{ translate('Set Widget Text Color.') }}</span>
        </div>
        <div class="col-xl-8 offset-xl-1">
            <div class="row ml-2">
                <div class="color">
                    <input type="text" class="form-control" name="widget_text_color"
                        value="{{ isset($option_settings['widget_text_color']) ? $option_settings['widget_text_color'] : '' }}">
                    <input type="color" class="" id="widget_text_color"
                        value="{{ isset($option_settings['widget_text_color']) ? $option_settings['widget_text_color'] : '#fafafa' }}">
                    <label for="widget_text_color">{{ translate('Select Color') }}</label>
                </div>
                <div class="d-flex align-items-center">
                    <label class="custom-checkbox position-relative ml-2 mr-1">
                        <input type="hidden" name="widget_text_color-transparent_i" value="0">
                        <input type="checkbox"
                            {{ isset($option_settings['widget_text_color-transparent_i']) && $option_settings['widget_text_color-transparent_i'] == 1 ? 'checked' : '' }}
                            name="widget_text_color-transparent_i" id="widget_text_color-transparent_i"
                            value="1">
                        <span class="checkmark"></span>
                    </label>
                    <label class="black font-16"
                        for="widget_text_color-transparent_i">{{ translate('Transparent') }}</label>
                </div>
            </div>
        </div>
    </div>
    {{-- Widget Text Color Field End --}}

    {{-- Widget Anchor Color Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-3">
            <label class="font-16 bold black">{{ translate('Widget Anchor Color') }}
            </label>
            <span class="d-block">{{ translate('Set Widget Anchor Color.') }}</span>
        </div>
        <div class="col-xl-8 offset-xl-1">
            <div class="row ml-2">
                <div class="color">
                    <input type="text" class="form-control" name="widget_anchor_color"
                        value="{{ isset($option_settings['widget_anchor_color']) ? $option_settings['widget_anchor_color'] : '' }}">
                    <input type="color" class="" id="widget_anchor_color"
                        value="{{ isset($option_settings['widget_anchor_color']) ? $option_settings['widget_anchor_color'] : '#fafafa' }}">
                    <label for="widget_anchor_color">{{ translate('Select Color') }}</label>
                </div>
                <div class="d-flex align-items-center">
                    <label class="custom-checkbox position-relative ml-2 mr-1">
                        <input type="hidden" name="widget_anchor_color-transparent_i" value="0">
                        <input type="checkbox"
                            {{ isset($option_settings['widget_anchor_color-transparent_i']) && $option_settings['widget_anchor_color-transparent_i'] == 1 ? 'checked' : '' }}
                            name="widget_anchor_color-transparent_i" id="widget_anchor_color-transparent_i"
                            value="1">
                        <span class="checkmark"></span>
                    </label>
                    <label class="black font-16"
                        for="widget_anchor_color-transparent_i">{{ translate('Transparent') }}</label>
                </div>
            </div>
        </div>
    </div>
    {{-- Widget Anchor Color Field End --}}

    {{-- Widget Hover Color Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-3">
            <label class="font-16 bold black">{{ translate('Widget Anchor Hover Color') }}
            </label>
            <span class="d-block">{{ translate('Set Widget Anchor Hover Color.') }}</span>
        </div>
        <div class="col-xl-8 offset-xl-1">
            <div class="row ml-2">
                <div class="color">
                    <input type="text" class="form-control" name="widget_anchor_hover_color"
                        value="{{ isset($option_settings['widget_anchor_hover_color']) ? $option_settings['widget_anchor_hover_color'] : '' }}">
                    <input type="color" class="" id="widget_anchor_hover_color"
                        value="{{ isset($option_settings['widget_anchor_hover_color']) ? $option_settings['widget_anchor_hover_color'] : '#fafafa' }}">
                    <label for="widget_anchor_hover_color">{{ translate('Select Color') }}</label>
                </div>
                <div class="d-flex align-items-center">
                    <label class="custom-checkbox position-relative ml-2 mr-1">
                        <input type="hidden" name="widget_anchor_hover_color-transparent_i" value="0">
                        <input type="checkbox"
                            {{ isset($option_settings['widget_anchor_hover_color-transparent_i']) && $option_settings['widget_anchor_hover_color-transparent_i'] == 1 ? 'checked' : '' }}
                            name="widget_anchor_hover_color-transparent_i"
                            id="widget_anchor_hover_color-transparent_i" value="1">
                        <span class="checkmark"></span>
                    </label>
                    <label class="black font-16"
                        for="widget_anchor_hover_color-transparent_i">{{ translate('Transparent') }}</label>
                </div>
            </div>
        </div>
    </div>
    {{-- Widget Hover Color Field End --}}
</div>
{{-- Custom Sidebar Style Switch On Field End --}}
