@php
   $fonts = getAllFonts();
@endphp
{{-- Heading Typography --}}
<h3 class="black mb-3">{{ translate('Heading Typography') }}</h3>
<input type="hidden" name="option_name" value="heading_typography">

{{-- All Heading Typography Field Start --}}
<div class="form-group row py-4 border-bottom">
    <div class="col-xl-3">
        <label for="" class="font-16 bold black">{{ translate('All Heading Typography') }}
        </label>
        <span class="d-block">{{ translate('These settings control the typography for all Heading.') }}</span>
    </div>
    <div class="col-xl-8 offset-xl-1">
        <input type="hidden" name="all_heading_typography_google_link_s" id="all_heading_typography_google_link_s" value="{{ isset($option_settings['all_heading_typography_google_link_s']) ? $option_settings['all_heading_typography_google_link_s']:''}}">

        <input type="hidden" name="all_heading_typography_css_i" id="all_heading_typography_css" value="{{ isset($option_settings['all_heading_typography_css_i']) ? $option_settings['all_heading_typography_css_i']:''}}">

        <input type="hidden" name="all_heading_font_unit_i" value="px">
        <div class="row">
            <div class="col-xl-6">
                <div class="form-group">
                    <label>{{ translate('Font Family') }}</label>
                    <select name="all_heading_font_font-family" class="form-control select font_family" id="all_heading_font_family" data-section="all_heading">
                        <option value="" {{ isset($option_settings['all_heading_font_font-family']) ? '':'selected' }}>{{ translate('Select  Fonts') }}</option>
                        <optgroup label="{{ translate('Custom Fonts') }}">
                            <option value="custom-font-1,sans-serif" {{ isset($option_settings['all_heading_font_font-family']) && $option_settings['all_heading_font_font-family'] == 'custom-font-1,sans-serif' ? 'selected':'' }} data-subsets="" data-variations="">{{ translate('Custom Font 1') }}</option>
                            <option value="custom-font-2,sans-serif" {{ isset($option_settings['all_heading_font_font-family']) && $option_settings['all_heading_font_font-family'] == 'custom-font-2,sans-serif' ? 'selected':'' }} data-subsets="" data-variations="">{{ translate('Custom Font 2') }}</option>
                        </optgroup>
                        <optgroup label="{{ translate('Google Web Fonts') }}">
                            @foreach ($fonts as $font)
                                <option value="{{ $font['family'].',sans-serif' }}"
                                    {{ isset($option_settings['all_heading_font_font-family']) && $option_settings['all_heading_font_font-family'] == $font['family'].',sans-serif' ? 'selected':'' }} 
                                    data-subsets="{{ $font['subsets'] }}" data-variations="{{ $font['variants'] }}">
                                    {{ $font['family'] }}
                                </option>
                            @endforeach
                        </optgroup>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label>{{ translate('Font Weight & Style') }}</label>
                    <input type="hidden" name="all_heading_font_font-style" id="all_heading_font_style" value="{{ isset($option_settings['all_heading_font_font-style']) ? $option_settings['all_heading_font_font-style']:'' }}">

                    <input type="hidden" name="all_heading_font_font-weight" id="all_heading_font_weight" value="{{ isset($option_settings['all_heading_font_font-weight']) ? $option_settings['all_heading_font_font-weight']:'' }}">

                    <select name="all_heading_font_weight_style_i" class="form-control select" id="all_heading_font_weight_style_i" data-value="{{ isset($option_settings['all_heading_font_weight_style_i']) ? $option_settings['all_heading_font_weight_style_i']:null }}" onchange="createUrl('all_heading')">
                        <option value="" {{ isset($option_settings['all_heading_font_weight_style_i']) ? '':'selected' }}>{{ translate('Select Weight & Style') }}</option>
                        <option value="400" {{ isset($option_settings['all_heading_font_weight_style_i']) && $option_settings['all_heading_font_weight_style_i'] == '400' ? 'selected':'' }}>Normal 400</option>
                        <option value="700" {{ isset($option_settings['all_heading_font_weight_style_i']) && $option_settings['all_heading_font_weight_style_i'] == '700' ? 'selected':'' }}>Bold 700</option>
                        <option value="400italic" {{ isset($option_settings['all_heading_font_weight_style_i']) && $option_settings['all_heading_font_weight_style_i'] == '400italic' ? 'selected':'' }}>Normal 400 Italic</option>
                        <option value="700italic" {{ isset($option_settings['all_heading_font_weight_style_i']) && $option_settings['all_heading_font_weight_style_i'] == '700italic' ? 'selected':'' }}>Bold 700 Italic</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label>{{ translate('Font Subsets') }}</label>
                    <select name="all_heading_font_font-subsets_i" class="form-control select" id="all_heading_font_subsets" data-value="{{ isset($option_settings['all_heading_font_font-subsets_i']) ? $option_settings['all_heading_font_font-subsets_i']:null }}"  onchange="createUrl('all_heading')">
                        <option value="" {{ isset($option_settings['all_heading_font_font-subsets_i']) ? '':'selected' }}>{{ translate('Select Font Subsets') }}</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label>{{ translate('Text Align') }}</label>
                    <select name="all_heading_font_text-align" class="form-control select" id="all_heading_text_align" onchange="createFontCss('all_heading')">
                        <option value="" disabled {{ isset($option_settings['all_heading_font_text-align']) ? '':'selected' }}>{{ translate('Text Align') }}</option>
                        <option value="inherit" {{ isset($option_settings['all_heading_font_text-align']) && $option_settings['all_heading_font_text-align'] == 'inherit' ? 'selected':'' }}>Inherit</option>
                        <option value="left" {{ isset($option_settings['all_heading_font_text-align']) && $option_settings['all_heading_font_text-align'] == 'left' ? 'selected':'' }}>Left</option>
                        <option value="right" {{ isset($option_settings['all_heading_font_text-align']) && $option_settings['all_heading_font_text-align'] == 'right' ? 'selected':'' }}>Right</option>
                        <option value="center" {{ isset($option_settings['all_heading_font_text-align']) && $option_settings['all_heading_font_text-align'] == 'center' ? 'selected':'' }}>Center</option>
                        <option value="justify" {{ isset($option_settings['all_heading_font_text-align']) && $option_settings['all_heading_font_text-align'] == 'justify' ? 'selected':'' }}>Justify</option>
                        <option value="initial" {{ isset($option_settings['all_heading_font_text-align']) && $option_settings['all_heading_font_text-align'] == 'initial' ? 'selected':'' }}>Initial</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label>{{ translate('Text Transform') }}</label>
                    <select name="all_heading_font_text-transform" class="form-control select" id="all_heading_text_transform" onchange="createFontCss('all_heading')">
                        <option value="" disabled {{ isset($option_settings['all_heading_font_text-transform']) ? '':'selected' }}>{{ translate('Text Transform') }}</option>
                        <option value="none" {{ isset($option_settings['all_heading_font_text-transform']) && $option_settings['all_heading_font_text-transform'] == 'none' ? 'selected':'' }}>None</option>
                        <option value="capitalize" {{ isset($option_settings['all_heading_font_text-transform']) && $option_settings['all_heading_font_text-transform'] == 'capitalize' ? 'selected':'' }}>Capitalize</option>
                        <option value="uppercase" {{ isset($option_settings['all_heading_font_text-transform']) && $option_settings['all_heading_font_text-transform'] == 'uppercase' ? 'selected':'' }}>Uppercase</option>
                        <option value="lowercase" {{ isset($option_settings['all_heading_font_text-transform']) && $option_settings['all_heading_font_text-transform'] == 'lowercase' ? 'selected':'' }}>Lowercase</option>
                        <option value="initial" {{ isset($option_settings['all_heading_font_text-transform']) && $option_settings['all_heading_font_text-transform'] == 'initial' ? 'selected':'' }}>Initial</option>
                        <option value="inherit" {{ isset($option_settings['all_heading_font_text-transform']) && $option_settings['all_heading_font_text-transform'] == 'inherit' ? 'selected':'' }}>Inherit</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6 row">
                <div class="col-xl-6">
                    <div class="form-group">
                        <label>{{ translate('Font Size') }}</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="all_heading_font_u_font-size"
                                id="all_heading_font_size" placeholder="{{ translate('Size') }}" value="{{ isset($option_settings['all_heading_font_u_font-size']) ? $option_settings['all_heading_font_u_font-size']:'' }}" onkeyup="createFontCss('all_heading')">
                            <div class="input-group-append">
                                <div class="input-group-text">px</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="form-group">
                        <label>{{ translate('Line Height') }}</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="all_heading_font_u_line-height"
                                id="all_heading_line_height" placeholder="{{ translate('Height') }}" value="{{ isset($option_settings['all_heading_font_u_line-height']) ? $option_settings['all_heading_font_u_line-height']:'' }}" onkeyup="createFontCss('all_heading')">
                            <div class="input-group-append">
                                <div class="input-group-text">px</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 row">
                <div class="col-xl-4">
                    <div class="form-group">
                        <label>{{ translate('Word Spacing') }}</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="all_heading_font_u_word-spacing"
                                id="all_heading_word_spacing" placeholder="{{ translate('Word Spacing') }}" value="{{ isset($option_settings['all_heading_font_u_word-spacing']) ? $option_settings['all_heading_font_u_word-spacing']:'' }}" onkeyup="createFontCss('all_heading')">
                            <div class="input-group-append">
                                <div class="input-group-text">px</div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="col-xl-4">
                    <div class="form-group">
                        <label>{{ translate('Letter Spacing') }}</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="all_heading_font_u_letter-spacing"
                                id="all_heading_letter_spacing" placeholder="{{ translate('Letter Spacing') }}" value="{{ isset($option_settings['all_heading_font_u_letter-spacing']) ? $option_settings['all_heading_font_u_letter-spacing']:'' }}" onkeyup="createFontCss('all_heading')">
                            <div class="input-group-append">
                                <div class="input-group-text">px</div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="col-xl-4">
                    <label for="all_heading_font_color">{{ translate('Select Color') }}</label>
                    <div class="color w-100">
                        <input type="text" class="form-control" name="all_heading_font_color"
                            value="{{ isset($option_settings['all_heading_font_color']) ? $option_settings['all_heading_font_color']:'' }}">
                        <input type="color" class="" id="all_heading_font_color" value="{{ isset($option_settings['all_heading_font_color']) ? $option_settings['all_heading_font_color']:'#fafafa' }}" oninput="createFontCss('all_heading')">
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4 border p-4 typography_preview" id="all_heading_typography_preview">
            {{ translate('The Quick Brown Fox Jumps Over The Lazy Dog') }}
        </div>
    </div>
