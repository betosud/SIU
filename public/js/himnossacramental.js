$(document).ready(function() {
    $("#himno_inicial" ).keyup(function() {
        var form = $('#form-getHimnos');
        var url  = form.attr('action').replace(':VAL', $(this).val());
        var data = form.serialize();
        $(this).autocomplete({
            source: function( request, response ) {
                $.ajax({
                    url: url,
                    dataType: "json",
                    data: data,
                    success: function( data ) {
                        response($.map(data,function(item){
                                if(item != null)
                                {
                                    return item
                                }
                            }
                        ))
                    }
                });
            },
            select: function( event, ui )
            {
                $('#himnoinicial').val(ui.item);
                $(this).blur();
            },
            open: function() {
            },
            close: function() {
            }
        });
    }).on('focusout', function(event){
        if( $('#himno_inicial').val() == '' || $('#himno_inicial').val() == '0' ){
            $(this).val('');
        }
    });
//            himnofinal
    $("#himno_final" ).keyup(function() {
        var form = $('#form-getHimnos');
        var url  = form.attr('action').replace(':VAL', $(this).val());
        var data = form.serialize();
        $(this).autocomplete({
            source: function( request, response ) {
                $.ajax({
                    url: url,
                    dataType: "json",
                    data: data,
                    success: function( data ) {
                        response($.map(data,function(item){
                                if(item != null)
                                {
                                    return item
                                }
                            }
                        ))
                    }
                });
            },
            select: function( event, ui )
            {
                $('#himno_final').val(ui.item);
                $(this).blur();
            },
            open: function() {
            },
            close: function() {
            }
        });
    }).on('focusout', function(event){
        if( $('#himno_final').val() == '' || $('#himno_final').val() == '0' ){
            $(this).val('');
        }
    });


    $("#himno_intermedio" ).keyup(function() {
        var form = $('#form-getHimnos');
        var url  = form.attr('action').replace(':VAL', $(this).val());
        var data = form.serialize();
        $(this).autocomplete({
            source: function( request, response ) {
                $.ajax({
                    url: url,
                    dataType: "json",
                    data: data,
                    success: function( data ) {
                        response($.map(data,function(item){
                                if(item != null)
                                {
                                    return item
                                }
                            }
                        ))
                    }
                });
            },
            select: function( event, ui )
            {
                $('#himno_intermedio').val(ui.item);
                $(this).blur();
            },
            open: function() {
            },
            close: function() {
            }
        });
    }).on('focusout', function(event){
        if( $('#himno_intermedio').val() == '' || $('#himno_intermedio').val() == '0' ){
            $(this).val('');
        }
    });


    $("#himno_sacramental" ).keyup(function() {
        var form = $('#form-getHimnos');
        var url  = form.attr('action').replace(':VAL', $(this).val());
        var data = form.serialize();
        $(this).autocomplete({
            source: function( request, response ) {
                $.ajax({
                    url: url,
                    dataType: "json",
                    data: data,
                    success: function( data ) {
                        response($.map(data,function(item){
                                if(item != null)
                                {
                                    return item
                                }
                            }
                        ))
                    }
                });
            },
            select: function( event, ui )
            {
                $('#himno_sacramental').val(ui.item);
                $(this).blur();
            },
            open: function() {
            },
            close: function() {
            }
        });
    }).on('focusout', function(event){
        if( $('#himno_sacramental').val() == '' || $('#himno_sacramental').val() == '0' ){
            $(this).val('');
        }
    });


});