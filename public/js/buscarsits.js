function buscar() {
    var token=$("#token").val();
    var datosbuscar=$("#datosbuscar").val();
    var year=$("#year").val();
    // console.log(year);
    var route="/buscarsits";

    $('#loading').openModal({
        opacity: .3,
        dismissible: false,
    });

    $.ajax({
        url: route,
        data: {datosbuscar:datosbuscar,year:year},
        type:'post',
        headers:{'X-CSRF-TOKEN':token},
        datatype: 'json',
        success: function (data) {
            $('#loading').closeModal();
            $('.sits').html(data);
        }
    });

}




$(document).on('click','.pagination a',function(e){
    e.preventDefault();

    var page=$(this).attr('href').split('/')[3];
    // var route=page.split('?')[0];
    var route='sits';
    var pageid=page.split('=')[1];
    var clase='.'+route;


    var page='sits';

    $('#loading').openModal({
        opacity: .3,
        dismissible: false,
    });
    console.log(page);
    console.log(route);
    console.log(pageid);
    console.log(clase);
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