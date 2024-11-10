<nav class="sidebar" data-trigger="scrollbar">
    <!-- Sidebar Header -->
    <div class="sidebar-header d-none d-lg-block">
        <!-- Sidebar Toggle Pin Button -->
        <div class="sidebar-toogle-pin">
            <i class="icofont-tack-pin"></i>
        </div>
        <!-- End Sidebar Toggle Pin Button -->
    </div>
    <!-- End Sidebar Header -->
    <!-- Sidebar Body -->
    <div class="sidebar-body">
        <!-- Nav -->
        <ul class="nav">
            @if (auth()->user()->can('Manage Dashboard'))
                <li class="{{ Request::routeIs('admin.dashboard') ? 'active ' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="icofont-dashboard"></i>
                        <span class="link-title">{{ translate('Dashboard') }}</span>
                    </a>
                </li>
            @endif

            @if (auth()->user()->can('Manage Media'))
                <!--Media Module-->
                <li class="{{ Request::routeIs(['core.media.page']) ? 'active ' : '' }}">
                    <a href="{{ route('core.media.page') }}">
                        <i class="icofont-multimedia"></i>
                        <span class="link-title">{{ translate('Media') }}</span>
                    </a>

                </li>
                <!--End Media module-->
            @endif

            <!-- Blog & Page Start-->
            <!--Blog Module-->
            @canany(['Show Blog', 'Create Blog', 'Manage Category', 'Manage Tag', 'Manage Comment'])
                <li
                    class="{{ Request::routeIs(['core.blog.category', 'core.add.blog.category', 'core.edit.blog.category', 'core.blog', 'core.add.blog', 'core.edit.blog', 'core.tag', 'core.edit.tag', 'core.add.tag', 'core.blog.comment', 'core.blog.comment.edit', 'core.blog.comment.setting', 'core.blog.ai.setting', 'core.blog.share.options']) ? 'active sub-menu-opened' : '' }}">
                    <a href="#">
                        <i class="icofont-blogger"></i>
                        <span class="link-title">{{ translate('Blog') }}</span>
                    </a>
                    <ul class="nav sub-menu">
                        @can('Show Blog')
                            <li class="{{ Request::routeIs(['core.blog', 'core.edit.blog']) ? 'active ' : '' }}">
                                <a href="{{ route('core.blog') }}">{{ translate('All Blogs') }}</a>
                            </li>
                        @endcan
                        @can('Create Blog')
                            <li class="{{ Request::routeIs('core.add.blog') ? 'active ' : '' }}">
                                <a href="{{ route('core.add.blog') }}">{{ translate('Add New Blog') }}</a>
                            </li>
                        @endcan
                        @can('Manage Category')
                            <li
                                class="{{ Request::routeIs(['core.blog.category', 'core.add.blog.category', 'core.edit.blog.category']) ? 'active ' : '' }}">
                                <a href="{{ route('core.blog.category') }}">{{ translate('Categories') }}</a>
                            </li>
                        @endcan
                        @can('Manage Tag')
                            <li class="{{ Request::routeIs(['core.tag', 'core.add.tag', 'core.edit.tag']) ? 'active ' : '' }}">
                                <a href="{{ route('core.tag') }}">{{ translate('Tags') }}</a>
                            </li>
                        @endcan
                        @can('Manage Comment')
                            <li
                                class="{{ Request::routeIs(['core.blog.comment', 'core.blog.comment.edit']) ? 'active ' : '' }}">
                                <a href="{{ route('core.blog.comment') }}">{{ translate('Comments') }}</a>
                            </li>
                            <li
                                class="{{ Request::routeIs(['core.blog.comment.setting', 'core.blog.ai.setting', 'core.blog.share.options']) ? 'active sub-menu-opened' : '' }}">
                                <a href="#">
                                    <span class="link-title">{{ translate('Settings') }}</span>
                                </a>
                                <ul class="nav sub-menu">
                                    <li class="{{ Request::routeIs(['core.blog.share.options']) ? 'active' : '' }}">
                                        <a
                                            href="{{ route('core.blog.share.options') }}">{{ translate('Blog Share Settings') }}</a>
                                    </li>
                                    <li class="{{ Request::routeIs(['core.blog.ai.setting']) ? 'active' : '' }}">
                                        <a href="{{ route('core.blog.ai.setting') }}">{{ translate('Open AI Settings') }}</a>
                                    </li>
                                    <li class="{{ Request::routeIs(['core.blog.comment.setting']) ? 'active' : '' }}">
                                        <a
                                            href="{{ route('core.blog.comment.setting') }}">{{ translate('Comment Settings') }}</a>
                                    </li>
                                </ul>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcanany
            <!--End Blog module-->

            <!--Page Module-->
            @canany(['Show Page', 'Create Page'])
                <li
                    class="{{ Request::routeIs(['core.page', 'core.page.add', 'core.page.edit']) ? 'active sub-menu-opened' : '' }}">
                    <a href="#">
                        <i class="icofont-page"></i>
                        <span class="link-title">{{ translate('Pages') }}</span>
                    </a>
                    <ul class="nav sub-menu">
                        @can('Show Page')
                            <li class="{{ Request::routeIs(['core.page', 'core.page.edit']) ? 'active ' : '' }}">
                                <a href="{{ route('core.page') }}">{{ translate('All Pages') }}</a>
                            </li>
                        @endcan
                        @can('Create Page')
                            <li class="{{ Request::routeIs('core.page.add') ? 'active ' : '' }}">
                                <a href="{{ route('core.page.add') }}">{{ translate('Add New Page') }}</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcanany
            <!--End Blog module-->
            <!-- Blog & Page End -->

            <!--Plugings nabvar options-->
            
            {{-- @foreach (pluginsNavbar() as $item)
                @includeIf($item)
            @endforeach --}}
            <!--End Plugings nabvar options-->

            <!--Appearances Modules-->
            @if (auth()->user()->can('Manage Themes') ||
                    auth()->user()->can('Manage Menus'))
                <li
                    class="{{ Request::routeIs(['core.themes.index', 'core.manage.menus']) ? 'active sub-menu-opened' : '' }}">
                    <a href="#">
                        <i class="icofont-brand-designfloat"></i>
                        <span class="link-title">{{ translate('Appearances') }}</span>
                    </a>
                    <ul class="nav sub-menu">
                        {{-- @if (auth()->user()->can('Manage Themes'))
                            <li class="{{ Request::routeIs(['core.themes.index']) ? 'active ' : '' }}">
                                <a href="{{ route('core.themes.index') }}">{{ translate('Themes') }}</a>
                            </li>
                        @endif --}}
                        @if (auth()->user()->can('Manage Menus'))
                            <li class="{{ Request::routeIs(['core.manage.menus']) ? 'active ' : '' }}">
                                <a href="{{ route('core.manage.menus') }}">{{ translate('Menus') }}</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            <!--End Appearances Modules-->

            <!--Theme otions-->
            @includeIf(getActiveThemeOptions())
            <!--End Theme options-->

            

            @if (auth()->user()->can('Manage General Settings') ||
                    auth()->user()->can('Manage Email Settings') ||
                    auth()->user()->can('Manage Email Templates') ||
                    auth()->user()->can('Manage Language') ||
                    auth()->user()->can('Manage Media Settings') ||
                    auth()->user()->can('Manage Seo Settings'))
                <!--Settings Modules-->
                <li
                    class="{{ Request::routeIs(['core.seo.settings', 'core.email.smtp.configuration', 'core.language.frontend.translations', 'core.image.settings', 'core.email.templates', 'core.language.edit', 'core.language.key.values', 'core.languages', 'core.language.new', 'core.image.settings', 'core.social.media.login.settings', 'core.general.settings']) ? 'active sub-menu-opened' : '' }}">
                    <a href="#">
                        <i class="icofont-settings-alt"></i>
                        <span class="link-title">{{ translate('Settings') }}</span>
                    </a>
                    <ul class="nav sub-menu">
                        @if (auth()->user()->can('Manage General Settings'))
                            <li class="{{ Request::routeIs(['core.general.settings']) ? 'active ' : '' }}">
                                <a href="{{ route('core.general.settings') }}">{{ translate('General settings') }}</a>
                            </li>
                        @endif

                        @if (auth()->user()->can('Manage Email Settings'))
                            <li class="{{ Request::routeIs(['core.email.smtp.configuration']) ? 'active ' : '' }}">
                                <a
                                    href="{{ route('core.email.smtp.configuration') }}">{{ translate('Email settings') }}</a>
                            </li>
                        @endif

                        @if (auth()->user()->can('Manage Email Templates'))
                            <li class="{{ Request::routeIs(['core.email.templates']) ? 'active ' : '' }}">
                                <a href="{{ route('core.email.templates') }}">{{ translate('Email Templates') }}</a>
                            </li>
                        @endif

                        @if (auth()->user()->can('Manage Language'))
                            <li
                                class="{{ Request::routeIs(['core.language.edit', 'core.language.key.values', 'core.languages', 'core.language.new']) ? 'active ' : '' }}">
                                <a href="{{ route('core.languages') }}">{{ translate('Languages') }}</a>
                            </li>
                        @endif

                        @if (auth()->user()->can('Manage Media Settings'))
                            <li class="{{ Request::routeIs(['core.image.settings']) ? 'active ' : '' }}">
                                <a href="{{ route('core.image.settings') }}">{{ translate('Media settings') }}</a>
                            </li>
                        @endif

                        @if (auth()->user()->can('Manage Seo Settings'))
                            <li class="{{ Request::routeIs(['core.seo.settings']) ? 'active ' : '' }}">
                                <a href="{{ route('core.seo.settings') }}">{{ translate('SEO settings') }}</a>
                            </li>
                        @endif

                        <li class="{{ Request::routeIs(['core.admin.sitemap']) ? 'active ' : '' }}">
                            <a href="{{ route('core.admin.sitemap') }}">{{ translate('Generate Sitemap') }}</a>
                        </li>
                    </ul>
                </li>
                <!--End Settings Modules-->
            @endif

            <!--Users Module-->
            @if (auth()->user()->can('Show User') ||
                    auth()->user()->can('Show Role') ||
                    auth()->user()->can('Show Permission'))
                <li
                    class="{{ Request::routeIs(['core.roles', 'core.permissions', 'core.users', 'core.add.user', 'core.edit.user']) ? 'active sub-menu-opened' : '' }}">
                    <a href="#">
                        <i class="icofont-users-social"></i>
                        <span class="link-title">{{ translate('Users') }}</span>
                    </a>
                    <ul class="nav sub-menu">
                        @if (auth()->user()->can('Show User'))
                            <li
                                class="{{ Request::routeIs(['core.users', 'core.add.user', 'core.edit.user']) ? 'active ' : '' }}">
                                <a href="{{ route('core.users') }}">{{ translate('Users') }}</a>
                            </li>
                        @endif

                        @if (auth()->user()->can('Show Role'))
                            <li class="{{ Request::routeIs(['core.roles']) ? 'active ' : '' }}"><a
                                    href="{{ route('core.roles') }}">{{ translate('Roles') }}</a></li>
                        @endif

                        @if (auth()->user()->can('Show Permission'))
                            <li class="{{ Request::routeIs(['core.permissions']) ? 'active ' : '' }}">
                                <a href="{{ route('core.permissions') }}">{{ translate('Permissions') }}</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            <!--End users-->

            <!--Activity Logs Module-->
            @if (auth()->user()->can('Manage Login activity'))
                <li
                    class="{{ Request::routeIs(['core.activity.logs', 'core.get.login.activity']) ? 'active sub-menu-opened' : '' }}">
                    <a href="#">
                        <i class="icofont-ui-password"></i>
                        <span class="link-title">{{ translate('Activity Logs') }}</span>
                    </a>
                    <ul class="nav sub-menu">
                        <li class="{{ Request::routeIs(['core.get.login.activity']) ? 'active ' : '' }}">
                            <a href="{{ route('core.get.login.activity') }}">{{ translate('Login activity') }}</a>
                        </li>
                    </ul>
                </li>
            @endif
            <!--Activity Logs Settings Module-->

        </ul>
        <!-- End Nav -->
    </div>
    <!-- End Sidebar Body -->
</nav>
