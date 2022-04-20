<?php include('modular-frontend/booking.php') ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="container">
        <div class="booking-page">
            
            <br>
            <h2 class="text-center">Fill this form to request your booking.</h2>

            <?php
            if(isset($_SESSION['add'])){
            echo $_SESSION['add']; //displaying session message
            unset($_SESSION['add']); //removing session message
            }

            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload']; //displaying session message
                unset($_SESSION['upload']); //removing session message
            }
            ?>

            <form action="" method="POST">
                
                
                <fieldset>

                    <td><div class="order-label">Room Type</div></td>
   
                        <?php
                        
                            $sql= "SELECT title FROM tbl_room";
                            $res= mysqli_query($conn, $sql);
            
                            $row_count = mysqli_num_rows($res);

                            if ($row_count>0){

                                while ($rows=mysqli_fetch_assoc($res)){ //while loop runs as long as there is data in the database
                                    $title=$rows['title'];
                                    echo $title;
                                    ?>
                                    <input type="radio" name="room-type" value="<?php echo $title; ?>" required><br>
                                    <?php
                                    ob_start();
                                }
                            }
                        ob_end_flush()    
                        ?>
   
                    <legend>Customer Details</legend>

                    <br> 
                    <tr>
                        <br> 
                        <td>
                            <div class="order-label">Full Name</div>
                            <input type="text" name="fullname" placeholder="Enter Your Full Name" class="input-responsive" required>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="order-label">Email</div>
                             <input type="email" name="email" placeholder="Enter Your Email" class="input-responsive" required>
                        </td>
                    </tr>

                    
                    <tr>
                        <td>
                            <div class="order-label">Length of Stay (days) </div>
                            <input type="number" name="lengthstay" min="1" max="100" required> <br>
                            Note: Booking cannot be longer than 100 days <br>
                        </td>
                    </tr>

                    <br>
                    <td><div class="order-label">Additional Service</div></td>
   
                        <?php
                            $sql= "SELECT title FROM tbl_service";
                            $res= mysqli_query($conn, $sql);
            
                            $row_count = mysqli_num_rows($res);

                            if ($row_count>0){

                                while ($rows=mysqli_fetch_assoc($res)){ //while loop runs as long as there is data in the database
                                    $title=$rows['title'];
                                    echo $title;
                                    ?>
                                    <input type="radio" name="additionalservices" value="<?php echo $title; ?>" required><br>
                                    <?php
                                }
                            }
                        ?>
                            
                    <br>
                    <tr>
                        <td>
                        <input type="submit" name="submit" value="Request Booking" class="btn btn-primary">
                        </td>
                    </tr>

                    
                </fieldset>

            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

<?php include('modular-frontend/footer.php') ?>

<?php
    //process the value for form and save to database
    
    //getting date from the form using the title
    if(isset($_POST['submit'])){//check whether submit button is clicked or not

        //getting date from the form using the title
        $room = $_POST['room-type'];
        $email = $_POST['email'];
        $fullname = $_POST['fullname'];
        $length_stay = $_POST['lengthstay'];
        $additional_services = $_POST['additionalservices'];
        $status = "Pending confirmation";

        $sql= "SELECT price FROM tbl_room WHERE title='$room'"; //finding the room price on tbl_room based on the room chosen from input
        $res= mysqli_query($conn, $sql);
        $row= mysqli_fetch_assoc($res);

        $price=(int) $row['price'];

        $total = $price * $length_stay;

        $sql= "SELECT price FROM tbl_service WHERE title='$additional_services'"; //finding the service price on tbl_service based on the service chosen from input
        $res= mysqli_query($conn, $sql);
        $row= mysqli_fetch_assoc($res);

        $price=(int) $row['price'];

        $total = $total+$price; //running total using incrementation


        //check to see how many are currently booked
        $sql = "SELECT * FROM tbl_booking"; //sql query to fetch all booking data
        $res = mysqli_query($conn, $sql); //executing the query
        $total_booked = 0;

            if ($res == TRUE){

                $row_count = mysqli_num_rows($res);

                if ($row_count>0){

                while ($rows=mysqli_fetch_assoc($res)){

                    $booked_status = $rows['status']; //if status is booked, increment the total number of booked people

                    if ($booked_status=='Booked'){
                        $total_booked++;
                    }
                }
                        
            }

        }
        
        //check to see how many rooms are available
        $sql = "SELECT * FROM tbl_numrooms WHERE id=1"; //sql query to fetch all booking data
        $res = mysqli_query($conn, $sql); //executing the query
        $num = mysqli_fetch_assoc($res);
        $total_rooms = (int) $num['total_rooms'];

        $total_available = $total_rooms - $total_booked; //available rooms is equal to the number of rooms minus the number of rooms booked

        if($total_available != 0){ //if there are rooms available, customer can continue to book

            
            $sql = "INSERT INTO tbl_booking SET
            room='$room',
            email='$email',
            fullname='$fullname',
            length_stay='$length_stay',
            additional_services='$additional_services',
            total='$total', 
            status='$status'
            ";

            //executing sql query to post data
            $res = mysqli_query($conn, $sql);

            if($res==TRUE){
     
                $_SESSION['add'] = "<div class='success text-center'>Booking requested successfully, your total will be $$total. Check your email for payment process.</div>";
                header("location:".SITEURL.'index.php');
        
            }
            else{

                $_SESSION['add'] = "<div class='error'>Failed to request booking</div>";
                header("location:".SITEURL.'book.php');
            }
        }
        else{
            $_SESSION['add'] = "<div class='error text-center'>Sorry, no more rooms available. Try again later.</div>";
            header("location:".SITEURL.'book.php');
        }
                
    }

?>

