<?php
    //start session
    session_start();

    //mysql connection constant to avoid repetiton of code

    define('SITEURL', 'http://localhost/cat-booking/'); //home url
    $conn = mysqli_connect('localhost', 'root', '', 'cat-booking') or die(mysqli_error());

?>