
function showModalFoto() {
   $('#cdiAjaxContent').html("<i class='fa fa-cog fa-spin'></i><span> Cargando...</span>");
    $('#cdiModal').modal('show');
    $.get('/gestion/foto-up').done(function (data) {
        $('#cdiAjaxContent').html(data);

    }
    );

}


function showEditFoto(id) {
   $('#cdiAjaxContent').html("<i class='fa fa-cog fa-spin'></i><span> Cargando...</span>");
    $('#cdiModal').modal('show');
    $.get('/gestion/foto-up',{id:id}).done(function (data) {
        $('#cdiAjaxContent').html(data);

    }
    );

}
