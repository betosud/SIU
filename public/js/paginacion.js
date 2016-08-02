$(document).on('click','.pagination a',function(e){
    e.preventDefault();

    var page=$(this).attr('href').split('/')[3];
    var route=page.split('?')[0];
    var pageid=page.split('=')[1];
    var clase='.'+route;
    
    
    $('#loading').openModal({
        opacity: .3,
        dismissible: false,
    });
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
            $('#loading').closeModal();
            $(clase).html(data);
        }
    });
});