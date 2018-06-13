$(function(){  

    var table = new DefaultDataTable({
        "ajax": {
            "url": $('#usertable').data('path'),
            "type": "POST"
        },
        "columns": [
            {
                "data": "nome"
            }, {
                "data": "email"
            }, {
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
                "data": "login"
            }, {
                "data": null,
                orderable: false,
                "className": "center",
                "render": function (data, type, row) {
                    var htmlResult = '<a class="btn editar-grid" rel="tooltip" title="Edit" data-original-title="Editar" style="color:green;"><i class="fa fa-edit" ></i></a> ';
                    if (row.ativo) {
                        htmlResult += ' <a href="#" class="btn activeDeactive-grid" rel="tooltip" title="Desativar" data-original-title="Deactivate" >' + '<i class="fa fa-thumbs-down"></i>	</a>';
                    } else {
                        htmlResult += ' <a href="#" class="btn activeDeactive-grid" rel="tooltip" title="Ativar" data-original-title="Activate" >' + '<i class="fa fa fa-thumbs-o-up"></i>	</a>';
                    }
                    return htmlResult;
                }
            }
        ]
    }, '#usertable', '', '', null, function () {

        $('#usertable').on('draw.dt', function () {
            $(".editar-grid").click(function () {
                var data = $('#usertable').DataTable().row($(this).parents('tr')).data();
                var _url = $('#usertable').data('path-edit');
                _url = _url.replace(0, data.id);
                window.location = _url;
            });

            $(".activeDeactive-grid").click(function () {
                var data = $('#usertable').DataTable().row($(this).parents('tr')).data();
                var titulo = data.name;
                var _urlDelete = $('#usertable').data('path-actdeact');
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
});