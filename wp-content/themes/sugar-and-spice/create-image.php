<?php
require_once(dirname(__FILE__).'/../../../wp-load.php');
global $wpdb;

$recId = $_GET['id'];

$results = $wpdb->get_results($wpdb->prepare("SELECT photo FROM $wpdb->recipes WHERE ID =%s",$recId));

if( $results!=null ){
        $row = $results[0]->photo;
        header("Content-Type: image/jpeg");
        echo $row;
}