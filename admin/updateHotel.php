<?php
require_once './inc/sqlfunctions.php';
if (isset($_GET["id"])) {
    $hotel_id = $_GET["id"];
    $services = select_all("services", $connection);
    $features = select_all("features", $connection);
    $airports = select_all("airports", $connection);
    $hotels = select_where("hotels", "id", $hotel_id, $connection, 1);
    $hotel_services = select_where("hotel_services", "hotel_id", $hotel_id, $connection, 2);
    $hotel_features = select_where("hotel_features", "hotel_id", $hotel_id, $connection, 2);
    $rates = select_where("hotel_rates", "hotel_id", $hotel_id, $connection, 2);
    $seasons = select_all("seasons", $connection);
}
if (isset($_POST["submit"])) {
    $image = $_FILES["image"]["name"];
    if (!$image) {
        $newImage = $hotels["image"];
    } else {
        unlink('./hotel profile images/' . $hotels["image"]);
        $tmp_image = $_FILES["image"]["tmp_name"];
        $newImage = new_file_name($image);
    }
    $hotel_arr = array(
        "name" => $_POST["name"],
        "location" => $_POST["location"],
        "distance" => $_POST["distance"],
        "shuttle_hours" => $_POST["shuttle"],
        "rating" => $_POST["stars"],
        "parking" => $_POST["parking"],
        "airport" => $_POST["airport"],
        "image" => $newImage,
    );
    $hotel_con = array(
        "id" => $hotel_id,
    );
    if (!$image) {
        update("hotels", $hotel_arr, $hotel_con, $connection);
    } else {
        if (move_uploaded_file($tmp_image, './hotel profile images/' . $newImage)) {
            update("hotels", $hotel_arr, $hotel_con, $connection);
        }
    }
    mysqli_query($connection, "DELETE FROM `hotel_services` WHERE `hotel_id` = $hotel_id");
    foreach ($_POST["services"] as $update_services) {
        mysqli_query($connection, "INSERT INTO `hotel_services`(`service`, `hotel_id`)VALUES('$update_services', '$hotel_id')");
    }
    mysqli_query($connection, "DELETE FROM `hotel_features` WHERE `hotel_id` = $hotel_id");
    foreach ($_POST["features"] as $update_features) {
        mysqli_query($connection, "INSERT INTO `hotel_features`(`feature`, `hotel_id`)VALUES('$update_features', '$hotel_id')");
    }
    mysqli_query($connection, "DELETE FROM `hotel_rates` WHERE `hotel_id` = $hotel_id");
    foreach($_POST["season"] as $sea){
        $season_arr[] = $sea;
    }
    $season_index = 0;
    foreach (array_combine($_POST["price"], $_POST["accomodation"]) as $rate_key => $rate_val) {
        if ($rate_key != "" && $rate_val != "") {
            $price = $rate_key;
            $accom = $rate_val;
            $season = $season_arr[$season_index];
            mysqli_query($connection, "INSERT INTO hotel_rates(`price` , `accomodation`, `season` ,`hotel_id`)VALUES('$price', '$accom', '$season', '$hotel_id')");
            $season_index++;
        }
    }
    header("location:viewHotels.php");
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
                            <h1 class="m-0">Update Hotel</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="col-12 my-2 border p-2">
                <a href="addService.php" class="btn btn-primary">Add Hotel Service</a>
                <a href="addFeature.php" class="btn btn-primary">Add Hotel Feature</a>
            </div>
            <div class="col-11 mx-auto border">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hotel Name</label>
                            <input type="text" class="form-control" value="<?php echo $hotels["name"] ?>" name="name" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Location</label>
                            <input type="text" class="form-control" value="<?php echo $hotels["location"] ?>" name="location" id="exampleInputPassword1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Distance From Airport</label>
                            <input type="text" class="form-control" value="<?php echo $hotels["distance"] ?>" name="distance" id="exampleInputPassword1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Shuttle Hours</label>
                            <input type="text" class="form-control" name="shuttle" value="<?php echo $hotels["shuttle_hours"] ?>" id="exampleInputPassword1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Hotel Profile Image</label>
                            <div class="mb-2"><img src="<?php echo './hotel profile images/' . $hotels["image"] ?>" width="200px" alt=""></div>
                            <input type="file" class="form-control" name="image" id="">
                        </div>
                        <div class="col-12">
                            <label for="">Services</label>
                            <div class="row border p-3">
                                <?php
                                foreach ($services as $mainServices) {
                                ?>
                                    <div class="col-3">
                                        <input type="checkbox" name="services[]" <?php if ($hotel_services != "") {
                                                                                        foreach ($hotel_services as $main_hotel_services) {
                                                                                            if ($main_hotel_services["service"] == $mainServices["service"]) {
                                                                                                echo "checked";
                                                                                            }
                                                                                        }
                                                                                    } ?> value="<?php echo $mainServices["service"] ?>" name="" id="<?php echo $mainServices["service"] ?>">
                                        <label class="pointer" for="<?php echo $mainServices["service"] ?>"><?php echo $mainServices["service"] ?></label>
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
                                        <input type="checkbox" name="features[]" <?php if ($hotel_features != "") {
                                                                                        foreach ($hotel_features as $main_hotel_features) {
                                                                                            if ($main_hotel_features["feature"] == $mainFeatures["feature"]) {
                                                                                                echo "checked";
                                                                                            }
                                                                                        }
                                                                                    } ?> value="<?php echo $mainFeatures["feature"] ?>" id="<?php echo $mainFeatures["feature"] ?>">
                                        <label class="pointer" for="<?php echo $mainFeatures["feature"] ?>"><?php echo $mainFeatures["feature"] ?></label>
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
                                <input type="radio" name="stars" value="3" <?php if ($hotels["rating"] == 3) {
                                                                                echo "checked";
                                                                            } ?> id="3stars">
                                <label for="3stars" class="pointer">3 Stars</label>
                            </span>
                            <span class="mr-5">
                                <input type="radio" <?php if ($hotels["rating"] == 4) {
                                                        echo "checked";
                                                    } ?> name="stars" value="4" id="4stars">
                                <label for="4stars" class="pointer">4 Stars</label>
                            </span>
                            <span class="">
                                <input type="radio" <?php if ($hotels["rating"] == 5) {
                                                        echo "checked";
                                                    } ?> name="stars" value="5" id="5stars">
                                <label for="5stars" class="pointer">5 Stars</label>
                            </span>

                        </div>
                        <div class="form-group">
                            <label for="">Parking</label>
                            <input type="text" value="<?php echo $hotels["parking"] ?>" name="parking" class="form-control" id="">
                        </div>
                        <div class="col-12 border main-accom-box">
                            <label for="">Rates</label>
                            <span class="fa fa-plus pointer add-acc float-right"></span>
                            <div class="accom-box border p-2">
                                <?php foreach ($rates as $mainRates) {

                                ?>
                                    <div class="inner-accom">
                                        <span class="fa fa-minus del-acc pointer float-right"></span>
                                        <label for="">Price</label>
                                        <input type="text" value="<?php echo $mainRates["price"] ?>" name="price[]" class="form-control" id="">
                                        <label for="">Accomodation</label>
                                        <input type="text" value="<?php echo $mainRates["accomodation"] ?>" name="accomodation[]" class="form-control" id="">
                                        <label for="season">Season</label>
                                        <select name="season[]" class="form-control" id="season">
                                            <?php
                                            foreach ($seasons as $mainSeasons) {
                                            ?>
                                                <option value="<?php echo $mainSeasons["name"] ?>" <?php if($mainRates["season"] == $mainSeasons["name"]){echo "selected";}?>><?php echo $mainSeasons["name"] ?></option>
                                            <?php
                                            } ?>
                                        </select>

                                    </div>
                                <?php
                                } ?>
                            </div>
                            <div class="hidden-accom d-none">
                                <div class="hidden-accom-box">
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
                            <div class="added-acc p-2">

                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label for="">Airport</label>
                            <select name="airport" id="" class="form-control">
                                <?php
                                foreach ($airports as $mainAirports) {
                                ?>
                                    <option value="<?php echo $mainAirports["airport"] ?>" <?php if ($hotels["airport"] == $mainAirports["airport"]) {
                                                                                                echo "selected";
                                                                                            } ?>><?php echo $mainAirports["airport"] ?></option>
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