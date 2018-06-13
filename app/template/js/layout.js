/*function pegarUrlCompletaDaAcao(nomeDaAcao, parametros) {
    parametros = parametros == undefined || parametros == null ? '' : parametros;

    var nomeDaAcaoArray = nomeDaAcao.split('/');
    var pathArray = document.location.pathname.split('/');

    var caminhoDoSite = "";
    var indiceDaArea = pathArray[1].toLowerCase() == diretorioVirtual.toLowerCase() ? 2 : 1;

    if (diretorioVirtual != '') {
        caminhoDoSite = diretorioVirtual + '/';
    }

    var retorno = "";

    if (nomeDaAcaoArray.length == 1) {
        retorno = document.location.protocol + '//' + document.location.host + '/' + caminhoDoSite + pathArray[indiceDaArea] + '/' + nomeDaAcao + '/' + parametros;
    }
    else if (nomeDaAcaoArray.length == 2) {        
        retorno = document.location.protocol + '//' + document.location.host + '/' + caminhoDoSite + pathArray[indiceDaArea] + '/' +  nomeDaAcaoArray[0] + '/' + nomeDaAcaoArray[1] + '/' + parametros;
    }
    else if (nomeDaAcaoArray.length == 3) {
        retorno = document.location.protocol + '//' + document.location.host + '/' + caminhoDoSite + nomeDaAcaoArray[0] + '/' + nomeDaAcaoArray[1] + '/' + nomeDaAcaoArray[2] + '/' + parametros;
    }

    return retorno;
}

function chamarGetViaAjax(url, successCallback, completeCallback, errorCallback) {
    $.ajax({
        type: 'GET',
        url: url,
        data: 'JSON',
        cache: false,
        success: function (data) {
            successCallback(data);
        },
        complete: function (data) {
            if (typeof (completeCallback) == 'function') {
                completeCallback(data);
            }
        },
        error: function (data) {
            if (typeof (errorCallback) == 'function') {
                errorCallback(data);
            }
        }
    });
}

function chamarPostViaAjax(url, pData, successCallback, completeCallback, errorCallback) {
    $.ajax({
        type: 'POST',
        url: url,
        data: pData,
        cache: false,
        traditional: true,
        beforeSend: function () {
            //EM TESTE: remove as notificações anteriores (de cliente) para mostrar as vindas do servidor.
            $('div.padrao-de-validacao').addClass("validation-summary-valid").removeClass("validation-summary-errors").find('ul').empty();
            if ($(".NewDialog").length == 0)
                $('html,body').animate({ scrollTop: 0 }, 'slow');
        },
        success: function (dataRetorno) {
            successCallback(dataRetorno);
        },
        complete: function (dataRetorno) {
            if (typeof (completeCallback) == 'function') {
                completeCallback(dataRetorno);
            }
        },
        error: function (dataRetorno) {
            if (typeof (errorCallback) == 'function') {
                errorCallback(dataRetorno);
            }
        }
    });
}

function chamarPostViaAjaxComJson(url, pData, successCallback, completeCallback, errorCallback) {
    $.ajax({
        type: 'POST',
        url: url,
        data: pData,
        contentType: 'application/json',
        dataType: 'json',
        cache: false,
        traditional: true,
        success: function (dataRetorno) {
            successCallback(dataRetorno);
        },
        complete: function (dataRetorno) {
            if (typeof (completeCallback) == 'function') {
                completeCallback(dataRetorno);
            }
        },
        error: function (dataRetorno) {
            if (typeof (errorCallback) == 'function') {
                errorCallback(dataRetorno);
            }
        }
    });
}*/