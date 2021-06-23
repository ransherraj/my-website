<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'links.php' ?>

    <link rel="stylesheet" href="css/style.css">
    <title>registered data</title>
</head>

<body>


    <div class="container">
        <h1>List of registered candidate and their data</h1>
        <div class="center-div">
            <div class="table-responsive">
                <table class="table table-bordered border-primary">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th class="email">Email</th>
                            <th>User</th>
                            <th>Password</th>
                            <th>Favorite Teacher</th>
                            <th colspan="2">Operations</th>
                        </tr>
                    </thead>
                    <tbody>


                        <?php

                        include 'connection.php';

                        $selectquery = "select * from register";

                        $query = mysqli_query($con, $selectquery);

                        // $num = mysqli_num_rows($query);

                        // echo $num;


                        while ($res = mysqli_fetch_array($query)) {
                            // echo $res['user'] . "<br>";

                        ?>
                            <tr>
                                <td><?php echo $res['id']; ?></td>
                                <td><?php echo $res['email']; ?></td>
                                <td><?php echo $res['user']; ?></td>
                                <td><?php echo $res['passwordd']; ?></td>
                                <td><?php echo $res['teacher']; ?></td>
                                <td> <a href="update.php?id=<?php echo $res['id']; ?>" data-toggle="tooltip" data-placement="bottom" title="Update"><i class="bi bi-pencil-square"></i></a> </td>
                                <td> <a href="delete.php?id=<?php echo $res['id']; ?>" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="bi bi-trash-fill"></i></a></td>

                            </tr>

                        <?php
                        }



                        ?>



                    </tbody>
                </table>
            </div>
        </div>
        <div>
            <a style="text-decoration: none;" href="index.php">Register Now</a>
        </div>
    </div>
</body>

</html>