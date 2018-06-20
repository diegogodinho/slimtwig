$(function(){
    var table = new DefaultDataTable({
        "ajax": {
            "url": $('#itemimoveltable').data('path'),
            "type": "POST",
            "data": function (d) {                
                d.nome = $('#nomeSearch').val();
                d.ativo = $('#ativoSearch').val();
                d.itenscomquantidade = $('#possuiqtdeSearch:checked').length > 0? 1:0;
            }
        },
        "columns": [
            {
                "data": "nome"
            },
            {
                "data": "possuiqtde",
                "render": function (data, type, row) {
                    var htmlResult;
                    if (row.possuiqtde) {
                        htmlResult = '<span style="color:green">Sim</span>';
                    } else {
                        htmlResult = '<span style="color:red">Nao</span>';
                    }
                    return htmlResult;
                }

            },{
                "data": "ativo",
                "render": function (data, type, row) {
                    var htmlResult;
                    if (row.ativo) {
                        htmlResult = '<span style="color:green">Ativo</span>';
                    } else {
                        htmlResult = '<span style="color:red">Inativo</span>';
                    }
                    return htmlResult;
                }
            }, {
                "data": null,
                orderable: false,
                "className": "center",
                "render": function (data, type, row) {
                    var htmlResult = '<a class="btn editar-grid" rel="tooltip" title="Edit" data-original-title="Editar" style="color:green;"><i class="fa fa-edit" ></i></a> ';
                    if (row.ativo) {
                        htmlResult += ' <a href="#" class="btn ativoDeativo-grid" rel="tooltip" title="Desativar" data-original-title="Deactivate" >' + '<i class="fa fa-thumbs-down"></i>	</a>';
                    } else {
                        htmlResult += ' <a href="#" class="btn ativoDeativo-grid" rel="tooltip" title="Ativar" data-original-title="Activate" >' + '<i class="fa fa fa-thumbs-o-up"></i>	</a>';
                    }
                    return htmlResult;
                }
            }
        ]
    }, '#itemimoveltable', '', '', null, function () {

        $('#itemimoveltable').on('draw.dt', function () {
            $(".editar-grid").click(function () {
                var data = $('#itemimoveltable').DataTable().row($(this).parents('tr')).data();
                var _url = $('#itemimoveltable').data('path-edit');
                _url = _url.replace(0, data.id);
                window.location = _url;
            });

            $(".ativoDeativo-grid").click(function () {
                var data = $('#itemimoveltable').DataTable().row($(this).parents('tr')).data();
                var titulo = data.nome;
                var _urlDelete = $('#itemimoveltable').data('path-actdeact');
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