@extends('core::base.layouts.master')

@section('title')
    {{ translate('Open AI Settings') }}
@endsection

@section('custom_css')
@endsection

@section('main_content')
    <!-- Main Content -->
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="card mb-30">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <h4 class="font-20">{{ translate('Setup Open AI Settings') }}</h4>
                    </div>
                    <form class="form-horizontal my-5" action="{{ route('core.blog.update.ai.setting') }}" method="post">
                        @csrf

                        {{-- OpenAI Model --}}
                        <div class="form-row mb-4">
                            <label for="name"
                                class="col-sm-4 font-14 bold black">{{ translate('Default OpenAI Model') }} <span
                                    class="text-danger">*</span>
                            </label>
                            <div class="col-sm-8">
                                <select name="default_model" class="form-control" required>
                                    <option value="text-davinci-003" @selected($ai_settings->default_model == 'text-davinci-003')>Davinci GPT-3</option>
                                    <option value="text-babbage-001" @selected($ai_settings->default_model == 'text-babbage-001')>Babbage GPT-3</option>
                                    <option value="text-curie-001" @selected($ai_settings->default_model == 'text-curie-001')>Curie GPT-3</option>
                                    <option value="text-ada-001" @selected($ai_settings->default_model == 'text-ada-001')>Ada GPT-3</option>
                                </select>
                                @if ($errors->has('default_model'))
                                    <p class="text-danger">{{ $errors->first('default_model') }}</p>
                                @endif
                            </div>
                        </div>
                        {{-- OpenAI Model --}}

                        <!---Secret Key---->
                        <div class="form-row mb-4">
                            <div class="col-sm-4">
                                <label class="font-14 bold black" for="api_key">{{ translate('OpenAI Secret Key') }} <span
                                        class="text-danger">*</span></label>
                            </div>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" name="api_key" id="api_key"
                                    placeholder="{{ translate('Enter Secret Key') }}" required value="{{ $ai_settings->api_key }}">
                                @if ($errors->has('api_key'))
                                    <p class="text-danger">{{ $errors->first('api_key') }}</p>
                                @endif
                            </div>
                        </div>
                        <!---Secret Key---->

                        <div class="form-group row">
                            <div class="offset-sm-4 col-sm-8">
                                <button type="submit" class="btn long">{{ translate('Save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
