<?php

    include('../config/constants.php'); //include the mysql connection constant

    $id = $_GET['id'];
    
    $sql = "UPDATE tbl_booking SET status='Checked out' WHERE id=$id"; //creating sql delete query

    $res = mysqli_query($conn, $sql);

    if($res==true){
        $_SESSION['delete'] = "<div class='success'>Customer checked out successfully</div>"; //creating session named delete
        header("location:".SITEURL.'admin/manage-booking.php');
    }
    else{
        $_SESSION['add'] = "<div class='error'>Failed to check out customer</div>";
        header("location:".SITEURL.'admin/manage-booking.php');
    }

?>