$(document).ready(function() {
    $(document).on('click', '.agregar_discursante', function () {
        var oradores= $('.referencia_orador').length, // how many "duplicatable" input fields we currently have
            newNum  = new Number(oradores + 1);
        newElem = $('#discursantes'+oradores).clone().attr('id', 'discursantes'+newNum).fadeIn('slow');
        newElem.find('.referencia_orador').attr('id', newNum+'_orador').attr('name', newNum+'_orador').html(newNum+' Orador');
        //nombre
        newElem.find('.tbxnombre_orador'+oradores).attr('id',  'txtnombre_orador'+newNum).attr('name',  'txtnombre_orador'+newNum).val('');
        newElem.find('.tbxtema_orador'+oradores).attr('id',  'tbxtema_orador'+newNum).attr('name', 'tbxtema_orador'+newNum).val('');
        $('#discursantes'+oradores).after(newElem);

    });

    $('#eliminar_discursante').click(function () {
        // confirmation
        var oradores = $('.referencia_orador').length;
        if (oradores > 1) {
//                    // how many "duplicatable" input fields we currently have
            $('#discursantes' + oradores).slideUp('slow', function () {
                $(this).remove();
//                        // if only one element remains, disable the "remove" button
            });

            return false;
        }
        else{
            Materialize.toast('Debe haber al menos un discursante', 4000,'rounded')
        }
    });

});