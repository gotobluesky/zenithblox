<li class="{{ Request::routeIs(['plugin.demo-plugin.index']) ? 'active ' : '' }}">
    <a href="{{ route('plugin.demo-plugin.index') }}">{{ translate('Demo Plugin') }}<span
            class="badge badge-danger ml-2">{{ translate('Adoon') }}</span></a>
</li>
