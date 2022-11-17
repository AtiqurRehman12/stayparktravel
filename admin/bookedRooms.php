<?php
require_once './inc/sqlfunctions.php';
$bookingSql = "SELECT guests.id, guests.first_name, guests.last_name , guests.email, guests.number, guests.address, guests.zip , guests.check_in, guests.check_out, guests.vehical_pickup, guests.room_type, guests.dues, guests.stay_nights, guests.room_num, guests.rooms, guests.adults, guests.children ,payment.card_number, payment.name_on_card, payment.payment_time, guests.hotel_id
FROM guests
INNER JOIN payment ON guests.id = payment.guest_id";
$bookingRes = mysqli_query($connection, $bookingSql);
if (mysqli_num_rows($bookingRes) > 0) {
    while ($bookingRow = mysqli_fetch_assoc($bookingRes)) {
        $bookingData[] = $bookingRow;
    }
}


?>
<?php
foreach ($bookingData as $delBooking) {
    if ($delBooking["check_out"] < date("Y-m-d")) {
        $delId = $delBooking["id"];
        echo $delId;
        delete_func("guests", $delId, $connection);
        delete_where_fun("payments", "guest_id", $delId, $connection);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once './inc/header.php' ?>
    <style>
        table {
            zoom: 50%;
        }

        td:hover {
            font-size: 30px;
            font-weight: bold;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->

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
                            <th scope="col">Check In</th>
                            <th scope="col">Check Out</th>
                            <th scope="col">Room</th>
                            <th scope="col">Room Number</th>
                            <th scope="col">No. of Rooms</th>
                            <th scope="col">Hotel Id</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($bookingData as $mainBookingData) {

                        ?>
                            <tr>
                                <th><?php echo $i ?></th>
                                <td><?php echo $mainBookingData["first_name"] . " " . $mainBookingData["last_name"] ?></td>
                                <td><?php echo $mainBookingData["check_in"] ?></td>
                                <td><?php echo $mainBookingData["check_out"] ?></td>
                                <td><?php echo $mainBookingData["room_type"] ?></td>
                                <td><?php echo $mainBookingData["room_num"] ?></td>
                                <td><?php echo $mainBookingData["rooms"] ?></td>
                                <td><?php echo $mainBookingData["hotel_id"] ?></td>

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