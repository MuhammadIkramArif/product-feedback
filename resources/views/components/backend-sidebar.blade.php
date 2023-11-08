<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="">
                <img src="{{ asset('assets/images/logo.svg') }}" class="w-100" alt="logo">
                </a></li>

        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li>
                <hr>
            </li>
            @role('superuser')
            <li class="nav-item {{ Request::is('admin/users/*') ? 'active' : '' }} {{ Request::is('admin/users') ? 'active' : '' }}">
                <a href="{{ route('users.index') }}">
                    <i class="fa fa-users"></i>
                    <span class="menu-title">Users</span>
                </a>
            </li><li class="nav-item {{ Request::is('admin/categories/*') ? 'active' : '' }} {{ Request::is('admin/categories') ? 'active' : '' }}">
                <a href="{{ route('categories.index') }}">
                    <i class="fa fa-list-alt"></i>
                    <span class="menu-title">Categories</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('admin/products/*') ? 'active' : '' }} {{ Request::is('admin/products') ? 'active' : '' }}">
                <a href="{{ route('products.index') }}">
                    <i class="feather icon-package"></i>
                    <span class="menu-title">Products</span>
                </a>
            </li>
            @endrole
            @role('customer')
            <li class="nav-item {{ Request::is('admin/products/*') ? 'active' : '' }} {{ Request::is('admin/products') ? 'active' : '' }}">
                <a href="{{ route('products.index') }}">
                    <i class="feather icon-package"></i>
                    <span class="menu-title">Products</span>
                </a>
            </li>
            @endrole

            <li class=" nav-item"><a href=""><i
                        class="feather icon-log-out"></i><span class="menu-title">Logout</span></a>
            </li>

        </ul>
    </div>
</div>
