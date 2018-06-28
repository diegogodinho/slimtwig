$(function(){
    var table = new DefaultDataTable({
        "ajax": {
            "url": $('#construtoratable').data('path'),
            "type": "POST",
            "data": function (d) {
                d.nome = $('#nameSearch').val();
                d.ativo = $('#activeSearch').val();
            }
        },
        "columns": [
            {
                "data": "nome"
            },{
                "data": "telefone"
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
    }, '#construtoratable', '', '', null, function () {

        $('#construtoratable').on('draw.dt', function () {
            $(".editar-grid").click(function () {
                var data = $('#construtoratable').DataTable().row($(this).parents('tr')).data();
                var _url = $('#construtoratable').data('path-edit');
                _url = _url.replace(0, data.id);
                window.location = _url;
            });

            $(".ativoDeativo-grid").click(function () {
                var data = $('#construtoratable').DataTable().row($(this).parents('tr')).data();                
                var _urlDelete = $('#construtoratable').data('path-actdeact');
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
});