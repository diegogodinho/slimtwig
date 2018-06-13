function DefaultDataTable(obj, idTable, urlEdit, urlDelete, columnAliasMessage, customEvents) {

    var _self = this;

    var _urlEdit = urlEdit;

    var _urlDelete = urlDelete;    

    var _name = columnAliasMessage != null ? columnAliasMessage : "Nome";

    var _mensagemConfirmacaoExclusao = "Tem certeza que deseja excluir o item de {0} ?";

    var _table = null;

    var _defaults = {
        "language": {
            "decimal": "",
            "emptyTable": "Não há dados a serem listados",
            "info": "_START_ de _END_ total de _TOTAL_ resultados",
            "infoEmpty": "Nenhum registro encontrado",
            "infoFiltered": "(filtered from _MAX_ total entries)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Exibindo _MENU_ resultados",
            "loadingRecords": "Carregando...",
            "processing": "Processando...",
            "search": "Filtrar:",
            "zeroRecords": "Nenhum resultado encontrado",
            "paginate": {
                "first": "Primeiro",
                "last": "último",
                "next": "Próximo",
                "previous": "Anterior"
            },
            "aria": {
                "sortAscending": ": activate to sort column ascending",
                "sortDescending": ": activate to sort column descending"
            }
        },
        "searching": false,
        "serverSide": true,
        "order": [[0, "asc"]],
        "pagingType": "full",
        "ajax": {
            "url": "/xxxx/xxxx",
            "type": "POST"
        }
    };

    function DefaultEvents() {

        $(idTable).on('draw.dt', function () {
            $(idTable + " .editar-grid").unbind("click");
            $(idTable + " .excluir-grid").unbind("click");           

            $(".editar-grid").click(function () {                
                var data = $(idTable).DataTable().row($(this).parents('tr')).data()
                if (typeof (_urlEdit) === "string") {
                    window.location = _urlEdit + '/' + data.ID
                }
                else if (typeof (_urlEdit) === "function") {
                    window.location = _urlEdit(data);
                }

            });
            $(".excluir-grid").click(function () {
                var data = $(idTable).DataTable().row($(this).parents('tr')).data();
                var titulo = $('#Titulo').val();
                bootbox.confirm(_mensagemConfirmacaoExclusao.replace("{0}", titulo), function (result) {
                    if (result) {
                        $.post(_urlDelete, {
                            ID: data.ID
                        }, function (retorno) {
                            _self._table.ajax.reload();

                            $.gritter.options.time = 1000;
                            $.gritter.add({
                                title: 'Exclusão',
                                text: 'Exlusão realizada com sucesso!'
                            });

                        }).error(function (result) {
                            bootbox.alert(result.responseJSON.Mensagens.join('</br>'));
                        });
                    }
                });
            });            
        });
    }

    _self.Bind = function () {

        if ($.fn.DataTable.isDataTable(idTable)) {
            $(idTable).DataTable().clear().destroy();
        }

        $.extend(true, _defaults, obj);

        if (customEvents) {
            _self._table = $(idTable).DataTable(_defaults);
            customEvents(_self._table);
        }
        else {            
            _defaults.columns.push({
                "data": null,
                orderable: false,
                "className": "center",
                "defaultContent": '<a href="#" class="btn editar-grid" rel="tooltip" title="Editar" data-original-title="Editar" style="color:green;"><i class="fa fa-edit" ></i></a>  <a href="#" class="btn excluir-grid" rel="tooltip" title="Excluir" data-original-title="Excluir" style="color:red;"><i class="fa fa-times"></i>	</a>'
            });
            _self._table = $(idTable).DataTable(_defaults);
            DefaultEvents();            
        }
        return _self._table;
    }
}