<?php
require_once './inc/sqlfunctions.php';
$services = select_all("services", $connection);
$features = select_all("features", $connection);
$seasons = select_all("seasons", $connection);
$airports = select_all("airports", $connection);
if (isset($_POST["submit"])) {
    $image = $_FILES["image"]["name"];
    $newImage = new_file_name($image);
    $tmp_image = $_FILES["image"]["tmp_name"];
    $hotel_arr = array(
        "name" => $_POST["name"],
        "location" => $_POST["location"],
        "distance" => $_POST["distance"],
        "shuttle_hours" => $_POST["shuttle"],
        "image" => $newImage,
        "rating" => $_POST["stars"],
        "parking" => $_POST["parking"],
        "airport" => $_POST["airport"],
    );
    if (move_uploaded_file($tmp_image, './hotel profile images/' . $newImage)) {
        insert_func("hotels", $hotel_arr, $connection);
    }
    $hotel_id = mysqli_insert_id($connection);
    foreach ($_FILES["more-img"]["tmp_name"] as $key => $value) {
        $temp_image = $_FILES["more-img"]["tmp_name"][$key];
        $detailImage = $_FILES["more-img"]["name"][$key];
        $newDetailImage = new_file_name($detailImage);

        if (move_uploaded_file($temp_image, './hotel detail images/' . $newDetailImage)) {
            mysqli_query($connection, "INSERT INTO hotel_images(images, hotel_id)VALUES('$newDetailImage', '$hotel_id')");
        }
    }
    foreach ($_POST["services"] as $ser_key => $ser_val) {
        $hotel_service = $_POST["services"][$ser_key];
        mysqli_query($connection, "INSERT INTO hotel_services(`service`,  `hotel_id`)VALUES('$hotel_service', '$hotel_id')");
    }
    foreach ($_POST["features"] as $fea_key => $fea_val) {
        $hotel_service = $_POST["features"][$fea_key];
        mysqli_query($connection, "INSERT INTO hotel_features(`feature`,  `hotel_id`)VALUES('$hotel_service', '$hotel_id')");
    }
    foreach($_POST["season"] as $sea){
        $season_arr[] = $sea; 
    }
    $season_index =0;
    foreach (array_combine($_POST["price"], $_POST["accomodation"]) as $rate_key => $rate_val) {
        if ($rate_key != "" &&  $rate_val != "") {
            $price = $rate_key;
            $accom = $rate_val;
            $season = $season_arr[$season_index];
            mysqli_query($connection, "INSERT INTO hotel_rates(`price` , `accomodation`, `season`,  `hotel_id`)VALUES('$price', '$accom', '$season', '$hotel_id')");
            $season_index++;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once './inc/header.php' ?>
    <style>
        .pointer {
            cursor: pointer;
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
                            <h1 class="m-0">Add Hotel</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="col-12 my-2 border p-2">
                <a href="addService.php" class="btn btn-primary">Add Hotel Service</a>
                <a href="addFeature.php" class="btn btn-primary">Add Hotel Feature</a>
                <a href="addSeason.php" class="btn btn-primary">Add Hotel Season</a>
            </div>
            <div class="col-11 mx-auto border">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hotel Name</label>
                            <input type="text" class="form-control" name="name" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Location</label>
                            <input type="text" class="form-control" name="location" id="exampleInputPassword1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Distance From Airport</label>
                            <input type="text" class="form-control" name="distance" id="exampleInputPassword1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Shuttle Hours</label>
                            <input type="text" class="form-control" name="shuttle" id="exampleInputPassword1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Hotel Profile Image</label>
                            <input type="file" class="form-control" name="image" id="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">More Images</label>
                            <input type="file" name="more-img[]" multiple class="form-control" id="">
                        </div>
                        <div class="col-12">
                            <label for="">Services</label>
                            <div class="row border p-3">
                                <?php
                                foreach ($services as $mainServices) {
                                ?>
                                    <div class="col-3">
                                        <input type="checkbox" name="services[]" value="<?php echo $mainServices["service"] ?>" name="" id="<?php echo $mainServices["service"] ?>">
                                        <label for="<?php echo $mainServices["service"] ?>"><?php echo $mainServices["service"] ?></label>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="">Features</label>
                            <div class="row border p-3">
                                <?php
                                foreach ($features as $mainFeatures) {
                                ?>
                                    <div class="col-3">
                                        <input type="checkbox" name="features[]" value="<?php echo $mainFeatures["feature"] ?>" name="" id="<?php echo $mainFeatures["feature"] ?>">
                                        <label for="<?php echo $mainFeatures["feature"] ?>"><?php echo $mainFeatures["feature"] ?></label>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            <div>
                                <label for="">Rating</label>
                            </div>
                            <span class="mr-5">
                                <input type="radio" name="stars" value="3" checked id="3stars">
                                <label for="3stars">3 Stars</label>
                            </span>
                            <span class="mr-5">
                                <input type="radio" name="stars" value="4" id="4stars">
                                <label for="4stars">4 Stars</label>
                            </span>
                            <span class="">
                                <input type="radio" name="stars" value="5" id="5stars">
                                <label for="5stars">5 Stars</label>
                            </span>

                        </div>
                        <div class="form-group">
                            <label for="">Parking</label>
                            <input type="text" name="parking" class="form-control" id="">
                        </div>
                        <div class="col-12 border main-accom-box">
                            <label for="">Rates</label>
                            <span class="fa fa-plus pointer add-acc float-right"></span>
                            <div class="accom-box border p-2">
                                <div class="inner-accom">
                                    <div>
                                        <span class="fa fa-minus del-acc pointer float-right"></span>
                                        <label for="">Price</label>
                                        <input type="text" name="price[]" class="form-control" id="">
                                        <label for="">Accomodation</label>
                                        <input type="text" name="accomodation[]" class="form-control" id="">
                                        <label for="season">Season</label>
                                        <select name="season[]" class="form-control" id="season">
                                            <?php
                                            foreach ($seasons as $mainSeasons) {
                                            ?>
                                                <option value="<?php echo $mainSeasons["name"] ?>"><?php echo $mainSeasons["name"] ?></option>
                                            <?php
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="hidden-accom-box d-none">
                                <div>
                                    <span class="fa fa-minus del-acc pointer float-right"></span>
                                    <label for="">Price</label>
                                    <input type="text" name="price[]" class="form-control" id="">
                                    <label for="">Accomodation</label>
                                    <input type="text" name="accomodation[]" class="form-control" id="">
                                    <label for="season">Season</label>
                                    <select name="season[]" class="form-control" id="season">
                                        <?php
                                        foreach ($seasons as $mainSeasons) {
                                        ?>
                                            <option value="<?php echo $mainSeasons["name"] ?>"><?php echo $mainSeasons["name"] ?></option>
                                        <?php
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="added-acc p-2">

                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label for="">Airport</label>
                            <select name="airport" id="" class="form-control">
                                <?php
                                foreach ($airports as $mainAirports) {
                                ?>
                                    <option value="<?php echo $mainAirports["airport"] ?>"><?php echo $mainAirports["airport"] ?></option>
                                <?php
                                } ?>
                            </select>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
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
    <script>
        $(document).ready(function() {
            $(".accom-box").find(".del-acc").hide();
            $(".add-acc").click(function() {
                var accom = $(".hidden-accom-box div").clone(true, true);
                $(".added-acc").append(accom);
                $(".added-acc").find(".del-acc").show();
            })
            $(".del-acc").click(function() {
                $(this).parent().remove();
            })
        })
    </script>
</body>

</html>