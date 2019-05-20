<?php
class db_handler {

    function connect_db(){
        include __DIR__ . '/ini.php';
        
        $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

        if ($mysqli->connect_errno) {
            echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        }
        $mysqli->query("set names utf8");

        return $mysqli;
    }

    function close_connection( $mysqli ){
        mysqli_close( $mysqli );
    }

    function get_departaments( $simple_format = false){

        $db_helper = $this->connect_db();
        $departs = $db_helper->query( "SELECT * FROM `departs`" );
        $this->close_connection( $db_helper );
    
        $depataments = [];

        if( $simple_format ){
            while ($row = $departs->fetch_assoc()) {
                $depataments[$row["id"]] = $row["address"];
            }
        }else{
            while ($row = $departs->fetch_assoc()) {
                $depataments[] = array(
                    'id' => $row["id"],
                    'city' => $row["city"],
                    'address' => $row["address"],
                );
            }
        }    

        return $depataments;
    }
    

}

?>