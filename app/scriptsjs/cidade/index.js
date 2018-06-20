$(function(){
    var table = new DefaultDataTable({
        "ajax": {
            "url": $('#cidadetable').data('path'),
            "type": "POST",
            "data": function (d) {
                d.nome = $('#nameSearch').val();
                d.estado_id = $('#estadoSearch').val();
            }
        },
        "columns": [
            {
                "data": "nome"
            }, {
                "data": "estado.nome",                
            }, {
                "data": null,
                orderable: false,
                "className": "center",
                "render": function (data, type, row) {
                    var htmlResult = '<a class="btn editar-grid" rel="tooltip" title="Edit" data-original-title="Editar" style="color:green;"><i class="fa fa-edit" ></i></a> ';                   
                    return htmlResult;
                }
            }
        ]
    }, '#cidadetable', '', '', null, function () {

        $('#cidadetable').on('draw.dt', function () {
            $(".editar-grid").click(function () {
                var data = $('#cidadetable').DataTable().row($(this).parents('tr')).data();
                var _url = $('#cidadetable').data('path-edit');
                _url = _url.replace(0, data.id);
                window.location = _url;
            });

            $(".activeDeactive-grid").click(function () {
                var data = $('#cidadetable').DataTable().row($(this).parents('tr')).data();                
                var _urlDelete = $('#cidadetable').data('path-actdeact');
                _urlDelete = _urlDelete.replace('0', data.id);
                $.post(_urlDelete, {
                    ID: data.ID
                }, function (retorno) {
                    table.ajax.reload();
                }).error(function (result) {                    
                });
            });
        });
    }).Bind();
    
    $('#btnFiltrar').click(function () {
        table.ajax.reload(null, false);
    });

    $('#clearFilter').click(function () {
        $('#nameSearch').val('');
        $('#estadoSearch').val('');
        table.ajax.reload(null, false);
    }); 
});