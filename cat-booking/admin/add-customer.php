<?php include('modular/booking.php') ?>

<?php
    if(isset($_SESSION['add'])){
        echo $_SESSION['add']; //displaying session message
        unset($_SESSION['add']); //removing session message
    }
?>

<?php

    $id = $_GET['id'];

    //updating status data from pending to booked
    $sql = "UPDATE tbl_booking SET 
        status='Booked'
        WHERE id=$id
        ";

    //executing sql query to post data
    $res = mysqli_query($conn, $sql);

    if($res==TRUE){
     
        $_SESSION['add'] = "<div class='success text-center'>Booking successfully added to system</div>"; //create a session variable to display message
        header("location:".SITEURL.'admin/manage-booking.php'); //redirect page to manage-admin to show that new booking has been added to database
        
    }
    else{

        $_SESSION['add'] = "<div class='error'>Failed to add booking to system</div>";
        header("location:".SITEURL.'admin/manage-booking.php');
    }
            
    
?>