<?php

include 'db_handler.php';

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

die(var_dump($parcels));
?>
