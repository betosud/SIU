$(document).ready(function() {
    $("#lider1" ).keyup(function() {

        var form = $('#form-lideres');
        var url  = form.attr('action').replace(':VAL', $(this).val());
        var token=$("#token").val();
        var data = form.serialize();
        $(this).autocomplete({
            source: function( request, response ) {
                $.ajax({
                    url: url,
                    headers:{'X-CSRF-TOKEN':token},
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
                $('#lider1').val(ui.item);
                $(this).blur();
            },
            open: function() {
            },
            close: function() {
            }
        });
    }).on('focusout', function(event){
        if( $('#lider1').val() == '' || $('#lider1').val() == '0' ){
            $(this).val('');
        }

    });

    $("#lider2" ).keyup(function() {

        var form = $('#form-lideres');
        var url  = form.attr('action').replace(':VAL', $(this).val());
        var token=$("#token").val();
        var data = form.serialize();
        $(this).autocomplete({
            source: function( request, response ) {
                $.ajax({
                    url: url,
                    headers:{'X-CSRF-TOKEN':token},
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
                $('#lider2').val(ui.item);
                $(this).blur();
            },
            open: function() {
            },
            close: function() {
            }
        });
    }).on('focusout', function(event){
        if( $('#lider1').val() == '' || $('#lider1').val() == '0' ){
            $(this).val('');
        }

    });


    $("#lider3" ).keyup(function() {

        var form = $('#form-lideres');
        var url  = form.attr('action').replace(':VAL', $(this).val());
        var token=$("#token").val();
        var data = form.serialize();
        $(this).autocomplete({
            source: function( request, response ) {
                $.ajax({
                    url: url,
                    headers:{'X-CSRF-TOKEN':token},
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
                $('#lider3').val(ui.item);
                $(this).blur();
            },
            open: function() {
            },
            close: function() {
            }
        });
    }).on('focusout', function(event){
        if( $('#lider1').val() == '' || $('#lider1').val() == '0' ){
            $(this).val('');
        }

    });

});