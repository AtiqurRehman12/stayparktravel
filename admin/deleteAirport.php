<?php 
require_once './inc/sqlfunctions.php';
if(isset($_GET["id"])){
    $id = $_GET["id"];
    delete_func("airports", $id, $connection);
    header("location:viewAirports.php");
}
?>