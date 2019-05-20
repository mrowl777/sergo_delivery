<?php

include 'db_handler.php';


class OrderHandler extends db_handler {
        
    function get_points() {
        return $this->get_departaments( true );
    }

    function generate_parcel(){
        $sender_f_name = $_POST['sender_f_name'];
        $sender_l_name = $_POST['sender_l_name'];
        $sender_s_name = $_POST['sender_s_name'];
        $sender_pass = $_POST['sender_passport'];
        $sender_city = $_POST['sender_city_'];
        
    
        $recipient_f_name = $_POST['recipient_f_name'];
        $recipient_l_name = $_POST['recipient_l_name'];
        $recipient_surname = $_POST['recipient_s_name'];
        $recipient_phone = $_POST['recipient_number'];
        $recipient_city = $_POST['recipient_city_'];
    
        $sender_delivery_type = $_POST['sender_del_type'];
        $recipient_delivery_type = $_POST['recipient_del_type'];
    
        list( $sender_address, $recipient_address ) = $this->get_address($sender_delivery_type,  $recipient_delivery_type );

        $sid = $this->put_sender($sender_f_name,$sender_l_name,$sender_s_name,$sender_pass, $sender_delivery_type, $sender_city, $sender_address);
        $rid = $this->put_recipient($recipient_f_name,$recipient_l_name,$recipient_surname, $recipient_delivery_type, $recipient_city, $recipient_address, $recipient_phone);
        
        $track = sha1($sid . $rid . time());

        $this->put_parcel($sid, $rid, $track);

        die($track);
    }


    function get_parcel_data(){
        $track = $_POST['track_code'];
        $parcel = $this->get_parcel($track);
        $sender = $this->get_sender($parcel['sender_id']);
        $recipient = $this->get_recipient($parcel['recipient_id']);

        $status = $this->get_normal_status($parcel['status']);
        $sender_title = $sender['last_name'] . " " . $sender['first_name'];
        $recipient_title = $recipient['last_name'] . " " . $recipient['first_name'];
        $sender_city = $sender['city'] == '1' ? 'Санкт-Петербурга' : 'Москвы';
        $recipient_city = $recipient['city'] == '1' ? 'Санкт-Петербург' : 'Москву';
        $sender_type = $sender['delivery_type'] == '1' ? 'Самовывоз' : ' Курьером';
        $recipient_type = $recipient['delivery_type'] == '1' ? 'Самовывоз' : ' Курьером';

        $data = [
            'status' => $parcel['status'],
            'sender_title' => $sender_title,
            'sender_city' => $sender_city,
            'sender_type' => $sender_type,
            'recipient_title' => $recipient_title,
            'recipient_city' => $recipient_city,
            'recipient_type' => $recipient_type
        ];

        die(json_encode($data));
    }


    function get_address( $sender_delivery_type, $recipient_delivery_type ){
        $depataments = $this->get_departaments( true );

        $sender_address = $_POST['sender_departmet_point'];
        $recipient_address = $_POST['recipient_departmet_point'];

        if( iconv_strlen($sender_address) == 1 ){
            $sender_address = $depataments[$sender_address]; 
        }

        if( iconv_strlen($recipient_address) == 1 ){
            $recipient_address = $depataments[$recipient_address]; 
        }

        return array( $sender_address, $recipient_address );
    }
}

$mh = new OrderHandler();

if( isset($_POST) && $_POST['action'] == 'new_parcel' ){
    $mh->generate_parcel();
}elseif( isset($_POST) && $_POST['action'] == 'get_parcel' ){
    $mh->get_parcel_data();
}

?>

