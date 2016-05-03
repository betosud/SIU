function comprobar(elemento) {
    var permiso =elemento.id;
    var id ='#'+elemento.id;
    var user =elemento.value;
    var token=$("#token").val();
    var route='/cambiarpermiso';
    var evento='';

    if ($(id).prop("checked")) {

        $(id).prop("checked", true);
        console.log('agregar');
        evento='agregar';

    }
    else {

        $(id).prop("checked", false);
        evento='quitar';
    }

// console.log('permiso '+permiso+" user "+user+"evento "+evento);

    $.ajax({
        url:route,
        headers:{'X-CSRF-TOKEN':token},
        type:'PUT',
        datatype:'json',
        data:{permiso:permiso,usuario:user,evento:evento},
        success:function(mensaje){


        },
        error:function(msj){




        }
    });
}