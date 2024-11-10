 {{-- Back To Top Header --}}
 <h3 class="black mb-3">{{ translate('Home Page') }}</h3>
 <input type="hidden" name="option_name" value="home_page">
  
  
  {{-- Back To Top Button Hover Background Color Field Start --}}
     <div class="form-group row py-3 border-bottom">
         <div class="col-xl-4">
             <label class="font-16 bold black">{{ translate('Home Page Layout') }}
             </label>
             <span class="d-block">{{ translate('Choose home page layout from here. If you use this option then you will able to change three type of layout ( Default Right Sidebar Layout ).') }}</span>
         </div>
         <div class="col-xl-6 offset-xl-1 row" id="homepage_layout_image_field">
            <div class="col-4">
                <div class="input-group">
                    <input type="radio" class="d-none"
                        {{ isset($option_settings['homepage_layout']) && $option_settings['homepage_layout'] == 'full_layout' ? 'checked' : '' }}
                        name="homepage_layout" id="full_layout" value="full_layout">
                    <label for="full_layout">
                        <img src="{{ asset('themes/default/public/assets/images/layout/no-sideber.png') }}"
                            title="no sidebar" alt="no sidebar" class="layout_img">
                    </label>
                </div>
            </div>
            <div class="col-4">
                <div class="input-group">
                    <input type="radio"
                        {{ isset($option_settings['homepage_layout']) && $option_settings['homepage_layout'] == 'left_sidebar_layout' ? 'checked' : '' }}
                        class="d-none" name="homepage_layout" id="left_sidebar_layout" value="left_sidebar_layout">
                    <label for="left_sidebar_layout">
                        <img src="{{ asset('themes/default/public/assets/images/layout/left-sideber.png') }}"
                            title="left sidebar layout" alt="left sidebar layout" class="layout_img">
                    </label>
                </div>
            </div>
            <div class="col-4">
                <div class="input-group">
                    <input type="radio"
                        {{ isset($option_settings['homepage_layout']) && $option_settings['homepage_layout'] == 'right_sidebar_layout' ? 'checked' : '' }}
                        class="d-none" name="homepage_layout" id="right_sidebar_layout" value="right_sidebar_layout">
                    <label for="right_sidebar_layout">
                        <img src="{{ asset('themes/default/public/assets/images/layout/right-sideber.png') }}"
                            title="right sidebar layout" alt="right sidebar layout" class="layout_img">
                    </label>
                </div>
            </div>
        </div>
     </div>
     {{-- Back To Top Button Hover Background Color Field End --}}