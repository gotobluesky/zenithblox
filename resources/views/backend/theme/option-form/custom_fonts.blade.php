{{-- Custom Fonts --}}
<h3 class="black mb-3">{{ translate('Custom Fonts') }}</h3>
<input type="hidden" name="option_name" value="custom_fonts">
<span
    class="d-block">{{ translate('After uploading your fonts, you should select font family (custom-font-1/custom-font-2 from dropdown list in (Body/Paragraph/Headings/Menu/Blog) Typography section.') }}</span>

{{-- Custom Font (1) Field Start --}}
<div class="form-group row py-4 border-bottom">
    <div class="col-xl-4">
        <label for="" class="font-16 bold black">{{ translate('Custom Font1') }}
        </label>
        <span class="d-block">{{ translate('Please Enable this option to use Custom Font 1.') }}</span>
    </div>
    <div class="col-xl-6 offset-xl-1">
        <label class="switch success">
            <input type="hidden" name="custom_font_1" value="0">
            <input type="checkbox"
                {{ isset($option_settings['custom_font_1']) && $option_settings['custom_font_1'] == 1 ? 'checked' : '' }}
                name="custom_font_1" id="custom_font_1" value="1">
            <span class="control" id="custom_font_1_switch">
                <span class="switch-off">{{ translate('Disable') }}</span>
                <span class="switch-on">{{ translate('Enable') }}</span>
            </span>
        </label>
    </div>
</div>
{{-- Custom Font (1) Field End --}}

{{-- Custom Font (1) Enable/Switch on Field Start --}}
<div id="custom_font_1_switch_on_field">
    {{-- Custom Font 1 woff --}}
    <div class="form-group row py-3 border-bottom">
        <div class="col-xl-4">
            <label for="" class="font-16 bold black">{{ translate('Custom font 1 .woff') }}
            </label>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <input type="hidden" class="custom_font_files" name="custom_font_1_woff" value="{{ isset($option_settings['custom_font_1_woff']) ? $option_settings['custom_font_1_woff'] : '' }}">
            <input type="text" class="form-control mb-3 file_name" readonly>
            <input type="file" class="d-none font_file_upload" name="custom_font_1_woff_file" id="custom_font_1_woff" accept=".woff, .ttf, .eot">

            <label for="custom_font_1_woff" >
                <span class="btn sm btn-info">{{ translate('Uploade File') }}</span>
            </label>
            <button type="button" class="d-none btn sm btn-danger remove_file_name">{{ translate('Remove') }}</button>
        </div>
    </div>

    {{-- Custom Font 1 ttf --}}
    <div class="form-group row py-2 border-bottom">
        <div class="col-xl-4">
            <label for="" class="font-16 bold black">{{ translate('Custom font 1 .ttf') }}
            </label>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <input type="hidden" class="custom_font_files" name="custom_font_1_ttf" value="{{ isset($option_settings['custom_font_1_ttf']) ? $option_settings['custom_font_1_ttf'] : '' }}">
            <input type="text" class="form-control mb-3 file_name" readonly>
            <input type="file" class="d-none font_file_upload" name="custom_font_1_ttf_file" id="custom_font_1_ttf" accept=".woff, .ttf, .eot">
            <label for="custom_font_1_ttf" >
                <span class="btn sm btn-info">{{ translate('Uploade File') }}</span>
            </label>
            <button type="button" class="d-none btn sm btn-danger remove_file_name">{{ translate('Remove') }}</button>
        </div>
    </div>

    {{-- Custom Font 1 eot --}}
    <div class="form-group row py-2 border-bottom">
        <div class="col-xl-4">
            <label for="" class="font-16 bold black">{{ translate('Custom font 1 .eot') }}
            </label>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <input type="hidden" class="custom_font_files" name="custom_font_1_eot" value="{{ isset($option_settings['custom_font_1_eot']) ? $option_settings['custom_font_1_eot'] : '' }}">
            <input type="text" class="form-control mb-3 file_name" readonly>
            <input type="file" class="d-none font_file_upload" name="custom_font_1_eot_file" id="custom_font_1_eot" accept=".woff, .ttf, .eot">
            <label for="custom_font_1_eot" >
                <span class="btn sm btn-info">{{ translate('Uploade File') }}</span>
            </label>
            <button type="button" class="d-none btn sm btn-danger remove_file_name">{{ translate('Remove') }}</button>
        </div>
    </div>
