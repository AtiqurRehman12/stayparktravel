<?php
require_once './admin/inc/sqlfunctions.php';
if(isset($_GET["id"])){
    $id = $_GET["id"];
    delete_func("notifications", $id, $connection);
    header("location:notifications.php");
}
?>