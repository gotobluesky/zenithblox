<?php

namespace Theme\Default\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Theme\Default\Models\TlThemeOptionSettings;

class ThemeOptionRepository
{

    /**
     ** Saving Theme Option
     * @param object $request
     * @return void
     */
    public function saveThemeOption($request)
    {
        $active_theme = getActiveTheme();
        $data = [];
        $option_name = $request->option_name;
        foreach ($request->all() as $key => $value) {
            if (!($key == '_token' || $key == 'submitType' || $key == 'option_name')) {
                $theme_options = TlThemeOptionSettings::where('option_name', $option_name)
                    ->where('theme_id', $active_theme->id)
                    ->where('field_name', $key);
                if ($theme_options->exists()) {
                    $theme_options->update([
                        'field_value' => xss_clean($value)
                    ]);
                } else {
                    $option_value = [
                        'option_name' => $option_name,
                        'theme_id' => $active_theme->id,
                        'field_name' => $key,
                        'field_value' => xss_clean($value),
                    ];
                    array_push($data, $option_value);
                }
            }
        };

        if (count($data) > 0) {
            TlThemeOptionSettings::insert($data);
        }
        // cache clear for theme option
        Cache::forget('theme-option-settings');

        // if theme option is subscribe then updating the Mailchimp env
        if ($option_name == 'subscribe') {
            setEnv('MAILCHIMP_APIKEY', str_replace(' ', '', $request->mailchimp_api_key));
            setEnv('MAILCHIMP_LIST_ID', str_replace(' ', '', $request->mailchimp_list_id));
        }

        // saving css file
        switch ($option_name) {
            case 'back_to_top':
                $back_to_top = getThemeOption('back_to_top', $active_theme->id);
                $this->setBackToTopStyle($back_to_top);
                break;
            case 'preloader':
                $preloader = getThemeOption('preloader', $active_theme->id);
                $this->setPreloaderStyle($preloader);
                break;
            case 'header':
                $header = getThemeOption('header', $active_theme->id);
                $this->setHeaderOptionsStyle($header);
                break;
            case 'header_logo':
                $header_logo = getThemeOption('header_logo', $active_theme->id);
                $this->setHeaderLogoStyle($header_logo);
                break;
            case 'menu':
                $menu = getThemeOption('menu', $active_theme->id);
                $this->setMenuStyle($menu);
                break;
            case 'mobile_menu':
                $mobile_menu = getThemeOption('mobile_menu', $active_theme->id);
                $this->setMobileMenuStyle($mobile_menu);
                break;
            case 'blog':
                $blog = getThemeOption('blog', $active_theme->id);
                $this->setBlogStyle($blog);
                break;
            case 'single_blog_page':
                if (isset($request->blog_details_custom_title)) {
                    storeFrontendTranslation($request->blog_details_custom_title);
                }
                if (isset($request->section_title)) {
                    storeFrontendTranslation($request->section_title);
                }
                break;
            case 'sidebar_options':
                $style = themeOptionToCss('sidebar_options', $active_theme->id);
                $this->setSidebarOptionStyle($style);
                break;
            case 'page':
                $page = themeOptionToCss('page', $active_theme->id);
                $this->setPageStyle($page);
                break;
            case 'contact':
                $this->contactStyle($request);
                break;
            case 'subscribe':
                $subscribe = getThemeOption('subscribe', $active_theme->id);
                $this->setFooterSubscribeStyle($subscribe);
                break;
            case 'footer':
                $footer = getThemeOption('footer', $active_theme->id);
                $this->setFooterStyle($footer);
                break;
            case 'page_404':
                $page_404 = themeOptionToCss('page_404', $active_theme->id);
                $this->setPage404Style($page_404);
                break;
            case 'custom_css':
                $custom_css = $request->custom_css_code;
                $path = base_path('themes/default/public/assets/css/custom_css.css');
                setFolderPermissions($path);
                file_put_contents($path, $custom_css);
                break;

            default:
                # code...
                break;
        }
    }

