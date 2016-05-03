function mostrar(btn) {
    var id=btn.id;
    var route="/discurso/"+id+"/show";
    console.log(route);

    $.get(route,function(res){
        $("#nombre").val(res.nombre);
        $("#id").val(res.id);
        $("h4.titulo").text("Enviar Asignacion de Discurso");
        $("#email").val('');
        $("#email").attr('placeholder','nombre@dominio.com');
        $("#titulo").val('Enviar');
    });

}



$("#enviarcorreo").click(function(){
    var id=$("#id").val();
    var email=$("#email").val();
    var token=$("#token").val();
    var nombre=$("#nombre").val();

    var route='enviarcorreo/'+id+'/discurso';
    // console.log('url '+route);
    // console.log(email);
    // console.log(token);
    $('#loading').modal('show')
    $.ajax({
        url:route,
        headers:{'X-CSRF-TOKEN':token},
        type:'PUT',
        datatype:'json',
        data:{nombre:nombre,email:email},
        success:function(salida){


            toastr.success('El correo Fue enviado',{timeOut: 1500});
            $('#loading').modal('hide');
            $('#enviar').modal('hide');
        },
        error:function(msj){
            $('#loading').modal('hide')
            var result =msj.responseJSON;
            $.each(result, function(i, item) {
                toastr.warning(item,{timeOut: 4000});
            });


        }
    });

});