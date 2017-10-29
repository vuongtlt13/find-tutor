<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        @if(Controller::getTypeOfUser(Sentinel::getUser()) == 1)
            <div class="row card-box" style="text-align: center; padding-top:  10px">
                <img class="img-circle" src="vendor/light/assets/images/users/avatar-6.jpg" alt="">
                <h3 id="name_info_left" class="header-title"><b>Bill Bertz</b></h3>
                <p id="gender_age_info_left" class="text-muted">Nam - 26 tuổi</p>
                <p id="job_info_left" class="text-muted">Branch manager</p>
                <p><label class="text-muted" id="phone_info_left">0123456789</label></p>
                {{--<p id="company_info" class="text-dark"><i class="md md-business m-r-10"></i><small>ABC company Pvt Ltd.</small></p>--}}
                {{--<p><b>Contact: </b></p>--}}
                {{--<p><label class="text-muted" id="email_info">abc@abc</label></p>--}}

            </div>
        @endif
        <!--- Divider -->
        <div id="sidebar-menu" style="padding-top: 0px">
            <ul>
                <li class="has_sub">
                    <a href="{{route('index')}}" class="waves-effect"><i class="ti-home"></i> <span> Trang chủ </span></a>
                </li>

                <li class="has_sub">
                    <a href="{{route('find-tutor')}}" class="waves-effect"><i class="ti-search"></i> <span> Tìm gia sư </span>
                        {{--<span class="menu-arrow"></span> --}}
                    </a>
                    {{--<ul class="">--}}
                        {{--<li><a href="/findbyname">Theo tên gia sư</a></li>--}}
                        {{--<li><a href="/findbysubject">Theo môn học</a></li>--}}
                        {{--<li><a href="/findbyage">Theo tuổi gia sư</a></li>--}}
                        {{--<li><a href="/findbyprice">Theo giá cả</a></li>--}}
                        {{--<li><a href="/findbycounty">Theo quận</a></li>--}}
                    {{--</ul>--}}
                </li>
                @if(Controller::getTypeOfUser(Sentinel::getUser()) == 1)
                <li class="text-muted menu-title">Quản lý</li>
                <li class="has_sub">
                    <a href="{{route('manage')}}" class="waves-effect"><i class="ti-settings"></i> <span> Quản lý dạy học </span>
                    </a>
                </li>
                @elseif (Controller::getTypeOfUser(Sentinel::getUser()) == 2)
                    <li class="text-muted menu-title">Quản lý</li>
                    <li class="has_sub">
                        <a href="{{route('manage')}}" class="waves-effect"><i class="ti-user"></i> <span> Danh sách gia sư </span></a>
                    </li>
                @endif
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- Left Sidebar End -->