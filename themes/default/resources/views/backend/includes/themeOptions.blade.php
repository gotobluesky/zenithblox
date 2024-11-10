{{-- Theme Option Navbar --}}
@canany(['Manage Theme General settings', 'Manage Home Page Builder', 'Manage Widget'])
    <li
        class="{{ Request::routeIs(['theme.default.options', 'theme.default.widgets', 'theme.default.homePageSections', 'theme.default.homePageSection.new', 'theme.default.homePageSection.edit']) ? 'active sub-menu-opened' : '' }}">
        <a href="#">
            <i class="icofont-ui-theme"></i>
            <span class="link-title">{{ translate('Site Options') }}</span>
        </a>
        <ul class="nav sub-menu">
            @can('Manage Theme General settings')
                <li class="{{ Request::routeIs(['theme.default.options']) ? 'active ' : '' }}">
                    <a href="{{ route('theme.default.options') }}">{{ translate('General Settings') }}</a>
                </li>
            @endcan

            @can('Manage Home Page Builder')
                <li
                    class="{{ Request::routeIs(['theme.default.homePageSections', 'theme.default.homePageSection.new', 'theme.default.homePageSection.edit']) ? 'active ' : '' }}">
                    <a href="{{ route('theme.default.homePageSections') }}">{{ translate('Home Page Builder') }}</a>
                </li>
            @endcan

            @can('Manage Widget')
                <li class="{{ Request::routeIs('theme.default.widgets') ? 'active ' : '' }}">
                    <a href="{{ route('theme.default.widgets') }}">{{ translate('Widgets') }}</a>
                </li>
            @endcan
        </ul>
    </li>
@endcanany
