<?php

    include('../config/constants.php'); //include the mysql connection constant

    $id = $_GET['id'];
    
    $sql = "DELETE FROM `tbl_room` WHERE id=$id"; //creating sql delete query

    $res = mysqli_query($conn, $sql);

    if($res==true){
        $_SESSION['delete'] = "<div class='success'>Room removed successfully</div>"; //creating session named delete
        header("location:".SITEURL.'admin/manage-room.php');
    }
    else{
        $_SESSION['add'] = "<div class='error'>Failed to remove room</div>";
        header("location:".SITEURL.'admin/manage-room.php');
    }

?>