@include('architecture.above')

<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <div class="layout-page">
            <!-- Navbar -->
                <nav class="layout-navbar navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme container-fluid" id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0   d-xl-none ">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                        <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>
                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <!-- Search -->
                        <div class="navbar-nav align-items-center">
                            <div class="nav-item navbar-search-wrapper mb-0">
                                <a class="nav-item nav-link search-toggler px-0" href="javascript:void(0);">
                                <i class="bx bx-search bx-sm"></i>
                                <span class="d-none d-md-inline-block text-muted">Search (Ctrl+/)</span>
                                </a>
                            </div>
                        </div>
                        <!-- /Search -->
                        <ul class="navbar-nav flex-row align-items-center ms-auto">

                        <!-- Language -->
                        <li class="nav-item dropdown-language dropdown me-2 me-xl-0">
                            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                            <i class="bx bx-globe bx-sm"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item active" href="javascript:void(0);" data-language="en" data-text-direction="ltr">
                                <span class="align-middle">English</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);" data-language="fr" data-text-direction="ltr">
                                <span class="align-middle">French</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);" data-language="ar" data-text-direction="rtl">
                                <span class="align-middle">Arabic</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);" data-language="de" data-text-direction="ltr">
                                <span class="align-middle">German</span>
                                </a>
                            </li>
                            </ul>
                        </li>
                        <!-- /Language -->

                        <!-- Style Switcher -->
                        <li class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0">
                            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                            <i class="bx bx-sm bx-sun"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
                                <span class="align-middle"><i class="bx bx-sun me-2"></i>Light</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                                <span class="align-middle"><i class="bx bx-moon me-2"></i>Dark</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
                                <span class="align-middle"><i class="bx bx-desktop me-2"></i>System</span>
                                </a>
                            </li>
                            </ul>
                        </li>
                        <!-- / Style Switcher-->
                        <!-- User -->
                        <li class="nav-item navbar-dropdown dropdown-user dropdown">
                            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                            <div class="avatar avatar-online">
                                <img src="/sneat/assets/img/avatars/1.png" alt="" class="w-px-40 h-auto rounded-circle">
                            </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="#">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <img src="/sneat/assets/img/avatars/1.png" alt="" class="w-px-40 h-auto rounded-circle">
                                    </div>
                                    </div>
                                    <div class="flex-grow-1">
                                    <span class="fw-medium d-block">{{$auth->name}}</span>
                                    <span class="text-muted">{{$auth->role_id}}</span>
                                    @if($auth->role_id == 1)
                                        <span class="badge badge-center rounded-pill bg-label-secondary w-px-30 h-px-30 me-2">
                                            <i class='bx bx-conversation'></i>
                                        </span>
                                        <span class="text-muted">IT Dev.</span>
                                    @elseif($auth->role_id == 2)
                                        <span class="badge badge-center rounded-pill bg-label-secondary w-px-30 h-px-30 me-2">
                                            <i class='bx bx-purchase-tag-alt'></i>
                                        </span>
                                        <span class="text-muted">Purchasing</span>
                                    @elseif($auth->role_id == 3)
                                        <span class="badge badge-center rounded-pill bg-label-secondary w-px-30 h-px-30 me-2">
                                            <i class="bx bx-mobile-alt bx-xs"></i>
                                        </span>
                                        <span class="text-muted">IT</span>
                                    @elseif($auth->role_id == 4)
                                        <span class="badge badge-center rounded-pill bg-label-secondary w-px-30 h-px-30 me-2">
                                            <i class='bx bx-wrench'></i>
                                        </span>
                                        <span class="text-muted">Labs</span>
                                    @elseif($auth->role_id == 5)
                                        <span class="badge badge-center rounded-pill bg-label-secondary w-px-30 h-px-30 me-2">
                                            <i class="bx bx-package bx-xs"></i>
                                        </span>
                                        <span class="text-muted">Courier</span>
                                    @elseif($auth->role_id == 6)
                                        <span class="badge badge-center rounded-pill bg-label-secondary w-px-30 h-px-30 me-2">
                                            <i class='bx bx-building'></i>
                                        </span>
                                        <span class="text-muted">Warehouse</span>
                                    @elseif($auth->role_id == 14)
                                        <span class="badge badge-center rounded-pill bg-label-secondary w-px-30 h-px-30 me-2">
                                            <i class='bx bx-building'></i>
                                        </span>
                                        <span class="text-muted">Family</span>
                                    @else
                                        <span class="badge badge-center rounded-pill bg-label-secondary w-px-30 h-px-30 me-2">
                                            <i class="bx bx-mobile-alt bx-xs"></i>
                                        </span>
                                        <span class="badge bg-danger">Unknown Status</span>
                                    @endif
                                    </div>
                                </div>
                                </a>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                <i class="bx bx-user me-2"></i>
                                <span class="align-middle">My Profile</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                <i class="bx bx-cog me-2"></i>
                                <span class="align-middle">Settings</span>
                                </a>
                            </li>
                            </ul>
                        </li>
                        <!--/ User -->
                        </ul>
                    </div>

                    <!-- Search Small Screens -->
                    <div class="navbar-search-wrapper search-input-wrapper d-none">
                        <span class="twitter-typeahead" style="position: relative; display: inline-block;"><input type="text" class="form-control search-input border-0 tt-input container-fluid" placeholder="Search..." aria-label="Search..." autocomplete="off" spellcheck="false" dir="auto" style="position: relative; vertical-align: top;"><pre aria-hidden="true" style="position: absolute; visibility: hidden; white-space: pre; font-family: &quot;Public Sans&quot;, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Oxygen, Ubuntu, Cantarell, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif; font-size: 15px; font-style: normal; font-variant: normal; font-weight: 400; word-spacing: 0px; letter-spacing: 0px; text-indent: 0px; text-rendering: auto; text-transform: none;"></pre><div class="tt-menu navbar-search-suggestion ps" style="position: absolute; top: 100%; left: 0px; z-index: 100; display: none;"><div class="tt-dataset tt-dataset-pages"></div><div class="tt-dataset tt-dataset-files"></div><div class="tt-dataset tt-dataset-members"></div><div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div></span>
                        <i class="bx bx-x bx-sm search-toggler cursor-pointer"></i>
                    </div>
                </nav>
            <!-- / Navbar -->

            <div class="content-wrapper">
                @yield('content')
            </div>
        </div>
    </div>
</div>


@include('architecture.zone')
