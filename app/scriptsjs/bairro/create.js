$(function(){
    $('#estado_id').change(function(){        
        $.ajax({
            type: "POST",
            url: $('#urlCidadeDropDown').val(),
            data: {
                estado_id:$('#estado_id').val(),
                dropdownid:'cidade',
                dropdownname:'cidade'
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