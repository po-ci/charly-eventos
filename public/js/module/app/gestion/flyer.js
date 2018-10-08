function showModalFlyer() {
   $('#cdiAjaxContent').html("<i class='fa fa-cog fa-spin'></i><span> Cargando...</span>");
    $('#cdiModal').modal('show');
    $.get('/gestion/flyer-up').done(function (data) {
        $('#cdiAjaxContent').html(data);

    }
    );

}


function showEditFlyer(id) {
   $('#cdiAjaxContent').html("<i class='fa fa-cog fa-spin'></i><span> Cargando...</span>");
    $('#cdiModal').modal('show');
    $.get('/gestion/flyer-up',{id:id}).done(function (data) {
        $('#cdiAjaxContent').html(data);

    }
    );

}

