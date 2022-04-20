<?php include('../config/constants.php'); //include the mysql connection constant ?>


<html>
    <head>
        <title> Admin Login </title>
        <link rel="stylesheet" href="../css/backend.css">
    </head>


    <body>
        <div class="login">
            <br><br>
            <h1 class="text-center"> Admin Login </h1>

            <br><br>
            <?php
                if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                } 

                if(isset($_SESSION['no-login'])){
                    echo $_SESSION['no-login'];
                    unset($_SESSION['no-login']);
                } 

            ?>

            <form action="" method="POST" class="text-center">

            <br><br>Username: 
            <input type="text" name="username" placeholder="Enter Username">
            

            <br><br>Password: 
            <input type="password" name="password" placeholder="Enter Password">

            <br><br><input type="submit" name="submit" value="Login" class="btn-primary">
            <br><br>

            </form>
            <p class = "text-center"> 2022 Computer Science IA - Cat Hotel</p>
    </div>
</html>

<?php

    if(isset($_POST['submit'])){ //login validation process will carry out if login button is pressed

        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'"; //sql check to see if login detail exists in database

        $res =  mysqli_query($conn, $sql);

        $row_count = mysqli_num_rows($res);

        if($row_count==1){

            $_SESSION['login'] = "<div class='success'>Login successful</div>";
            $_SESSION['user'] = $username; //checks if user is logged in or not

            header("location:".SITEURL.'admin/');

        }
        else{
            $_SESSION['login'] = "<div class='error text-center' >Failed to login, incorrect details. Try again.</div>";
            header("location:".SITEURL.'admin/login.php');
        }
    }
?>