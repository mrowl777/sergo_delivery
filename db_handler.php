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

    function put_sender($fn,$ln,$sn,$ps,$dt,$ct, $ad){
        $query_fields = "INSERT INTO `senders`(`id`, `first_name`, `last_name`, `surname`, `passport`, `delivery_type`, `City`, `date`, `adress`) VALUES ";
        $query_vals = "('','".$fn."','".$ln."','".$sn."','".$ps."','".$dt."','".$ct."', CURRENT_TIMESTAMP ,'".$ad."')";
        $db_helper = $this->connect_db();
        $db_helper->query( $query_fields . $query_vals );

        $query = "SELECT `id` FROM `senders` WHERE  `first_name` = '".$fn."' AND `last_name` = '".$ln."' AND `passport` = '".$ps."'";
        $uid = $db_helper->query( $query );
        $uid = $uid->fetch_assoc();
        $this->close_connection( $db_helper );

        return $uid['id'];
    }

    function put_recipient($fn,$ln,$sn,$dt,$ct, $ad,$ph){
        $query_fields = "INSERT INTO `recipients`(`id`, `first_name`, `last_name`, `surname`, `delivery_type`, `city`, `address`, `phone`) VALUES ";
        $query_vals = "('','".$fn."','".$ln."','".$sn."','".$dt."','".$ct."','".$ad."', '".$ph."')";
        $db_helper = $this->connect_db();
        $db_helper->query( $query_fields . $query_vals );

        $query = "SELECT `id` FROM `recipients` WHERE  `first_name` = '".$fn."' AND `last_name` = '".$ln."' AND  `phone` ='".$ph."'";
        $uid = $db_helper->query( $query );
        $uid = $uid->fetch_assoc();
        $this->close_connection( $db_helper );

        return $uid['id'];
    }

    function put_parcel($sid, $rid, $track){
        $query = "INSERT INTO `packets`(`id`, `sender_id`, `recipient_id`, `status`, `track`) VALUES ('','".$sid."','".$rid."','1','".$track."')";
        $db_helper = $this->connect_db();
        $db_helper->query( $query );
        $this->close_connection( $db_helper );
    }

    function get_parcel($track){
        $query = "SELECT `id`, `sender_id`, `recipient_id`, `status` FROM `packets` WHERE `track` = '".$track."'";
        $db_helper = $this->connect_db();
        $parcel = $db_helper->query( $query );
        $this->close_connection( $db_helper );
        $parcel = $parcel->fetch_assoc();
        return $parcel;
    }
    
    function get_sender($id){
        $query = "SELECT `first_name`, `last_name`, `delivery_type`, `City` FROM `senders` WHERE `id` = '".$id."'";
        $db_helper = $this->connect_db();
        $sender = $db_helper->query( $query );
        $this->close_connection( $db_helper );
        $sender = $sender->fetch_assoc();
        return $sender;
    }

    function get_recipient($id){
        $query = "SELECT  `first_name`, `last_name`, `delivery_type`, `city` FROM `recipients` WHERE `id` = '".$id."'";
        $db_helper = $this->connect_db();
        $recipient = $db_helper->query( $query );
        $this->close_connection( $db_helper );
        $recipient = $recipient->fetch_assoc();
        return $recipient;
    }

    function get_normal_status($id){
        $query = "SELECT `status` FROM `statuses` WHERE `id` = '".$id."'";
        $db_helper = $this->connect_db();
        $status = $db_helper->query( $query );
        $this->close_connection( $db_helper );
        $status = $status->fetch_assoc();
        return $status['status'];
    }

    function get_statuses(){
        $query = "SELECT * FROM `statuses` WHERE 1";
        $db_helper = $this->connect_db();
        $statuses = $db_helper->query( $query );
        $this->close_connection( $db_helper );
        $data = [];
        while ($row = $departs->fetch_assoc()) {
            $data[$row["id"]] = $row["status"];
        }
        return $data;
    }

    function get_parcels_data(){
        $query = "SELECT * FROM `packets` WHERE 1";
        $db_helper = $this->connect_db();
        $parcels = $db_helper->query( $query );
        $data = [];
        while ($row = $parcels->fetch_assoc()) {
            $sid = $row['sender_id'];
            $rid = $row['recipient_id'];
            $query = "SELECT `first_name`, `last_name`, `surname`, `passport`, `delivery_type`, `City`, `adress` FROM `senders` WHERE `id` = '".$sid."'";
            $sender = $db_helper->query( $query );
            $sender = $sender->fetch_assoc();


            $sender_fio = $sender['last_name'] . " " . $sender['first_name']. " " . $sender['surname'];
            
            if( $sender['delivery_type'] == 1 ){
                $sender_address = 'Cамовывоз: ' . $sender['adress'];
            }else{
                $sender_address = 'Доставка: ' . $sender['adress'];
            }

            $sender_city = $this->build_address($sender['City']);


            $query = "SELECT `first_name`, `last_name`, `surname`, `delivery_type`, `city`, `address`, `phone` FROM `recipients` WHERE `id` = '".$rid."'";
            $recipient = $db_helper->query( $query );
            $recipient = $recipient->fetch_assoc();

            $recipient_fio = $recipient['last_name'] . " " . $recipient['first_name']. " " . $recipient['surname'];
            $recipient_city = $this->build_address($recipient['City']);


            if( $recipient['delivery_type'] == 1 ){
                $recipient_address = 'Cамовывоз: ' . $recipient['address'];
            }else{
                $recipient_address = 'Доставка: ' . $recipient['address'];
            }

            $data[$row['id']] = [
                'sender_fio' => $sender_fio,
                'recipient_fio' => $recipient_fio,
                'sender_city' => $sender_city,
                'recipient_city' => $recipient_city,
                'sender_passport' => $sender['passport'],
                'recipient_phone' => $recipient['phone'],
                'sender_address' => $sender_address,
                'recipient_address' => $recipient_address,
                'status' => $row['status']
            ];
        }

        $this->close_connection( $db_helper );

        return $data;
        
    }

    function build_address( $target ){
        if($target == 1){
            $city = 'Санкт-Петербург';
        }else{
            $city = 'Москва';
        }
        return $city;
    }

}

?>