{{-- Footer Header --}}
<h3 class="black mb-3">{{ translate('Footer') }}</h3>
<input type="hidden" name="option_name" value="footer">

{{-- Custom Footer Switch Field Start --}}
<div class="form-group row py-4 border-bottom">
    <div class="col-xl-4">
        <label class="font-16 bold black">{{ translate('Custom Footer Style') }}
        </label>
        <span class="d-block">{{ translate('Set custom footer style') }}</span>
    </div>
    <div class="col-xl-6 offset-xl-1">
        <label class="switch success">
            <input type="hidden" name="custom_footer_style" value="0">
            <input type="checkbox"
                {{ isset($option_settings['custom_footer_style']) && $option_settings['custom_footer_style'] == 1 ? 'checked' : '' }}
                name="custom_footer_style" id="custom_footer_style" value="1">
            <span class="control" id="custom_footer_style_switch">
                <span class="switch-off">{{ translate('Disable') }}</span>
                <span class="switch-on">{{ translate('Enable') }}</span>
            </span>
        </label>
    </div>
</div>
{{-- Custom Footer Switch Field End --}}

{{-- Custom Footer Switch On Field Start --}}
<div id="custom_footer_style_switch_on_field">
    {{-- Footer Background Color Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4">
            <label class="font-16 bold black">{{ translate('Footer Background Color') }}
            </label>
            <span class="d-block">{{ translate('Set Footer Background Color') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <div class="row ml-2">
                <div class="color">
                    <input type="text" class="form-control" name="footer_bg_color"
                        value="{{ isset($option_settings['footer_bg_color']) ? $option_settings['footer_bg_color'] : '' }}">

                    <input type="color" class="" id="footer_bg_color"
                        value="{{ isset($option_settings['footer_bg_color']) ? $option_settings['footer_bg_color'] : '#fafafa' }}">
                    <label for="footer_bg_color">{{ translate('Select Color') }}</label>
                </div>
                <div class="d-flex align-items-center">
                    <label class="custom-checkbox position-relative ml-2 mr-1">
                        <input type="hidden" name="footer_bg_color_transparent" value="0">
                        <input type="checkbox"
                            {{ isset($option_settings['footer_bg_color_transparent']) && $option_settings['footer_bg_color_transparent'] == 1 ? 'checked' : '' }}
                            name="footer_bg_color_transparent" id="footer_bg_color_transparent" value="1">
                        <span class="checkmark"></span>
                    </label>
                    <label class="black font-16"
                        for="footer_bg_color_transparent">{{ translate('Transparent') }}</label>
                </div>
            </div>
        </div>
    </div>
    {{-- Footer Background Color Field End --}}

    {{-- Footer Padding Switch On Custom Footer Padding Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4">
            <label class="font-16 bold black">{{ translate('Custom Footer Padding.') }}
            </label>
            <span class="d-block">{{ translate('Set Footer Padding.') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1 row">
            <div class="input-group col-xl-4">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-arrow-up"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="custom_footer_padding_top"
                    id="custom_footer_padding_top" placeholder="{{ translate('Top') }}"
                    value="{{ isset($option_settings['custom_footer_padding_top']) ? $option_settings['custom_footer_padding_top'] : '' }}">
            </div>

            <div class="input-group col-xl-4">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-arrow-down"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="custom_footer_padding_bottom"
                    id="custom_footer_padding_bottom" placeholder="{{ translate('Bottom') }}"
                    value="{{ isset($option_settings['custom_footer_padding_bottom']) ? $option_settings['custom_footer_padding_bottom'] : '' }}">
            </div>

            <div class="input-group col-xl-4">
                <select class="form-control select" name="custom_footer_padding_unit" id="custom_footer_padding_unit">
                    <option value="px"
                        {{ isset($option_settings['custom_footer_padding_unit']) && $option_settings['custom_footer_padding_unit'] == 'px' ? 'selected' : '' }}>
                        px</option>
                </select>
            </div>
        </div>
    </div>
    {{-- Footer Padding Switch On Custom Footer Padding Field End --}}

    {{-- Footer Social Enable/Disable Switch Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4">
            <label class="font-16 bold black">{{ translate('Footer Social Enable/Disable') }}
            </label>
            <span class="d-block">{{ translate('Set Enable to show Footer Social') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <label class="switch success">
                <input type="hidden" name="footer_social_enable" value="0">
                <input type="checkbox"
                    {{ isset($option_settings['footer_social_enable']) && $option_settings['footer_social_enable'] == 1 ? 'checked' : '' }}
                    name="footer_social_enable" id="footer_social_enable" value="1">
                <span class="control" id="footer_social_enable_switch">
                    <span class="switch-off">{{ translate('Disable') }}</span>
                    <span class="switch-on">{{ translate('Enable') }}</span>
                </span>
            </label>
        </div>
    </div>
    {{-- Footer Social Enable/Disable Switch Field End --}}

    {{-- Footer Social Switch Enable Field Start --}}
    <div id="footer_social_enable_switch_on_field">
        {{-- Footer Social Color Field Start --}}
        <div class="form-group row py-4 border-bottom">
            <div class="col-xl-4">
                <label class="font-16 bold black">{{ translate('Footer Social Color') }}
                </label>
                <span class="d-block">{{ translate('Set Footer Social Color') }}</span>
            </div>
            <div class="col-xl-6 offset-xl-1">
                <div class="row ml-2">
                    <div class="color">
                        <input type="text" class="form-control" name="footer_social_color"
                            value="{{ isset($option_settings['footer_social_color']) ? $option_settings['footer_social_color'] : '' }}">

                        <input type="color" class="" id="footer_social_color"
                            value="{{ isset($option_settings['footer_social_color']) ? $option_settings['footer_social_color'] : '#fafafa' }}">
                        <label for="footer_social_color">{{ translate('Select Color') }}</label>
                    </div>
                    <div class="d-flex align-items-center">
                        <label class="custom-checkbox position-relative ml-2 mr-1">
                            <input type="hidden" name="footer_social_color_transparent" value="0">
                            <input type="checkbox"
                                {{ isset($option_settings['footer_social_color_transparent']) && $option_settings['footer_social_color_transparent'] == 1 ? 'checked' : '' }}
                                name="footer_social_color_transparent" id="footer_social_color_transparent"
                                value="1">
                            <span class="checkmark"></span>
                        </label>
                        <label class="black font-16"
                            for="footer_social_color_transparent">{{ translate('Transparent') }}</label>
                    </div>
                </div>
            </div>
        </div>
        {{-- Footer Social Color Field Start --}}

        {{-- Footer Social Hover Color Field Start --}}
        <div class="form-group row py-4 border-bottom">
            <div class="col-xl-4">
                <label class="font-16 bold black">{{ translate('Footer Social Hover Color') }}
                </label>
            </div>
            <div class="col-xl-6 offset-xl-1">
                <div class="row ml-2">
                    <div class="color">
                        <input type="text" class="form-control" name="footer_social_hover_color"
                            value="{{ isset($option_settings['footer_social_hover_color']) ? $option_settings['footer_social_hover_color'] : '' }}">

                        <input type="color" class="" id="footer_social_hover_color"
                            value="{{ isset($option_settings['footer_social_hover_color']) ? $option_settings['footer_social_hover_color'] : '#fafafa' }}">
                        <label for="footer_social_hover_color">{{ translate('Select Color') }}</label>
                    </div>
                    <div class="d-flex align-items-center">
                        <label class="custom-checkbox position-relative ml-2 mr-1">
                            <input type="hidden" name="footer_social_hover_color_transparent" value="0">
                            <input type="checkbox"
                                {{ isset($option_settings['footer_social_hover_color_transparent']) && $option_settings['footer_social_hover_color_transparent'] == 1 ? 'checked' : '' }}
                                name="footer_social_hover_color_transparent"
                                id="footer_social_hover_color_transparent" value="1">
                            <span class="checkmark"></span>
                        </label>
                        <label class="black font-16"
                            for="footer_social_hover_color_transparent">{{ translate('Transparent') }}</label>
                    </div>
                </div>
            </div>
        </div>
        {{-- Footer Social Hover Color Field End --}}

        {{-- Footer Social Alignment Field Start --}}
        <div class="form-group row py-4 border-bottom">
            <div class="col-xl-4">
                <label class="font-16 bold black">{{ translate('Footer Social Alignment') }}
                </label>
                <span class="d-block">{{ translate('Set Footer Social Alignment Position') }}</span>
            </div>
            <div class="col-xl-6 offset-xl-1">
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-light sm">
                        <input type="radio"
                            {{ isset($option_settings['footer_social_alignment']) && $option_settings['footer_social_alignment'] == 'left' ? 'checked' : '' }}
                            class="d-none" name="footer_social_alignment" id="left" value="left">
                        {{ translate('left') }}
                    </label>
                    <label class="btn btn-light sm">
                        <input type="radio"
                            {{ isset($option_settings['footer_social_alignment']) && $option_settings['footer_social_alignment'] == 'center' ? 'checked' : '' }}
                            class="d-none" name="footer_social_alignment" id="center" value="center">
                        {{ translate('center') }}
                    </label>
                    <label class="btn btn-light sm">
                        <input type="radio"
                            {{ isset($option_settings['footer_social_alignment']) && $option_settings['footer_social_alignment'] == 'right' ? 'checked' : '' }}
                            class="d-none" name="footer_social_alignment" id="right" value="right">
                        {{ translate('right') }}
                    </label>
                </div>
            </div>
        </div>
        {{-- Footer Social Alignment Field End --}}
    </div>
    {{-- Footer Social Switch Enable Field End --}}

    {{-- Footer Logo Enable/Disable Switch Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4">
            <label class="font-16 bold black">{{ translate('Footer Logo Enable/Disable') }}
            </label>
            <span
                class="d-block">{{ translate('Set Enable to show Footer Logo (Header Logo will be set as Footer Logo).') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <label class="switch success">
                <input type="hidden" name="footer_logo_enable" value="0">
                <input type="checkbox"
                    {{ isset($option_settings['footer_logo_enable']) && $option_settings['footer_logo_enable'] == 1 ? 'checked' : '' }}
                    name="footer_logo_enable" id="footer_logo_enable" value="1">
                <span class="control" id="footer_logo_enable_switch">
                    <span class="switch-off">{{ translate('Disable') }}</span>
                    <span class="switch-on">{{ translate('Enable') }}</span>
                </span>
            </label>
        </div>
    </div>
    {{-- Footer Logo Enable/Disable Switch Field End --}}

    {{-- Footer Logo Switch Enable Field Start --}}
    <div id="footer_logo_enable_switch_on_field">
        {{-- Footer Logo Anchor URL Field Start --}}
        <div class="form-group row py-4 border-bottom">
            <div class="col-xl-4">
                <label for="footer_logo_anchor_url"
                    class="font-16 bold black">{{ translate('Footer Logo Anchor URL') }}
                </label>
                <span class="d-block">{{ translate('Set Footer Logo Anchor URL(default is home url)') }}</span>
            </div>
            <div class="col-xl-6 offset-xl-1">
                <input type="text" name="footer_logo_anchor_url" id="footer_logo_anchor_url" class="form-control"
                    value="{{ isset($option_settings['footer_logo_anchor_url']) ? $option_settings['footer_logo_anchor_url'] : '' }}">
            </div>
        </div>
        {{-- Footer Logo Anchor URL Field End --}}

        {{-- Footer Logo Alignment Field Start --}}
        <div class="form-group row py-4 border-bottom">
            <div class="col-xl-4">
                <label class="font-16 bold black">{{ translate('Footer Logo Alignment') }}
                </label>
                <span class="d-block">{{ translate('Set Enable to show Footer Logo Alignment') }}</span>
            </div>
            <div class="col-xl-6 offset-xl-1">
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-light sm">
                        <input type="radio"
                            {{ isset($option_settings['footer_logo_alignment']) && $option_settings['footer_logo_alignment'] == 'start' ? 'checked' : '' }}
                            class="d-none" name="footer_logo_alignment" id="start" value="start">
                        {{ translate('left') }}
                    </label>
                    <label class="btn btn-light sm">
                        <input type="radio"
                            {{ isset($option_settings['footer_logo_alignment']) && $option_settings['footer_logo_alignment'] == 'center' ? 'checked' : '' }}
                            class="d-none" name="footer_logo_alignment" id="center" value="center">
                        {{ translate('center') }}
                    </label>
                    <label class="btn btn-light sm">
                        <input type="radio"
                            {{ isset($option_settings['footer_logo_alignment']) && $option_settings['footer_logo_alignment'] == 'end' ? 'checked' : '' }}
                            class="d-none" name="footer_logo_alignment" id="end" value="end">
                        {{ translate('right') }}
                    </label>
                </div>
            </div>
        </div>
        {{-- Footer Logo Alignment Field End --}}
    </div>
    {{-- Footer Logo Switch Enable Field End --}}

    {{-- Footer Text Enable/Disable Switch Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4">
            <label class="font-16 bold black">{{ translate('Footer Text Enable/Disable') }}
            </label>
            <span class="d-block">{{ translate('Set Enable to show Footer Copyright Text') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <label class="switch success">
                <input type="hidden" name="footer_text_enable" value="0">
                <input type="checkbox"
                    {{ isset($option_settings['footer_text_enable']) && $option_settings['footer_text_enable'] == 1 ? 'checked' : '' }}
                    name="footer_text_enable" id="footer_text_enable" value="1">
                <span class="control" id="footer_text_enable_switch">
                    <span class="switch-off">{{ translate('Disable') }}</span>
                    <span class="switch-on">{{ translate('Enable') }}</span>
                </span>
            </label>
        </div>
    </div>
    {{-- Footer Text Enable/Disable Switch Field End --}}

    {{-- Footer Text Switch Enable Field Start --}}
    <div id="footer_text_enable_switch_on_field">
        {{-- Footer Text Alignment Field Start --}}
        <div class="form-group row py-4 border-bottom">
            <div class="col-xl-4">
                <label class="font-16 bold black">{{ translate('Footer Copyright Text Alignment') }}
                </label>
                <span class="d-block">{{ translate('Set Enable to show Footer Text Alignment') }}</span>
            </div>
            <div class="col-xl-6 offset-xl-1">
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-light sm">
                        <input type="radio"
                            {{ isset($option_settings['footer_text_alignment']) && $option_settings['footer_text_alignment'] == 'left' ? 'checked' : '' }}
                            class="d-none" name="footer_text_alignment" id="left" value="left">
                        {{ translate('left') }}
                    </label>
                    <label class="btn btn-light sm">
                        <input type="radio"
                            {{ isset($option_settings['footer_text_alignment']) && $option_settings['footer_text_alignment'] == 'center' ? 'checked' : '' }}
                            class="d-none" name="footer_text_alignment" id="center" value="center">
                        {{ translate('center') }}
                    </label>
                    <label class="btn btn-light sm">
                        <input type="radio"
                            {{ isset($option_settings['footer_text_alignment']) && $option_settings['footer_text_alignment'] == 'right' ? 'checked' : '' }}
                            class="d-none" name="footer_text_alignment" id="right" value="right">
                        {{ translate('right') }}
                    </label>
                </div>
            </div>
        </div>
        {{-- Footer Text Alignment Field End --}}

        {{-- Footer Text Color Field Start --}}
        <div class="form-group row py-4 border-bottom">
            <div class="col-xl-4">
                <label class="font-16 bold black">{{ translate('Footer Copyright Text Color') }}
                </label>
                <span class="d-block">{{ translate('Set Footer Text Color') }}</span>
            </div>
            <div class="col-xl-6 offset-xl-1">
                <div class="row ml-2">
                    <div class="color">
                        <input type="text" class="form-control" name="footer_text_color"
                            value="{{ isset($option_settings['footer_text_color']) ? $option_settings['footer_text_color'] : '' }}">

                        <input type="color" class="" id="footer_text_color"
                            value="{{ isset($option_settings['footer_text_color']) ? $option_settings['footer_text_color'] : '#fafafa' }}">
                        <label for="footer_text_color">{{ translate('Select Color') }}</label>
                    </div>
                    <div class="d-flex align-items-center">
                        <label class="custom-checkbox position-relative ml-2 mr-1">
                            <input type="hidden" name="footer_text_color_transparent" value="0">
                            <input type="checkbox"
                                {{ isset($option_settings['footer_text_color_transparent']) && $option_settings['footer_text_color_transparent'] == 1 ? 'checked' : '' }}
                                name="footer_text_color_transparent" id="footer_text_color_transparent"
                                value="1">
                            <span class="checkmark"></span>
                        </label>
                        <label class="black font-16"
                            for="footer_text_color_transparent">{{ translate('Transparent') }}</label>
                    </div>
                </div>
            </div>
        </div>
        {{-- Footer Text Color Field End --}}

        {{-- Footer  Anchor Text Color Field Start --}}
        <div class="form-group row py-4 border-bottom">
            <div class="col-xl-4">
                <label class="font-16 bold black">{{ translate('Footer Copyright Anchor Text Color') }}
                </label>
                <span class="d-block">{{ translate('Set Footer Anchor Text Color') }}</span>
            </div>
            <div class="col-xl-6 offset-xl-1">
                <div class="row ml-2">
                    <div class="color">
                        <input type="text" class="form-control" name="footer_anchor_text_color"
                            value="{{ isset($option_settings['footer_anchor_text_color']) ? $option_settings['footer_anchor_text_color'] : '' }}">

                        <input type="color" class="" id="footer_anchor_text_color"
                            value="{{ isset($option_settings['footer_anchor_text_color']) ? $option_settings['footer_anchor_text_color'] : '#fafafa' }}">
                        <label for="footer_anchor_text_color">{{ translate('Select Color') }}</label>
                    </div>
                    <div class="d-flex align-items-center">
                        <label class="custom-checkbox position-relative ml-2 mr-1">
                            <input type="hidden" name="footer_anchor_text_color_transparent" value="0">
                            <input type="checkbox"
                                {{ isset($option_settings['footer_anchor_text_color_transparent']) && $option_settings['footer_anchor_text_color_transparent'] == 1 ? 'checked' : '' }}
                                name="footer_anchor_text_color_transparent" id="footer_anchor_text_color_transparent"
                                value="1">
                            <span class="checkmark"></span>
                        </label>
                        <label class="black font-16"
                            for="footer_anchor_text_color_transparent">{{ translate('Transparent') }}</label>
                    </div>
                </div>
            </div>
        </div>
        {{-- Footer  Anchor Text Color Field End --}}

        {{-- Footer Anchor Text Hover Color Field Start --}}
        <div class="form-group row py-4 border-bottom">
            <div class="col-xl-4">
                <label class="font-16 bold black">{{ translate('Footer Copyright Anchor Text Hover Color') }}
                </label>
                <span class="d-block">{{ translate('Set Footer Anchor Text Hover Color') }}</span>
            </div>
            <div class="col-xl-6 offset-xl-1">
                <div class="row ml-2">
                    <div class="color">
                        <input type="text" class="form-control" name="footer_anchor_text_hover_color"
                            value="{{ isset($option_settings['footer_anchor_text_hover_color']) ? $option_settings['footer_anchor_text_hover_color'] : '' }}">

                        <input type="color" class="" id="footer_anchor_text_hover_color"
                            value="{{ isset($option_settings['footer_anchor_text_hover_color']) ? $option_settings['footer_anchor_text_hover_color'] : '#fafafa' }}">
                        <label for="footer_anchor_text_hover_color">{{ translate('Select Color') }}</label>
                    </div>
                    <div class="d-flex align-items-center">
                        <label class="custom-checkbox position-relative ml-2 mr-1">
                            <input type="hidden" name="footer_anchor_text_hover_color_transparent" value="0">
                            <input type="checkbox"
                                {{ isset($option_settings['footer_anchor_text_hover_color_transparent']) && $option_settings['footer_anchor_text_hover_color_transparent'] == 1 ? 'checked' : '' }}
                                name="footer_anchor_text_hover_color_transparent"
                                id="footer_anchor_text_hover_color_transparent" value="1">
                            <span class="checkmark"></span>
                        </label>
                        <label class="black font-16"
                            for="footer_anchor_text_hover_color_transparent">{{ translate('Transparent') }}</label>
                    </div>
                </div>
            </div>
        </div>
        {{-- Footer Anchor Text Hover Color Field End --}}
    </div>
    {{-- Footer Text Switch Enable Field End --}}
</div>
{{-- Custom Footer Switch On Field End --}}


{{-- Footer Language Switch Field Start --}}
<div class="form-group row py-4 border-bottom">
    <div class="col-xl-4">
        <label class="font-16 bold black">{{ translate('Footer Language Select') }}
        </label>
        <span class="d-block">{{ translate('Set Enable to display multi-language select in footer.') }}</span>
    </div>
    <div class="col-xl-6 offset-xl-1">
        <label class="switch success">
            <input type="hidden" name="footer_language_select" value="0">
            <input type="checkbox" {{ isset($option_settings['footer_language_select']) && $option_settings['footer_language_select'] == 1 ? 'checked' : '' }}
                name="footer_language_select" id="footer_language_select" value="1">
            <span class="control" id="footer_language_select_switch">
                <span class="switch-off">{{ translate('Disable') }}</span> 
                <span class="switch-on">{{ translate('Enable') }}</span>
            </span>
        </label>
    </div>
</div>
{{-- Footer Language Switch Icon Field End --}}