{{-- Blog Header --}}
<h3 class="black mb-3">{{ translate('Contact') }}</h3>
<input type="hidden" name="option_name" value="contact">

{{-- Default Or Custom Back To Top Button Switch Start --}}
<div class="form-group row py-3 border-bottom">
    <div class="col-xl-4">
        <label class="font-16 bold black">{{ translate('Custom Contact Page Style') }}
        </label>
        <span class="d-block">{{ translate('set custom contact page style.') }}</span>
    </div>
    <div class="col-xl-6 offset-xl-1">
        <label class="switch success">
            <input type="hidden" name="custom_contact_style" value="0">
            <input type="checkbox"
                {{ isset($option_settings['custom_contact_style']) && $option_settings['custom_contact_style'] == 1 ? 'checked' : '' }}
                name="custom_contact_style" id="custom_contact_style" value="1">
            <span class="control" id="custom_contact_style_switch">
                <span class="switch-off">{{ translate('Default') }}</span>
                <span class="switch-on">{{ translate('Custom') }}</span>
            </span>
        </label>
    </div>
</div>
{{-- Default Or Custom Back To Top Button Switch End --}}

{{-- Custom Blog Style Switch on Field Start --}}
<div id="custom_contact_style_switch_on_field">

    {{-- Contact Image Field Show/Hide Switch Start --}}
    <div class="form-group row py-3 border-bottom">
        <div class="col-xl-4">
            <label class="font-16 bold black">{{ translate('Contact Image') }}
            </label>
            <span class="d-block">{{ translate('show/hide contact page image') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <label class="switch success">
                <input type="hidden" name="contact_image_show" value="0">
                <input type="checkbox"
                    {{ isset($option_settings['contact_image_show']) && $option_settings['contact_image_show'] == 1 ? 'checked' : '' }}
                    name="contact_image_show" id="contact_image_show" value="1">
                <span class="control" id="contact_image_show_switch">
                    <span class="switch-off">{{ translate('Hide') }}</span>
                    <span class="switch-on">{{ translate('Show') }}</span>
                </span>
            </label>
        </div>
    </div>
    {{-- Contact Image Field Show/Hide Switch End --}}

    {{-- Contact Image Setting Switch Start --}}
    <div class="form-group row py-3 border-bottom" id="contact_image_show_switch_on_field">
        <div class="col-xl-4">
            <label class="font-16 bold black">{{ translate('Custom Contact Image') }}
            </label>
            <span class="d-block">{{ translate('set custom contact image') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            @include('core::base.includes.media.media_input', [
                'input' => 'custom_contact_image',
                'data' => isset($option_settings['custom_contact_image'])
                    ? $option_settings['custom_contact_image']
                    : null,
            ])
        </div>
    </div>
    {{-- Contact Image Setting Switch End --}}

    {{-- Title Field Start --}}
    <div class="form-group row py-3 border-bottom">
        <div class="col-xl-4">
            <label for="contact_title" class="font-16 bold black">{{ translate('Conatct Title') }}
            </label>
            <span class="d-block">{{ translate('set title for contact page') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <input type="text" name="contact_title" id="contact_title" class="form-control"
                value="{{ isset($option_settings['contact_title']) ? $option_settings['contact_title'] : '' }}"
                placeholder="{{ translate('Contact Title') }}">
            <small>{{ translate('Transalate to another language') }} <a
                    href="{{ route('core.languages') }}">{{ translate('click here') }}.</a></small>
        </div>
    </div>
    {{-- Title Field End --}}

    {{-- Subtitle Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4">
            <label for="contact_subtitle" class="font-16 bold black">{{ translate('Conatct Subtitle') }}
            </label>
            <span class="d-block">{{ translate('set subtitle for contact page') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <textarea class="theme-input-style style--seven" name="contact_subtitle" id="contact_subtitle"
                placeholder="{{ translate('Conatct Subtitle') }}">{{ isset($option_settings['contact_subtitle']) ? $option_settings['contact_subtitle'] : '' }}</textarea>
            <small>{{ translate('Transalate to another language') }} <a
                    href="{{ route('core.languages') }}">{{ translate('click here') }}.</a></small>
        </div>
    </div>
    {{-- Subtitle Field End --}}

    {{-- Name Field Start --}}
    <div class="form-group row py-3 border-bottom">
        <div class="col-xl-4">
            <label for="contact_name_placeholder"
                class="font-16 bold black">{{ translate('Contact Name Placeholder') }}
            </label>
            <span class="d-block">{{ translate('set placeholder for contact form name') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <input type="text" name="contact_name_placeholder" id="contact_name_placeholder" class="form-control"
                value="{{ isset($option_settings['contact_name_placeholder']) ? $option_settings['contact_name_placeholder'] : '' }}"
                placeholder="{{ translate('Contact Name Placeholder') }}">
            <small>{{ translate('Transalate to another language') }} <a
                    href="{{ route('core.languages') }}">{{ translate('click here') }}.</a></small>
        </div>
    </div>
    {{-- Name Field End --}}

    {{-- Email Field Start --}}
    <div class="form-group row py-3 border-bottom">
        <div class="col-xl-4">
            <label for="contact_email_placeholder"
                class="font-16 bold black">{{ translate('Contact Email Placeholder') }}
            </label>
            <span class="d-block">{{ translate('set placeholder for contact form email') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <input type="text" name="contact_email_placeholder" id="contact_email_placeholder" class="form-control"
                value="{{ isset($option_settings['contact_email_placeholder']) ? $option_settings['contact_email_placeholder'] : '' }}"
                placeholder="{{ translate('Contact Email Placeholder') }}">
            <small>{{ translate('Transalate to another language') }} <a
                    href="{{ route('core.languages') }}">{{ translate('click here') }}.</a></small>
        </div>
    </div>
    {{-- Email Field End --}}

    {{-- Subject Field Start --}}
    <div class="form-group row py-3 border-bottom">
        <div class="col-xl-4">
            <label for="contact_subject_placeholder"
                class="font-16 bold black">{{ translate('Contact Subject Placeholder') }}
            </label>
            <span class="d-block">{{ translate('set placeholder for contact form subject') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <input type="text" name="contact_subject_placeholder" id="contact_subject_placeholder"
                class="form-control"
                value="{{ isset($option_settings['contact_subject_placeholder']) ? $option_settings['contact_subject_placeholder'] : '' }}"
                placeholder="{{ translate('Contact Subject Placeholder') }}">
            <small>{{ translate('Transalate to another language') }} <a
                    href="{{ route('core.languages') }}">{{ translate('click here') }}.</a></small>
        </div>
    </div>
    {{-- Subject Field End --}}

    {{-- Message Field Start --}}
    <div class="form-group row py-3 border-bottom">
        <div class="col-xl-4">
            <label for="contact_message_placeholder"
                class="font-16 bold black">{{ translate('Contact Message Placeholder') }}
            </label>
            <span class="d-block">{{ translate('set placeholder for message form subject') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <input type="text" name="contact_message_placeholder" id="contact_message_placeholder"
                class="form-control"
                value="{{ isset($option_settings['contact_message_placeholder']) ? $option_settings['contact_message_placeholder'] : '' }}"
                placeholder="{{ translate('Contact Message Placeholder') }}">
            <small>{{ translate('Transalate to another language') }} <a
                    href="{{ route('core.languages') }}">{{ translate('click here') }}.</a></small>
        </div>
    </div>
    {{-- Message Field End --}}

    {{-- Message Field Start --}}
    <div class="form-group row py-3 border-bottom">
        <div class="col-xl-4">
            <label for="contact_button_text" class="font-16 bold black">{{ translate('Contact Submit Button Text') }}
            </label>
            <span class="d-block">{{ translate('set contact form buton text') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <input type="text" name="contact_button_text" id="contact_button_text" class="form-control"
                value="{{ isset($option_settings['contact_button_text']) ? $option_settings['contact_button_text'] : '' }}"
                placeholder="{{ translate('Contact Submit Button Textr') }}">
            <small>{{ translate('Transalate to another language') }} <a
                    href="{{ route('core.languages') }}">{{ translate('click here') }}.</a></small>
        </div>
    </div>
    {{-- Message Field End --}}

</div>
{{-- Custom Blog Style Switch on Field End --}}

{{-- Contact In Header Menu Switch Start --}}
<div class="form-group row py-3 border-bottom">
    <div class="col-xl-4">
        <label class="font-16 bold black">{{ translate('Contact In Header Menu') }}
        </label>
        <span class="d-block">{{ translate('show/hide contact link in header menu') }}</span>
    </div>
    <div class="col-xl-6 offset-xl-1">
        <label class="switch success">
            <input type="hidden" name="contact_header_menu" value="0">
            <input type="checkbox"
                {{ isset($option_settings['contact_header_menu']) && $option_settings['contact_header_menu'] == 1 ? 'checked' : '' }}
                name="contact_header_menu" id="contact_header_menu" value="1">
            <span class="control" id="contact_header_menu_switch">
                <span class="switch-off">{{ translate('Hide') }}</span>
                <span class="switch-on">{{ translate('Show') }}</span>
            </span>
        </label>
    </div>
</div>
{{-- Contact In Header Menu Switch End --}}

{{-- Contact In Header Menu Text Switch Start --}}
<div class="form-group row py-3 border-bottom" id="contact_header_menu_switch_on_field">
    <div class="col-xl-4">
        <label class="font-16 bold black">{{ translate('Contact In Header Menu Text') }}
        </label>
        <span class="d-block">{{ translate('set text for contact in header menu. if no text is set default "Contact" will be placed') }}</span>
    </div>
    <div class="col-xl-6 offset-xl-1">
        <input type="text" name="contact_header_text" id="contact_header_text" class="form-control"
            value="{{ isset($option_settings['contact_header_text']) ? $option_settings['contact_header_text'] : '' }}"
            placeholder="{{ translate('Contact Header Text') }}">
        <small>{{ translate('Transalate to another language') }} <a
                href="{{ route('core.languages') }}">{{ translate('click here') }}.</a></small>
    </div>
</div>
{{-- Contact In Header Menu Text Switch End --}}

{{-- Contact Email Will Be Sent Field Start --}}
<div class="form-group row py-3 border-bottom">
    <div class="col-xl-4">
        <label for="contact_sent_email" class="font-16 bold black">{{ translate('Contact Email Will Be Sent') }}
        </label>
        <span class="d-block">{{ translate('set where will be the contact email will be sent') }}</span>
    </div>
    <div class="col-xl-6 offset-xl-1">
        <input type="emain" name="contact_sent_email" id="contact_sent_email" class="form-control"
            value="{{ isset($option_settings['contact_sent_email']) ? $option_settings['contact_sent_email'] : '' }}"
            placeholder="{{ translate('Email') }}">
    </div>
</div>
{{-- Contact Email Will Be Sent Field End --}}
