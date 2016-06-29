$(document).ready(function() {
    $(".status").change(function (e) {
        e.preventDefault();
        var row=$(this).parents('tr');
        var id=row.data('id');
        var valor= $("#status"+id).val();
        $(".realizado").val(valor);
        var form=$('#form-update')
        var url=form.attr('action').replace(':ID',id);
        var data=form.serialize();

        // console.log(data+'url='+url);

        $.post(url,data,function(result){
            Materialize.toast(result.mensaje,3000,'rounded');
        });
    });
});