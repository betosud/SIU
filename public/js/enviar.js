function mostrar(btn) {
    var id=btn.id;
    var route="/entrevista/"+id+"/show";
    //console.log(route);

    $.get(route,function(res){
        $("#nombre").val(res.nombre);
        $("#id").val(res.id);
        $("h4.titulo").text("Enviar Entrevista");
        $("#email").val('');
        $("#email").attr('placeholder','nombre@dominio.com');
        $("#titulo").val('Enviar Carta');
    });

}



$("#enviarentrevista").click(function(){
    var id=$("#id").val();
    var email=$("#email").val();
    var token=$("#token").val();
    var nombre=$("#nombre").val();

    var route='enviarcorreo/'+id+'/entrevista';
    console.log('url '+route);
    //console.log(email);
    //console.log(token);
    $('#progresoenviar').openModal({
        dismissible: false
    });
    $.ajax({
        url:route,
        headers:{'X-CSRF-TOKEN':token},
        type:'PUT',
        datatype:'json',
        data:{nombre:nombre,email:email},
        success:function(salida){

            //console.log('salida');
            $('#progresoenviar').closeModal();
            Materialize.toast('El correo Fue enviado', 4000,'rounded')
        },
        error:function(msj){
            $('#progresoenviar').closeModal();
            var result =msj.responseJSON;
            $.each(result, function(i, item) {
                Materialize.toast(item, 6000,'rounded')
            });


        }
    });

});