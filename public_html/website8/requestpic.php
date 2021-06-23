<?php 

session_start();
include("requestpicupheader.php");
include("connection.php");


?>

<?php

    if (isset($_POST['req_submit'])) {
        $fullname = $_POST['fullname'];
        $EMAIL = $_POST['emailaddress'];
        $service = $_POST['service'];
        $address = $_POST['address'];
        $comments = $_POST['comments'];

        // $_SESSION['req_email'] = $EMAIL;

        $query = "INSERT INTO requestpickup (`fullname`,`emailaddress`,`service`,`address`,`comments`,`registerdate`) VALUES ('$fullname','$EMAIL','$service','$address','$comments',NOW())";
        $res = mysqli_query($con, $query);

        if ($res) {
    ?>
            <script>
                alert("Your data sent properly");
                location.replace('index2.php');
            </script>

        <?php

        } else {
        ?>
            <script>
                alert("Data not inserted");
            </script>

    <?php
        }

    }
    ?>

    <!--------------------------------------------------------------------------------------->



    <section class="bg0 p-t-104 p-b-116">
        <div class="container">
            <!--<div class="flex-w flex-tr">-->
            <div class="bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <h4 class="mtext-105 cl2 txt-center p-b-30">
                        Send Request for a Pickup
                    </h4>



                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="fullname" placeholder="Your Name" required>
                        <img class="how-pos4 pointer-none" src="images/icons/icon-name.jpg" alt="ICON">
                    </div>

                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="emailaddress" placeholder="Email" required>
                        <img class="how-pos4 pointer-none" src="images/icons/icon-name.jpg" alt="ICON">
                    </div>



                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" list="dropdown" type="text" name="service" placeholder="Service Required" required>
                        <img class="how-pos4 pointer-none" src="images/icons/service.jpg" alt="ICON">
                        <datalist id="dropdown">
                            <option value="Residential Waste">
                            <option value="Industrial Waste">
                            <option value="Commercial Waste">
                            <option value="Plastic Recycling">
                            <option value="Paper Recycling">
                            <option value="Purchase of Scrap">
                        </datalist>
                    </div>

                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="address" placeholder="Address" required>
                        <img class="how-pos4 pointer-none" src="images/icons/location.jpg" alt="ICON">
                    </div>

                    <div class="bor8 m-b-30">
                        <textarea class="stext-111 cl2 plh3 size-120 p-lr-28 p-tb-25" name="comments" placeholder="Any Additional Comments"></textarea>
                    </div>




                    <button name="req_submit" class="flex-c-m m-b-30 stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
                        Send Request
                    </button>
                </form>

                <h4 class="mtext-104 cl2 txt-center p-b-30">
                    Facing any issue? Feel free to <a href="contact.php">Contact Us</a>
                </h4>

            </div>


        </div>
    </section>










<?php 
include("footer.php");

?>