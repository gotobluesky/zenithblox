@php
    // Theme Option and Setting
    $subscribe_form = isset($subscribe['footer_subscribe_form']) && $subscribe['footer_subscribe_form'] == 1 ? true : false;
    $form_title = isset($subscribe['subscribe_form_title']) && $subscribe['subscribe_form_title'] != '' ? $subscribe['subscribe_form_title'] : front_translate('Subscribe Our Newsletter');
    
    $placeholder = isset($subscribe['subscribe_form_placeholder']) && $subscribe['subscribe_form_placeholder'] != '' ? $subscribe['subscribe_form_placeholder'] : front_translate('Enter Your Email');
    
    $button_text = isset($subscribe['subscribe_form_button_text']) && $subscribe['subscribe_form_button_text'] != '' ? $subscribe['subscribe_form_button_text'] : front_translate('Submit');
    
    $is_privacy = false;
    if (isset($subscribe['privacy_policy']) && $subscribe['privacy_policy'] == 1 && isset($subscribe['privacy_policy_page'])) {
        $is_privacy = true;
    }
@endphp

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

<style>
    
    /* footer */
:root {
  --primary-color: #555e94;
  --secondary-color: #00001c;
  --counter-number-color: #555e94;
  --font-family: "Poppins", sans-serif;
  --font-weight-bold: "700";
  --font-weight-regular: "400";
  --bg-section-o: #e7eef8;
  --li-a-border-bottom: #6570be;
}

/* footer */
.footer-wrap {
  display: flex;
  justify-content: center;
  background: rgba(0, 0, 28, 1);
}

/* footer middle css start */
.footer-middle-section {
  margin-top: 100px;
  margin-bottom: 50px;
  display: flex;
  /* background: linear-gradient(138deg, rgba(0,0,28,1) 0%, rgba(14,42,69,1) 100%); */
  justify-content: space-between;
}
.Quick-Links h6 {
  font-family: var(--font-family);
  color: white;
  font-weight: 600;
  font-size: 20px;
  margin-bottom: 0px;
}
.Quick-Links p a {
  font-family: var(--font-family);
  color: rgba(255, 255, 255, 0.627);
  font-weight: 400;
  font-size: 16px;
  margin-bottom: 0px;
}
.Quick-Links p a:hover {
  border-bottom: 2px solid var(--primary-color);
  color: var(--primary-color);
}
.footer-logo {
  width: 250px;
  display: flex;
  justify-content: center;
  align-items: center;
}
.footer-logo img {
  width: 100%;
}
.Customer-Service h6 {
  font-family: var(--font-family);
  color: white;
  font-weight: 600;
  font-size: 20px;
  margin-bottom: 0px;
}

.Customer-Service p a {
  font-family: var(--font-family);
  color: rgba(255, 255, 255, 0.627);
  font-weight: 400;
  font-size: 16px;
  margin-bottom: 0px;
}
.Customer-Service p a:hover {
  border-bottom: 2px solid var(--primary-color);
  color: var(--primary-color);
}
.Our-Newsletter h6 {
  font-family: var(--font-family);
  color: white;
  font-weight: 600;
  font-size: 20px;
  margin-bottom: 0px;
}
.Our-Newsletter p {
  font-family: var(--font-family);
  color: rgba(255, 255, 255, 0.627);
  font-weight: 400;
  font-size: 16px;
  margin-bottom: 0px;
}
.Customer-Service p, .Quick-Links p, .Our-Newsletter p {
    padding: 5px 0;
}
.Customer-Service h6, .Quick-Links h6, .Our-Newsletter h6 {
    margin-bottom: 10px;
}
.email-container {
  margin-top: 12px;
  display: flex;
  align-items: center;
  background-color: #fff;
  border: 1px solid #ccc;
  border-radius: 5px;
  padding: 5px;
  /* width: fit-content */
}
.email-container input {
  border: none;
  outline: none;
  padding: 10px;
  flex: 1;
}
.email-container button {
  /* background-color: #00bfff; */
  border: none;
  /* border-radius: 50%; */
  /* padding: 10px; */
  cursor: pointer;
}
.email-container button img {
  width: 30px;
  height: 30px;
}
.email-container form {
  margin-top: 0px;
  width: 100% !important;
  display: flex;
  align-items: center;
  margin-bottom: 0px;
}

/* footer middle css end */








/* footer bottom section start */
.footer-bottom-section {
  display: flex;
  align-items: center;
  justify-content: space-between;
  border-top: 2px solid #47475b;
  padding: 30px 0px;
}
.terms-and-condition {
  gap: 20px;
  display: flex;
}
.terms-and-condition a {
    font-family: var(--font-family);
  font-weight: 400;
  color: #fff;
}
.terms-and-condition p {
  margin: 0px;
  font-family: var(--font-family);
  font-weight: 400;
  color: #fff;
}
.copy-right p {
  margin: 0px;
  font-family: var(--font-family);
  font-weight: 400;
  color: #fff;
}
/* footer bottom section end */

.email-container input{
    margin-bottom: 0;
    padding: 5px;
}
.footer-logo img {
    max-width: 200px;
}

@media (max-width: 980x) {
  .footer-middle-section {
    flex-direction: column;
    align-items: center;
  }
}


</style>

    <div class="footer-wrap">
      <div class="container footer">
        <div class="footer-wrapper">
          <div class="footer-middle-section">
            <div class="footer-logo">
                <a href="/"><img src="{{ asset('themes/default/public/assets/images/footerlogo.png') }}" alt="logo" class="img-fluid"></a>
            </div>
            <div class="Quick-Links">
              <h6>Quick Links</h6>
              <p><a href="/">Home</a></p>
              <p><a href="/page/about-us">About Us</a></p>
              <p><a href="/page/solutions">Solutions</a></p>
              <p><a href="/contact">Contact Us</a></p>
            </div>
            <div class="Customer-Service">
              <h6>Customer Service</h6>
              <p><a href="/contact">Contact Us</a></p>
              <p><a href="/page/terms">Terms of Service</a></p>
                <p><a href="/page/privacy-policy">Privacy Policy</a></p>
            </div>
            <div class="Our-Newsletter">
              <h6>Our Newsletter</h6>
              <p>Subscribe to get updates from us.</p>
              <div class="email-container">
                <form action="javascript:void(0);" method="post" class="newsletterForm">
                    @csrf
                  <input type="email" name="email" placeholder="{{ front_translate($placeholder) }}">
                  <button type="submit">
                    <img src="{{ asset('themes/default/public/assets/images/send-btn.png') }}" alt="Send">
                  </button>
                  
                </form>
              </div>
            </div>
          </div>
          <div class="footer-bottom-section">
            <div class="copy-right">
                @if ($is_text)
                    <p>
                        {!! xss_clean($footer_copyright_text) !!}
                    </p>
                @endif
            </div>
            <div class="terms-and-condition">
              <p><a href="/page/terms">Terms of Service</a></p>
                <p><a href="/page/privacy-policy">Privacy Policy</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    
<footer class="footer-container align-items-center d-none">
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

<script>


    
</script>

<!-- End of Footer -->
