function pagoVendedor(id) {


    $('#cdiAjaxContent').html("<i class='fa fa-cog fa-spin'></i><span> Cargando...</span>");
    $('#cdiModal').modal('show');
    $.get('/vendedores/pago', {id: id}).done(function (data) {
        $('#cdiAjaxContent').html(data);

    }
    );

}


function reloadCuenta() {
    $.get('/vendedores/cuenta', {}).done(function (data) {
        $('#ajax-container').html(data);
        $('#loaderModal').modal('hide');
    }
    );

}


function submitFormPagoVendedor() {

    var datastring = $('#PagoVendedor').serialize();
    $('#cdiAjaxContent').html("<i class='fa fa-cog fa-spin'></i><span> Cargando...</span>");
    $.post('/vendedores/pago', datastring)
            .done(function (data) {
                $('#cdiAjaxContent').html(data);
            });

}





$(function () {


    $('#cdiModal').on('hidden.bs.modal', function () {
        $('#loaderModal').modal('show');
       reloadCuenta();

    })

});
