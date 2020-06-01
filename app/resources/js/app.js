require('./bootstrap');

$(document).on("click", ".delete" , function() {
    var car_id = $(this).data('car_id');
    var autopark_id = $(this).data('autopark_id');
    var el = this;
    var token = $("meta[name='csrf-token']").attr("content");
    $.ajax({
        url: '/car/destroy/'+autopark_id+'/'+car_id,
        type: 'get',
        data:{
            _toket: token
        },
        success: function(response){
            $(el).closest( ".list" ).remove();
        }
    });
});

$(document).ready(function () {
    $('#add_btn').on('click', function () {
         var html2 = '<tr class="list">';
         html2 += '<td>';
         html2 += '<input class="form-control" type="text" name="number[]" value="">';
         html2 += '</td>';
         html2 += '<td>';
         html2 += '<input class="form-control" type="text" name="driver_name[]" value="">';
         html2 += '</td>';
         html2 += '<td>';
         html2 += '<p class="btn btn-danger delete" id="remove_btn">Удалить</p>';
         html2 += '</td>';
         html2 += '</tr>';
        $('tbody').append(html2);
    })
});
$(document).on('click', '#remove_btn', function () {
    $(this).closest('.list').remove();
});
