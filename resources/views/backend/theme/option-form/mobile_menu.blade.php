{{-- Mobile Menu Header --}}
<h3 class="black mb-3">{{ translate('Mobile Menu') }}</h3>
<input type="hidden" name="option_name" value="mobile_menu">

{{-- Custom Menu Style Switch Field Start --}}
<div class="form-group row py-4 border-bottom">
    <div class="col-xl-4">
        <label class="font-16 bold black">{{ translate('Custom Mobile Menu Style') }}
        </label>
        <span class="d-block">{{ translate('custom set mobile menu style.') }}</span>
    </div>
    <div class="col-xl-6 offset-xl-1">
        <label class="switch success">
            <input type="hidden" name="custom_mobile_menu_style" value="0">
            <input type="checkbox"
                {{ isset($option_settings['custom_mobile_menu_style']) && $option_settings['custom_mobile_menu_style'] == 1 ? 'checked' : '' }}
                name="custom_mobile_menu_style" id="custom_mobile_menu_style" value="1">
            <span class="control" id="custom_mobile_menu_style_switch">
                <span class="switch-off">{{ translate('Disable') }}</span>
                <span class="switch-on">{{ translate('Enable') }}</span>
            </span>
        </label>
    </div>
</div>
{{-- Custom Menu Style Switch Field End --}}

