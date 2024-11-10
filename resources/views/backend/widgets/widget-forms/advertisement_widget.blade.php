@php
    $add_information = isset($value) && isset($value['add_information']) ? $value['add_information'] : '';
    $ads_image = isset($value) && isset($value['ads_image']) ? $value['ads_image'] : null;
    $ads_url = isset($value) && isset($value['ads_url']) ? $value['ads_url'] : '';

    $adsence_index = isset($value) && isset($value['google_adsence_sidebar']) ? $value['google_adsence_sidebar'] : '';
    $active_theme = getActiveTheme();
    $option_settings = getThemeOption('google_adsense', $active_theme->id);
    $adsense_list = null;
    if (isset($option_settings['adsense_list']) && $option_settings['adsense_list'] != '') {
        $adsense_list = json_decode($option_settings['adsense_list']);
    }
@endphp
<form action="#" class=" widget_input_field_form px-3 py-3 bg-white"
    onsubmit="event.preventDefault(); widgetInputFormSubmit(this);">

    <div class="form-row mb-20">
        <div class="col-sm-12">
            <label class="font-14 bold black">{{ translate('Image') }} </label>
        </div>
        <div class="col-md-12">
            @include('core::base.includes.media.media_input', [
                'input' => 'ads_image',
                'data' => $ads_image,
            ])
        </div>
    </div>
    <div class="form-row mb-20">
        <div class="col-sm-12">
            <label class="font-14 bold black">{{ translate('Url') }} </label>
        </div>
        <div class="col-md-12">
            <input type="text" class="theme-input-style" name="ads_url" value="{{ $ads_url }}">
        </div>
    </div>

    <div class="form-row mb-2">
        <div class="col-sm-12">
            <label class="font-14 bold black">{{ translate('Google Adsense') }} </label>
        </div>
        <div class="col-md-12">
            <select name="google_adsence_sidebar" id=""
                class="form-control">
                <option value="">{{ translate('Select Adsence') }}</option>
                @if (isset($adsense_list))
                    @foreach ($adsense_list as $adsense)
                        <option value="{{ $adsense->adsense_index }}" @selected($adsense->adsense_index == $adsence_index)>{{ $adsense->adsense_title }}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
    <span class="d-block ml-2 mb-3 text-danger">* {{ translate('If you select AdSense, it will be overwrite Image and Url fields.') }}</span>


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
