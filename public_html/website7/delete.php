<?php

include 'connection.php';

 $ids = $_GET['id'];

 $delete = "DELETE from register where id = $ids ";
 $query = mysqli_query($con,$delete);

 if($query){
    
     header('location: display.php');
 }

?>