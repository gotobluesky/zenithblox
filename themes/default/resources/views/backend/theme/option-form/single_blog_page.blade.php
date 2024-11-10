{{-- Single Blog Page Header --}}
<h3 class="black mb-3">{{ translate('Single Blog Page') }}</h3>
<input type="hidden" name="option_name" value="single_blog_page">

{{-- Default Or Custom Back To Top Button Switch Start --}}
<div class="form-group row py-3 border-bottom">
    <div class="col-xl-4">
        <label class="font-16 bold black">{{ translate('Custom Single Blog page') }}
        </label>
        <span class="d-block">{{ translate('set custom single blog style.') }}</span>
    </div>
    <div class="col-xl-6 offset-xl-1">
        <label class="switch success">
            <input type="hidden" name="custom_single_blog_style" value="0">
            <input type="checkbox"
                {{ isset($option_settings['custom_single_blog_style']) && $option_settings['custom_single_blog_style'] == 1 ? 'checked' : '' }}
                name="custom_single_blog_style" id="custom_single_blog_style" value="1">
            <span class="control" id="custom_single_blog_style_switch">
                <span class="switch-off">{{ translate('Default') }}</span>
                <span class="switch-on">{{ translate('Custom') }}</span>
            </span>
        </label>
    </div>
</div>
{{-- Default Or Custom Back To Top Button Switch End --}}

