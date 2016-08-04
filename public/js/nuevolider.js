/**
 * Created by enrique on 04/08/16.
 */
$("#addlidersave").click(function () {
    var nombre=$('#nombre').val();
    var idbarrio=$('#idbarrio').val();
    var email=$('#email').val();
    var organizacion=$('#organizacion').val();
    var phone=$('#phone').val();
    var llamamiento=$('#llamamiento').val();
    var token=$('#token').val();
    var route='/guardarlider';
    $.ajax({
        url:route,
        headers:{'X-CSRF-TOKEN':token},
        type:'post',
        datatype:'json',
        data:{idbarrio:idbarrio,nombre: nombre,email:email,organizacion:organizacion,phone:phone,llamamiento:llamamiento},
        success:function(lider){

            Materialize.toast('Lider Agregado',3000,'rounded');
            $('#addlider').closeModal();
            actualizacomboslideres();
        },

        error:function(msj){
            $('#addlider').openModal({
                dismissible: false,
            });
            var result =msj.responseJSON;
            $.each(result, function(i, item) {
                Materialize.toast(item,3000,'rounded');
            });

        }

    });

});