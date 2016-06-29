$(document).ready(function() {
    $(".estado").change(function (e) {

        $('#loading').openModal({
            dismissible: false,
        });
        e.preventDefault();
        var row=$(this).parents('tr');
        var id=row.data('id');
        var valor= $("#estado"+id).val();
        $(".status").val(valor);
        var form=$('#form-update')
        var url=form.attr('action').replace(':ID',id);
        var data=form.serialize();


        // console.log('status '+valor);
        $.post(url,data,function(result){
            Materialize.toast(result.mensaje,3000,'rounded');

            $('#loading').closeModal();
        });
    });
});