</div>
{{-- All Heading Typography Field End --}}

{{-- (H1) Heading Typography Field Start --}}
<div class="form-group row py-4 border-bottom">
    <div class="col-xl-3">
        <label for="" class="font-16 bold black">{{ translate('(H1) Heading Typography') }}
        </label>
        <span class="d-block">{{ translate('These settings control the typography for all (H1)Heading.') }}</span>
    </div>
    <div class="col-xl-8 offset-xl-1">
        <input type="hidden" name="h1_heading_typography_google_link_s" id="h1_heading_typography_google_link_s" value="{{ isset($option_settings['h1_heading_typography_google_link_s']) ? $option_settings['h1_heading_typography_google_link_s']:''}}">
        
        <input type="hidden" name="h1_heading_typography_css_i" id="h1_heading_typography_css" value="{{ isset($option_settings['h1_heading_typography_css_i']) ? $option_settings['h1_heading_typography_css_i']:''}}">

        <input type="hidden" name="h1_heading_font_unit_i" value="px">
        <div class="row">
            <div class="col-xl-6">
                <div class="form-group">
                    <label>{{ translate('Font Family') }}</label>
                    <select name="h1_heading_font_font-family" class="form-control select font_family" id="h1_heading_font_family" data-section="h1_heading">
                        <option value="" {{ isset($option_settings['h1_heading_font_font-family']) ? '':'selected' }}>{{ translate('Select  Fonts') }}</option>
                        <optgroup label="{{ translate('Custom Fonts') }}">
                            <option value="custom-font-1,sans-serif" {{ isset($option_settings['h1_heading_font_font-family']) && $option_settings['h1_heading_font_font-family'] == 'custom-font-1,sans-serif' ? 'selected':'' }} data-subsets="" data-variations="">{{ translate('Custom Font 1') }}</option>
                            <option value="custom-font-2,sans-serif" {{ isset($option_settings['h1_heading_font_font-family']) && $option_settings['h1_heading_font_font-family'] == 'custom-font-2,sans-serif' ? 'selected':'' }} data-subsets="" data-variations="">{{ translate('Custom Font 2') }}</option>
                        </optgroup>
                        <optgroup label="{{ translate('Google Web Fonts') }}">
                            @foreach ($fonts as $font)
                                <option value="{{ $font['family'].',sans-serif' }}"
                                    {{ isset($option_settings['h1_heading_font_font-family']) && $option_settings['h1_heading_font_font-family'] == $font['family'].',sans-serif' ? 'selected':'' }} 
                                    data-subsets="{{ $font['subsets'] }}" data-variations="{{ $font['variants'] }}">
                                    {{ $font['family'] }}
                                </option>
                            @endforeach
                        </optgroup>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label>{{ translate('Font Weight & Style') }}</label>
                    <input type="hidden" name="h1_heading_font_font-style" id="h1_heading_font_style" value="{{ isset($option_settings['h1_heading_font_font-style']) ? $option_settings['h1_heading_font_font-style']:'' }}">

                    <input type="hidden" name="h1_heading_font_font-weight" id="h1_heading_font_weight" value="{{ isset($option_settings['h1_heading_font_font-weight']) ? $option_settings['h1_heading_font_font-weight']:'' }}">

                    <select name="h1_heading_font_weight_style_i" class="form-control select" id="h1_heading_font_weight_style_i" data-value="{{ isset($option_settings['h1_heading_font_weight_style_i']) ? $option_settings['h1_heading_font_weight_style_i']:null }}" onchange="createUrl('h1_heading')">
                        <option value="" {{ isset($option_settings['h1_heading_font_weight_style_i']) ? '':'selected' }}>{{ translate('Select Weight & Style') }}</option>
                        <option value="400" {{ isset($option_settings['h1_heading_font_weight_style_i']) && $option_settings['h1_heading_font_weight_style_i'] == '400' ? 'selected':'' }}>Normal 400</option>
                        <option value="700" {{ isset($option_settings['h1_heading_font_weight_style_i']) && $option_settings['h1_heading_font_weight_style_i'] == '700' ? 'selected':'' }}>Bold 700</option>
                        <option value="400italic" {{ isset($option_settings['h1_heading_font_weight_style_i']) && $option_settings['h1_heading_font_weight_style_i'] == '400italic' ? 'selected':'' }}>Normal 400 Italic</option>
                        <option value="700italic" {{ isset($option_settings['h1_heading_font_weight_style_i']) && $option_settings['h1_heading_font_weight_style_i'] == '700italic' ? 'selected':'' }}>Bold 700 Italic</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label>{{ translate('Font Subsets') }}</label>
                    <select name="h1_heading_font_font-subsets_i" class="form-control select" id="h1_heading_font_subsets" data-value="{{ isset($option_settings['h1_heading_font_font-subsets_i']) ? $option_settings['h1_heading_font_font-subsets_i']:null }}"  onchange="createUrl('h1_heading')">
                        <option value="" {{ isset($option_settings['h1_heading_font_font-subsets_i']) ? '':'selected' }}>{{ translate('Select Font Subsets') }}</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label>{{ translate('Text Align') }}</label>
                    <select name="h1_heading_font_text-align" class="form-control select" id="h1_heading_text_align" onchange="createFontCss('h1_heading')">
                        <option value="" disabled {{ isset($option_settings['h1_heading_font_text-align']) ? '':'selected' }}>{{ translate('Text Align') }}</option>
                        <option value="inherit" {{ isset($option_settings['h1_heading_font_text-align']) && $option_settings['h1_heading_font_text-align'] == 'inherit' ? 'selected':'' }}>Inherit</option>
                        <option value="left" {{ isset($option_settings['h1_heading_font_text-align']) && $option_settings['h1_heading_font_text-align'] == 'left' ? 'selected':'' }}>Left</option>
                        <option value="right" {{ isset($option_settings['h1_heading_font_text-align']) && $option_settings['h1_heading_font_text-align'] == 'right' ? 'selected':'' }}>Right</option>
                        <option value="center" {{ isset($option_settings['h1_heading_font_text-align']) && $option_settings['h1_heading_font_text-align'] == 'center' ? 'selected':'' }}>Center</option>
                        <option value="justify" {{ isset($option_settings['h1_heading_font_text-align']) && $option_settings['h1_heading_font_text-align'] == 'justify' ? 'selected':'' }}>Justify</option>
                        <option value="initial" {{ isset($option_settings['h1_heading_font_text-align']) && $option_settings['h1_heading_font_text-align'] == 'initial' ? 'selected':'' }}>Initial</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label>{{ translate('Text Transform') }}</label>
                    <select name="h1_heading_font_text-transform" class="form-control select" id="h1_heading_text_transform" onchange="createFontCss('h1_heading')">
                        <option value="" disabled {{ isset($option_settings['h1_heading_font_text-transform']) ? '':'selected' }}>{{ translate('Text Transform') }}</option>
                        <option value="none" {{ isset($option_settings['h1_heading_font_text-transform']) && $option_settings['h1_heading_font_text-transform'] == 'none' ? 'selected':'' }}>None</option>
                        <option value="capitalize" {{ isset($option_settings['h1_heading_font_text-transform']) && $option_settings['h1_heading_font_text-transform'] == 'capitalize' ? 'selected':'' }}>Capitalize</option>
                        <option value="uppercase" {{ isset($option_settings['h1_heading_font_text-transform']) && $option_settings['h1_heading_font_text-transform'] == 'uppercase' ? 'selected':'' }}>Uppercase</option>
                        <option value="lowercase" {{ isset($option_settings['h1_heading_font_text-transform']) && $option_settings['h1_heading_font_text-transform'] == 'lowercase' ? 'selected':'' }}>Lowercase</option>
                        <option value="initial" {{ isset($option_settings['h1_heading_font_text-transform']) && $option_settings['h1_heading_font_text-transform'] == 'initial' ? 'selected':'' }}>Initial</option>
                        <option value="inherit" {{ isset($option_settings['h1_heading_font_text-transform']) && $option_settings['h1_heading_font_text-transform'] == 'inherit' ? 'selected':'' }}>Inherit</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6 row">
                <div class="col-xl-6">
                    <div class="form-group">
                        <label>{{ translate('Font Size') }}</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="h1_heading_font_u_font-size"
                                id="h1_heading_font_size" placeholder="{{ translate('Size') }}" value="{{ isset($option_settings['h1_heading_font_u_font-size']) ? $option_settings['h1_heading_font_u_font-size']:'' }}" onkeyup="createFontCss('h1_heading')">
                            <div class="input-group-append">
                                <div class="input-group-text">px</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="form-group">
                        <label>{{ translate('Line Height') }}</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="h1_heading_font_u_line-height"
                                id="h1_heading_line_height" placeholder="{{ translate('Height') }}" value="{{ isset($option_settings['h1_heading_font_u_line-height']) ? $option_settings['h1_heading_font_u_line-height']:'' }}" onkeyup="createFontCss('h1_heading')">
                            <div class="input-group-append">
                                <div class="input-group-text">px</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 row">
                <div class="col-xl-4">
                    <div class="form-group">
                        <label>{{ translate('Word Spacing') }}</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="h1_heading_font_u_word-spacing"
                                id="h1_heading_word_spacing" placeholder="{{ translate('Word Spacing') }}" value="{{ isset($option_settings['h1_heading_font_u_word-spacing']) ? $option_settings['h1_heading_font_u_word-spacing']:'' }}" onkeyup="createFontCss('h1_heading')">
                            <div class="input-group-append">
                                <div class="input-group-text">px</div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="col-xl-4">
                    <div class="form-group">
                        <label>{{ translate('Letter Spacing') }}</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="h1_heading_font_u_letter-spacing"
                                id="h1_heading_letter_spacing" placeholder="{{ translate('Letter Spacing') }}" value="{{ isset($option_settings['h1_heading_font_u_letter-spacing']) ? $option_settings['h1_heading_font_u_letter-spacing']:'' }}" onkeyup="createFontCss('h1_heading')">
                            <div class="input-group-append">
                                <div class="input-group-text">px</div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="col-xl-4">
                    <label for="h1_heading_font_color">{{ translate('Select Color') }}</label>
                    <div class="color w-100">
                        <input type="text" class="form-control" name="h1_heading_font_color"
                            value="{{ isset($option_settings['h1_heading_font_color']) ? $option_settings['h1_heading_font_color']:'' }}">
                        <input type="color" class="" id="h1_heading_font_color" value="{{ isset($option_settings['h1_heading_font_color']) ? $option_settings['h1_heading_font_color']:'#fafafa' }}" oninput="createFontCss('h1_heading')">
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4 border p-4 typography_preview" id="h1_heading_typography_preview">
            {{ translate('The Quick Brown Fox Jumps Over The Lazy Dog') }}
        </div>
    </div>
