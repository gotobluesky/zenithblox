{{-- Header Logo Header --}}
<h3 class="black mb-3">{{ translate('Header Logo') }}</h3>
<input type="hidden" name="option_name" value="header_logo">

{{-- Custom Header Style Switch Field Start --}}
<div class="form-group row py-4 border-bottom">
    <div class="col-xl-4">
        <label class="font-16 bold black">{{ translate('Custom Header Style') }}
        </label>
        <span class="d-block">{{ translate('custom set header logo style.') }}</span>
    </div>
    <div class="col-xl-6 offset-xl-1">
        <label class="switch success">
            <input type="hidden" name="custom_header_style" value="0">
            <input type="checkbox"
                {{ isset($option_settings['custom_header_style']) && $option_settings['custom_header_style'] == 1 ? 'checked' : '' }}
                name="custom_header_style" id="custom_header_style" value="1">
            <span class="control" id="custom_header_style_switch">
                <span class="switch-off">{{ translate('Disable') }}</span>
                <span class="switch-on">{{ translate('Enable') }}</span>
            </span>
        </label>
    </div>
</div>
{{-- Custom Header Style Switch Field End --}}

{{-- Custom Header Style Swutch On Field Start --}}
<div id="custom_header_style_switch_on_field">
    {{-- Header Logo Dimention Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4">
            <label for="logo_dimension" class="font-16 bold black">{{ translate('Logo Dimensions (Width/Height).') }}
            </label>
            <span class="d-block">{{ translate('Set logo dimensions to choose width, height, and unit.') }}</span>
        </div>
        <div class="col-xl-7 offset-xl-1 row">
            <div class="input-group col-xl-5">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-resize"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="logo_dimension_width" id="logo_dimension_width"
                    placeholder="{{ translate('Width') }}"
                    value="{{ isset($option_settings['logo_dimension_width']) ? $option_settings['logo_dimension_width'] : '' }}">
            </div>
            <div class="input-group col-xl-5">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-resize"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="logo_dimension_height" id="logo_dimension_height"
                    placeholder="{{ translate('Height') }}"
                    value="{{ isset($option_settings['logo_dimension_height']) ? $option_settings['logo_dimension_height'] : '' }}">
            </div>
            <div class="input-group col-xl-5 mt-3">
                <select class="form-control select" name="logo_dimension_unit" id="logo_dimension_unit">
                    <option value="px"
                        {{ isset($option_settings['logo_dimension_height']) && $option_settings['logo_dimension_height'] == 'px' ? 'selected' : '' }}>
                        px</option>
                </select>
            </div>
        </div>
    </div>
    {{-- Header Logo Dimention Field End --}}

    {{-- Header Logo Margin Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4">
            <label for="logo_margin" class="font-16 bold black">{{ translate('Logo Top and Bottom Margin.') }}
            </label>
            <span class="d-block">{{ translate('Set logo top and bottom margin.') }}</span>
        </div>
        <div class="col-xl-7 offset-xl-1 row">
            <div class="input-group col-xl-5">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-arrow-up"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="logo_margin_top" id="logo_margin_top"
                    placeholder="{{ translate('Top') }}"
                    value="{{ isset($option_settings['logo_margin_top']) ? $option_settings['logo_margin_top'] : '' }}">
            </div>
            <div class="input-group col-xl-5">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-arrow-down"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="logo_margin_bottom" id="logo_margin_bottom"
                    placeholder="{{ translate('Bottom') }}"
                    value="{{ isset($option_settings['logo_margin_bottom']) ? $option_settings['logo_margin_bottom'] : '' }}">
            </div>
            <div class="input-group col-xl-5 mt-3">
                <select class="form-control select" name="logo_margin_unit" id="logo_margin_unit">
                    <option value="px"
                        {{ isset($option_settings['logo_margin_unit']) && $option_settings['logo_margin_unit'] == 'px' ? 'selected' : '' }}>
                        px</option>
                </select>
            </div>
        </div>
    </div>
    {{-- Header Logo Margin Field End --}}

    {{-- Sticky Logo Dimention Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4">
            <label for="menu_color"
                class="font-16 bold black">{{ translate('Sticky Logo Dimensions (Width/Height).') }}
            </label>
            <span
                class="d-block">{{ translate('Set Sticky logo dimensions to choose width, height, and unit.') }}</span>
        </div>
        <div class="col-xl-7 offset-xl-1 row">
            <div class="input-group col-xl-5">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-resize"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="sticky_logo_dimension_width"
                    id="sticky_logo_dimension_width" placeholder="{{ translate('Width') }}"
                    value="{{ isset($option_settings['sticky_logo_dimension_width']) ? $option_settings['sticky_logo_dimension_width'] : '' }}">
            </div>
            <div class="input-group col-xl-5">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-resize"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="sticky_logo_dimension_height"
                    id="sticky_logo_dimension_height" placeholder="{{ translate('Height') }}"
                    value="{{ isset($option_settings['sticky_logo_dimension_height']) ? $option_settings['sticky_logo_dimension_height'] : '' }}">
            </div>
            <div class="input-group col-xl-5 mt-3">
                <select class="form-control select" name="sticky_logo_dimension_unit"
                    id="sticky_logo_dimension_unit">
                    <option value="px"
                        {{ isset($option_settings['sticky_logo_dimension_unit']) && $option_settings['sticky_logo_dimension_unit'] == 'px' ? 'selected' : '' }}>
                        px
                    </option>
                </select>
            </div>
        </div>
    </div>
    {{-- Sticky Logo Dimention Field End --}}

    {{-- Sticky Logo Margin Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4">
            <label for="menu_color" class="font-16 bold black">{{ translate('Sticky Logo Top and Bottom Margin.') }}
            </label>
            <span class="d-block">{{ translate('Set Sticky logo top and bottom margin.') }}</span>
        </div>
        <div class="col-xl-7 offset-xl-1 row">
            <div class="input-group col-xl-5">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-arrow-up"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="sticky_logo_margin_top" id="sticky_logo_margin_top"
                    placeholder="{{ translate('Top') }}"
                    value="{{ isset($option_settings['sticky_logo_margin_top']) ? $option_settings['sticky_logo_margin_top'] : '' }}">
            </div>
            <div class="input-group col-xl-5">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-arrow-down"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="sticky_logo_margin_bottom"
                    id="sticky_logo_margin_bottom" placeholder="{{ translate('Bottom') }}"
                    value="{{ isset($option_settings['sticky_logo_margin_bottom']) ? $option_settings['sticky_logo_margin_bottom'] : '' }}">
            </div>
            <div class="input-group col-xl-5 mt-3">
                <select class="form-control select" name="sticky_logo_margin_unit" id="sticky_logo_margin_unit">
                    <option value="px"
                        {{ isset($option_settings['sticky_logo_margin_unit']) && $option_settings['sticky_logo_margin_unit'] == 'px' ? 'selected' : '' }}>
                        px
                    </option>
                </select>
            </div>
        </div>
    </div>
    {{-- Sticky Logo Margin Field Start --}}
</div>
{{-- Custom Header Style Swutch On Field End --}}
