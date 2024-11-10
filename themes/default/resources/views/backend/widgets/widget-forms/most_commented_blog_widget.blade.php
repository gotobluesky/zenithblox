@php
    $widget_title = isset($value) && isset($value['widget_title']) ? $value['widget_title'] : '';
    $per_slide_number = isset($value) && isset($value['per_slide_number']) ? $value['per_slide_number']:'';
    $total_blog_number = isset($value) && isset($value['total_blog_number']) ? $value['total_blog_number']:'';
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
                            href="javascript:void(0)"
                            onclick="getSidebarWidgetTranslationField(this,{{ $sidebar_has_widget_id }},{{ $widget_id }},'{{ $language->code }}')">
                            <img src="{{ asset('/public/flags/') . '/' . $language->code . '.png' }}" width="20px"
                                title="{{ $language->name }}">
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

    <div class="form-group @if (!empty($lang) && $lang != getDefaultLang()) area-disabled @endif">
        <label for="per_slide_number">{{ translate('Per Slide Number') }}</label>
        <input type="number" min="1" step="1" required class="form-control" id="per_slide_number" name="per_slide_number"
            placeholder="{{ translate('Per Slide Number') }}" value="{{ $per_slide_number }}"
            @if (!empty($lang) && $lang != getDefaultLang()) disabled @endif>
    </div>

    <div class="form-group @if (!empty($lang) && $lang != getDefaultLang()) area-disabled @endif">
        <label for="total_blog_number">{{ translate('Total Blog Number') }}</label>
        <input type="number" min="1" step="1" required class="form-control" id="total_blog_number" name="total_blog_number"
            placeholder="{{ translate('Total Blog Number') }}" value="{{ $total_blog_number }}"
            @if (!empty($lang) && $lang != getDefaultLang()) disabled @endif>
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
