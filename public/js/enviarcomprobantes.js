function mostrar(btn) {
    var id=btn.id;
    var route="/mostrarinfosit/"+id+"/show";
    console.log(route);

    $.get(route,function(res){
        $("#nombre").val(res.pagable);
        $("#id").val(res.id);
        $("h4.titulo").text(res.idsit);
        $("#email").val(res.idbarrio+'@ldsmex.org');
        $("#email").attr('placeholder','nombre@dominio.com');
        $("#titulo").val('SIT '+res.idsit);
    });

}



$("#enviarcorreo").click(function(){
    var id=$("#id").val();
    var email=$("#email").val();
    var token=$("#token").val();
    var nombre=$("#nombre").val();

    var route='/enviarcomprobantes/'+id;
    console.log('url '+route);
    console.log(email);
    console.log(token);
    $('#loading').openModal({
        dismissible: false,
    });

    console.log(route);
    $.ajax({
        url:route,
        headers:{'X-CSRF-TOKEN':token},
        type:'PUT',
        datatype:'json',
        data:{nombre:nombre,email:email},
        success:function(salida){
            Materialize.toast(salida.salida,3000,'rounded');
            $('#loading').closeModal();
            // $('#enviar').closeModal();
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