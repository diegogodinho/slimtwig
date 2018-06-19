$(function(){
    var table = new DefaultDataTable({
        "ajax": {
            "url": $('#bairrotable').data('path'),
            "type": "POST",
            "data": function (d) {
                d.nome = $('#nameSearch').val();
                d.estado_id = $('#estadoSearch').val();
                d.cidade_id = $('#cidadeSearch').val();
            }
        },
        "columns": [
            {
                "data": "nome"
            }, {
                "data": "cidade.nome",                
            },{
                "data": "cidade.estado.nome",                
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
    }, '#bairrotable', '', '', null, function () {

        $('#bairrotable').on('draw.dt', function () {
            $(".editar-grid").click(function () {
                var data = $('#bairrotable').DataTable().row($(this).parents('tr')).data();
                var _url = $('#bairrotable').data('path-edit');
                _url = _url.replace(0, data.id);
                window.location = _url;
            });

            $(".activeDeactive-grid").click(function () {
                var data = $('#bairrotable').DataTable().row($(this).parents('tr')).data();                
                var _urlDelete = $('#bairrotable').data('path-actdeact');
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
        $('#cidadeSearch').val('');
        table.ajax.reload(null, false);
    }); 

    $('#estadoSearch').change(function(){        
        $.ajax({
            type: "POST",
            url: $('#urlCidadeDropDown').val(),
            data: {
                estado_id:$('#estadoSearch').val(),
                dropdownid:'cidadeSearch',
                dropdownname:'cidadeSearch'
            },
            success: function(data){
                $('#areaCidadeDropDown').html('');
                $('#areaCidadeDropDown').html(data);
            },
            error: function(data){
                console.log(data);                
            }
          });
    });
});