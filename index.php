<?php
$db_name = 'u76899_devivery';
$db_host = 'localhost';
$db_user = 'u76899';
$db_pass = '3R3MTvbpeJNYiuq';


$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($mysqli->connect_errno) {
    echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
$mysqli->query("set names utf8");

$departs = $mysqli->query( "SELECT * FROM `departs`" );

$depataments = [];

while ($row = $departs->fetch_assoc()) {
  $depataments[] = array(
      'id' => $row["id"],
      'city' => $row["city"],
      'address' => $row["address"],
  );
}

mysqli_close( $mysqli );
?>


<html >
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Interactive Form</title>
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
      </ul>
      <form class="form-wrapper">
        <fieldset class="section is-active">
          <h3>Отправитель</h3>
          <input type="text" name="l_name" id="l_name" placeholder="Фамилия">
          <input type="text" name="f_name" id="f_name" placeholder="Имя">
          <input type="text" name="s_name" id="s_name" placeholder="Отчество">
          <input type="text" name="pass" id="pass" placeholder="Серия номер паспорта">
          <select class="addr_selector city_sndr" name="city_selector_sender">
            <option value='1'>Санкт-Петербург</option>
            <option value='2'>Москва</option>
          </select>
          <div class="button">Дальше</div>
        </fieldset>
        <fieldset class="section">
          <h3>Получатель</h3>
          <input type="text" name="l_name" id="l_name" placeholder="Фамилия">
          <input type="text" name="f_name" id="f_name" placeholder="Имя">
          <input type="text" name="s_name" id="s_name" placeholder="Отчество">
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
          <h3>Получатель</h3>
          <input type="text" name="sender_addr_man" id="sender_addr" placeholder="Адрес отправителя">
          
          <select class="addr_selector" name="sender_addr">
          <?php
              echo '<option disabled selected>Выберите адрес</option>';
            foreach( $depataments as $each ){
              echo "<option class='sndr' value='".$each['id']."' city='".$each['city']."'>".$each['address']."</option>";
            }
          ?>
          </select>

          <input type="text" name="recipient_addr_man" id="recipient_addr" placeholder="Адрес получателя">
          <select class="addr_selector" name="recipient_addr">
            <?php
                echo '<option disabled selected>Выберите адрес</option>';
              foreach( $depataments as $each ){
                echo "<option class='rcpnt' value='".$each['id']."' city='".$each['city']."'>".$each['address']."</option>";
              }
            ?>
          </select>

          <div class="button">Дальше</div>
        </fieldset>
        
        <fieldset class="section">
          <h3>Account Created!</h3>
          <p>Your account has now been created.</p>
          <div class="button">Reset Form</div>
        </fieldset>
      </form>
    </div>
  </div>
  <script src='jquery-3.4.0.js'></script>

  <script src="js/index.js"></script>

</body>
</html>