    /**
     * set back to top style
     */
    private function setBackToTopStyle($style)
    {
        foreach ($style as $key => $value) {
            if (str_contains($key, 'transparent') && $value == 1) {
                $color = str_replace('_transparent', '', $key);
                $style[$color] = 'transparent';
            }
        }
        $themeOption = [];
        $styleProperties = "";
        if (isset($style['back_to_top_button']) && $style['back_to_top_button'] == 1 && isset($style['custom_back_to_top_button']) && $style['custom_back_to_top_button'] == 1) {
            foreach ($style as $key => $value) {
                if ($key == 'back_to_top_button_bgcolor' && $value != "") {
                    $themeOption['.custom-style']['background-color'] = $value . "!important;";
                }
                if ($key == 'back_to_top_button_color' && $value != "") {
                    $themeOption['.custom-style']['color'] = $value . "!important;";
                }
                if ($key == 'back_to_top_button_hover_bgcolor' && $value != "") {
                    $themeOption['.custom-style:hover']['background-color'] = $value . "!important;";
                }
                if ($key == 'back_to_top_button_hover_color' && $value != "") {
                    $themeOption['.custom-style:hover']['color'] = $value . "!important;";
                }
                if ($key == 'back_to_top_button_on_mobile' && $value == 0) {
                    $themeOption['@media (max-width:575px)']['.custom-style']['display'] = 'none !important;';
                }
            }
            $styleProperties = makeCssProperties($themeOption);
        }
        $path = base_path('themes/default/public/assets/css/back_to_top.css');
        setFolderPermissions($path);
        file_put_contents($path, $styleProperties);
    }

    /**
     * set preloader style
     */
    private function setPreloaderStyle($style)
    {
        // Save the Text Field in Frontend Translation
        if (isset($style['preloader_text'])) {
            storeFrontendTranslation($style['preloader_text']);
        }
        $themeOption = [];
        $styleProperties = "";
        if (isset($style['preloader_field']) && $style['preloader_field'] == 1) {
            if ($style['preloader_bgcolor'] != '' || $style['preloader_bgcolor_transparent'] == 1) {
                $themeOption['.preloader']['background-color'] = ($style['preloader_bgcolor_transparent'] == 1 ? 'transparent' : $style['preloader_bgcolor']) . ';';
            }

            if ($style['preloader_item_color'] != '' || $style['preloader_item_color_transparent'] == 1) {
                $themeOption['.preloader .spinnerBounce .double-bounce1,.preloader .spinnerBounce .double-bounce2']['background-color'] = ($style['preloader_item_color_transparent'] == 1 ? 'transparent' : $style['preloader_item_color']) . ';';
            }
            $styleProperties = makeCssProperties($themeOption);
        }
        $path = base_path('themes/default/public/assets/css/preloader.css');
        setFolderPermissions($path);
        file_put_contents($path, $styleProperties);
    }

    /**
     * set header style
     */
    private function setHeaderOptionsStyle($style)
    {
        foreach ($style as $key => $value) {
            if (str_contains($key, 'transparent') && $value == 1) {
                $color = str_replace('_transparent', '', $key);
                $style[$color] = 'transparent';
            }
        }

        $themeOption = [];
        $styleProperties = "";

        foreach ($style as $key => $value) {
            if ($key == 'header_bg_color' && $value != "") {
                $themeOption['.header .header-fixed']['background-color'] = $value . "!important;";
            }
            if ($key == 'sticky_header_bg_color' && $value != "") {
                $themeOption['.header .header-fixed.is-sticky']['background-color'] = $value . "!important;";
            }
            if ($key == 'header_search_icon_color' && $value != "" && $style['header_search_icon'] == 1) {
                $themeOption['.mobile-nav-menu li svg g line,.mobile-nav-menu li svg g path']['stroke'] = $value . "!important;";
            }
            if ($key == 'sticky_header_search_icon_color' && $value != "" && $style['header_search_icon'] == 1) {
                $themeOption['.is-sticky .mobile-nav-menu li svg g line,.is-sticky .mobile-nav-menu li svg g path']['stroke'] = $value . "!important;";
            }
        }
        $styleProperties = makeCssProperties($themeOption);
        $path = base_path('themes/default/public/assets/css/header.css');
        setFolderPermissions($path);
        file_put_contents($path, $styleProperties);
    }

