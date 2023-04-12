        <!-- Navigation Bar-->
        <header id="topnav">

            <!-- Topbar Start -->
            <div class="navbar-custom">
                <div class="container-fluid">
                    <ul class="list-unstyled topnav-menu float-right mb-0">

                        <li class="dropdown notification-list">
                            <!-- Mobile menu toggle-->
                            <a class="navbar-toggle nav-link">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <!-- End mobile menu toggle-->
                        </li>

                        <li class="d-none d-sm-block">
                            <form action="{{ url('search') }}" method="GET" class="app-search">
                                <div class="app-search-box">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search" placeholder="Search Lead...">
                                        <div class="input-group-append">
                                            <button class="btn" type="submit">
                                                <i class="fe-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </li>
            
                        <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle waves-light waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="fe-bell noti-icon"></i>
                                <span class="badge badge-danger rounded-circle noti-icon-badge">0</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-lg">

                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5 class="m-0">
                                        <span class="float-right">
                                            <a href="" class="text-muted">
                                                <small>Clear All</small>
                                            </a>
                                        </span>Notification
                                    </h5>
                                </div>
								
                                <div class="slimscroll noti-scroll">

                                    @foreach($notifies as $notifi)
                                        @php
                                            $active = '';
                                            if($notifi->notifi_status == 0) {
                                                $active = 'active';
                                            }
                                        @endphp
                                    <a href="{{ url($notifi->notifi_link).'?noti_id=' }}{{ $notifi->notifi_id }}" class="dropdown-item notify-item {{ $active }}">
                                        <div class="notify-icon bg-info">
                                            <i class="mdi mdi-comment-account-outline"></i>
                                        </div>
                                        <p class="notify-details">
                                            <b>{{ $notifi->user->user_first_name.' '.$notifi->user->user_last_name }}</b> {{ $notifi->notifi_subject }}
                                            <small class="text-muted">{{ $notifi->notifi_time }} 
                                                @if($notifi->notifi_time == date('Y-m-d'))
                                                <span class="badge badge-danger" style="display: inline-block;font-size: 13px">today</span>
                                                @endif
                                            </small>
                                        </p>
                                    </a>
                                    @endforeach

                                    <!--
                                    <a href="javascript:void(0);" class="dropdown-item notify-item active">
                                        <div class="notify-icon">
                                            <img src="assets/images/users/user-1.jpg" class="img-fluid rounded-circle" alt="" /> </div>
                                        <p class="notify-details">Cristina Pride</p>
                                        <p class="text-muted mb-0 user-msg">
                                            <small>Hi, How are you? What about our next meeting</small>
                                        </p>
                                    </a>

                                    
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-primary">
                                            <i class="mdi mdi-comment-account-outline"></i>
                                        </div>
                                        <p class="notify-details">Caleb Flakelar commented on Admin
                                            <small class="text-muted">1 min ago</small>
                                        </p>
                                    </a>

                                   
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon">
                                            <img src="assets/images/users/user-4.jpg" class="img-fluid rounded-circle" alt="" /> </div>
                                        <p class="notify-details">Karen Robinson</p>
                                        <p class="text-muted mb-0 user-msg">
                                            <small>Wow ! this admin looks good and awesome design</small>
                                        </p>
                                    </a>

                                    
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-warning">
                                            <i class="mdi mdi-account-plus"></i>
                                        </div>
                                        <p class="notify-details">New user registered.
                                            <small class="text-muted">5 hours ago</small>
                                        </p>
                                    </a>

                                    
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-info">
                                            <i class="mdi mdi-comment-account-outline"></i>
                                        </div>
                                        <p class="notify-details">Caleb Flakelar commented on Admin
                                            <small class="text-muted">4 days ago</small>
                                        </p>
                                    </a>

                                    
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-secondary">
                                            <i class="mdi mdi-heart text-danger"></i>
                                        </div>
                                        <p class="notify-details">Carlos Crouch liked
                                            <b>Admin</b>
                                            <small class="text-muted">13 days ago</small>
                                        </p>
                                    </a>
                                    -->
                                </div><!-- End noti-scroll -->

                                <!-- All-->
                                <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                                    View all
                                    <i class="fi-arrow-right"></i>
                                </a>

                            </div>
                        </li>

                        <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                @if(Auth::user()->user_image == NULL)
                                <img src="{{ asset('assets/images/avatar.png') }}"
                                     class="rounded-circle"
                                     alt="Frontted">
                                @else
                                <img src="{{ asset('uploads/images/users/').'/'.Auth::user()->user_image }}"
                                     class="rounded-circle"
                                     alt="avatar">
                                @endif
                                <span class="pro-user-name ml-1">
                                    {{ ucfirst(Auth::user()->user_first_name) }}. <i class="mdi mdi-chevron-down"></i> 
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5 class="m-0">
                                        Welcome !
                                    </h5>
                                </div>

                                <!-- item-->
                                <a href="{{ url('profile/user/').'/'.auth::user()->user_id }}" class="dropdown-item notify-item">
                                    <i class="fe-user"></i>
                                    <span>My Account</span>
                                </a>

                                <div class="dropdown-divider"></div>

                                <!-- item-->
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fe-log-out"></i> Logout
                                </a>
                                <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display:none;">
                                @csrf
                                </form>

                            </div>
                        </li>
                        
                    </ul>

                    <!-- LOGO -->
                    <div class="logo-box">
                        <a href="{{ url('/') }}" class="logo text-center">
                            <span class="logo-lg">
                                <!--<img src="assets/images/logo-light.png" alt="" height="26">-->
                                <!-- <span class="logo-lg-text-dark">Upvex</span> -->
                            </span>
                            <span class="logo-sm">
                                <!-- <span class="logo-sm-text-dark">X</span> -->
                                <!--<img src="assets/images/logo-sm.png" alt="" height="28">-->
                            </span>
                            @include('layouts.logo')
                        </a>
                    </div>

                    <ul class="list-unstyled topnav-menu topnav-menu-left m-0">

                        <li class="dropdown d-none d-lg-block">
                            <a class="nav-link dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                Reports
                            </a>
                        </li>

                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- end Topbar -->

            <div class="topbar-menu">
                <div class="container-fluid">
                    <div id="navigation">
                        <!-- Navigation Menu-->
                        <ul class="navigation-menu">

                            <li class="has-submenu">
                                <a href="{{ url('/') }}">
                                    <i class="la la-dashboard"></i>Dashboards
                                </a>
                            </li>

                            <li class="has-submenu">
                                <a href="#">
                                    <i class="la la-phone"></i>Contacts <div class="arrow-down"></div></a>
                                <ul class="submenu">
                                    <li>
                                        <a href="{{ url('leads') }}">Leads</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('companies') }}">Companies</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="has-submenu">
                                <a href="{{ url('users') }}"> <i class="la la-user"></i>Users</a>
                            </li>

                            <li class="has-submenu">
                                <a href="{{ url('activities') }}"> <i class="la la-file-text"></i>Activities</a>
                            </li>

                            <li class="has-submenu">
                                <a href="#"> <i class="la la-bullhorn"></i>Markting <div class="arrow-down"></div></a>
                                <ul class="submenu">
                                    <li>
                                        <a href="{{ url('products') }}">Products</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('campaigns') }}">Campaigns</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('orders') }}">Orders</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('sales') }}">Sales</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a href="{{ url('calendar') }}"><i class="la la-calendar-check-o"></i> Calendar</a>
                            </li>

                        </ul>
                        <!-- End navigation menu -->

                        <div class="clearfix"></div>
                    </div>
                    <!-- end #navigation -->
                </div>
                <!-- end container -->
            </div>
            <!-- end navbar-custom -->

        </header>
        <!-- End Navigation Bar-->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="wrapper">
            <div class="container-fluid">
                @include('layouts/error')