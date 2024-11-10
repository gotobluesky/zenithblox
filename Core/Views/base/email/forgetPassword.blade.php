@php
    $template = getEmailTemplateOf(config('settings.email_template.reset_user_password'), $data, $keywords);
@endphp
{!! xss_clean($template) !!}
