function getMinAge(ages) {
    if (ages === "Tất cả") return 0;
    let stringArray = ages.split(" ");
    //console.log(typeof stringArray, stringArray);

    if (stringArray.length === 2) {
        if (stringArray[0] === "<=") return 0;
        else return parseInt(stringArray[1]);
    }
    return parseInt(stringArray[0]);
}

function getMaxAge(ages) {
    if (ages === "Tất cả") return 100;
    let stringArray = ages.split(" ");
    //console.log(typeof stringArray, stringArray);

    if (stringArray.length === 2) {
        if (stringArray[0] === "<=") return parseInt(stringArray[1]);
        else return 100;
    }
    return parseInt(stringArray[2]);
}

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

$(document).ready(function () {
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
        columnDefs :[
            {
                "targets": 2,
                "data" : function ( row, type, val, meta ) {
                    console.log('Row: ', row);
                    console.log('Type: ', type);
                    console.log('Val: ', val);
                    console.log('Meta: ', meta);
                    return val === 1 ? "Nam" : "Nữ";
                }
            },
        ],
        columns: [
            { data: "subject", name: "subject"},
            { data: "area", name: "area"},
            { data: "fee", name: "fee"},
            { data: "fee", name: "fee"},
            { data: "fee", name: "fee"},
        ],
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
    });

    $('#btnSearch').on('click', function (e) {
        e.preventDefault();
        console.log("Tim kiem lai");
        let url = makeUrl();
        table.ajax.url(url).load();
    })
});