</div>
{{-- (H1) Heading Typography Field End --}}

{{-- (H2) Heading Typography Field Start --}}
<div class="form-group row py-4 border-bottom">
    <div class="col-xl-3">
        <label for="" class="font-16 bold black">{{ translate('(H2) Heading Typography') }}
        </label>
        <span class="d-block">{{ translate('These settings control the typography for all (H2)Heading.') }}</span>
    </div>
    <div class="col-xl-8 offset-xl-1">
        <input type="hidden" name="h2_heading_typography_google_link_s" id="h2_heading_typography_google_link_s" value="{{ isset($option_settings['h2_heading_typography_google_link_s']) ? $option_settings['h2_heading_typography_google_link_s']:''}}">

        <input type="hidden" name="h2_heading_typography_css_i" id="h2_heading_typography_css" value="{{ isset($option_settings['h2_heading_typography_css_i']) ? $option_settings['h2_heading_typography_css_i']:''}}">

        <input type="hidden" name="h2_heading_font_unit_i" value="px">
        <div class="row">
            <div class="col-xl-6">
                <div class="form-group">
                    <label>{{ translate('Font Family') }}</label>
                    <select name="h2_heading_font_font-family" class="form-control select font_family" id="h2_heading_font_family" data-section="h2_heading">
                        <option value="" {{ isset($option_settings['h2_heading_font_font-family']) ? '':'selected' }}>{{ translate('Select  Fonts') }}</option>
                        <optgroup label="{{ translate('Custom Fonts') }}">
                            <option value="custom-font-1,sans-serif" {{ isset($option_settings['h2_heading_font_font-family']) && $option_settings['h2_heading_font_font-family'] == 'custom-font-1,sans-serif' ? 'selected':'' }} data-subsets="" data-variations="">{{ translate('Custom Font 1') }}</option>
                            <option value="custom-font-2,sans-serif" {{ isset($option_settings['h2_heading_font_font-family']) && $option_settings['h2_heading_font_font-family'] == 'custom-font-2,sans-serif' ? 'selected':'' }} data-subsets="" data-variations="">{{ translate('Custom Font 2') }}</option>
                        </optgroup>
                        <optgroup label="{{ translate('Google Web Fonts') }}">
                            @foreach ($fonts as $font)
                                <option value="{{ $font['family'].',sans-serif' }}"
                                    {{ isset($option_settings['h2_heading_font_font-family']) && $option_settings['h2_heading_font_font-family'] == $font['family'].',sans-serif' ? 'selected':'' }} 
                                    data-subsets="{{ $font['subsets'] }}" data-variations="{{ $font['variants'] }}">
                                    {{ $font['family'] }}
                                </option>
                            @endforeach
                        </optgroup>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label>{{ translate('Font Weight & Style') }}</label>
                    <input type="hidden" name="h2_heading_font_font-style" id="h2_heading_font_style" value="{{ isset($option_settings['h2_heading_font_font-style']) ? $option_settings['h2_heading_font_font-style']:'' }}">

                    <input type="hidden" name="h2_heading_font_font-weight" id="h2_heading_font_weight" value="{{ isset($option_settings['h2_heading_font_font-weight']) ? $option_settings['h2_heading_font_font-weight']:'' }}">

                    <select name="h2_heading_font_weight_style_i" class="form-control select" id="h2_heading_font_weight_style_i" data-value="{{ isset($option_settings['h2_heading_font_weight_style_i']) ? $option_settings['h2_heading_font_weight_style_i']:null }}" onchange="createUrl('h2_heading')">
                        <option value="" {{ isset($option_settings['h2_heading_font_weight_style_i']) ? '':'selected' }}>{{ translate('Select Weight & Style') }}</option>
                        <option value="400" {{ isset($option_settings['h2_heading_font_weight_style_i']) && $option_settings['h2_heading_font_weight_style_i'] == '400' ? 'selected':'' }}>Normal 400</option>
                        <option value="700" {{ isset($option_settings['h2_heading_font_weight_style_i']) && $option_settings['h2_heading_font_weight_style_i'] == '700' ? 'selected':'' }}>Bold 700</option>
                        <option value="400italic" {{ isset($option_settings['h2_heading_font_weight_style_i']) && $option_settings['h2_heading_font_weight_style_i'] == '400italic' ? 'selected':'' }}>Normal 400 Italic</option>
                        <option value="700italic" {{ isset($option_settings['h2_heading_font_weight_style_i']) && $option_settings['h2_heading_font_weight_style_i'] == '700italic' ? 'selected':'' }}>Bold 700 Italic</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label>{{ translate('Font Subsets') }}</label>
                    <select name="h2_heading_font_font-subsets_i" class="form-control select" id="h2_heading_font_subsets" data-value="{{ isset($option_settings['h2_heading_font_font-subsets_i']) ? $option_settings['h2_heading_font_font-subsets_i']:null }}"  onchange="createUrl('h2_heading')">
                        <option value="" {{ isset($option_settings['h2_heading_font_font-subsets_i']) ? '':'selected' }}>{{ translate('Select Font Subsets') }}</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label>{{ translate('Text Align') }}</label>
                    <select name="h2_heading_font_text-align" class="form-control select" id="h2_heading_text_align" onchange="createFontCss('h2_heading')">
                        <option value="" disabled {{ isset($option_settings['h2_heading_font_text-align']) ? '':'selected' }}>{{ translate('Text Align') }}</option>
                        <option value="inherit" {{ isset($option_settings['h2_heading_font_text-align']) && $option_settings['h2_heading_font_text-align'] == 'inherit' ? 'selected':'' }}>Inherit</option>
                        <option value="left" {{ isset($option_settings['h2_heading_font_text-align']) && $option_settings['h2_heading_font_text-align'] == 'left' ? 'selected':'' }}>Left</option>
                        <option value="right" {{ isset($option_settings['h2_heading_font_text-align']) && $option_settings['h2_heading_font_text-align'] == 'right' ? 'selected':'' }}>Right</option>
                        <option value="center" {{ isset($option_settings['h2_heading_font_text-align']) && $option_settings['h2_heading_font_text-align'] == 'center' ? 'selected':'' }}>Center</option>
                        <option value="justify" {{ isset($option_settings['h2_heading_font_text-align']) && $option_settings['h2_heading_font_text-align'] == 'justify' ? 'selected':'' }}>Justify</option>
                        <option value="initial" {{ isset($option_settings['h2_heading_font_text-align']) && $option_settings['h2_heading_font_text-align'] == 'initial' ? 'selected':'' }}>Initial</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label>{{ translate('Text Transform') }}</label>
                    <select name="h2_heading_font_text-transform" class="form-control select" id="h2_heading_text_transform" onchange="createFontCss('h2_heading')">
                        <option value="" disabled {{ isset($option_settings['h2_heading_font_text-transform']) ? '':'selected' }}>{{ translate('Text Transform') }}</option>
                        <option value="none" {{ isset($option_settings['h2_heading_font_text-transform']) && $option_settings['h2_heading_font_text-transform'] == 'none' ? 'selected':'' }}>None</option>
                        <option value="capitalize" {{ isset($option_settings['h2_heading_font_text-transform']) && $option_settings['h2_heading_font_text-transform'] == 'capitalize' ? 'selected':'' }}>Capitalize</option>
                        <option value="uppercase" {{ isset($option_settings['h2_heading_font_text-transform']) && $option_settings['h2_heading_font_text-transform'] == 'uppercase' ? 'selected':'' }}>Uppercase</option>
                        <option value="lowercase" {{ isset($option_settings['h2_heading_font_text-transform']) && $option_settings['h2_heading_font_text-transform'] == 'lowercase' ? 'selected':'' }}>Lowercase</option>
                        <option value="initial" {{ isset($option_settings['h2_heading_font_text-transform']) && $option_settings['h2_heading_font_text-transform'] == 'initial' ? 'selected':'' }}>Initial</option>
                        <option value="inherit" {{ isset($option_settings['h2_heading_font_text-transform']) && $option_settings['h2_heading_font_text-transform'] == 'inherit' ? 'selected':'' }}>Inherit</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6 row">
                <div class="col-xl-6">
                    <div class="form-group">
                        <label>{{ translate('Font Size') }}</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="h2_heading_font_u_font-size"
                                id="h2_heading_font_size" placeholder="{{ translate('Size') }}" value="{{ isset($option_settings['h2_heading_font_u_font-size']) ? $option_settings['h2_heading_font_u_font-size']:'' }}" onkeyup="createFontCss('h2_heading')">
                            <div class="input-group-append">
                                <div class="input-group-text">px</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="form-group">
                        <label>{{ translate('Line Height') }}</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="h2_heading_font_u_line-height"
                                id="h2_heading_line_height" placeholder="{{ translate('Height') }}" value="{{ isset($option_settings['h2_heading_font_u_line-height']) ? $option_settings['h2_heading_font_u_line-height']:'' }}" onkeyup="createFontCss('h2_heading')">
                            <div class="input-group-append">
                                <div class="input-group-text">px</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 row">
                <div class="col-xl-4">
                    <div class="form-group">
                        <label>{{ translate('Word Spacing') }}</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="h2_heading_font_u_word-spacing"
                                id="h2_heading_word_spacing" placeholder="{{ translate('Word Spacing') }}" value="{{ isset($option_settings['h2_heading_font_u_word-spacing']) ? $option_settings['h2_heading_font_u_word-spacing']:'' }}" onkeyup="createFontCss('h2_heading')">
                            <div class="input-group-append">
                                <div class="input-group-text">px</div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="col-xl-4">
                    <div class="form-group">
                        <label>{{ translate('Letter Spacing') }}</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="h2_heading_font_u_letter-spacing"
                                id="h2_heading_letter_spacing" placeholder="{{ translate('Letter Spacing') }}" value="{{ isset($option_settings['h2_heading_font_u_letter-spacing']) ? $option_settings['h2_heading_font_u_letter-spacing']:'' }}" onkeyup="createFontCss('h2_heading')">
                            <div class="input-group-append">
                                <div class="input-group-text">px</div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="col-xl-4">
                    <label for="h2_heading_font_color">{{ translate('Select Color') }}</label>
                    <div class="color w-100">
                        <input type="text" class="form-control" name="h2_heading_font_color"
                            value="{{ isset($option_settings['h2_heading_font_color']) ? $option_settings['h2_heading_font_color']:'' }}">
                        <input type="color" class="" id="h2_heading_font_color" value="{{ isset($option_settings['h2_heading_font_color']) ? $option_settings['h2_heading_font_color']:'#fafafa' }}" oninput="createFontCss('h2_heading')">
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4 border p-4 typography_preview" id="h2_heading_typography_preview">
            {{ translate('The Quick Brown Fox Jumps Over The Lazy Dog') }}
        </div>
    </div>
