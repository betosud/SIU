$(document).on('click','.pagination a',function(e){
    e.preventDefault();
    //var page=$(this).attr('href').split('page=')[1];

    var page=$(this).attr('href').split('/')[3];
    var route=page.split('?')[0];
    var pageid=page.split('=')[1];
    var clase='.'+route;
    $('#loading').modal('show')
    // console.log(page);
    // console.log(route);
    // console.log(pageid);
    // console.log(clase);
    $.ajax({
       url: '/'+route,
        data: {page:pageid},
        type:'GET',
        datatype: 'json',
        success: function (data) {
            $('#loading').modal('hide')
            $(clase).html(data);
        }
    });
});