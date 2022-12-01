<?php
require_once './inc/sqlfunctions.php';
if(isset($_GET["id"])){
    $id = $_GET["id"];
    delete_func("guests", $id, $connection);
    delete_where_fun("payment", "guest_id", $id, $connection);
    header("location:viewBookings.php");
}
?>