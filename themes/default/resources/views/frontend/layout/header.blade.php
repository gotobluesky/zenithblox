@php
    // Theme Option and Settings
    $header_logo = isset($logo_details['white_background_logo']) ? $logo_details['white_background_logo'] : null;
    $mobile_logo = isset($logo_details['white_mobile_background_logo']) ? $logo_details['white_mobile_background_logo'] : null;
    $sticky_header_logo = isset($logo_details['sticky_background_logo']) ? $logo_details['sticky_background_logo'] : null;
    $mobile_sticky_header_logo = isset($logo_details['sticky_mobile_background_logo']) ? $logo_details['sticky_mobile_background_logo'] : null;
    
    $dark_header_logo = isset($logo_details['black_background_logo']) ? $logo_details['black_background_logo'] : null;
    $dark_mobile_logo = isset($logo_details['black_mobile_background_logo']) ? $logo_details['black_mobile_background_logo'] : null;
    $dark_sticky_header_logo = isset($logo_details['sticky_black_background_logo']) ? $logo_details['sticky_black_background_logo'] : null;
    $dark_mobile_sticky_header_logo = isset($logo_details['sticky_black_mobile_background_logo']) ? $logo_details['sticky_black_mobile_background_logo'] : null;
    
    $text_logo = isset($logo_details['system_name']) ? $logo_details['system_name'] : null;
    
    $contact_header = isset($contact['contact_header_menu']) && $contact['contact_header_menu'] == 1 ? true : false;
    $contact_text = isset($contact['contact_header_text']) && $contact['contact_header_text'] != '' ? front_translate($contact['contact_header_text']) : front_translate('Contact');
    
    $mood = 'light';
    if (session()->has('frontend-mood')) {
        $mood = session()->get('frontend-mood');
    }


    $menu_position = getMenuPositionId(config('default.menu_position')[0]);
    $data = getMenuStructure($menu_position);
    
    function getActiveMenuColor($index, $data)
    {
        $currentUrl = URL::current();
        $class = '';
        if ($data[$index]->level == 1) {
            if (url($data[$index]->url) == $currentUrl) {
                $class = 'active-menu-item';
            }
        } else {
            if (url($data[$index]->url) == $currentUrl) {
                $class = 'active-sub-menu-item';
            }
        }
    
        $i = $index + 1;
        while ($i < sizeof($data) && $data[$i]->level > $data[$index]->level) {
            if (url($data[$i]->url) == $currentUrl) {
                if ($data[$index]->level == 1) {
                    $class = 'active-menu-item';
                } else {
                    $class = 'active-sub-menu-item';
                }
                break;
            }
            $i++;
        }
        return $class;
    }
@endphp
<!-- Header -->

