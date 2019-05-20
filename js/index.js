var sender_first_name, 
    sender_last_name,
    sender_surname,
    sender_pass,
    sender_city,
    recipient_first_name,
    recipient_last_name,
    recipient_surname,
    recipient_phone,
    recipient_city,
    sender_delivery_type,
    recipient_delivery_type,
    sender_addr,
    recipient_addr,
    sender_addr_title,
    recipient_addr_title;

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
    sender_first_name = $('input[name=sender_f_name]').val();
    sender_last_name = $('input[name=sender_l_name]').val();
    sender_surname = $('input[name=sender_s_name]').val();
    sender_pass = $('input[name=sender_pass]').val();
    sender_city = $('.city_sndr').val();

    recipient_first_name = $('input[name=f_name]').val();
    recipient_last_name = $('input[name=l_name]').val();
    recipient_surname = $('input[name=s_name]').val();
    recipient_phone = $('input[name=phone]').val();
    recipient_city = $('.city_rcvr').val();

    sender_delivery_type = $('input[name=sender_type]:checked').val();
    recipient_delivery_type = $('input[name=recipient_type]:checked').val();


    sender_addr = $('input[name=sender_addr_man]').val();
    recipient_addr = $('input[name=recipient_addr_man]').val();

    if(!sender_addr || sender_addr == ''){
      sender_addr_title = $('.sndr_addr option:selected').text();
      sender_addr = $('.sndr_addr').val();
    }

    if(!recipient_addr || recipient_addr == ''){
      recipient_addr_title = $('.rcvr_addr option:selected').text();
      recipient_addr = $('.rcvr_addr').val();
    }


    var sender_fio = sender_last_name + " " + sender_first_name + " " + sender_surname;
    var recipient_fio = recipient_last_name + " " + recipient_first_name + " " + recipient_surname;

    $('#result_sender_fio').text("ФИО:  " + sender_fio);
    $('#result_recipient_fio').text("ФИО:  " + recipient_fio);
    $('#result_sender_city').text("ГОРОД: " + sender_city);
    $('#result_recipient_city').text("ГОРОД: " + recipient_city);
    $('#result_recipient_phone').text("ТЕЛЕФОН: " + recipient_phone);
    if(sender_addr_title && sender_addr_title !== '' ){
      $('#result_sender_address').text("Адрес: " + sender_addr_title);
    }else{
      $('#result_sender_address').text("Адрес: " + sender_addr);
    }

    if(recipient_addr_title && recipient_addr_title !== '' ){
      $('#result_recipient_address').text("Адрес: " + recipient_addr_title);
    }else{
      $('#result_recipient_address').text("Адрес: " + recipient_addr);
    }


    if( sender_delivery_type == "1"){
      $('#result_sender_del_type').text("Доставка: самостоятельно на точку приема посылок");
    }else{
      $('#result_sender_del_type').text("Доставка: курьер свяжется для согласования времени");
    }

    if( recipient_delivery_type == "1"){
      $('#result_recipient_del_type').text("Доставка: забирает самостоятельно на точке приема посылок");
    }else{
      $('#result_recipient_del_type').text("Доставка: курьер свяжется для согласования времени");
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

    if(currentSectionIndex === 4){
      $(document).find(".form-wrapper .section").first().addClass("is-active");
      $(document).find(".steps li").first().addClass("is-active");
    }
  });

  $(".form-wrapper .done").click(function(){
    if(confirm("Вы уверены в правильности данных?")){
      $.post(
        "handler.php",
        {
            action: "new_parcel",
            sender_f_name: sender_first_name, 
            sender_l_name:sender_last_name,
            sender_s_name:sender_surname,
            sender_passport:sender_pass,
            sender_city_:sender_city,
            recipient_f_name:recipient_first_name,
            recipient_l_name:recipient_last_name,
            recipient_s_name:recipient_surname,
            recipient_number:recipient_phone,
            recipient_city_:recipient_city,
            sender_del_type:sender_delivery_type,
            recipient_del_type:recipient_delivery_type,
            sender_departmet_point:sender_addr,
            recipient_departmet_point:recipient_addr
        },
        on_answer
      );
    }
  });

});

function on_answer( data ){
  $('.result_data').hide();
  $('#track_code').text(data);
  $('.track_code').show();
}