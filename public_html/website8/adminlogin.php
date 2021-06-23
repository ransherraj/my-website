<?php
session_start();
include('adminloginheader.php');
include('connection.php');

?>



<section id="login">

    <div class="card bg-light" id="card1">
        <article class="card-body mx-auto" style="max-width: 400px;">
            <hr>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" id="reg-form">

                <div class="form-group input-group">
                    <div class="input-group-prepend" style="text-align: center;">
                        <span class="input-group-text"> <i class="fa fa-envelope"></i><small> Username</small> </span>
                    </div>
                    <input name="username" value="" id="email" class="form-control" placeholder="username" type="username" required>
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

                            $username = $_POST['username'];

                            $_SESSION['USERNAME'] = $username;

                            $password = $_POST['password'];
                            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                            $user_search = "SELECT * FROM loginpageadmin WHERE USERNAME = '$username'";

                            $query = mysqli_query($con, $user_search);
                            $user_count = mysqli_num_rows($query);

                            if ($user_count) {
                                $user_pass = mysqli_fetch_assoc($query);
                                $db_pass = $user_pass['PASSWORD'];
                                // echo "$db_pass";
                                // echo "$password";
                                echo strcmp($db_pass,$password);
                                // $pass_decode = password_verify($hashed_password, $db_pass);

                                if (!strcmp($db_pass,$password)) {
                                    echo "Login Successful";
                                    ?>
                                        <script>
                                            alert('Sucessfully Logged In');
                                            location.replace('index3.php')

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
                
            </form>
        </article>
    </div>



</section>

<?php include('loginfooter.php'); ?>