$(document).on('click','.pagination a',function(e){
    e.preventDefault();
    var page=$(this).attr('href').split('page=')[1];
    var route ='/usuarios';

    $.ajax({
       url: route,
        data: {page:page},
        type:'GET',
        datatype: 'json',
        success: function (data) {
            $(".usuario").html(data);
        }
    });
});