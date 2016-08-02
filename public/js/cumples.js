/**
 * Created by enrique on 02/08/16.
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
            $('#cumples').empty().html(data);
            $('#loading').closeModal();

        }
    });
});
$(document).ready(function() {
    $('#loading').openModal({
        opacity: .3,
        dismissible: false,
    });
    listarcumples()
});

var listarcumples = function () {
    var url = 'listarcumples';
    $.ajax({
        type: 'get',
        url: url,
//                datatype: 'json',
        success: function (data) {
            $('#cumples').empty().html(data);
//                    $('sits').html(data);
        }
    });
    $('#loading').closeModal();
};

function mostrar(btn) {
    var id=btn.id;
    var route="/cumpleshow/"+id+"/show";
    $('#editar').openModal({
        dismissible: false,
    });

    $.get(route,function(res){

        $("#fecha").val(res.fecha);
        $(".nombre").val(res.nombre);
        $(".idactualiza").val(res.id);


    });
}



$("#actualizarcumple").click(function(){
    var id=$(".idactualiza").val();
    var nombre=$(".nombre").val();
    var token=$("#token").val();
    var fecha=$("#fecha").val();
    var route='/actualizacumple/'+id;
    console.log(nombre);
    $.ajax({
        url:route,
        headers:{'X-CSRF-TOKEN':token},
        type:'PUT',
        datatype:'json',
        data:{nombre:nombre,fecha:fecha},
        success:function(salida){
            location.reload(true);
        },
        error:function(msj){
            $('#loading').closeModal();
            var result =msj.responseJSON;
            $.each(result, function(i, item) {
                Materialize.toast(item,3000,'rounded');
            });


        }
    });
});


$("#eliminarcumple").click(function(){
    var id=$(".idactualiza").val();
    var nombre=$(".nombre").val();
    var token=$("#token").val();
    var fecha=$("#fecha").val();
    var route='/eliminarcumple/'+id;
    console.log(nombre);
    $.ajax({
        url:route,
        headers:{'X-CSRF-TOKEN':token},
        type:'delete',
//                datatype:'json',
//                data:{nombre:nombre,fecha:fecha},
        success:function(salida){
            location.reload(true);
        },
        error:function(msj){
            $('#loading').closeModal();
            var result =msj.responseJSON;
            $.each(result, function(i, item) {
                Materialize.toast(item,3000,'rounded');
            });


        }
    });
});