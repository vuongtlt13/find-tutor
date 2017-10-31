function createQuery(params) {
    let res = "";
    params.forEach((query) => {
        if (res === "") res += query;
        else res += '&' + query;
    });
    return res;
}

function makeUrl() {
    let res = "/manage/search?";
    /** GET SUBJECT */
    let subject = $('#subject').val().trim() === "Tất cả" ? "all" : $('#subject').val().trim();
    // console.log('subject : ', subject);

    /** GET AREA */
    let area = $('#area').val().trim() === "Tất cả" ? "all" : $('#area').val().trim();
    // console.log('area : ', area);

    //console.log('\n\n');
    subject = 'subject=' + subject;
    area = 'area=' + area;

    res += createQuery([subject, area]);
    console.log('URL :', res);
    return res;
}

let table = $('#datatable').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: makeUrl(),
        error: function (err) {
            console.log(makeUrl());
            console.log('Loi r', err);
        },
    },
    columnDefs: [
        {
            targets: -3,
            render: function ( data, type, row ) {
                return data + ' VNĐ'
            },
        },
        {
            targets: -2,
            render: function ( data, type, row ) {
                return data == 1 ?
                    '<span class="label label-success">Hoạt động</span>'
                    :
                    '<span class="label label-danger">Đóng</span>';
            },
        },
        {
            targets: -1,
            data: null,
            render: function ( data, type, row ) {
                // console.log(row);
                var inputTrue = '<input class="btnActive" data-size="small" type="checkbox" data-plugin="switchery" data-color="#0ab310" data-secondary-color="#ed0109"/>';
                var inputFalse = '<input class="btnActive" data-size="small" checked type="checkbox" data-plugin="switchery" data-color="#0ab310" data-secondary-color="#ed0109"/>';
                var btnEdit = '<button class="btnEdit btn btn-icon waves-effect waves-light btn-primary btn-xs" data-toggle="modal" data-target="#update-modal"> <i class="fa fa-pencil"></i> </button>';
                var btnDelete = '<a href="#custom-modal" class="btnDelete btn btn-primary waves-effect waves-light btn-danger btn-xs" data-animation="fadein" data-plugin="custommodal" ' +
                                'data-overlaySpeed="200" data-overlayColor="#36404a"><i class="fa fa-remove"></i></a>';

                return data == 0 ? inputTrue + ' ' + btnEdit + ' ' + btnDelete
                                 : inputFalse + ' ' + btnEdit + ' ' + btnDelete;
            },
        }
    ],
    columns: [
        { data: "id", name: "id", visible:true},
        { data: "subject", name: "subject"},
        { data: "area", name: "area"},
        { data: "fee", name: "fee"},
        { data: "status", name: "status", searchable: false},
        { data: "status", name: "status", sortable: false},
    ],
    drawCallback: function() {
        console.log('after');
        $("span").remove(".switchery");
        // $('#active')
        $.getScript('/vendor/light/assets/js/jquery.core.js', function () {
            console.log('script loaded');
        });
        $.getScript('/js/manage-action.js', function () {
            console.log('script loaded');
        });
    },
    pageLength: 15,
    searching: false,
    lengthChange: false,
    language:{
        emptyTable:     "Không có dữ liệu trong bảng",
        info:           "Đang xem từ _START_ đến _END_ trong tổng số _TOTAL_",
        infoEmpty:      "",
        loadingRecords: "Đang tải...",
        processing:     "Đang lấy thông tin từ server...",
        paginate: {
            first:      "Trang đầu",
            last:       "Trang cuối",
            next:       "Sau",
            previous:   "Trước"
        }
    },
    order:[[ 0, 'desc' ], [ 3, 'asc' ]],
});

function initModal() {
    var subjectDefault = $('.subject option:first').text();
    // console.log(subjectDefault);
    var areaDefault = $('.area option:first').text();
    // console.log(areaDefault);

    /** subject **/
    $('.subject .bootstrap-select .filter-option').text(subjectDefault);
    $('#subject').val(subjectDefault);

    /** area **/
    $('.area .bootstrap-select .filter-option').text(areaDefault);
    $('#area').val(areaDefault);

    /** fee **/
    $('#fee').val('');

    /** active **/
    $('#active').prop('checked', false);

    /** refresh active **/
    $("span").remove(".switchery");
    // $('#active')
    $.getScript('/vendor/light/assets/js/jquery.core.js', function () {
        console.log('script loaded');
    });
}

$(document).ready(function () {
    $('#btnSearch').on('click', function (e) {
        e.preventDefault();
        console.log("Tim kiem lai");
        let url = makeUrl();
        table.ajax.url(url).load();
    });

    $('#btnAdd').on('click', function () {
        initModal();
    });
});