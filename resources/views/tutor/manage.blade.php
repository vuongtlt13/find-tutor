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

    <link href="vendor/light/assets/plugins/switchery/css/switchery.min.css" rel="stylesheet" />
    <link href="vendor/light/assets/plugins/custombox/css/custombox.css" rel="stylesheet">
@endsection

@section('content')
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="content-page">
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        <div class="panel panel-border panel-primary">
                            <div class="panel-heading">
                                <h2 class="panel-title">Tìm kiếm môn dạy</h2>
                            </div>
                            <div class="panel-body">
                                <div class="row text-center">
                                    <div class="col-sm-4">
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
                                    <div class="col-sm-4 form-group">
                                        <span class="input-group-btn">
                                            <button id="btnSearch" type="button" class="btn waves-effect waves-light btn-default btn-md"><i class="fa fa-search m-r-5"></i> Tìm kiếm</button>
                                        </span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="btn-group pull-right m-t-5 m-b-15">
                    <button id="btnAdd" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#con-close-modal"> <i class="fa fa-plus m-r-5"></i> <span>Thêm môn dạy</span> </button>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Môn dạy</th>
                                    <th>Khu vực</th>
                                    <th>Giá(1 buổi)</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                                </thead>
                                <tbody>
                                    {{--@foreach($courses as $course)--}}
                                        {{--<tr>--}}
                                            {{--<td>{{$course->subject_id}}</td>--}}
                                            {{--<td>{{$course->area_id}}</td>--}}
                                            {{--<td>{{$course->fee}} VNĐ</td>--}}
                                            {{--<td></td>--}}
                                            {{--<td></td>--}}
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

    <!-- Create Modal -->
    <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="createForm" method="post" action="manage/create">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Thêm môn học</h4>
                        {{csrf_field()}}
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Môn học</label>
                                <div class="subject btn-group bootstrap-select">
                                    <select id="subject" name="subject" class="selectpicker" data-style="btn-white" tabindex="-98">
                                        @foreach($subjects as $subject)
                                        <option>{{$subject->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label>Nơi dạy</label>
                                <div class="area btn-group bootstrap-select">
                                    <select id="area" name="area" class="selectpicker" data-style="btn-white" tabindex="-98">
                                        <option>Tất cả</option>
                                        @foreach($areas as $area)
                                            <option>{{$area->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-10">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="price" class="control-label">Học phí</label>
                                    <input type="number" name="fee" class="form-control" id="fee" placeholder="Giá cả">
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-10">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label id="lable" for="active" class="control-label m-r-15">Nhận dạy: </label>
                                    <input id="active" name="active" type="checkbox" data-plugin="switchery" data-color="#0ab310" data-secondary-color="#ed0109"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="submit" type="submit" class="btn btn-info waves-effect waves-light">Thêm</button>
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Hủy</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Update Modal -->
    <div id="update-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="updateForm" method="post" action="manage/update">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Sửa môn học</h4>
                        {{csrf_field()}}
                        <input id ="idCourse" name="idCourse" type="hidden" value="">
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Môn học</label>
                                <div class="subject-update btn-group bootstrap-select">
                                    <select id="subject-update" name="subject-update" class="selectpicker" data-style="btn-white" tabindex="-98"></select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label>Nơi dạy</label>
                                <div class="area-update btn-group bootstrap-select">
                                    <select id="area-update" name="area-update" class="selectpicker" data-style="btn-white" tabindex="-98"></select>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-10">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="fee-update" class="control-label">Học phí</label>
                                    <input type="number" name="fee-update" class="form-control" id="fee-update" placeholder="Giá cả">
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-10">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label id="lable-update" for="active-update" class="control-label m-r-15">Nhận dạy: </label>
                                    <input id="active-update" name="active-update" type="checkbox" data-plugin="switchery" data-color="#0ab310" data-secondary-color="#ed0109"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="submit-update" type="submit" class="btn btn-info waves-effect waves-light">Lưu</button>
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Hủy</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete modal -->
    <div id="custom-modal" class="modal-demo">
        <button type="button" class="close" onclick="Custombox.close();">
            <span>&times;</span><span class="sr-only">Close</span>
        </button>
        <form id="deleteForm" method="post" action="manage/delete">
            <h4 class="custom-modal-title">Xác nhận</h4>
            <div class="custom-modal-text">
                Bạn thực sự muốn xóa dữ liệu đã chọn?
            </div>
            <div class="row">
                {{csrf_field()}}
                <input type="hidden" name="id" id="id" value="">
                <p>
                    <button type="submit" class="btn btn-lg btn-warning btn-md waves-effect waves-light" tabindex="1" style="display: inline-block;">Xóa</button>
                    <button type="button" onclick="Custombox.close();" class="btn btn-lg btn-white btn-md waves-effect" tabindex="2" style="display: inline-block;">Hủy bỏ</button>
                </p>
            </div>
        </form>
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

    <script src="vendor/light/assets/plugins/switchery/js/switchery.min.js"></script>

    <script src="vendor/light/assets/pages/datatables.init.js"></script>

    <script src="vendor/light/assets/plugins/select2/js/select2.min.js" type="text/javascript"></script>
    <script src="vendor/light/assets/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>

    <script src="/js/manage.js"></script>

    <!-- Modal-Effect -->
    <script src="vendor/light/assets/plugins/custombox/js/custombox.min.js"></script>
    <script src="vendor/light/assets/plugins/custombox/js/legacy.min.js"></script>
@endsection