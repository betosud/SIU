/**
 * Created by enrique on 04/08/16.
 */
$('#lider1').on('change',function (e) {
    var id = document.getElementById("lider1").value;
    if(id==-1) {
        $('#addlider').openModal({
            dismissible: false,
        });
    }
});
$('#lider2').on('change',function (e) {
    var id = document.getElementById("lider2").value;
    if(id==-1) {
        $('#addlider').openModal({
            dismissible: false,
        });
    }
});
$('#lider3').on('change',function (e) {
    var id = document.getElementById("lider3").value;
    if(id==-1) {
        $('#addlider').openModal({
            dismissible: false,
        });
    }
});



function actualizacomboslideres() {
    var route= '/consultalideres/todos/activos';
    $.get(route, function (res) {
        $("#lider1").empty();
        $("#lider1").append('<option value="" placeholder="Selecciona Lider" >Selecciona Lider</option>');


        for(var i=0;i<res.combo.length;i++){
            $("#lider1").append('<option value="' + res.combo[i].id + '">' + res.combo[i].nombre + '</option>');
            console.log("id "+res.combo[i].id+" nombre "+res.combo[i].nombre);
        }
        $('select').material_select();
    });

//            actualiza combo obispado
    var route= '/consultalideres/Obispado/activos';
    $.get(route, function (res) {
        $("#lider2").empty();
        $("#lider2").append('<option value="" placeholder="Selecciona Lider" >Selecciona Lider</option>');


        for(var i=0;i<res.combo.length;i++){
            $("#lider2").append('<option value="' + res.combo[i].id + '">' + res.combo[i].nombre + '</option>');
            console.log("id "+res.combo[i].id+" nombre "+res.combo[i].nombre);
        }
        $('select').material_select();
    });

    $.get(route, function (res) {
        $("#lider3").empty();
        $("#lider3").append('<option value="" placeholder="Selecciona Lider" >Selecciona Lider</option>');


        for(var i=0;i<res.combo.length;i++){
            $("#lider3").append('<option value="' + res.combo[i].id + '">' + res.combo[i].nombre + '</option>');
            console.log("id "+res.combo[i].id+" nombre "+res.combo[i].nombre);
        }
        $('select').material_select();
    });
}