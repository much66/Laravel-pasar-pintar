<div class="l-navbar" id="nav-bar">
    @can('view-pedagang')
        <nav class="nav" style="overflow-y: auto;">
            <div>
                <div class="mx-auto px-4">
                    <div class="header_toggle text-white"> <i class='bx bx-menu' id="header-toggle"></i> </div>
                </div>
                <div class="nav_list mt-3" style="width: calc(100% + 20px);">
                    <a href="/seller" class="nav_link {{ Request::is('seller') ? 'active' : '' }}">
                        <i class="fa-solid fa-house"></i><span class="nav_name">Beranda</span></a>

                    <a href="/dashboard" class="nav_link {{ Request::is('dashboard') ? 'active' : '' }}">
                        <i class="fa-solid fa-cart-shopping"></i><span class="nav_name">Belanja</span></a>

                    <a href="/ide_menu" class="nav_link {{ Request::is('ide_menu*') ? 'active' : '' }}">
                        <i class="fa-solid fa-utensils nav_icon"></i> <span class="nav_name">Ide Menu</span> </a>

                    <a class="dropdown-btn nav_link {{ Request::is('produk') ? 'active' : '' }}"> <i
                            class="fa-solid fa-store nav_icon"></i> <span>Produk <i class="fa fa-caret-down"></i></span></a>
                    <div class="dropdown-container" style="display: none;">
                        <a class="nav_link {{ Request::is('produk/products/create') ? 'active' : '' }}"
                            href="/produk/products/create"><i class="fa-solid fa-plus nav_icon"></i>Tambah
                            Produk</a>
                        <a class="nav_link {{ Request::is('produk/products') ? 'active' : '' }}" href="/produk/products"><i
                                class="fa-solid fa-list nav_icon"></i>List Produk</a>
                    </div>

                    <a href="/keranjang" class="nav_link {{ Request::is('keranjang*') ? 'active' : '' }}">
                        <i class="fa-solid fa-basket-shopping nav_icon"></i> <span class="nav_name">Keranjang</span> </a>

                    <a class="dropdown-btn nav_link {{ Request::is('pesanan') ? 'active' : '' }}"> <i
                            class="fa-solid fa-scroll nav_icon"></i> <span>Pesanan <i
                                class="fa fa-caret-down"></i></span></a>
                    <div class="dropdown-container" style="display: none;">
                        <a href="/pesanan_seller" class="nav_link {{ Request::is('pesanan_seller') ? 'active' : '' }}">
                            <i class="fa-solid fa-scroll"></i> <span class="nav_name">Pesanan Toko</span> </a>

                        <a href="/pesanan" class="nav_link {{ Request::is('pesanan') ? 'active' : '' }}">
                            <i class="fa-solid fa-bag-shopping nav_icon"></i> <span class="nav_name">Pesanan Anda</span>
                        </a>
                    </div>
                    <a href="/resep/recipes" class="nav_link ms-1 {{ Request::is('resep/posts*') ? 'active' : '' }}">
                        <i class="fa-solid fa-receipt nav_icon"></i> <span class="nav_name ms-1">Resep Anda</span> </a>

                    <a href="/profile" class="nav_link {{ Request::is('profile') ? 'active' : '' }} mt-3">
                        <img @if (auth()->user()->image) src="{{ asset('storage/' . auth()->user()->image) }}"
                        @else
                        src="/img/guest.jpg" @endif
                            alt="" style="width: 28px;" class="rounded-circle"> <span class="nav_name">@auth
                                {{ auth()->user()->name }}
                            @else
                                Guest
                            @endauth
                        </span> </a>
                    <div style="margin-top:80px">
                        <form action="/logout" method="post">
                            @csrf
                            <button class="nav_link border-0 bg-transparent"> <i class='bx bx-log-out nav_icon'></i> <span
                                    class="nav_name">SignOut</span> </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
    @else
        <nav class="nav">
            <div>
                <div class="mx-auto ps-4" style="width: calc(100% + 20px);">
                    <div class="header_toggle text-white"> <i class='bx bx-menu' id="header-toggle"></i> </div>
                </div>
                <div class="nav_list mt-3">
                    <a href="/dashboard" class="nav_link {{ Request::is('dashboard*') ? 'active' : '' }}">
                        <i class="fa-solid fa-cart-shopping"></i><span class="nav_name">Belanja</span></a>

                    <a href="/ide_menu" class="nav_link {{ Request::is('ide_menu*') ? 'active' : '' }}">
                        <i class="fa-solid fa-utensils nav_icon"></i> <span class="nav_name">Ide Menu</span> </a>

                    <a href="/keranjang" class="nav_link {{ Request::is('keranjang*') ? 'active' : '' }}">
                        <i class="fa-solid fa-basket-shopping nav_icon"></i> <span class="nav_name">Keranjang</span> </a>

                    <a href="/pesanan" class="nav_link {{ Request::is('pesanan*') ? 'active' : '' }}">
                        <i class="fa-solid fa-bag-shopping  nav_icon"></i> <span class="nav_name">Pesanan</span> </a>
                    @auth
                        <a href="/resep/recipes" class="nav_link ms-1 {{ Request::is('resep/posts*') ? 'active' : '' }}">
                            <i class="fa-solid fa-receipt nav_icon"></i> <span class="nav_name ms-1">Resep Anda</span> </a>
                    @endauth
                    <a href="/profile" class="nav_link mt-5 {{ Request::is('profile') ? 'active' : '' }}">
                        <img @auth @if (auth()->user()->image) src="{{ asset('storage/' . auth()->user()->image) }}"
                        @else
                        src="/img/guest.jpg" @endif
                        @else
                        src="/img/guest.jpg" @endauth
                            alt="" style="width: 28px;" class="rounded-circle"> <span class="nav_name">
                            @auth
                                {{ auth()->user()->name }}
                            @else
                                Guest
                            @endauth
                        </span> </a>
                </div>
            </div>
            @auth
                <form action="/logout" method="post">
                    @csrf
                    <button class="nav_link border-0 bg-transparent"> <i class='bx bx-log-out nav_icon'></i> <span
                            class="nav_name">SignOut</span> </button>
                </form>
            @else
                <a href="/login" class="nav_link"> <i class='bx bx-log-in nav_icon'></i> <span
                        class="nav_name">Login</span>
                </a>
            @endauth
        </nav>
    @endcan
</div>
