/**
 * Created by enrique on 01/08/16.
 */
$(document).on('click','.pagination li a',function(e){
    e.preventDefault();

    $('#loading').openModal({
        opacity: .3,
        dismissible: false,
    });

    var page=$(this).attr('href');

    var route=page.split('?')[0];
    var pageid=page.split('=')[1];
    var clase='.'+route;
    $.ajax({
        type:'get',
        url:page,
        success: function (data) {
            $('#sits').empty().html(data);
            $('#loading').closeModal();

        }
    });
});

$(document).ready(function() {
    var datobuscar=$("#datosbuscar" ).val();
    var year=$("#year" ).val();
    var status=$("#status" ).val();

    listarproductos(datobuscar,year,status)
});
var buscarproductos = function (datobuscar,year) {
    var datobuscar=$("#datosbuscar" ).val();
    var year=$("#year" ).val();
    var status=$("#status" ).val();
    listarproductos(datobuscar,year,status)
};


$("#year").change(function(){
    var datobuscar=$("#datosbuscar" ).val();
    var year=$("#year" ).val();
    var status=$("#status" ).val();
    listarproductos(datobuscar,year,status);
});


$("#status").change(function(){
    var datobuscar=$("#datosbuscar" ).val();
    var year=$("#year" ).val();
    var status=$("#status" ).val();
    listarproductos(datobuscar,year,status);
});

var listarproductos = function (datobuscar,year,status) {
    $('#loading').openModal({
        opacity: .4,
        dismissible: false,
    });
    if(datobuscar==''){
        datobuscar='vacio'
    }

    var url = 'buscarsits/'+datobuscar+'/'+year+"/"+status;
    console.log(url);
    $.ajax({
        type: 'get',
        url: url,
//                datatype: 'json',
        success: function (data) {
            $('#sits').empty().html(data);
//                    $('sits').html(data);
            $('#loading').closeModal();
        }
    });
};