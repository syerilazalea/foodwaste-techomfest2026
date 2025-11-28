<div id="nav" class="nav-container d-flex">
            <div class="nav-content d-flex">
                <div class="logo position-relative">
                    <a href="{{route ('dashboard.penyedia')}}" class="logo-link">
                        <div class="img"></div>
                    </a>
                </div>
                <!-- User Menu Start -->
                <div class="user-container d-flex">
                    <a href="#" class="d-flex user position-relative" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <img class="profile" alt="profile" src="{{asset ('img/profile/profile-9.webp')}}" />
                        <div class="name">User Penyedia</div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end user-menu wide">
                        <div class="row mb-1 ms-0 me-0">
                            <div class="col-6 pe-1 ps-1">
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="#">
                                            <i data-acorn-icon="gear" class="me-2" data-acorn-size="17"></i>
                                            <span class="align-middle">Settings</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i data-acorn-icon="logout" class="me-2" data-acorn-size="17"></i>
                                            <span class="align-middle">Logout</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Icons Menu Start -->
                <ul class="list-unstyled list-inline text-center menu-icons">
                    <li class="list-inline-item">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#searchPagesModal">
                            <i data-acorn-icon="search" data-acorn-size="18"></i>
                        </a>
                    </li>
                    <!-- <li class="list-inline-item">
              <a href="#" id="colorButton">
                <i data-acorn-icon="light-on" class="light" data-acorn-size="18"></i>
                <i data-acorn-icon="light-off" class="dark" data-acorn-size="18"></i>
              </a>
            </li> -->
                </ul>
                <!-- Icons Menu End -->

                <!-- Menu Start -->
                <div class="menu-container flex-grow-1">
                    <ul id="menu" class="menu">

                        <li>
                            <a href="{{route ('dashboard.penyedia')}}">
                                <i data-acorn-icon="home" class="icon" data-acorn-size="18"></i>
                                <span class="label">Dashboard</span>
                            </a>
                        </li>
                         <li>
                            <a href="#data-item" data-bs-toggle="collapse" class="dropdown-toggle">
                                <i data-acorn-icon="home" class="icon" data-acorn-size="18"></i>
                                <span class="label">Data Item</span>
                            </a>
                            <ul id="data-item" class="collapse">
                                <li>
                                    <a href="{{route ('dashboard.tabel.makanan')}}">
                                        <span class="label">Makanan</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route ('dashboard.tabel.daur-ulang')}}">
                                        <span class="label">Daur Ulang</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="#menu-katalog" data-bs-toggle="collapse" class="dropdown-toggle">
                                <i data-acorn-icon="home" class="icon" data-acorn-size="18"></i>
                                <span class="label">Katalog</span>
                            </a>
                            <ul id="menu-katalog" class="collapse">
                                <li><a href="{{route ('dashboard.katalog.makanan')}}"><span class="label">Makanan</span></a></li>
                                <li><a href="{{route ('dashboard.katalog.daur-ulang')}}"><span class="label">Daur Ulang</span></a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="#">
                                <i data-acorn-icon="home" class="icon" data-acorn-size="18"></i>
                                <span class="label">Kampanye</span>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i data-acorn-icon="home" class="icon" data-acorn-size="18"></i>
                                <span class="label">Tentang Kami</span>
                            </a>
                        </li>

                    </ul>
                </div>

                <!-- Menu End -->

                <!-- Mobile Buttons -->
                <div class="mobile-buttons-container">
                    <a href="#" id="scrollSpyButton" class="spy-button" data-bs-toggle="dropdown">
                        <i data-acorn-icon="menu-dropdown"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" id="scrollSpyDropdown"></div>
                    <a href="#" id="mobileMenuButton" class="menu-button">
                        <i data-acorn-icon="menu"></i>
                    </a>
                </div>
                <!-- Mobile Buttons -->
            </div>
            <div class="nav-shadow"></div>
        </div>