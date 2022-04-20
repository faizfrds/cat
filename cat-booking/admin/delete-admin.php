<?php

    include('../config/constants.php'); //include the mysql connection constant

    $id = $_GET['id']; //getting the value of admin id to be deleted
    
    $sql = "DELETE FROM `tbl_admin` WHERE id=$id"; //creating sql delete query

    $res = mysqli_query($conn, $sql);

    if($res==true){
        $_SESSION['delete'] = "<div class='success'>Admin removed successfully</div>"; //creating session named delete
        header("location:".SITEURL.'admin/manage-admin.php');
    }
    else{
        $_SESSION['add'] = "<div class='error'>Failed to remove admin</div>";
        header("location:".SITEURL.'admin/manage-admin.php');
    }

?>