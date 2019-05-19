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
      </ul>
      <form class="form-wrapper">
        <fieldset class="section is-active">
          <h3>Отправитель</h3>
          <input type="text" name="l_name" id="l_name" placeholder="Фамилия">
          <input type="text" name="f_name" id="f_name" placeholder="Имя">
          <input type="text" name="s_name" id="s_name" placeholder="Отчество">
          <input type="text" name="pass" id="pass" placeholder="Серия номер паспорта">
          <input type="text" name="city" id="city" placeholder="Город">
          <div class="button">Дальше</div>
        </fieldset>
        <fieldset class="section">
          <h3>Получатель</h3>
          <input type="text" name="l_name" id="l_name" placeholder="Фамилия">
          <input type="text" name="f_name" id="f_name" placeholder="Имя">
          <input type="text" name="s_name" id="s_name" placeholder="Отчество">
          <input type="text" name="city" id="city" placeholder="Город">
          <input type="text" name="phone" id="phone" placeholder="Телефон">
          <!-- <input class="submit button" type="submit" value="Sign Up"> -->
          <div class="button">Дальше</div>
        </fieldset>
        <fieldset class="section">
          Отправитель:
          <div class="row cf">
            <div class="four col">
              <input type="radio" name="sender_type" id="r1" checked>
              <label for="r1">
                <h4>Привезу в пункт приема</h4>
              </label>
            </div>
            <div class="four col">
              <input type="radio" name="sender_type" id="r2"><label for="r2">
                <h4>Вызвать курьера</h4>
              </label>
            </div>
          </div>
          Получатель: 
          <div class="row cf">
            <div class="four col">
              <input type="radio" name="recipient_type" id="d1" checked>
              <label for="d1">
                <h4>Забирает в пункте приема</h4>
              </label>
            </div>
            <div class="four col">
              <input type="radio" name="recipient_type" id="d2"><label for="d2">
                <h4>Курьером до двери</h4>
              </label>
            </div>
          </div>
          <div class="button deltype">Дальше</div>
        </fieldset>

        <fieldset class="section">
          <h3>Получатель</h3>
          <input type="text" name="sender_addr" id="sender_addr" placeholder="Адрес отправителя">
          <input type="text" name="recipient_addr" id="recipient_addr" placeholder="Адрес получателя">
          
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
