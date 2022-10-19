<?php
require_once './inc/sqlfunctions.php';
$id = $_GET["id"];
$feature = select_where("features", "id", $id, $connection, 1);
if(isset($_POST["submit"])){


$fea_arr = array(
    "feature" => $_POST["feature"],
    "font_awesome" => $_POST["icon"]
);
$fea_con = array(
    "id" => $id,
);
update("features",$fea_arr, $fea_con, $connection);
header("location:viewFeatures.php");
}
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
                            <h1 class="m-0">Update Feature</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="col-11 mx-auto border">
                <form action="" method="post">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Feature Name</label>
                            <input type="text" class="form-control" name="feature" id="exampleInputEmail1" value="<?php echo $feature["feature"] ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Icon</label>
                            <input type="text" value="<?php echo $feature["font_awesome"] ?>" class="form-control" name="icon" id="exampleInputEmail1">
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="pb-3">
                        <button type="submit" name="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>

            </div>
            <div class="col-11 mx-auto mt-2">
                <a href="addHotel.php" class="btn btn-primary">Go back</a>
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