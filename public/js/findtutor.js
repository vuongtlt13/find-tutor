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
    let res = "/search?type=course&";
    /** GET NAME */
    let name = $('#name').val().trim() === "" ? "all" : $('#name').val().trim();
    // console.log('name : ', name);

    /** GET GENDER */
    let gender = $('#gender').val().trim() === "Tất cả" ? "all" : $('#gender').val().trim();
    // console.log('gender : ', gender);

    /** GET SUBJECT */
    let subject = $('#subject').val().trim() === "Tất cả" ? "all" : $('#subject').val().trim();
    // console.log('subject : ', subject);

    /** GET AREA */
    let area = $('#area').val().trim() === "Tất cả" ? "all" : $('#area').val().trim();
    // console.log('area : ', area);

    /** GET MIN AGE AND MAX AGE */
    let ages = $('#age').val().trim();

    let minAge = getMinAge(ages);
    // console.log('Min age : ', minAge);
    let maxAge = getMaxAge(ages);
    // console.log('Max age : ', maxAge);

    /** GET MIN PRICE AND MAX PRICE */
    let minPrice = parseInt($('#minPrice').val().trim()) || 0;
    // console.log('minPrice : ', minPrice);
    let maxPrice = parseInt($('#maxPrice').val().trim()) || 10000000;
    // console.log('maxPrice : ', maxPrice);

    // console.log('\n\n');
    name = 'name=' + name;
    gender = 'gender=' + gender;
    subject = 'subject=' + subject;
    area = 'area=' + area;
    minAge = 'minage=' + minAge;
    maxAge = 'maxage=' + maxAge;
    minPrice = 'minprice=' + minPrice;
    maxPrice = 'maxprice=' + maxPrice;

    res += createQuery([name, gender, subject, area, minAge, maxAge, minPrice, maxPrice]);
    console.log('URL :', res);
    return res;
}

function showModal(data) {
    console.log('Data: ', data);

    $('#name_info').text(data.name);
    $('#subject_info').text(data.subject);
    $('#area_info').text(data.area);
    $('#fee_info').text(formatNumber(data.fee) + " VNĐ/buổi");

    $.ajax({
        url: '/getinfo?id=' + data.user_id,
        dataType: 'json',
        error: function () {
            console.log("Loi r");
        },
        success: function (data) {
            console.log('admin-info:', data);
            $('#gender_age_info').text(data.gender + ' - ' + data.age + ' tuổi');
            $('#job_info').text(data.job);
            $('#company_info').text(data.workplace);

            $('#email_info').text(data.email);
            $('#phone_info').text(data.phone);

            $('#btnModal').trigger("click");
        }
    });
}

function formatNumber(data) {
    // console.log(typeof data, data);
    let res = "";
    data = String(data);
    let arr = data.split("").reverse();
    for (let i = 0; i < arr.length; i++) {
        if (i !== 0 && i % 3 === 0) {
            res += ',';
        }
        res += arr[i];
    }
    return res.split("").reverse().join("");
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
        columnDefs: [
            {
                targets: -2,
                render: function ( data, type, row ) {
                    let res = formatNumber(data);
                    return res + ' VNĐ'
                },
            },
            {
                targets: -1,
                // data: null,
                render: function (data, type, row) {
                    return '<button class="btn btn-icon waves-effect waves-light btn-success"> <i class="fa fa-phone"></i> </button>'
                }
            }
        ],
        columns: [
            { data: "id", name: "id", "visible": false},
            // { data: "id", name: "id"},
            { data: "name", name: "name"},
            { data: "age", name: "age"},
            { data: "gender", name: "gender"},
            { data: "subject", name: "subject"},
            { data: "area", name: "area"},
            { data: "fee", name: "fee"},
            { data: "action", name: "fee"},
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
    });

    $('#datatable tbody').on( 'click', 'tr', function () {
        console.log('click to row with course_id: ', table.row($(this)).data().id);
        showModal(table.row($(this)).data());
    } );
});