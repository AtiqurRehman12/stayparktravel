<?php
session_start();
require_once './admin/inc/sqlfunctions.php';
$hotel_id = $_GET["hotel_id"];
$hotel = select_where("hotels", "id", $hotel_id, $connection, 1);
$stayNights = $_GET["stay"];
$startDate = $_GET["startDate"];
$endDate = $_GET["endDate"];
$pickup = $_GET["pickup"];
$children = $_GET["children"];
$adults = $_GET["adults"];
$rooms = $_GET["rooms"];
$price = $_GET["price"];
$season = $_GET["season"];
$accomodation = $_GET["accomodation"];
$room_num = $_GET["room_no"];

if (isset($_POST["submit"])) {
    $expiryDate = $_POST["month"] . "/" . $_POST["year"];
    $guest_arr = array(
        "first_name" => $_POST["firstname"],
        "last_name" => $_POST["lastname"],
        "email" => $_POST["email"],
        "number" => $_POST["number"],
        "address" => $_POST["address"],
        "zip" => $_POST["zip"],
        "check_in" => date("Y-m-d", strtotime($startDate)),
        "check_out" => date("Y-m-d", strtotime($endDate)),
        "vehical_pickup" => $pickup,
        "room_type" => $accomodation,
        "dues" => $price * $stayNights * $rooms + 70,
        "stay_nights" => $stayNights,
        "rooms" => $rooms,
        "adults" => $adults,
        "children" => $children,
        "room_num" => $room_num,
        "season" => $season,
        "hotel_id" => $hotel["id"],
    );
    insert_func("guests", $guest_arr, $connection);
    $guest_id = mysqli_insert_id($connection);
    $payment = array(
        "card_number" => $_POST["cardno"],
        "name_on_card" => $_POST["cardname"],
        "expiry_date" => $expiryDate,
        "cvc" => $_POST["cvc"],
        "guest_id" => $guest_id,
    );
    insert_func("payment", $payment, $connection);
    $hotelDetail = select_where("hotels", "id", $hotel_id, $connection, 1);
    $hotelName = $hotelDetail["name"];
    $message = $_POST["firstname"] . " " . $_POST["lastname"] . ", You have booked " . $rooms . " in " . $hotelName . " at " . date("d, M-Y");
    $notification_arr = array(
        "message" => $message,
        "user_mail" => $_POST["email"],
        "status" => 1,
    );
    insert_func("notifications", $notification_arr, $connection);
    // the message
    $msg = "First line of text\nSecond line of text";
    $gmail = $_POST["email"];
    mail($gmail, "My subject", $msg);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once './inc/header.php' ?>
    <style>
        label {
            margin-bottom: 2px;
        }
    </style>
</head>

<body>
    <div class="col-12 border-bottom py-3">
        <div class="col-11 p-0 mx-auto">
            <div class="row">
                <div class="col-6">
                    <img src="https://www.stayparktravel.com/images/stayparktravel-simple-logo.com.svg" class="img-fluid" alt="">
                </div>
                <div class="col-6 lato">
                    <div class="row justify-content-end align-items-center">
                        <span class="fa fa-phone"></span>
                        <span class="mr-3">+1-855-301-3111</span>
                        <span class="fa fa-user text-primary"></span>
                        <span class="text-primary ml-2">Sign In</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 bg-light font-14 py-1">
        <div class="row justify-content-center">
            <div class="col-2">
                <span class="fa fa-shield"></span>
                <span class="lato">SECURE CHECKOUT</span>
            </div>
            <div class="col-2">
                <span class="fa fa-clock-o"></span>
                <span class="lato">24-HOURS SERVICE</span>
            </div>
            <div class="col-2">
                <span class="fa fa-check-circle"></span>
                <span class="lato">TRUSTED PAYMENTS</span>
            </div>
        </div>
    </div>
    <div class="col-12 pt-2" style="background-color: #EDEDED;">
        <div class="col-11 mx-auto text-secondary"><span class="font-weight-bold">Almost Done!</span><span> Enter your details and complete your booking now.</span></div>
        <div class="col-11 mx-auto p-0 mt-2 pb-3">
            <div class="col-12">
                <div class="row">
                    <div class="col-8 p-0">
                        <div class="col-12 bg-white rounded shadow p-0 pb-3 mb-3">
                            <div class="col-12 pt-3 mb-3">
                                <div class="row">
                                    <div class="col-3">
                                        <img src="<?php echo './admin/hotel profile images/' . $hotel["image"] ?>" class="rounded img-fluid" alt="">
                                    </div>
                                    <div class="col-9 pl-0">
                                        <div class="lato font-18 font-700"><?php echo $hotel["name"] ?></div>
                                        <div class="lato"><?php echo $hotel["location"] ?></div>
                                        <?php
                                        for ($i = 0; $i < $hotel["rating"]; $i++) {
                                        ?>
                                            <span class="fa fa-star text-success"></span>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="col-12 lato font-14 mb-1">
                                    <div class="row">
                                        <span class="font-600 col-2 p-0">Check-in / Out:</span>
                                        <span class="">
                                            <?php echo date("D-d M Y", strtotime($startDate)) . " - " . date("D-d M Y", strtotime($endDate)); ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-12 font-14 lato">
                                    <div class="row">
                                        <span class="font-600 col-2 p-0">Car Pick-up: </span>
                                        <span class=""><?php echo date("D-d M Y", strtotime($pickup)) ?></span>
                                    </div>
                                </div>
                                <div class="lato font-600 font-14 mt-2">
                                    <span class="fa fa-car"></span>
                                    <span><?php echo $hotel["parking"] ?></span>
                                </div>
                                <div class="lato font-13 mt-1">
                                    <span class="fa fa-bed"></span>
                                    <span><?php echo $accomodation ?></span>
                                </div>
                                <div class="lato font-13 mt-2">
                                    <span class="fa fa-users"></span>
                                    <span class="mr-2"><?php echo "Guest(s): " . $adults ?></span>
                                    <?php if ($children > 0) {
                                    ?>
                                        <span class="mr-2">Children: <?php echo $children ?></span>
                                    <?php
                                    }
                                    ?>
                                    <span class="fa fa-key"></span>
                                    <span class="mr-2"><?php echo "Room(s): " . $rooms ?></span>
                                    <span class="fa fa-moon"></span>
                                    <span><?php echo "Night(s): " . $stayNights ?></span>
                                </div>

                            </div>
                        </div>
                        <form action="" method="post">
                            <div class="col-12 bg-white rounded shadow pb-4">
                                <div class="pt-3    ">
                                    <span class="fa fa-users"></span>
                                    <span class="text-primary lato font-20">Guest Detail</span>
                                </div>
                                <div class="col-12 pl-5">
                                    <div class="row">
                                        <div class="col-4 p-0">
                                            <label for="" class="font-14 font-700 text-secondary lato">First Name</label>
                                            <input type="text" name="firstname" class="form-control rounded-0" id="">
                                        </div>
                                        <div class="col-4 pr-0">
                                            <label for="" class="font-14 font-700 text-secondary lato">Last Name</label>
                                            <input type="text" name="lastname" class="form-control rounded-0" id="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 pl-5 mt-2">
                                    <div class="row">
                                        <div class="col-6 p-0">
                                            <label for="" class="font-14 font-700 text-secondary lato">Email Address</label>
                                            <input type="email" name="email" class="form-control rounded-0" id="">
                                        </div>
                                        <div class="col-4 pr-0">
                                            <label for="" class="font-14 font-700 text-secondary lato">Phone Number</label>
                                            <input type="text" name="number" class="form-control rounded-0" id="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 shadow rounded bg-white mt-3 p-3">
                                <div>
                                    <span class="fa fa-credit-card"></span>
                                    <span class="lato font-20 text-primary ml-3">Payment</span>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-7">
                                            <label for="" class="font-14 font-600 text-secondary lato">Name on Card</label>
                                            <input type="text" name="cardname" class="form-control rounded-0" id="">
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-5">
                                            <label for="" class="font-14 font-600 text-secondary lato">Card Number</label>
                                            <input type="text" class="form-control rounded-0" name="cardno" id="">
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12">
                                            <label for="" class="font-14 font-600 text-secondary lato">Expiration date</label>
                                        </div>
                                        <div class="col-3">
                                            <select name="month" class="form-control rounded-0" id="">
                                                <option value="01">January</option>
                                                <option value="02">February</option>
                                                <option value="03">March</option>
                                                <option value="04">April</option>
                                                <option value="05">May</option>
                                                <option value="06">June</option>
                                                <option value="07">July</option>
                                                <option value="08">August</option>
                                                <option value="09">September</option>
                                                <option value="10">October</option>
                                                <option value="11">November</option>
                                                <option value="12">December</option>
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <select name="year" class="form-control rounded-0" id="">
                                                <option value="22">2022</option>
                                                <option value="23">2023</option>
                                                <option value="24">2024</option>
                                                <option value="25">2025</option>
                                                <option value="26">2026</option>
                                                <option value="27">2027</option>
                                                <option value="28">2028</option>
                                                <option value="29">2029</option>
                                                <option value="30">2030</option>
                                                <option value="31">2031</option>
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <input type="text" name="cvc" placeholder="CVC number" class="form-control rounded-0" id="">
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-6">
                                            <label for="" class="font-14 font-600 text-secondary lato">Address</label>
                                            <input type="text" class="form-control rounded-0" name="address" id="">
                                        </div>
                                        <div class="col-3">
                                            <label for="" class="font-14 font-600 text-secondary lato">Zip/Postal Code</label>
                                            <input type="number" class="form-control rounded-0" name="zip" value="">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <button type="submit" onclick="return confirm('Do you want to make this reservation?');" class="btn btn-primary py-2 px-3" name="submit">Confirm Reservation</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-4">
                        <div class="col-12 bg-white shadow rounded p-3">
                            <div class="border-bottom pb-3">
                                <div>
                                    <span class="lato text-success font-600">Room/ <?php echo $stayNights . " Night Stay" ?></span>
                                    <span class="lato text-success font-700 float-right"><?php echo $price . "$" ?></span>
                                </div>
                                <div class="lato">
                                    <span>Number of nights</span>
                                    <span class="float-right">x <?php echo $stayNights ?></span>
                                </div>
                                <div class="lato">
                                    <span>Number of Rooms</span>
                                    <span class="float-right"><?php echo $rooms ?></span>
                                </div>
                                <div class="lato">
                                    <span>Taxes and fees</span>
                                    <span class="float-right">70$</span>
                                </div>
                            </div>
                            <div class="p-2 text-primary lato font-weight-bold font-18">
                                <span class="">Total Cost</span>
                                <span class="float-right"><?php echo $stayNights * $price * $rooms + 70 . "$" ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once './inc/footer.php' ?>
    <script>
        $(document).ready(function() {
            $("form").validate({
                rules: {
                    "firstname": "required",
                    "lastname": "required",
                    "email": "required",
                    "number": "required",
                    "cardname": "required",
                    "cardno": "required",
                    "cvc": "required",
                    "year": "required",
                    "month": "required",
                    "address": "required",
                    "zip": "required",
                },
                message: {
                    "firstname": "Field is required",
                    "lastname": "Field is required",
                    "email": "Field is required",
                    "number": "Field is required",
                    "cardname": "Field is required",
                    "cardno": "Field is required",
                    "cvc": "Field is required",
                    "year": "Field is required",
                    "month": "Field is required",
                    "address": "Field is required",
                    "zip": "Field is required",
                }
            })
        })
    </script>
</body>

</html>