    /**
     * set header logo style
     */
    public function setHeaderLogoStyle($style)
    {
        foreach ($style as $key => $value) {
            $splitted_key =  explode('_', $key);
            $last_identifier = array_pop($splitted_key);
            $first_identifier = implode('_', $splitted_key);

            if ($last_identifier == 'top' || $last_identifier == 'bottom' || $last_identifier == 'height' || $last_identifier == 'width') {
                if ($value != "") {
                    $style[$key] = $value . $style[$first_identifier . "_unit"];
                }
            }
        }
        $themeOption = [];
        $styleProperties = "";
        if (isset($style['custom_header_style']) && $style['custom_header_style'] == 1) {
            foreach ($style as $key => $value) {
                if ($key == 'logo_dimension_height' && $value != "") {
                    $themeOption['.header .logo a img.default-logo']['height'] = $value . "!important;";
                }
                if ($key == 'logo_dimension_width' && $value != "") {
                    $themeOption['.header .logo a img.default-logo']['width'] = $value . "!important;";
                }
                if ($key == 'logo_margin_top' && $value != "") {
                    $themeOption['.header .logo a img.default-logo']['margin-top'] = $value . "!important;";
                }
                if ($key == 'logo_margin_bottom' && $value != "") {
                    $themeOption['.header .logo a img.default-logo']['margin-bottom'] = $value . "!important;";
                }
                if ($key == 'sticky_logo_dimension_height' && $value != "") {
                    $themeOption['.header .logo a img.sticky-logo']['height'] = $value . "!important;";
                }
                if ($key == 'sticky_logo_dimension_width' && $value != "") {
                    $themeOption['.header .logo a img.sticky-logo']['width'] = $value . "!important;";
                }
                if ($key == 'sticky_logo_margin_top' && $value != "") {
                    $themeOption['.header .logo a img.sticky-logo']['margin-top'] = $value . "!important;";
                }
                if ($key == 'sticky_logo_margin_bottom' && $value != "") {
                    $themeOption['.header .logo a img.sticky-logo']['margin-bottom'] = $value . "!important;";
                }
            }
            $styleProperties = makeCssProperties($themeOption);
        }
        $path = base_path('themes/default/public/assets/css/header_logo.css');
        setFolderPermissions($path);
        file_put_contents($path, $styleProperties);
    }

    /**
     * set menu style
     */
    public function setMenuStyle($style)
    {
        foreach ($style as $key => $value) {
            if (str_contains($key, 'transparent') && $value == 1) {
                $color = str_replace('_transparent', '', $key);
                $style[$color] = 'transparent';
            }
        }
        $themeOption = [];
        $styleProperties = "";
        if (isset($style['custom_menu_style']) && $style['custom_menu_style'] == 1) {
            foreach ($style as $key => $value) {
                if ($key == 'menu_color' && $value != "") {
                    $themeOption['.nav-menu li a']['color'] = $value . "!important;";
                }
                if ($key == 'menu_hover_color' && $value != "") {
                    $themeOption['.nav-menu li:hover > a']['color'] = $value . "!important;";
                }
                if ($key == 'menu_active_item_color' && $value != "") {
                    $themeOption['.active-menu-item']['color'] = $value . "!important;";
                }
                if ($key == 'sub_menu_color' && $value != "") {
                    $themeOption['.nav-menu li .sub-menu li a ']['color'] = $value . "!important;";
                }
                if ($key == 'sub_menu_hover_color' && $value != "") {
                    $themeOption['.nav-menu li .sub-menu li:hover > a ']['color'] = $value . "!important;";
                }
                if ($key == 'sub_menu_active_item_color' && $value != "") {
                    $themeOption['.active-sub-menu-item']['color'] = $value . "!important;";
                }
            }
            $styleProperties = makeCssProperties($themeOption);
        }
        $path = base_path('themes/default/public/assets/css/menu.css');
        setFolderPermissions($path);
        file_put_contents($path, $styleProperties);
    }

