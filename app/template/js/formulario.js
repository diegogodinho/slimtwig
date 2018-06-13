function addOptionDefaultCombobox(dropDown) {
    dropDown.empty();
    var option = $('<option/>');
    option.attr({ 'value': '' }).text('Selecione...');
    dropDown.append(option);
}

function addFieldError(id, message) {
    $('#' + id).addClass('input-validation-error');
    $('#' + id).parent().find("span[data-valmsg-for='" + id + "']").removeClass('field-validation-valid').addClass('field-validation-error');
    $('#' + id).parent().find("span[data-valmsg-for='" + id + "']").empty();
    $('#' + id).parent().find("span[data-valmsg-for='" + id + "']").append("<span for='" + id + "' generated='true' class=''>" + message + "</span>");
}

function configurarExibicaoMsgAlerta() {
    //$.post('/Alerta/GetTotalAlertaJson', {
    //}, function (data) {
    //    //if (data != null && data.length > 0) {
    //    //    $('#lnkAlerta').append(data);
    //    //}
    //});
}