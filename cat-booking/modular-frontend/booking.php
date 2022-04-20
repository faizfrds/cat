<?php include('config/constants.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cat Hotel Customer</title>

    <link rel="stylesheet" href="css/frontend.css"> <!-- Link to CSS -->
</head>

<body>
    <!-- Navigation bar section starts -->
    <section class="navbar">
        <div class="container">

            <div class="menu text-center">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL; ?>">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>room.php">Room Types</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>service.php">Services</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>book.php">Book</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>admin/login.php">Admin Login</a>
                    </li>

                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navigation bar section ends -->
