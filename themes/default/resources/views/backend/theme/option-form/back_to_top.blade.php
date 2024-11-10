{{-- Back To Top Header --}}
<h3 class="black mb-3">{{ translate('Back To Top') }}</h3>
<input type="hidden" name="option_name" value="back_to_top">

{{-- Back To Top Button Switch Start --}}
<div class="form-group row py-4 border-bottom">
    <div class="col-xl-4">
        <label class="font-16 bold black">{{ translate('Back To Top Button') }}
        </label>
        <span class="d-block">{{ translate('Switch On to Display back to top button.') }}</span>
    </div>
    <div class="col-xl-6 offset-xl-1">
        <label class="switch success">
            <input type="hidden" name="back_to_top_button" value="0">
            <input type="checkbox"
                {{ isset($option_settings['back_to_top_button']) && $option_settings['back_to_top_button'] == 1 ? 'checked' : '' }}
                name="back_to_top_button" id="back_to_top_button" value="1">
            <span class="control" id="back_to_top_button_switch">
                <span class="switch-off">{{ translate('Disable') }}</span>
                <span class="switch-on">{{ translate('Enable') }}</span>
            </span>
        </label>
    </div>
</div>
{{-- Back To Top Button Switch End --}}

{{-- Back To Top Button Switch On Field Start --}}
<div class="" id="back_to_top_button_switch_on_field">
    {{-- Default Or Custom Back To Top Button Switch Start --}}
    <div class="form-group row py-3 border-bottom">
        <div class="col-xl-4">
            <label class="font-16 bold black">{{ translate('Custom Back To Top Button') }}
            </label>
            <span
                class="d-block">{{ translate('If you switch it off, it will show default design for "back to top" button.') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <label class="switch success">
                <input type="hidden" name="custom_back_to_top_button" value="0">
                <input type="checkbox"
                    {{ isset($option_settings['custom_back_to_top_button']) && $option_settings['custom_back_to_top_button'] == 1 ? 'checked' : '' }}
                    name="custom_back_to_top_button" id="custom_back_to_top_button" value="1">
                <span class="control" id="custom_back_to_top_button_switch">
                    <span class="switch-off">{{ translate('Default') }}</span>
                    <span class="switch-on">{{ translate('Custom') }}</span>
                </span>
            </label>
        </div>
    </div>
    {{-- Default Or Custom Back To Top Button Switch End --}}

    {{-- Custom Back To Top Styles Field Start --}}
    <div id="custom_back_to_top_button_switch_on_field">
        {{-- Custom Back To Top Button Icon Picker Start --}}
        <div class="form-group row py-3 border-bottom">
            <div class="col-xl-4">
                <label for="custom_back_to_top_button_icon"
                    class="font-16 bold black">{{ translate('Custom Back To Top Button Icon') }}
                </label>
                <span class="d-block">{{ translate('Select Back To Top Button icon.') }}</span>
            </div>
            <div class="col-xl-6 offset-xl-1">
                <input class="form-control icon-picker" name="custom_back_to_top_button_icon"
                    value="{{ isset($option_settings['custom_back_to_top_button_icon']) ? $option_settings['custom_back_to_top_button_icon'] : '' }}"
                    type="text" />
            </div>
        </div>
        {{-- Custom Back To Top Button Icon Picker End --}}

        {{-- Back To Top Button Background Color Field Start --}}
        <div class="form-group row py-3 border-bottom">
            <div class="col-xl-4">
                <label class="font-16 bold black">{{ translate('Back To Top Button Background Color') }}
                </label>
                <span class="d-block">{{ translate('Set Back to top button Background Color.') }}</span>
            </div>
            <div class="col-xl-6 offset-xl-1">
                <div class="row ml-2">
                    <div class="color">
                        <input type="text" class="form-control" name="back_to_top_button_bgcolor" id=""
                            value="{{ isset($option_settings['back_to_top_button_bgcolor']) ? $option_settings['back_to_top_button_bgcolor'] : '' }}">

                        <input type="color" class="" id="back_to_top_button_bgcolor"
                            value="{{ isset($option_settings['back_to_top_button_bgcolor']) ? $option_settings['back_to_top_button_bgcolor'] : '#fafafa' }}">

                        <label for="back_to_top_button_bgcolor">{{ translate('Select Color') }}</label>
                    </div>
                    <div class="d-flex align-items-center">
                        <label class="custom-checkbox position-relative ml-2 mr-1">
                            <input type="hidden" name="back_to_top_button_bgcolor_transparent" value="0">
                            <input type="checkbox"
                                {{ isset($option_settings['back_to_top_button_bgcolor_transparent']) && $option_settings['back_to_top_button_bgcolor_transparent'] == 1 ? 'checked' : '' }}
                                name="back_to_top_button_bgcolor_transparent"
                                id="back_to_top_button_bgcolor_transparent" value="1">
                            <span class="checkmark"></span>
                        </label>
                        <label class="black font-16"
                            for="back_to_top_button_bgcolor_transparent">{{ translate('Transparent') }}</label>
                    </div>
                </div>
            </div>
        </div>
        {{-- Back To Top Button Background Color Field End  --}}

        {{-- Back To Top Button Color Field Start --}}
        <div class="form-group row py-3 border-bottom">
            <div class="col-xl-4">
                <label class="font-16 bold black">{{ translate('Back To Top Button Color') }}
                </label>
                <span class="d-block">{{ translate('Set Back to top button Color.') }}</span>
            </div>
            <div class="col-xl-6 offset-xl-1">
                <div class="row ml-2">
                    <div class="color">
                        <input type="text" class="form-control" name="back_to_top_button_color" id=""
                            value="{{ isset($option_settings['back_to_top_button_color']) ? $option_settings['back_to_top_button_color'] : '' }}">

                        <input type="color" id="back_to_top_button_color"
                            value="{{ isset($option_settings['back_to_top_button_color']) ? $option_settings['back_to_top_button_color'] : '#fafafa' }}">
                        <label for="back_to_top_button_color">{{ translate('Select Color') }}</label>
                    </div>
                    <div class="d-flex align-items-center">
                        <label class="custom-checkbox position-relative ml-2 mr-1">
                            <input type="hidden" class="" name="back_to_top_button_color_transparent"
                                value="0">
                            <input type="checkbox"
                                {{ isset($option_settings['back_to_top_button_color_transparent']) && $option_settings['back_to_top_button_color_transparent'] == 1 ? 'checked' : '' }}
                                class="" name="back_to_top_button_color_transparent"
                                id="back_to_top_button_color_transparent" value="1">
                            <span class="checkmark"></span>
                        </label>
                        <label class="black font-16"
                            for="back_to_top_button_color_transparent">{{ translate('Transparent') }}</label>
                    </div>
                </div>
            </div>
        </div>
        {{-- Back To Top Button Color Field End --}}

        {{-- Back To Top Button Hover Color Field Start --}}
        <div class="form-group row py-3 border-bottom">
            <div class="col-xl-4">
                <label class="font-16 bold black">{{ translate('Back To Top Hover Button Color') }}
                </label>
                <span class="d-block">{{ translate('Set Back to top button Color.') }}</span>
            </div>
            <div class="col-xl-6 offset-xl-1">
                <div class="row ml-2">
                    <div class="color">
                        <input type="text" class="form-control" name="back_to_top_button_hover_color"
                            value="{{ isset($option_settings['back_to_top_button_hover_color']) ? $option_settings['back_to_top_button_hover_color'] : '' }}">

                        <input type="color" class="" id="back_to_top_button_hover_color"
                            value="{{ isset($option_settings['back_to_top_button_hover_color']) ? $option_settings['back_to_top_button_hover_color'] : '#fafafa' }}">
                        <label for="back_to_top_button_hover_color">{{ translate('Select Color') }}</label>
                    </div>
                    <div class="d-flex align-items-center">
                        <label class="custom-checkbox position-relative ml-2 mr-1">
                            <input type="hidden" name="back_to_top_button_hover_color_transparent" value="0">
                            <input type="checkbox"
                                {{ isset($option_settings['back_to_top_button_hover_color_transparent']) && $option_settings['back_to_top_button_hover_color_transparent'] == 1 ? 'checked' : '' }}
                                name="back_to_top_button_hover_color_transparent"
                                id="back_to_top_button_hover_color_transparent" value="1">
                            <span class="checkmark"></span>
                        </label>
                        <label class="black font-16"
                            for="back_to_top_button_hover_color_transparent">{{ translate('Transparent') }}</label>
                    </div>
                </div>
            </div>
        </div>
        {{-- Back To Top Button Hover Color Field Start --}}

        {{-- Back To Top Button Hover Background Color Field Start --}}
        <div class="form-group row py-3 border-bottom">
            <div class="col-xl-4">
                <label class="font-16 bold black">{{ translate('Back To Top Button Hover Background Color') }}
                </label>
                <span class="d-block">{{ translate('Set Back to top button hover background Color.') }}</span>
            </div>
            <div class="col-xl-6 offset-xl-1">
                <div class="row ml-2">
                    <div class="color">
                        <input type="text" class="form-control" name="back_to_top_button_hover_bgcolor"
                            value="{{ isset($option_settings['back_to_top_button_hover_bgcolor']) ? $option_settings['back_to_top_button_hover_bgcolor'] : '' }}">

                        <input type="color" class="" id="back_to_top_button_hover_bgcolor"
                            value="{{ isset($option_settings['back_to_top_button_hover_bgcolor']) ? $option_settings['back_to_top_button_hover_bgcolor'] : '#fafafa' }}">

                        <label for="back_to_top_button_hover_bgcolor">{{ translate('Select Color') }}</label>
                    </div>
                    <div class="d-flex align-items-center">
                        <label class="custom-checkbox position-relative ml-2 mr-1">
                            <input type="hidden" name="back_to_top_button_hover_bgcolor_transparent" value="0">
                            <input type="checkbox"
                                {{ isset($option_settings['back_to_top_button_hover_bgcolor_transparent']) && $option_settings['back_to_top_button_hover_bgcolor_transparent'] == 1 ? 'checked' : '' }}
                                name="back_to_top_button_hover_bgcolor_transparent"
                                id="back_to_top_button_hover_bgcolor_transparent" value="1">
                            <span class="checkmark"></span>
                        </label>
                        <label class="black font-16"
                            for="back_to_top_button_hover_bgcolor_transparent">{{ translate('Transparent') }}</label>
                    </div>
                </div>
            </div>
        </div>
        {{-- Back To Top Button Hover Background Color Field End --}}
    </div>
    {{-- Custom Back To Top Styles Field End --}}

    {{-- Back To Top Button On Mobile Switch Start --}}
    <div class="form-group row py-3 border-bottom">
        <div class="col-xl-4">
            <label class="font-16 bold black">{{ translate('Keep Back To Top Button On Mobile') }}
            </label>
            <span class="d-block">{{ translate('If you switch it on, it will show in mobile devices..') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <label class="switch success">
                <input type="hidden" name="back_to_top_button_on_mobile" value="0">
                <input type="checkbox"
                    {{ isset($option_settings['back_to_top_button_on_mobile']) && $option_settings['back_to_top_button_on_mobile'] == 1 ? 'checked' : '' }}
                    name="back_to_top_button_on_mobile" id="back_to_top_button_on_mobile" value="1">
                <span class="control">
                    <span class="switch-off">{{ translate('Disable') }}</span>
                    <span class="switch-on">{{ translate('Enable') }}</span>
                </span>
            </label>
        </div>
    </div>
    {{-- Back To Top Button On Mobile Switch End --}}
</div>
{{-- Back To Top Button Switch On Field End --}}
