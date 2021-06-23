<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'links.php' ?>

    <link rel="stylesheet" href="css/style.css">
    <title>User registration Update</title>

</head>

<body>


    <form method="POST" action="">
        <div class="container">
            <h1>Register</h1>
            <p>Please fill in this form to create an account.</p>
            <hr>
            <hr>
            <h3>List of registered candidates</h3>
            <a href="display.php">Click Here</a>
            <hr>

            <?php include 'connection.php';

            $ids = $_GET['id'];
            $selectquery = "SELECT * from register where id={$ids}";
            $showdata = mysqli_query($con, $selectquery);
            $arraydata = mysqli_fetch_array($showdata);


            if (isset($_POST['sub'])) {

                $idupdate = $_GET['id'];

                $emaill = $_POST['email'];
                $userr = $_POST['user'];
                $passwordd = $_POST['psw'];
                $teacherr = $_POST['teacher'];

                // $query = " INSERT INTO register (email,user,passwordd,teacher) VALUES ('$emaill','$userr','$passwordd','$teacherr') ";

                $query = "UPDATE register set email='$emaill' , user='$userr',passwordd='$passwordd',teacher='$teacherr' where id=$idupdate";
                $res = mysqli_query($con, $query);

                if ($res) {
                header('location: display.php');
                }
                
            }

            ?>


            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter Email" value="<?php echo $arraydata['email']; ?>" name="email" id="email" autocomplete="off" required>

            <label for="name"><b>User</b></label>
            <input type="text" placeholder="Enter User Name" value="<?php echo $arraydata['user']; ?>" name="user" id="name" autocomplete="off" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" value="<?php echo $arraydata['passwordd']; ?>" name="psw" id="psw" autocomplete="off" required>

            <label for="teacher"><b> Your Favorite Teacher Name? </b></label>
            <input type="text" placeholder="Enter Your Favorite Teacher Name" value="<?php echo $arraydata['teacher']; ?>" name="teacher" id="teacher" autocomplete="off" required>

            <!-- <label for="psw-repeat"><b>Repeat Password</b></label>
            <input type="password" placeholder="Repeat Password" name="pswrepeat" id="psw-repeat" required>
            <hr> -->

            <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
            <button type="submit" name="sub" class="registerbtn">Update</button>

            <div class="signin">
                <p>Already have an account? <a href="#">Sign in</a>.</p>
            </div>

            <div>
                <a style="text-decoration: none;" href="index.php">Register Now</a>
            </div>
        </div>


    </form>



</body>

</html>