@php
    $adsense_list = null;
    if(isset( $option_settings['adsense_list']) && $option_settings['adsense_list'] != ''){
        $adsense_list = json_decode($option_settings['adsense_list']); 
    }
@endphp
{{-- Google Adsense Header --}}
<h3 class="black mb-3">{{ translate('Google Adsense') }}</h3>
<input type="hidden" name="option_name" value="google_adsense">

{{-- Google Adsense Field Start --}}
<div class="form-group row py-4 border-bottom">
    <div class="col-xl-12">
        <label for="footer_text" class="font-16 bold black">{{ translate('Adsense List') }}
        </label>
        <span class="d-block">{{ translate('Add new addsense.') }}</span>
    </div>
    <div class="col-xl-12 mt-5">
        <div id="addsenseAccordion">
            {{-- if adsense list is empty a default slide will be here --}}
            @if (isset($adsense_list))
                @foreach ($adsense_list as $adsense_item)
                    <div class="accordion-item my-2">
                        <h2 class="accordion-header py-3" id="headingOne">
                            <button class="accordion-button  bg-transparent">
                                {{ $adsense_item->adsense_title == '' ? translate('New Slide') : $adsense_item->adsense_title }}
                            </button>
                        </h2>
                        <div class="accordion-body row">
                            <div class="col-xl-12">
                                <input type="hidden" name="adsense_index[]" value="{{ $adsense_item->adsense_index }}" class="index_num">
                                <input type="text" name="adsense_title[]" class="form-control adsense_title my-3"
                                    placeholder="{{ translate('Title') }}" value="{{ $adsense_item->adsense_title }}">

                                <textarea name="adsense_code[]" class="theme-input-style style--seven" placeholder="{{ translate('Code') }}">{{ $adsense_item->adsense_code }}</textarea>
                            </div>
                            <div class="col-xl-12 offset-xl-10">
                                <button type="button"
                                    class="btn btn-danger accordion-delete sm mt-2">{{ translate('Delete') }}</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="accordion-item my-2">
                    <h2 class="accordion-header py-3" id="headingOne">
                        <button class="accordion-button  bg-transparent">
                            {{ translate('New Adsense') }}
                        </button>
                    </h2>
                    <div class="accordion-body row">
                        <div class="col-xl-12">
                            <input type="hidden" name="adsense_index[]" value="1" class="index_num">
                            <input type="text" name="adsense_title[]" class="form-control adsense_title my-3"
                                placeholder="{{ translate('Title') }}">

                            <textarea name="adsense_code[]" class="theme-input-style style--seven" placeholder="{{ translate('Code') }}"></textarea>
                        </div>
                        <div class="col-xl-12 offset-xl-10">
                            <button type="button"
                                class="btn btn-danger accordion-delete sm mt-2">{{ translate('Delete') }}</button>
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
{{-- Google Adsense Field Start --}}

