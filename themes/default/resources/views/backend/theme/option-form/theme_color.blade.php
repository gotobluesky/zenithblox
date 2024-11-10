 {{-- Back To Top Header --}}
<h3 class="black mb-3">{{ translate('Theme Color') }}</h3>
<input type="hidden" name="option_name" value="theme_color">
 
 
 {{-- Back To Top Button Hover Background Color Field Start --}}
    <div class="form-group row py-3 border-bottom">
        <div class="col-xl-4">
            <label class="font-16 bold black">{{ translate('Theme Primary Color') }}
            </label>
            <span class="d-block">{{ translate('Set theme primary color') }}</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <div class="row ml-2">
                <div class="color justify-content-between">
                    <input type="text" class="form-control" name="theme_primary_color" 
                    value="{{ isset($option_settings['theme_primary_color']) ? $option_settings['theme_primary_color'] : '' }}">
                    
                    <input type="color" class="" id="theme_primary_color"
                        value="{{ isset($option_settings['theme_primary_color']) ? $option_settings['theme_primary_color'] : '#fafafa' }}">
                        
                    <label for="theme_primary_color">{{ translate('Select Color') }}</label>
                </div>
            </div>
        </div>
    </div>
    {{-- Back To Top Button Hover Background Color Field End --}}