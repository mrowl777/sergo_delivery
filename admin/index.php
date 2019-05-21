<?php

    include '../db_handler.php';

    class ParcelManager extends db_handler {

        function get_parcels() {
            return $this->get_parcels_data();
        }

        function get_stats(){
            return $this->get_statuses();
        }
    }

    $pc = new ParcelManager();
    $parcels = $pc->get_parcels();
?>

<html >
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Admin panel</title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>

<body>
<?php
    foreach( $parcels as $each  )
    echo 'each<br/>';
        echo $each['recipient_fio'] ;
?>
    <!-- <table class="cinereousTable">
        <thead>
            <tr>
                <th>Отправитель</th>
                <th>Паспорт</th>
                <th>Город</th>
                <th>Адрес</th>
                <th>Получатель</th>
                <th>Телефон</th>
                <th>Город</th>
                <th>Адрес</th>
                <th>Статус</th>
            </tr>
        </thead>
        <tbody>
        <?php
            // foreach( $parcels as $each  )
            //     echo "<tr id='"."'>";
            //     echo "<td>" . $each['sender_fio'] . "</td>";
            //     echo "<td>" . $each['sender_passport'] . "</td>";
            //     echo "<td>" . $each['sender_city'] . "</td>";
            //     echo "<td>" . $each['sender_address'] . "</td>";
            //     echo "<td>" . $each['recipient_fio'] . "</td>";
            //     echo "<td>" . $each['recipient_phone'] . "</td>";
            //     echo "<td>" . $each['recipient_city'] . "</td>";
            //     echo "<td>" . $each['recipient_address'] . "</td>";
            //     echo "<td>" . $each['status'] . "</td>";
            //     echo "</tr>";
        ?>
        </tbody>
    </table> -->

  <script src='../jquery-3.4.0.js'></script>
  <script src="index.js"></script>
</body>
</html>

