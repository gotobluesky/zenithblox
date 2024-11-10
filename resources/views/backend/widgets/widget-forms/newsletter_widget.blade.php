@php
    $widget_title = isset($value) && isset($value['widget_title']) ? $value['widget_title'] : '';
    $newsletter_short_desc = isset($value) && isset($value['newsletter_short_desc']) ? $value['newsletter_short_desc']:'';
    $email_placeholder = isset($value) && isset($value['email_placeholder']) ? $value['email_placeholder']:'';
    $button_text = isset($value) && isset($value['button_text']) ? $value['button_text']:'';
@endphp
<form action="#" class=" widget_input_field_form px-3 py-3 bg-white"
    onsubmit="event.preventDefault(); widgetInputFormSubmit(this);">
    {{-- Translated Language --}}
    <div class="row mb-3">
        <div class="col-12">
            <ul class="nav nav-tabs nav-fill border-light border-0">
                @php
                   $languages = getAllLanguages();
                @endphp
                @foreach ($languages as $key => $language)
                    <li class="nav-item">
                        <a class="nav-link @if ($language->code == $lang) active border-0 @else bg-light @endif py-2"
                            href="javascript:void(0)" onclick="getSidebarWidgetTranslationField(this,{{ $sidebar_has_widget_id }},{{ $widget_id }},'{{ $language->code }}')">
                            <img src="{{ asset('/public/flags/') . '/' . $language->code . '.png' }}" width="20px" title="{{ $language->name }}">
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <input type="hidden" name="lang" value="{{ $lang }}">
    {{-- Translated Language --}}
    <div class="form-group">
        <label for="widget_title" class="">{{ translate('Widget Title') }}</label>
        <input type="text" class="form-control" id="widget_title" name="widget_title"
            placeholder="{{ translate('Widget Title') }}" value="{{ $widget_title }}">
    </div>

    <div class="form-group">
        <label for="newsletter_short_desc">{{ translate('Newsletter Short Desc') }}</label>
        <textarea id="newsletter_short_desc" name="newsletter_short_desc"
            class="theme-input-style style--two" placeholder="{{ translate('Newsletter Short Desc') }}">{{ $newsletter_short_desc }}</textarea>
    </div>

    <div class="form-group">
        <label for="email_placeholder" class="">{{ translate('Email Placeholder') }}</label>
        <input type="text" class="form-control" id="email_placeholder" name="email_placeholder"
            placeholder="{{ translate('Email Placeholder') }}" value="{{ $email_placeholder }}">
    </div>

    <div class="form-group">
        <label for="button_text" class="">{{ translate('Button Text') }}</label>
        <input type="text" class="form-control" id="button_text" name="button_text"
            placeholder="{{ translate('Button Text') }}" value="{{ $button_text }}">
    </div>

    <div class="px-3 row justify-content-between">
        <div>
            <a href="javascript:;void(0)" class="text-danger"
                onclick="removeFromSidebar(this)">{{ translate('Delete') }}</a>
            <span class="mx-1">|</span>
            <a href="javascript:;void(0)" class="text-info"
                onclick="closeSidebarDropMenu(this)">{{ translate('Done') }}</a>
        </div>
        <button type="submit" class="btn btn-primary sm">{{ translate('Save') }}</button>
    </div>
</form>
