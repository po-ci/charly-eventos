function cancelarCuota(id) {


    $('#cdiAjaxContent').html("<i class='fa fa-cog fa-spin'></i><span> Cargando...</span>");
    $('#cdiModal').modal('show');
    $.get('/ventas/cancelar-cuota', {id: id}).done(function (data) {
        $('#cdiAjaxContent').html(data);

    }
    );

}

function submitFormCancelarCuota() {

    var datastring = $('#CancelarCuota').serialize();
    $('#cdiAjaxContent').html("<i class='fa fa-cog fa-spin'></i><span> Cargando...</span>");
    $.post('/ventas/cancelar-cuota', datastring)
            .done(function (data) {
                 $('#cdiAjaxContent').html(data);
            });

}



 $(function() {
        $('[name="desde"]').datetimepicker({
            pickTime: false,
            language: 'es'
        });

        $('[name="hasta"]').datetimepicker(
                {
                    pickTime: false,
                    language: 'es'
                });
    });
