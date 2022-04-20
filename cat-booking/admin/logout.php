<?php

    include('../config/constants.php'); //include the mysql connection constant
    session_destroy(); //unsets user session and logout from the system

    header("location:".SITEURL.'admin/login.php');

?>