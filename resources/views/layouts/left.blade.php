/**
 * Created by PhpStorm.
 * User: vuong
 * Date: 02/10/2017
 * Time: 14:36
 */

<!-- ========== Left Sidebar Start ========== -->

<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <!--- Divider -->
        <div id="sidebar-menu">
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
                @if(Controller::getTypeOfUser(Sentinel::getUser()) >= 1)
                <li class="text-muted menu-title">Cài đặt</li>
                <li class="has_sub">
                    <a href="{{route('manage')}}" class="waves-effect"><i class="ti-settings"></i> <span> Quản lý dạy học </span>
                    </a>
                </li>
                @endif
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- Left Sidebar End -->