<?php
require_once './inc/sqlfunctions.php';
$id = $_GET["id"];
delete_func("features", $id, $connection);
header("location:viewFeatures.php");
?>