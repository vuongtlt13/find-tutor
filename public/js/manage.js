function makeUrl() {
    let res = "/search?";
    /** GET SUBJECT */
    let subject = $('#subject').val().trim() === "Tất cả" ? "all" : $('#subject').val().trim();
    console.log('subject : ', subject);

    /** GET AREA */
    let area = $('#area').val().trim() === "Tất cả" ? "all" : $('#area').val().trim();
    console.log('area : ', area);

    console.log('\n\n');

    subject = 'subject=' + subject;
    area = 'area=' + area;

    res += createQuery([subject, area]);
    console.log(res);
    return res;
}

$(document).ready(function () {
    let table = $('#datatable').dataTable({
        "pageLength": 15,
        "searching": false,
        "lengthChange": false,
        "language":{
            "emptyTable":     "Không có dữ liệu trong bảng",
            "info":           "Đang xem từ _START_ đến _END_ trong tổng số _TOTAL_",
            "infoEmpty":      "",
            "loadingRecords": "Đang tải...",
            "processing":     "Đang tiến hành...",
            "paginate": {
                "first":      "Trang đầu",
                "last":       "Trang cuối",
                "next":       "Sau",
                "previous":   "Trước"
            }
        },
    });

    $('#btnSearch').on('click', function (e) {
        e.preventDefault();
        console.log("Tim kiem");

        let url = makeUrl();
    });
});