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
    let res = "/search?";
    /** GET NAME */
    let name = $('#name').val().trim() === "" ? "all" : $('#name').val().trim();
    console.log('name : ', name);

    /** GET GENDER */
    let gender = $('#gender').val().trim() === "Tất cả" ? "all" : $('#gender').val().trim();
    console.log('gender : ', gender);

    /** GET SUBJECT */
    let subject = $('#subject').val().trim() === "Tất cả" ? "all" : $('#subject').val().trim();
    console.log('subject : ', subject);

    /** GET AREA */
    let area = $('#area').val().trim() === "Tất cả" ? "all" : $('#area').val().trim();
    console.log('area : ', area);

    /** GET MIN AGE AND MAX AGE */
    let ages = $('#age').val().trim();

    let minAge = getMinAge(ages);
    console.log('Min age : ', minAge);
    let maxAge = getMaxAge(ages);
    console.log('Max age : ', maxAge);

    /** GET MIN PRICE AND MAX PRICE */
    let minPrice = parseInt($('#minPrice').val().trim()) || 0;
    console.log('minPrice : ', minPrice);
    let maxPrice = parseInt($('#maxPrice').val().trim()) || 10000000;
    console.log('maxPrice : ', maxPrice);

    console.log('\n\n');
    name = 'name=' + name;
    gender = 'gender=' + gender;
    subject = 'subject=' + subject;
    area = 'area=' + area;
    minAge = 'minage=' + minAge;
    maxAge = 'maxage=' + maxAge;
    minPrice = 'minprice=' + minPrice;
    maxPrice = 'maxprice=' + maxPrice;

    res += createQuery([name, gender, subject, area, minAge, maxAge, minPrice, maxPrice]);
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

    })
});