<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once './inc/header.php' ?>
    <style>
        .card img{
            height: 200px!important;
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
                            <h1 class="m-0">Dashboard</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="col-11 mx-auto">
                <div class="row">
                    <div class="col-4">
                        <div class="card" style="width: 18rem;">
                            <a href="addHotel.php" class="card-text h4"><img class="card-img-top" src="./adminimages/136007469074.jpg" alt="Card image cap"></a>
                            <div class="card-body text-center">
                                <a class="card-text h4" href="addHotel.php">Add Hotel</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card" style="width: 18rem;">
                            <a href="addAirport.php" class="card-text h4"><img class="card-img-top" src="./adminimages/portland-international-airport-00-USAIRPORTSWB21-35b7a73d8c0c4a86a9f9e5b27a7c3bbe.jpg" alt="Card image cap"></a>
                            <div class="card-body text-center">
                                <a class="card-text h4" href="addAirport.php">Add Airport</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card" style="width: 18rem;">
                            <a href="viewHotels.php" class="card-text h4"><img class="card-img-top" src="./adminimages/three-stars-hotel-text-d-concept-white-61086205.jpg" alt="Card image cap"></a>
                            <div class="card-body text-center">
                                <a class="card-text h4" href="viewHotels.php">View Hotels</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card" style="width: 18rem;">
                            <a href="addService.php" class="card-text text-center h4"><img class="card-img-top w-50" src="./adminimages/download.png" alt="Card image cap"></a>
                            <div class="card-body text-center">
                                <a class="card-text h4" href="addService.php">Add Services</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card" style="width: 18rem;">
                            <a href="addFeature.php" class="card-text text-center h4"><img class="card-img-top w-50" src="./adminimages/vector-icon-settings-feature-thin-line-sign-isolated-contour-symbol-illustration-167525346.jpg" alt="Card image cap"></a>
                            <div class="card-body text-center">
                                <a class="card-text h4" href="addFeature.php">Add Feature</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card" style="width: 18rem;">
                            <a href="addSeason.php" class="card-text text-center h4"><img class="card-img-top w-50" src="./adminimages/flat-clock-icon-png-7.jpg" style="height: 100px;" alt="Card image cap"></a>
                            <div class="card-body text-center">
                                <a class="card-text h4" href="addSeason.php">Add Hotel Season</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card" style="width: 18rem;">
                            <a href="viewBookings.php" class="card-text text-center h4"><img class="card-img-top w-50" src="./adminimages/127528463-booking-icon-vector-illustration (1).webp" style="height: 100px;" alt="Card image cap"></a>
                            <div class="card-body text-center">
                                <a class="card-text h4" href="viewBookings.php">Bookings</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021<a href="https://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>

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