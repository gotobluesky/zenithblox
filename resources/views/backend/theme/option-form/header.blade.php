{{-- Header Option Header --}}
<h3 class="black mb-3">{{ translate('Header') }}</h3>
<input type="hidden" name="option_name" value="header">

{{-- Header Background Color Field Start --}}
<div class="form-group row py-4 border-bottom">
    <div class="col-xl-4">
        <label class="font-16 bold black">{{ translate('Header Background Color') }}
        </label>
        <span class="d-block">{{ translate('Set Header Background Color.') }}</span>
    </div>
    <div class="col-xl-6 offset-xl-1">
        <div class="row ml-2">
            <div class="color">
                <input type="text" class="form-control" name="header_bg_color"
                value="{{ isset($option_settings['header_bg_color']) ? $option_settings['header_bg_color']:'' }}">

                <input type="color" class="" id="header_bg_color"
                    value="{{ isset($option_settings['header_bg_color']) ? $option_settings['header_bg_color']:'#fafafa' }}">

                <label for="header_bg_color">{{ translate('Select Color') }}</label>
            </div>
            <div class="d-flex align-items-center">
                <label class="custom-checkbox position-relative ml-2 mr-1">
                    <input type="hidden" name="header_bg_color_transparent" value="0">
                    <input type="checkbox"
                        {{ isset($option_settings['header_bg_color_transparent']) && $option_settings['header_bg_color_transparent'] == 1 ? 'checked' : '' }}
                        name="header_bg_color_transparent" id="header_bg_color_transparent" value="1">
                    <span class="checkmark"></span>
                </label>
                <label class="black font-16"
                    for="header_bg_color_transparent">{{ translate('Transparent') }}</label>
            </div>
        </div>
    </div>
</div>
{{-- Header Background Color Field End --}}

{{-- Sticky Header Background Color Field Start --}}
<div class="form-group row py-4 border-bottom">
    <div class="col-xl-4">
        <label class="font-16 bold black">{{ translate('Sticky Header Background Color') }}
        </label>
        <span class="d-block">{{ translate('Set Sticky Header Background color.') }}</span>
    </div>
    <div class="col-xl-6 offset-xl-1">
        <div class="row ml-2">
            <div class="color">
                <input type="text" class="form-control" name="sticky_header_bg_color"
                value="{{ isset($option_settings['sticky_header_bg_color']) ? $option_settings['sticky_header_bg_color']:'' }}">

                <input type="color" class="" id="sticky_header_bg_color"
                    value="{{ isset($option_settings['sticky_header_bg_color']) ? $option_settings['sticky_header_bg_color']:'#fafafa' }}">
                    
                <label for="sticky_header_bg_color">{{ translate('Select Color') }}</label>
            </div>
            <div class="d-flex align-items-center">
                <label class="custom-checkbox position-relative ml-2 mr-1">
                    <input type="hidden" name="sticky_header_bg_color_transparent" value="0">
                    <input type="checkbox"
                        {{ isset($option_settings['sticky_header_bg_color_transparent']) && $option_settings['sticky_header_bg_color_transparent'] == 1 ? 'checked' : '' }}
                        name="sticky_header_bg_color_transparent" id="sticky_header_bg_color_transparent"
                        value="1">
                    <span class="checkmark"></span>
                </label>
                <label class="black font-16"
                    for="sticky_header_bg_color_transparent">{{ translate('Transparent') }}</label>
            </div>
        </div>
    </div>
</div>
{{-- Sticky Header Background Color Field End --}}

