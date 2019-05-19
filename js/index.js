$(document).ready(function(){
  $('.deltype').click(function(){
    var sender_type = $('input[name=sender_type]:checked').val();
    var recipient_type = $('input[name=recipient_type]:checked').val();


    if( sender_type == '2' ){
      $('select[name=sender_addr]').hide();
    }else{
      $('input[name=sender_addr_man]').hide();
      var selected_city = $('.city_sndr').val();
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
      var recipient_city = $('.city_rcvr').val();

      if( recipient_city == '1' ){
        $('.rcpnt[city=MSK]').hide();
      }else{
        $('.rcpnt[city=SPB]').hide();
      }
    }
    
  });

  $('.summary').click(function(){
    var sender_first_name = $('input[name=sender_f_name]').val();
    var sender_last_name = $('input[name=sender_l_name]').val();
    var sender_surname = $('input[name=sender_s_name]').val();
    var sender_pass = $('input[name=sender_pass]').val();
    var sender_city = $('.city_sndr').val();

    var recipient_first_name = $('input[name=f_name]').val();
    var recipient_last_name = $('input[name=l_name]').val();
    var recipient_surname = $('input[name=s_name]').val();
    var recipient_phone = $('input[name=phone]').val();
    var recipient_city = $('.city_rcvr').val();

    var sender_delivery_type = $('input[name=sender_type]:checked').val();
    var recipient_delivery_type = $('input[name=recipient_type]:checked').val();


    var sender_addr = $('input[name=sender_addr_man]').val();
    var recipient_addr = $('input[name=recipient_addr_man]').val();

    if(!sender_addr || sender_addr == ''){
      var sender_addr_title = $('input[name=sender_addr]:checked').text();
      sender_addr = $('input[name=sender_addr]:checked').val();
    }

    if(!recipient_addr || recipient_addr == ''){
      var recipient_addr_title = $('input[name=recipient_addr]:checked').text();
      recipient_addr = $('input[name=sender_addr]:checked').val();
    }

    console.log('sender_first_name', sender_first_name);
    console.log('sender_last_name', sender_last_name);
    console.log('sender_surname', sender_surname);
    console.log('sender_pass', sender_pass);
    console.log('sender_city', sender_city);
    console.log('recipient_first_name', recipient_first_name);
    console.log('recipient_last_name', recipient_last_name);
    console.log('recipient_surname', recipient_surname);
    console.log('recipient_phone',recipient_phone );
    console.log('recipient_city', recipient_city);
    console.log('sender_delivery_type', sender_delivery_type);
    console.log('recipient_delivery_type', recipient_delivery_type);
    console.log('sender_addr', sender_addr);
    console.log('recipient_addr', recipient_addr);
    console.log('sender_addr_title', sender_addr_title);
    console.log('recipient_addr_title', recipient_addr_title);

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

    if(currentSectionIndex === 4){
      $(document).find(".form-wrapper .section").first().addClass("is-active");
      $(document).find(".steps li").first().addClass("is-active");
    }
  });
});