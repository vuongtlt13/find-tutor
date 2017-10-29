/**
 * Created by home on 28/10/2017.
 */
$('.btnActive').change(function(e){
    // console.log($(this));
    var row = e.target.closest('tr');
    var dataRow = table.row($(row)).data();
    // console.log(data);
    $.ajax({
        url: '/manage/changestatus',
        type: 'post',
        processing: false,
        data: {
            id: dataRow.id,
        },
        dataType: 'json',
        error: function (e) {
            console.log('Loi r', e);
        },
        success: function (data) {
            // // console.log('thanh cong r', data);
            // let newData = {...dataRow};
            // table.row($(row)).data(newData) .draw();
            dataRow.status = data.status;
            //
            // console.log($(e.target).closest('td').prevAll("td:first"));
            var status = $(e.target).closest('td').prevAll("td:first");

            status.empty();
            if (data.status === 1) {
                status.append('<span class="label label-success">Hoạt động</span>');
            } else {
                status.append('<span class="label label-danger">Đóng</span>');
            }
        }
    })
});

$('.btnEdit').on('click', function (e) {
    // console.log('click');
    let data = table.row($(e.target.closest('tr'))).data();
    // console.log(data.subject);
    // console.log($('#subject'));

    /** subject **/
    $('#subject-update').empty();
    $('#subject-update').append('<option>' + data.subject + '</option>');
    $('.subject-update .bootstrap-select .filter-option').text(data.subject);
    $('#subject-update').val(data.subject);

    /** area **/
    $('#area-update').empty();
    $('#area-update').append('<option>' + data.area + '</option>');
    $('.area-update .bootstrap-select .filter-option').text(data.area);
    $('#area-update').val(data.area);

    /** fee **/
    $('#fee-update').val(data.fee);

    /** active **/
    if (data.status == 1) {
        $('#active-update').prop('checked', true);
    } else {
        $('#active-update').prop('checked', false);
    }

    /** refresh active **/
    $("span").remove(".switchery");
    // $('#active')
    $.getScript('/vendor/light/assets/js/jquery.core.js', function () {
        console.log('script loaded');
    });

    $('#idCourse').attr('value', data.id);
});

$('.btnDelete').on('click', function (e) {
    let id = table.row($(e.target).closest('tr')).data().id;
    console.log(table.row($(e.target).closest('tr')).data(), id);
    $('#id').val(id);
});