@extends('layouts.master')
@section('css')
    <link href="vendor/light/assets/plugins/owl.carousel/dist/assets/owl.carousel.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="content-page">
        <div class="content">
            <div class="container">

                <div class="row" style="padding-top: 5%">
                    <div class="col-md-6 col-lg-4">
                        <div class="widget-bg-color-icon card-box">
                            <div class="bg-icon bg-icon-purple pull-left">
                                <i class="md md-account-child text-custom"></i>
                            </div>
                            <div class="text-right">
                                <h3 class="text-dark"><b class="counter">3,564</b></h3>
                                <p class="text-muted">Người học</p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <div class="widget-bg-color-icon card-box">
                            <div class="bg-icon bg-icon-purple pull-left">
                                <i class="md md-account-child text-custom"></i>
                            </div>
                            <div class="text-right">
                                <h3 class="text-dark"><b class="counter">242</b></h3>
                                <p class="text-muted">Gia sư</p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <div class="widget-bg-color-icon card-box">
                            <div class="bg-icon bg-icon-success pull-left">
                                <i class="md md-remove-red-eye text-success"></i>
                            </div>
                            <div class="text-right">
                                <h3 class="text-dark"><b class="counter">64,570</b></h3>
                                <p class="text-muted">Lượt truy cập</p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <h4 class=" m-t-0 header-title"><b>TOP gia sư</b></h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-5 col-lg-5">
                        <!-- START carousel-->
                        <div id="carousel-example-captions" data-ride="carousel" class="carousel slide">
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-captions" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-captions" data-slide-to="1"></li>
                                <li data-target="#carousel-example-captions" data-slide-to="2"></li>
                                <li data-target="#carousel-example-captions" data-slide-to="3"></li>
                                <li data-target="#carousel-example-captions" data-slide-to="4"></li>
                                <li data-target="#carousel-example-captions" data-slide-to="5"></li>
                                <li data-target="#carousel-example-captions" data-slide-to="6"></li>
                                <li data-target="#carousel-example-captions" data-slide-to="7"></li>
                                <li data-target="#carousel-example-captions" data-slide-to="8"></li>
                                <li data-target="#carousel-example-captions" data-slide-to="9"></li>
                            </ol>
                            <div role="listbox" class="carousel-inner">
                                <div class="item active">
                                    <img class="img-rounded" style="width:300px;padding-top:10px;padding-left: 30%;padding-bottom: 35%" src="vendor/light/assets/images/users/avatar-1.jpg" alt="First slide image">

                                    <div class="carousel-caption">
                                        <h3 class="text-black font-600">Phan Vương Hải</h3>
                                        <p style="color: blue">
                                            Giảng viên đại học công nghệ
                                        </p>
                                    </div>
                                </div>
                                <div class="item">
                                    <img class="img-rounded" style="width:300px;padding-top:10px;padding-left: 30%;padding-bottom: 35%"  src="vendor/light/assets/images/users/avatar-2.jpg" alt="Second slide image">
                                    <div class="carousel-caption">
                                        <h3 class="text-black font-600">Trần Đinh Sơn</h3>
                                        <p style="color: blue">
                                            Giảng viên đại học công nghệ
                                        </p>
                                    </div>
                                </div>
                                <div class="item">
                                    <img class="img-rounded" style="width:300px;padding-top:10px;padding-left: 30%;padding-bottom: 35%" src="vendor/light/assets/images/users/avatar-3.jpg" alt="Second slide image">
                                    <div class="carousel-caption">
                                        <h3 class="text-black font-600">Trịnh Tư Cường</h3>
                                        <p style="color: blue">
                                            Giảng viên đại học công nghệ
                                        </p>
                                    </div>
                                </div>
                                <div class="item">
                                    <img class="img-rounded" style="width:300px;padding-top:10px;padding-left: 30%;padding-bottom: 35%" src="vendor/light/assets/images/users/avatar-4.jpg" alt="Second slide image">
                                    <div class="carousel-caption">
                                        <h3 class="text-black font-600">Trần Bá Vương</h3>
                                        <p style="color: blue">
                                            Giảng viên đại học công nghệ
                                        </p>
                                    </div>
                                </div>
                                <div class="item">
                                    <img class="img-rounded" style="width:300px;padding-top:10px;padding-left: 30%;padding-bottom: 35%" src="vendor/light/assets/images/users/avatar-5.jpg" alt="Second slide image">
                                    <div class="carousel-caption">
                                        <h3 class="text-black font-600">Phan Vương Hải</h3>
                                        <p style="color: blue">
                                            Giảng viên đại học công nghệ
                                        </p>
                                    </div>
                                </div>
                                <div class="item">
                                    <img class="img-rounded" style="width:300px;padding-top:10px;padding-left: 30%;padding-bottom: 35%" src="vendor/light/assets/images/users/avatar-6.jpg" alt="Second slide image">
                                    <div class="carousel-caption">
                                        <h3 class="text-black font-600">Đỗ Xuân Đức</h3>
                                        <p style="color: blue">
                                            Giảng viên đại học công nghệ
                                        </p>
                                    </div>
                                </div>
                                <div class="item">
                                    <img class="img-rounded" style="width:300px;padding-top:10px;padding-left: 30%;padding-bottom: 35%" src="vendor/light/assets/images/users/avatar-7.jpg" alt="Second slide image">
                                    <div class="carousel-caption">
                                        <h3 class="text-black font-600">Đỗ Xuân Đức</h3>
                                        <p style="color: blue">
                                            Giảng viên đại học công nghệ
                                        </p>
                                    </div>
                                </div>
                                <div class="item">
                                    <img class="img-rounded" style="width:300px;padding-top:10px;padding-left: 30%;padding-bottom: 35%" src="vendor/light/assets/images/users/avatar-8.jpg" alt="Second slide image">
                                    <div class="carousel-caption">
                                        <h3 class="text-black font-600">Trần Bắc Liên</h3>
                                        <p style="color: blue">
                                            Giảng viên đại học công nghệ
                                        </p>
                                    </div>
                                </div>
                                <div class="item">
                                    <img class="img-rounded" style="width:300px;padding-top:10px;padding-left: 30%;padding-bottom: 35%" src="vendor/light/assets/images/users/avatar-9.jpg" alt="Second slide image">
                                    <div class="carousel-caption">
                                        <h3 class="text-black font-600">Lương Bích Cầm</h3>
                                        <p style="color: blue">
                                            Giảng viên đại học công nghệ
                                        </p>
                                    </div>
                                </div>
                                <div class="item">
                                    <img class="img-rounded" style="width:300px;padding-top:10px;padding-left: 30%;padding-bottom: 35%" src="vendor/light/assets/images/users/avatar-10.jpg" alt="Second slide image">
                                    <div class="carousel-caption">
                                        <h3 class="text-black font-600">Trần Bắc Liên</h3>
                                        <p style="color: blue">
                                            Giảng viên đại học công nghệ
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <a href="#carousel-example-captions" role="button" data-slide="prev" class="left carousel-control"> <span aria-hidden="true" class="fa fa-angle-left"></span> <span class="sr-only">Previous</span> </a>
                            <a href="#carousel-example-captions" role="button" data-slide="next" class="right carousel-control"> <span aria-hidden="true" class="fa fa-angle-right"></span> <span class="sr-only">Next</span> </a>
                        </div>
                        <!-- END carousel-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Right content here -->
    <!-- ============================================================== -->
@endsection

@section('script')
    <script src="vendor/light/assets/plugins/owl.carousel/dist/owl.carousel.min.js"></script>

@endsection