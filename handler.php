<?php
include __DIR__ . 'ini.php';
if( isset($_POST) && $_POST['action'] == 'new_parcel' ){
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

    list( $sender_address, $recipient_address ) = get_address( $sender_delivery_type,  $recipient_delivery_type );
    
    /**fullfill parcel data to db */

    /***generate, insert, return track-code */
}

if( isset($_POST) && $_POST['action'] == 'get_parcel' ){
    $track = $_POST['track_code'];
}

function get_address( $sender_delivery_type, $recipient_delivery_type ){
    if( $sender_delivery_type == '1' ){
        //samovivoz
        $sender_address = $_POST['sender_departmet_point'];
    }else{
        //kyr'er
        $sender_address = $_POST['sender_address'];
    }

    if( $recipient_delivery_type == '1' ){
        //samovivoz
        $recipient_address = $_POST['sender_departmet_point'];
    }else{
        //kyr'er
        $recipient_address = $_POST['recipient_address'];
    }

    if( count($sender_address) == 1 ){
        $sender_address = ''; //get addr from mysql;
    }

    if( count($recipient_address) == 1 ){
        $recipient_address = ''; //get addr from mysql;
    }

    return array( $sender_address, $recipient_address );
}




?>