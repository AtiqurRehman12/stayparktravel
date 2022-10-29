<?php
require_once './inc/sqlfunctions.php';
if(isset($_GET["id"])){
    $id = $_GET["id"];
    $season = select_where("seasons", "id" , $id , $connection, 1);
}
if(isset($_POST["submit"])){
   $sea_arr = array(
    "name" => $_POST["name"],
    "start" => $_POST["start"],
    "end" => $_POST["end"],
   );
   $sea_con = array(
    "id" => $id,
   );
   update("seasons", $sea_arr, $sea_con, $connection);
   header("location:viewSeasons.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once './inc/header.php' ?>
    <style>
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
                            <h1 class="m-0">Update Season</h1>
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
                            <label for="exampleInputEmail1">Season Name</label>
                            <input type="text" value="<?php echo $season["name"] ?>" class="form-control" name="name" id="exampleInputEmail1" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Season start</label>
                            <input type="date" value="<?php echo $season["start"] ?>" class="form-control" name="start" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Season end</label>
                            <input type="date" value="<?php echo $season["end"] ?>" class="form-control" name="end" id="exampleInputEmail1">
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="pb-3">
                        <button type="submit" name="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>

            </div>
            <div class="col-11 mx-auto mt-2">
                <a href="viewSeasons.php" class="btn btn-primary">View Seasons</a>
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