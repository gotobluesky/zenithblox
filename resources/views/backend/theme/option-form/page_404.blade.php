{{-- 404 Page Header --}}
<h3 class="black mb-3">{{ translate('404 Page') }}</h3>
<input type="hidden" name="option_name" value="page_404">

{{-- Custom page 404 Switch Field Start --}}
<div class="form-group row py-4 border-bottom">
    <div class="col-xl-4">
        <label class="font-16 bold black">{{ translate('Custom 404 Style') }}
        </label>
        <span class="d-block">{{ translate('Set custom 404') }}</span>
    </div>
    <div class="col-xl-6 offset-xl-1">
        <label class="switch success">
            <input type="hidden" name="custom_404_page_c" value="0">
            <input type="checkbox"
                {{ isset($option_settings['custom_404_page_c']) && $option_settings['custom_404_page_c'] == 1 ? 'checked' : '' }}
                name="custom_404_page_c" id="custom_404_page" value="1">
            <span class="control" id="custom_404_page_switch">
                <span class="switch-off">{{ translate('Disable') }}</span>
                <span class="switch-on">{{ translate('Enable') }}</span>
            </span>
        </label>
    </div>
</div>
{{-- Custom page 404 Switch Field End --}}

{{-- Custom 404 Switch On Field Start --}}
<div id="custom_404_page_switch_on_field">
    {{-- 404 Page Subtittle Field Start --}}
    <div class="form-group row py-3 border-bottom">
        <div class="col-xl-4">
            <label for="page_404_title_s" class="font-16 bold black">{{ translate('Page Title') }}
            </label>
            <span class="d-block">{{ translate('Set Page Title') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <input type="text" name="page_404_title_s" id="page_404_title_s" class="form-control"
                value="{{ isset($option_settings['page_404_title_s']) ? $option_settings['page_404_title_s'] : '' }}"
                placeholder="{{ translate('Page Title') }}">
            <small>{{ translate('Transalate to another language') }} <a
                    href="{{ route('core.languages') }}">{{ translate('click here') }}.</a></small>
        </div>
    </div>
    {{-- 404 Page Subtittle Field End --}}

    {{-- 404 Page Subtittle Field Start --}}
    <div class="form-group row py-3 border-bottom">
        <div class="col-xl-4">
            <label for="page_404_subtitle_s" class="font-16 bold black">{{ translate('Page Subtitle') }}
            </label>
            <span class="d-block">{{ translate('Set Page Subtitle') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <input type="text" name="page_404_subtitle_s" id="page_404_subtitle_s" class="form-control"
                value="{{ isset($option_settings['page_404_subtitle_s']) ? $option_settings['page_404_subtitle_s'] : '' }}"
                placeholder="{{ translate('Page Subtitle') }}">
                <small>{{ translate('Transalate to another language') }} <a
                    href="{{ route('core.languages') }}">{{ translate('click here') }}.</a></small>
        </div>
    </div>
    {{-- 404 Page Subtittle Field End --}}

    {{-- Button Before Text Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4">
            <label for="page_404_button_before_text_s" class="font-16 bold black">{{ translate('Button Before Text') }}
            </label>
            <span class="d-block">{{ translate('Button Before Text') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <textarea class="theme-input-style style--seven" name="page_404_button_before_text_s" id="page_404_button_before_text_s"
                placeholder="{{ translate('Button Before Text') }}">{{ isset($option_settings['page_404_button_before_text_s']) ? $option_settings['page_404_button_before_text_s'] : '' }}</textarea>
                <small>{{ translate('Transalate to another language') }} <a
                    href="{{ route('core.languages') }}">{{ translate('click here') }}.</a></small>
        </div>
    </div>
    {{-- Button Before Text Field End --}}

    {{-- Button Text Field Start --}}
    <div class="form-group row py-3 border-bottom">
        <div class="col-xl-4">
            <label for="page_404_button_text_s" class="font-16 bold black">{{ translate('Button Text') }}
            </label>
            <span class="d-block">{{ translate('Button Text') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <input type="text" name="page_404_button_text_s" id="page_404_button_text_s" class="form-control"
                value="{{ isset($option_settings['page_404_button_text_s']) ? $option_settings['page_404_button_text_s'] : '' }}"
                placeholder="{{ translate('Button Text') }}">
                <small>{{ translate('Transalate to another language') }} <a
                    href="{{ route('core.languages') }}">{{ translate('click here') }}.</a></small>
        </div>
    </div>
    {{-- Button Text Field End --}}

    {{-- 404 Page Background Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-3">
            <label class="font-16 bold black">{{ translate('Background') }}
            </label>
            <span class="d-block">{{ translate('page background with image, color, etc.') }}</span>
        </div>
        <div class="col-xl-8 offset-xl-1">
            <div class="row">
                <div class="col-xl-12 my-2">
                    <div class="row ml-1">
                        <div class="color">
                            <input type="text" class="form-control" name="page_404_background-color"
                                value="{{ isset($option_settings['page_404_background-color']) ? $option_settings['page_404_background-color'] : '' }}">
                            <input type="color" class="" id="page_404_background-color"
                                value="{{ isset($option_settings['page_404_background-color']) ? $option_settings['page_404_background-color'] : '#fafafa' }}"
                                oninput="pageHeaderBackgroundCss('page_404')">
                            <label for="page_404_background-color">{{ translate('Select Color') }}</label>
                        </div>
                        <div class="d-flex align-items-center">
                            <label class="custom-checkbox position-relative ml-2 mr-1">
                                <input type="hidden" name="page_404_background-color-transparent_i" value="0">
                                <input type="checkbox"
                                    {{ isset($option_settings['page_404_background-color-transparent_i']) && $option_settings['page_404_background-color-transparent_i'] == 1 ? 'checked' : '' }}
                                    name="page_404_background-color-transparent_i"
                                    id="page_404_background_color-transparent" value="1"
                                    onclick="pageHeaderBackgroundCss('page_404')">
                                <span class="checkmark"></span>
                            </label>
                            <label class="black font-16"
                                for="page_404_background_color-transparent">{{ translate('Transparent') }}</label>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 my-2">
                    <label class="col-form-label col-form-label-sm">{{ translate('Background Repeat') }}</label>
                    <select name="page_404_background-repeat" id="page_404_bg_repeat" class="form-control select"
                        onchange="pageHeaderBackgroundCss('page_404')">
                        <option value="" selected>{{ translate('Select Background Repeat') }}</option>
                        <option value="no-repeat"
                            {{ isset($option_settings['page_404_background-repeat']) && $option_settings['page_404_background-repeat'] == 'no-repeat' ? 'selected' : '' }}>
                            No Repeat</option>
                        <option value="repeat"
                            {{ isset($option_settings['page_404_background-repeat']) && $option_settings['page_404_background-repeat'] == 'repeat' ? 'selected' : '' }}>
                            Repeat All</option>
                        <option value="repeat-x"
                            {{ isset($option_settings['page_404_background-repeat']) && $option_settings['page_404_background-repeat'] == 'repeat-x' ? 'selected' : '' }}>
                            Repeat Horizontally</option>
                        <option value="repeat-y"
                            {{ isset($option_settings['page_404_background-repeat']) && $option_settings['page_404_background-repeat'] == 'repeat-y' ? 'selected' : '' }}>
                            Repeat Vertically</option>
                        <option value="inherit"
                            {{ isset($option_settings['page_404_background-repeat']) && $option_settings['page_404_background-repeat'] == 'inherit' ? 'selected' : '' }}>
                            Inherit</option>
                    </select>
                </div>
                <div class="col-xl-6 my-2">
                    <label class="col-form-label col-form-label-sm">{{ translate('Background Size') }}</label>
                    <select name="page_404_background-size" id="page_404_bg_size" class="form-control select"
                        onchange="pageHeaderBackgroundCss('page_404')">
                        <option value="" selected>{{ translate('Select Background Size') }}</option>
                        <option value="inherit"
                            {{ isset($option_settings['page_404_background-size']) && $option_settings['page_404_background-size'] == 'inherit' ? 'selected' : '' }}>
                            Inherit</option>
                        <option value="cover"
                            {{ isset($option_settings['page_404_background-size']) && $option_settings['page_404_background-size'] == 'cover' ? 'selected' : '' }}>
                            Cover</option>
                        <option value="contain"
                            {{ isset($option_settings['page_404_background-size']) && $option_settings['page_404_background-size'] == 'contain' ? 'selected' : '' }}>
                            Contain</option>
                    </select>
                </div>
                <div class="col-xl-6 my-2">
                    <label class="col-form-label col-form-label-sm">{{ translate('Background Attachment') }}</label>
                    <select name="page_404_background-attachment" id="page_404_bg_attachment"
                        class="form-control select" onchange="pageHeaderBackgroundCss('page_404')">
                        <option value="" selected>{{ translate('Select Background Attachment') }}</option>
                        <option value="fixed"
                            {{ isset($option_settings['page_404_background-attachment']) && $option_settings['page_404_background-attachment'] == 'fixed' ? 'selected' : '' }}>
                            Fixed</option>
                        <option value="scroll"
                            {{ isset($option_settings['page_404_background-attachment']) && $option_settings['page_404_background-attachment'] == 'scroll' ? 'selected' : '' }}>
                            Scroll</option>
                        <option value="inherit"
                            {{ isset($option_settings['page_404_background-attachment']) && $option_settings['page_404_background-attachment'] == 'inherit' ? 'selected' : '' }}>
                            Inherit</option>
                    </select>
                </div>
                <div class="col-xl-6 my-2">
                    <label class="col-form-label col-form-label-sm"
                        for="page_404_background-repeat">{{ translate('Background Position') }}</label>
                    <select name="page_404_background-position" id="page_404_bg_position" class="form-control select"
                        onchange="pageHeaderBackgroundCss('page_404')">
                        <option value="" selected>{{ translate('Select Background Position') }}</option>
                        <option value="left top"
                            {{ isset($option_settings['page_404_background-position']) && $option_settings['page_404_background-position'] == 'left top' ? 'selected' : '' }}>
                            Left Top</option>
                        <option value="left center"
                            {{ isset($option_settings['page_404_background-position']) && $option_settings['page_404_background-position'] == 'left center' ? 'selected' : '' }}>
                            Left Center</option>
                        <option value="left bottom"
                            {{ isset($option_settings['page_404_background-position']) && $option_settings['page_404_background-position'] == 'left bottom' ? 'selected' : '' }}>
                            Left Bottom</option>
                        <option value="center top"
                            {{ isset($option_settings['page_404_background-position']) && $option_settings['page_404_background-position'] == 'center top' ? 'selected' : '' }}>
                            Center Top</option>
                        <option value="center center"
                            {{ isset($option_settings['page_404_background-position']) && $option_settings['page_404_background-position'] == 'center center' ? 'selected' : '' }}>
                            Center Center</option>
                        <option value="center bottom"
                            {{ isset($option_settings['page_404_background-position']) && $option_settings['page_404_background-position'] == 'center bottom' ? 'selected' : '' }}>
                            Center Bottom</option>
                        <option value="right top"
                            {{ isset($option_settings['page_404_background-position']) && $option_settings['page_404_background-position'] == 'right top' ? 'selected' : '' }}>
                            Right Top</option>
                        <option value="right center"
                            {{ isset($option_settings['page_404_background-position']) && $option_settings['page_404_background-position'] == 'right center' ? 'selected' : '' }}>
                            Right Center</option>
                        <option value="right bottom"
                            {{ isset($option_settings['page_404_background-position']) && $option_settings['page_404_background-position'] == 'right bottom' ? 'selected' : '' }}>
                            Right Bottom</option>
                    </select>
                </div>
                <div class="col-xl-6 my-2">
                    <input type="hidden" name="page_404_background-image" id="page_404_background-image" value>
                    @include('core::base.includes.media.media_input', [
                        'input' => 'page_404_background_image_i',
                        'data' => isset($option_settings['page_404_background_image_i'])
                            ? $option_settings['page_404_background_image_i']
                            : null,
                    ])
                </div>
            </div>
            <div class="mt-4 page_background_preview" id="page_404_background_preview">
            </div>
        </div>
    </div>
    {{-- 404 Page Background Field End --}}

    {{-- 404 Page Overly Switch Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4">
            <label class="font-16 bold black">{{ translate('Background Overlay') }}
            </label>
            <span class="d-block">{{ translate('Set background ovelay.') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1 row align-items-center">
            <label class="custom-checkbox solid position-relative">
                <input type="hidden" name="background_overlay_c" value="0">
                <input type="checkbox"
                    {{ isset($option_settings['background_overlay_c']) && $option_settings['background_overlay_c'] == 1 ? 'checked' : '' }}
                    name="background_overlay_c" id="background_overlay" value="1">
                <span class="checkmark" id="background_overlay_switch"></span>
            </label>
        </div>
    </div>
    {{-- 404 Page Overly Switch Field End --}}

    {{-- 404 Page BG Overly Switch On Field Start --}}
    <div id="background_overlay_switch_on_field">
        {{-- Page Overlay Bgcolor Field Start --}}
        <div class="form-group row py-4 border-bottom">
            <div class="col-xl-4">
                <label class="font-16 bold black">{{ translate('Overlay Color') }}
                </label>
                <span class="d-block">{{ translate('Set overlay color.') }}</span>
            </div>
            <div class="col-xl-6 offset-xl-1">
                <div class="row ml-2">
                    <div class="color">
                        <input type="text" class="form-control" name="overlay_background-color"
                            value="{{ isset($option_settings['overlay_background-color']) ? $option_settings['overlay_background-color'] : '' }}">
                        <input type="color" class="" id="overlay_background_color"
                            value="{{ isset($option_settings['overlay_background-color']) ? $option_settings['overlay_background-color'] : '#fafafa' }}">
                        <label for="overlay_background_color">{{ translate('Select Color') }}</label>
                    </div>
                    <div class="d-flex align-items-center">
                        <label class="custom-checkbox position-relative ml-2 mr-1">
                            <input type="hidden" name="overlay_background-color-transparent_i" value="0">
                            <input type="checkbox"
                                {{ isset($option_settings['overlay_background-color-transparent_i']) && $option_settings['overlay_background-color-transparent_i'] == 1 ? 'checked' : '' }}
                                name="overlay_background-color-transparent_i"
                                id="overlay_background-color-transparent" value="1">
                            <span class="checkmark"></span>
                        </label>
                        <label class="black font-16"
                            for="overlay_background-color-transparent">{{ translate('Transparent') }}</label>
                    </div>
                </div>
            </div>
        </div>
        {{-- Page Overlay Bgcolor Field End --}}

        {{-- Page Overlay Opacity Field Start --}}
        <div class="form-group row py-4 border-bottom">
            <div class="col-xl-4">
                <label class="font-16 bold black">{{ translate('Overlay Opacity') }}
                </label>
                <span class="d-block">{{ translate('set overlay opacity.') }}</span>
            </div>
            <div class="col-xl-6 offset-xl-1 row align-items-center">
                <input type="number" step="any" class="form-control col-xl-3" name="overlay_opacity"
                    id="overlay_opacity"
                    value="{{ isset($option_settings['overlay_opacity']) ? $option_settings['overlay_opacity'] : '' }}">

                <input type="range" class="col-xl-8" id="overlay_opacity_range" style="height: 30%;"
                    min="0" max="1" step="0.1"
                    value="{{ isset($option_settings['overlay_opacity']) ? $option_settings['overlay_opacity'] : '0.5' }}">
            </div>
        </div>
        {{-- Page Overlay Opacity Field End --}}
    </div>
    {{-- 404 Page BG Overly Switch on Field End --}}

    {{-- Title Color Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4">
            <label class="font-16 bold black">{{ translate('Title Color') }}
            </label>
            <span class="d-block">{{ translate('Pick a title color') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <div class="row ml-2">
                <div class="color">
                    <input type="text" class="form-control" name="title_color"
                        value="{{ isset($option_settings['title_color']) ? $option_settings['title_color'] : '' }}">

                    <input type="color" class="" id="title_color"
                        value="{{ isset($option_settings['title_color']) ? $option_settings['title_color'] : '#fafafa' }}">

                    <label for="title_color">{{ translate('Select Color') }}</label>
                </div>
                <div class="d-flex align-items-center">
                    <label class="custom-checkbox position-relative ml-2 mr-1">
                        <input type="hidden" name="title_color-transparent_i" value="0">
                        <input type="checkbox"
                            {{ isset($option_settings['title_color-transparent_i']) && $option_settings['title_color-transparent_i'] == 1 ? 'checked' : '' }}
                            name="title_color-transparent_i" id="title_color-transparent" value="1">
                        <span class="checkmark"></span>
                    </label>
                    <label class="black font-16" for="title_color-transparent">{{ translate('Transparent') }}</label>
                </div>
            </div>
        </div>
    </div>
    {{-- Title Color Field End --}}

    {{-- Sub Title Color Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4">
            <label class="font-16 bold black">{{ translate('Subtitle Color') }}
            </label>
            <span class="d-block">{{ translate('Pick a subtitle color') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <div class="row ml-2">
                <div class="color">
                    <input type="text" class="form-control" name="subtitle_color"
                        value="{{ isset($option_settings['subtitle_color']) ? $option_settings['subtitle_color'] : '' }}">

                    <input type="color" class="" id="subtitle_color"
                        value="{{ isset($option_settings['subtitle_color']) ? $option_settings['subtitle_color'] : '#fafafa' }}">

                    <label for="subtitle_color">{{ translate('Select Color') }}</label>
                </div>
                <div class="d-flex align-items-center">
                    <label class="custom-checkbox position-relative ml-2 mr-1">
                        <input type="hidden" name="subtitle_color-transparent_i" value="0">
                        <input type="checkbox"
                            {{ isset($option_settings['subtitle_color-transparent_i']) && $option_settings['subtitle_color-transparent_i'] == 1 ? 'checked' : '' }}
                            name="subtitle_color-transparent_i" id="subtitle_color-transparent" value="1">
                        <span class="checkmark"></span>
                    </label>
                    <label class="black font-16"
                        for="subtitle_color-transparent">{{ translate('Transparent') }}</label>
                </div>
            </div>
        </div>
    </div>
    {{-- Sub Title Color Field End --}}

    {{-- Before Button Text Color Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4">
            <label class="font-16 bold black">{{ translate('Before Button Text Color') }}
            </label>
            <span class="d-block">{{ translate('Pick Before Button Text Color') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <div class="row ml-2">
                <div class="color">
                    <input type="text" class="form-control" name="before_button_text_color"
                        value="{{ isset($option_settings['before_button_text_color']) ? $option_settings['before_button_text_color'] : '' }}">

                    <input type="color" class="" id="before_button_text_color"
                        value="{{ isset($option_settings['before_button_text_color']) ? $option_settings['before_button_text_color'] : '#fafafa' }}">

                    <label for="before_button_text_color">{{ translate('Select Color') }}</label>
                </div>
                <div class="d-flex align-items-center">
                    <label class="custom-checkbox position-relative ml-2 mr-1">
                        <input type="hidden" name="before_button_text_color-transparent_i" value="0">
                        <input type="checkbox"
                            {{ isset($option_settings['before_button_text_color-transparent_i']) && $option_settings['before_button_text_color-transparent_i'] == 1 ? 'checked' : '' }}
                            name="before_button_text_color-transparent_i" id="before_button_text_color-transparent"
                            value="1">
                        <span class="checkmark"></span>
                    </label>
                    <label class="black font-16"
                        for="before_button_text_color-transparent">{{ translate('Transparent') }}</label>
                </div>
            </div>
        </div>
    </div>
    {{-- Before Button Text Color Field End --}}

    {{-- Before Button Color Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4">
            <label class="font-16 bold black">{{ translate('Before Button Color') }}
            </label>
            <span class="d-block">{{ translate('Pick Before Button Color') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <div class="row ml-2">
                <div class="color">
                    <input type="text" class="form-control" name="before_button_color"
                        value="{{ isset($option_settings['before_button_color']) ? $option_settings['before_button_color'] : '' }}">

                    <input type="color" class="" id="before_button_color"
                        value="{{ isset($option_settings['before_button_color']) ? $option_settings['before_button_color'] : '#fafafa' }}">

                    <label for="before_button_color">{{ translate('Select Color') }}</label>
                </div>
                <div class="d-flex align-items-center">
                    <label class="custom-checkbox position-relative ml-2 mr-1">
                        <input type="hidden" name="before_button_color-transparent_i" value="0">
                        <input type="checkbox"
                            {{ isset($option_settings['before_button_color-transparent_i']) && $option_settings['before_button_color-transparent_i'] == 1 ? 'checked' : '' }}
                            name="before_button_color-transparent_i" id="before_button_color-transparent"
                            value="1">
                        <span class="checkmark"></span>
                    </label>
                    <label class="black font-16"
                        for="before_button_color-transparent">{{ translate('Transparent') }}</label>
                </div>
            </div>
        </div>
    </div>
    {{-- Before Button Color Field End --}}

    {{-- Before Button Hover Color Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4">
            <label class="font-16 bold black">{{ translate('Before Button Hover Color') }}
            </label>
            <span class="d-block">{{ translate('Pick Before Button Hover Color') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <div class="row ml-2">
                <div class="color">
                    <input type="text" class="form-control" name="before_button_hover_color"
                        value="{{ isset($option_settings['before_button_hover_color']) ? $option_settings['before_button_hover_color'] : '' }}">

                    <input type="color" class="" id="before_button_hover_color"
                        value="{{ isset($option_settings['before_button_hover_color']) ? $option_settings['before_button_hover_color'] : '#fafafa' }}">

                    <label for="before_button_hover_color">{{ translate('Select Color') }}</label>
                </div>
                <div class="d-flex align-items-center">
                    <label class="custom-checkbox position-relative ml-2 mr-1">
                        <input type="hidden" name="before_button_hover_color-transparent_i" value="0">
                        <input type="checkbox"
                            {{ isset($option_settings['before_button_hover_color-transparent_i']) && $option_settings['before_button_hover_color-transparent_i'] == 1 ? 'checked' : '' }}
                            name="before_button_hover_color-transparent_i" id="before_button_hover_color-transparent"
                            value="1">
                        <span class="checkmark"></span>
                    </label>
                    <label class="black font-16"
                        for="before_button_hover_color-transparent">{{ translate('Transparent') }}</label>
                </div>
            </div>
        </div>
    </div>
    {{-- Before Button Hover Color Field End --}}
</div>
{{-- Custom 404 Switch On Field End --}}
