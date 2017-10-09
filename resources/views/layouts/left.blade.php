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
                    <a href="{{route('index')}}" class="waves-effect"><i class="ti-home"></i> <span> Home </span></a>
                </li>

                <li class="has_sub">
                    <a href="{{route('find-tutor')}}" class="waves-effect"><i class="ti-paint-bucket"></i> <span> Tìm gia sư </span>
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
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- Left Sidebar End -->