    /**
     * set mobile menu style
     */
    public function setMobileMenuStyle($style)
    {
        foreach ($style as $key => $value) {
            if (str_contains($key, 'transparent') && $value == 1) {
                $color = str_replace('_transparent', '', $key);
                $style[$color] = 'transparent';
            }
        }
        $themeOption = [];
        $styleProperties = "";
        if (isset($style['custom_mobile_menu_style']) && $style['custom_mobile_menu_style'] == 1) {
            foreach ($style as $key => $value) {
                if ($key == 'mobile_menu_icon_color' && $value != "") {
                    $themeOption['@media (max-width:575px)']['.header .header-fixed svg.img-fluid.svg.replaced-svg']['stroke'] = $value . "!important;";
                }
                if ($key == 'sticky_header_mobile_menu_icon_color' && $value != "") {
                    $themeOption['@media (max-width:575px)']['.header .header-fixed.is-sticky svg.img-fluid.svg.replaced-svg']['stroke'] = $value . "!important;";
                }
                if ($key == 'mobile_menu_color' && $value != "") {
                    $themeOption['@media (max-width:575px)']['.nav-menu li a']['color'] = $value . "!important;";
                }
                if ($key == 'mobile_menu_hover_color' && $value != "") {
                    $themeOption['@media (max-width:575px)']['.nav-menu li:hover > a']['color'] = $value . "!important;";
                }
                if ($key == 'mobile_menu_active_item_color' && $value != "") {
                    $themeOption['@media (max-width:575px)']['.active-menu-item']['color'] = $value . "!important;";
                }
                if ($key == 'mobile_sub_menu_color' && $value != "") {
                    $themeOption['@media (max-width:575px)']['.nav-menu li .sub-menu li a ']['color'] = $value . "!important;";
                }
                if ($key == 'mobile_sub_menu_hover_color' && $value != "") {
                    $themeOption['@media (max-width:575px)']['.nav-menu li .sub-menu li:hover > a ']['color'] = $value . "!important;";
                }
                if ($key == 'mobile_sub_menu_active_item_color' && $value != "") {
                    $themeOption['@media (max-width:575px)']['.active-sub-menu-item']['color'] = $value . "!important;";
                }
            }
            $styleProperties = makeCssProperties($themeOption);
        }
        $path = base_path('themes/default/public/assets/css/mobile_menu.css');
        setFolderPermissions($path);
        file_put_contents($path, $styleProperties);
    }

    /**
     * set blog style
     */
    public function setBlogStyle($style)
    {
        // Save the Text Field in Frontend Translation
        if (isset($style['blog_custom_title'])) {
            storeFrontendTranslation($style['blog_custom_title']);
        }
        if (isset($style['read_more_text'])) {
            storeFrontendTranslation($style['read_more_text']);
        }

        foreach ($style as $key => $value) {
            if (str_contains($key, 'transparent') && $value == 1) {
                $color = str_replace('_transparent', '', $key);
                $style[$color] = 'transparent';
            }
        }
        $themeOption = [];
        $styleProperties = '';
        if (isset($style['custom_blog_style']) && $style['custom_blog_style'] == 1) {
            foreach ($style as $key => $value) {
                if ($key == 'blog_pagination_color' && $value != "") {
                    $themeOption['.post-pagination a']['color'] = $value . "!important;";
                }
                if ($key == 'blog_pagination_bg_color' && $value != "") {
                    $themeOption['.post-pagination a']['background-color'] = $value . "!important;";
                }
                if ($key == 'blog_pagination_hover_color' && $value != "") {
                    $themeOption['.post-pagination a:hover']['color'] = $value . "!important;";
                }
                if ($key == 'blog_pagination_hover_bg_color' && $value != "") {
                    $themeOption['.post-pagination a:hover']['background-color']  = $value . "!important;";
                }
                if ($key == 'blog_pagination_active_color' && $value != "") {
                    $themeOption['.post-pagination a.current']['color'] = $value . "!important;";
                }
                if ($key == 'blog_pagination_active_bg_color' && $value != "") {
                    $themeOption['.post-pagination a.current']['background-color'] = $value . "!important;";
                }
            }
            $styleProperties = makeCssProperties($themeOption);
        }
        $path = base_path('themes/default/public/assets/css/blog.css');
        setFolderPermissions($path);
        file_put_contents($path, $styleProperties);
    }

