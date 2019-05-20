<?php

include 'db_handler.php';

// if( isset($_POST) && $_POST['action'] == 'new_parcel' ){
//     return new MainHandler::generate_parcel();
// }elseif( isset($_POST) && $_POST['action'] == 'get_parcel' ){
//     return new MainHandler::get_parcel_data();
// }
$MainHandler = new MainHandler();
$a = $MainHandler->get_points();
echo(var_dump($a));
class MainHandler extends db_handler {


    function get_points() {
        $depataments = $this->get_departaments( true );
    }

    function generate_parcel(){
        $sender_f_name = $_POST['sender_first_name'];
        $sender_l_name = $_POST['sender_last_name'];
        $sender_s_name = $_POST['sender_surname'];
        $sender_pass = $_POST['sender_passport'];
        $sender_city = $_POST['sender_city'];
        
    
        $recipient_f_name = $_POST['recipient_first_name'];
        $recipient_l_name = $_POST['recipient_last_name'];
        $recipient_surname = $_POST['recipient_surname'];
        $recipient_phone = $_POST['recipient_phone'];
        $recipient_city = $_POST['recipient_city'];
    
        $sender_delivery_type = $_POST['sender_delivery_type'];
        $recipient_delivery_type = $_POST['recipient_delivery_type'];
    
        list( $sender_address, $recipient_address ) = $this->get_address( $sender_delivery_type,  $recipient_delivery_type );
        
        /**fullfill parcel data to db */
    
        /***generate, insert, return track-code */
    }


    function get_parcel_data(){
        $track = $_POST['track_code'];
    }


    function get_address( $sender_delivery_type, $recipient_delivery_type ){
        $depataments = $this->get_departaments( true );
        if( $sender_delivery_type == '1' ){
            $sender_address = $_POST['sender_departmet_point'];
        }else{
            $sender_address = $_POST['sender_address'];
        }

        if( $recipient_delivery_type == '1' ){
            $recipient_address = $_POST['sender_departmet_point'];
        }else{
            $recipient_address = $_POST['recipient_address'];
        }

        if( count($sender_address) == 1 ){
            $sender_address = $depataments[$sender_address]; 
        }

        if( count($recipient_address) == 1 ){
            $recipient_address = $depataments[$recipient_address]; 
        }

        return array( $sender_address, $recipient_address );
    }
}

?>

