@php
    $active_theme = getActiveTheme();
    $newsletter_fields = getSidebarWidgetValues($sidebar_has_widget, getFrontLocale());
    $widget_title = isset($newsletter_fields['widget_title']) ? $newsletter_fields['widget_title'] : '';
    $newsletter_short_desc = isset($newsletter_fields['newsletter_short_desc']) ? $newsletter_fields['newsletter_short_desc'] : '';
    $email_placeholder = isset($newsletter_fields['email_placeholder']) ? $newsletter_fields['email_placeholder'] : '';
    $button_text = isset($newsletter_fields['button_text']) ? $newsletter_fields['button_text'] : '';
    $subscribe = getThemeOption('subscribe', $active_theme->id);
    $is_privacy = false;
    if (isset($subscribe['privacy_policy']) && $subscribe['privacy_policy'] == 1 && isset($subscribe['privacy_policy_page'])) {
        $is_privacy = true;
    }
@endphp
<!-- Newsletter Widget -->
<div class="widget widget-newsletter">
    <!-- Widget Title -->
    {!! makeTitleTag($sidebar_widget_title_tag, $widget_title, 'widget-title') !!}
    <!-- End of Widget Title -->

    <!-- Widget Content -->
    <div class="widget-content">
        <!-- Newsletter Text -->
        <p>{{ $newsletter_short_desc }}</p>
        <!-- Newsletter Form -->
        <div class="newsletter">
            <form action="javascript:void(0);" method="post" class="newsletterForm">
                @csrf
                <input type="email" class="form-control" name="email" placeholder="{{ $email_placeholder }}">
                @if ($is_privacy)
                    <p class="checkbox-cover d-flex justify-content-center">
                        <label class="m-0"> {{ front_translate("I've read and accept the") }}
                            @php
                                $tlpage = Core\Models\TlPage::where('id', $subscribe['privacy_policy_page'])->select(['id','permalink','title'])->first();
                                $parentUrl = isset($tlpage) ? getParentUrl($tlpage) : '';
                            @endphp
                            <a
                                href="{{ route('theme.default.viewPage', ['permalink' => $parentUrl . $tlpage->permalink]) }}">{{ $tlpage->translation('title', getFrontLocale()) }}</a>
                            <input type="checkbox">
                            <span class="checkmark"></span>
                        </label>
                    </p>
                @endif
                <button type="submit" class="btn btn-block btn-default text-center">{{ $button_text }}</button>
            </form>
        </div>
    </div>
    <!-- End of Widget Content -->
</div>
<!-- End of Newsletter Widget -->
