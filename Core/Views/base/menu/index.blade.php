@php
    $menu_groups = getAllMenuGroups();
    $selected_menu_group = isset(request()->group_id) ? request()->group_id : -1;
    $all_menu_positions = getAllMenuPositions();
    $languages = getAllLanguages();
    
    $menu_items = getAllMenuItems();
    
    $all_categories = getAllCategories();
    $all_recent_categories = getAllRecentCategories();
    
    $all_posts = getAllPosts();
    $all_recent_posts = getAllRecentPosts();
    
    $all_pages = getAllPages();
    $all_recent_pages = getAllRecentPages();
    
    $all_tags = getAllTags();
    $all_recent_tags = getAllRecentTags();
@endphp
@extends('core::base.layouts.master')
@section('title')
    {{ translate('Menu') }}
@endsection
@section('custom_css')
    <link href="{{ asset('/public/backend/assets/plugins/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('/public/backend/assets/plugins/select2/select2.min.css') }}">

@section('main_content')
    <div class="border-bottom2 pb-3 mb-4">
        <h4><i class="icofont-navigation-menu"></i> {{ translate('Menus') }}</h4>
    </div>

    <ul class="nav nav-tabs pl-20" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="edit_menus-tab" data-toggle="tab" href="#edit_menus" role="tab"
                aria-controls="edit_menus" aria-selected="true">{{ translate('Edit Menus') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="manage_location-tab" data-toggle="tab" href="#manage_location" role="tab"
                aria-controls="manage_location" aria-selected="false">{{ translate('Manage Locations') }}</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade show active" id="edit_menus" role="tabpanel" aria-labelledby="edit_menus-tab">
            <!-- Select menu to edit -->
            <div class="align-items-center justify-content-between bg-white d-flex flex-wrap ml-0 p-4 ">
                <div class="d-flex align-items-center menu-sm-colunm">
                    <label class="menu-name-label text-nowrap mr-30 ml-10"
                        for="menu-name">{{ translate('Select a menu to edit:') }}</label>
                    <select class="form-control w-100" id="menu_group" onchange="getMenuStructure()">
                        @foreach ($menu_groups as $menu)
                            <option value="{{ $menu->id }}" class="text-uppercase" id="menu_option_{{ $menu->id }}"
                                {{ $selected_menu_group == $menu->id ? 'selected' : '' }}>{{ $menu->name }}
                            </option>
                        @endforeach
                    </select>
                    </span><span class="select2-selection__arrow" role="presentation"><b
                            role="presentation"></b></span></span></span><span class="dropdown-wrapper"
                        aria-hidden="true"></span></span>
                </div>
                <div>
                    <button class="btn sm" onclick="showMenuCreationForm()"> {{ translate('Create Menu ') }}</button>
                </div>
            </div>

            <div class="align-items-center justify-content-between bg-white d-flex flex-wrap p-4">
                <div class="d-flex align-items-center menu-sm-colunm">
                    <label class="lang-name-label text-nowrap mr-30 ml-10"
                        for="lang-name">{{ translate('Translate Menu Into:') }}</label>
                    <select class="form-control w-100" id="language" onchange="getMenuStructure()">
                        @foreach ($languages as $lang)
                            <option value="{{ $lang->id }}" class="text-uppercase" id="lang_{{ $lang->id }}">
                                {{ $lang->name }}
                            </option>
                        @endforeach
                    </select>
                    </span><span class="select2-selection__arrow" role="presentation"><b
                            role="presentation"></b></span></span></span><span class="dropdown-wrapper"
                        aria-hidden="true"></span></span>
                </div>
            </div>
            <!-- /Select menu to edit -->
            <div class="p-4 bg-white">
                <p class="alert alert-info">You are editing
                    <strong>"{{ getLanguageNameByCode(getDefaultLang()) }}"</strong> version
                </p>
            </div>

            <!-- menu itemes-->
            <div class="menu-management-frame">
                <div class="add-menu-item {{ sizeof($menu_groups) > 0 ? '' : 'area-disabled' }}" id="accordion-container">
                    <form action="#" class="nav-menu-meta">
                        <div class="card accordion">
                            <!-- Custom menu-->
                            <div data-accordion-tab="toggle">
                                <div class="accordion-title d-flex gap-10 align-items-center justify-content-between">
                                    <h5>{{ translate('Custom Links') }}</h5>
                                    <i class="icofont-caret-down"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>
                                        <label class="mb-2 black" for="custom-menu-item-url">{{ translate('URL') }}</label>
                                        <input id="custom_url" type="text" class="theme-input-style menu-item-textbox"
                                            placeholder="https://">
                                    </p>
                                    <p>
                                        <label class="mb-2 black"
                                            for="custom-menu-item-name">{{ translate('Link Text') }}</label>
                                        <input id="custom_link" type="text" class="theme-input-style menu-item-textbox">
                                    </p>
                                    <p class="button-controls">
                                        <span class="add-to-menu">
                                            <button type="button" class="submit-add-to-menu "
                                                onclick="addCustomMenu()">{{ translate('Add to Menu') }}</button>
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <!-- /Custom Menu-->

                            <!-- Default Category Menu-->
                            <div data-accordion-tab="toggle">
                                <div class="accordion-title d-flex gap-10 align-items-center justify-content-between">
                                    <h5>{{ translate('Categories') }}</h5>
                                    <i class="icofont-caret-down"></i>
                                </div>
                                <div class="accordion-content">
                                    <ul class="nav nav-tabs small-tabs pl-1" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#categories_recent"
                                                role="tab">{{ translate('Most Recent') }}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#categories_all"
                                                role="tab">{{ translate('View All') }}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#categories_searched"
                                                role="tab">{{ translate('Search') }}</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="categories_recent" role="tabpanel">
                                            <ul class="item-check-list pages-check-list">
                                                @for ($i = 0; $i < sizeof($all_recent_categories); $i++)
                                                    <li>
                                                        <label class="menu-item-title">
                                                            <input type="checkbox" class="menu-item-checkbox"
                                                                id="recent_cat_{{ $all_recent_categories[$i]->id }}">
                                                            {{ $all_recent_categories[$i]->translation('name', getLocale()) }}
                                                        </label>
                                                    </li>
                                                @endfor
                                            </ul>
                                            <p
                                                class="button-controls d-flex justify-content-between gap-10 align-items-center pt-3 border-top2">
                                                <span class="list-controls">
                                                    <input type="checkbox" id="select_recent_cat" class="select-all"
                                                        onclick="selectItemToMenu('#select_recent_cat' , '#categories_recent')">
                                                    <label for="page-tab8"
                                                        class="cursor-pointer">{{ translate('Select All') }}</label>
                                                </span>

                                                <span class="add-to-menu">
                                                    <input type="button" class="submit-add-to-menu" value="Add to Menu"
                                                        onclick="addItemToMenu('#recent_cat_' , {{ json_encode($all_recent_categories) }} , 'category')">
                                                </span>
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="categories_all" role="tabpanel">
                                            <ul class="item-check-list pages-check-list">
                                                @for ($i = 0; $i < sizeof($all_categories); $i++)
                                                    <li>
                                                        <label class="menu-item-title">
                                                            <input type="checkbox" class="menu-item-checkbox"
                                                                id="all_cat_{{ $all_categories[$i]->id }}">
                                                            {{ $all_categories[$i]->translation('name', getLocale()) }}
                                                        </label>
                                                    </li>
                                                @endfor
                                            </ul>
                                            <p
                                                class="button-controls d-flex justify-content-between gap-10 align-items-center pt-3 border-top2">
                                                <span class="list-controls">
                                                    <input type="checkbox" id="select_all_cat" class="select-all"
                                                        onclick="selectItemToMenu('#select_all_cat' , '#categories_all')">
                                                    <label for="page-tab8"
                                                        class="cursor-pointer">{{ translate('Select All ') }}</label>
                                                </span>

                                                <span class="add-to-menu">
                                                    <input type="button" class="submit-add-to-menu" value="Add to Menu"
                                                        onclick="addItemToMenu('#all_cat_' , {{ json_encode($all_categories) }} , 'category')">
                                                </span>
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="categories_searched" role="tabpanel">
                                            <div class="pt-3">
                                                <input type="search" class="theme-input-style" placeholder="Search"
                                                    id="search_category"
                                                    onkeyup="searchItem('#search_category' , '#searched_category_list' , '{{ route('core.search.category.by.keywords') }}')">
                                            </div>
                                            <div id="searched_category_list">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Default Category Menu-->

                            <!-- Post Menu-->
                            <div data-accordion-tab="toggle">
                                <div class="accordion-title d-flex gap-10 align-items-center justify-content-between">
                                    <h5>{{ translate('Posts') }}</h5>
                                    <i class="icofont-caret-down"></i>
                                </div>
                                <div class="accordion-content">
                                    <ul class="nav nav-tabs small-tabs pl-1" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#post_recent"
                                                role="tab">{{ translate('Most Recent') }}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#post_all"
                                                role="tab">{{ translate('View All') }}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#post_searched"
                                                role="tab">{{ translate('Search') }}</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="post_recent" role="tabpanel">
                                            <ul class="item-check-list pages-check-list">
                                                @for ($i = 0; $i < sizeof($all_recent_posts); $i++)
                                                    <li>
                                                        <label class="menu-item-title">
                                                            <input type="checkbox" class="menu-item-checkbox"
                                                                id="recent_post_{{ $all_recent_posts[$i]->id }}">
                                                            {{ $all_recent_posts[$i]->translation('name', getLocale()) }}
                                                        </label>
                                                    </li>
                                                @endfor
                                            </ul>
                                            <p
                                                class="button-controls d-flex justify-content-between gap-10 align-items-center pt-3 border-top2">
                                                <span class="list-controls">
                                                    <input type="checkbox" id="select_recent_post" class="select-all"
                                                        onclick="selectItemToMenu('#select_recent_post' , '#post_recent')">
                                                    <label for="page-tab8"
                                                        class="cursor-pointer">{{ translate('Select All') }}</label>
                                                </span>

                                                <span class="add-to-menu">
                                                    <input type="button" class="submit-add-to-menu" value="Add to Menu"
                                                        onclick="addItemToMenu('#recent_post_' , {{ json_encode($all_recent_posts) }} , 'post')">
                                                </span>
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="post_all" role="tabpanel">
                                            <ul class="item-check-list pages-check-list">
                                                @for ($i = 0; $i < sizeof($all_posts); $i++)
                                                    <li>
                                                        <label class="menu-item-title">
                                                            <input type="checkbox" class="menu-item-checkbox"
                                                                id="all_post_{{ $all_posts[$i]->id }}">
                                                            {{ $all_posts[$i]->translation('name', getLocale()) }}
                                                        </label>
                                                    </li>
                                                @endfor
                                            </ul>
                                            <p
                                                class="button-controls d-flex justify-content-between gap-10 align-items-center pt-3 border-top2">
                                                <span class="list-controls">
                                                    <input type="checkbox" id="select_all_post" class="select-all"
                                                        onclick="selectItemToMenu('#select_all_post' , '#post_all')">
                                                    <label for="page-tab8"
                                                        class="cursor-pointer">{{ translate('Select All ') }}</label>
                                                </span>

                                                <span class="add-to-menu">
                                                    <input type="button" class="submit-add-to-menu" value="Add to Menu"
                                                        onclick="addItemToMenu('#all_post_' , {{ json_encode($all_posts) }} , 'post')">
                                                </span>
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="post_searched" role="tabpanel">
                                            <div class="pt-3">
                                                <input type="search" class="theme-input-style" placeholder="Search"
                                                    id="search_post"
                                                    onkeyup="searchItem('#search_post' , '#searched_post_list' , '{{ route('core.search.post.by.keywords') }}')">
                                            </div>
                                            <div id="searched_post_list">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Post menu-->

                            <!-- Page Menu-->
                            <div data-accordion-tab="toggle">
                                <div class="accordion-title d-flex gap-10 align-items-center justify-content-between">
                                    <h5>{{ translate('Pages') }}</h5>
                                    <i class="icofont-caret-down"></i>
                                </div>
                                <div class="accordion-content">
                                    <ul class="nav nav-tabs small-tabs pl-1" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#page_recent"
                                                role="tab">{{ translate('Most Recent') }}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#page_all"
                                                role="tab">{{ translate('View All') }}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#page_searched"
                                                role="tab">{{ translate('Search') }}</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="page_recent" role="tabpanel">
                                            <ul class="item-check-list pages-check-list">
                                                @for ($i = 0; $i < sizeof($all_recent_pages); $i++)
                                                    <li>
                                                        <label class="menu-item-title">
                                                            <input type="checkbox" class="menu-item-checkbox"
                                                                id="recent_page_{{ $all_recent_pages[$i]->id }}">
                                                            {{ $all_recent_pages[$i]->translation('name', getLocale()) }}
                                                        </label>
                                                    </li>
                                                @endfor
                                            </ul>
                                            <p
                                                class="button-controls d-flex justify-content-between gap-10 align-items-center pt-3 border-top2">
                                                <span class="list-controls">
                                                    <input type="checkbox" id="select_recent_page" class="select-all"
                                                        onclick="selectItemToMenu('#select_recent_page' , '#page_recent')">
                                                    <label for="page-tab8"
                                                        class="cursor-pointer">{{ translate('Select All') }}</label>
                                                </span>

                                                <span class="add-to-menu">
                                                    <input type="button" class="submit-add-to-menu" value="Add to Menu"
                                                        onclick="addItemToMenu('#recent_page_', {{ json_encode($all_recent_pages) }} , 'page')">
                                                </span>
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="page_all" role="tabpanel">
                                            <ul class="item-check-list pages-check-list">
                                                @for ($i = 0; $i < sizeof($all_pages); $i++)
                                                    <li>
                                                        <label class="menu-item-title">
                                                            <input type="checkbox" class="menu-item-checkbox"
                                                                id="all_page_{{ $all_pages[$i]->id }}">
                                                            {{ $all_pages[$i]->translation('name', getLocale()) }}
                                                        </label>
                                                    </li>
                                                @endfor
                                            </ul>
                                            <p
                                                class="button-controls d-flex justify-content-between gap-10 align-items-center pt-3 border-top2">
                                                <span class="list-controls">
                                                    <input type="checkbox" id="select_all_page" class="select-all"
                                                        onclick="selectItemToMenu('#select_all_page' , '#page_all')">
                                                    <label for="page-tab8"
                                                        class="cursor-pointer">{{ translate('Select All ') }}</label>
                                                </span>

                                                <span class="add-to-menu">
                                                    <input type="button" class="submit-add-to-menu" value="Add to Menu"
                                                        onclick="addItemToMenu('#all_page_', {{ json_encode($all_pages) }} , 'page')">
                                                </span>
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="page_searched" role="tabpanel">
                                            <div class="pt-3">
                                                <input type="search" class="theme-input-style" placeholder="Search"
                                                    id="search_page"
                                                    onkeyup="searchItem('#search_page' , '#searched_page_list' , '{{ route('core.search.page.by.keywords') }}')">
                                            </div>
                                            <div id="searched_page_list">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Page menu-->

                            <!-- Tag Menu-->
                            <div data-accordion-tab="toggle">
                                <div class="accordion-title d-flex gap-10 align-items-center justify-content-between">
                                    <h5>{{ translate('Tags') }}</h5>
                                    <i class="icofont-caret-down"></i>
                                </div>
                                <div class="accordion-content">
                                    <ul class="nav nav-tabs small-tabs pl-1" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#tag_recent"
                                                role="tab">{{ translate('Most Recent') }}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#tag_all"
                                                role="tab">{{ translate('View All') }}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#tag_searched"
                                                role="tab">{{ translate('Search') }}</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="tag_recent" role="tabpanel">
                                            <ul class="item-check-list tags-check-list">
                                                @for ($i = 0; $i < sizeof($all_recent_tags); $i++)
                                                    <li>
                                                        <label class="menu-item-title">
                                                            <input type="checkbox" class="menu-item-checkbox"
                                                                id="recent_tag_{{ $all_recent_tags[$i]->id }}">
                                                            {{ $all_recent_tags[$i]->translation('name', getLocale()) }}
                                                        </label>
                                                    </li>
                                                @endfor
                                            </ul>
                                            <p
                                                class="button-controls d-flex justify-content-between gap-10 align-items-center pt-3 border-top2">
                                                <span class="list-controls">
                                                    <input type="checkbox" id="select_recent_tag" class="select-all"
                                                        onclick="selectItemToMenu('#select_recent_tag' , '#tag_recent')">
                                                    <label for="tag-tab8"
                                                        class="cursor-pointer">{{ translate('Select All') }}</label>
                                                </span>

                                                <span class="add-to-menu">
                                                    <input type="button" class="submit-add-to-menu" value="Add to Menu"
                                                        onclick="addItemToMenu('#recent_tag_', {{ json_encode($all_recent_tags) }} , 'tag')">
                                                </span>
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="tag_all" role="tabpanel">
                                            <ul class="item-check-list tags-check-list">
                                                @for ($i = 0; $i < sizeof($all_tags); $i++)
                                                    <li>
                                                        <label class="menu-item-title">
                                                            <input type="checkbox" class="menu-item-checkbox"
                                                                id="all_tag_{{ $all_tags[$i]->id }}">
                                                            {{ $all_tags[$i]->translation('name', getLocale()) }}
                                                        </label>
                                                    </li>
                                                @endfor
                                            </ul>
                                            <p
                                                class="button-controls d-flex justify-content-between gap-10 align-items-center pt-3 border-top2">
                                                <span class="list-controls">
                                                    <input type="checkbox" id="select_all_tag" class="select-all"
                                                        onclick="selectItemToMenu('#select_all_tag' , '#tag_all')">
                                                    <label for="tag-tab8"
                                                        class="cursor-pointer">{{ translate('Select All ') }}</label>
                                                </span>

                                                <span class="add-to-menu">
                                                    <input type="button" class="submit-add-to-menu" value="Add to Menu"
                                                        onclick="addItemToMenu('#all_tag_', {{ json_encode($all_tags) }} , 'tag')">
                                                </span>
                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="tag_searched" role="tabpanel">
                                            <div class="pt-3">
                                                <input type="search" class="theme-input-style" placeholder="Search"
                                                    id="search_tag"
                                                    onkeyup="searchItem('#search_tag' , '#searched_tag_list' , '{{ route('core.search.tag.by.keywords') }}')">
                                            </div>
                                            <div id="searched_tag_list">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Tag menu-->

                            @for ($i = 0; $i < sizeof($menu_items); $i++)
                                @php
                                    $template = $menu_items[$i]->template;
                                @endphp
                                @if (View::exists($template))
                                    @include($template)
                                @endif
                            @endfor
                        </div>
                    </form>
                </div>

                <!-- Add new menu -->
                <div class="menu-structure border-left2 card" id="create_menu_group">
                    <!-- New menu input -->
                    <div class="card-header">
                        <div class="d-flex gap-15 align-items-center mxw-550 ml-0">
                            <label class="menu-name-label text-nowrap"
                                for="editable_menu_group">{{ translate('Menu Name') }}</label>
                            <input name="menu_group_name" id="menu_group_name" type="text" class="theme-input-style"
                                value="" required>
                            <div class="invalid-input" id="create_menu_name_error"></div>
                        </div>
                    </div>
                    <!-- /New menu input -->

                    <!-- Menu settings on create-->
                    <div class="card-body">
                        <div class="horizontal-form mb-30">
                            <div class="instruction mb-3">
                                <p>{{ translate('Give your menu a name, then click Save Menu.') }}</p>
                            </div>
                            <hr>

                            <h4 class="mb-3">{{ translate('Menu Settings') }}</h4>

                            <div class="form-group d-sm-flex mb-4">
                                <label class="font-14 bold">{{ translate('Display Locations') }}</label>
                                <div class="">
                                    @for ($i = 0; $i < sizeof($all_menu_positions); $i++)
                                        @php
                                            $menu_group = getMenuGroupOnThisPosition($all_menu_positions[$i]->id);
                                        @endphp
                                        <div class="d-flex align-items-center mb-3">
                                            <label class="custom-checkbox position-relative mr-2 mr-md-4">
                                                <input type="checkbox" id="check_{{ $all_menu_positions[$i]->id }}"
                                                    name="position[]" value="{{ $all_menu_positions[$i]->id }}">
                                                <span class="checkmark"></span>
                                            </label>
                                            <label for="check_{{ $all_menu_positions[$i]->id }}">
                                                {{ $all_menu_positions[$i]->position }}
                                                {{ $menu_group != null ? '(' . translate('Currently set to : ') . $menu_group->name . '.' . ')' : '' }}
                                            </label>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Menu settings on create-->

                    <!-- Save button-->
                    <div class="card-footer">
                        <div class="d-flex gap-15 align-items-rigt mxw-550 ml-0 float-right">
                            <button class="btn sm" onclick="saveMenuGroup()">{{ translate('Save Menu') }}</button>
                        </div>
                    </div>
                    <!-- /Save button-->
                </div>
                <!-- /Add new menu -->

                <!-- Update Menu-->
                <div class="menu-structure border-left2 card" id="edit_menu_group">
                    <div class="card-header">
                        <div class="d-flex gap-15 align-items-center mxw-550 ml-0">
                            <label class="menu-name-label my-auto text-nowrap"
                                for="editable_menu_group">{{ translate('Menu Name') }}</label>
                            <input name="menu_group" id="editable_menu_group" type="text" class="theme-input-style"
                                value="">
                            <div class="invalid-input" id="edit_menu_name_error"></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="instruction mb-3">
                            <p>{{ translate('Drag the items into the order you prefer. Click the arrow on the right of the item to reveal additional configuration options.') }}
                            </p>
                        </div>
                        <div class="post-body-content">
                            <ul id="tree"></ul>
                        </div>
                        <hr>
                        <div class="horizontal-form mb-30">
                            <h4 class="mb-3">{{ translate('Menu Settings') }}</h4>

                            <div class="form-group d-sm-flex mb-4">
                                <label class="font-14 bold">{{ translate('Display Locations') }}</label>
                                <div class="">
                                    @for ($i = 0; $i < sizeof($all_menu_positions); $i++)
                                        @php
                                            $menu_group = getMenuGroupOnThisPosition($all_menu_positions[$i]->id);
                                        @endphp
                                        <div class="d-flex align-items-center mb-3">
                                            <label class="custom-checkbox position-relative mr-2 mr-md-4">
                                                <input type="checkbox" id="check_e_{{ $all_menu_positions[$i]->id }}"
                                                    name="edit_position[]" value="{{ $all_menu_positions[$i]->id }}">
                                                <span class="checkmark"></span>
                                            </label>
                                            <label for="check_{{ $all_menu_positions[$i]->id }}">
                                                {{ $all_menu_positions[$i]->position }}
                                                {{ $menu_group != null ? ' (Currently set to:' . $menu_group->name . ')' : '' }}
                                            </label>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-light">
                        <div class="d-flex gap-15 align-items-rigt mxw-550 ml-0 float-left">
                            <button class="btn-link text-danger"
                                onclick="deleteMenuGroup()">{{ translate('Delete Menu') }}</button>
                        </div>
                        <div class="d-flex gap-15 align-items-rigt mxw-550 ml-0 float-right">
                            <button class="btn sm" onclick="updateGroupMenu()">{{ translate('Update Menu') }}</button>
                        </div>
                    </div>
                </div>
                <!-- /Update Menu-->

            </div>
            <!-- menu itemes-->
        </div>

        <div class="tab-pane fade" id="manage_location" role="tabpanel" aria-labelledby="manage_location-tab">
            <div class="card">
                <div class="card-body">
                    <p>{{ translate('Your site supports') }} {{ sizeof($all_menu_positions) }}
                        {{ translate('menus. Select which menu appears in each location.') }}
                    </p>
                    <form action="#">
                        <div class="table-responsive">
                            <table class="menu-locations-table" id="menu-locations-table">
                                <thead>
                                    <tr>
                                        <th class="manage-column column-locations">{{ translate('Location') }}</th>
                                        <th class="manage-column column-menus">{{ translate('Assigned Menu') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="menu-locations">
                                    @for ($i = 0; $i < sizeof($all_menu_positions); $i++)
                                        <tr class="menu-locations-row">
                                            @php
                                                $menu_group = getMenuGroupOnThisPosition($all_menu_positions[$i]->id);
                                            @endphp
                                            @if ($menu_group != null)
                                                <td class="menu-location-title">
                                                    <label for="locations-primary-menu"
                                                        class="semi-bold black">{{ $all_menu_positions[$i]->position }}</label>
                                                </td>
                                                <td class="menu-location-menus">
                                                    <select class="theme-input-style"
                                                        id="location_{{ $all_menu_positions[$i]->id }}"
                                                        onchange="hideEditButton('{{ $menu_group->id }}','{{ $all_menu_positions[$i]->id }}')">
                                                        </option>
                                                        @foreach ($menu_groups as $menu)
                                                            <option value="{{ $menu->id }}" class="text-uppercase"
                                                                {{ $menu_group->id == $menu->id ? 'selected' : '' }}>
                                                                {{ $menu->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="locations-row-links">
                                                        <span class="locations-edit-menu-link border-right2 pr-2"
                                                            id="location_edit_{{ $all_menu_positions[$i]->id }}">
                                                            <a
                                                                href="{{ route('core.manage.menus') }}?group_id={{ $menu_group->id }}">
                                                                <span aria-hidden="true">{{ translate(' Edit') }}</span>
                                                            </a>
                                                        </span>
                                                        <span class="locations-add-menu-link pl-2">
                                                            <a href="#" onclick="showMenuCreationForm()">
                                                                {{ translate('Use new menu') }}
                                                            </a>
                                                        </span>
                                                    </div>
                                                </td>
                                            @endif
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @include('core::base.media.partial.media_modal')
    </div>
@endsection
@section('custom_scripts')
    <script src="{{ asset('/public/backend/assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('/public/backend/assets/js/menu_tree_sortable.js') }}"></script>
    <script src="{{ asset('/public/backend/assets/js/menu_script.js') }}"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="{{ asset('/public/backend/assets/plugins/select2/select2.min.js') }}"></script>

    <script>
        let data = [];
        let temp_data = [];
        let tree_data = [];
        let data_for_level_count = [];

        let sortable = new TreeSortable();
        let $tree = $("#tree");
        let $content = null;

        (function($) {
            "use strict";

            initDropzone()
            $(document).ready(function() {
                $('#menu_group').select2({
                    theme: "classic"
                });
                $('#menu_group_2').select2({
                    theme: "classic"
                });

                filtermedia()

                is_for_browse_file = true
                enable_multiple_file_select = false
                let total_menu_group = {{ sizeof($menu_groups) }}

                if (total_menu_group > 0) {
                    hideElement(['#create_menu_group', '#menu_group_on_create'])
                    getMenuStructure()
                } else {
                    hideElement(['#edit_menu_group'])
                    $('#menu_group').append(
                        '<option value="-1" class="text-uppercase" id="menu_option_0" selected>Select Menu' +
                        '</option>')
                }
            });

            $content = data.map(sortable.createBranch)
            $tree.html($content);
            sortable.run();
        })(jQuery);



        /**
         * Set tree view structure
         */
        function setTreeViewData(parent_id, id, level) {
            "use strict";

            for (let i = 0; i < data.length; i++) {
                if (typeof data[i] != 'undefined') {
                    if (data[i].id == id) {
                        data[i].level = parseInt(level)
                        if (parent_id + '' == 'undefined') {
                            data[i].parent_id = null
                        } else {
                            data[i].parent_id = parent_id
                        }
                    }
                }
            }
        }

        /**
         * Will update group wise menus
         */
        function updateGroupMenu() {
            "use strict";
            let menu_group_id = $('#menu_group :selected').val()
            let menu_group_name = $('#editable_menu_group').val()
            let lang_id = $('#language').val()

            var all_location_id = document.querySelectorAll('input[name="edit_position[]"]:checked');
            var all_location = [];

            for (var x = 0, l = all_location_id.length; x < l; x++) {
                all_location.push(all_location_id[x].value);
            }

            $.post("{{ route('core.update.menu.structure') }}", {
                    _token: '{{ csrf_token() }}',
                    menu_group_id: menu_group_id,
                    menu_group_name: menu_group_name,
                    all_position: all_location,
                    lang_id: lang_id,
                    sorting: 1
                },
                function(details, status) {
                    if (details.demo_mode) {
                        toastr.error(details.message, "Alert!");
                    } else {
                        toastr.success("Menu group updated successfully", "Success!");
                    }
                }
            ).fail(function(xhr, status, error) {
                let error_response = JSON.parse(xhr.responseText)
                let error_message = error_response.message
                let errors = {}
                if (error_response.hasOwnProperty('errors')) {
                    errors = error_response.errors
                    if (errors.hasOwnProperty('menu_group_name')) {
                        $('#edit_menu_name_error').html(errors.menu_group_name)
                    } else {
                        toastr.error(error_message, "Error!");
                    }
                } else {
                    toastr.error(error_message, "Error!");
                }
            });
        }

        /*
         * Delete menu group
         **/
        function deleteMenuGroup() {
            "use strict";
            let menu_group_id = $('#menu_group :selected').val()

            $.post("{{ route('core.delete.menu.group') }}", {
                    _token: '{{ csrf_token() }}',
                    menu_group_id: menu_group_id
                },
                function(details, status) {
                    if (details.demo_mode) {
                        toastr.error(details.message, "Alert!");
                    } else {
                        toastr.success("Menu group deleted successfully", "Success!");
                    }
                }
            ).fail(function(xhr, status, error) {
                toastr.error("Unable to delete menu group", "Error!");
            });
        }

        /**
         * Save menu information
         */
        function saveMenuInfo(id) {
            "use strict";
            let url = DOMPurify.sanitize($('#url_' + id).val()).replace(/"/g, '&quot;').replace(/</g, '&lt;').replace(/>/g,
                '&gt;');
            let name = DOMPurify.sanitize($('#menu_' + id).val()).replace(/"/g, '&quot;').replace(/</g, '&lt;').replace(
                />/g, '&gt;');
            let icon = $('#menu_icon_' + id).val()
            let menu_group_id = $('#menu_group :selected').val()
            let lang_id = $('#language').val()

            $.post("{{ route('core.update.tree.view.data') }}", {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    url: url,
                    name: name,
                    icon: icon,
                    menu_group_id: menu_group_id,
                    lang_id: lang_id,
                },
                function(details, status) {
                    if (details.demo_mode) {
                        toastr.error(details.message, "Alert!");
                    } else {
                        getMenuStructure()
                        toastr.success("Menu information updated successfully", "Success!");
                    }
                }
            ).fail(function(xhr, status, error) {
                toastr.error("Unable to update menu information", "Error!");
            });
        }

        /**
         * Store new menu group 
         */
        function saveMenuGroup() {
            "use strict";
            let menu_group_name = $('#menu_group_name').val()

            var all_location_id = document.querySelectorAll('input[name="position[]"]:checked');
            var all_location = [];

            for (var x = 0, l = all_location_id.length; x < l; x++) {
                all_location.push(all_location_id[x].value);
            }

            $.post("{{ route('core.add.menu.group') }}", {
                    _token: '{{ csrf_token() }}',
                    menu_name: menu_group_name,
                    all_position: all_location
                },
                function(details, status) {
                    if (details.demo_mode) {
                        toastr.error(details.message, "Alert!");
                    } else {
                        window.location.replace('{{ route('core.manage.menus') }}');
                    }
                }
            ).fail(function(xhr, status, error) {
                let error_response = JSON.parse(xhr.responseText)
                let error_message = error_response.message
                let errors = {}
                if (error_response.hasOwnProperty('errors')) {
                    errors = error_response.errors
                    if (errors.hasOwnProperty('menu_name')) {
                        $('#create_menu_name_error').html(errors.menu_name)
                    } else {
                        toastr.error(error_message, "Error!");
                    }
                } else {
                    toastr.error(error_message, "Error!");
                }
            });
        }

        /**
         * Remove specific menu from tree view
         */
        function removeMenu(id, index) {
            "use strict";
            if (id != -1) {
                $.post("{{ route('core.delete.tree.view.data') }}", {
                        _token: '{{ csrf_token() }}',
                        id: id
                    },
                    function(details, status) {
                        if (details.demo_mode) {
                            toastr.error(details.message, "Alert!");
                        } else {
                            getMenuStructure()
                            toastr.success("Menu deletion successful", "Success!");
                        }
                    }
                ).fail(function(xhr, status, error) {
                    toastr.error("You can not delete a parent menu", "Error!");
                });
            } else {
                data.splice(index, 1);
                $content = data.map(sortable.createBranch);
                $tree.html($content);
                sortable.run();
            }
        }

        /**
         * Will set menu structure for specific menu group
         */
        function getMenuStructure() {
            "use strict";
            let menu_group_id = $('#menu_group :selected').val()

            if (menu_group_id + '' !== '-1') {
                let menu_group_name = $('#menu_group :selected').text()
                let lang_id = $('#language').val()

                let lang_name = $('#language :selected').text().trim();
                $('.alert > strong').text('"' + lang_name + '"');

                showElement(['#edit_menu_group', '#language'])
                hideElement(['#create_menu_group'])
                $('#accordion-container').removeClass('area-disabled')

                $.post("{{ route('core.tree.view.data') }}", {
                        _token: '{{ csrf_token() }}',
                        menu_group_id: menu_group_id,
                        lang_id: lang_id,
                        menu_group_name: menu_group_name,
                    },

                    function(details, status) {
                        let menu_position = details.menu_position
                        menu_group_name = details.menu_group_name

                        var all_location_id = document.querySelectorAll('input[name="edit_position[]"]');
                        var all_location = [];

                        for (var x = 0, l = all_location_id.length; x < l; x++) {
                            if (menu_position.indexOf(parseInt(all_location_id[x].value)) !== -1) {
                                $('#' + all_location_id[x].id).prop('checked', true);
                            } else {
                                $('#' + all_location_id[x].id).prop('checked', false);
                            }
                        }
                        data = details.data;
                        $content = data.map(sortable.createBranch);
                        $tree.html($content);
                        sortable.run();

                        $('#editable_menu_group').val(menu_group_name)
                        if (lang_id != '{{ getGeneralSetting('default_language') }}') {
                            $('#accordion-container').addClass('area-disabled')
                            $('.hide_on_lang_change').addClass('area-disabled')
                        } else {
                            $('#accordion-container').removeClass('area-disabled')
                            $('.hide_on_lang_change').removeClass('area-disabled')
                        }
                    }
                ).fail(function(xhr, status, error) {
                    toastr.error("Unable to fetch data", "Error!");
                });
            }
        }

        /**
         * show menu creation form
         */
        function showMenuCreationForm() {
            "use strict";

            $('.alert').html(`You are creating <strong>"{{ getLanguageNameByCode(getDefaultLang()) }}"</strong> version`);

            showElement(['#create_menu_group'])
            hideElement(['#edit_menu_group'])
            if (!$('#edit_menus-tab').hasClass('active')) {
                $('#edit_menus-tab').addClass('active')
                $('#manage_location-tab').removeClass('active')

                $('#manage_location').removeClass('active')
                $('#manage_location').removeClass('show')

                $('#edit_menus').addClass('active')
                $('#edit_menus').addClass('show')
            }

            if ($('#menu_option_0').length == 0) {
                $('#menu_group').append(
                    '<option value="-1" class="text-uppercase" id="menu_option_0" selected>Select Menu' + '</option>')
            } else {
                $('#menu_option_0').remove()
                $('#menu_group').append(
                    '<option value="-1" class="text-uppercase" id="menu_option_0" selected>Select Menu' + '</option>')
            }

            $('#accordion-container').addClass('area-disabled')
            $('#language').hide()
        }

        /*
         * Search default product categories by keywords
         */
        function searchItem(search_keyword, search_list, route) {
            "use strict";
            let keywords = $(search_keyword).val()
            $.post(route, {
                    _token: '{{ csrf_token() }}',
                    keyword: keywords
                },
                function(details, status) {
                    $(search_list).html(details)
                }
            ).fail(function(xhr, status, error) {
                let error_response = JSON.parse(xhr.responseText)
                let error_message = error_response.message
                toastr.error(error_message, "Error!");
            });
        }

        /**
         * Add custom menu to the existing menu structure
         */
        function addCustomMenu() {
            "use strict";

            let custom_url = DOMPurify.sanitize($('#custom_url').val()).replace(/"/g, '&quot;').replace(/</g, '&lt;')
                .replace(/>/g, '&gt;');
            let custom_link = DOMPurify.sanitize($('#custom_link').val()).replace(/"/g, '&quot;').replace(/</g, '&lt;')
                .replace(/>/g, '&gt;');
            let image_id = $('#menu_icon_id').val();
            let image_src = $('#menu_icon_preview').attr('src');
            let image_alt = $('#menu_icon_preview').attr('alt');

            if (custom_link != "") {
                let new_menu = {
                    index: data.length,
                    alt: image_alt,
                    icon: image_id,
                    id: -1,
                    level: 1,
                    parent_id: 0,
                    path: image_src,
                    title: custom_link,
                    url: custom_url,
                    preview_url: custom_url
                }

                data.push(new_menu)

                $content = data.map(sortable.createBranch);
                $tree.html($content);
                sortable.run();
            }
            updateMenuStructure(data)
        }

        /**
         * Select all menu items after clicking select all button
         */
        function selectItemToMenu(select_id, list_id) {
            "use strict";
            if ($(select_id).is(':checked')) {
                $('li', $(list_id)).each(function() {
                    $(this).children().children().attr('checked', true);
                });
            } else {
                $('li', $(list_id)).each(function() {
                    $(this).children().children().attr('checked', false);
                });
            }
        }

        /**
         * Add product types item menu to existing menu structure
         */
        function addItemToMenu(id_prefix, all_items, menu_type) {
            "use strict";
            all_items = JSON.parse(JSON.stringify(all_items));

            for (let i = 0; i < all_items.length; i++) {
                if ($(id_prefix + all_items[i].id).is(':checked')) {

                    let new_menu = {
                        index: data.length,
                        alt: null,
                        icon: null,
                        id: -1,
                        level: 1,
                        parent_id: 0,
                        menu_type_id: all_items[i].id,
                        menu_type: menu_type,
                        path: null,
                        title: all_items[i].name,
                        url: all_items[i].permalink,
                        preview_url: all_items[i].preview_url
                    }

                    data.push(new_menu)

                    $content = data.map(sortable.createBranch);
                    $tree.html($content);
                    sortable.run();
                }
            }
            updateMenuStructure(data)
        }


        /**
         * Hide edit buttong from menu location list after selecting new menu
         */
        function hideEditButton(menu_group_id, menu_position_id) {
            "use strict";
            let selected_menu_group_id = $("#location_" + menu_position_id + " option:selected").val()
            if (menu_group_id + "" != selected_menu_group_id) {
                $("#location_edit_" + menu_position_id).hide()
            } else {
                $("#location_edit_" + menu_position_id).show()
            }
        }

        /*
         * will request to update menu structure 
         */
        function updateMenuStructure(list) {
            "use strict";
            let menu_group_id = $('#menu_group :selected').val()
            $.post("{{ route('core.update.menu.structure.on.sort') }}", {
                    _token: '{{ csrf_token() }}',
                    data: list,
                    menu_group_id: menu_group_id
                },
                function(details, status) {
                    if (details.demo_mode) {
                        toastr.error(details.message, "Alert!");
                    } else {
                        getMenuStructure()
                        toastr.success("Menu list updated successfully", "Success!");
                    }
                }
            ).fail(function(xhr, status, error) {
                let error_response = JSON.parse(xhr.responseText)
                let error_message = error_response.message
                toastr.error(error_message, "Error!");
            });
        }
    </script>
@endsection
