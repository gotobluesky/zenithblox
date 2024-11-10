@php
    $pages = getPage([['tl_pages.publish_status', '=', config('default.page_status.publish')], ['tl_pages.publish_at', '<', currentDateTime()]]);
@endphp
{{-- Subscribe Header --}}
<h3 class="black mb-3">{{ translate('Subscribe') }}</h3>
<input type="hidden" name="option_name" value="subscribe">

{{-- Mailchimp API Key Field Start --}}
<div class="form-group row py-4 border-bottom">
    <div class="col-xl-4">
        <label for="mailchimp_api_key" class="font-16 bold black">{{ translate('Mailchimp API Key') }}
        </label>
        <span class="d-block">{{ translate('Set mailchimp api key') }}</span>
    </div>
    <div class="col-xl-6 offset-xl-1">
        <input type="text" name="mailchimp_api_key" id="mailchimp_api_key" class="form-control"
            value="{{ isset($option_settings['mailchimp_api_key']) ? $option_settings['mailchimp_api_key'] : '' }}">
    </div>
</div>
{{-- Mailchimp API Key Field End --}}

{{-- Mailchimp List ID Field Start --}}
<div class="form-group row py-4 border-bottom">
    <div class="col-xl-4">
        <label for="mailchimp_list_id" class="font-16 bold black">{{ translate('Mailchimp List ID') }}
        </label>
        <span class="d-block">{{ translate('Set mailchimp list id.') }}</span>
    </div>
    <div class="col-xl-6 offset-xl-1">
        <input type="text" name="mailchimp_list_id" id="mailchimp_list_id" class="form-control"
            value="{{ isset($option_settings['mailchimp_list_id']) ? $option_settings['mailchimp_list_id'] : '' }}">
    </div>
</div>
{{-- Mailchimp List ID Field End --}}

{{-- Footer Subscribe Form Enable/Disable Field Start --}}
<div class="form-group row py-4 border-bottom">
    <div class="col-xl-4">
        <label class="font-16 bold black">{{ translate('Footer Subscribe Form') }}
        </label>
        <span class="d-block">{{ translate('Set Enable to display Subscribe form in footer.') }}</span>
    </div>
    <div class="col-xl-6 offset-xl-1">
        <label class="switch success">
            <input type="hidden" name="footer_subscribe_form" value="0">
            <input type="checkbox"
                {{ isset($option_settings['footer_subscribe_form']) && $option_settings['footer_subscribe_form'] == 1 ? 'checked' : '' }}
                name="footer_subscribe_form" id="footer_subscribe_form" value="1">
            <span class="control" id="footer_subscribe_form_switch">
                <span class="switch-off">{{ translate('Disable') }}</span>
                <span class="switch-on">{{ translate('Enable') }}</span>
            </span>
        </label>
    </div>
</div>
{{-- Footer Subscribe Form Enable/Disable Field End --}}

