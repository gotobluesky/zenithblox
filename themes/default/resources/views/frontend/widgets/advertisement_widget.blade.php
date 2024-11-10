@php
    $active_theme = getActiveTheme();
    $option_settings = getThemeOption('google_adsense', $active_theme->id);
    $adsense_list = null;
    if (isset($option_settings['adsense_list']) && $option_settings['adsense_list'] != '') {
        $adsense_list = json_decode($option_settings['adsense_list'], true);
    }
    $get_ads_fields = getSidebarWidgetValues($sidebar_has_widget, getFrontLocale());
    $ads_url = isset($get_ads_fields['ads_url']) ? $get_ads_fields['ads_url']:'/';
    $ads_image = isset($get_ads_fields['ads_image']) ? $get_ads_fields['ads_image']:'';
@endphp
<!-- Ad Widget -->
<div class="widget widget-ad">
    <!-- Widget Content -->
    <div class="widget-content">
        @if (isset($get_ads_fields['google_adsence_sidebar']) &&
                !empty($get_ads_fields['google_adsence_sidebar']) &&
                isset($adsense_list) &&
                findAdsense($get_ads_fields['google_adsence_sidebar'], $adsense_list))
            {!! findAdsense($get_ads_fields['google_adsence_sidebar'], $adsense_list) !!}
        @else
            <a href="{{ $ads_url }}" aria-label="ads"><img
                    data-src="{{ asset(getFilePath($ads_image)) }}" alt="Ads"
                    class="img-fluid lazy"></a>
        @endif

    </div>
    <!-- End of Widget Content -->
</div>
<!-- End of Ad Widget -->
