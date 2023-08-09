<header>
    <div class="header-area header-transparrent">
        <div class="headder-top header-sticky sticky-bar sticky">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-2">
                        <!-- Logo -->
                        <div class="logo">
                            <a href="{{ route('homepage') }}"><img src="{{ asset('img/logo/logo.png') }}" alt=""></a>
                        </div>  
                    </div>
                    <div class="col-lg-9 col-md-9">
                        <div class="menu-wrapper">
                            <!-- Main-menu -->
                            <div class="main-menu">
                                <nav class="d-none d-lg-block">
                                    <ul id="navigation">
                                        <li><a href="{{ route('homepage') }}">Home</a></li>
                                        <li><a href="{{ route('job.index') }}">Jobs</a></li>
                                        @if (auth()->guard('company')->check())
                                            <li><a href="#">Employees</a></li>
                                        @else
                                            <li><a href="#">Companies</a></li>
                                        @endif
                                        <li><a href="#">Contact</a></li>
                                        @if (auth()->guard('company')->check() || auth()->guard('user')->check())
                                            <li class="avatar">
                                                <a href="#"><img src="{{ asset('img/avatar/default.jpg') }}" alt=""></a>
                                                <ul class="submenu">
                                                    @if (auth()->guard('company')->check())
                                                        @php
                                                            $companyId = auth()->guard('company')->id();
                                                        @endphp
                                                        <li><a href="{{ route('company.show', ['id' => $companyId]) }}">Profile</a></li>
                                                        <li><a href="{{ route('company.jobs', ['id' => $companyId]) }}">Posted Jobs</a></li>
                                                    @endif
                                                    @if (auth()->guard('user')->check())
                                                        @php
                                                            $userId = auth()->guard('user')->id();
                                                        @endphp
                                                        <li><a href="{{ route('user.show', ['id' => $userId]) }}">Profile</a></li>
                                                        <li><a href="{{ route('user.appliedJobs') }}">Applied Jobs</a></li>
                                                    @endif
                                                    <li><a href="{{ route('logout') }}">Logout</a></li>
                                                </ul>
                                            </li>
                                        @endif
                                    </ul>
                                </nav>
                            </div>
                            @if (!auth()->guard('company')->check() && !auth()->guard('user')->check())
                                <!-- Header-btn -->
                                <div class="header-btn d-none f-right d-lg-block">
                                    <button type="button" class="btn head-btn1" data-toggle="modal" data-target="#registerModal">Register</button>
                                    <button type="button" class="btn head-btn2" data-toggle="modal" data-target="#loginModal">Login</button>
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- Mobile Menu -->
                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>