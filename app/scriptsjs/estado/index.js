$(function(){
    var table = new DefaultDataTable({
        "ajax": {
            "url": $('#estadotable').data('path'),
            "type": "POST",
            "data": function (d) {
                d.nome = $('#nameSearch').val();
                d.ativo = $('#activeSearch').val();
            }
        },
        "columns": [
            {
                "data": "nome"
            }, {
                "data": "sigla",                
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
    }, '#estadotable', '', '', null, function () {

        $('#estadotable').on('draw.dt', function () {
            $(".editar-grid").click(function () {
                var data = $('#estadotable').DataTable().row($(this).parents('tr')).data();
                var _url = $('#estadotable').data('path-edit');
                _url = _url.replace(0, data.id);
                window.location = _url;
            });

            $(".activeDeactive-grid").click(function () {
                var data = $('#estadotable').DataTable().row($(this).parents('tr')).data();                
                var _urlDelete = $('#estadotable').data('path-actdeact');
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