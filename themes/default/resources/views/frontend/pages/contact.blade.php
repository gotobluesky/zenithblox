@php
    // Theme Option and Settings
    $generalSettings = getGeneralSettingsDetails();
    $active_theme = getActiveTheme();
    $contact_option = getThemeOption('contact', $active_theme->id);
    $breadcrumb_title = front_translate('Contact');
    $title = front_translate('Get In Touch');
    $subtitle = front_translate('Whether you have a question, want to start a project or simply want to connect. Feel free to send me a message in the contact form');
    $name_placeholder = front_translate('Your Name');
    $email_placeholder = front_translate('Your Email');
    $subject_placeholder = front_translate('Subject');
    $message_placeholder = front_translate('Your Message');
    $btn_text = front_translate('Submit');
    $contact_image = true;
    $image_path = false;
    
    //contact page field
    if (isset($contact_option) && $contact_option['custom_contact_style'] == 1) {
        $title = isset($contact_option['contact_title']) ? front_translate($contact_option['contact_title']) : '';
        $subtitle = isset($contact_option['contact_subtitle']) ? front_translate($contact_option['contact_subtitle']) : '';
        $name_placeholder = isset($contact_option['contact_name_placeholder']) ? front_translate($contact_option['contact_name_placeholder']) : '';
        $email_placeholder = isset($contact_option['contact_email_placeholder']) ? front_translate($contact_option['contact_email_placeholder']) : '';
        $subject_placeholder = isset($contact_option['contact_subject_placeholder']) ? front_translate($contact_option['contact_subject_placeholder']) : '';
        $message_placeholder = isset($contact_option['contact_message_placeholder']) ? front_translate($contact_option['contact_message_placeholder']) : '';
        $btn_text = isset($contact_option['contact_button_text']) ? front_translate($contact_option['contact_button_text']) : '';
        if (isset($contact_option['contact_image_show']) && $contact_option['contact_image_show'] == 1) {
            if (isset($contact_option['custom_contact_image']) && $contact_option['custom_contact_image'] != null) {
                $contact_image = true;
                $image_path = asset(getFilePath($contact_option['custom_contact_image']));
            }
        } else {
            $contact_image = false;
        }
    }
    
    // page options title css for breadcrumb
    $page_options = themeOptionToCss('page', $active_theme->id);
    $page_title_tag = 'h1';
    $is_title = true;
    $is_breadcrumb = true;
    $overlay = '';
    if (isset($page_options['condition']['custom_page_c']) && $page_options['condition']['custom_page_c'] == '1') {
        $page_title_tag = isset($page_options['static']['page_title_tag_s']) ? $page_options['static']['page_title_tag_s'] : 'h1';
        $is_breadcrumb = isset($page_options['condition']['breadcrumb_hide_show_c']) && $page_options['condition']['breadcrumb_hide_show_c'] == '1' ? true : false;
        $is_title = isset($page_options['condition']['page_title_c']) && $page_options['condition']['page_title_c'] == '1' ? true : false;
        $overlay = isset($page_options['condition']['overlay_c']) && $page_options['condition']['overlay_c'] == '1' ? 'bg-overlay' : '';
    }
    
@endphp
@extends('theme/default::frontend.layout.master')

@section('seo')
    {{-- SEO --}}
    <title> {{ $breadcrumb_title }}</title>
    <meta name="title" content="{{ front_translate('Contact') }}">
    <meta name="description" content="{{ $generalSettings['site_meta_description'] }}">
    <meta name="keywords" content="{{ $generalSettings['site_meta_keywords'] }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $breadcrumb_title }}">
    <meta property="og:description" content="{{ $generalSettings['site_meta_description'] }}">
    <meta name="twitter:card" content="{{ $generalSettings['site_meta_description'] }}">
    <meta name="twitter:title" content="{{ $breadcrumb_title }}">
    <meta name="twitter:description" content="{{ $generalSettings['site_meta_description'] }}">
    <meta name="twitter:image" content="{{ asset(getFilePath($generalSettings['site_meta_image'])) }}">
    <meta property="og:image" content="{{ asset(getFilePath($generalSettings['site_meta_image'])) }}">
@endsection

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('themes/default/public/assets/css/blog.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('/public/backend/assets/plugins/select2/select2.min.css') }}">
    <!--  End select2  -->
    <style>
        .footer-newsletter {
            padding: 60px 0;
        }
        .footer-newsletter.newsletter-cover .nl-bg-ol {
            background: #fff;
        }
    </style>
@endsection



@section('content')

<style>
    .contact-us-banner {
    display: flex;
    height: 50vh;
    align-items: center;
    justify-content: center;
    padding: 100px 20px;
    background-image: url('/public/storage/all_files/2024/Sep/contact-us_1091.png');
    background-repeat: no-repeat;
    background-size: cover;
    background-color: #0000008f;
    background-position: center;
    background-blend-mode: overlay;
  }
  .vertial-center-items h3 {
    font-family: var(--font-family);
    font-weight: 400;
    color: #FEFEFE;
    font-size: 20px;
    line-height: 30px;
    margin-bottom: 30px;
  }
  .vertial-center-items h1 {
    font-family: var(--font-family);
    font-weight: 700;
    color: white;
    font-size: 60px;
    line-height: 70px;
    margin-bottom: 20px;
    margin-top: 0px;
  }
</style>

<section class="contact-us-banner">
      <div class="container">
        <div class="vertial-center-items">
          <h3>ZenithBlox's capabilities & benefits</h3>
          <h1>Contact Us</h1>
        </div>
      </div>
    </section>
@endsection

@section('custom-js')
@endsection


