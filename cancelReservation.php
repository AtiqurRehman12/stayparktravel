<?php 
session_start();
require_once './admin/inc/sqlfunctions.php';
if(isset($_GET["id"]) && isset($_GET["hotel"])){
    $id = $_GET["id"];
    $hotel = str_replace("-","&",$_GET["hotel"] );
    $reservation = select_where("guests", "id", $id , $connection, 1);
    $name = $reservation["first_name"] . " " . $reservation["last_name"];
    $number = $reservation["number"];
    $address = $reservation["address"];
    $dues = $reservation["dues"];
    $email = $_SESSION["email"];
    echo $hotel;
    $cancel_arr = array(
        "name" => $name,
        "number" => $number,
        "address" => $address,
        "dues" => $dues,
        "hotel" => $hotel,
    );
    insert_func("cancelled_reservations", $cancel_arr, $connection);

    delete_func("guests", $id, $connection);
    delete_where_fun("payment", "guest_id", $id, $connection);
    $message = "Your reservation at ". $hotel . " has been Cancelled.";
    $notification_arr = array(
        "message" => $message,
        "user_mail" => $email,
        "status" => 1,
    );
    insert_func("notifications", $notification_arr, $connection);
    header("location:userAccount.php");
}
?>