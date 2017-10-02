@extends('layouts.master')

@section('css')
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
                                <h3 class="panel-title">Tìm kiếm gia sư</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row text-center">
                                    <div class="col-sm-4 form-group">
                                        <label for="name">Name</label>
                                        <input type="name" class="form-control" id="name" placeholder="Điền tên">
                                    </div>
                                    <div class="col-sm-2 form-group">
                                        <label>Giới tính</label>
                                        <div class="btn-group bootstrap-select">
                                            <div class="dropdown-menu open" style="max-height: 756px; overflow: hidden; min-height: 0px;">
                                                <ul class="dropdown-menu inner" role="menu" style="max-height: 748px; overflow-y: auto; min-height: 0px;">
                                                    <li data-original-index="0" class="selected">
                                                        <a tabindex="0" class="" style="" data-tokens="null">
                                                            <span class="text">Tất cả</span>
                                                            <span class="glyphicon glyphicon-ok check-mark"></span>
                                                        </a>
                                                    </li>
                                                    <li data-original-index="1">
                                                        <a tabindex="0" class="" style="" data-tokens="null">
                                                            <span class="text">Nam</span>
                                                            <span class="glyphicon glyphicon-ok check-mark"></span>
                                                        </a>
                                                    </li>
                                                    <li data-original-index="2" class="">
                                                        <a tabindex="0" class="" style="" data-tokens="null">
                                                            <span class="text">Nữ</span>
                                                            <span class="glyphicon glyphicon-ok check-mark"></span>
                                                        </a>
                                                    </li>
                                                    <li data-original-index="3">
                                                        <a tabindex="0" class="" style="" data-tokens="null">
                                                            <span class="text">Khác</span>
                                                            <span class="glyphicon glyphicon-ok check-mark"></span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <select class="selectpicker" data-style="btn-white" tabindex="-98">
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
                                            <div class="dropdown-menu open" style="max-height: 756px; overflow: hidden; min-height: 0px;">
                                                <ul class="dropdown-menu inner" role="menu" style="max-height: 748px; overflow-y: auto; min-height: 0px;">
                                                    <li data-original-index="0" class="selected">
                                                        <a tabindex="0" class="" style="" data-tokens="null">
                                                            <span class="text">Môn 1</span>
                                                            <span class="glyphicon glyphicon-ok check-mark"></span>
                                                        </a>
                                                    </li>
                                                    <li data-original-index="1">
                                                        <a tabindex="0" class="" style="" data-tokens="null">
                                                            <span class="text">Môn 2</span>
                                                            <span class="glyphicon glyphicon-ok check-mark"></span>
                                                        </a>
                                                    </li>
                                                    <li data-original-index="2" class="">
                                                        <a tabindex="0" class="" style="" data-tokens="null">
                                                            <span class="text">Môn 3</span>
                                                            <span class="glyphicon glyphicon-ok check-mark"></span>
                                                        </a>
                                                    </li>
                                                    <li data-original-index="3">
                                                        <a tabindex="0" class="" style="" data-tokens="null">
                                                            <span class="text">Môn 4</span>
                                                            <span class="glyphicon glyphicon-ok check-mark"></span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <select class="selectpicker" data-style="btn-white" tabindex="-98">
                                                <option>Môn 1</option>
                                                <option>Môn 2</option>
                                                <option>Môn 3</option>
                                                <option>Môn 4</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Nơi dạy</label>
                                        <div class="btn-group bootstrap-select">
                                            <div class="dropdown-menu open" style="max-height: 756px; overflow: hidden; min-height: 0px;">
                                                <ul class="dropdown-menu inner" role="menu" style="max-height: 748px; overflow-y: auto; min-height: 0px;">
                                                    <li data-original-index="0" class="selected">
                                                        <a tabindex="0" class="" style="" data-tokens="null">
                                                            <span class="text">Quận 1</span>
                                                            <span class="glyphicon glyphicon-ok check-mark"></span>
                                                        </a>
                                                    </li>
                                                    <li data-original-index="1">
                                                        <a tabindex="0" class="" style="" data-tokens="null">
                                                            <span class="text">Quận 2</span>
                                                            <span class="glyphicon glyphicon-ok check-mark"></span>
                                                        </a>
                                                    </li>
                                                    <li data-original-index="2" class="">
                                                        <a tabindex="0" class="" style="" data-tokens="null">
                                                            <span class="text">Quận 3</span>
                                                            <span class="glyphicon glyphicon-ok check-mark"></span>
                                                        </a>
                                                    </li>
                                                    <li data-original-index="3">
                                                        <a tabindex="0" class="" style="" data-tokens="null">
                                                            <span class="text">Quận 4</span>
                                                            <span class="glyphicon glyphicon-ok check-mark"></span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <select class="selectpicker" data-style="btn-white" tabindex="-98">
                                                <option>Quận 1</option>
                                                <option>Quận 2</option>
                                                <option>Quận 3</option>
                                                <option>Quận 4</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Started Date</th>
                                    <th>Updated Date</th>
                                    <th>Attended rooms</th>
                                    <th>Sent messages</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>
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
@endsection