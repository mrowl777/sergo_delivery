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

    function put_sender($fn,$ln,$sn,$ps,$dt,$ct){
        $query_fields = "INSERT INTO `senders`(`id`, `first_name`, `last_name`, `surname`, `passport`, `delivery_type`, `City`, `date`, `adress`) VALUES ";
        $query_vals = "('','".$fn."','".$ln."','".$sn."','".$ps."','".$dt."','".$ct."','','".$ad."')";
        $db_helper = $this->connect_db();
        $db_helper->query( $query_fields . $query_vals );

        $query = "SELECT `id` FROM `senders` WHERE  `first_name` = '".$fn."' AND `last_name` = '".$ln."' AND `passport` = '".$ps."'";
        $uid = $db_helper->query( $query );
        $uid = $uid->fetch_assoc();
        $this->close_connection( $db_helper );

        return $uid['id'];
    }

    function put_recipient($fn,$ln,$sn,$dt,$ct,$ph){
        $query_fields = "INSERT INTO `recipients`(`id`, `first_name`, `last_name`, `surname`, `delivery_type`, `city`, `address`, `phone`) VALUES ";
        $query_vals = "('','".$fn."','".$ln."','".$sn."','".$dt."','".$ct."','','".$ad."', '".$ph."')";
        $db_helper = $this->connect_db();
        $db_helper->query( $query_fields . $query_vals );

        $query = "SELECT `id` FROM `recipients` WHERE  `first_name` = '".$fn."' AND `last_name` = '".$ln."' AND  `phone` ='".$ph."'";
        $uid = $db_helper->query( $query );
        $uid = $uid->fetch_assoc();
        $this->close_connection( $db_helper );

        return $uid['id'];
    }

    function put_parcel($sid, $rid, $track){
        $query = "INSERT INTO `packets`(`id`, `sender_id`, `recipient_id`, `who_pays`, `track`) VALUES ('','".$sid."','".$rid."','','".$track."')";
        $db_helper = $this->connect_db();
        $db_helper->query( $query );
        $this->close_connection( $db_helper );
    }
    

}

?>