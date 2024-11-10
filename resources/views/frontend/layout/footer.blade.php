@php
    // Theme Options and Setting
    $active_theme = getActiveTheme();
    $social_options = getThemeOption('social', $active_theme->id);
    $is_social = true;
    $is_logo = true;
    $is_text = true;
    
    $all_socials = isset($social_options['social_field']) ? json_decode($social_options['social_field']) : null;
    $footer_logo = isset($white_logo) ? project_asset($white_logo) : null;
    if ($mood === 'dark') {
        $footer_logo = isset($dark_logo) ? project_asset($dark_logo) : null;
    }
    $logo_url = route('theme.default.home');
    $logo_alignment = 'center';
    $text_alignment = $rtl ? 'left' : 'right';
    $social_alignment = $rtl ? 'right' : 'left';
    $lang_alignment = $rtl ? 'right' : 'left';
    $footer_copyright_text = $copyright_text;
    $languages = getAllActiveLanguages();
    
    if (isset($footer['custom_footer_style']) && $footer['custom_footer_style'] == 1) {
        $is_social = isset($footer['footer_social_enable']) && $footer['footer_social_enable'] == 1 ? true : false;
        if (isset($footer['footer_logo_enable']) && $footer['footer_logo_enable'] == 1) {
            $is_logo = true;
            $logo_url = isset($footer['footer_logo_anchor_url']) ? $footer['footer_logo_anchor_url'] : '';
            $logo_alignment = isset($footer['footer_logo_alignment']) ? $footer['footer_logo_alignment'] : 'center';
        } else {
            $is_logo = false;
        }
        if (isset($footer['footer_text_enable']) && $footer['footer_text_enable'] == 1) {
            $is_text = true;
            $text_alignment = isset($footer['footer_text_alignment']) ? $footer['footer_text_alignment'] : 'right';
        } else {
            $is_text = false;
        }
    }
    
    $lang = isset($footer['footer_language_select']) && $footer['footer_language_select'] == 1 ? true : false;
@endphp
<!-- Footer -->
<footer class="footer-container d-flex align-items-center">
    <div class="container">
        <div class="footer">
            <div class="row align-items-center">
                <!-- Language -->
                @if ($lang)
                    <div class="col-md-2 order-last order-md-1 text-center text-md-{{ $lang_alignment }}">
                        <select class="bg-light w-75 py-1 px-2" id="language-change">
                            @foreach ($languages as $language)
                                <option value="{{ $language->code }}" @selected($language->code == getFrontLocale())>
                                    {{ $language->native_name }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                <!-- End of Language -->
                <div
                    class="@if ($lang) col-md-3 order-md-2 order-2 @else col-md-4 order-md-1 order-2 @endif text-center text-md-{{ $social_alignment }} py-1">
                    <div class="footer-social">
                        @if ($is_social)
                            @isset($all_socials)
                                @foreach ($all_socials as $social)
                                    @if ($social->social_icon != '')
                                        @php
                                            $logo_url = $social->social_icon_url;
                                            if ($social->social_icon_url === '' || $social->social_icon_url === '/') {
                                                $logo_url = url('/') . $social->social_icon_url;
                                            }
                                        @endphp
                                        <a href="{{ $logo_url }}" aria-label="icon"><i
                                                class="fa {{ $social->social_icon }}"></i></a>
                                    @endif
                                @endforeach
                            @endisset
                        @endif
                    </div>
                </div>
                <div
                    class="@if ($lang) col-md-2 order-md-3 order-1 @else col-md-4 order-md-2 order-1 @endif d-flex order-md-2 order-2 py-1 justify-content-{{ $logo_alignment }}">
                    @if ($is_logo && $footer_logo != null)
                        @php
                            if (!str_contains($logo_url, 'https://') || !str_contains($logo_url, 'http://')) {
                                $logo_url = 'http://' . $logo_url;
                            }
                        @endphp
                        <a href="{{ $logo_url }}"><img src="{{ $footer_logo }}" alt="logo"
                                class="img-fluid"></a>
                    @else
                        <h2>{{ $text_logo }}</h2>
                    @endif
                </div>
                <div
                    class="@if ($lang) col-md-5 order-md-4 order-3 @else col-md-4 order-md-3 order-3 @endif text-center  text-md-{{ $text_alignment }} py-1">
                    @if ($is_text)
                        <div class="footer-cradit">
                            {!! xss_clean($footer_copyright_text) !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- End of Footer -->
