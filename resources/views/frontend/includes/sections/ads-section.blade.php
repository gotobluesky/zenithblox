@php
    $content = explode('_', $properties['content']);
    $type = $properties['layout'];
    $active_theme = getActiveTheme();
    $option_settings = getThemeOption('google_adsense', $active_theme->id);
    $adsense_list = null;
    if (isset($option_settings['adsense_list']) && $option_settings['adsense_list'] != '') {
        $adsense_list = json_decode($option_settings['adsense_list'], true);
    }
@endphp

<div class="pt-40 pb-40 biz-ad" id="{{ $type . '_' . $id }}">
    <div class="row">
        @foreach ($content as $key => $value)
            @php
                $img = $key + 1 . '_' . $value . '_image';
                $url = $key + 1 . '_' . $value . '_url';
                $adsense = $key + 1 . '_' . $value . '_google_adsense';
            @endphp
            <div class="col-sm-{{ $value }} text-center">
                @if (isset($properties[$adsense]) &&
                        !empty($properties[$adsense]) &&
                        isset($adsense_list) &&
                        findAdsense($properties[$adsense], $adsense_list))
                    {!! findAdsense($properties[$adsense], $adsense_list) !!}
                @else
                    <a href="{{ $properties[$url] }}" aria-label="ads"><img
                            data-src="{{ asset(getFilePath($properties[$img])) }}" alt="Ads"
                            class="img-fluid lazy"></a>
                @endif
            </div>
        @endforeach
    </div>
</div>
