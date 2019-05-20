function init(){
  var search_button = $('.icon-search'),
    close_button  = $('.close'),
    input = $('.input');
  search_button.on('click',function(){
    $(this).parent().addClass('open');
    close_button.fadeIn(500);
    input.fadeIn(500);
  });

  close_button.on('click',function(){
    search_button.parent().removeClass('open');
    close_button.fadeOut(500);
    input.fadeOut(500);
  });

  $( input ).on( 'keyup', function keyup( e ) {
    if( e.keyCode == 13 ){
      get_data(input.val());
    }
  });

  var GET = window.location.search.replace( '?', ''); 
  if( GET ){
    var arr = GET.split('=');
    var code = arr[1];
    if(code && code != ''){
      get_data( code );
    }
  }

}

function get_data( code ){
  $.post(
    "../handler.php",
    {
        action: "get_parcel",
        track_code: code
    },
    on_answer
  );
}

function on_answer(data){
  alert(data);
}

document.addEventListener('DOMContentLoaded', function () {
    init();
});