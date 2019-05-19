
var search_button = $('.icon-search'),
    close_button  = $('.icon-times'),
    input = $('.input');
    console.log(search_button);
search_button.on('click',function(){
  console.log('clc');
  $(this).parent().addClass('open');
  close_button.fadeIn(500);
  input.fadeIn(500);
});

close_button.on('click',function(){
  search_button.parent().removeClass('open');
  close_button.fadeOut(500);
  input.fadeOut(500);
});