{{-- Header Search Icon Switch Field Start --}}
<div class="form-group row py-4 border-bottom">
    <div class="col-xl-4">
        <label class="font-16 bold black">{{ translate('Header Search Icon') }}
        </label>
        <span class="d-block">{{ translate('Set Enable to display search icon.') }}</span>
    </div>
    <div class="col-xl-6 offset-xl-1">
        <label class="switch success">
            <input type="hidden" name="header_search_icon" value="0">
            <input type="checkbox" {{ isset($option_settings['header_search_icon']) && $option_settings['header_search_icon'] == 1 ? 'checked' : '' }}
                name="header_search_icon" id="header_search_icon" value="1">
            <span class="control" id="header_search_icon_switch">
                <span class="switch-off">{{ translate('Disable') }}</span> 
                <span class="switch-on">{{ translate('Enable') }}</span>
            </span>
        </label>
    </div>
</div>
{{-- Header Search Switch Icon Field End --}}

{{-- Header Search Icon Switch Enable Field Start --}}
<div id="header_search_icon_switch_on_field">
    {{-- Header Search Icon Color Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4">
            <label class="font-16 bold black">{{ translate('Header Search Icon Color') }}
            </label>
            <span class="d-block">{{ translate('Set search icon color.') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <div class="row ml-2">
                <div class="color">
                    <input type="text" class="form-control"  name="header_search_icon_color" value="{{ isset($option_settings['header_search_icon_color']) ? $option_settings['header_search_icon_color']:'' }}">

                    <input type="color" class="" id="header_search_icon_color" value="{{ isset($option_settings['header_search_icon_color']) ? $option_settings['header_search_icon_color']:'#fafafa' }}">

                    <label for="header_search_icon_color">{{ translate('Select Color') }}</label>
                </div>
                <div class="d-flex align-items-center">
                    <label class="custom-checkbox position-relative ml-2 mr-1">
                        <input type="hidden" name="header_search_icon_color_transparent" value="0">
                        <input type="checkbox"
                            {{ isset($option_settings['header_search_icon_color_transparent']) && $option_settings['header_search_icon_color_transparent'] == 1 ? 'checked' : '' }}
                            name="header_search_icon_color_transparent" id="header_search_icon_color_transparent"
                            value="1">
                        <span class="checkmark"></span>
                    </label>
                    <label class="black font-16"
                        for="header_search_icon_color_transparent">{{ translate('Transparent') }}</label>
                </div>
            </div>
        </div>
    </div>
    {{-- Header Search Icon Color Field Start --}}

    {{-- Sticky Header Search Icon Color Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4">
            <label class="font-16 bold black">{{ translate('Sticky Header Search Icon Color') }}
            </label>
            <span class="d-block">{{ translate('Set sticky header search icon color.') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <div class="row ml-2">
                <div class="color">
                    <input type="text" class="form-control" name="sticky_header_search_icon_color"
                    value="{{ isset($option_settings['sticky_header_search_icon_color']) ? $option_settings['sticky_header_search_icon_color']:'' }}">

                    <input type="color" class="" id="sticky_header_search_icon_color"
                        value="{{ isset($option_settings['sticky_header_search_icon_color']) ? $option_settings['sticky_header_search_icon_color']:'#fafafa' }}">

                    <label for="sticky_header_search_icon_color">{{ translate('Select Color') }}</label>
                </div>
                <div class="d-flex align-items-center">
                    <label class="custom-checkbox position-relative ml-2 mr-1">
                        <input type="hidden" name="sticky_header_search_icon_color_transparent" value="0">
                        <input type="checkbox"
                            {{ isset($option_settings['sticky_header_search_icon_color_transparent']) && $option_settings['sticky_header_search_icon_color_transparent'] == 1 ? 'checked' : '' }}
                            name="sticky_header_search_icon_color_transparent"
                            id="sticky_header_search_icon_color_transparent" value="1">
                        <span class="checkmark"></span>
                    </label>
                    <label class="black font-16"
                        for="sticky_header_search_icon_color_transparent">{{ translate('Transparent') }}</label>
                </div>
            </div>
        </div>
    </div>
    {{-- Sticky Header Search Icon Color Field End --}}
</div>
{{-- Header Search Icon Switch Enable Field End --}}
