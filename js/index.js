$(document).ready(function(){
  $('.deltype').click(function(){
    var sender_type = $('input[name=sender_type]:checked').val();
    var recipient_type = $('input[name=recipient_type]:checked').val();


    if( sender_type == '2' ){
      $('select[name=sender_addr]').hide();
    }else{
      $('input[name=sender_addr_man]').hide();
      var selected_city = $('input[name=city_selector_sender]:checked').val();
      console.log($('.city_sndr:checked'));
      if( selected_city == '1' ){
        $('.sndr[city=MSK]').hide();
      }else{
        $('.sndr[city=SPB]').hide();
      }
    }

    if( recipient_type == '2' ){
      $('select[name=recipient_addr]').hide();
    }else{
      $('input[name=recipient_addr_man]').hide();
      var recipient_city = $('input[name=city_selector_recipient]:checked').val();
      console.log($('.city_rcvr:checked'));

      if( recipient_city == '1' ){
        $('.rcpnt[city=MSK]').hide();
      }else{
        $('.rcpnt[city=SPB]').hide();
      }
    }
    
  });

  $(".form-wrapper .button").click(function(){
    var button = $(this);
    var currentSection = button.parents(".section");
    var currentSectionIndex = currentSection.index();
    var headerSection = $('.steps li').eq(currentSectionIndex);
    currentSection.removeClass("is-active").next().addClass("is-active");
    headerSection.removeClass("is-active").next().addClass("is-active");

    $(".form-wrapper").submit(function(e) {
      e.preventDefault();
    });

    if(currentSectionIndex === 3){
      $(document).find(".form-wrapper .section").first().addClass("is-active");
      $(document).find(".steps li").first().addClass("is-active");
    }
  });
});