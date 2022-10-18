<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once './inc/header.php' ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
</head>

<body>
    <?php require_once './inc/navbar.php' ?>
    <div class="col-12 form-background pt-3 pb-5">
        <div class="col-11 mx-auto p-0">
            <div class="col-10 bg-light rounded pt-2 pb-4">
                <form action="" method="post">
                    <div class="pb-3 border-bottom">
                        <div class="col-12 font-32 font-600 lato">
                            Airport Hotel And Parking Deals
                        </div>
                        <div class="col-12 lato font-18">
                            Free Airport Parking With One Night Hotel Stay
                        </div>
                    </div>
                    <div class="">
                        <div class="col-12 py-2 border-bottom">
                            <ul class="navbar-nav flex-row form-nav-color font-700 lato">
                                <li class="nav-item pr-5">
                                    AIRPORT HOTEL WITH PARKING
                                </li>
                                <li class="nav-item pr-5">
                                    FLIGHTS
                                </li>
                                <li class="nav-item">
                                    CARS
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 p-0 bg-white pt-3 pl-2">
                        <ul class="navbar-nav flex-row form-nav-color">
                            <li class="nav-item lato bg-light py-2 font-700 px-4 mr-3">Park Stay Fly Packages</li>
                            <li class="nav-item lato bg-light py-2 font-700 px-4 mr-3">Cruise & Parking</li>
                            <li class="nav-item lato bg-light py-2 font-700 px-4 mr-3">Hotel Room Only</li>
                            <li class="nav-item lato bg-light py-2 font-700 px-4">Parking</li>
                        </ul>
                        <ul class="navbar-nav lato form-nav-color font-700 flex-row mt-3">
                            <li class="nav-item border-bottom-blue mr-3">Room at the start of the trip</li>
                            <li class="nav-item mr-3">Room at the end of the trip</li>
                            <li class="nav-item">Room at the start and end of the trip</li>
                        </ul>
                        <div class="mt-4">
                            <input type="text" class="form-control search-hotel lato rounded-0 p-4" placeholder="Enter Airport or Cruise Port" name="" id="">
                            <span class="fa fa-search search-absolute"></span>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="row">
                                <div class="col-6 p-0">
                                    <input type="text" name="daterange" class="form-control pl-5 rounded-0 datepicker p-4" value="" />

                                </div>
                                <div class="col-4 tenant-parent">
                                    <span class="fa fa-user user-absolute form-nav-color"></span>
                                    <input type="text" name="" value="1 adult, 0 children, 1 room" class="form-control rounded-0 p-4 tenant-open bg-white" readonly id="">
                                    <div class="col-12 border p-0 tenant-box">
                                        <div class="col-12 mt-2">
                                            <div class="row border-bottom pb-2">
                                                <div class="col-8 lato">Adult(s)</div>
                                                <div class="col-4 p-0">
                                                    <span class="fa fa-minus"></span>
                                                    <input type="text" class="tenant-input adults" value="1" name="" id="">
                                                    <span class="fa fa-plus"></span>
                                                </div>
                                            </div>
                                            <div class="row mt-2 border-bottom pb-2">
                                                <div class="col-8 lato">Child(ren)</div>
                                                <div class="col-4 p-0">
                                                    <span class="fa fa-minus"></span>
                                                    <input type="text" class="tenant-input children" value="0" name="" id="">
                                                    <span class="fa fa-plus"></span>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-8 lato">Room(s)</div>
                                                <div class="col-4 p-0">
                                                    <span class="fa fa-minus"></span>
                                                    <input type="text" class="tenant-input room" value="1" name="" id="">
                                                    <span class="fa fa-plus"></span>
                                                </div>
                                            </div>
                                            <div class="btn btn-block btn-success py-1 mt-2 tenant-close">Done</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <a href="#" class="btn lato btn-success find-button w-100 h-100 font-20">Find Hotel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php require_once './inc/footer.php' ?>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        $(document).ready(function(e) {
            e.preventdefault
            $('input[name="daterange"]').daterangepicker({
                opens: 'left'
            }, function(start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            });
            $(".fa-minus").click(function() {
                var minusval = $(this).next().val();
                if (minusval >= 1) {
                    $(this).next().val(minusval - 1);
                }
            })
            $(".fa-plus").click(function() {
                var plusval = $(this).prev().val();
                    $(this).prev().val( parseInt(plusval) + 1);
            })
            $(".tenant-open").click(function(){
                $(".tenant-box").slideToggle(500);
            })
            $(".tenant-close").click(function(){
                $(".tenant-box").slideUp(500);
                var adults = $(".adults").val();
                var child = $(".children").val();
                var room = $ (".room").val();
                $(".tenant-open").val(adults + " Adults, " + child + " Children ," + room + " Rooms " )
            })
        });
    </script>
</body>

</html>