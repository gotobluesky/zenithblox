@extends('core::base.layouts.master')
@section('title')
    {{ translate('Frontend Translations') }}
@endsection
@section('custom_css')
    <style>
        td.key{
            width: 50%;
        }
    </style>
@endsection
@section('main_content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-30">
                <div class="card-body border-bottom2">
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <h4 class="font-20 mb-2">{{ $language->native_name }}</h4>
                        <div class="d-flex flex-wrap">
                            <form action="{{ route('core.language.frontend.translations', ['lang' => $language->id]) }}"
                                method="GET">
                                <input name="search_key"
                                    value="{{ request()->has('search_key') ? request()->get('search_key') : null }}"
                                    class="theme-input-style" placeholder="Type Search Key & Enter ">
                            </form>
                            @if (request()->has('search_key'))
                                <a class="btn btn-danger long mb-auto ml-10"
                                    href="{{ route('core.language.frontend.translations', ['lang' => $language->id]) }}">{{ translate('Clear Filter') }}</a>
                            @endif
                        </div>
                    </div>
                </div>
                <form class="form-horizontal" action="{{ route('core.language.frontend.translations.update') }}"
                    method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $language->id }}">
                    <input type="hidden" name="theme" value="{{ $theme }}">
                    <div class="table-responsive">
                        <table class="dh-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ translate('Key') }}</th>
                                    <th>{{ translate('Value') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lang_keys as $key => $translation)
                                    <tr>
                                        <td>{{ $key + 1 + ($lang_keys->currentPage() - 1) * $lang_keys->perPage() }}
                                        </td>
                                        <td class="key" style="width:45%">{{ $translation->lang_value }}</td>
                                        <td style="width:45%">
                                            <input type="text" class="form-control value"
                                                name="values[{{ $translation->lang_key }}]"
                                                @if (($traslate_lang = \Core\Models\ThemeTranslations::where('lang', $language->code)->where('theme', $theme)->where('lang_key', $translation->lang_key)->latest()->first()) != null) value="{{ $traslate_lang->lang_value }}" @endif>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="text-right">
                            <div class="col-12">
                                <button type="submit" class="btn long">{{ translate('Save Changes') }}</button>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="col-12">
                                {{ $lang_keys->onEachSide(1)->appends(request()->input())->links('pagination::bootstrap-5-custom') }}
                            </div>
                        </div>
                    </div>
            </div>
            </form>
        </div>
    </div>
    </div>
@endsection
@section('custom_scripts')
@endsection
