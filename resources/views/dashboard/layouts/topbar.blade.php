<div id="nav" class="nav-container d-flex">
    <div class="nav-content d-flex">
        <div class="logo position-relative">
            @auth
            @if(Route::has('dashboard.index'))
            <a href="{{ route('dashboard.index') }}" class="logo-link">
                <div class="img"></div>
            </a>
            @endif
            @else
            @if(Route::has('home.index'))
            <a href="{{ route('home.index') }}">
                <div class="img"></div>
            </a>
            @endif
            @endauth
        </div>

        <!-- User Menu Start -->
        @auth
        <div class="user-container d-flex">
            <a href="#" class="d-flex user position-relative" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="profile" <img src="{{ asset(auth()->user()->gambar ?: 'default.png') }}" alt="profile" />
                <div class="name">
                    <div class="name">{{ auth()->user()->name }}</div>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end user-menu wide">
                <div class="row mb-1 ms-0 me-0">
                    <div class="col-6 pe-1 ps-1">
                        <ul class="list-unstyled">
                            <li>
                                <a href="{{ route('settings.profile') }}">
                                    <i data-acorn-icon="gear" class="me-2" data-acorn-size="17"></i>
                                    <span class="align-middle">Settings</span>
                                </a>
                            </li>
                            <li>
                                <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i data-acorn-icon="logout" class="me-2" data-acorn-size="17"></i>
                                    <span class="align-middle">Logout</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="user-container d-flex">
            <a href="{{ route('auth.login') }}" class="btn btn-outline-light px-4 py-2">
                Login
            </a>
        </div>
        @endauth
        <!-- User Menu End -->

        <!-- Menu Start -->
        <div class="menu-container flex-grow-1">
            <ul id="menu" class="menu">
                @auth
                @if(Route::has('dashboard.index'))
                <li>
                    <a href="{{ route('dashboard.index') }}">
                        <i data-acorn-icon="home" class="icon" data-acorn-size="18"></i>
                        <span class="label">Dashboard</span>
                    </a>
                </li>
                @endif
                @else
                @if(Route::has('home.index'))
                <li>
                    <a href="{{ route('home.index') }}">
                        <i data-acorn-icon="home" class="icon" data-acorn-size="18"></i>
                        <span class="label">Home</span>
                    </a>
                </li>
                @endif
                @endauth
                @auth
                <li>
                    <a href="#data-item" data-bs-toggle="collapse" class="dropdown-toggle">
                        <i data-acorn-icon="list" class="icon" data-acorn-size="18"></i>
                        <span class="label">Data Item</span>
                    </a>
                    <ul id="data-item" class="collapse">
                        <li><a href="{{ route('dashboard.dataMakanan.index') }}"><span class="label">Makanan</span></a></li>
                        <li><a href="{{ route('dashboard.dataDaurUlang.index') }}"><span class="label">Daur Ulang</span></a></li>
                    </ul>
                </li>
                @endauth
                <li>
                    <a href="#menu-katalog" data-bs-toggle="collapse" class="dropdown-toggle">
                        <i data-acorn-icon="layout-2" class="icon" data-acorn-size="18"></i>
                        <span class="label">Katalog</span>
                    </a>
                    <ul id="menu-katalog" class="collapse">
                        <li><a href="{{ route('katalog.katalogMakanan.index') }}"><span class="label">Makanan</span></a></li>
                        <li><a href="{{ route('katalog.katalogDaurUlang.index') }}"><span class="label">Daur Ulang</span></a></li>
                    </ul>
                </li>
                <!-- Jika user belum login -->
                @guest
                <li>
                    <a href="{{ route('home.kampanye') }}">
                        <i data-acorn-icon="menu-bookmark" class="icon" data-acorn-size="18"></i>
                        <span class="label">Kampanye</span>
                    </a>
                </li>
                @endguest

                <!-- Jika user sudah login -->
                @auth
                <li>
                    <a href="#menu-kampanye" data-bs-toggle="collapse" class="dropdown-toggle">
                        <i data-acorn-icon="menu-bookmark" class="icon" data-acorn-size="18"></i>
                        <span class="label">Kampanye</span>
                    </a>
                    <ul id="menu-kampanye" class="collapse">
                        <li><a href="{{ route('dashboard.kampanye.index') }}"><span class="label">Kampanye</span></a></li>
                        <li><a href="{{ route('dashboard.agenda.index') }}"><span class="label">Agenda</span></a></li>
                        <li><a href="{{ route('dashboard.artikel.index') }}"><span class="label">Artikel</span></a></li>
                    </ul>
                </li>
                @endauth

                @auth
                <li>
                    <a href="{{route ('dashboard.chat.index')}}">
                        <i data-acorn-icon="message" class="icon" data-acorn-size="18"></i>
                        <span class="label">Riwayat Pesan</span>
                    </a>
                </li>
                @endauth

                <li>
                    <a href="{{route ('home.tentangKami')}}">
                        <i data-acorn-icon="support" class="icon" data-acorn-size="18"></i>
                        <span class="label">Tentang Kami</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Menu End -->

        <!-- Mobile Buttons Start -->
        <div class="mobile-buttons-container">
            <a href="#" id="scrollSpyButton" class="spy-button" data-bs-toggle="dropdown">
                <i data-acorn-icon="menu-dropdown"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-end" id="scrollSpyDropdown"></div>
            <a href="#" id="mobileMenuButton" class="menu-button">
                <i data-acorn-icon="menu"></i>
            </a>
        </div>
        <!-- Mobile Buttons End -->
    </div>
    <div class="nav-shadow"></div>
</div>