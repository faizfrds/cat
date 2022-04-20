<?php include('modular/booking.php') ?>

<div class="main-content">
            <div class="wrapper">
                <h1 strong>Booking Manager</h1 strong>

                <br /><br />

                <?php
                    if(isset($_SESSION['add'])){
                        echo $_SESSION['add']; //displaying session message
                        unset($_SESSION['add']); //removing session message
                    }
                ?>

                <?php
                    if(isset($_SESSION['delete'])){
                        echo $_SESSION['delete']; //displaying session message
                        unset($_SESSION['delete']); //removing session message
                    }
                ?>

                <tr><td> Total number of rooms currently: </td></tr>
                <?php

                    $sql = "SELECT * FROM tbl_numrooms WHERE id=1"; //sql query to fetch all admin data
                    $res = mysqli_query($conn, $sql); //executing the query
                    $num = mysqli_fetch_assoc($res);
                    $total_rooms = (int) $num['total_rooms'];
                    
                ?>
                
                <?php echo $total_rooms ?></td>
                <br><br>

                <form action="" method="POST">
                
                    <tr>
                        <td> Modify number of rooms: </td>
                        <td><input type="number" name="num-rooms" min=1></td>

                    </tr>
                    <br><br>

                    <tr>
                        <td colspan="2">
                        <input type="submit" name="submit" value="Update number of rooms" class="btn-secondary">
                        </td>

                    </tr>
                
                </form>

                <?php
                if(isset($_POST['submit'])){ //check whether submit button is clicked or not

                    $num_rooms = $_POST['num-rooms']; //getting date from the form using the name
            
                    //sql query of data, name on left is name of column; name of right is name of value of data from form. Insert query.
                    $sql = "UPDATE tbl_numrooms SET
                        total_rooms='$num_rooms'
                        WHERE id=1
                    "; 
            
                    $res = mysqli_query($conn, $sql); //executing sql query to post data 
                    header("location:".SITEURL.'admin/manage-booking.php'); //refreshes page to show new number of rooms
                }
                ?>
                

                <br /><br /><br />
                <table class="tbl-full" >
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Room Type</th>
                        <th>Length of Stay</th>
                        <th>Additional Service</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                        $sql = "SELECT * FROM tbl_booking"; //sql query to fetch all booking data
                        $res = mysqli_query($conn, $sql); //executing the query

                        if($res == TRUE){

                            $row_count = mysqli_num_rows($res); //function to check the number of rows in the database
                            $idchange=1; //avoids the id number not showing in order

                            if ($row_count>0){

                                while ($rows=mysqli_fetch_assoc($res)){ //while loop runs as long as there is data in the database

                                    $id=$rows['id'];
                                    $fullname=$rows['fullname'];
                                    $email=$rows['email'];
                                    $room=$rows['room'];
                                    $length_stay=$rows['length_stay'];
                                    $additional_services=$rows['additional_services'];
                                    $total=$rows['total'];
                                    $status=$rows['status'];

                                    ?>

                                    <?php
                                    
                                    if ($status!='Removed'){
                                        ?>
                                        <tr>
                                            <td><?php echo $idchange++ ?></td>
                                            <td><?php echo $fullname ?></td>
                                            <td><?php echo $email ?></td>
                                            <td><?php echo $room ?></td>
                                            <td><?php echo $length_stay ?></td>
                                            <td><?php echo $additional_services ?></td>
                                            <td>$<?php echo $total ?></td>
                                            <td><?php echo $status ?></td>
                                        
                                            <?php                      
                                                if ($status=='Pending confirmation'){ //admin needs to confirm booking first before being added to system i.e. customer needs to pay first before being booked
                                                    ?>
                                                    <td><a href="<?php echo SITEURL; ?>admin/add-customer.php?id=<?php echo $id; ?>"class="btn-secondary">Confirm Booking </a></td>
                                                    <td><a href="<?php echo SITEURL; ?>admin/decline-customer.php?id=<?php echo $id; ?>"class="btn-tertiary">Decline Booking </a></td>
                                                    <?php
                                                }
                                                else if ($status=='Booked'){ //admin can checkout customer if they are currently booked
                                                    ?>
                                                    <td><a href="<?php echo SITEURL; ?>admin/checkout-customer.php?id=<?php echo $id; ?>"class="btn-danger">Checkout Customer </a> </td>
                                                    <?php
                                                }
                                                else{ //admin can decide whether to keep or remove customer data once they have checked out
                                                    ?>
                                                    <td><a href="<?php echo SITEURL; ?>admin/delete-customer.php?id=<?php echo $id; ?>"class="btn-tertiary">Remove Customer </a></td>
                                                    <?php
                                                }
                                            ?>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    
                                    <?php

                                }
                            }
                        }
                    ?>
   
                </table>
            </div>
        </div>
        
<?php include('modular/footer.php') ?>