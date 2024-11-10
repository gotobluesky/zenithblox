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
@if ($subscribe_form)
    <!-- Newsletter -->
    <section class="footer-newsletter newsletter-cover">
        <!-- Overlay -->
        <div class="nl-bg-ol"></div>
        <div class="container">
            <div class="newsletter pt-80 pb-80">
                <!-- Section title -->
                <div class="section-title text-center">
                    <h2>{{ front_translate($form_title) }}
                    </h2>
                </div>
                <!-- End of Section title -->
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <!-- Newsletter Form -->
                        <form action="javascript:void(0);" method="post" class="newsletterForm">
                            @csrf
                            <div class="input-group">
                                <input type="email" name="email" class="form-control"
                                    placeholder="{{ front_translate($placeholder) }}">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">{{ front_translate($button_text) }}</button>
                                </div>
                            </div>
                            @if ($is_privacy)
                                <p class="checkbox-cover d-flex justify-content-center">
                                    <label> {{ front_translate("I've read and accept the") }}
                                        @php
                                            $tlpage = Core\Models\TlPage::where('id', $subscribe['privacy_policy_page'])->select(['id','permalink','title'])->first();
                                            $parentUrl = isset($tlpage) ? getParentUrl($tlpage) : '';
                                        @endphp
                                        <a
                                            href="{{ route('theme.default.viewPage', ['permalink' => $parentUrl . $tlpage->permalink]) }}">{{ $tlpage->translation('title',getFrontLocale()) }}</a>

                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </p>
                            @endif
                        </form>
                        <!-- End of Newsletter Form -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End of Newsletter -->
@endif
