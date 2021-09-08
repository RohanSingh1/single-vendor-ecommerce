<div class="app-sidebar sidebar-shadow {{$sidebarColor??''}}">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                        data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">Dashboards</li>
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="{{ active(['admin/dashboard'], 'mm-active') }}">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Dashboard
                    </a>
                </li>
                @can('isAdmin')
                <li class="app-sidebar__heading">Components</li>
                    <li>
                        <a href="{{ route('admin.products.index') }}"
                           class="{{ active(['admin/products*'], 'mm-active') }}">
                            <i class="metismenu-icon pe-7s-radio"></i>
                            Products
                            <i class="metismenu-state-icon "></i>
                        </a>
                    </li>
                    {{-- <li>
                        <a href="{{ route('admin.brand.index') }}" class="{{ active(['admin/brand*'], 'mm-active') }}">
                            <i class="metismenu-icon pe-7s-helm"></i>
                            Brands
                            <i class="metismenu-state-icon "></i>
                        </a>
                    </li> --}}

                    <li>
                        <a href="{{ route('admin.category.index') }}"
                           class="{{ active(['admin/category*'], 'mm-active') }}">
                            <i class="metismenu-icon pe-7s-radio"></i>
                            Category
                            <i class="metismenu-state-joy "></i>
                        </a>
                    </li>
                <li>
                    <a href="{{ route('admin.sliders.index') }}"
                       class="{{ active(['admin/cms/slider*'], 'mm-active') }}">
                        <i class="metismenu-icon pe-7s-network"></i>
                        Slider
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.deals.index') }}"
                       class="{{ active(['admin/deals*'], 'mm-active') }}">
                        <i class="metismenu-icon pe-7s-network"></i>
                        Deals
                        <i class="metismenu-state-icon "></i>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.orders.index') }}"
                       class="{{ active(['admin/orders*'], 'mm-active') }}">
                        <i class="metismenu-icon pe-7s-network"></i>
                        Orders From Cart
                        <i class="metismenu-state-icon "></i>
                    </a>
                </li>

                {{--  <li>
                    <a href="{{ route('admin.customerFeedback.index') }}"
                       class="{{ active(['admin/customerFeedback*'], 'mm-active') }}">
                        <i class="metismenu-icon pe-7s-network"></i>
                        Customer Feedbacks
                        <i class="metismenu-state-icon "></i>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.customerReviews.index') }}"
                       class="{{ active(['admin/customerReviews*'], 'mm-active') }}">
                        <i class="metismenu-icon pe-7s-network"></i>
                        Customer Reviews
                        <i class="metismenu-state-icon "></i>
                    </a>
                </li>  --}}




                {{--  <li>
                    <a href="{{ route('admin.pages.index') }}"
                       class="{{ active(['admin/cms/pages*'], 'mm-active') }}">
                        <i class="metismenu-icon pe-7s-network"></i>
                        Pages
                    </a>
                </li>  --}}

                <li>
                    <a href="{{ route('admin.content-management.menus.index') }}"
                       class="{{ active(['admin/cms/menus*'], 'mm-active') }}">
                       <i class="metismenu-icon pe-7s-network"></i>
                        Menus
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.newsletters.index') }}"
                       class="{{ active(['admin/cms/newsletters*'], 'mm-active') }}">
                        <i class="metismenu-icon pe-7s-network"></i>
                        Newsletters
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.faq.index') }}"
                       class="{{ active(['admin/cms/faq*'], 'mm-active') }}">
                        <i class="metismenu-icon pe-7s-network"></i>
                        Faq
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.users') }}"
                       class="{{ active(['admin/users*'], 'mm-active') }}">
                        <i class="metismenu-icon pe-7s-network"></i>
                        Delivery Boys
                        <i class="metismenu-state-icon "></i>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.delivery_name.index') }}"
                       class="{{ active(['admin/delivery_name*'], 'mm-active') }}">
                        <i class="metismenu-icon pe-7s-network"></i>
                        Delivery Status
                        <i class="metismenu-state-icon "></i>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.content-management.settings.index') }}"
                       class="{{ active(['admin/cms/settings*'], 'mm-active') }}">
                        <i class="metismenu-icon pe-7s-network"></i>
                        Settings
                    </a>
                </li>

                @else

                <li>
                    <a href="{{ route('admin.orders.index') }}"
                       class="{{ active(['admin/orders*'], 'mm-active') }}">
                        <i class="metismenu-icon pe-7s-network"></i>
                        Orders
                        <i class="metismenu-state-icon "></i>
                    </a>
                </li>

                @endcan

            </ul>
        </div>
    </div>
</div>
