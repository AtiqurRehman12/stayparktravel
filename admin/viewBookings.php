<?php
require_once './inc/sqlfunctions.php';
$bookingSql = "SELECT guests.first_name, guests.last_name , guests.email, guests.number, guests.address, guests.zip , guests.check_in, guests.check_out, guests.vehical_pickup, guests.room_type, guests.dues, guests.stay_nights, guests.rooms, guests.adults, guests.children ,payment.card_number, payment.name_on_card, payment.payment_time
FROM guests
INNER JOIN payment ON guests.id = payment.guest_id";
$bookingRes = mysqli_query($connection, $bookingSql);
if(mysqli_num_rows($bookingRes)>0){
    while($bookingRow = mysqli_fetch_assoc($bookingRes)){
        $bookingData[] = $bookingRow;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once './inc/header.php' ?>
    <style>
       table{
        zoom: 50%;
       }
       td:hover{
        font-size: 30px;
        font-weight: bold;
       }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <?php './inc/navbar.php' ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php require_once './inc/cleanSidebar.php' ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Bookings</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="col-11 mx-auto border">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone#</th>
                            <th scope="col">Address</th>
                            <th scope="col">Zip</th>
                            <th scope="col">Stay Dates</th>
                            <th scope="col">Vehical PickUp</th>
                            <th scope="col">Check In</th>
                            <th scope="col">Check Out</th>
                            <th scope="col">Room</th>
                            <th scope="col">No. of Rooms</th>
                            <th scope="col">No. of Adults/Children</th>
                            <th scope="col">Dues</th>
                            <th scope="col">Name on Card</th>
                            <th scope="col">Card Number</th>
                            <th scope="col">Payment Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach($bookingData as $mainBookingData){

                        ?>
                        <tr>
                            <th><?php echo $i ?></th>
                            <td><?php echo $mainBookingData["first_name"] . " " . $mainBookingData["last_name"] ?></td>
                            <td><?php echo $mainBookingData["email"] ?></td>
                            <td><?php echo $mainBookingData["number"] ?></td>
                            <td><?php echo $mainBookingData["address"] ?></td>
                            <td><?php echo $mainBookingData["zip"] ?></td>
                            <td><?php echo $mainBookingData["check_in"] . " - " . $mainBookingData["check_out"] ?></td>
                            <td><?php echo $mainBookingData["vehical_pickup"] ?></td>
                            <td><?php echo $mainBookingData["check_in"] ?></td>
                            <td><?php echo $mainBookingData["check_out"] ?></td>
                            <td><?php echo $mainBookingData["room_type"] ?></td>
                            <td><?php echo $mainBookingData["rooms"] ?></td>
                            <td><?php echo $mainBookingData["adults"] . " Adults ," . $mainBookingData["children"] . " Children" ?></td>
                            <td><?php echo $mainBookingData["dues"] . "$" ?></td>
                            <td><?php echo $mainBookingData["name_on_card"]?></td>
                            <td><?php echo $mainBookingData["card_number"]?></td>
                            <td><?php echo $mainBookingData["payment_time"]?></td>
                        </tr>
                        <?php
                        $i++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-11 mx-auto mt-2">
                <a href="addFeature.php" class="btn btn-primary">Go back</a>
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php require_once './inc/commonfooter.php' ?>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <?php require_once './inc/footer.php' ?>
</body>

</html>