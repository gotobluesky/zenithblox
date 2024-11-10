
{{-- Google Fonts Link preconnect --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

@if (isset($body_typography['static']['body_typography_google_link_s']) &&
    !str_contains($body_typography['static']['body_typography_google_link_s'], 'custom'))
    <!-- Body font google link -->
    <link href="{{ $body_typography['static']['body_typography_google_link_s'] }}"rel="stylesheet" type="text/css">
@endif

@if (isset($paragraph_typography['static']['paragraph_typography_google_link_s']) && !str_contains($paragraph_typography['static']['paragraph_typography_google_link_s'], 'custom'))
    <!-- paragraph font google link -->
    <link href="{{ $paragraph_typography['static']['paragraph_typography_google_link_s'] }}"rel="stylesheet"
        type="text/css">
@endif

@if (isset($heading_typography['static']['all_heading_typography_google_link_s']) &&
    !str_contains($heading_typography['static']['all_heading_typography_google_link_s'], 'custom'))
    <!-- all heading font google link -->
    <link href="{{ $heading_typography['static']['all_heading_typography_google_link_s'] }}"rel="stylesheet"
        type="text/css">
@endif

@if (isset($heading_typography['static']['h1_heading_typography_google_link_s']) &&
    !str_contains($heading_typography['static']['h1_heading_typography_google_link_s'], 'custom'))
    <!-- h1 heading font google link -->
    <link href="{{ $heading_typography['static']['h1_heading_typography_google_link_s'] }}"rel="stylesheet"
        type="text/css">
@endif

@if (isset($heading_typography['static']['h2_heading_typography_google_link_s']) &&
    !str_contains($heading_typography['static']['h2_heading_typography_google_link_s'], 'custom'))
    <!-- h2 heading font google link -->
    <link href="{{ $heading_typography['static']['h2_heading_typography_google_link_s'] }}"rel="stylesheet"
        type="text/css">
@endif

@if (isset($heading_typography['static']['h3_heading_typography_google_link_s']) &&
    !str_contains($heading_typography['static']['h3_heading_typography_google_link_s'], 'custom'))
    <!-- h3 headingh font google link -->
    <link href="{{ $heading_typography['static']['h3_heading_typography_google_link_s'] }}"rel="stylesheet"
        type="text/css">
@endif

@if (isset($heading_typography['static']['h4_heading_typography_google_link_s']) &&
    !str_contains($heading_typography['static']['h4_heading_typography_google_link_s'], 'custom'))
    <!-- h4 heading font google link -->
    <link href="{{ $heading_typography['static']['h4_heading_typography_google_link_s'] }}"rel="stylesheet"
        type="text/css">
@endif

@if (isset($heading_typography['static']['h5_heading_typography_google_link_s']) &&
    !str_contains($heading_typography['static']['h5_heading_typography_google_link_s'], 'custom'))
    <!-- h5 heading font google link -->
    <link href="{{ $heading_typography['static']['h5_heading_typography_google_link_s'] }}"rel="stylesheet"
        type="text/css">
@endif

@if (isset($heading_typography['static']['h6_heading_typography_google_link_s']) &&
    !str_contains($heading_typography['static']['h6_heading_typography_google_link_s'], 'custom'))
    <!-- h6 heading font google link -->
    <link href="{{ $heading_typography['static']['h6_heading_typography_google_link_s'] }}"rel="stylesheet"
        type="text/css">
@endif

@if (isset($menu_typography['static']['menu_typography_google_link_s']) &&
    !str_contains($menu_typography['static']['menu_typography_google_link_s'], 'custom'))
    <!-- menu font google link -->
    <link href="{{ $menu_typography['static']['menu_typography_google_link_s'] }}"rel="stylesheet" type="text/css">
@endif

@if (isset($menu_typography['static']['sub_menu_typography_google_link_s']) &&
    !str_contains($menu_typography['static']['sub_menu_typography_google_link_s'], 'custom'))
    <!-- sub menu font google link -->
    <link href="{{ $menu_typography['static']['sub_menu_typography_google_link_s'] }}"rel="stylesheet" type="text/css">
@endif

@if (isset($button_typography['static']['button_typography_google_link_s']) &&
    !str_contains($button_typography['static']['button_typography_google_link_s'], 'custom'))
    <!-- button font google link -->
    <link href="{{ $button_typography['static']['button_typography_google_link_s'] }}"rel="stylesheet" type="text/css">
@endif

@if (isset($sidebar_options['static']['widget_title_typography_google_link_s']) &&
    !str_contains($sidebar_options['static']['widget_title_typography_google_link_s'], 'custom'))
    <!-- Widget Title google link -->
    <link href="{{ $sidebar_options['static']['widget_title_typography_google_link_s'] }}"rel="stylesheet"
        type="text/css">
@endif

@if (isset($page_options['static']['page_title_typography_google_link_s']) &&
    !str_contains($page_options['static']['page_title_typography_google_link_s'], 'custom'))
    <!-- Page Title google link -->
    <link href="{{ $page_options['static']['page_title_typography_google_link_s'] }}"rel="stylesheet" type="text/css">
@endif
