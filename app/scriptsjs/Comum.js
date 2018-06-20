function FormatarDataParaSalvar(date) {
    if (date) {
        var ano = date.substring(4);
        var mes = date.substring(2, 4);
        var dia = date.substring(0, 2);
        return ano + mes + dia;
    }
    else
        return '';
}

function FormatarDataParaExibir(date) {
    if (date) {
        if (date.indexOf('-') > -1) {
            var dateAux = date.split('-');
            var dia = dateAux[2];
            var mes = dateAux[1];
            var ano = dateAux[0];
            return dia + mes + ano;
        }
        else{            
            var dia = date.substring(6);
            var mes = date.substring(4,6);
            var ano = date.substring(0,4);
            return dia + mes + ano;
        }
    }
    else
        return '';
}