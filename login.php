<?php
session_start();
require_once './admin/inc/sqlfunctions.php';
if (isset($_POST["signup"])) {
    $signup_arr = array(
        "username" => $_POST["upname"],
        "password" => $_POST["uppass"],
        "email" => $_POST["upmail"],
    );
    insert_func("users", $signup_arr, $connection);
}
if(isset($_POST["signin"])){
    $email = $_POST["inmail"];
    $pass = $_POST["inpass"];
    $signInSql = "SELECT * FROM users WHERE email = '$email' AND `password` = '$pass'";
    $sigInRes = mysqli_query($connection, $signInSql);
    if(mysqli_num_rows($sigInRes)>0){
        $_SESSION["loggedIn"] = true;
        while($signInRow = mysqli_fetch_assoc($sigInRes)){
            $signInData[] = $signInRow;
        }
        $signInData = array_shift($signInData);
        $_SESSION["username"] = $signInData["username"];
        $_SESSION["email"] = $signInData["email"];
    }
    else{
        echo "wrong credientials";
    }
}
?>