$(document).ready(function() {
    $(".validado").change(function (e) {
        e.preventDefault();
        var row=$(this).parents('tr');
        var id=row.data('id');

        var valor= $("#validado"+id).val();
        // console.log('valor '+valor);
        $(".validadopor").val(valor);
        var form=$('#form-update-comprobante')
        var url=form.attr('action').replace(':ID',id);
        var data=form.serialize();

        // console.log('url='+url);
        //
        $.post(url,data,function(result){
            // console.log(result);
            Materialize.toast(result.mensaje,3000,'rounded');
        });
    });
});