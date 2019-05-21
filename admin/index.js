function init(){
    $('select').change(function() {
        var option = $(this).find('option:selected');
        var value = option.val();
        var id = $(this).parent().parent().attr('id');
        console.log(value);
        console.log(id);
    });
  }
  
  document.addEventListener('DOMContentLoaded', function () {
      init();
  });