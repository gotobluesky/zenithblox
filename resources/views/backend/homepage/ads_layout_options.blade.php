@php
    $active_theme = getActiveTheme();
    $options = explode('_', $layout);
    $option_settings = getThemeOption('google_adsense', $active_theme->id);
    $adsense_list = null;
    if (isset($option_settings['adsense_list']) && $option_settings['adsense_list'] != '') {
        $adsense_list = json_decode($option_settings['adsense_list']);
    }
@endphp
@if ($layout != null)
    <div class="row m-0">
        @foreach ($options as $key => $option)
            <div class="col-{{ $option }}" style="border:1px dotted">
                <div class="form-row mb-20">
                    <div class="col-sm-12">
                        <label class="font-14 bold black">{{ translate('Image') }} </label>
                    </div>
                    <div class="col-md-12">
                        @include('core::base.includes.media.media_input', [
                            'input' => $key + 1 . '_' . $option . '_image',
                            'data' => old($key + 1 . '_' . $option . '_image'),
                        ])

                    </div>
                </div>
                <div class="form-row mb-20">
                    <div class="col-sm-12">
                        <label class="font-14 bold black">{{ translate('Url') }} </label>
                    </div>
                    <div class="col-md-12">
                        <input type="text" class="theme-input-style" name="{{ $key + 1 . '_' . $option . '_url' }}">
                    </div>
                </div>

                <div class="form-row mb-20">
                    <div class="col-sm-12">
                        <label class="font-14 bold black">{{ translate('Google Adsense') }} </label>
                    </div>
                    <div class="col-md-12">
                        <select name="{{ $key + 1 . '_' . $option . '_google_adsense' }}" id=""
                            class="form-control">
                            <option value="">{{ translate('Select Adsence') }}</option>
                            @if (isset($adsense_list))
                                @foreach ($adsense_list as $adsense)
                                    <option value="{{ $adsense->adsense_index }}">{{ $adsense->adsense_title }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <span class="bold d-block ml-3 mt-2 text-danger">* {{ translate('If you select AdSense, it will be overwrite Image and Url fields.') }}</span>
@else
    <p class="alert alert-danger">{{ translate('Please select a layout') }}</p>
@endif
