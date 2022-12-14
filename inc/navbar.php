<?php 
$notificaitonSql = "SELECT * FROM notifications WHERE `status` = 1";
$notificaitonRes = mysqli_query($connection, $notificaitonSql);
$numOfNotifications = mysqli_num_rows($notificaitonRes);
 ?>
<section class="nav-top-border bg-white navbar-section pb-2">
    <div class="col-11 mx-auto">
        <nav class="navbar navbar-expand-lg navbar-light p-0">
            <div class="py-2"><a class="navbar-brand col-3" href="index.php"><img src="https://www.stayparktravel.com/images/stayparktravel.com.svg" class="nav-image" alt=""></a></div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <ul class="navbar-nav ul-bg ml-auto pr-2">
                                    <li class="nav-item bg-white pr-5">
                                        <span class="fa fa-phone font-13"></span>
                                        <span class="lato font-13">+1-855-301-3111</span>
                                    </li>
                                    <li class="nav-item pl-2">
                                        <a class="nav-link lato text-white p-1 font-13" data-toggle="<?php if(!isset($_SESSION["loggedIn"])){echo "modal";} ?>" href="<?php if(!isset($_SESSION["loggedIn"])){echo "#exampleModal";}else{echo "signOut.php";} ?>"><span class="fa fa-user text-white mr-2"></span><?php if(isset($_SESSION["loggedIn"])){echo "Sign Out";}elseif(!isset($_SESSION["loggedIn"])){echo "Sign In";} ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link lato text-white p-1 font-13" href="<?php if(!isset($_SESSION["loggedIn"])){echo "#exampleModal";}else{echo "userAccount.php";}?>" data-toggle="<?php if(!isset($_SESSION["loggedIn"])){echo "modal";} ?>"><span class="fa fa-briefcase text-white mr-2"></span>View Reservations</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link lato text-white p-1 font-13" href="<?php if(isset($_SESSION["loggedIn"])){echo "notifications.php";}else{echo "#";} ?>"><span class="fa fa-clock-o text-white mr-2"></span><?php if(isset($_SESSION["loggedIn"])){echo "Notifications"; if($numOfNotifications>0){echo "<span class='badge badge-danger ml-1'>". $numOfNotifications. "</span>";} }else{echo "Hours";} ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link lato text-white p-1 font-13" href="#"><span class="fa fa-phone text-white mr-2"></span>Request Call Back</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12 pr-0 mt-3">
                            <ul class="navbar-nav font-15 float-right">
                                <li class="nav-item mr-3">
                                    <a href="" class="sec-nav">Airport Hotel & Parking</a>
                                </li>
                                <li class="nav-item mr-3">
                                    <a href="" class="sec-nav">Flights</a>
                                </li>
                                <li class="nav-item mr-3">
                                    <a href="" class="sec-nav">Cars</a>
                                </li>
                                <li class="nav-item mr-3">
                                    <a href="" class="sec-nav">Room Only</a>
                                </li>
                                <li class="nav-item mr-3">
                                    <a href="" class="sec-nav">Cruise Port Hotel & Parking</a>
                                </li>
                                <li class="nav-item mr-3">
                                    <a href="" class="sec-nav">Airport Parking</a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="sec-nav">Coupons</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


        </nav>
    </div>
</section>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-body">
                <div class="login-wrap">
                    <div class="login-html">
                        <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
                        <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
                        <div class="login-form">
                            <form action="" method="post">
                                <div class="sign-in-htm">
                                    <div class="group">
                                        <label for="user" class="label">Email</label>
                                        <input id="user" type="email" name="inmail" class="input">
                                    </div>
                                    <div class="group">
                                        <label for="pass" class="label">Password</label>
                                        <input id="pass" type="password" name="inpass" class="input" data-type="password">
                                    </div>
                                    <div class="group">
                                        <input id="check" type="checkbox" name="incookie" class="check" checked>
                                        <label for="check"><span class="icon"></span> Keep me Signed in</label>
                                    </div>
                                    <div class="group">
                                        <input type="submit" class="button" value="Sign In" name="signin">
                                    </div>
                                    <div class="hr"></div>
                                </div>
                            </form>
                            <form action="" method="post">
                                <div class="sign-up-htm">
                                    <div class="group">
                                        <label for="user" class="label">Username</label>
                                        <input id="user" name="upname" type="text" class="input">
                                    </div>
                                    <div class="group">
                                        <label for="pass" class="label">Password</label>
                                        <input id="pass" type="password" name="uppass" class="input" data-type="password">
                                    </div>
                                    <div class="group">
                                        <label for="pass" class="label">Email Address</label>
                                        <input id="pass" type="text" name="upmail" class="input">
                                    </div>
                                    <div class="group">
                                        <input type="submit" name="signup" class="button" value="Sign Up">
                                    </div>
                                    <div class="hr"></div>
                                    <div class="foot-lnk">
                                        <label for="tab-1">Already Member?</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>