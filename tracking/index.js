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
  var obj = $.parseJSON(data);
  var sender_name = $('#sender_title');
  var sender_city = $('#sender_city');
  var sender_del = $('#sender_delivery');
  var recipient_name = $('#recipient_title');
  var recipient_city = $('#recipient_city');
  var recipient_delivery = $('#recipient_delivery');
  var status = $('#status');

  sender_name.text(obj.sender_title);
  sender_city.text(obj.sender_city);
  sender_del.text(obj.sender_type);

  recipient_name.text(obj.recipient_title);
  recipient_city.text(obj.recipient_city);
  recipient_delivery.text(obj.recipient_type);

  status.text(obj.status);

  $('.search').hide();
  $('.data_block').show();

}

document.addEventListener('DOMContentLoaded', function () {
    init();
});