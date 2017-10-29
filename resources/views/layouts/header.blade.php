<!-- Top Bar Start -->
<div class="topbar">

    <!-- LOGO -->
    <div class="topbar-left">
        <div class="text-center">
            <a href="{{route('index')}}" class="logo"><span><img src="images/edit.png" height="40"/></span> <i class="icon-magnet icon-c-logo"></i> <span> Gia sư</span></a>
        </div>
    </div>

    <!-- Button mobile view to collapse sidebar menu -->
    <div class="navbar navbar-default" role="navigation">
        <div class="container">

            @if (Sentinel::check())
                <div class="">
                    <ul class="nav navbar-nav navbar-right pull-right">
                        <li class="dropdown top-menu-item-xs">
                            <a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="false">
                                <img src="vendor/light/assets/images/users/avatar-1.jpg" alt="user-img" class="img-circle">
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="javascript:void(0)"><i class="ti-user m-r-10 text-custom"></i> Hồ sơ</a></li>
                                {{--<li><a href="javascript:void(0)"><i class="ti-settings m-r-10 text-custom"></i> Settings</a></li>--}}
                                {{--<li><a href="javascript:void(0)"><i class="ti-lock m-r-10 text-custom"></i> Lock screen</a></li>--}}
                                <li class="divider"></li>
                                <li><a href="{{route('logout')}}"><i class="ti-power-off m-r-10 text-danger"></i> Đăng xuất </a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            @else
                <div class="">
                    <ul class="nav navbar-nav navbar-right pull-right hidden-xs">
                        <li><a href="{{route('register')}}" class="waves-effect waves-light"> <login>Đăng ký </login> </a></li>
                        <li><a href="{{route('login')}}" class="waves-effect waves-light"> <login>Đăng nhập </login></a></li>
                    </ul>
                </div>
            @endif
            <!--/.nav-collapse -->
        </div>
    </div>
</div>
<!-- Top Bar End -->