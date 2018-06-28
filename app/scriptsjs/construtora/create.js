$(function () {
	$('#telefone').mask('(00) 0000-0000');
	$('#telefonecel').mask('(00) 00000-0000');

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
	$('#construtoraform').submit(function () {		
		$('#telefone').val($('#telefone').cleanVal());
		$('#telefonecel').val($('#telefonecel').cleanVal());		
		return true;
	});
});
