$( document ).ready(function() {

    $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15, // Creates a dropdown of 15 years to control year
        closeOnSelect: true,
        labelMonthNext: 'Siguiente Mes',
        labelMonthPrev: 'Mes Anterior',
        labelMonthSelect: 'Selecciona Mes',
        labelYearSelect: 'Selecciona Año',
        monthsFull: [ 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Nombiembre', 'Diciembre' ],
        monthsShort: [ 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic' ],
        weekdaysFull: [ 'Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado' ],
        weekdaysShort: [ 'Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab' ],
        weekdaysLetter: [ 'D', 'L', 'M', 'M', 'J', 'V', 'S' ],
        today: 'Hoy',
        clear: 'Borrar',
        close: 'Cerrar',
        format: 'yyyy-mm-dd'
    });
    $('#pick-a-time').lolliclock({autoclose:true});

    $('ul.tabs').tabs();

    $(".button-collapse").sideNav();
    $('.slider').slider({
        Height:200
    });
    $('.modal-trigger').leanModal({
        dismissible: false,
    });
    $('select').material_select();

    $('.tooltipped').tooltip({delay: 50});
    $('.dropdown-button').dropdown({
            inDuration: 300,
            outDuration: 225,

            constrain_width: true, // Does not change width of dropdown to that of the activator
            hover: true, // Activate on hover
            gutter: 0, // Spacing from edge
            belowOrigin: true, // Displays dropdown below the button
            alignment: 'left' // Displays dropdown with edge aligned to the left of button
        }
    );
});