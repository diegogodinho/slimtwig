$(function () {
	CropperHelper().LoadImage();

	$('.datas').each(function () {
		$(this).val(FormatarDataParaExibir($(this).val()));
	});
	$('.datas').mask('00/00/0000');
	$('#telefone').mask('(00) 0000-0000');
	$('#telefonecel').mask('(00) 00000-0000');
	$('#cpf').mask('000.000.000-00', { reverse: true });
	$('#identidade').mask('ZZ-00.000.000', {
		translation: {
			'Z': {
				pattern: /[a-zA-Z]/, optional: false
			}
		}
	});

	$('#estado_id').change(function () {
		$('#cidade').val('');
		$('#bairro_id').val('');
		$.ajax({
			type: "POST",
			url: $('#urlCidadeDropDown').val(),
			data: {
				estado_id: $('#estado_id').val(),
				dropdownid: 'cidade',
				dropdownname: 'cidade'
			},
			success: function (data) {
				$('#areaCidadeDropDown').html('');
				$('#areaCidadeDropDown').html(data);
				$('#cidade').change(onChangeCidade);
			},
			error: function (data) {
				console.log(data);
			}
		});
	});

	$('#cidade').change(onChangeCidade);

	function onChangeCidade() {
		$('#bairro_id').val('');
		$.ajax({
			type: "POST",
			url: $('#urlBairroDropDown').val(),
			data: {
				cidade_id: $('#cidade').val(),
				dropdownid: 'bairro',
				dropdownname: 'bairro'
			},
			success: function (data) {
				$('#areaBairroDropDown').html('');
				$('#areaBairroDropDown').html(data);
			},
			error: function (data) {
				console.log(data);
			}
		});
	};




	$('#usuarioform').submit(function () {
		$('.datas').each(function () {
			$(this).val(FormatarDataParaSalvar($(this).cleanVal()));
		});
		$('#telefone').val($('#telefone').cleanVal());
		$('#telefonecel').val($('#telefonecel').cleanVal());
		$('#cpf').val($('#cpf').cleanVal());
		return true;
	});



});
