<?php
require_once './admin/inc/sqlfunctions.php';
if (isset($_GET["airport"]) && isset($_GET["date"])) {
    $children = $_GET["children"];
    $adults = $_GET["adults"];
    $rooms = $_GET["rooms"];
    $airport = $_GET["airport"];
    $date = $_GET["date"];
    $pickup = $_GET["pickup"];
    $hotels = select_where_string("hotels", "airport", $airport, $connection, 2);
    $date_arr = explode('-', $date);
    $startDate = $date_arr[0];
    $endDate = end($date_arr);
    $startDate = date("Y-m-d", strtotime($startDate));
    $endDate = date("Y-m-d", strtotime($endDate));
    $stayNights = date("d", strtotime($endDate)) - date("d", strtotime($startDate));
    $stayNights = abs($stayNights);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once './inc/header.php' ?>
    <style>
        .main-zoom {
            zoom: 89%;
        }

        .pointer {
            cursor: pointer;
        }
    </style>
</head>

<body class="bg-light">
    <?php require_once './inc/navbar.php' ?>
    <div class="col-11 mx-auto lato font-20 font-700 hotel-count border-bottom p-2">

        <span>Showing <span class="count"></span> hotels near <?php echo $airport ?></span>
    </div>
    <div class="col-11 mx-auto mt-2">
        <div class="row">
            <div class="col-3 p-0 pt-2">
                <div class="col-12 pr-0">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d46885.56638912919!2d-73.84182618720372!3d42.73869111557575!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89de0cee2f49259f%3A0xf064a3c7c66b5d9b!2sAlbany%20International%20Airport!5e0!3m2!1sen!2s!4v1666612048255!5m2!1sen!2s" class="img-fluid" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="col-12 lato font-20 my-3">
                    Search by property name
                </div>
                <div class="col-12 mb-3">
                    <input type="text" class="form-control rounded-0" placeholder="Property Name" name="" id="property-search">
                </div>
                <div class="col-12">
                    <div class="lato font-20 mb-3">Filter properties by</div>
                    <div class="border-bottom pb-2">
                        <div>Sort by</div>
                        <div class="mt-1">
                            <div class="font-15 lato"><input type="radio" name="sort" id="recommended"> <label for="recommended">Recommended</label></div>
                            <div class="font-15 lato"><input type="radio" name="sort" id="hotel-name"> <label for="hotel-name">Hotel Name</label></div>
                            <div class="font-15 lato"><input type="radio" name="sort" id="rating"> <label for="rating">Rating</label></div>
                            <div class="font-15 lato"><input type="radio" name="sort" id="price"> <label for="price">Price</label></div>
                        </div>
                    </div>
                    <div>
                        <div class="font-20 lato">Property Class</div>
                        <div>
                            <div>
                                <input type="radio" name="rating" id="any">
                                <label for="any" class="lato">Any</label>
                            </div>
                            <div>
                                <input type="radio" name="rating" id="three-star">
                                <label for="three-star">
                                    <span class="fa fa-star text-success"></span>
                                    <span class="fa fa-star text-success"></span>
                                    <span class="fa fa-star text-success"></span>
                                </label>
                            </div>
                            <div>
                                <input type="radio" name="rating" id="four-star">
                                <label for="four-star">
                                    <span class="fa fa-star text-success"></span>
                                    <span class="fa fa-star text-success"></span>
                                    <span class="fa fa-star text-success"></span>
                                    <span class="fa fa-star text-success"></span>
                                </label>
                            </div>
                            <div>
                                <input type="radio" name="rating" id="five-star">
                                <label for="five-star">
                                    <span class="fa fa-star text-success"></span>
                                    <span class="fa fa-star text-success"></span>
                                    <span class="fa fa-star text-success"></span>
                                    <span class="fa fa-star text-success"></span>
                                    <span class="fa fa-star text-success"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="lato font-20 mb-2">Price per night</div>
                        <div>
                            <input type="radio" name="price" id="all-prices">
                            <label for="all-prices">All</label>
                        </div>
                        <div>
                            <input type="radio" name="price" id="low-price">
                            <label for="low-price" class="lato">Less than $90</label>
                        </div>
                        <div>
                            <input type="radio" name="price" id="mid-price">
                            <label for="mid-price" class="lato">$91 to $110</label>
                        </div>
                        <div>
                            <input type="radio" name="price" id="high-price">
                            <label for="high-price" class="lato">$110 to $199</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-9 main-container main-zoom">
                <?php
                if ($hotels != "") {
                    foreach ($hotels as $mainHotels) {
                        $price = [];
                        $accom = [];
                        $hotel_id = $mainHotels["id"];
                        $rate = select_where_rate($hotel_id, $connection, 2);
                        foreach ($rate as $mainRate) {
                            if ($startDate < $mainRate["start"]) {
                                continue;
                            } elseif ($startDate > $mainRate["end"]) {
                                continue;
                            }

                            $price[] = $mainRate["price"];
                            $accom[] = $mainRate["accomodation"];
                        }
                        if (count($price) == 0) {
                            $lowPrice = "";
                        } else {
                            $lowPrice = min($price);
                        }


                ?>
                        <div class="col-12 my-2 bg-white hotel-box shadow" value="<?php echo $mainHotels["name"] ?>" data-name="<?php echo $mainHotels["name"] ?>" data-star="<?php echo $mainHotels["rating"] ?>" data-price="<?php echo $lowPrice; ?>">
                            <div class="row">
                                <div class="col-4 p-0">
                                    <img src="<?php echo './admin/hotel profile images/' . $mainHotels["image"] ?>" class="w-100 h-100 img-fluid" alt="">
                                </div>
                                <div class="col-5 pb-3">
                                    <div class="hotel-title">
                                        <?php echo $mainHotels["name"] ?>
                                    </div>
                                    <div class="">
                                        <?php
                                        for ($i = 0; $i < $mainHotels["rating"]; $i++) {
                                        ?>
                                            <span class="fa fa-star rating"></span>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div>
                                        <?php
                                        $hotel_services = "SELECT services.font_awesome, hotel_services.service, hotel_services.hotel_id
                                FROM hotel_services
                                INNER JOIN services ON services.service = hotel_services.service && hotel_services.hotel_id = $hotel_id;";
                                        $ser_res = mysqli_query($connection, $hotel_services);
                                        if (mysqli_num_rows($ser_res) > 0) {
                                            while ($ser_row = mysqli_fetch_array($ser_res)) {
                                        ?>
                                                <span class="<?php echo $ser_row["font_awesome"] ?> font-18 text-secondary"></span>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                    <div>
                                        <span class="fa fa-map-marker font-20 text-secondary"></span>
                                        <span class="font-13 lato"><?php echo $mainHotels["location"] ?></span>
                                    </div>
                                    <div>
                                        <span class="fa fa-plane font-20 text-secondary"></span>
                                        <span class="lato font-14"><?php echo $mainHotels["distance"] ?></span>
                                    </div>
                                    <div>
                                        <span class="lato font-13">Airport Shuttle Hour: </span>
                                        <span class="lato font-13"><?php echo $mainHotels["shuttle_hours"] ?></span>
                                    </div>
                                    <div>
                                        <?php
                                        $hotel_features = "SELECT features.font_awesome, hotel_features.feature
                                        FROM hotel_features
                                        INNER JOIN features ON features.feature = hotel_features.feature && hotel_features.hotel_id = $hotel_id";
                                        $fea_res = mysqli_query($connection, $hotel_features);
                                        if (mysqli_num_rows($fea_res) > 0) {
                                            while ($fea_row = mysqli_fetch_array($fea_res)) {
                                        ?>
                                                <div class="features">
                                                    <span class="<?php echo $fea_row["font_awesome"] ?>"></span>
                                                    <span><?php echo $fea_row["feature"] ?> </span>
                                                </div>
                                        <?php
                                            }
                                        } ?>
                                    </div>
                                </div>
                                <div class="col-3 pt-2 pr-2">
                                    <div class="features lato"><?php echo $mainHotels["parking"] ?></div>
                                    <?php
                                    foreach ($rate as $mainRate) {
                                        if ($startDate < $mainRate["start"]) {
                                            continue;
                                        } elseif ($startDate > $mainRate["end"]) {
                                            continue;
                                        } elseif ($mainRate["price"] != $lowPrice) {
                                            continue;
                                        }
                                    ?>
                                        <div class="font-15 lato"><span class="fa fa-bed text-secondary"></span><?php echo $mainRate["accomodation"] ?></div>
                                        <div class="text-right pr-3 price lato"><span class="font-27"><?php echo $mainRate["price"] ?></span><sup class="usd">USD</sup></div>
                                    <?php
                                    }
                                    ?>
                                    <button class="btn <?php if (count($price) == 0) {
                                                            echo "btn-danger mt-5";
                                                        } else {
                                                            echo "btn-success";
                                                        } ?>  btn-block lato" data-toggle="modal" data-target="#<?php $modalName = str_replace(" ", "-", $mainHotels["name"]);
                                                                                                                echo str_replace("&", "s", $modalName); ?>"><?php if (count($price) == 0) {
                                                                                                        echo "Not Available";
                                                                                                    } else {
                                                                                                        echo "Book Now";
                                                                                                    } ?></button>
                                    <div class="<?php if (count($price) == 0 || count($price) == 1) {
                                                    echo "d-none";
                                                } ?> more-rates lato text-right mt-1 pointer" data-toggle="modal" data-target="#<?php $modalName = str_replace(" ", "-", $mainHotels["name"]);
                                                                                                                                echo str_replace("&", "s", $modalName); ?>"><span class="fa fa-arrow-circle-right mr-2"></span><span>Show more rates</span></div>

                                    <div class="modal fade" id="<?php $modalName = str_replace(" ", "-", $mainHotels["name"]);
                                                                echo str_replace("&", "s", $modalName); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary">
                                                    <h5 class="modal-title text-white" id="exampleModalLabel"><?php echo $mainHotels["name"] ?></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                    foreach (array_combine($price, $accom) as $key => $val) {
                                                    ?>
                                                        <div class="border bg-primary">
                                                            <div class="lato font-20 p-1"><span class="font-15 text-white"><?php echo $val ?></span> <a href="confirmation.php?stay=<?php echo $stayNights. "&hotel_id=". $mainHotels["id"] ."&startDate=". $startDate ."&endDate=".$endDate . "&children=".$children . "&adults=".$adults."&rooms=".$rooms."&price=".$key."&accomodation=".$val."&pickup=".$pickup;?>" class="p-2 btn btn-success mt-1 float-right ml-5">Book Now</a><span class="float-right mr-5 lato text-white font-weight-bold"><?php echo $key . "$" ?></span></div>
                                                            <div class="lato font-15 text-white pl-1"><?php echo $mainHotels["parking"] ?></div>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } ?>
            </div>
        </div>
    </div>
    <?php require_once './inc/footer.php' ?>
    <script>
        $(document).ready(function() {
            $("#price").click(function() {
                var result = $('.hotel-box').sort(function(a, b) {
                    var contentA = parseInt($(a).data('price'));
                    var contentB = parseInt($(b).data('price'));
                    return (contentA < contentB) ? -1 : (contentA > contentB) ? 1 : 0;
                }).appendTo(".main-container")
            })
            $("#rating").click(function() {
                var result = $('.hotel-box').sort(function(a, b) {
                    var contentA = parseInt($(a).data('star'));
                    var contentB = parseInt($(b).data('star'));
                    return (contentA < contentB) ? -1 : (contentA > contentB) ? 1 : 0;
                }).appendTo(".main-container")
            })
            $("#hotel-name").click(function() {
                var result = $('.hotel-box').sort(function(a, b) {
                    var contentA = $(a).data('name');
                    var contentB = $(b).data('name');
                    return (contentA < contentB) ? -1 : (contentA > contentB) ? 1 : 0;
                }).appendTo(".main-container")
            })
            $("#three-star").click(function() {
                $(".hotel-box[data-star='3']").show();
                $(".hotel-box[data-star='4'], .hotel-box[data-star='5']").hide();
            })
            $("#four-star").click(function() {
                $(".hotel-box[data-star='4']").show();
                $(".hotel-box[data-star='3'], .hotel-box[data-star='5']").hide();
            })
            $("#five-star").click(function() {
                $(".hotel-box[data-star='5']").show();
                $(".hotel-box[data-star='3'], .hotel-box[data-star='4']").hide();
            })
            $("#any").click(function() {
                $(".hotel-box[data-star='5'], .hotel-box[data-star='3'], .hotel-box[data-star='4']").show();
            })
            $("#all-prices").click(function() {
                $(".hotel-box").show();
            })
            $("#low-price").click(function() {
                $(".hotel-box").show();
                $(".hotel-box").filter(function() {
                    return $(this).data("price") > 90;
                }).hide()
            })
            $("#mid-price").click(function() {
                $(".hotel-box").show();
                $(".hotel-box").filter(function() {
                    return $(this).data("price") < 90;
                }).hide()
                $(".hotel-box").filter(function() {
                    return $(this).data("price") > 110;
                }).hide()
            })
            $("#high-price").click(function() {
                $(".hotel-box").show();
                $(".hotel-box").filter(function() {
                    return $(this).data("price") < 110;
                }).hide()
                $(".hotel-box").filter(function() {
                    return $(this).data("price") > 199;
                }).hide()
            })
            $("#property-search").keyup(function() {
                var value = $(this).val().toLowerCase();
                $(".hotel-box").each(function() {
                    $(this).filter(function() {
                        $(this).toggle($(this).first().text().toLowerCase().indexOf(value) > -1)
                    });
                })
            })
            $i = 0;
            $(".hotel-box").each(function() {
                $i++
            })
            $(".count").text($i)

        })
    </script>
</body>

</html>