{{-- Footer Subscribe Form Enable Field Start --}}
<div id="footer_subscribe_form_switch_on_field">
    {{-- Form Title Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4">
            <label for="subscribe_form_title" class="font-16 bold black">{{ translate('Form Title') }}
            </label>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <input type="text" class="form-control" name="subscribe_form_title" id="subscribe_form_title"
                value="{{ isset($option_settings['subscribe_form_title']) ? $option_settings['subscribe_form_title'] : '' }}">
                <small>{{ translate('Transalate to another language') }} <a
                    href="{{ route('core.languages') }}">{{ translate('click here') }}.</a></small>
        </div>
    </div>
    {{-- Form Title Field End --}}

    {{-- Form Placeholder Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4">
            <label for="subscribe_form_placeholder" class="font-16 bold black">{{ translate('Form Placeholder') }}
            </label>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <input type="text" class="form-control" name="subscribe_form_placeholder" id="subscribe_form_placeholder"
                value="{{ isset($option_settings['subscribe_form_placeholder']) ? $option_settings['subscribe_form_placeholder'] : '' }}">
                <small>{{ translate('Transalate to another language') }} <a
                    href="{{ route('core.languages') }}">{{ translate('click here') }}.</a></small>
        </div>
    </div>
    {{-- Form Placeholder Field End --}}

    {{-- Form Button Text Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4">
            <label for="subscribe_form_button_text" class="font-16 bold black">{{ translate('Form Button Text') }}
            </label>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <input type="text" class="form-control" name="subscribe_form_button_text" id="subscribe_form_button_text"
                value="{{ isset($option_settings['subscribe_form_button_text']) ? $option_settings['subscribe_form_button_text'] : '' }}">
                <small>{{ translate('Transalate to another language') }} <a
                    href="{{ route('core.languages') }}">{{ translate('click here') }}.</a></small>
        </div>
    </div>
    {{-- Form Button Text Field End --}}

    {{-- Privacy Policy Enable/Disable Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4">
            <label class="font-16 bold black">{{ translate('Privacy Policy') }}
            </label>
            <span class="d-block">{{ translate('Set Enable to display Privacy Policy Button.') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <label class="switch success">
                <input type="hidden" name="privacy_policy" value="0">
                <input type="checkbox"
                    {{ isset($option_settings['privacy_policy']) && $option_settings['privacy_policy'] == 1 ? 'checked' : '' }}
                    name="privacy_policy" id="privacy_policy" value="1">
                <span class="control" id="privacy_policy_switch">
                    <span class="switch-off">{{ translate('Disable') }}</span>
                    <span class="switch-on">{{ translate('Enable') }}</span>
                </span>
            </label>
        </div>
    </div>
    {{-- Privacy Policy Enable/Disable Field End --}}

    {{-- Privacy Policy Enable Field Start --}}
    <div id="privacy_policy_switch_on_field">
        {{-- Privacy Policy Page Select Field Start --}}
        <div class="form-group row py-4 border-bottom">
            <div class="col-xl-4">
                <label class="font-16 bold black">{{ translate('Privacy Policy Page') }}
                </label>
                <span class="d-block">{{ translate('Select Privacy Policy Page.') }}</span>
            </div>
            <div class="col-xl-6 offset-xl-1">
                <select class="form-control select" name="privacy_policy_page" id="privacy_policy_page">
                    @foreach ($pages as $item)
                        <option value="{{ $item->id }}"
                            {{ isset($option_settings['privacy_policy_page']) && $option_settings['privacy_policy_page'] == $item->id ? 'selected' : '' }}>
                            {{ $item->translation('title', getLocale()) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        {{-- Privacy Policy Page Select Field End --}}
    </div>
    {{-- Privacy Policy Enable Field End --}}


    {{-- Custom Footer Subscribe Style Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4">
            <label class="font-16 bold black">{{ translate('Custom Footer Subscribe Style') }}
            </label>
            <span class="d-block">{{ translate('Set custom footer subscribe style') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <label class="switch success">
                <input type="hidden" name="custom_footer_subscribe" value="0">
                <input type="checkbox"
                    {{ isset($option_settings['custom_footer_subscribe']) && $option_settings['custom_footer_subscribe'] == 1 ? 'checked' : '' }}
                    name="custom_footer_subscribe" id="custom_footer_subscribe" value="1">
                <span class="control" id="custom_footer_subscribe_switch">
                    <span class="switch-off">{{ translate('Disable') }}</span>
                    <span class="switch-on">{{ translate('Enable') }}</span>
                </span>
            </label>
        </div>
    </div>
    {{-- Custom Footer Subscribe Style Field End --}}

    {{-- Custom Footer Subscribe Switch On Field Start --}}
    <div id="custom_footer_subscribe_switch_on_field">
        {{-- Form Privacy Text Color Field Start --}}
        <div class="form-group row py-4 border-bottom">
            <div class="col-xl-4">
                <label class="font-16 bold black">{{ translate('Form Privacy Text Color') }}
                </label>
                <span class="d-block">{{ translate('If privacy policy switch is enabled') }}</span>
            </div>
            <div class="col-xl-6 offset-xl-1">
                <div class="row ml-2">
                    <div class="color">
                        <input type="text" class="form-control" name="form_privacy_text_color"
                            value="{{ isset($option_settings['form_privacy_text_color']) ? $option_settings['form_privacy_text_color'] : '' }}">

                        <input type="color" class="" id="form_privacy_text_color"
                            value="{{ isset($option_settings['form_privacy_text_color']) ? $option_settings['form_privacy_text_color'] : '#fafafa' }}">
                        <label for="form_privacy_text_color">{{ translate('Select Color') }}</label>
                    </div>
                    <div class="d-flex align-items-center">
                        <label class="custom-checkbox position-relative ml-2 mr-1">
                            <input type="hidden" name="form_privacy_text_color_transparent" value="0">
                            <input type="checkbox"
                                {{ isset($option_settings['form_privacy_text_color_transparent']) && $option_settings['form_privacy_text_color_transparent'] == 1 ? 'checked' : '' }}
                                name="form_privacy_text_color_transparent" id="form_privacy_text_color_transparent"
                                value="1">
                            <span class="checkmark"></span>
                        </label>
                        <label class="black font-16"
                            for="form_privacy_text_color_transparent">{{ translate('Transparent') }}</label>
                    </div>
                </div>
            </div>
        </div>
        {{-- Form Privacy Text Color Field End --}}

        {{-- Form Privacy Text Anchor Color Field Start --}}
        <div class="form-group row py-4 border-bottom">
            <div class="col-xl-4">
                <label class="font-16 bold black">{{ translate('Form Privacy Text Anchor Color') }}
                </label>
                <span class="d-block">{{ translate('If privacy policy switch is enabled') }}</span>
            </div>
            <div class="col-xl-6 offset-xl-1">
                <div class="row ml-2">
                    <div class="color">
                        <input type="text" class="form-control" name="form_privacy_text_anchor_color"
                            value="{{ isset($option_settings['form_privacy_text_anchor_color']) ? $option_settings['form_privacy_text_anchor_color'] : '' }}">

                        <input type="color" class="" id="form_privacy_text_anchor_color"
                            value="{{ isset($option_settings['form_privacy_text_anchor_color']) ? $option_settings['form_privacy_text_anchor_color'] : '#fafafa' }}">

                        <label for="form_privacy_text_anchor_color">{{ translate('Select Color') }}</label>
                    </div>
                    <div class="d-flex align-items-center">
                        <label class="custom-checkbox position-relative ml-2 mr-1">
                            <input type="hidden" name="form_privacy_text_anchor_color_transparent" value="0">
                            <input type="checkbox"
                                {{ isset($option_settings['form_privacy_text_anchor_color_transparent']) && $option_settings['form_privacy_text_anchor_color_transparent'] == 1 ? 'checked' : '' }}
                                name="form_privacy_text_anchor_color_transparent"
                                id="form_privacy_text_anchor_color_transparent" value="1">
                            <span class="checkmark"></span>
                        </label>
                        <label class="black font-16"
                            for="form_privacy_text_anchor_color_transparent">{{ translate('Transparent') }}</label>
                    </div>
                </div>
            </div>
        </div>
        {{-- Form Privacy Text Anchor Color Field End --}}

        {{-- Form Background Color Field Start --}}
        <div class="form-group row py-4 border-bottom">
            <div class="col-xl-4">
                <label class="font-16 bold black">{{ translate('Form Background Color') }}
                </label>
            </div>
            <div class="col-xl-6 offset-xl-1">
                <div class="row ml-2">
                    <div class="color">
                        <input type="text" class="form-control" name="form_bg_color"
                            value="{{ isset($option_settings['form_bg_color']) ? $option_settings['form_bg_color'] : '' }}">

                        <input type="color" class="" id="form_bg_color"
                            value="{{ isset($option_settings['form_bg_color']) ? $option_settings['form_bg_color'] : '#fafafa' }}">
                        <label for="form_bg_color">{{ translate('Select Color') }}</label>
                    </div>
                    <div class="d-flex align-items-center">
                        <label class="custom-checkbox position-relative ml-2 mr-1">
                            <input type="hidden" name="form_bg_color_transparent" value="0">
                            <input type="checkbox"
                                {{ isset($option_settings['form_bg_color_transparent']) && $option_settings['form_bg_color_transparent'] == 1 ? 'checked' : '' }}
                                name="form_bg_color_transparent" id="form_bg_color_transparent" value="1">
                            <span class="checkmark"></span>
                        </label>
                        <label class="black font-16"
                            for="form_bg_color_transparent">{{ translate('Transparent') }}</label>
                    </div>
                </div>
            </div>
        </div>
        {{-- Form Background Color Field End --}}

        {{-- Form Title Color Field Start --}}
        <div class="form-group row py-4 border-bottom">
            <div class="col-xl-4">
                <label class="font-16 bold black">{{ translate('Form Title Color') }}
                </label>
            </div>
            <div class="col-xl-6 offset-xl-1">
                <div class="row ml-2">
                    <div class="color">
                        <input type="text" class="form-control" name="form_title_color"
                            value="{{ isset($option_settings['form_title_color']) ? $option_settings['form_title_color'] : '' }}">

                        <input type="color" class="" id="form_title_color"
                            value="{{ isset($option_settings['form_title_color']) ? $option_settings['form_title_color'] : '#fafafa' }}">
                        <label for="form_title_color">{{ translate('Select Color') }}</label>
                    </div>
                    <div class="d-flex align-items-center">
                        <label class="custom-checkbox position-relative ml-2 mr-1">
                            <input type="hidden" name="form_title_color_transparent" value="0">
                            <input type="checkbox"
                                {{ isset($option_settings['form_title_color_transparent']) && $option_settings['form_title_color_transparent'] == 1 ? 'checked' : '' }}
                                name="form_title_color_transparent" id="form_title_color_transparent" value="1">
                            <span class="checkmark"></span>
                        </label>
                        <label class="black font-16"
                            for="form_title_color_transparent">{{ translate('Transparent') }}</label>
                    </div>
                </div>
            </div>
        </div>
        {{-- Form Title Color Field End --}}

        {{-- Form Input Color Field Start --}}
        <div class="form-group row py-4 border-bottom">
            <div class="col-xl-4">
                <label class="font-16 bold black">{{ translate('Form Input Background Color') }}
                </label>
            </div>
            <div class="col-xl-6 offset-xl-1">
                <div class="row ml-2">
                    <div class="color">
                        <input type="text" class="form-control" name="form_input_color"
                            value="{{ isset($option_settings['form_input_color']) ? $option_settings['form_input_color'] : '' }}">

                        <input type="color" class="" id="form_input_color"
                            value="{{ isset($option_settings['form_input_color']) ? $option_settings['form_input_color'] : '#fafafa' }}">
                        <label for="form_input_color">{{ translate('Select Color') }}</label>
                    </div>
                    <div class="d-flex align-items-center">
                        <label class="custom-checkbox position-relative ml-2 mr-1">
                            <input type="hidden" name="form_input_color_transparent" value="0">
                            <input type="checkbox"
                                {{ isset($option_settings['form_input_color_transparent']) && $option_settings['form_input_color_transparent'] == 1 ? 'checked' : '' }}
                                name="form_input_color_transparent" id="form_input_color_transparent" value="1">
                            <span class="checkmark"></span>
                        </label>
                        <label class="black font-16"
                            for="form_input_color_transparent">{{ translate('Transparent') }}</label>
                    </div>
                </div>
            </div>
        </div>
        {{-- Form Input Color Field End --}}

        {{-- Form Submit Button Color Field Start --}}
        <div class="form-group row py-4 border-bottom">
            <div class="col-xl-4">
                <label class="font-16 bold black">{{ translate('Form Submit Button Color') }}
                </label>
            </div>
            <div class="col-xl-6 offset-xl-1">
                <div class="row ml-2">
                    <div class="color">
                        <input type="text" class="form-control" name="form_submit_button_color"
                            value="{{ isset($option_settings['form_submit_button_color']) ? $option_settings['form_submit_button_color'] : '' }}">

                        <input type="color" class="" id="form_submit_button_color"
                            value="{{ isset($option_settings['form_submit_button_color']) ? $option_settings['form_submit_button_color'] : '#fafafa' }}">
                        <label for="form_submit_button_color">{{ translate('Select Color') }}</label>
                    </div>
                    <div class="d-flex align-items-center">
                        <label class="custom-checkbox position-relative ml-2 mr-1">
                            <input type="hidden" name="form_submit_button_color_transparent" value="0">
                            <input type="checkbox"
                                {{ isset($option_settings['form_submit_button_color_transparent']) && $option_settings['form_submit_button_color_transparent'] == 1 ? 'checked' : '' }}
                                name="form_submit_button_color_transparent" id="form_submit_button_color_transparent"
                                value="1">
                            <span class="checkmark"></span>
                        </label>
                        <label class="black font-16"
                            for="form_submit_button_color_transparent">{{ translate('Transparent') }}</label>
                    </div>
                </div>
            </div>
        </div>
        {{-- Form Submit Button Color Field End --}}

        {{-- Form Submit Button Background Color Field Start --}}
        <div class="form-group row py-4 border-bottom">
            <div class="col-xl-4">
                <label class="font-16 bold black">{{ translate('Form Submit Button Background Color') }}
                </label>
            </div>
            <div class="col-xl-6 offset-xl-1">
                <div class="row ml-2">
                    <div class="color">
                        <input type="text" class="form-control"name="form_submit_button_bg_color"
                            value="{{ isset($option_settings['form_submit_button_bg_color']) ? $option_settings['form_submit_button_bg_color'] : '' }}">

                        <input type="color" class="" id="form_submit_button_bg_color"
                            value="{{ isset($option_settings['form_submit_button_bg_color']) ? $option_settings['form_submit_button_bg_color'] : '#fafafa' }}">
                        <label for="form_submit_button_bg_color">{{ translate('Select Color') }}</label>
                    </div>
                    <div class="d-flex align-items-center">
                        <label class="custom-checkbox position-relative ml-2 mr-1">
                            <input type="hidden" name="form_submit_button_bg_color_transparent" value="0">
                            <input type="checkbox"
                                {{ isset($option_settings['form_submit_button_bg_color_transparent']) && $option_settings['form_submit_button_bg_color_transparent'] == 1 ? 'checked' : '' }}
                                name="form_submit_button_bg_color_transparent"
                                id="form_submit_button_bg_color_transparent" value="1">
                            <span class="checkmark"></span>
                        </label>
                        <label class="black font-16"
                            for="form_submit_button_bg_color_transparent">{{ translate('Transparent') }}</label>
                    </div>
                </div>
            </div>
        </div>
        {{-- Form Submit Button Background Color Field End --}}
    </div>
    {{-- Custom Footer Subscribe Switch On Field End --}}
</div>
{{-- Footer Subscribe Form Enable Field End --}}