{{-- Custom Single Blog Page Switch on Field Start --}}
<div id="custom_single_blog_style_switch_on_field">
    {{-- Single Blog Page Layout Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-5">
            <label class="font-16 bold black">{{ translate('Layout') }}
            </label>
            <span
                class="d-block">{{ translate('Choose blog single page layout from here. If you use this option then you will able to change three type of blog single page layout ( Default Right Sidebar Layout ).') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1 row" id="single_blog_page_layout_image_field">
            <div class="col-4">
                <div class="input-group col-xl-5">
                    <input type="radio"
                        {{ isset($option_settings['single_blog_page_layout']) && $option_settings['single_blog_page_layout'] == 'single_blog_page_layout1' ? 'checked' : '' }}
                        class="d-none" name="single_blog_page_layout" id="single_blog_page_layout1"
                        value="single_blog_page_layout1">
                    <label for="single_blog_page_layout1">
                        <img src="{{ asset('themes/default/public/assets/images/layout/no-sideber.png') }}"
                            title="no sidebar" alt="no sidebar" class="layout_img">
                    </label>
                </div>
            </div>
            <div class="col-4">
                <div class="input-group col-xl-5">
                    <input type="radio"
                        {{ isset($option_settings['single_blog_page_layout']) && $option_settings['single_blog_page_layout'] == 'single_blog_page_layout2' ? 'checked' : '' }}
                        class="d-none" name="single_blog_page_layout" id="single_blog_page_layout2"
                        value="single_blog_page_layout2">
                    <label for="single_blog_page_layout2">
                        <img src="{{ asset('themes/default/public/assets/images/layout/left-sideber.png') }}"
                            title="left sidebar" alt="left sidebar" class="layout_img">
                    </label>
                </div>
            </div>
            <div class="col-4">
                <div class="input-group col-xl-5">
                    <input type="radio"
                        {{ isset($option_settings['single_blog_page_layout']) && $option_settings['single_blog_page_layout'] == 'single_blog_page_layout3' ? 'checked' : '' }}
                        class="d-none" name="single_blog_page_layout" id="single_blog_page_layout3"
                        value="single_blog_page_layout3">
                    <label for="single_blog_page_layout3">
                        <img src="{{ asset('themes/default/public/assets/images/layout/right-sideber.png') }}"
                            title="right sidebar" alt="right sidebar" class="layout_img">
                    </label>
                </div>
            </div>
        </div>
    </div>
    {{-- Single Blog Page Layout Field End --}}

    {{-- Blog Post Title Position Header-Below Thumbnail Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-5">
            <label class="font-16 bold black">{{ translate('Blog Post Title Position') }}
            </label>
            <span class="d-block">{{ translate('Control blog post title position from here.') }}</span>
            <span>on header / below thumbnail</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <label class="switch success">
                <input type="hidden" name="blog_post_title_position" value="on_header">
                <input type="checkbox"
                    {{ isset($option_settings['blog_post_title_position']) && $option_settings['blog_post_title_position'] == 'below_thumbnail' ? 'checked' : '' }}
                    name="blog_post_title_position" id="blog_post_title_position" value="below_thumbnail">
                <span class="control" id="blog_post_title_position_switch">
                    <span class="switch-off">On Header</span>
                    <span class="switch-on">Below Thumbnail</span>
                </span>
            </label>
        </div>
    </div>
    {{-- Blog Post Title Position Header-Below Thumbnail  Field End --}}

    {{-- Blog Post Title Position Below Thumbnail Custom Title Field Start --}}
    <div class="form-group row py-4 border-bottom" id="blog_post_title_position_switch_on_field">
        <div class="col-xl-5">
            <label for="blog_details_custom_title"
                class="font-16 bold black">{{ translate('Blog Details Custom Title') }}
            </label>
            <span class="d-block">{{ translate('This title will show in Breadcrumb title.') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <input type="text" name="blog_details_custom_title" id="blog_details_custom_title" class="form-control"
                placeholder="{{ translate('Blog Details Custom Title') }}"
                value="{{ isset($option_settings['blog_details_custom_title']) ? $option_settings['blog_details_custom_title'] : '' }}">
            <small>{{ translate('Transalate to another language') }} <a
                    href="{{ route('core.languages') }}">{{ translate('click here') }}.</a></small>
        </div>
    </div>
    {{-- Blog Post Title Position Below Thumbnail Custom Title Field End --}}

    {{-- Blog Post Author Show/Hide Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-5">
            <label class="font-16 bold black">{{ translate('Author') }}
            </label>
            <span class="d-block">{{ translate('Switch On to Display Author.') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <label class="switch success">
                <input type="hidden" name="author" value="0">
                <input type="checkbox"
                    {{ isset($option_settings['author']) && $option_settings['author'] == 1 ? 'checked' : '' }}
                    name="author" id="author" value="1">
                <span class="control" id="author_switch">
                    <span class="switch-off">{{ translate('Disable') }}</span>
                    <span class="switch-on">{{ translate('Enable') }}</span>
                </span>
            </label>
        </div>
    </div>
    {{-- Blog Post Author Show/Hide Field End --}}

    {{-- Blog Post Date Show/Hide Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-5">
            <label class="font-16 bold black">{{ translate('Date') }}
            </label>
            <span class="d-block">{{ translate('Switch On to Display Date.') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <label class="switch success">
                <input type="hidden" name="date" value="0">
                <input type="checkbox"
                    {{ isset($option_settings['date']) && $option_settings['date'] == 1 ? 'checked' : '' }}
                    name="date" id="date" value="1">
                <span class="control" id="date_switch">
                    <span class="switch-off">{{ translate('Disable') }}</span>
                    <span class="switch-on">{{ translate('Enable') }}</span>
                </span>
            </label>
        </div>
    </div>
    {{-- Blog Post Date Show/Hide Field Start --}}

    {{-- Blog Post Reading Time Show/Hide Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-5">
            <label class="font-16 bold black">{{ translate('Reading Time') }}
            </label>
            <span class="d-block">{{ translate('Switch On to Display Reading Time.') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <label class="switch success">
                <input type="hidden" name="reading_time" value="0">
                <input type="checkbox"
                    {{ isset($option_settings['reading_time']) && $option_settings['reading_time'] == 1 ? 'checked' : '' }}
                    name="reading_time" id="reading_time" value="1">
                <span class="control" id="reading_time_switch">
                    <span class="switch-off">{{ translate('Disable') }}</span>
                    <span class="switch-on">{{ translate('Enable') }}</span>
                </span>
            </label>
        </div>
    </div>
    {{-- Blog Post Reading Time Show/Hide Field Start --}}

    {{-- Blog Post Category Show/Hide Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-5">
            <label class="font-16 bold black">{{ translate('Category') }}
            </label>
            <span class="d-block">{{ translate('Switch On to Display Category.') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <label class="switch success">
                <input type="hidden" name="category" value="0">
                <input type="checkbox"
                    {{ isset($option_settings['category']) && $option_settings['category'] == 1 ? 'checked' : '' }}
                    name="category" id="category" value="1">
                <span class="control" id="category_switch">
                    <span class="switch-off">{{ translate('Disable') }}</span>
                    <span class="switch-on">{{ translate('Enable') }}</span>
                </span>
            </label>
        </div>
    </div>
    {{-- Blog Post Category Show/Hide Field Start --}}

    {{-- Blog Post Tags Show/Hide Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-5">
            <label class="font-16 bold black">{{ translate('Tags') }}
            </label>
            <span class="d-block">{{ translate('Switch On to Display Tags.') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <label class="switch success">
                <input type="hidden" name="tags" value="0">
                <input type="checkbox"
                    {{ isset($option_settings['tags']) && $option_settings['tags'] == 1 ? 'checked' : '' }}
                    name="tags" id="tags" value="1">
                <span class="control" id="tags_switch">
                    <span class="switch-off">{{ translate('Disable') }}</span>
                    <span class="switch-on">{{ translate('Enable') }}</span>
                </span>
            </label>
        </div>
    </div>
    {{-- Blog Post Tags Show/Hide Field Start --}}

    {{-- Blog Post Comments Show/Hide Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-5">
            <label class="font-16 bold black">{{ translate('Comments') }}
            </label>
            <span class="d-block">{{ translate('Switch On to Display Comments.') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <label class="switch success">
                <input type="hidden" name="comments" value="0">
                <input type="checkbox"
                    {{ isset($option_settings['comments']) && $option_settings['comments'] == 1 ? 'checked' : '' }}
                    name="comments" id="comments" value="1">
                <span class="control" id="comments_switch">
                    <span class="switch-off">{{ translate('Disable') }}</span>
                    <span class="switch-on">{{ translate('Enable') }}</span>
                </span>
            </label>
        </div>
    </div>
    {{-- Blog Post Comments Show/Hide Field Start --}}

    {{-- Blog Post Share Show/Hide Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-5">
            <label class="font-16 bold black">{{ translate('Blog Share Options') }}
            </label>
            <span class="d-block">{{ translate('Switch On to Display Blog Share.') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <label class="switch success">
                <input type="hidden" name="blog_share" value="0">
                <input type="checkbox"
                    {{ isset($option_settings['blog_share']) && $option_settings['blog_share'] == 1 ? 'checked' : '' }}
                    name="blog_share" id="blog_share" value="1">
                <span class="control" id="blog_share_switch">
                    <span class="switch-off">{{ translate('Disable') }}</span>
                    <span class="switch-on">{{ translate('Enable') }}</span>
                </span>
            </label>
        </div>
    </div>
    {{-- Blog Post Share Show/Hide Field Start --}}

    {{-- Blog Post Biography Info Show/Hide Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-5">
            <label class="font-16 bold black">{{ translate('Biography Info') }}
            </label>
            <span
                class="d-block">{{ translate('Control biography info from here. If you use this option then you will able to show ro hide biography info') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <label class="switch success">
                <input type="hidden" name="biography_info" value="0">
                <input type="checkbox"
                    {{ isset($option_settings['biography_info']) && $option_settings['biography_info'] == 1 ? 'checked' : '' }}
                    name="biography_info" id="biography_info" value="1">
                <span class="control" id="biography_info_switch">
                    <span class="switch-off">{{ translate('Hide') }}</span>
                    <span class="switch-on">{{ translate('Show') }}</span>
                </span>
            </label>
        </div>
    </div>
    {{-- Blog Post Biography Info Show/Hide Field Start --}}

    {{-- Related Blog Show/Hide Field Start --}}
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-5">
            <label class="font-16 bold black">{{ translate('Related Blogs') }}
            </label>
            <span class="d-block">{{ translate('Show/Hide related blogs') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <label class="switch success">
                <input type="hidden" name="related_blogs" value="0">
                <input type="checkbox"
                    {{ isset($option_settings['related_blogs']) && $option_settings['related_blogs'] == 1 ? 'checked' : '' }}
                    name="related_blogs" id="related_blogs" value="1">
                <span class="control" id="related_blogs_switch">
                    <span class="switch-off">{{ translate('Hide') }}</span>
                    <span class="switch-on">{{ translate('Show') }}</span>
                </span>
            </label>
        </div>
    </div>
    {{-- Related Blog Show/Hide Field Start --}}

    {{-- Related Blog Field Start --}}
    <div id="related_blogs_switch_on_field">
        <!-- Related Blog Section Title  -->
        <div class="form-group row py-4 border-bottom">
            <div class="col-xl-5">
                <label for="section_title"
                    class="font-16 bold black">{{ translate('Related Blog Section Title') }}
                </label>
                <span class="d-block">{{ translate('This title will show in Breadcrumb title.') }}</span>
            </div>
            <div class="col-xl-6 offset-xl-1">
                <input type="text" name="section_title" id="section_title"
                    class="form-control" placeholder="{{ translate('Related Blog Section Title') }}"
                    value="{{ isset($option_settings['section_title']) ? $option_settings['section_title'] : '' }}">
                <small>{{ translate('Transalate to another language') }} <a
                        href="{{ route('core.languages') }}">{{ translate('click here') }}.</a></small>
            </div>
        </div>
        <!-- Related Blog Count  -->
        <div class="form-group row py-4 border-bottom">
            <div class="col-xl-5">
                <label for="blog_count"
                    class="font-16 bold black">{{ translate('Related Blog Count') }}
                </label>
                <span class="d-block">{{ translate('select how may related blog you want to show.') }}</span>
            </div>
            <div class="col-xl-6 offset-xl-1">
                <input type="text" name="blog_count" id="blog_count"
                    class="form-control" placeholder="{{ translate('Related Blog Count') }}"
                    value="{{ isset($option_settings['blog_count']) ? $option_settings['blog_count'] : '' }}">
            </div>
        </div>
    </div>
    {{-- Related Blog Field End --}}
</div>
{{-- Custom Single Blog Page Switch on Field End --}}
