<?php

    include('../config/constants.php'); //include the mysql connection constant

    $id = $_GET['id']; //getting the value of admin id to be deleted
    
    $sql = "UPDATE `tbl_booking` SET status='Removed' WHERE id=$id"; //creating sql delete query

    $res = mysqli_query($conn, $sql);

    if($res==true){
        $_SESSION['delete'] = "<div class='success'>Customer removed successfully</div>"; //creating session named delete
        header("location:".SITEURL.'admin/manage-booking.php');
    }
    else{
        $_SESSION['add'] = "<div class='error'>Failed to remove customer</div>";
        header("location:".SITEURL.'admin/manage-booking.php');
    }

?>