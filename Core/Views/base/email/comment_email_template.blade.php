@php
    $template = getEmailTemplateOf(config('settings.email_template.blog_comment_email_template'), $data, $keywords);
@endphp
{!! xss_clean($template) !!}