</div>
{{-- (H2) Heading Typography Field End --}}

{{-- (H3) Heading Typography Field Start --}}
<div class="form-group row py-4 border-bottom">
    <div class="col-xl-3">
        <label for="" class="font-16 bold black">{{ translate('(H3) Heading Typography') }}
        </label>
        <span class="d-block">{{ translate('These settings control the typography for all (H3)Heading.') }}</span>
    </div>
    <div class="col-xl-8 offset-xl-1">
        <input type="hidden" name="h3_heading_typography_google_link_s" id="h3_heading_typography_google_link_s" value="{{ isset($option_settings['h3_heading_typography_google_link_s']) ? $option_settings['h3_heading_typography_google_link_s']:''}}">

        <input type="hidden" name="h3_heading_typography_css_i" id="h3_heading_typography_css" value="{{ isset($option_settings['h3_heading_typography_css_i']) ? $option_settings['h3_heading_typography_css_i']:''}}">

        <input type="hidden" name="h3_heading_font_unit_i" value="px">
        <div class="row">
            <div class="col-xl-6">
                <div class="form-group">
                    <label>{{ translate('Font Family') }}</label>
                    <select name="h3_heading_font_font-family" class="form-control select font_family" id="h3_heading_font_family" data-section="h3_heading">
                        <option value="" {{ isset($option_settings['h3_heading_font_font-family']) ? '':'selected' }}>{{ translate('Select  Fonts') }}</option>
                        <optgroup label="{{ translate('Custom Fonts') }}">
                            <option value="custom-font-1,sans-serif" {{ isset($option_settings['h3_heading_font_font-family']) && $option_settings['h3_heading_font_font-family'] == 'custom-font-1,sans-serif' ? 'selected':'' }} data-subsets="" data-variations="">{{ translate('Custom Font 1') }}</option>

                            <option value="custom-font-2,sans-serif" {{ isset($option_settings['h3_heading_font_font-family']) && $option_settings['h3_heading_font_font-family'] == 'custom-font-2,sans-serif' ? 'selected':'' }} data-subsets="" data-variations="">{{ translate('Custom Font 2') }}</option>
                        </optgroup>
                        <optgroup label="{{ translate('Google Web Fonts') }}">
                            @foreach ($fonts as $font)
                                <option value="{{ $font['family'].',sans-serif' }}"
                                    {{ isset($option_settings['h3_heading_font_font-family']) && $option_settings['h3_heading_font_font-family'] == $font['family'].',sans-serif' ? 'selected':'' }} 
                                    data-subsets="{{ $font['subsets'] }}" data-variations="{{ $font['variants'] }}">
                                    {{ $font['family'] }}
                                </option>
                            @endforeach
                        </optgroup>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label>{{ translate('Font Weight & Style') }}</label>
                    <input type="hidden" name="h3_heading_font_font-style" id="h3_heading_font_style" value="{{ isset($option_settings['h3_heading_font_font-style']) ? $option_settings['h3_heading_font_font-style']:'' }}">

                    <input type="hidden" name="h3_heading_font_font-weight" id="h3_heading_font_weight" value="{{ isset($option_settings['h3_heading_font_font-weight']) ? $option_settings['h3_heading_font_font-weight']:'' }}">

                    <select name="h3_heading_font_weight_style_i" class="form-control select" id="h3_heading_font_weight_style_i" data-value="{{ isset($option_settings['h3_heading_font_weight_style_i']) ? $option_settings['h3_heading_font_weight_style_i']:null }}" onchange="createUrl('h3_heading')">
                        <option value="" {{ isset($option_settings['h3_heading_font_weight_style_i']) ? '':'selected' }}>{{ translate('Select Weight & Style') }}</option>
                        <option value="400" {{ isset($option_settings['h3_heading_font_weight_style_i']) && $option_settings['h3_heading_font_weight_style_i'] == '400' ? 'selected':'' }}>Normal 400</option>
                        <option value="700" {{ isset($option_settings['h3_heading_font_weight_style_i']) && $option_settings['h3_heading_font_weight_style_i'] == '700' ? 'selected':'' }}>Bold 700</option>
                        <option value="400italic" {{ isset($option_settings['h3_heading_font_weight_style_i']) && $option_settings['h3_heading_font_weight_style_i'] == '400italic' ? 'selected':'' }}>Normal 400 Italic</option>
                        <option value="700italic" {{ isset($option_settings['h3_heading_font_weight_style_i']) && $option_settings['h3_heading_font_weight_style_i'] == '700italic' ? 'selected':'' }}>Bold 700 Italic</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label>{{ translate('Font Subsets') }}</label>
                    <select name="h3_heading_font_font-subsets_i" class="form-control select" id="h3_heading_font_subsets" data-value="{{ isset($option_settings['h3_heading_font_font-subsets_i']) ? $option_settings['h3_heading_font_font-subsets_i']:null }}"  onchange="createUrl('h3_heading')">
                        <option value="" {{ isset($option_settings['h3_heading_font_font-subsets_i']) ? '':'selected' }}>{{ translate('Select Font Subsets') }}</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label>{{ translate('Text Align') }}</label>
                    <select name="h3_heading_font_text-align" class="form-control select" id="h3_heading_text_align" onchange="createFontCss('h3_heading')">
                        <option value="" disabled {{ isset($option_settings['h3_heading_font_text-align']) ? '':'selected' }}>{{ translate('Text Align') }}</option>
                        <option value="inherit" {{ isset($option_settings['h3_heading_font_text-align']) && $option_settings['h3_heading_font_text-align'] == 'inherit' ? 'selected':'' }}>Inherit</option>
                        <option value="left" {{ isset($option_settings['h3_heading_font_text-align']) && $option_settings['h3_heading_font_text-align'] == 'left' ? 'selected':'' }}>Left</option>
                        <option value="right" {{ isset($option_settings['h3_heading_font_text-align']) && $option_settings['h3_heading_font_text-align'] == 'right' ? 'selected':'' }}>Right</option>
                        <option value="center" {{ isset($option_settings['h3_heading_font_text-align']) && $option_settings['h3_heading_font_text-align'] == 'center' ? 'selected':'' }}>Center</option>
                        <option value="justify" {{ isset($option_settings['h3_heading_font_text-align']) && $option_settings['h3_heading_font_text-align'] == 'justify' ? 'selected':'' }}>Justify</option>
                        <option value="initial" {{ isset($option_settings['h3_heading_font_text-align']) && $option_settings['h3_heading_font_text-align'] == 'initial' ? 'selected':'' }}>Initial</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label>{{ translate('Text Transform') }}</label>
                    <select name="h3_heading_font_text-transform" class="form-control select" id="h3_heading_text_transform" onchange="createFontCss('h3_heading')">
                        <option value="" disabled {{ isset($option_settings['h3_heading_font_text-transform']) ? '':'selected' }}>{{ translate('Text Transform') }}</option>
                        <option value="none" {{ isset($option_settings['h3_heading_font_text-transform']) && $option_settings['h3_heading_font_text-transform'] == 'none' ? 'selected':'' }}>None</option>
                        <option value="capitalize" {{ isset($option_settings['h3_heading_font_text-transform']) && $option_settings['h3_heading_font_text-transform'] == 'capitalize' ? 'selected':'' }}>Capitalize</option>
                        <option value="uppercase" {{ isset($option_settings['h3_heading_font_text-transform']) && $option_settings['h3_heading_font_text-transform'] == 'uppercase' ? 'selected':'' }}>Uppercase</option>
                        <option value="lowercase" {{ isset($option_settings['h3_heading_font_text-transform']) && $option_settings['h3_heading_font_text-transform'] == 'lowercase' ? 'selected':'' }}>Lowercase</option>
                        <option value="initial" {{ isset($option_settings['h3_heading_font_text-transform']) && $option_settings['h3_heading_font_text-transform'] == 'initial' ? 'selected':'' }}>Initial</option>
                        <option value="inherit" {{ isset($option_settings['h3_heading_font_text-transform']) && $option_settings['h3_heading_font_text-transform'] == 'inherit' ? 'selected':'' }}>Inherit</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6 row">
                <div class="col-xl-6">
                    <div class="form-group">
                        <label>{{ translate('Font Size') }}</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="h3_heading_font_u_font-size"
                                id="h3_heading_font_size" placeholder="{{ translate('Size') }}" value="{{ isset($option_settings['h3_heading_font_u_font-size']) ? $option_settings['h3_heading_font_u_font-size']:'' }}" onkeyup="createFontCss('h3_heading')">
                            <div class="input-group-append">
                                <div class="input-group-text">px</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="form-group">
                        <label>{{ translate('Line Height') }}</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="h3_heading_font_u_line-height"
                                id="h3_heading_line_height" placeholder="{{ translate('Height') }}" value="{{ isset($option_settings['h3_heading_font_u_line-height']) ? $option_settings['h3_heading_font_u_line-height']:'' }}" onkeyup="createFontCss('h3_heading')">
                            <div class="input-group-append">
                                <div class="input-group-text">px</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 row">
                <div class="col-xl-4">
                    <div class="form-group">
                        <label>{{ translate('Word Spacing') }}</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="h3_heading_font_u_word-spacing"
                                id="h3_heading_word_spacing" placeholder="{{ translate('Word Spacing') }}" value="{{ isset($option_settings['h3_heading_font_u_word-spacing']) ? $option_settings['h3_heading_font_u_word-spacing']:'' }}" onkeyup="createFontCss('h3_heading')">
                            <div class="input-group-append">
                                <div class="input-group-text">px</div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="col-xl-4">
                    <div class="form-group">
                        <label>{{ translate('Letter Spacing') }}</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="h3_heading_font_u_letter-spacing"
                                id="h3_heading_letter_spacing" placeholder="{{ translate('Letter Spacing') }}" value="{{ isset($option_settings['h3_heading_font_u_letter-spacing']) ? $option_settings['h3_heading_font_u_letter-spacing']:'' }}" onkeyup="createFontCss('h3_heading')">
                            <div class="input-group-append">
                                <div class="input-group-text">px</div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="col-xl-4">
                    <label for="h3_heading_font_color">{{ translate('Select Color') }}</label>
                    <div class="color w-100">
                        <input type="text" class="form-control" name="h3_heading_font_color"
                            value="{{ isset($option_settings['h3_heading_font_color']) ? $option_settings['h3_heading_font_color']:'' }}">
                        <input type="color" class="" id="h3_heading_font_color" value="{{ isset($option_settings['h3_heading_font_color']) ? $option_settings['h3_heading_font_color']:'#fafafa' }}" oninput="createFontCss('h3_heading')">
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4 border p-4 typography_preview" id="h3_heading_typography_preview">
            {{ translate('The Quick Brown Fox Jumps Over The Lazy Dog') }}
        </div>
    </div>
