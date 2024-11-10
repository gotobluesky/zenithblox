@php
    $share_icons = Core\Models\BlogShareOption::where('status', config('settings.general_status.active'))
        ->get()
        ->toArray();
@endphp
<h4 class="d-inline">{{ front_translate('Share') }} :</h4>
@foreach ($share_icons as $value)
    @isset($blog_shares[$value['network']])
        <a href="{{ $blog_shares[$value['network']] }}" class="m-2" target="_blank"
            title="{{ $value['network_name'] }}">{!! $value['icon'] !!}</a>
    @endisset
@endforeach
