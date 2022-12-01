<?php
session_start();
 require_once './admin/inc/sqlfunctions.php';
 if(!isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] != true){
    header("location:index.php");
 }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once './inc/header.php' ?>
    <style>
        th{
            color: darkorchid;
        }
    tr:hover{
        background-color: blueviolet;
    }
    tr:hover td{
        color: white;
    }
    td{
        color:darkblue;
    }
    table{
        zoom: 80%;
    }
    .fa-trash{
        cursor: pointer;
    }
    </style>
</head>
<body>
    <?php require_once './inc/navbar.php' ?> 
    <div class="col-11 mx-auto">
        <div class="col-12">
          <span class="font-weight-bold lato" >Hi <?php echo $_SESSION["username"] ?></span><span>! Here are the Reservations you have made</span>
        </div>
    <table class="table table-info">
  <thead class="">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Check In - Check Out</th>
      <th scope="col">Rooms</th>
      <th scope="col">Room Type</th>
      <th scope="col">Guests</th>
      <th scope="col">Hotel</th>
      <th scope="col">Dues</th>
      <th scope="col">Cancel Reservation</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $counter = 1;
    $email = $_SESSION["email"];
    $bookings = select_where_string("guests", "email", $email, $connection, 2);
    if(!empty($bookings)){

    foreach($bookings as $mainbooking){
        $checkin = date("D-m-y", strtotime($mainbooking["check_in"]));
        $checkout = date("D-m-y", strtotime($mainbooking["check_out"]));
        $hotel_id = $mainbooking["hotel_id"];
        $hotel = select_where("hotels", "id" , $hotel_id , $connection, 1);
    ?>
    <tr>
      <th scope="row"><?php echo $counter; ?></th>
      <td><?php echo $mainbooking["first_name"] . " " . $mainbooking["last_name"] ?></td>
      <td><?php echo $checkin . " to " . $checkout ?></td>
      <td><?php echo $mainbooking["rooms"] ?></td>
      <td><?php echo $mainbooking["room_type"] ?></td>
      <td><?php echo $mainbooking["adults"] + $mainbooking["children"] ?></td>
      <td><?php echo $hotel["name"] ?></td>
      <td><?php echo $mainbooking["dues"] ?></td>
      <td><a href="cancelReservation.php?id=<?php echo $mainbooking["id"] ?>&hotel=<?php echo str_replace("&","-",$hotel["name"]) ?>"><span class="fa fa-trash"></span></a></td>
    </tr>
    <?php
    $counter++;
    }
  }else{
    echo "No Reservations Made!";
  }
    ?>
  </tbody>
</table>
    </div>

<?php require_once './inc/footer.php' ?>
</body>
</html>