</div>
{{-- Custom Font (1) Enable/Switch on Field End --}}

{{-- Custom Font (2) Field Start --}}
<div class="form-group row py-4 border-bottom">
    <div class="col-xl-4">
        <label for="" class="font-16 bold black">{{ translate('Custom Font2') }}
        </label>
        <span class="d-block">{{ translate('Please Enable this option to use Custom Font 2.') }}</span>
    </div>
    <div class="col-xl-6 offset-xl-1">
        <label class="switch success">
            <input type="hidden" name="custom_font_2" value="0">
            <input type="checkbox"
                {{ isset($option_settings['custom_font_2']) && $option_settings['custom_font_2'] == 1 ? 'checked' : '' }}
                name="custom_font_2" id="custom_font_2" value="1">
            <span class="control" id="custom_font_2_switch">
                <span class="switch-off">{{ translate('Disable') }}</span>
                <span class="switch-on">{{ translate('Enable') }}</span>
            </span>
        </label>
    </div>
</div>
{{-- Custom Font (2) Field End --}}

{{-- Custom Font (1) Enable/Switch on Field Start --}}
<div id="custom_font_2_switch_on_field">
    {{-- Custom Font 2 woff --}}
    <div class="form-group row py-2 border-bottom">
        <div class="col-xl-4">
            <label for="" class="font-16 bold black">{{ translate('Custom font 2 .woff') }}
            </label>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <input type="hidden" class="custom_font_files" name="custom_font_2_woff" value="{{ isset($option_settings['custom_font_2_woff']) ? $option_settings['custom_font_2_woff'] : '' }}">
            <input type="text" class="form-control mb-3 file_name" readonly>
            <input type="file" class="d-none font_file_upload" name="custom_font_2_woff_file" id="custom_font_2_woff" accept=".woff, .ttf, .eot">
            <label for="custom_font_2_woff" >
                <span class="btn sm btn-info">{{ translate('Uploade File') }}</span>
            </label>
            <button type="button" class="d-none btn sm btn-danger remove_file_name">{{ translate('Remove') }}</button>
        </div>
    </div>

    {{-- Custom Font 2 ttf --}}
    <div class="form-group row py-2 border-bottom">
        <div class="col-xl-4">
            <label for="" class="font-16 bold black">{{ translate('Custom font 2 .ttf') }}
            </label>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <input type="hidden" class="custom_font_files" name="custom_font_2_ttf" value="{{ isset($option_settings['custom_font_2_ttf']) ? $option_settings['custom_font_2_ttf'] : '' }}">
            <input type="text" class="form-control mb-3 file_name" readonly>
            <input type="file" class="d-none font_file_upload" name="custom_font_2_ttf_file" id="custom_font_2_ttf" accept=".woff, .ttf, .eot">
            <label for="custom_font_2_ttf" >
                <span class="btn sm btn-info">{{ translate('Uploade File') }}</span>
            </label>
            <button type="button" class="d-none btn sm btn-danger remove_file_name">{{ translate('Remove') }}</button>
        </div>
    </div>

    {{-- Custom Font 2 eot --}}
    <div class="form-group row py-2 border-bottom">
        <div class="col-xl-4">
            <label for="" class="font-16 bold black">{{ translate('Custom font 2 .eot') }}
            </label>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <input type="hidden" class="custom_font_files" name="custom_font_2_eot" value="{{ isset($option_settings['custom_font_2_eot']) ? $option_settings['custom_font_2_eot'] : '' }}">
            <input type="text" class="form-control mb-3 file_name" readonly>
            <input type="file" class="d-none font_file_upload" name="custom_font_2_eot_file" id="custom_font_2_eot" accept=".woff, .ttf, .eot">
            <label for="custom_font_2_eot" >
                <span class="btn sm btn-info">{{ translate('Uploade File') }}</span>
            </label>
            <button type="button" class="d-none btn sm btn-danger remove_file_name">{{ translate('Remove') }}</button>
        </div>
    </div>
</div>
{{-- Custom Font (1) Enable/Switch on Field End --}}
