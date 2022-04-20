<?php 
include('../config/constants.php');
include('login-check.php'); ?> <!-- Since booking.php is used in all pages,
I can input the constant.php here to avoid more repetition of code -->

<html>
    <head>
        <title>Cat Hotel Admin</title>

        <link rel="stylesheet" href="../css/backend.css">
    </head>

<!-- NAvigation bar section starts -->
    <body>
        <div class="booking text-center"> <!-- Integrating CSS class into HTML -->
            <div class="wrapper">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="manage-admin.php">Admin</a></li>
                    <li><a href="manage-booking.php">Bookings</a></li>
                    <li><a href="manage-room.php">Room</a></li>
                    <li><a href="manage-service.php">Services</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
<!-- NAvigation bar section ends -->
