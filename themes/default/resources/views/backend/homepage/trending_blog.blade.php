<ul class="nav nav-tabs mb-20" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="content-info-tab" data-toggle="tab" href="#content-info" role="tab"
            aria-controls="content-info" aria-selected="true">{{ translate('Content') }}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="background-tab" data-toggle="tab" href="#background" role="tab"
            aria-controls="background" aria-selected="false">{{ translate('Background') }}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="button-tab" data-toggle="tab" href="#button" role="tab" aria-controls="button"
            aria-selected="false">{{ translate('Button') }}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="advanced-tab" data-toggle="tab" href="#advanced" role="tab" aria-controls="button"
            aria-selected="false">{{ translate('Advanced') }}</a>
    </li>
</ul>
<div class="tab-content" id="myTabContent">

    <div class="tab-pane fade show active" id="content-info" role="tabpanel" aria-labelledby="content-info-tab">
        <div class="form-row mb-20">
            <div class="col-sm-12">
                <label class="font-14 bold black">{{ translate('Blog Post Style') }}</label>
            </div>
            <div class="col-sm-12">
                <select class="theme-input-style" id="blogPostStyle" name="post_style" required
                    onchange="selectPostStyleOption('trending_blog')">
                    <option value="">{{ translate('Select Style') }}</option>
                    <option value="s_one">{{ translate('Style 1') }}</option>
                    <option value="s_two">{{ translate('Style 2') }}</option>
                    <option value="s_three">{{ translate('Style 3') }}</option>
                    <option value="s_four">{{ translate('Style 4') }}</option>
                    <option value="s_five">{{ translate('Style 5') }}</option>
                </select>

                @if ($errors->has('post_style'))
                    <div class="invalid-input">{{ $errors->first('post_style') }}</div>
                @endif
            </div>
        </div>
        <div class="form-row mb-20">
            <div class="col-sm-12">
                <label class="font-14 bold black">{{ translate('Blog Colum') }}</label>
            </div>
            <div class="col-sm-12" id="blog_colum_image_field">
                <div class="row">
                    <div class="col-4">
                        <div class="input-group">
                            <input type="radio" checked class="d-none" name="blog_colum" id="blog_colum_1"
                                value="col-12">
                            <label for="blog_colum_1">
                                <img src="{{ asset('themes/default/public/assets/images/layout/1column.png') }}"
                                    title="Blog Column 1" alt="Blog Column 1" class="layout_img">
                            </label>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="input-group">
                            <input type="radio" class="d-none" name="blog_colum" id="blog_colum_2" value="col-sm-6">
                            <label for="blog_colum_2">
                                <img src="{{ asset('themes/default/public/assets/images/layout/2column.png') }}"
                                    title="Blog Column 2" alt="Blog Column 2" class="layout_img">
                            </label>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="input-group">
                            <input type="radio" class="d-none" name="blog_colum" id="blog_colum_3"
                                value="col-sm-6 col-md-4">
                            <label for="blog_colum_3">
                                <img src="{{ asset('themes/default/public/assets/images/layout/3column.png') }}"
                                    title="Blog Column 3" alt="Blog Column 3" class="layout_img">
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row mb-20">
            <div class="col-sm-12">
                <label class="font-14 bold black">{{ translate('Number of Blogs') }} </label>
            </div>
            <div class="col-sm-12">
                <input type="text" name="number_of_blogs" class="theme-input-style" value="3" placeholder="00">
                @if ($errors->has('number_of_blogs'))
                    <div class="invalid-input">{{ $errors->first('number_of_blogs') }}</div>
                @endif
            </div>
        </div>
        <div class="form-row mb-20">
            <div class="col-sm-12">
                <label class="font-14 bold black">{{ translate('Title') }} </label>
            </div>
            <div class="col-sm-12">
                <input type="text" name="title" class="theme-input-style" value="{{ old('title') }}"
                    placeholder="{{ translate('Type title') }}" required>
                @if ($errors->has('title'))
                    <div class="invalid-input">{{ $errors->first('title') }}</div>
                @endif
                <small>{{ translate('Title is visible in homepage. Transalate to another language') }} <a
                        href="{{ route('core.languages') }}">{{ translate('click here') }}.</a></small>
            </div>
        </div>
        <div class="form-row mb-20">
            <div class="col-sm-12">
                <label class="font-14 bold black">{{ translate('Title Color') }} </label>
            </div>
            <div class="col-sm-12">
                <div class="input-group addon">
                    <input type="text" name="title_color" class="color-input form-control style--two"
                        placeholder="#000000" value="#000000">
                    <div class="input-group-append">
                        <input type="color" class="input-group-text theme-input-style2 color-picker" id="colorPicker"
                            value="#a21010" oninput="selectColor(event,this.value)">
                    </div>
                </div>
                @if ($errors->has('title_color'))
                    <div class="invalid-input">{{ $errors->first('title_color') }}</div>
                @endif
            </div>
        </div>
        <div class="form-row mb-20">
            <div class="col-sm-12">
                <label class="font-14 bold black">{{ translate('Description Color') }} </label>
            </div>
            <div class="col-sm-12">
                <div class="input-group addon">
                    <input type="text" name="description_color" class="color-input form-control style--two"
                        placeholder="#000000" value="#000000">
                    <div class="input-group-append">
                        <input type="color" class="input-group-text theme-input-style2 color-picker" id="colorPicker"
                            value="#a21010" oninput="selectColor(event,this.value)">
                    </div>
                </div>
                @if ($errors->has('description_color'))
                    <div class="invalid-input">{{ $errors->first('description_color') }}</div>
                @endif
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="background" role="tabpanel" aria-labelledby="background-tab">
        <div class="form-row mb-20">
            <div class="col-sm-12">
                <label class="font-14 bold black">{{ translate('Background Color') }} </label>
            </div>
            <div class="col-sm-12">
                <div class="input-group addon">
                    <input type="text" name="bg_color" class="color-input form-control style--two"
                        placeholder="#000000" value="#000000">
                    <div class="input-group-append">
                        <input type="color" class="input-group-text theme-input-style2 color-picker"
                            id="colorPicker" value="#a21010" oninput="selectColor(event,this.value)">
                    </div>
                </div>
                @if ($errors->has('bg_color'))
                    <div class="invalid-input">{{ $errors->first('bg_color') }}</div>
                @endif
            </div>
        </div>
        <div class="form-row mb-20">
            <div class="col-sm-12">
                <label class="font-14 bold black">{{ translate('Background Image') }} </label>
            </div>
            <div class="col-md-12">
                @include('core::base.includes.media.media_input', [
                    'input' => 'bg_image',
                    'data' => old('bg_image'),
                ])
                @if ($errors->has('bg_image'))
                    <div class="invalid-input">{{ $errors->first('bg_image') }}</div>
                @endif
            </div>
        </div>
        <div class="form-row mb-20">
            <div class="col-sm-12">
                <label class="font-14 bold black"> {{ translate('Background Size') }} </label>
            </div>
            <div class="col-sm-12">
                <select class="theme-input-style" name="background_size">
                    <option value="cover">cover</option>
                    <option value="auto">auto</option>
                    <option value="contain">contain</option>
                    <option value="initial">initial</option>
                    <option value="revert">revert</option>
                    <option value="inherit">inherit</option>
                    <option value="revert-layer">revert-layer</option>
                    <option value="unset">unset</option>
                </select>
                @if ($errors->has('background_size'))
                    <div class="invalid-input">{{ $errors->first('background_size') }}</div>
                @endif
            </div>
        </div>
        <div class="form-row mb-20">
            <div class="col-sm-12">
                <label class="font-14 bold black"> {{ translate('Background Position') }} </label>
            </div>
            <div class="col-sm-12">
                <select class="theme-input-style" name="background_position">
                    <option value="bottom">bottom</option>
                    <option value="center">center</option>
                    <option value="inherit">inherit</option>
                    <option value="initial">initial</option>
                    <option value="left">left</option>
                    <option value="revert">revert</option>
                    <option value="revert-layer">revert-layer</option>
                    <option value="right">right</option>
                    <option value="top">top</option>
                    <option value="unset">unset</option>
                </select>
                @if ($errors->has('background_position'))
                    <div class="invalid-input">{{ $errors->first('background_position') }}</div>
                @endif
            </div>
        </div>
        <div class="form-row mb-20">
            <div class="col-sm-12">
                <label class="font-14 bold black"> {{ translate('Background Repeat') }} </label>
            </div>
            <div class="col-sm-12">
                <select class="theme-input-style" name="background_repeat">
                    <option value="no-repeat">no-repeat</option>
                    <option value="repeat">repeat</option>
                </select>
                @if ($errors->has('background_repeat'))
                    <div class="invalid-input">{{ $errors->first('background_repeat') }}</div>
                @endif
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="button" role="tabpanel" aria-labelledby="button-tab">
        <div class="form-row mb-20">
            <div class="col-sm-12">
                <label class="font-14 bold black">{{ translate('Button Title') }} </label>
            </div>
            <div class="col-sm-12">
                <input type="text" name="btn_title" class="theme-input-style" value="{{ old('btn_title') }}"
                    placeholder="{{ translate('Button Title') }}">
                @if ($errors->has('btn_title'))
                    <div class="invalid-input">{{ $errors->first('btn_title') }}</div>
                @endif
                <small>{{ translate('Button title is visible in homepage. Transalate to another language') }} <a
                        href="{{ route('core.languages') }}">{{ translate('click here') }}.</a></small>
            </div>
        </div>
        <div class="form-row mb-20">
            <div class="col-sm-12">
                <label class="font-14 bold black">{{ translate('Button Color') }} </label>
            </div>
            <div class="col-sm-12">
                <div class="input-group addon">
                    <input type="text" name="btn_color" class="color-input form-control style--two"
                        placeholder="#000000" value="#000000">
                    <div class="input-group-append">
                        <input type="color" class="input-group-text theme-input-style2 color-picker"
                            id="colorPicker" value="#a21010" oninput="selectColor(event,this.value)">
                    </div>
                </div>
                @if ($errors->has('btn_color'))
                    <div class="invalid-input">{{ $errors->first('btn_color') }}</div>
                @endif
            </div>
        </div>
        <div class="form-row mb-20">
            <div class="col-sm-12">
                <label class="font-14 bold black">{{ translate('Button Hover Color') }} </label>
            </div>
            <div class="col-sm-12">
                <div class="input-group addon">
                    <input type="text" name="btn_hover_color" class="color-input form-control style--two"
                        placeholder="#000000" value="#000000">
                    <div class="input-group-append">
                        <input type="color" class="input-group-text theme-input-style2 color-picker"
                            id="colorPicker" value="#a21010" oninput="selectColor(event,this.value)">
                    </div>
                </div>
                @if ($errors->has('btn_hover_color'))
                    <div class="invalid-input">{{ $errors->first('btn_hover_color') }}</div>
                @endif
            </div>
        </div>
        <div class="form-row mb-20">
            <div class="col-sm-12">
                <label class="font-14 bold black">{{ translate('Button Background Color') }} </label>
            </div>
            <div class="col-sm-12">
                <div class="input-group addon">
                    <input type="text" name="btn_bg_color" class="color-input form-control style--two"
                        placeholder="#000000" value="#000000">
                    <div class="input-group-append">
                        <input type="color" class="input-group-text theme-input-style2 color-picker"
                            id="colorPicker" value="#a21010" oninput="selectColor(event,this.value)">
                    </div>
                </div>
                @if ($errors->has('btn_bg_color'))
                    <div class="invalid-input">{{ $errors->first('btn_bg_color') }}</div>
                @endif
            </div>
        </div>
        <div class="form-row mb-20">
            <div class="col-sm-12">
                <label class="font-14 bold black">{{ translate('Button Background Hover Color') }} </label>
            </div>
            <div class="col-sm-12">
                <div class="input-group addon">
                    <input type="text" name="btn_bg_hover_color" class="color-input form-control style--two"
                        placeholder="#000000" value="#000000">
                    <div class="input-group-append">
                        <input type="color" class="input-group-text theme-input-style2 color-picker"
                            id="colorPicker" value="#a21010" oninput="selectColor(event,this.value)">
                    </div>
                </div>
                @if ($errors->has('btn_bg_hover_color'))
                    <div class="invalid-input">{{ $errors->first('btn_bg_hover_color') }}</div>
                @endif
            </div>
        </div>
        <div class="form-row mb-20">
            <div class="col-sm-12">
                <label class="font-14 bold black">{{ translate('Button Border') }} </label>
            </div>
            <div class="col-sm-12">
                <div class="input-group addon">
                    <input type="text" class="form-control radius-0" name="btn_border" placeholder="00">
                    <div class="input-group-append">
                        <span class="input-group-text style--three black bold">px</span>
                    </div>
                </div>
                @if ($errors->has('btn_border'))
                    <div class="invalid-input">{{ $errors->first('btn_border') }}</div>
                @endif
            </div>
        </div>
        <div class="form-row mb-20">
            <div class="col-sm-12">
                <label class="font-14 bold black">{{ translate('Button Border Color') }} </label>
            </div>
            <div class="col-sm-12">
                <div class="input-group addon">
                    <input type="text" name="btn_border_color" class="color-input form-control style--two"
                        placeholder="#000000" value="#000000">
                    <div class="input-group-append">
                        <input type="color" class="input-group-text theme-input-style2 color-picker"
                            id="colorPicker" value="#a21010" oninput="selectColor(event,this.value)">
                    </div>
                </div>
                @if ($errors->has('btn_border_color'))
                    <div class="invalid-input">{{ $errors->first('btn_border_color') }}</div>
                @endif
            </div>
        </div>
        <div class="form-row mb-20">
            <div class="col-sm-12">
                <label class="font-14 bold black">{{ translate('Button Border Hover Color') }} </label>
            </div>
            <div class="col-sm-12">
                <div class="input-group addon">
                    <input type="text" name="btn_border_hover_color" class="color-input form-control style--two"
                        placeholder="#000000" value="#000000">
                    <div class="input-group-append">
                        <input type="color" class="input-group-text theme-input-style2 color-picker"
                            id="colorPicker" value="#a21010" oninput="selectColor(event,this.value)">
                    </div>
                </div>
                @if ($errors->has('btn_border_hover_color'))
                    <div class="invalid-input">{{ $errors->first('btn_border_hover_color') }}</div>
                @endif
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="advanced" role="tabpanel" aria-labelledby="advanced-tab">

        <div class="form-row mb-20">
            <div class="col-sm-12">
                <label class="font-14 bold black">{{ translate('Padding') }} </label>
            </div>
            <div class="col-sm-3">
                <div class="input-group addon">
                    <input type="text" class="form-control radius-0" name="padding_top" id="left-right-addons"
                        placeholder="00">
                    <div class="input-group-append">
                        <span class="input-group-text style--three black bold">px</span>
                    </div>
                </div>
                <small>{{ translate('Top') }}</small>
                @if ($errors->has('padding_top'))
                    <div class="invalid-input">{{ $errors->first('padding_top') }}</div>
                @endif
            </div>
            <div class="col-sm-3">
                <div class="input-group addon">
                    <input type="text" class="form-control radius-0" name="padding_right" id="left-right-addons"
                        placeholder="00">
                    <div class="input-group-append">
                        <span class="input-group-text style--three black bold">px</span>
                    </div>
                </div>
                <small>{{ translate('Right') }}</small>
                @if ($errors->has('padding_right'))
                    <div class="invalid-input">{{ $errors->first('padding_right') }}</div>
                @endif
            </div>
            <div class="col-sm-3">
                <div class="input-group addon">
                    <input type="text" class="form-control radius-0" name="padding_bottom" id="left-right-addons"
                        placeholder="00">
                    <div class="input-group-append">
                        <span class="input-group-text style--three black bold">px</span>
                    </div>
                </div>
                <small>{{ translate('Bottom') }}</small>
                @if ($errors->has('padding_bottom'))
                    <div class="invalid-input">{{ $errors->first('padding_bottom') }}</div>
                @endif
            </div>
            <div class="col-sm-3">
                <div class="input-group addon">
                    <input type="text" class="form-control radius-0" name="padding_left" id="left-right-addons"
                        placeholder="00">
                    <div class="input-group-append">
                        <span class="input-group-text style--three black bold">px</span>
                    </div>
                </div>
                <small>{{ translate('Left') }}</small>
                @if ($errors->has('padding_left'))
                    <div class="invalid-input">{{ $errors->first('padding_left') }}</div>
                @endif
            </div>
        </div>

        <div class="form-row mb-20">
            <div class="col-sm-12">
                <label class="font-14 bold black">{{ translate('Margin') }} </label>
            </div>
            <div class="col-sm-3">
                <div class="input-group addon">
                    <input type="text" class="form-control radius-0" name="margin_top" id="left-right-addons"
                        placeholder="00">
                    <div class="input-group-append">
                        <span class="input-group-text style--three black bold">px</span>
                    </div>
                </div>
                <small>{{ translate('Top') }}</small>
                @if ($errors->has('margin_top'))
                    <div class="invalid-input">{{ $errors->first('margin_top') }}</div>
                @endif
            </div>
            <div class="col-sm-3">
                <div class="input-group addon">
                    <input type="text" class="form-control radius-0" name="margin_right" id="left-right-addons"
                        placeholder="00">
                    <div class="input-group-append">
                        <span class="input-group-text style--three black bold">px</span>
                    </div>
                </div>
                <small>{{ translate('Right') }}</small>
                @if ($errors->has('margin_right'))
                    <div class="invalid-input">{{ $errors->first('margin_right') }}</div>
                @endif
            </div>
            <div class="col-sm-3">
                <div class="input-group addon">
                    <input type="text" class="form-control radius-0" name="margin_bottom" id="left-right-addons"
                        placeholder="00">
                    <div class="input-group-append">
                        <span class="input-group-text style--three black bold">px</span>
                    </div>
                </div>
                <small>{{ translate('Bottom') }}</small>
                @if ($errors->has('margin_bottom'))
                    <div class="invalid-input">{{ $errors->first('margin_bottom') }}</div>
                @endif
            </div>
            <div class="col-sm-3">
                <div class="input-group addon">
                    <input type="text" class="form-control radius-0" name="margin_left" id="left-right-addons"
                        placeholder="00">
                    <div class="input-group-append">
                        <span class="input-group-text style--three black bold">px</span>
                    </div>
                </div>
                <small>{{ translate('Left') }}</small>
                @if ($errors->has('margin_left'))
                    <div class="invalid-input">{{ $errors->first('margin_left') }}</div>
                @endif
            </div>
        </div>

    </div>
</div>
