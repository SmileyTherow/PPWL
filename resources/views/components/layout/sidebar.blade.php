<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
                <!-- SVG omitted for brevity (keep your existing SVG) -->
                <svg width="25" viewBox="0 0 25 42" version="1.1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink">
                    <!-- ... -->
                </svg>
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">Sneat</span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto dblock d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>
    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item active">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Pages</span>
        </li>

        <!-- Product Menu -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
                <div data-i18n="Authentications">Product</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <!-- Admin should go to admin product index -->
                            <a href="{{ route('admin.products.index') }}" class="menu-link">
                                <div data-i18n="Basic">Daftar produk</div>
                            </a>
                        @else
                            <!-- Regular users go to public product index -->
                            <a href="{{ route('products.index') }}" class="menu-link">
                                <div data-i18n="Basic">Daftar produk</div>
                            </a>
                        @endif
                    @else
                        <a href="{{ route('products.index') }}" class="menu-link">
                            <div data-i18n="Basic">Daftar produk</div>
                        </a>
                    @endauth
                </li>

                <!-- 'Tambah produk' only visible & linked for admin -->
                @auth
                    @if(auth()->user()->role === 'admin')
                        <li class="menu-item">
                            <a href="{{ route('admin.products.create') }}" class="menu-link">
                                <div data-i18n="Basic">Tambah produk</div>
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>
        </li>

        <!-- Category Menu -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Kategori">Kategori</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.category.index') }}" class="menu-link">
                                <div data-i18n="Account">Daftar kategori</div>
                            </a>
                        @else
                            <a href="{{ route('category.index') }}" class="menu-link">
                                <div data-i18n="Account">Daftar kategori</div>
                            </a>
                        @endif
                    @else
                        <a href="{{ route('category.index') }}" class="menu-link">
                            <div data-i18n="Account">Daftar kategori</div>
                        </a>
                    @endauth
                </li>

                @auth
                    @if(auth()->user()->role === 'admin')
                        <li class="menu-item">
                            <a href="{{ route('admin.category.create') }}" class="menu-link">
                                <div data-i18n="Notifications">Tambah kategori</div>
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>
        </li>

    </ul>
</aside>
