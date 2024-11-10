@php
    $active_theme = getActiveTheme();
    $options = explode('_', $layout);
    $option_settings = getThemeOption('google_adsense', $active_theme->id);
    $adsense_list = null;
    if (isset($option_settings['adsense_list']) && $option_settings['adsense_list'] != '') {
        $adsense_list = json_decode($option_settings['adsense_list']);
    }
@endphp
@foreach ($options as $key => $option)
    <div class="col-{{ $option }}" style="border:1px dotted">
        @php
            $image = $key + 1 . '_' . $option . '_image';
            $url = $key + 1 . '_' . $option . '_url';
            $adsence = $key + 1 . '_' . $option . '_google_adsense';
        @endphp
        <div class="form-row mb-20">
            <div class="col-sm-12">
                <label class="font-14 bold black">{{ translate('Image') }} </label>
            </div>
            <div class="col-md-12">
                @include('core::base.includes.media.media_input', [
                    'input' => $image,
                    'data' => getHomePageSectionProperties($section_details->id, $image),
                ])

            </div>
        </div>
        <div class="form-row mb-20">
            <div class="col-sm-12">
                <label class="font-14 bold black">{{ translate('Url') }} </label>
            </div>
            <div class="col-md-12">
                <input type="text" class="theme-input-style" name="{{ $url }}"
                    value="{{ getHomePageSectionProperties($section_details->id, $url) }}">
            </div>
        </div>

        <div class="form-row mb-20">
            <div class="col-sm-12">
                <label class="font-14 bold black">{{ translate('Google Adsense') }} </label>
            </div>
            <div class="col-md-12">
                <select name="{{ $adsence }}" id=""
                    class="form-control">
                    @if (isset($adsense_list))
                        <option value="">{{ translate('Select Adsence') }}</option>
                        @foreach ($adsense_list as $adsense)
                            <option value="{{ $adsense->adsense_index }}" @selected( getHomePageSectionProperties($section_details->id, $adsence) == $adsense->adsense_index )>{{ $adsense->adsense_title }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
    </div>
    <span class="bold d-block ml-3 mt-2 text-danger">* {{ translate('If you select AdSense, it will be overwrite Image and Url fields.') }}</span>
@endforeach
