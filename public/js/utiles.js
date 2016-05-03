$('[data-toggle="tooltip"]').tooltip()
$('[data-toggle="popover"]').popover({html:true})
$('#date').datetimepicker({
    format: 'dddd DD MMM YYYY'
});

$('#time').datetimepicker({
    format: 'LT'
});
