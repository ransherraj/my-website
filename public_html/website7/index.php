<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'links.php' ?>
     
     <link rel="stylesheet" href="css/style.css">
    <title>User registration</title>
    
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

            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="email" id="email" autocomplete="off" required>

            <label for="name"><b>User</b></label>
            <input type="text" placeholder="Enter User Name" name="user" id="name" autocomplete="off" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" id="psw" autocomplete="off" required>

            <label for="teacher"><b> Your Favorite Teacher Name? </b></label>
            <input type="text" placeholder="Enter Your Favorite Teacher Name" name="teacher" id="teacher" autocomplete="off" required>

            <!-- <label for="psw-repeat"><b>Repeat Password</b></label>
            <input type="password" placeholder="Repeat Password" name="pswrepeat" id="psw-repeat" required>
            <hr> -->

            <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
            <button type="submit" name="sub" class="registerbtn">Register</button>

            <div class="signin">
                <p>Already have an account? <a href="#">Sign in</a>.</p>
            </div>
        </div>


    </form>

</body>

</html>

<?php include 'connection.php';

if(isset($_POST['sub'])){
    
    $emaill = $_POST['email'];
    $userr = $_POST['user'];
    $passwordd = $_POST['psw'];
    $teacherr = $_POST['teacher'];

    $query = " INSERT INTO register (email,user,passwordd,teacher) VALUES ('$emaill','$userr','$passwordd','$teacherr') ";

    $res = mysqli_query($con,$query);

    if($res){
        header('location: display.php');
    }
   
}

?>