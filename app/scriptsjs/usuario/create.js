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

  $('#usuarioform').submit(function () {    
    $('.datas').each(function () {
      $(this).val(FormatarDataParaSalvar($(this).cleanVal()));
    });
    $('#telefone').val($('#telefone').cleanVal());
    $('#telefonecel').val($('#telefonecel').cleanVal());
    $('#cpf').val($('#cpf').cleanVal());
    $('#identidade').val($('#identidade').cleanVal());
    return true;
  });

  

});