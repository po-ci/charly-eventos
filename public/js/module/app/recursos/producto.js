function compra(id) {


    $('#cdiAjaxContent').html("<i class='fa fa-cog fa-spin'></i><span> Cargando...</span>");
    $('#cdiModal').modal('show');
    $.get('/recursos/fcompra', {idProducto: id}).done(function (data) {
        $('#cdiAjaxContent').html(data);

    }
    );

}


function reloadProductos() {
    $.get('/recursos/producto', {}).done(function (data) {
        $('#ajax-container').html(data);
        $('#loaderModal').modal('hide');
    }
    );

}


function submitFormCompra() {

    var datastring = $('#ProductoCompra').serialize();
    $('#cdiAjaxContent').html("<i class='fa fa-cog fa-spin'></i><span> Cargando...</span>");
    $.post('/recursos/fcompra', datastring)
            .done(function (data) {
                $('#cdiAjaxContent').html(data);
            });

}



function entrega(id) {


    $('#cdiAjaxContent').html("<i class='fa fa-cog fa-spin'></i><span> Cargando...</span>");
    $('#cdiModal').modal('show');
    $.get('/recursos/fentrega', {idProducto: id}).done(function (data) {
        $('#cdiAjaxContent').html(data);

    }
    );

}



function submitFormEntrega() {

    var datastring = $('#ProductoEntrega').serialize();
    $('#cdiAjaxContent').html("<i class='fa fa-cog fa-spin'></i><span> Cargando...</span>");
    $.post('/recursos/fentrega', datastring)
            .done(function (data) {
                $('#cdiAjaxContent').html(data);
            });

}



$(function () {


    $('#cdiModal').on('hidden.bs.modal', function () {
        $('#loaderModal').modal('show');
        reloadProductos();

    })

});
