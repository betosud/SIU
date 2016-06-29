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
    $('#loading').openModal({
        dismissible: false,
    });
    $.ajax({
        url:route,
        headers:{'X-CSRF-TOKEN':token},
        type:'PUT',
        datatype:'json',
        data:{nombre:nombre,email:email},
        success:function(salida){
            Materialize.toast('El Correo Fue Enviado',3000,'rounded')
            $('#loading').closeModal();
            $('#enviar').closeModal();
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