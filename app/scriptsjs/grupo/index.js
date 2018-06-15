$(function(){
    var table = new DefaultDataTable({
        "ajax": {
            "url": $('#grupotable').data('path'),
            "type": "POST",
            "data": function (d) {                
                d.nome = $('#nomeSearch').val();                                
            }
        },
        "columns": [
            {
                "data": "nome"
            },
            {
                "data": null,
                orderable: false,
                "className": "center",
                "render": function (data, type, row) {
                    var htmlResult = '<a class="btn editar-grid" rel="tooltip" title="Edit" data-original-title="Editar" style="color:green;"><i class="fa fa-edit" ></i></a> ';                    
                    htmlResult += ' <button type="button" class="btn btn-warning"> <span class="glyphicon glyphicon-search"></span> Editar/Visualizar  Grupo/Permissoes </button>'
                    return htmlResult;
                }
            }
        ]
    }, '#grupotable', '', '', null, function () {

        $('#grupotable').on('draw.dt', function () {
            $(".editar-grid").click(function () {
                var data = $('#grupotable').DataTable().row($(this).parents('tr')).data();
                var _url = $('#grupotable').data('path-edit');
                _url = _url.replace(0, data.id);
                window.location = _url;
            });

            $(".ativoDeativo-grid").click(function () {
                var data = $('#grupotable').DataTable().row($(this).parents('tr')).data();
                var titulo = data.nome;
                var _urlDelete = $('#grupotable').data('path-actdeact');
                _urlDelete = _urlDelete.replace('0', data.id);
                $.post(_urlDelete, {
                    ID: data.ID
                }, function (retorno) {
                    table.ajax.reload();
                }).error(function (result) {
                    bootbox.alert('Failed');
                });
            });
        });
    }).Bind();

    $('#btnFiltrar').click(function () {
        table.ajax.reload(null, false);
    });
    $('#clearFilter').click(function () {
        $('#nomeSearch').val('');
        $('#ativoSearch').val('');
        table.ajax.reload(null, false);
    }); 
});