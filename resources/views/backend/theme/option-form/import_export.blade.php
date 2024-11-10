<input type="hidden" name="option_name" value="import_export">

{{-- Import Field Start --}}
<div class="form-group row py-3 border-bottom">
    <div class="col-xl-12">
        <label for="page_404_title_s" class="font-16 bold black mb-4">{{ translate('Import Options Json') }}
        </label>
    </div>
    <div class="col-xl-12">
        <form action="{{ route('theme.default.theme-option.import') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="d-block mb-3">
                <button type="button" class="btn sm btn-info"
                    id="import_from_clipboard">{{ translate('Import From Clipboard') }}</button>
                <label for="file_upload_theme_options" class="import_option_file">
                    <span class="btn sm btn-info">{{ translate('Uploade File') }}</span>
                </label>
                <input type="file" class="d-none" name="theme_options_file" id="file_upload_theme_options"
                    accept="application/json">
                <span class="file-name"></span>
            </div>
            <div class="my-3 d-none hide" id="import_area">
                <span class="black">{{ translate('Paste your clipboard data here.') }}</span>
                <textarea class="theme-input-style style--seven" name="import_text" id="import_text"></textarea>
            </div>
            <button type="submit" class="btn sm btn-primary" id="import-btn">{{ translate('Import') }}</button>
            <span
                class="text-danger ml-2">{{ translate('WARNING! This will overwrite all existing option values, please proceed with caution!') }}</span>

        </form>

    </div>
</div>
{{-- Import Field End --}}


{{-- Export Field Start --}}
<div class="form-group row py-3 border-bottom">
    <div class="col-xl-12">
        <label for="page_404_title_s" class="font-16 bold black mb-4">{{ translate('Export Options Json') }}
        </label>
        <span
            class="d-block mb-2">{{ translate('Here you can copy/download your current option settings. Keep this safe as you can use it as a backup should anything go wrong, or you can use it to restore your settings on this site (or any other site).') }}</span>
    </div>
    <div class="col-xl-12">
        <button type="button" class="btn sm btn-info" onclick="themeOptionCopyToClipboard(this)"
            data-export="{{ getJsonThemeOption() }}">{{ translate('Copy to Clipboard') }}</button>
        <a href="{{ route('theme.default.theme-option.download') }}"
            class="btn sm btn-primary">{{ translate('Export File') }}</a>
    </div>
</div>
{{-- Export Field End --}}