<style>
.mobile-nav-menu li.search-toggle-open, .mobile-nav-menu li.search-toggle-close {
    width: 26px;
}
.custom-theme-btn {
    margin-left: 20px;
    font-family: var(--font-family);
    font-weight: 600;
    color: white;
    padding: 15px 15px;
    border: none;
    outline: none;
    color: #FFF;
    cursor: pointer;
    position: relative;
    z-index: 0;
    border-radius: 5px;
    background: linear-gradient(90deg, rgba(169, 85, 247, 0.695) 0%, rgba(101, 113, 189, 0.671) 100%);
    text-transform: uppercase;
    font-size: 18px;
}
.custom-theme-btn::before {
    content: "";
    background: linear-gradient(45deg, #6570BE, #A855F7, #8493D0, #650DB8, #650DB8, #8493D0, #A855F7, #6570BE);
    position: absolute;
    top: -2px;
    left: -2px;
    background-size: 600%;
    z-index: -1;
    width: calc(100% + 4px);
    height: calc(100% + 4px);
    filter: blur(8px);
    animation: glowing 25s linear infinite;
    animation-fill-mode: forwards;
    transition: opacity 1s ease-in-out;
    border-radius: 5px;
    opacity: 0;
}
.custom-theme-btn::after {
    content: "";
    z-index: -1;
    position: absolute;
    width: 100%;
    height: 100%;
    background-image: linear-gradient(to left top, #A855F7, #6570BE);
    left: 0;
    top: 0;
    border-radius: 5px;
}
.custom-theme-btn:hover {
    color: #fff !important;
}
.custom-theme-btn:hover::before {
    opacity: 1;
}
</style>

<header class="header">
    <div class="header-fixed">
        <div class="container position-relative">
            <div class="row d-flex align-items-center logo-area">
                <div class="col-lg-3 col-md-4 col-6">
                    <!-- Logo -->
                    <div class="logo">
                        <a href="{{ route('theme.default.home') }}">
                            @if ($mood === 'dark')
                                <!-- Main Header Logo -->
                                @if (isset($dark_header_logo))
                                    <img src="{{ project_asset($dark_header_logo) }}" alt="Logo"
                                        class="img-fluid default-logo">
                                @elseif(isset($text_logo))
                                    <h1 class="default-logo"> {{ $text_logo }} </h1>
                                @endif
                                <!-- Main Header Mobile Logo -->
                                @if (isset($dark_mobile_logo))
                                    <img src="{{ project_asset($dark_mobile_logo) }}" alt="Logo"
                                        class="img-fluid mobile-logo">
                                @elseif(isset($text_logo))
                                    <h1 class="mobile-logo"> {{ $text_logo }} </h1>
                                @endif
                                <!-- Sticky Header Logo -->
                                @if (isset($dark_sticky_header_logo))
                                    <img src="{{ project_asset($dark_sticky_header_logo) }}" alt="Logo"
                                        class="img-fluid sticky-logo">
                                @elseif(isset($text_logo))
                                    <h2 class="sticky-logo"> {{ $text_logo }} </h2>
                                @endif
                                <!-- Sticky Header Mobile Logo -->
                                @if (isset($dark_mobile_sticky_header_logo))
                                    <img src="{{ project_asset($dark_mobile_sticky_header_logo) }}" alt="Logo"
                                        class="img-fluid sticky-mobile-logo">
                                @elseif(isset($text_logo))
                                    <h2 class="sticky-mobile-logo"> {{ $text_logo }} </h2>
                                @endif
                            @else
                                <!-- Main Header Logo -->
                                @if (isset($header_logo))
                                    <img src="{{ project_asset($header_logo) }}" alt="Logo"
                                        class="img-fluid default-logo">
                                @elseif(isset($text_logo))
                                    <h1 class="default-logo"> {{ $text_logo }} </h1>
                                @endif
                                <!-- Main Header Mobile Logo -->
                                @if (isset($mobile_logo))
                                    <img src="{{ project_asset($mobile_logo) }}" alt="Logo"
                                        class="img-fluid mobile-logo">
                                @elseif(isset($text_logo))
                                    <h1 class="mobile-logo"> {{ $text_logo }} </h1>
                                @endif
                                <!-- Sticky Header Logo -->
                                @if (isset($sticky_header_logo))
                                    <img src="{{ project_asset($sticky_header_logo) }}" alt="Logo"
                                        class="img-fluid sticky-logo">
                                @elseif(isset($text_logo))
                                    <h2 class="sticky-logo"> {{ $text_logo }} </h2>
                                @endif
                                <!-- Sticky Header Mobile Logo -->
                                @if (isset($mobile_sticky_header_logo))
                                    <img src="{{ project_asset($mobile_sticky_header_logo) }}" alt="Logo"
                                        class="img-fluid sticky-mobile-logo">
                                @elseif(isset($text_logo))
                                    <h2 class="sticky-mobile-logo"> {{ $text_logo }} </h2>
                                @endif
                            @endif
                        </a>
                    </div>
                    <!-- End of Logo -->
                </div>

                <div class="col-lg-9 col-md-8 col-6 d-flex justify-content-end position-static">
                    <!-- Nav Menu -->
                    <div class="nav-menu-cover">
                        <ul class="nav nav-menu">
                            @for ($i = 0; $i < sizeof($data); $i++)
                                <li
                                    class="{{ $i + 1 != sizeof($data) && $data[$i + 1]->level > $data[$i]->level ? 'menu-item-has-children' : '' }}">
                                    @if ($i + 1 != sizeof($data) && $data[$i + 1]->level > $data[$i]->level)
                                        <a href="{{ $data[$i]->menu_type_id == null ? $data[$i]->url : url($data[$i]->url) }}"
                                            class="{{ getActiveMenuColor($i, $data) }}">
                                            <!-- first -->
                                            {{ $data[$i]->title }}
                                        </a>
                                    @else
                                        <a class="{{ getActiveMenuColor($i, $data) }}"
                                            href="{{ $data[$i]->menu_type_id == null ? $data[$i]->url : url($data[$i]->url) }}">
                                            <!-- second -->
                                            {{ $data[$i]->title }}
                                        </a>
                                    @endif

                                    @if ($i + 1 != sizeof($data) && $data[$i + 1]->level > $data[$i]->level)
                                        <ul class="sub-menu">
                                        @elseif($i + 1 != sizeof($data) && $data[$i + 1]->level == $data[$i]->level)
                                </li>
                            @elseif($i + 1 != sizeof($data) && $data[$i + 1]->level < $data[$i]->level)
                                @php
                                    $step = ($data[$i]->level - $data[$i + 1]->level) * 2 + 1;
                                    for ($j = 1; $j < $step + 1; $j++) {
                                        if ($j % 2 != 0) {
                                            echo '</li>';
                                        } else {
                                            echo '</ul>';
                                        }
                                    }
                                @endphp
                            @elseif($i + 1 != sizeof($data))
                                @for ($j = 1; $j < $data[$i]->level - 1; $j++)
                                    </li>
                        </ul>
                        @endfor
                        @endif
                        @endfor
                        </li>
                        @if ($contact_header)
                            <li class="">
                                <a class="" href="{{ url('/contact') }}">{{ $contact_text }}</a>
                            </li>
                        @endif
                        </ul>
                    </div>
                    <!-- End of Nav Menu -->

                    <!-- Mobile Menu -->
                    <div class="mobile-menu-cover">
                        <ul class="nav mobile-nav-menu">
                            @if (isset($header['header_search_icon']) && $header['header_search_icon'] == 1)
                                <li class="search-toggle-open">
                                    <img src=" {{ asset('https://stagingmockup.agency/zenithblox/assets/images/searchicon.png') }}"
                                        alt="" class="img-fluid svg">
                                </li>
                            @endif
                            <li class="search-toggle-close hide">
                                <img src="{{ asset('themes/default/public/assets/images/close.svg') }}" alt=""
                                    class="img-fluid">
                            </li>
                            <li class="demo-link">
                                <a href="#" class="custom-theme-btn">Demo Now</a>
                            </li>
                            <li class="nav-menu-toggle">
                                <img src="{{ asset('themes/default/public/assets/images/menu-toggler.svg') }}"
                                    alt="" class="img-fluid svg">
                            </li>
                        </ul>
                                
                    </div>
                    <!-- End of Mobile Menu -->
                </div>
            </div>
        </div>
    </div>
</header>
<!-- End of Header -->