</div>
{{-- (H3) Heading Typography Field End --}}

{{-- (H4) Heading Typography Field Start --}}
<div class="form-group row py-4 border-bottom">
    <div class="col-xl-3">
        <label for="" class="font-16 bold black">{{ translate('(H4) Heading Typography') }}
        </label>
        <span class="d-block">{{ translate('These settings control the typography for all (H4)Heading.') }}</span>
    </div>
    <div class="col-xl-8 offset-xl-1">
        <input type="hidden" name="h4_heading_typography_google_link_s" id="h4_heading_typography_google_link_s" value="{{ isset($option_settings['h4_heading_typography_google_link_s']) ? $option_settings['h4_heading_typography_google_link_s']:''}}">

        <input type="hidden" name="h4_heading_typography_css_i" id="h4_heading_typography_css" value="{{ isset($option_settings['h4_heading_typography_css_i']) ? $option_settings['h4_heading_typography_css_i']:''}}">

        <input type="hidden" name="h4_heading_font_unit_i" value="px">
        <div class="row">
            <div class="col-xl-6">
                <div class="form-group">
                    <label>{{ translate('Font Family') }}</label>
                    <select name="h4_heading_font_font-family" class="form-control select font_family" id="h4_heading_font_family" data-section="h4_heading">
                        <option value="" {{ isset($option_settings['h4_heading_font_font-family']) ? '':'selected' }}>{{ translate('Select  Fonts') }}</option>
                        <optgroup label="{{ translate('Custom Fonts') }}">
                            <option value="custom-font-1,sans-serif" {{ isset($option_settings['h4_heading_font_font-family']) && $option_settings['h4_heading_font_font-family'] == 'custom-font-1,sans-serif' ? 'selected':'' }} data-subsets="" data-variations="">{{ translate('Custom Font 1') }}</option>

                            <option value="custom-font-2,sans-serif" {{ isset($option_settings['h4_heading_font_font-family']) && $option_settings['h4_heading_font_font-family'] == 'custom-font-2,sans-serif' ? 'selected':'' }} data-subsets="" data-variations="">{{ translate('Custom Font 2') }}</option>
                        </optgroup>
                        <optgroup label="{{ translate('Google Web Fonts') }}">
                            @foreach ($fonts as $font)
                                <option value="{{ $font['family'].',sans-serif' }}"
                                    {{ isset($option_settings['h4_heading_font_font-family']) && $option_settings['h4_heading_font_font-family'] == $font['family'].',sans-serif' ? 'selected':'' }} 
                                    data-subsets="{{ $font['subsets'] }}" data-variations="{{ $font['variants'] }}">
                                    {{ $font['family'] }}
                                </option>
                            @endforeach
                        </optgroup>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label>{{ translate('Font Weight & Style') }}</label>
                    <input type="hidden" name="h4_heading_font_font-style" id="h4_heading_font_style" value="{{ isset($option_settings['h4_heading_font_font-style']) ? $option_settings['h4_heading_font_font-style']:'' }}">

                    <input type="hidden" name="h4_heading_font_font-weight" id="h4_heading_font_weight" value="{{ isset($option_settings['h4_heading_font_font-weight']) ? $option_settings['h4_heading_font_font-weight']:'' }}">

                    <select name="h4_heading_font_weight_style_i" class="form-control select" id="h4_heading_font_weight_style_i" data-value="{{ isset($option_settings['h4_heading_font_weight_style_i']) ? $option_settings['h4_heading_font_weight_style_i']:null }}" onchange="createUrl('h4_heading')">
                        <option value="" {{ isset($option_settings['h4_heading_font_weight_style_i']) ? '':'selected' }}>{{ translate('Select Weight & Style') }}</option>
                        <option value="400" {{ isset($option_settings['h4_heading_font_weight_style_i']) && $option_settings['h4_heading_font_weight_style_i'] == '400' ? 'selected':'' }}>Normal 400</option>
                        <option value="700" {{ isset($option_settings['h4_heading_font_weight_style_i']) && $option_settings['h4_heading_font_weight_style_i'] == '700' ? 'selected':'' }}>Bold 700</option>
                        <option value="400italic" {{ isset($option_settings['h4_heading_font_weight_style_i']) && $option_settings['h4_heading_font_weight_style_i'] == '400italic' ? 'selected':'' }}>Normal 400 Italic</option>
                        <option value="700italic" {{ isset($option_settings['h4_heading_font_weight_style_i']) && $option_settings['h4_heading_font_weight_style_i'] == '700italic' ? 'selected':'' }}>Bold 700 Italic</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label>{{ translate('Font Subsets') }}</label>
                    <select name="h4_heading_font_font-subsets_i" class="form-control select" id="h4_heading_font_subsets" data-value="{{ isset($option_settings['h4_heading_font_font-subsets_i']) ? $option_settings['h4_heading_font_font-subsets_i']:null }}"  onchange="createUrl('h4_heading')">
                        <option value="" {{ isset($option_settings['h4_heading_font_font-subsets_i']) ? '':'selected' }}>{{ translate('Select Font Subsets') }}</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label>{{ translate('Text Align') }}</label>
                    <select name="h4_heading_font_text-align" class="form-control select" id="h4_heading_text_align" onchange="createFontCss('h4_heading')">
                        <option value="" disabled {{ isset($option_settings['h4_heading_font_text-align']) ? '':'selected' }}>{{ translate('Text Align') }}</option>
                        <option value="inherit" {{ isset($option_settings['h4_heading_font_text-align']) && $option_settings['h4_heading_font_text-align'] == 'inherit' ? 'selected':'' }}>Inherit</option>
                        <option value="left" {{ isset($option_settings['h4_heading_font_text-align']) && $option_settings['h4_heading_font_text-align'] == 'left' ? 'selected':'' }}>Left</option>
                        <option value="right" {{ isset($option_settings['h4_heading_font_text-align']) && $option_settings['h4_heading_font_text-align'] == 'right' ? 'selected':'' }}>Right</option>
                        <option value="center" {{ isset($option_settings['h4_heading_font_text-align']) && $option_settings['h4_heading_font_text-align'] == 'center' ? 'selected':'' }}>Center</option>
                        <option value="justify" {{ isset($option_settings['h4_heading_font_text-align']) && $option_settings['h4_heading_font_text-align'] == 'justify' ? 'selected':'' }}>Justify</option>
                        <option value="initial" {{ isset($option_settings['h4_heading_font_text-align']) && $option_settings['h4_heading_font_text-align'] == 'initial' ? 'selected':'' }}>Initial</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label>{{ translate('Text Transform') }}</label>
                    <select name="h4_heading_font_text-transform" class="form-control select" id="h4_heading_text_transform" onchange="createFontCss('h4_heading')">
                        <option value="" disabled {{ isset($option_settings['h4_heading_font_text-transform']) ? '':'selected' }}>{{ translate('Text Transform') }}</option>
                        <option value="none" {{ isset($option_settings['h4_heading_font_text-transform']) && $option_settings['h4_heading_font_text-transform'] == 'none' ? 'selected':'' }}>None</option>
                        <option value="capitalize" {{ isset($option_settings['h4_heading_font_text-transform']) && $option_settings['h4_heading_font_text-transform'] == 'capitalize' ? 'selected':'' }}>Capitalize</option>
                        <option value="uppercase" {{ isset($option_settings['h4_heading_font_text-transform']) && $option_settings['h4_heading_font_text-transform'] == 'uppercase' ? 'selected':'' }}>Uppercase</option>
                        <option value="lowercase" {{ isset($option_settings['h4_heading_font_text-transform']) && $option_settings['h4_heading_font_text-transform'] == 'lowercase' ? 'selected':'' }}>Lowercase</option>
                        <option value="initial" {{ isset($option_settings['h4_heading_font_text-transform']) && $option_settings['h4_heading_font_text-transform'] == 'initial' ? 'selected':'' }}>Initial</option>
                        <option value="inherit" {{ isset($option_settings['h4_heading_font_text-transform']) && $option_settings['h4_heading_font_text-transform'] == 'inherit' ? 'selected':'' }}>Inherit</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6 row">
                <div class="col-xl-6">
                    <div class="form-group">
                        <label>{{ translate('Font Size') }}</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="h4_heading_font_u_font-size"
                                id="h4_heading_font_size" placeholder="{{ translate('Size') }}" value="{{ isset($option_settings['h4_heading_font_u_font-size']) ? $option_settings['h4_heading_font_u_font-size']:'' }}" onkeyup="createFontCss('h4_heading')">
                            <div class="input-group-append">
                                <div class="input-group-text">px</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="form-group">
                        <label>{{ translate('Line Height') }}</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="h4_heading_font_u_line-height"
                                id="h4_heading_line_height" placeholder="{{ translate('Height') }}" value="{{ isset($option_settings['h4_heading_font_u_line-height']) ? $option_settings['h4_heading_font_u_line-height']:'' }}" onkeyup="createFontCss('h4_heading')">
                            <div class="input-group-append">
                                <div class="input-group-text">px</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 row">
                <div class="col-xl-4">
                    <div class="form-group">
                        <label>{{ translate('Word Spacing') }}</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="h4_heading_font_u_word-spacing"
                                id="h4_heading_word_spacing" placeholder="{{ translate('Word Spacing') }}" value="{{ isset($option_settings['h4_heading_font_u_word-spacing']) ? $option_settings['h4_heading_font_u_word-spacing']:'' }}" onkeyup="createFontCss('h4_heading')">
                            <div class="input-group-append">
                                <div class="input-group-text">px</div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="col-xl-4">
                    <div class="form-group">
                        <label>{{ translate('Letter Spacing') }}</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="h4_heading_font_u_letter-spacing"
                                id="h4_heading_letter_spacing" placeholder="{{ translate('Letter Spacing') }}" value="{{ isset($option_settings['h4_heading_font_u_letter-spacing']) ? $option_settings['h4_heading_font_u_letter-spacing']:'' }}" onkeyup="createFontCss('h4_heading')">
                            <div class="input-group-append">
                                <div class="input-group-text">px</div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="col-xl-4">
                    <label for="h4_heading_font_color">{{ translate('Select Color') }}</label>
                    <div class="color w-100">
                        <input type="text" class="form-control" name="h4_heading_font_color"
                            value="{{ isset($option_settings['h4_heading_font_color']) ? $option_settings['h4_heading_font_color']:'' }}">
                        <input type="color" class="" id="h4_heading_font_color" value="{{ isset($option_settings['h4_heading_font_color']) ? $option_settings['h4_heading_font_color']:'#fafafa' }}" oninput="createFontCss('h4_heading')">
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4 border p-4 typography_preview" id="h4_heading_typography_preview">
            {{ translate('The Quick Brown Fox Jumps Over The Lazy Dog') }}
        </div>
    </div>
