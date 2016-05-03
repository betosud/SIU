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

        $.post(url,data,function(result){
            toastr.success(result.mensaje,{timeOut: 1500,"closeButton": true});
        });
    });
});