<?php
require_once './inc/sqlfunctions.php';
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $hotels = select_where("hotels","id", $id, $connection, 1);
    $images = select_where("hotel_images", "hotel_id", $id, $connection, 2);
    unlink('./hotel profile images/'.$hotels["image"]);
    foreach($images as $mainImages){
        unlink('./hotel detail images/'.$mainImages["images"]);
    }
    delete_where_fun("hotels", "id", $id, $connection);
    delete_where_fun("hotel_rates", "hotel_id", $id, $connection);
    delete_where_fun("hotel_services", "hotel_id", $id, $connection);
    delete_where_fun("hotel_features", "hotel_id", $id, $connection);
    delete_where_fun("hotel_images", "hotel_id", $id, $connection);
    header("location:viewHotels.php");
}
