<?php
    //checks whether the user is logged in or not for access control
    if(!isset($_SESSION['user'])){ //if not user session set, then user is not logged in --> redirect to login page for system
        $_SESSION['no-login'] = "<div class='error text-center'>You are not logged in, please log in to access admin system</div>";
        header("location:".SITEURL.'admin/login.php');
    }
?>