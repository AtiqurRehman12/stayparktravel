<?php require_once './login.php'; ?>
<?php 
$userMail = $_SESSION["email"];
$userNotifications = select_where_string("notifications", "user_mail", $userMail, $connection, 2);
if(!empty($userNotifications)){

    $userNotifications = array_reverse($userNotifications);
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php require_once './inc/header.php'?>
<style>
    .notification:hover{
        transform: scale(1.05)translateY(-10px);
        transition: 0.3s;
        background-color: black!important;
        color: white;
    }
</style>    
</head>
<body>
<?php require_once './inc/navbar.php'?> 
<div class="col-10 mt-4 mx-auto bg-dark display-4 text-white lato text-center rounded">
    Notifications
</div>
<div class="col-10 mx-auto shadow-lg">
    <?php
    if(!empty($userNotifications)){
        foreach($userNotifications as $mainUserNotification){
    ?>
    <div class="row notification bg-light shadow p-2 mt-1">
        <div class="col-1">
            <span class="fa fa-user text-primary fa-2x" ></span>
        </div>
        <div class="col-10">
            <a href="userAccount.php" class="text-decoration-none"><?php echo $mainUserNotification["message"]; ?></a>
        </div>
        <div class="col-1">
            <a href="deleteNotification.php?id=<?php echo $mainUserNotification["id"]?>" class="fa fa-times text-decoration-none"></a>
        </div>
    </div>
    <?php
        }
    }
    ?>
</div>   
<?php require_once './inc/footer.php'?> 
<?php 
$readNotificationsSql = "UPDATE `notifications` SET `status` = 0 WHERE `status` = 1";
mysqli_query($connection,$readNotificationsSql);
?>   

</body>
</html>