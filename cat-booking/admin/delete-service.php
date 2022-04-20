<?php

    include('../config/constants.php'); //include the mysql connection constant

    $id = $_GET['id'];
    
    $sql = "DELETE FROM `tbl_service` WHERE id=$id"; //creating sql delete query

    $res = mysqli_query($conn, $sql);

    if($res==true){
        $_SESSION['delete'] = "<div class='success'>Service removed successfully</div>"; //creating session named delete
        header("location:".SITEURL.'admin/manage-service.php');
    }
    else{
        $_SESSION['add'] = "<div class='error'>Failed to remove service</div>";
        header("location:".SITEURL.'admin/manage-service.php');
    }

?>