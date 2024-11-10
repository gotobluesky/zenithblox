{{-- Menu Header --}}
<h3 class="black mb-3">{{ translate('Menu') }}</h3>
<input type="hidden" name="option_name" value="menu">

{{-- Custom Menu Style Switch Field Start --}}
<div class="form-group row py-4 border-bottom">
    <div class="col-xl-4">
        <label class="font-16 bold black">{{ translate('Custom Menu Style') }}
        </label>
        <span class="d-block">{{ translate('custom set menu style.') }}</span>
    </div>
    <div class="col-xl-6 offset-xl-1">
        <label class="switch success">
            <input type="hidden" name="custom_menu_style" value="0">
            <input type="checkbox"
                {{ isset($option_settings['custom_menu_style']) && $option_settings['custom_menu_style'] == 1 ? 'checked' : '' }}
                name="custom_menu_style" id="custom_menu_style" value="1">
            <span class="control" id="custom_menu_style_switch">
                <span class="switch-off">{{ translate('Disable') }}</span>
                <span class="switch-on">{{ translate('Enable') }}</span>
            </span>
        </label>
    </div>
</div>
{{-- Custom Menu Style Switch Field End --}}

{{-- Custome Menu Switch On Field Start --}}
<div id="custom_menu_style_switch_on_field">
    {{-- Menu Color Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4">
            <label class="font-16 bold black">{{ translate('Menu Color') }}
            </label>
            <span class="d-block">{{ translate('Set header menu color.') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <div class="row ml-2">
                <div class="color">
                    <input type="text" class="form-control" name="menu_color"
                        value="{{ isset($option_settings['menu_color']) ? $option_settings['menu_color'] : '' }}">

                    <input type="color" class="" id="menu_color"
                        value="{{ isset($option_settings['menu_color']) ? $option_settings['menu_color'] : '#fafafa' }}">
                    <label for="menu_color">{{ translate('Select Color') }}</label>
                </div>
                <div class="d-flex align-items-center">
                    <label class="custom-checkbox position-relative ml-2 mr-1">
                        <input type="hidden" name="menu_color_transparent" value="0">
                        <input type="checkbox"
                            {{ isset($option_settings['menu_color_transparent']) && $option_settings['menu_color_transparent'] == 1 ? 'checked' : '' }}
                            name="menu_color_transparent" id="menu_color_transparent" value="1">
                        <span class="checkmark"></span>
                    </label>
                    <label class="black font-16" for="menu_color_transparent">{{ translate('Transparent') }}</label>
                </div>
            </div>
        </div>
    </div>
    {{-- Menu Color Field End --}}

    {{-- Menu Hover Color Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4">
            <label class="font-16 bold black">{{ translate('Menu Hover Color') }}
            </label>
            <span class="d-block">{{ translate('Set header menu hover color.') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <div class="row ml-2">
                <div class="color">
                    <input type="text" class="form-control" name="menu_hover_color"
                        value="{{ isset($option_settings['menu_hover_color']) ? $option_settings['menu_hover_color'] : '' }}">

                    <input type="color" class="" id="menu_hover_color"
                        value="{{ isset($option_settings['menu_hover_color']) ? $option_settings['menu_hover_color'] : '#fafafa' }}">
                    <label for="menu_hover_color">{{ translate('Select Color') }}</label>
                </div>
                <div class="d-flex align-items-center">
                    <label class="custom-checkbox position-relative ml-2 mr-1">
                        <input type="hidden" name="menu_hover_color_transparent" value="0">
                        <input type="checkbox"
                            {{ isset($option_settings['menu_hover_color_transparent']) && $option_settings['menu_hover_color_transparent'] == 1 ? 'checked' : '' }}
                            name="menu_hover_color_transparent" id="menu_hover_color_transparent" value="1">
                        <span class="checkmark"></span>
                    </label>
                    <label class="black font-16"
                        for="menu_hover_color_transparent">{{ translate('Transparent') }}</label>
                </div>
            </div>
        </div>
    </div>
    {{-- Menu Hover Color Field End --}}

    {{-- Menu Active Item Color Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4">
            <label class="font-16 bold black">{{ translate('Menu Active Item Color') }}
            </label>
            <span class="d-block">{{ translate('Set header menu Active Item color.') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <div class="row ml-2">
                <div class="color">
                    <input type="text" class="form-control" name="menu_active_item_color"
                        value="{{ isset($option_settings['menu_active_item_color']) ? $option_settings['menu_active_item_color'] : '' }}">

                    <input type="color" class="" id="menu_active_item_color"
                        value="{{ isset($option_settings['menu_active_item_color']) ? $option_settings['menu_active_item_color'] : '#fafafa' }}">
                    <label for="menu_active_item_color">{{ translate('Select Color') }}</label>
                </div>
                <div class="d-flex align-items-center">
                    <label class="custom-checkbox position-relative ml-2 mr-1">
                        <input type="hidden" name="menu_active_item_color_transparent" value="0">
                        <input type="checkbox"
                            {{ isset($option_settings['menu_active_item_color_transparent']) && $option_settings['menu_active_item_color_transparent'] == 1 ? 'checked' : '' }}
                            name="menu_active_item_color_transparent" id="menu_active_item_color_transparent"
                            value="1">
                        <span class="checkmark"></span>
                    </label>
                    <label class="black font-16"
                        for="menu_active_item_color_transparent">{{ translate('Transparent') }}</label>
                </div>
            </div>
        </div>
    </div>
    {{-- Menu Active Item Color Field End --}}

    {{-- Sub Menu Color Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4">
            <label class="font-16 bold black">{{ translate('Sub Menu Color') }}
            </label>
            <span class="d-block">{{ translate('Set header sub menu color.') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <div class="row ml-2">
                <div class="color">
                    <input type="text" class="form-control" name="sub_menu_color"
                        value="{{ isset($option_settings['sub_menu_color']) ? $option_settings['sub_menu_color'] : '' }}">

                    <input type="color" class="" id="sub_menu_color"
                        value="{{ isset($option_settings['sub_menu_color']) ? $option_settings['sub_menu_color'] : '#fafafa' }}">
                    <label for="sub_menu_color">{{ translate('Select Color') }}</label>
                </div>
                <div class="d-flex align-items-center">
                    <label class="custom-checkbox position-relative ml-2 mr-1">
                        <input type="hidden" name="sub_menu_color_transparent" value="0">
                        <input type="checkbox"
                            {{ isset($option_settings['sub_menu_color_transparent']) && $option_settings['sub_menu_color_transparent'] == 1 ? 'checked' : '' }}
                            name="sub_menu_color_transparent" id="sub_menu_color_transparent" value="1">
                        <span class="checkmark"></span>
                    </label>
                    <label class="black font-16"
                        for="sub_menu_color_transparent">{{ translate('Transparent') }}</label>
                </div>
            </div>
        </div>
    </div>
    {{-- Sub Menu Color Field End --}}

    {{-- Sub Menu Hover Color Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4">
            <label class="font-16 bold black">{{ translate('Sub Menu Hover Color') }}
            </label>
            <span class="d-block">{{ translate('Set header sub menu hover color.') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <div class="row ml-2">
                <div class="color">
                    <input type="text" class="form-control" name="sub_menu_hover_color"
                        value="{{ isset($option_settings['sub_menu_hover_color']) ? $option_settings['sub_menu_hover_color'] : '' }}">

                    <input type="color" class="" id="sub_menu_hover_color"
                        value="{{ isset($option_settings['sub_menu_hover_color']) ? $option_settings['sub_menu_hover_color'] : '#fafafa' }}">
                    <label for="sub_menu_hover_color">{{ translate('Select Color') }}</label>
                </div>
                <div class="d-flex align-items-center">
                    <label class="custom-checkbox position-relative ml-2 mr-1">
                        <input type="hidden" name="sub_menu_hover_color_transparent" value="0">
                        <input type="checkbox"
                            {{ isset($option_settings['sub_menu_hover_color_transparent']) && $option_settings['sub_menu_hover_color_transparent'] == 1 ? 'checked' : '' }}
                            name="sub_menu_hover_color_transparent" id="sub_menu_hover_color_transparent"
                            value="1">
                        <span class="checkmark"></span>
                    </label>
                    <label class="black font-16"
                        for="sub_menu_hover_color_transparent">{{ translate('Transparent') }}</label>
                </div>
            </div>
        </div>
    </div>
    {{-- Sub Menu Hover Color Field End --}}

    {{-- Sub Menu Active Item Color Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4">
            <label class="font-16 bold black">{{ translate('Sub Menu Active Item Color') }}
            </label>
            <span class="d-block">{{ translate('Set header Sub menu Active Item color.') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <div class="row ml-2">
                <div class="color">
                    <input type="text" class="form-control" name="sub_menu_active_item_color"
                        value="{{ isset($option_settings['sub_menu_active_item_color']) ? $option_settings['sub_menu_active_item_color'] : '' }}">

                    <input type="color" class=""
                        id="sub_menu_active_item_color"value="{{ isset($option_settings['sub_menu_active_item_color']) ? $option_settings['sub_menu_active_item_color'] : '#fafafa' }}">
                    <label for="sub_menu_active_item_color">{{ translate('Select Color') }}</label>
                </div>
                <div class="d-flex align-items-center">
                    <label class="custom-checkbox position-relative ml-2 mr-1">
                        <input type="hidden" name="sub_menu_active_item_color_transparent" value="0">
                        <input type="checkbox"
                            {{ isset($option_settings['sub_menu_active_item_color_transparent']) && $option_settings['sub_menu_active_item_color_transparent'] == 1 ? 'checked' : '' }}
                            name="sub_menu_active_item_color_transparent" id="sub_menu_active_item_color_transparent"
                            value="1">
                        <span class="checkmark"></span>
                    </label>
                    <label class="black font-16"
                        for="sub_menu_active_item_color_transparent">{{ translate('Transparent') }}</label>
                </div>
            </div>
        </div>
    </div>
    {{-- Sub Menu Active Item Color Field End --}}
</div>
{{-- Custome Menu Switch On Field End --}}
