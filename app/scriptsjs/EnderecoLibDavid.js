function EnderecoGoogleMaps(containerEndereco, onEnderecoChange, autocompleteType) {
    var _self = this;

    var googleMapsApiAutoComplete = null;    
    this.containerEndereco = containerEndereco;
    this.ID = $($(_self.containerEndereco).find("[fieldendereco='ID']")[0]);
    this.NomePais = $($(_self.containerEndereco).find("[fieldendereco='NomePais']")[0]);
    this.NomeEstado = $($(_self.containerEndereco).find("[fieldendereco='NomeEstado']")[0]);
    this.SiglaEstado = $($(_self.containerEndereco).find("[fieldendereco='SiglaEstado']")[0]);
    this.NomeMunicipio = $($(_self.containerEndereco).find("[fieldendereco='NomeMunicipio']")[0]);
    this.Cep = $($(_self.containerEndereco).find("[fieldendereco='Cep']")[0]);
    this.Logradouro = $($(_self.containerEndereco).find("[fieldendereco='Logradouro']")[0]);
    this.NumeroNoLogradouro = $($(_self.containerEndereco).find("[fieldendereco='NumeroNoLogradouro']")[0]);
    this.GooglePlaceId = $($(_self.containerEndereco).find("[fieldendereco='GooglePlaceId']")[0]);
    this.campoEndereco = $(_self.containerEndereco).find("[fieldendereco='Endereco']")[0];


    configurarGoogleMapsApi();

    function configurarGoogleMapsApi() {
        validarAutocompleteType();        

        googleMapsApiAutoComplete = new google.maps.places.Autocomplete(
            _self.campoEndereco,
            {
                types: [autocompleteType],
                componentRestrictions: { country: "br" }
            }
        );

        $(_self.campoEndereco).on('change', function () {
            if ($(this).val() == '') {
                preencherEndereco({});

                if (onEnderecoChange) {
                    onEnderecoChange($(_self.campoEndereco).val());
                }
            }
        });

        // When the user selects an address from the dropdown, populate the address fields in the form.
        google.maps.event.addListener(googleMapsApiAutoComplete, 'place_changed', onPlaceChanged);

        google.maps.event.addDomListener(_self.campoEndereco, 'keydown', function (e) {
            if (e.keyCode == 13) {
                e.preventDefault();
            }
        });
    }

    function validarAutocompleteType() {
        if (autocompleteType != '(cities)' && autocompleteType != '(regions)' && autocompleteType != 'address') {
            throw 'autocompleteType inválido.';
        }
    }

    function onPlaceChanged() {
        var place = googleMapsApiAutoComplete.getPlace();

        var endereco = obterEdereco(place);

        preencherEndereco(endereco);

        if (onEnderecoChange) {
            onEnderecoChange($(_self.campoEndereco).val());
        }
    }

    function preencherEndereco(endereco) {
        _self.NomePais.val(endereco.pais);
        _self.NomeEstado.val(endereco.nomeEstado);
        _self.SiglaEstado.val(endereco.siglaEstado);
        _self.NomeMunicipio.val(endereco.nomeCidade);
        _self.Cep.val(endereco.cep);
        _self.Logradouro.val(endereco.rua);
        _self.NumeroNoLogradouro.val(endereco.numero);
        _self.GooglePlaceId.val(endereco.place_id);
    }

    function obterEdereco(place) {
        var dadosEndereco = {};

        $.each(place.address_components, function (indice, item) {
            if (item.types[0] == 'administrative_area_level_1') { //estado
                dadosEndereco.siglaEstado = item.short_name;
                dadosEndereco.nomeEstado = item.long_name;
            }
            else if (item.types[0] == 'administrative_area_level_2') { //cidade
                dadosEndereco.nomeCidade = item.long_name;
            }
            else if (item.types[0] == 'country') {
                dadosEndereco.pais = item.long_name;
            }
            else if (item.types[0] == 'postal_code') {
                dadosEndereco.cep = item.short_name;
            }
            else if (item.types[0] == 'route') {
                dadosEndereco.rua = item.long_name;
            }
            else if (item.types[0] == 'street_number') {
                dadosEndereco.numero = item.short_name;
            }
        });

        dadosEndereco.enderecoFormatado = place.formatted_address;
        dadosEndereco.place_id = place.place_id;

        return dadosEndereco;
    }
}