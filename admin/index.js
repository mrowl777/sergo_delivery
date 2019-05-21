function init(){
    $('select').change(function() {
        var option = $(this).find('option:selected');
        var value = option.val();
        var _id = $(this).parent().parent().attr('id');

        $.post(
            "../handler.php",
            {
                action: "update_status",
                id: _id,
                status: value
            },
            on_answer
          );
    });
  }

  function on_answer( data ){
    alert('Статус обновлен');
  }
  
  document.addEventListener('DOMContentLoaded', function () {
      init();
  });