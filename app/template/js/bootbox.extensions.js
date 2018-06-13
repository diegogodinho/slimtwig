bootbox_extension = {};
bootbox_extension.defaults = {
    DefaultMessageConfirmDelete: 'Tem certeza que deseja excluir o item ?',
    DefaultTitleConfirmation: 'Confirmação',
    DefaultTitleAlert: 'Informação',
    showMessageConfirmation: function (message, callback) {
        bootbox.confirm({
            title: this.DefaultTitleConfirmation,
            message: message,
            callback: callback
        });
    },
    showMessageAlert: function (message) {
        bootbox.alert({
            title: this.DefaultTitleAlert,
            message: message
        });
    }
};