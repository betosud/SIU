
function cambio(campo ){




    var id=campo.id.split('-')[0];
    var tipo=campo.id.split('-')[1];
    var idindicador=campo.id.split('-')[2];
    var valor=campo.value;
    var token=$("#token").val();
    var route='actualizaindicador/'+id;
       console.log('id='+id+' tipo='+tipo+' idindicador='+idindicador+' valor='+valor);


    $.ajax({
        url:route,
        headers:{'X-CSRF-TOKEN':token},
        type:'PUT',
        datatype:'json',
        data:{tipo:tipo,idindicador:idindicador,valor:valor},
        success:function(mensaje){

//                    Materialize.toast(mensaje.mensaje, 3000,'rounded')
            toastr.success(mensaje.mensaje,{timeOut: 1500});
        },
        error:function(msj){

            var result =msj.responseJSON;
            $.each(result, function(i, item) {
//                        Materialize.toast(item, 6000,'rounded')
                toastr.warning(item);
            });


        }
    });

}