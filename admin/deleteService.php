<?php
require_once './inc/sqlfunctions.php';
$id = $_GET["id"];
delete_func("services", $id, $connection);
header("location:viewFeatures.php");
?>