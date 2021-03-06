<?php

include 'db_handler.php';

class ParcelCreator extends db_handler {

  function get_points() {
    return $this->get_departaments();
  }

}

?>


<html >
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Оформление</title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="container">
    <div class="wrapper">
      <ul class="steps">
        <li class="is-active">Шаг 1</li>
        <li>Шаг 2</li>
        <li>Шаг 3</li>
        <li>Шаг 4</li>
        <li>Звершение</li>
      </ul>
      <form class="form-wrapper">
        <fieldset class="section is-active">
          <h3>Отправитель</h3>
          <input type="text" name="sender_l_name"  placeholder="Фамилия">
          <input type="text" name="sender_f_name" placeholder="Имя">
          <input type="text" name="sender_s_name" placeholder="Отчество">
          <input type="text" name="sender_pass"  placeholder="Серия номер паспорта">
          <select class="addr_selector city_sndr" name="city_selector_sender">
            <option value='1'>Санкт-Петербург</option>
            <option value='2'>Москва</option>
          </select>
          <div class="track"> <h4>Уже отправили посылку?</h4> <a href="/sergo_delivery/tracking">Отследить</a> </div>
          <div class="button">Дальше</div>
        </fieldset>
        <fieldset class="section">
          <h3>Получатель</h3>
          <input type="text" name="l_name" placeholder="Фамилия">
          <input type="text" name="f_name"  placeholder="Имя">
          <input type="text" name="s_name"  placeholder="Отчество">
          <select class="addr_selector city_rcvr" name="city_selector_recipient">
            <option value='1'>Санкт-Петербург</option>
            <option value='2'>Москва</option>
          </select>
          <input type="text" name="phone" id="phone" placeholder="Телефон">
          <div class="button">Дальше</div>
        </fieldset>
        <fieldset class="section">
          Отправитель:
          <div class="row cf">
            <div class="four col">
              <input type="radio" name="sender_type" id="r1" value="1" checked>
              <label for="r1">
                <h4>Привезу в пункт приема</h4>
              </label>
            </div>
            <div class="four col">
              <input type="radio" name="sender_type" value="2" id="r2"><label for="r2">
                <h4>Вызвать курьера</h4>
              </label>
            </div>
          </div>
          Получатель: 
          <div class="row cf">
            <div class="four col">
              <input type="radio" name="recipient_type" value="1" id="d1" checked>
              <label for="d1">
                <h4>Забирает в пункте приема</h4>
              </label>
            </div>
            <div class="four col">
              <input type="radio" name="recipient_type" value="2" id="d2"><label for="d2">
                <h4>Курьером до двери</h4>
              </label>
            </div>
          </div>
          <div class="button deltype">Дальше</div>
        </fieldset>

        <fieldset class="section">
          <input type="text" name="sender_addr_man" id="sender_addr" placeholder="Адрес отправителя">
          
          <select class="addr_selector sndr_addr" name="sender_addr">
          <?php
              echo '<option disabled selected>Выберите пункт приема посылок</option>';
            $pc = new ParcelCreator();
            $depataments = $pc->get_points();
            foreach( $depataments as $each ){
              echo "<option class='sndr' value='".$each['id']."' city='".$each['city']."'>".$each['address']."</option>";
            }
          ?>
          </select>

          <input type="text" name="recipient_addr_man" id="recipient_addr" placeholder="Адрес получателя">
          <select class="addr_selector rcvr_addr" name="recipient_addr">
            <?php
                echo '<option disabled selected>Выберите пункт выдачи посылок</option>';
              $pc = new ParcelCreator();
              $depataments = $pc->get_points();
              foreach( $depataments as $each ){
                echo "<option class='rcpnt' value='".$each['id']."' city='".$each['city']."'>".$each['address']."</option>";
              }
            ?>
          </select>

          <div class="button summary">Дальше</div>
        </fieldset>
        
        <fieldset class="section">

          <div class="result_data">
              <div>
                <h2>Отправитель</h2>
                <p id="result_sender_fio"></p>
                <p id="result_sender_city"></p>
                <p id="result_sender_address"></p>
                <p id="result_sender_del_type"></p>
              </div>

              <div style="margin-bottom: 50px;">
                <h2>Получатель</h2>
                <p id="result_recipient_fio"></p>
                <p id="result_recipient_city"></p>
                <p id="result_recipient_phone"></p>
                <p id="result_recipient_address"></p>
                <p id="result_recipient_del_type"></p>
              </div>

              <div class="done">Все верно</div>
              <div class="button">Начать с начала</div>
          </div>

          <div class="track_code">
            <h2>Ваш номер отслеживания:</h2>
            <h2 id="track_code"></h2>
          </div>
        </fieldset>
      </form>
    </div>
  </div>
  <script src='jquery-3.4.0.js'></script>

  <script src="js/index.js"></script>

</body>
</html>
