<?php
require_once './inc/sqlfunctions.php';
$hotels = select_all("hotels", $connection);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once './inc/header.php' ?>
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
                            <h1 class="m-0">Hotels</h1>
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
                            <th scope="col">Location</th>
                            <th scope="col">Airport</th>
                            <th scope="col">Image</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach($hotels as $mainhotels){

                        ?>
                        <tr>
                            <th><?php echo $i ?></th>
                            <td><?php echo $mainhotels["name"] ?></td>
                            <td><?php echo $mainhotels["location"] ?></td>
                            <td><?php echo $mainhotels["airport"] ?></td>
                            <td><img src="<?php echo './hotel profile images/'. $mainhotels["image"] ?>" style="width: 100px;" alt=""></td>

                            <td>
                                <a href="deleteHotel.php?id=<?php echo $mainhotels["id"] ?>"><span class="fa fa-trash-alt text-danger"></span></a>
                                <a href="updateHotel.php?id=<?php echo $mainhotels["id"] ?>"><span class="fa fa-pen-alt text-success" ></span></a>
                            </td>
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