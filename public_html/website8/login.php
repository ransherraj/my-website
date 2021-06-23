<?php
 session_start();
include('loginheader.php');
include('connection.php');

?>






<section id="login">



    <div class="card bg-light" id="card1">
        <article class="card-body mx-auto" style="max-width: 400px;">
            <hr>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" id="reg-form">



                <div class="form-group input-group">
                    <div class="input-group-prepend" style="text-align: center;">
                        <span class="input-group-text"> <i class="fa fa-envelope"></i><small> Email</small> </span>
                    </div>
                    <input name="email" value="" id="email" class="form-control" placeholder="Email address" type="email" required>
                </div> <!-- form-group// -->

                <div class="form-group input-group">
                    <div class="input-group-prepend" style="text-align: center;">
                        <span class="input-group-text"> <i class="fa fa-lock"></i> <small> Password</small></span>
                    </div>
                    <input class="form-control" value="" name="password" id="password" placeholder="password" type="password" required>
                </div> <!-- form-group// -->

                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-primary btn-block"> login </button>
                    <small style="color: red;" id="warning">

                        <?php
                    
                        if (isset($_POST['submit'])) {

                            $email = $_POST['email'];

                            $_SESSION['email'] = $email;

                            $password = $_POST['password'];

                            $email_search = "SELECT * FROM registeruser WHERE email = '$email'";

                            $query = mysqli_query($con, $email_search);
                            $email_count = mysqli_num_rows($query);

                            if ($email_count) {
                                $email_pass = mysqli_fetch_assoc($query);
                                $db_pass = $email_pass['password'];
                                $pass_decode = password_verify($password, $db_pass);
                                
                                if ($pass_decode) {
                                    echo "Login Successful";
                                    ?>
                                        <script>
                                            alert('Sucessfully Logged In');
                                            location.replace('index2.php')

                                        </script>
                                    <?php
                                } else {
                                    echo "Password Incorrect";
                                }
                            } else {
                                echo "Invalid Details!!";
                            }
                        }
                        ?>



                    </small>
                </div> <!-- form-group// -->
                <p class="text-center">NOT Have an account? <a href="register.php">register</a> </p>
            </form>
        </article>
    </div>



</section>

<?php include('loginfooter.php'); ?>