    /**
     * set sidebar option style
     */
    public function setSidebarOptionStyle($style)
    {
        $widget = ['widget'];
        $widget_custom = ['widget_custom', 'widget_margin', 'widget_padding', 'widget_border'];
        $widget_title = ['widget_title', 'widget_title_font', 'widget_title_margin', 'widget_title_padding'];
        $widget_text = ['widget_text'];
        $widget_anchor = ['widget_anchor'];
        $widget_anchor_hover = ['widget_anchor_hover'];
        $themeOption = [];
        $styleProperties = '';

        if (isset($style['css']) && count($style['css']) > 0 && $style['condition']['custom_sidebar_c'] == 1) {
            foreach ($style['css'] as $key => $values) {
                foreach ($values as $property => $value) {
                    if (in_array($key, $widget)) {
                        $themeOption['.widget'][$property] = $value . ';';
                    } elseif (in_array($key, $widget_custom)) {
                        $themeOption['.widget'][$property] = $value . ';';
                    } elseif (in_array($key, $widget_title)) {
                        $themeOption['.widget .widget-title'][$property] = $value . ';';
                    } elseif (in_array($key, $widget_text)) {
                        $themeOption['.widget'][$property] = $value . ';';
                    } elseif (in_array($key, $widget_anchor)) {
                        $themeOption['.widget a'][$property] = $value . ';';
                    } elseif (in_array($key, $widget_anchor_hover)) {
                        $themeOption['.widget a:hover'][$property] = $value . ';';
                    } else {
                        $themeOption[$key][$property] = $value . ';';
                    }
                }
            }
            $styleProperties = makeCssProperties($themeOption);
        }
        $path = base_path('themes/default/public/assets/css/sidebar_options.css');
        setFolderPermissions($path);
        file_put_contents($path, $styleProperties);
    }

    /**
     * set page style
     */
    public function setPageStyle($style)
    {
        $page = ['page'];
        $page_title = ['page_title_font'];
        $overlay = ['overlay'];
        $breadcrumb = ['breadcrumb'];
        $breadcrumb_activer = ['breadcrumb_activer'];
        $breadcrumb_divider = ['breadcrumb_divider'];
        $themeOption = [];
        $styleProperties = '';

        if (isset($style['css']) && count($style['css']) > 0 && $style['condition']['custom_page_c'] == 1) {
            foreach ($style['css'] as $key => $values) {
                foreach ($values as $property => $value) {
                    if (in_array($key, $page)) {
                        $themeOption['.page-title'][$property] = $value . ';';
                    } elseif ($style['condition']['page_title_c'] == '1' && in_array($key, $page_title)) {
                        $themeOption['.page-title .title'][$property] = $value . ';';
                    } elseif ($style['condition']['overlay_c'] == '1' && in_array($key, $overlay)) {
                        $themeOption['.page-title.bg-overlay:before'][$property] = $value . ';';
                    } elseif ($style['condition']['breadcrumb_hide_show_c'] == '1' && in_array($key, $breadcrumb)) {
                        $themeOption['.page-title .nav li, .page-title .nav li a'][$property] = $value . ';';
                    } elseif ($style['condition']['breadcrumb_hide_show_c'] == '1' && in_array($key, $breadcrumb_activer)) {
                        $themeOption['.page-title .nav li.active'][$property] = $value . ';';
                    } elseif ($style['condition']['breadcrumb_hide_show_c'] == '1' && in_array($key, $breadcrumb_divider)) {
                        $themeOption['.page-title .nav li:after'][$property] = $value . ';';
                    } else {
                        $themeOption[$key][$property] = $value . ';';
                    }
                }
            }
            $styleProperties = makeCssProperties($themeOption);
        }
        $path = base_path('themes/default/public/assets/css/page.css');
        setFolderPermissions($path);
        file_put_contents($path, $styleProperties);
    }

    /**
     * contact page style
     */
    public function contactStyle($request)
    {
        // Save the Text Field in Frontend Translation
        if (isset($request['contact_title'])) {
            storeFrontendTranslation($request['contact_title']);
        }
        if (isset($request['contact_subtitle'])) {
            storeFrontendTranslation($request['contact_subtitle']);
        }
        if (isset($request['contact_name_placeholder'])) {
            storeFrontendTranslation($request['contact_name_placeholder']);
        }
        if (isset($request['contact_email_placeholder'])) {
            storeFrontendTranslation($request['contact_email_placeholder']);
        }
        if (isset($request['contact_subject_placeholder'])) {
            storeFrontendTranslation($request['contact_subject_placeholder']);
        }
        if (isset($request['contact_message_placeholder'])) {
            storeFrontendTranslation($request['contact_message_placeholder']);
        }
        if (isset($request['contact_button_text'])) {
            storeFrontendTranslation($request['contact_button_text']);
        }
        if (isset($request['contact_header_text'])) {
            storeFrontendTranslation($request['contact_header_text']);
        }
    }

