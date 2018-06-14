$(function(){  

    var table = new DefaultDataTable({
        "ajax": {
            "url": $('#usertable').data('path'),
            "type": "POST"
        },
        "columns": [
            {
                "render": function (data, type, row) {
                    return '<img src="' + row.urlrelative + '" />';
                },
                "width": "20%"
            }, {
                "data": "name",
                "render": function (data, type, row) {
                    return '<a href="#" onclick="ShowModal(\'' + row.urlrelative + '\');">' + row.name + '</a> ';
                }
            }, {
                "data": "iswatermark",
                "render": function (data, type, row) {
                    var htmlResult;
                    if (row.iswatermark) {
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
                    var htmlResult = '<a href="#" class="btn excluir-grid" rel="tooltip" title="Delete" data-original-title="Excluir" style="color:red;"><i class="fa fa-times"></i>	</a>';
                    if (row.iswatermark) {
                        htmlResult += ' <a href="#" class="btn activeDeactive-grid" rel="tooltip" title="Remover marca d\'agua" data-original-title="Deactivate" >' + '<i class="fa fa-thumbs-down"></i>	</a>';
                    } else {
                        htmlResult += ' <a href="#" class="btn activeDeactive-grid" rel="tooltip" title="Definir como marca d\'agua" data-original-title="Activate" >' + '<i class="fa fa fa-thumbs-o-up"></i>	</a>';
                    }
                    return htmlResult;
                }

            }
        ]
    }, '#usertable', '', '', null, function () {       
        $('#usertable').on('draw.dt', function () {
            $(".excluir-grid").click(function () {
                var data = $('#usertable').DataTable().row($(this).parents('tr')).data();
                var titulo = data.name;
                var _urlDelete = $('#usertable').data('path-del');
                _urlDelete = _urlDelete.replace('0', data.id);
                bootbox.confirm("Tem certeza que deseja excluir o item {0}?".replace("{0}", titulo), function (result) {
                    if (result) {
                        $.post(_urlDelete, {
                            ID: data.ID
                        }, function (retorno) {
                            table.ajax.reload();
                            //$('#modal-confirmation-excluded').modal('show');
                        }).error(function (result) {
                            bootbox.alert('Failed');
                        });
                    }
                });
            });
            $(".activeDeactive-grid").click(function () {
                var data = $('#usertable').DataTable().row($(this).parents('tr')).data();
                var titulo = data.name;
                var _urlDelete = $('#usertable').data('path-actdeact');
                _urlDelete = _urlDelete.replace('0', data.id);
                $.post(_urlDelete, {
                    id: data.id
                }, function (retorno) {
                    table.ajax.reload();

                }).error(function (result) {
                    bootbox.alert('Failed');
                });
            });
        });
    }).Bind();    
});