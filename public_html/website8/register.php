

<?php
include('connection.php');
session_start();
?>



<?php

if (isset($_POST['submit'])) {
    $USERNAME = $_POST['username'];
    $EMAIL = $_POST['email'];
    $PHONE = $_POST['phone'];
    $PASSWORD = $_POST['password'];
    $hashed_password = password_hash($PASSWORD, PASSWORD_DEFAULT);
    $PROFILEIMAGE = $_FILES['file'];


    // print_r($USERNAME);
    // print_r($PROFILEIMAGE);

    $filename = $PROFILEIMAGE['name'];
    $fileerror = $PROFILEIMAGE['error'];
    $filetemp = $PROFILEIMAGE['tmp_name'];

    $fileext = explode('.', $filename);
    $filecheck = strtolower(end($fileext));
    $fileextstored = array('png', 'jpg', 'jpeg');

    $res = false;
    if (in_array($filecheck, $fileextstored)) {
        $destinationfile = 'images/uploads/' . $filename;
        move_uploaded_file($filetemp, $destinationfile);



        // multiple email check

        $emailquery = "SELECT * FROM registeruser where email = '$EMAIL' ";
        $q = mysqli_query($con,$emailquery);

        $emailcount = mysqli_num_rows($q);

        if($emailcount>0){
            echo "Email Already Exists ";
            echo("\n");
        }

        else{

            $query = "INSERT INTO `registeruser`(`username`, `email`, `phone`, `password`, `profileimage`, `registerdate`) VALUES ('$USERNAME','$EMAIL','$PHONE','$hashed_password','$destinationfile',NOW())";
            $res = mysqli_query($con, $query);
        }


       
    }

    if ($res) {
        
        
           
            // unset($_POST['submit']);

            // $_SESSION['is_register'] = true;
            // $_SESSION['username'] = $USERNAME;
            ?>

            <script>
                alert("Registered Successfully");
                location.replace("login.php");
            </script>
                
            <?php
            
            
            
            
        
    }

    else{
        print "Data NOT inserted";
    }
}
?>

<?php
include('registerheader.php');
?>



<section id="register">



    <div class="card bg-light" id="card1">
        <article class="card-body mx-auto" style="max-width: 400px;">
            <hr>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" id="reg-form">

                <div class="form-group input-group">
                    <!-- <div class="input-group-prepend" style="text-align: center;">

                            <span class="input-group-text"><i class="fa fa-image"></i> <small>Add Profile picture</small> </span>

                        </div> -->

                    <div class="upload-profile-image d-flex justify-content-center">
                        <div class="text-center">
                            <div class="d-flex justify-content-center">
                                <img style="margin-top:-120px; width: 300px; height: 300px;" class="img rounded-circle " id="profileimage" src="images/icons/human01.png" alt="">
                            </div>

                        </div>
                    </div>
                    <input value="<?php if (isset($_POST['file'])) echo $_POST['file'] ?>" class=" d-flex justify-content-center" name="file" type="file" id="profileimageupload" required>
                </div> <!-- form-group// -->
                <hr>


                <div class="form-group input-group">
                    <div class="input-group-prepend" style="text-align: center;">
                        <span class="input-group-text"><i class="fa fa-user"></i> <small>User Name</small> </span>
                    </div>
                    <input name="username" value="<?php if (isset($_POST['username'])) echo $_POST['username'] ?>" id="username" class="form-control" validation="true" placeholder="Full name" type="text" required>
                </div> <!-- form-group// -->
                <div class="form-group input-group">
                    <div class="input-group-prepend" style="text-align: center;">
                        <span class="input-group-text"> <i class="fa fa-envelope"></i><small> Email</small> </span>
                    </div>
                    <input name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email'] ?>" id="email" class="form-control" placeholder="Email address" type="email" required>
                </div> <!-- form-group// -->
                <div class="form-group input-group">
                    <div class="input-group-prepend" style="text-align: center;">
                        <span class="input-group-text"> <i class="fa fa-phone"></i> <small> Phone Number</small></span>
                    </div>

                    <input name="phone" value="<?php if (isset($_POST['phone'])) echo $_POST['phone'] ?>" id="phone" class="form-control" placeholder="Phone number" type="text" required>
                </div> <!-- form-group// -->

                <div class="form-group input-group">
                    <div class="input-group-prepend" style="text-align: center;">
                        <span class="input-group-text"> <i class="fa fa-lock"></i> <small> Password</small></span>
                    </div>
                    <input class="form-control" value="<?php if (isset($_POST['password'])) echo $_POST['password'] ?>" name="password" id="password" placeholder="Create password" type="password" required>
                </div> <!-- form-group// -->
                <div class="form-group input-group">
                    <div class="input-group-prepend" style="text-align: center;">
                        <span class="input-group-text"> <i class="fa fa-lock"></i> <small> Repeat Password</small></span>
                        <small style="color: red;" id="confirm_error"></small>
                    </div>
                    <input class="form-control" value="<?php if (isset($_POST['cpassword'])) echo $_POST['cpassword'] ?>" name="cpassword" id="cpassword" placeholder="Repeat password" type="password" required>
                </div> <!-- form-group// -->
                <div class="form-group">
                    <button type="submit" name="submit" id="submit" class="btn btn-primary btn-block"> Create Account </button>
                </div> <!-- form-group// -->
                <p class="text-center">Have an account? <a href="login.php">Log In</a> </p>
            </form>
        </article>
    </div>



</section>






<?php

include('footer.php');
?>