    /**
     * set 404 page style
     */
    public function setPage404Style($style)
    {
        // Save the Text Field in Frontend Translation
        if (isset($style['static']['page_404_title_s'])) {
            storeFrontendTranslation($style['static']['page_404_title_s']);
        }
        if (isset($style['static']['page_404_subtitle_s'])) {
            storeFrontendTranslation($style['static']['page_404_subtitle_s']);
        }
        if (isset($style['static']['page_404_button_before_text_s'])) {
            storeFrontendTranslation($style['static']['page_404_button_before_text_s']);
        }
        if (isset($style['static']['page_404_button_text_s'])) {
            storeFrontendTranslation($style['static']['page_404_button_text_s']);
        }

        $themeOption = [];
        $styleProperties = '';
        if (isset($style['css']) && count($style['css']) > 0  && $style['condition']['custom_404_page_c'] == 1) {
            foreach ($style['css'] as $key => $values) {
                foreach ($values as $property => $value) {
                    if ($key === 'page_404') {
                        $themeOption['#section_404'][$property] = $value . ';';
                    } elseif ($key === 'overlay' && $style['condition']['background_overlay_c'] == '1') {
                        $themeOption['#section_404.overlay:before'][$property] = $value . ';';
                    } elseif ($key === 'title') {
                        $themeOption['#section_404 .title'][$property] = $value . ';';
                    } elseif ($key === 'subtitle') {
                        $themeOption['#section_404 .subtitle'][$property] = $value . ';';
                    } elseif ($key === 'before_button_text') {
                        $themeOption['#section_404 .before_button_text'][$property] = $value . ';';
                    } elseif ($key === 'before_button') {
                        $themeOption['#section_404 .before_button'][$property] = $value . ';';
                    } elseif ($key === 'before_button_hover') {
                        $themeOption['#section_404 .before_button:hover'][$property] = $value . ';';
                    }
                }
            }
            $styleProperties = makeCssProperties($themeOption);
        }

        $path = base_path('themes/default/public/assets/css/page_404.css');
        setFolderPermissions($path);
        file_put_contents($path, $styleProperties);
    }

    /**
     * set subscribe style
     */
    public function setFooterSubscribeStyle($style)
    {
        // Save the Text Field in Frontend Translation
        if (isset($style['subscribe_form_title'])) {
            storeFrontendTranslation($style['subscribe_form_title']);
        }
        if (isset($style['subscribe_form_placeholder'])) {
            storeFrontendTranslation($style['subscribe_form_placeholder']);
        }
        if (isset($style['subscribe_form_button_text'])) {
            storeFrontendTranslation($style['subscribe_form_button_text']);
        }

        foreach ($style as $key => $value) {
            if (str_contains($key, 'transparent') && $value == 1) {
                $color = str_replace('_transparent', '', $key);
                $style[$color] = 'transparent';
            }
        }
        $themeOption = [];
        $styleProperties = "";
        if (isset($style['custom_footer_subscribe']) && $style['custom_footer_subscribe'] == 1) {
            foreach ($style as $key => $value) {
                if ($key == 'form_privacy_text_color' && $value != "" && $style['privacy_policy'] == 1) {
                    $themeOption['.newsletter-cover .newsletter .checkbox-cover label']['color'] = $value . "!important;";
                }
                if ($key == 'form_privacy_text_anchor_color' && $value != "" && $style['privacy_policy'] == 1) {
                    $themeOption['.newsletter-cover .newsletter .checkbox-cover label a']['color'] = $value . "!important;";
                }
                if ($key == 'form_bg_color' && $value != "") {
                    $themeOption['.newsletter-cover .newsletter']['background-color'] = $value . "!important;";
                }
                if ($key == 'form_title_color' && $value != "") {
                    $themeOption['.newsletter-cover .newsletter .section-title h2']['color'] = $value . "!important;";
                }
                if ($key == 'form_input_color' && $value != "") {
                    $themeOption['.newsletter-cover .newsletter form input']['background-color'] = $value . "!important;";
                }
                if ($key == 'form_submit_button_color' && $value != "") {
                    $themeOption['.newsletter-cover .newsletter form .btn']['color'] = $value . "!important;";
                }
                if ($key == 'form_submit_button_bg_color' && $value != "") {
                    $themeOption['.newsletter-cover .newsletter form .btn']['background-color'] = $value . "!important;";
                }
            }
            $styleProperties = makeCssProperties($themeOption);
        }
        $path = base_path('themes/default/public/assets/css/subscribe.css');
        setFolderPermissions($path);
        file_put_contents($path, $styleProperties);
    }