</div>
{{-- (H4) Heading Typography Field End --}}

{{-- (H5) Heading Typography Field Start --}}
<div class="form-group row py-4 border-bottom">
    <div class="col-xl-3">
        <label for="" class="font-16 bold black">{{ translate('(H5) Heading Typography') }}
        </label>
        <span class="d-block">{{ translate('These settings control the typography for all (H5)Heading.') }}</span>
    </div>
    <div class="col-xl-8 offset-xl-1">
        <input type="hidden" name="h5_heading_typography_google_link_s" id="h5_heading_typography_google_link_s" value="{{ isset($option_settings['h5_heading_typography_google_link_s']) ? $option_settings['h5_heading_typography_google_link_s']:''}}">

        <input type="hidden" name="h5_heading_typography_css_i" id="h5_heading_typography_css" value="{{ isset($option_settings['h5_heading_typography_css_i']) ? $option_settings['h5_heading_typography_css_i']:''}}">

        <input type="hidden" name="h5_heading_font_unit_i" value="px">
        <div class="row">
            <div class="col-xl-6">
                <div class="form-group">
                    <label>{{ translate('Font Family') }}</label>
                    <select name="h5_heading_font_font-family" class="form-control select font_family" id="h5_heading_font_family" data-section="h5_heading">
                        <option value="" {{ isset($option_settings['h5_heading_font_font-family']) ? '':'selected' }}>{{ translate('Select  Fonts') }}</option>
                        <optgroup label="{{ translate('Custom Fonts') }}">
                            <option value="custom-font-1,sans-serif" {{ isset($option_settings['h5_heading_font_font-family']) && $option_settings['h5_heading_font_font-family'] == 'custom-font-1,sans-serif' ? 'selected':'' }} data-subsets="" data-variations="">{{ translate('Custom Font 1') }}</option>

                            <option value="custom-font-2,sans-serif" {{ isset($option_settings['h5_heading_font_font-family']) && $option_settings['h5_heading_font_font-family'] == 'custom-font-2,sans-serif' ? 'selected':'' }} data-subsets="" data-variations="">{{ translate('Custom Font 2') }}</option>
                        </optgroup>
                        <optgroup label="{{ translate('Google Web Fonts') }}">
                            @foreach ($fonts as $font)
                                <option value="{{ $font['family'].',sans-serif' }}"
                                    {{ isset($option_settings['h5_heading_font_font-family']) && $option_settings['h5_heading_font_font-family'] == $font['family'].',sans-serif' ? 'selected':'' }} 
                                    data-subsets="{{ $font['subsets'] }}" data-variations="{{ $font['variants'] }}">
                                    {{ $font['family'] }}
                                </option>
                            @endforeach
                        </optgroup>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label>{{ translate('Font Weight & Style') }}</label>
                    <input type="hidden" name="h5_heading_font_font-style" id="h5_heading_font_style" value="{{ isset($option_settings['h5_heading_font_font-style']) ? $option_settings['h5_heading_font_font-style']:'' }}">

                    <input type="hidden" name="h5_heading_font_font-weight" id="h5_heading_font_weight" value="{{ isset($option_settings['h5_heading_font_font-weight']) ? $option_settings['h5_heading_font_font-weight']:'' }}">

                    <select name="h5_heading_font_weight_style_i" class="form-control select" id="h5_heading_font_weight_style_i" data-value="{{ isset($option_settings['h5_heading_font_weight_style_i']) ? $option_settings['h5_heading_font_weight_style_i']:null }}" onchange="createUrl('h5_heading')">
                        <option value="" {{ isset($option_settings['h5_heading_font_weight_style_i']) ? '':'selected' }}>{{ translate('Select Weight & Style') }}</option>
                        <option value="400" {{ isset($option_settings['h5_heading_font_weight_style_i']) && $option_settings['h5_heading_font_weight_style_i'] == '400' ? 'selected':'' }}>Normal 400</option>
                        <option value="700" {{ isset($option_settings['h5_heading_font_weight_style_i']) && $option_settings['h5_heading_font_weight_style_i'] == '700' ? 'selected':'' }}>Bold 700</option>
                        <option value="400italic" {{ isset($option_settings['h5_heading_font_weight_style_i']) && $option_settings['h5_heading_font_weight_style_i'] == '400italic' ? 'selected':'' }}>Normal 400 Italic</option>
                        <option value="700italic" {{ isset($option_settings['h5_heading_font_weight_style_i']) && $option_settings['h5_heading_font_weight_style_i'] == '700italic' ? 'selected':'' }}>Bold 700 Italic</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label>{{ translate('Font Subsets') }}</label>
                    <select name="h5_heading_font_font-subsets_i" class="form-control select" id="h5_heading_font_subsets" data-value="{{ isset($option_settings['h5_heading_font_font-subsets_i']) ? $option_settings['h5_heading_font_font-subsets_i']:null }}"  onchange="createUrl('h5_heading')">
                        <option value="" {{ isset($option_settings['h5_heading_font_font-subsets_i']) ? '':'selected' }}>{{ translate('Select Font Subsets') }}</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label>{{ translate('Text Align') }}</label>
                    <select name="h5_heading_font_text-align" class="form-control select" id="h5_heading_text_align" onchange="createFontCss('h5_heading')">
                        <option value="" disabled {{ isset($option_settings['h5_heading_font_text-align']) ? '':'selected' }}>{{ translate('Text Align') }}</option>
                        <option value="inherit" {{ isset($option_settings['h5_heading_font_text-align']) && $option_settings['h5_heading_font_text-align'] == 'inherit' ? 'selected':'' }}>Inherit</option>
                        <option value="left" {{ isset($option_settings['h5_heading_font_text-align']) && $option_settings['h5_heading_font_text-align'] == 'left' ? 'selected':'' }}>Left</option>
                        <option value="right" {{ isset($option_settings['h5_heading_font_text-align']) && $option_settings['h5_heading_font_text-align'] == 'right' ? 'selected':'' }}>Right</option>
                        <option value="center" {{ isset($option_settings['h5_heading_font_text-align']) && $option_settings['h5_heading_font_text-align'] == 'center' ? 'selected':'' }}>Center</option>
                        <option value="justify" {{ isset($option_settings['h5_heading_font_text-align']) && $option_settings['h5_heading_font_text-align'] == 'justify' ? 'selected':'' }}>Justify</option>
                        <option value="initial" {{ isset($option_settings['h5_heading_font_text-align']) && $option_settings['h5_heading_font_text-align'] == 'initial' ? 'selected':'' }}>Initial</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label>{{ translate('Text Transform') }}</label>
                    <select name="h5_heading_font_text-transform" class="form-control select" id="h5_heading_text_transform" onchange="createFontCss('h5_heading')">
                        <option value="" disabled {{ isset($option_settings['h5_heading_font_text-transform']) ? '':'selected' }}>{{ translate('Text Transform') }}</option>
                        <option value="none" {{ isset($option_settings['h5_heading_font_text-transform']) && $option_settings['h5_heading_font_text-transform'] == 'none' ? 'selected':'' }}>None</option>
                        <option value="capitalize" {{ isset($option_settings['h5_heading_font_text-transform']) && $option_settings['h5_heading_font_text-transform'] == 'capitalize' ? 'selected':'' }}>Capitalize</option>
                        <option value="uppercase" {{ isset($option_settings['h5_heading_font_text-transform']) && $option_settings['h5_heading_font_text-transform'] == 'uppercase' ? 'selected':'' }}>Uppercase</option>
                        <option value="lowercase" {{ isset($option_settings['h5_heading_font_text-transform']) && $option_settings['h5_heading_font_text-transform'] == 'lowercase' ? 'selected':'' }}>Lowercase</option>
                        <option value="initial" {{ isset($option_settings['h5_heading_font_text-transform']) && $option_settings['h5_heading_font_text-transform'] == 'initial' ? 'selected':'' }}>Initial</option>
                        <option value="inherit" {{ isset($option_settings['h5_heading_font_text-transform']) && $option_settings['h5_heading_font_text-transform'] == 'inherit' ? 'selected':'' }}>Inherit</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6 row">
                <div class="col-xl-6">
                    <div class="form-group">
                        <label>{{ translate('Font Size') }}</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="h5_heading_font_u_font-size"
                                id="h5_heading_font_size" placeholder="{{ translate('Size') }}" value="{{ isset($option_settings['h5_heading_font_u_font-size']) ? $option_settings['h5_heading_font_u_font-size']:'' }}" onkeyup="createFontCss('h5_heading')">
                            <div class="input-group-append">
                                <div class="input-group-text">px</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="form-group">
                        <label>{{ translate('Line Height') }}</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="h5_heading_font_u_line-height"
                                id="h5_heading_line_height" placeholder="{{ translate('Height') }}" value="{{ isset($option_settings['h5_heading_font_u_line-height']) ? $option_settings['h5_heading_font_u_line-height']:'' }}" onkeyup="createFontCss('h5_heading')">
                            <div class="input-group-append">
                                <div class="input-group-text">px</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 row">
                <div class="col-xl-4">
                    <div class="form-group">
                        <label>{{ translate('Word Spacing') }}</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="h5_heading_font_u_word-spacing"
                                id="h5_heading_word_spacing" placeholder="{{ translate('Word Spacing') }}" value="{{ isset($option_settings['h5_heading_font_u_word-spacing']) ? $option_settings['h5_heading_font_u_word-spacing']:'' }}" onkeyup="createFontCss('h5_heading')">
                            <div class="input-group-append">
                                <div class="input-group-text">px</div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="col-xl-4">
                    <div class="form-group">
                        <label>{{ translate('Letter Spacing') }}</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="h5_heading_font_u_letter-spacing"
                                id="h5_heading_letter_spacing" placeholder="{{ translate('Letter Spacing') }}" value="{{ isset($option_settings['h5_heading_font_u_letter-spacing']) ? $option_settings['h5_heading_font_u_letter-spacing']:'' }}" onkeyup="createFontCss('h5_heading')">
                            <div class="input-group-append">
                                <div class="input-group-text">px</div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="col-xl-4">
                    <label for="h5_heading_font_color">{{ translate('Select Color') }}</label>
                    <div class="color w-100">
                        <input type="text" class="form-control" name="h5_heading_font_color"
                            value="{{ isset($option_settings['h5_heading_font_color']) ? $option_settings['h5_heading_font_color']:'' }}">
                        <input type="color" class="" id="h5_heading_font_color" value="{{ isset($option_settings['h5_heading_font_color']) ? $option_settings['h5_heading_font_color']:'#fafafa' }}" oninput="createFontCss('h5_heading')">
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4 border p-4 typography_preview" id="h5_heading_typography_preview">
            {{ translate('The Quick Brown Fox Jumps Over The Lazy Dog') }}
        </div>
    </div>
