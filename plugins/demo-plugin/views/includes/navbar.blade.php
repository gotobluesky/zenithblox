<li class="{{ Request::routeIs(['plugin.demo-plugin.index']) ? 'active sub-menu-opened' : '' }}">
    <a href="#">
        <i class="icofont-wallet"></i>
        <span class="link-title">{{ translate('Demo Plugin') }}</span><span
            class="badge badge-danger ml-2">{{ translate('Addon') }}</span>
    </a>
    <ul class="nav sub-menu">
        @include('plugin/demo-plugin::includes.submenu.submenu')
    </ul>
</li>