    /**
     * set footer style
     */
    public function setFooterStyle($style)
    {
        foreach ($style as $key => $value) {
            $splitted_key =  explode('_', $key);
            $last_identifier = array_pop($splitted_key);
            $first_identifier = implode('_', $splitted_key);

            if ($last_identifier == 'top' || $last_identifier == 'bottom') {
                if ($value != "") {
                    $style[$key] = $value . $style[$first_identifier . "_unit"];
                }
            }

            if ($last_identifier == 'transparent') {
                if ($style[$first_identifier . "_transparent"] == 1) {
                    $style[$first_identifier] = 'transparent';
                }
            }
        }
        $themeOption = [];
        $styleProperties = "";
        if (isset($style['custom_footer_style']) && $style['custom_footer_style'] == 1) {
            foreach ($style as $key => $value) {
                if ($key == 'footer_bg_color' && $value != "") {
                    $themeOption['.footer-container']['background-color'] = $value . "!important;";
                    $themeOption['.newsletter-cover .nl-bg-ol']['background-color'] = $value . "!important;";
                }
                if ($key == 'custom_footer_padding_top' && $value != "") {
                    $themeOption['.footer-container']['padding-top'] = $value . "!important;";
                }
                if ($key == 'custom_footer_padding_bottom' && $value != "") {
                    $themeOption['.footer-container']['padding-bottom'] = $value . "!important;";
                }

                if (isset($style['footer_social_enable']) && $style['footer_social_enable'] == 1) {
                    if ($key == 'footer_social_color' && $value != "") {
                        $themeOption['.footer-social a']['color'] = $value . "!important;";
                    }
                    if ($key == 'footer_social_hover_color' && $value != "") {
                        $themeOption['.footer-social a:hover']['color'] = $value . "!important;";
                    }
                    if ($key == 'footer_social_alignment' && $value != "") {
                        $themeOption['.footer-social']['text-align'] = $value . "!important;";
                    }
                }
                if (isset($style['footer_text_enable']) && $style['footer_text_enable'] == 1) {
                    if ($key == 'footer_text_color' && $value != "") {
                        $themeOption['.footer-cradit']['color'] = $value . "!important;";
                    }
                    if ($key == 'footer_anchor_text_color' && $value != "") {
                        $themeOption['.footer-cradit a']['color'] = $value . "!important;";
                    }
                    if ($key == 'footer_anchor_text_hover_color' && $value != "") {
                        $themeOption['.footer-cradit a:hover']['color'] = $value . "!important;";
                    }
                }
            }
            $styleProperties = makeCssProperties($themeOption);
        }
        $path = base_path('themes/default/public/assets/css/footer.css');
        setFolderPermissions($path);
        file_put_contents($path, $styleProperties);
    }


    /**
     ** reset Theme Option
     * @param object $request
     * @return void
     */
    public function resetThemeOption($request)
    {
        // all css file name
        $themeOptionCssFile = [
            'back_to_top',
            'preloader',
            'header',
            'header_logo',
            'menu',
            'mobile_menu',
            'blog',
            'sidebar_options',
            'page',
            'page_404',
            'subscribe',
            'footer',
            'custom_css'
        ];

        $active_theme = getActiveTheme();
        $options =  TlThemeOptionSettings::where('theme_id', $active_theme->id);

        // reset section
        if ($request->submitType == 'reset_section') {
            $path = base_path('themes/default/public/assets/css/' . $request->option_name . '.css');
            if (file_exists($path)) {
                unlink($path);
            }
            fopen($path, 'w');
            chmod($path, 0777);
            file_put_contents($path, '');
            $options = $options->where('option_name', $request->option_name);
        }

        //  reset all file
        if ($request->submitType == 'reset_all') {
            for ($i = 0; $i < sizeof($themeOptionCssFile); $i++) {
                $path = base_path('themes/default/public/assets/css/' . $themeOptionCssFile[$i] . '.css');
                if (file_exists($path)) {
                    unlink($path);
                }
                fopen($path, 'w');
                chmod($path, 0777);
                file_put_contents($path, '');
            }
        }

        // update database
        $options = $options->update([
            'field_value' =>  DB::raw('field_reset_value')
        ]);
        // cache clear for theme option
        Cache::forget('theme-option-settings');
    }


