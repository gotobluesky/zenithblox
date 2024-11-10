@php
    $socials = null;
    if(isset( $option_settings['social_field']) && $option_settings['social_field'] != ''){
        $socials = json_decode($option_settings['social_field']);
    }
@endphp
{{-- Social Header --}}
<h3 class="black mb-3">{{ translate('Social') }}</h3>
<input type="hidden" name="option_name" value="social">

{{-- Social Profile Links Field Start --}}
<div class="form-group row py-4 border-bottom">
    <div class="col-xl-2">
        <label for="footer_text" class="font-16 bold black">{{ translate('Social Profile Links') }}
        </label>
        <span class="d-block">{{ translate('Add social icon and url.') }}</span>
    </div>
    <div class="col-xl-9 offset-xl-1">
        <div id="socialAccordion">
            {{-- if Social is empty a default slide will be here --}}
            @if (isset($socials))
                @foreach ($socials as $social)
                    <div class="accordion-item my-2">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button  bg-transparent">
                                {{ $social->social_icon_title == '' ? translate('New Slide'):$social->social_icon_title }}
                            </button>
                        </h2>
                        <div class="accordion-body row">
                            <div class="col-xl-12">
                                <input type="text" name="social_icon_title[]" class="form-control icon_title my-3"
                                    placeholder="{{ translate('Title') }}" value="{{ $social->social_icon_title }}">

                                <input type="text" name="social_icon[]" class="form-control icon-picker my-3"
                                    placeholder="{{ translate('Icon(example: fa fa-facebook)') }}" value="{{ $social->social_icon }}">

                                <input type="text" name="social_icon_url[]" class="form-control my-3"
                                    placeholder="{{ translate('Url') }}" value="{{ $social->social_icon_url }}">
                            </div>
                            <div class="col-xl-12 offset-xl-10">
                                <button type="button"
                                    class="btn btn-danger accordion-delete sm">{{ translate('Delete') }}</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="accordion-item my-2">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button  bg-transparent">
                            {{ translate('New Slide') }}
                        </button>
                    </h2>
                    <div class="accordion-body row">
                        <div class="col-xl-12">
                            <input type="text" name="social_icon_title[]" class="form-control icon_title my-3"
                                placeholder="{{ translate('Title') }}">

                            <input type="text" name="social_icon[]" class="form-control icon-picker my-3"
                                placeholder="{{ translate('Icon(example: fa fa-facebook)') }}">

                            <input type="text" name="social_icon_url[]" class="form-control my-3"
                                placeholder="{{ translate('Url') }}">
                        </div>
                        <div class="col-xl-12 offset-xl-10">
                            <button type="button"
                                class="btn btn-danger accordion-delete sm">{{ translate('Delete') }}</button>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="row justify-content-end mr-2 mt-4">
            <button type="button" id="addSlide" class="btn btn-dark sm">{{ translate('Add Slide') }}</button>
        </div>
    </div>
</div>
{{-- Social Profile Links Field Start --}}

