@extends('layouts.master')

@section('css')
    <link href="vendor/light/assets/plugins/custombox/css/custombox.css" rel="stylesheet">
    <!-- DataTables -->
    <link href="vendor/light/assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <link href="vendor/light/assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="vendor/light/assets/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="vendor/light/assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="vendor/light/assets/plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="vendor/light/assets/plugins/datatables/dataTables.colVis.css" rel="stylesheet" type="text/css"/>
    <link href="vendor/light/assets/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="vendor/light/assets/plugins/datatables/fixedColumns.dataTables.min.css" rel="stylesheet" type="text/css"/>

    <link href="vendor/light/assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="vendor/light/assets/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" />
    <style>
        table.myTable.stripe tbody tr.odd,
        table.myTable.display tbody tr.odd {
            background-color: #f9f9f9
        }

        table.myTable.hover tbody tr:hover,
        table.myTable.display tbody tr:hover {
            cursor: pointer;
            background-color: #aab7d1
        }
    </style>
@endsection

@section('content')
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="content-page">
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1">
                        <div class="panel panel-border panel-primary">
                            <div class="panel-heading">
                                <h2 class="panel-title">Tìm kiếm gia sư</h2>
                            </div>
                            <div class="panel-body">
                                <div class="row text-center">
                                    <div class="col-sm-4 form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" placeholder="Điền tên">
                                    </div>
                                    <div class="col-sm-2 form-group">
                                        <label>Giới tính</label>
                                        <div class="btn-group bootstrap-select">
                                            <select id="gender" class="selectpicker" data-style="btn-white" tabindex="-98">
                                                <option>Tất cả</option>
                                                <option>Nam</option>
                                                <option>Nữ</option>
                                                <option>Khác</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <label>Môn học</label>
                                        <div class="btn-group bootstrap-select">
                                            <select id="subject" class="selectpicker" data-style="btn-white" tabindex="-98">
                                                <option>Tất cả</option>
                                                @foreach($subjects as $subject)
                                                    <option>{{$subject->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Nơi dạy</label>
                                        <div class="btn-group bootstrap-select">
                                            <select id="area" class="selectpicker" data-style="btn-white" tabindex="-98">
                                                <option>Tất cả</option>
                                                @foreach($areas as $area)
                                                    <option>{{$area->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row text-center col-sm-12">
                                    <div class="col-sm-3 form-group">
                                        <label for="name">Tuổi</label>
                                        <div class="btn-group bootstrap-select">
                                            <select id="age" class="selectpicker" data-style="btn-white" tabindex="-98">
                                                <option>Tất cả</option>
                                                <option><= 25</option>
                                                <option>26 - 30</option>
                                                <option>31 - 35</option>
                                                <option>>= 36</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-7">
                                        <label for="name">Học phí (1 buổi)</label>
                                        <div>
                                            <div class="form-inline col-sm-6">
                                                <label class="col-sm-3" style="padding-top: 10px">Từ: </label>
                                                <div class="col-sm-7">
                                                    <input type="number" class="form-control" id="minPrice" placeholder="Giá nhỏ nhất" value="0">
                                                </div>
                                                <div style="padding-top: 10px">VNĐ</div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="col-sm-3" style="padding-top: 10px">Đến: </label>
                                                <div class="col-sm-7">
                                                    <input type="number" class="form-control" id="maxPrice" placeholder="Giá lớn nhất" value="100000">
                                                </div>
                                                <div style="padding-top: 10px">VNĐ</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-2 form-group">
                                        <span class="input-group-btn">
                                            <button id="btnSearch" type="button" class="btn waves-effect waves-light btn-default btn-md"><i class="fa fa-search m-r-5"></i> Tìm kiếm</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <table id="datatable" class="table table-bordered display myTable">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Tên</th>
                                    <th>Tuổi</th>
                                    <th>Giới tính</th>
                                    <th>Môn dạy</th>
                                    <th>Khu vực</th>
                                    <th>Học phí(1 buổi)</th>
                                    <th>Contact</th>
                                </tr>
                                </thead>
                                <tbody>
                                {{--@foreach($courses as $course)--}}
                                    {{--<tr>--}}
                                        {{--<td>{{$course->user_id}}</td>--}}
                                        {{--<td>{{$course->user_id}}</td>--}}
                                        {{--<td>{{$course->user_id}}</td>--}}
                                        {{--<td>{{$course->subject_id}}</td>--}}
                                        {{--<td>{{$course->area_id}}</td>--}}
                                        {{--<td>{{$course->fee}} VNĐ</td>--}}
                                    {{--</tr>--}}
                                {{--@endforeach--}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Right content here -->
    <!-- ============================================================== -->

    <!-- Modal -->
    <div id="custom-modal" class="modal-demo">
        <button type="button" class="close" onclick="Custombox.close();">
            <span>&times;</span><span class="sr-only">Close</span>
        </button>
        <h4 class="custom-modal-title">Thông tin chi tiết</h4>
        <div class="custom-modal-text">
            <div class="row card-box">
                <div class="col-sm-5">
                    <img class="img-circle" src="vendor/light/assets/images/users/avatar-6.jpg" alt="">
                    <h3 id="name_info" class="header-title"><b>Bill Bertz</b></h3>
                    <p id="gender_age_info" class="text-muted">Nam - 26 tuổi</p>
                    <p id="job_info" class="text-muted">Branch manager</p>
                    <p id="company_info" class="text-dark"><i class="md md-business m-r-10"></i><small>ABC company Pvt Ltd.</small></p>
                </div>
                <div class="col-sm-6 pull-right" style="padding-right: 5%;padding-top: 3%;">
                    <div class="form-group" style="text-align:left;">
                        <p><b>Môn học: </b><label class="text-muted" id="subject_info">Toán học</label></p>
                        <p><b>Khu vực: </b><label class="text-muted" id="area_info">Quận Hai Bà Trưng</label></p>
                        <p><b>Học phí: </b><label class="text-muted" id="fee_info">200000 VNĐ/buổi</label></p>
                        <p><b>Email: </b><label class="text-muted" id="email_info">abc@abc</label></p>
                        <p><b>Số điện thoại: </b><label class="text-muted" id="phone_info">0123456789</label></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="display: none" id="myDiv">
        <a id ="btnModal"  href="#custom-modal" class="btn btn-primary waves-effect waves-light" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a">Show Me</a>
    </div>
@endsection

@section('script')
    <script src="vendor/light/assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/light/assets/plugins/datatables/dataTables.bootstrap.js"></script>

    <script src="vendor/light/assets/plugins/datatables/dataTables.buttons.min.js"></script>
    <script src="vendor/light/assets/plugins/datatables/buttons.bootstrap.min.js"></script>
    <script src="vendor/light/assets/plugins/datatables/jszip.min.js"></script>
    <script src="vendor/light/assets/plugins/datatables/pdfmake.min.js"></script>
    <script src="vendor/light/assets/plugins/datatables/vfs_fonts.js"></script>
    <script src="vendor/light/assets/plugins/datatables/buttons.html5.min.js"></script>
    <script src="vendor/light/assets/plugins/datatables/buttons.print.min.js"></script>
    <script src="vendor/light/assets/plugins/datatables/dataTables.fixedHeader.min.js"></script>
    <script src="vendor/light/assets/plugins/datatables/dataTables.keyTable.min.js"></script>
    <script src="vendor/light/assets/plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="vendor/light/assets/plugins/datatables/responsive.bootstrap.min.js"></script>
    <script src="vendor/light/assets/plugins/datatables/dataTables.scroller.min.js"></script>
    <script src="vendor/light/assets/plugins/datatables/dataTables.colVis.js"></script>
    <script src="vendor/light/assets/plugins/datatables/dataTables.fixedColumns.min.js"></script>

    <script src="vendor/light/assets/pages/datatables.init.js"></script>

    <script src="vendor/light/assets/plugins/select2/js/select2.min.js" type="text/javascript"></script>
    <script src="vendor/light/assets/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>

    <script src="/js/findtutor.js"></script>

    <!-- Modal-Effect -->
    <script src="vendor/light/assets/plugins/custombox/js/custombox.min.js"></script>
    <script src="vendor/light/assets/plugins/custombox/js/legacy.min.js"></script>
@endsection