    /**
     **  save social link
     * @param object $request
     * @return void
     */
    public function saveSocialLink($request)
    {
        $active_theme = getActiveTheme();
        $data = [];

        // icon title
        for ($i = 0; $i < sizeof($request->social_icon_title); $i++) {
            $data[$i]['social_icon_title'] = $request->social_icon_title[$i];
        }

        // icon
        for ($i = 0; $i < sizeof($request->social_icon); $i++) {
            $data[$i]['social_icon'] = $request->social_icon[$i];
        }

        // icon url
        for ($i = 0; $i < sizeof($request->social_icon_url); $i++) {
            $data[$i]['social_icon_url'] = $request->social_icon_url[$i];
        }

        //order
        foreach ($data as $key => $value) {
            $data[$key]['order'] = $key + 1;
        }

        $encoded_data = json_encode($data);

        $option = TlThemeOptionSettings::firstOrNew([
            'option_name' => 'social',
            'theme_id' => $active_theme->id,
            'field_name' => 'social_field'
        ]);

        $option->option_name = 'social';
        $option->theme_id = $active_theme->id;
        $option->field_name = 'social_field';
        $option->field_value = xss_clean($encoded_data);

        $option->exists ? $option->update() : $option->save();

        // cache clear for theme option
        Cache::forget('theme-option-settings');
    }




    /**
     ** Save Google Adsense
     * @param object $request
     * @return void
     */
    public function saveAdsense($request)
    {
        $active_theme = getActiveTheme();
        $data = [];

        // title
        for ($i = 0; $i < sizeof($request->adsense_title); $i++) {
            $data[$i]['adsense_title'] = $request->adsense_title[$i];
        }

        // code
        for ($i = 0; $i < sizeof($request->adsense_code); $i++) {
            $data[$i]['adsense_code'] = $request->adsense_code[$i];
        }

        // index
        for ($i = 0; $i < sizeof($request->adsense_index); $i++) {
            $data[$i]['adsense_index'] = $request->adsense_index[$i];
        }

        $encoded_data = json_encode($data);

        $option = TlThemeOptionSettings::firstOrNew([
            'option_name' => 'google_adsense',
            'theme_id' => $active_theme->id,
            'field_name' => 'adsense_list'
        ]);

        $option->field_value = $encoded_data;

        $option->save();

        // cache clear for theme option
        Cache::forget('theme-option-settings');
    }


    /**
     ** Save Custom Fonts
     * @param object $request
     * @return void
     */
    public function saveCustomFont($request)
    {
        $active_theme = getActiveTheme();
        $location = 'themes/default/public/assets/';
        $font_file = ['woff', 'ttf', 'eot'];

        foreach ($request->all() as $key => $value) {
            if (str_contains($key, 'custom_font_1')) {
                $folder = 'custom_font_1';
            } elseif (str_contains($key, 'custom_font_2')) {
                $folder = 'custom_font_2';
            }

            if (str_contains($key, 'file')) {
                if ($request->hasFile($key)) {
                    $file = $request->file($key);
                    $name = $file->getClientOriginalName();
                    $path = asset($location . $folder . '/' . $name);
                    if (!file_exists($path)) {
                        $file->move($location . $folder . '/', $name);
                    }
                }
            }

            $key_array = explode('_', $key);
            $file_type = array_pop($key_array);

            if (in_array($file_type, $font_file)) {
                if ($value == '') {
                    $active_theme = getActiveTheme();
                    $name = TlThemeOptionSettings::where([
                        ['theme_id', $active_theme->id],
                        ['option_name', 'custom_fonts'],
                        ['field_name', $key]
                    ])->first();
                    if ($name && $name->field_value != null) {
                        unlink($location . $folder . '/' . $name->field_value);
                    }
                }
            }
        }
        $this->saveThemeOption($request);
    }
}