{{-- Custom Mobile Menu Switch On Field Start --}}
<div id="custom_mobile_menu_style_switch_on_field">
    {{-- Mobile Menu Icon Color Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4">
            <label class="font-16 bold black">{{ translate('Mobile Menu Icon Color') }}
            </label>
            <span class="d-block">{{ translate('Set Mobile menu Icon color.') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <div class="row ml-2">
                <div class="color">
                    <input type="text" class="form-control" name="mobile_menu_icon_color"
                        value="{{ isset($option_settings['mobile_menu_icon_color']) ? $option_settings['mobile_menu_icon_color'] : '' }}">

                    <input type="color" class="" id="mobile_menu_icon_color"
                        value="{{ isset($option_settings['mobile_menu_icon_color']) ? $option_settings['mobile_menu_icon_color'] : '#fafafa' }}">

                    <label for="mobile_menu_icon_color">{{ translate('Select Color') }}</label>
                </div>
                <div class="d-flex align-items-center">
                    <label class="custom-checkbox position-relative ml-2 mr-1">
                        <input type="hidden" name="mobile_menu_icon_color_transparent" value="0">
                        <input type="checkbox"
                            {{ isset($option_settings['mobile_menu_icon_color_transparent']) && $option_settings['mobile_menu_icon_color_transparent'] == 1 ? 'checked' : '' }}
                            name="mobile_menu_icon_color_transparent" id="mobile_menu_icon_color_transparent"
                            value="1">
                        <span class="checkmark"></span>
                    </label>
                    <label class="black font-16"
                        for="mobile_menu_icon_color_transparent">{{ translate('Transparent') }}</label>
                </div>
            </div>
        </div>
    </div>
    {{-- Mobile Menu Icon Color Field End --}}

    {{-- Sticky Header Mobile Menu Icon Color Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4">
            <label class="font-16 bold black">{{ translate('Sticky Header Mobile Menu Icon Color') }}
            </label>
            <span class="d-block">{{ translate('Set Sticky Header Mobile menu Icon color.') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <div class="row ml-2">
                <div class="color">
                    <input type="text" class="form-control" name="sticky_header_mobile_menu_icon_color"
                        value="{{ isset($option_settings['sticky_header_mobile_menu_icon_color']) ? $option_settings['sticky_header_mobile_menu_icon_color'] : '' }}">

                    <input type="color" class="" id="sticky_header_mobile_menu_icon_color"
                        value="{{ isset($option_settings['sticky_header_mobile_menu_icon_color']) ? $option_settings['sticky_header_mobile_menu_icon_color'] : '#fafafa' }}">

                    <label for="sticky_header_mobile_menu_icon_color">{{ translate('Select Color') }}</label>
                </div>
                <div class="d-flex align-items-center">
                    <label class="custom-checkbox position-relative ml-2 mr-1">
                        <input type="hidden" name="sticky_header_mobile_menu_icon_color_transparent" value="0">
                        <input type="checkbox"
                            {{ isset($option_settings['sticky_header_mobile_menu_icon_color_transparent']) && $option_settings['sticky_header_mobile_menu_icon_color_transparent'] == 1 ? 'checked' : '' }}
                            name="sticky_header_mobile_menu_icon_color_transparent"
                            id="sticky_header_mobile_menu_icon_color_transparent" value="1">
                        <span class="checkmark"></span>
                    </label>
                    <label class="black font-16"
                        for="sticky_header_mobile_menu_icon_color_transparent">{{ translate('Transparent') }}</label>
                </div>
            </div>
        </div>
    </div>
    {{-- Sticky Header Mobile Menu Icon Color Field End --}}

    {{-- Mobile Menu Color Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4">
            <label class="font-16 bold black">{{ translate('Mobile Menu Color') }}
            </label>
            <span class="d-block">{{ translate('Set Mobile menu color.') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <div class="row ml-2">
                <div class="color">
                    <input type="text" class="form-control" name="mobile_menu_color"
                        value="{{ isset($option_settings['mobile_menu_color']) ? $option_settings['mobile_menu_color'] : '' }}">

                    <input type="color" class="" id="mobile_menu_color"
                        value="{{ isset($option_settings['mobile_menu_color']) ? $option_settings['mobile_menu_color'] : '#fafafa' }}">
                    <label for="mobile_menu_color">{{ translate('Select Color') }}</label>
                </div>
                <div class="d-flex align-items-center">
                    <label class="custom-checkbox position-relative ml-2 mr-1">
                        <input type="hidden" name="mobile_menu_color_transparent" value="0">
                        <input type="checkbox"
                            {{ isset($option_settings['mobile_menu_color_transparent']) && $option_settings['mobile_menu_color_transparent'] == 1 ? 'checked' : '' }}
                            name="mobile_menu_color_transparent" id="mobile_menu_color_transparent" value="1">
                        <span class="checkmark"></span>
                    </label>
                    <label class="black font-16"
                        for="mobile_menu_color_transparent">{{ translate('Transparent') }}</label>
                </div>
            </div>
        </div>
    </div>
    {{-- Mobile Menu Color Field End --}}

    {{-- Mobile Menu Hover Color Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4">
            <label class="font-16 bold black">{{ translate('Mobile Menu Hover Color') }}
            </label>
            <span class="d-block">{{ translate('Set Mobile menu hover color.') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <div class="row ml-2">
                <div class="color">
                    <input type="text" class="form-control" name="mobile_menu_hover_color"
                        value="{{ isset($option_settings['mobile_menu_hover_color']) ? $option_settings['mobile_menu_hover_color'] : '' }}">

                    <input type="color" class="" id="mobile_menu_hover_color"
                        value="{{ isset($option_settings['mobile_menu_hover_color']) ? $option_settings['mobile_menu_hover_color'] : '#fafafa' }}">
                    <label for="mobile_menu_hover_color">{{ translate('Select Color') }}</label>
                </div>
                <div class="d-flex align-items-center">
                    <label class="custom-checkbox position-relative ml-2 mr-1">
                        <input type="hidden" name="mobile_menu_hover_color_transparent" value="0">
                        <input type="checkbox"
                            {{ isset($option_settings['mobile_menu_hover_color_transparent']) && $option_settings['mobile_menu_hover_color_transparent'] == 1 ? 'checked' : '' }}
                            name="mobile_menu_hover_color_transparent" id="mobile_menu_hover_color_transparent"
                            value="1">
                        <span class="checkmark"></span>
                    </label>
                    <label class="black font-16"
                        for="mobile_menu_hover_color_transparent">{{ translate('Transparent') }}</label>
                </div>
            </div>
        </div>
    </div>
    {{-- Mobile Menu Hover Color Field End --}}

    {{-- Mobile Menu Active Item Color Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4">
            <label class="font-16 bold black">{{ translate('Mobile Menu Active Item Color') }}
            </label>
            <span class="d-block">{{ translate('Set Mobile menu Active Item color.') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <div class="row ml-2">
                <div class="color">
                    <input type="text" class="form-control" name="mobile_menu_active_item_color"
                        value="{{ isset($option_settings['mobile_menu_active_item_color']) ? $option_settings['mobile_menu_active_item_color'] : '' }}">

                    <input type="color" class="" id="mobile_menu_active_item_color"
                        value="{{ isset($option_settings['mobile_menu_active_item_color']) ? $option_settings['mobile_menu_active_item_color'] : '#fafafa' }}">
                    <label for="mobile_menu_active_item_color">{{ translate('Select Color') }}</label>
                </div>
                <div class="d-flex align-items-center">
                    <label class="custom-checkbox position-relative ml-2 mr-1">
                        <input type="hidden" name="mobile_menu_active_item_color_transparent" value="0">
                        <input type="checkbox"
                            {{ isset($option_settings['mobile_menu_active_item_color_transparent']) && $option_settings['mobile_menu_active_item_color_transparent'] == 1 ? 'checked' : '' }}
                            name="mobile_menu_active_item_color_transparent"
                            id="mobile_menu_active_item_color_transparent" value="1">
                        <span class="checkmark"></span>
                    </label>
                    <label class="black font-16"
                        for="mobile_menu_active_item_color_transparent">{{ translate('Transparent') }}</label>
                </div>
            </div>
        </div>
    </div>
    {{-- Mobile Menu Active Item Color Field End --}}

    {{-- Mobile Sub Menu Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4">
            <label class="font-16 bold black">{{ translate('Mobile Sub Menu Color') }}
            </label>
            <span class="d-block">{{ translate('Set Mobile sub menu color.') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <div class="row ml-2">
                <div class="color">
                    <input type="text" class="form-control" name="mobile_sub_menu_color"
                        value="{{ isset($option_settings['mobile_sub_menu_color']) ? $option_settings['mobile_sub_menu_color'] : '' }}">

                    <input type="color" class="" id="mobile_sub_menu_color"
                        value="{{ isset($option_settings['mobile_sub_menu_color']) ? $option_settings['mobile_sub_menu_color'] : '#fafafa' }}">
                    <label for="mobile_sub_menu_color">{{ translate('Select Color') }}</label>
                </div>
                <div class="d-flex align-items-center">
                    <label class="custom-checkbox position-relative ml-2 mr-1">
                        <input type="hidden" name="mobile_sub_menu_color_transparent" value="0">
                        <input type="checkbox"
                            {{ isset($option_settings['mobile_sub_menu_color_transparent']) && $option_settings['mobile_sub_menu_color_transparent'] == 1 ? 'checked' : '' }}
                            name="mobile_sub_menu_color_transparent" id="mobile_sub_menu_color_transparent"
                            value="1">
                        <span class="checkmark"></span>
                    </label>
                    <label class="black font-16"
                        for="mobile_sub_menu_color_transparent">{{ translate('Transparent') }}</label>
                </div>
            </div>
        </div>
    </div>
    {{-- Mobile Sub Menu Field End --}}

    {{-- Mobile Sub Menu Hover Color Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4">
            <label class="font-16 bold black">{{ translate('Mobile Sub Menu Hover Color') }}
            </label>
            <span class="d-block">{{ translate('Set Mobile sub menu hover color.') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <div class="row ml-2">
                <div class="color">
                    <input type="text" class="form-control" name="mobile_sub_menu_hover_color"
                        value="{{ isset($option_settings['mobile_sub_menu_hover_color']) ? $option_settings['mobile_sub_menu_hover_color'] : '' }}">

                    <input type="color" class="" id="mobile_sub_menu_hover_color"
                        value="{{ isset($option_settings['mobile_sub_menu_hover_color']) ? $option_settings['mobile_sub_menu_hover_color'] : '#fafafa' }}">
                    <label for="mobile_sub_menu_hover_color">{{ translate('Select Color') }}</label>
                </div>
                <div class="d-flex align-items-center">
                    <label class="custom-checkbox position-relative ml-2 mr-1">
                        <input type="hidden" name="mobile_sub_menu_hover_color_transparent" value="0">
                        <input type="checkbox"
                            {{ isset($option_settings['mobile_sub_menu_hover_color_transparent']) && $option_settings['mobile_sub_menu_hover_color_transparent'] == 1 ? 'checked' : '' }}
                            name="mobile_sub_menu_hover_color_transparent"
                            id="mobile_sub_menu_hover_color_transparent" value="1">
                        <span class="checkmark"></span>
                    </label>
                    <label class="black font-16"
                        for="mobile_sub_menu_hover_color_transparent">{{ translate('Transparent') }}</label>
                </div>
            </div>
        </div>
    </div>
    {{-- Mobile Sub Menu Hover Color Field End --}}

    {{-- Mobile Sub Menu Active Item Color Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4">
            <label class="font-16 bold black">{{ translate('Mobile Sub Menu Active Item Color') }}
            </label>
            <span class="d-block">{{ translate('Set Mobile Sub menu Active Item color.') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <div class="row ml-2">
                <div class="color">
                    <input type="text" class="form-control" name="mobile_sub_menu_active_item_color"
                        value="{{ isset($option_settings['mobile_sub_menu_active_item_color']) ? $option_settings['mobile_sub_menu_active_item_color'] : '' }}">

                    <input type="color" class="" id="mobile_sub_menu_active_item_color"
                        value="{{ isset($option_settings['mobile_sub_menu_active_item_color']) ? $option_settings['mobile_sub_menu_active_item_color'] : '#fafafa' }}">
                    <label for="mobile_sub_menu_active_item_color">{{ translate('Select Color') }}</label>
                </div>
                <div class="d-flex align-items-center">
                    <label class="custom-checkbox position-relative ml-2 mr-1">
                        <input type="hidden" name="mobile_sub_menu_active_item_color_transparent" value="0">
                        <input type="checkbox"
                            {{ isset($option_settings['mobile_sub_menu_active_item_color_transparent']) && $option_settings['mobile_sub_menu_active_item_color_transparent'] == 1 ? 'checked' : '' }}
                            name="mobile_sub_menu_active_item_color_transparent"
                            id="mobile_sub_menu_active_item_color_transparent" value="1">
                        <span class="checkmark"></span>
                    </label>
                    <label class="black font-16"
                        for="mobile_sub_menu_active_item_color_transparent">{{ translate('Transparent') }}</label>
                </div>
            </div>
        </div>
    </div>
    {{-- Mobile Sub Menu Active Item Color Field End --}}
</div>
{{-- Custom Mobile Menu Switch On Field End --}}
