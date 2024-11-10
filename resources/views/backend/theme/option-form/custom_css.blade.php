{{-- Custom Css Header --}}
<h3 class="black mb-3">{{ translate('Custom Css') }}</h3>
<input type="hidden" name="option_name" value="custom_css">

{{-- Custom Css Field Start --}}
<div class="form-group row py-4 border-bottom">
    <div class="col-xl-2">
        <label for="footer_text" class="font-16 bold black">{{ translate('CSS Code') }}
        </label>
        <span class="d-block">{{ translate('Paste your CSS code here.') }}</span>
    </div>
    <div class="col-xl-9 offset-xl-1">
        <textarea class="d-none" name="custom_css_code" id="custom_css_code"></textarea>
        <div class="mx-4 mt-2" id="custom_css_code_editor">{{ isset($option_settings['custom_css_code']) ? $option_settings['custom_css_code'] : '' }}</div>
    </div>
</div>
{{-- Custom Css Field End --}}