</div>
{{-- (H5) Heading Typography Field End --}}

{{-- (H6) Heading Typography Field Start --}}
<div class="form-group row py-4 border-bottom">
    <div class="col-xl-3">
        <label for="" class="font-16 bold black">{{ translate('(H6) Heading Typography') }}
        </label>
        <span class="d-block">{{ translate('These settings control the typography for all (H6)Heading.') }}</span>
    </div>
    <div class="col-xl-8 offset-xl-1">
        <input type="hidden" name="h6_heading_typography_google_link_s" id="h6_heading_typography_google_link_s" value="{{ isset($option_settings['h6_heading_typography_google_link_s']) ? $option_settings['h6_heading_typography_google_link_s']:''}}">

        <input type="hidden" name="h6_heading_typography_css_i" id="h6_heading_typography_css" value="{{ isset($option_settings['h6_heading_typography_css_i']) ? $option_settings['h6_heading_typography_css_i']:''}}">

        <input type="hidden" name="h6_heading_font_unit_i" value="px">
        <div class="row">
            <div class="col-xl-6">
                <div class="form-group">
                    <label>{{ translate('Font Family') }}</label>
                    <select name="h6_heading_font_font-family" class="form-control select font_family" id="h6_heading_font_family" data-section="h6_heading">
                        <option value="" {{ isset($option_settings['h6_heading_font_font-family']) ? '':'selected' }}>{{ translate('Select  Fonts') }}</option>
                        <optgroup label="{{ translate('Custom Fonts') }}">
                            <option value="custom-font-1,sans-serif" {{ isset($option_settings['h6_heading_font_font-family']) && $option_settings['h6_heading_font_font-family'] == 'custom-font-1,sans-serif' ? 'selected':'' }} data-subsets="" data-variations="">{{ translate('Custom Font 1') }}</option>

                            <option value="custom-font-2,sans-serif" {{ isset($option_settings['h6_heading_font_font-family']) && $option_settings['h6_heading_font_font-family'] == 'custom-font-2,sans-serif' ? 'selected':'' }} data-subsets="" data-variations="">{{ translate('Custom Font 2') }}</option>
                        </optgroup>
                        <optgroup label="{{ translate('Google Web Fonts') }}">
                            @foreach ($fonts as $font)
                                <option value="{{ $font['family'].',sans-serif' }}"
                                    {{ isset($option_settings['h6_heading_font_font-family']) && $option_settings['h6_heading_font_font-family'] == $font['family'].',sans-serif' ? 'selected':'' }} 
                                    data-subsets="{{ $font['subsets'] }}" data-variations="{{ $font['variants'] }}">
                                    {{ $font['family'] }}
                                </option>
                            @endforeach
                        </optgroup>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label>{{ translate('Font Weight & Style') }}</label>
                    <input type="hidden" name="h6_heading_font_font-style" id="h6_heading_font_style" value="{{ isset($option_settings['h6_heading_font_font-style']) ? $option_settings['h6_heading_font_font-style']:'' }}">

                    <input type="hidden" name="h6_heading_font_font-weight" id="h6_heading_font_weight" value="{{ isset($option_settings['h6_heading_font_font-weight']) ? $option_settings['h6_heading_font_font-weight']:'' }}">

                    <select name="h6_heading_font_weight_style_i" class="form-control select" id="h6_heading_font_weight_style_i" data-value="{{ isset($option_settings['h6_heading_font_weight_style_i']) ? $option_settings['h6_heading_font_weight_style_i']:null }}" onchange="createUrl('h6_heading')">
                        <option value="" {{ isset($option_settings['h6_heading_font_weight_style_i']) ? '':'selected' }}>{{ translate('Select Weight & Style') }}</option>
                        <option value="400" {{ isset($option_settings['h6_heading_font_weight_style_i']) && $option_settings['h6_heading_font_weight_style_i'] == '400' ? 'selected':'' }}>Normal 400</option>
                        <option value="700" {{ isset($option_settings['h6_heading_font_weight_style_i']) && $option_settings['h6_heading_font_weight_style_i'] == '700' ? 'selected':'' }}>Bold 700</option>
                        <option value="400italic" {{ isset($option_settings['h6_heading_font_weight_style_i']) && $option_settings['h6_heading_font_weight_style_i'] == '400italic' ? 'selected':'' }}>Normal 400 Italic</option>
                        <option value="700italic" {{ isset($option_settings['h6_heading_font_weight_style_i']) && $option_settings['h6_heading_font_weight_style_i'] == '700italic' ? 'selected':'' }}>Bold 700 Italic</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label>{{ translate('Font Subsets') }}</label>
                    <select name="h6_heading_font_font-subsets_i" class="form-control select" id="h6_heading_font_subsets" data-value="{{ isset($option_settings['h6_heading_font_font-subsets_i']) ? $option_settings['h6_heading_font_font-subsets_i']:null }}"  onchange="createUrl('h6_heading')">
                        <option value="" {{ isset($option_settings['h6_heading_font_font-subsets_i']) ? '':'selected' }}>{{ translate('Select Font Subsets') }}</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label>{{ translate('Text Align') }}</label>
                    <select name="h6_heading_font_text-align" class="form-control select" id="h6_heading_text_align" onchange="createFontCss('h6_heading')">
                        <option value="" disabled {{ isset($option_settings['h6_heading_font_text-align']) ? '':'selected' }}>{{ translate('Text Align') }}</option>
                        <option value="inherit" {{ isset($option_settings['h6_heading_font_text-align']) && $option_settings['h6_heading_font_text-align'] == 'inherit' ? 'selected':'' }}>Inherit</option>
                        <option value="left" {{ isset($option_settings['h6_heading_font_text-align']) && $option_settings['h6_heading_font_text-align'] == 'left' ? 'selected':'' }}>Left</option>
                        <option value="right" {{ isset($option_settings['h6_heading_font_text-align']) && $option_settings['h6_heading_font_text-align'] == 'right' ? 'selected':'' }}>Right</option>
                        <option value="center" {{ isset($option_settings['h6_heading_font_text-align']) && $option_settings['h6_heading_font_text-align'] == 'center' ? 'selected':'' }}>Center</option>
                        <option value="justify" {{ isset($option_settings['h6_heading_font_text-align']) && $option_settings['h6_heading_font_text-align'] == 'justify' ? 'selected':'' }}>Justify</option>
                        <option value="initial" {{ isset($option_settings['h6_heading_font_text-align']) && $option_settings['h6_heading_font_text-align'] == 'initial' ? 'selected':'' }}>Initial</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label>{{ translate('Text Transform') }}</label>
                    <select name="h6_heading_font_text-transform" class="form-control select" id="h6_heading_text_transform" onchange="createFontCss('h6_heading')">
                        <option value="" disabled {{ isset($option_settings['h6_heading_font_text-transform']) ? '':'selected' }}>{{ translate('Text Transform') }}</option>
                        <option value="none" {{ isset($option_settings['h6_heading_font_text-transform']) && $option_settings['h6_heading_font_text-transform'] == 'none' ? 'selected':'' }}>None</option>
                        <option value="capitalize" {{ isset($option_settings['h6_heading_font_text-transform']) && $option_settings['h6_heading_font_text-transform'] == 'capitalize' ? 'selected':'' }}>Capitalize</option>
                        <option value="uppercase" {{ isset($option_settings['h6_heading_font_text-transform']) && $option_settings['h6_heading_font_text-transform'] == 'uppercase' ? 'selected':'' }}>Uppercase</option>
                        <option value="lowercase" {{ isset($option_settings['h6_heading_font_text-transform']) && $option_settings['h6_heading_font_text-transform'] == 'lowercase' ? 'selected':'' }}>Lowercase</option>
                        <option value="initial" {{ isset($option_settings['h6_heading_font_text-transform']) && $option_settings['h6_heading_font_text-transform'] == 'initial' ? 'selected':'' }}>Initial</option>
                        <option value="inherit" {{ isset($option_settings['h6_heading_font_text-transform']) && $option_settings['h6_heading_font_text-transform'] == 'inherit' ? 'selected':'' }}>Inherit</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6 row">
                <div class="col-xl-6">
                    <div class="form-group">
                        <label>{{ translate('Font Size') }}</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="h6_heading_font_u_font-size"
                                id="h6_heading_font_size" placeholder="{{ translate('Size') }}" value="{{ isset($option_settings['h6_heading_font_u_font-size']) ? $option_settings['h6_heading_font_u_font-size']:'' }}" onkeyup="createFontCss('h6_heading')">
                            <div class="input-group-append">
                                <div class="input-group-text">px</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="form-group">
                        <label>{{ translate('Line Height') }}</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="h6_heading_font_u_line-height"
                                id="h6_heading_line_height" placeholder="{{ translate('Height') }}" value="{{ isset($option_settings['h6_heading_font_u_line-height']) ? $option_settings['h6_heading_font_u_line-height']:'' }}" onkeyup="createFontCss('h6_heading')">
                            <div class="input-group-append">
                                <div class="input-group-text">px</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 row">
                <div class="col-xl-4">
                    <div class="form-group">
                        <label>{{ translate('Word Spacing') }}</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="h6_heading_font_u_word-spacing"
                                id="h6_heading_word_spacing" placeholder="{{ translate('Word Spacing') }}" value="{{ isset($option_settings['h6_heading_font_u_word-spacing']) ? $option_settings['h6_heading_font_u_word-spacing']:'' }}" onkeyup="createFontCss('h6_heading')">
                            <div class="input-group-append">
                                <div class="input-group-text">px</div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="col-xl-4">
                    <div class="form-group">
                        <label>{{ translate('Letter Spacing') }}</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="h6_heading_font_u_letter-spacing"
                                id="h6_heading_letter_spacing" placeholder="{{ translate('Letter Spacing') }}" value="{{ isset($option_settings['h6_heading_font_u_letter-spacing']) ? $option_settings['h6_heading_font_u_letter-spacing']:'' }}" onkeyup="createFontCss('h6_heading')">
                            <div class="input-group-append">
                                <div class="input-group-text">px</div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="col-xl-4">
                    <label for="h6_heading_font_color">{{ translate('Select Color') }}</label>
                    <div class="color w-100">
                        <input type="text" class="form-control" name="h6_heading_font_color"
                            value="{{ isset($option_settings['h6_heading_font_color']) ? $option_settings['h6_heading_font_color']:'' }}">
                        <input type="color" class="" id="h6_heading_font_color" value="{{ isset($option_settings['h6_heading_font_color']) ? $option_settings['h6_heading_font_color']:'#fafafa' }}" oninput="createFontCss('h6_heading')">
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4 border p-4 typography_preview" id="h6_heading_typography_preview">
            {{ translate('The Quick Brown Fox Jumps Over The Lazy Dog') }}
        </div>
    </div>
</div>
{{-- (H6) Heading Typography Field End --}}