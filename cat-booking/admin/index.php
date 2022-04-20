
<?php include('modular/booking.php') ?>

<!-- Dashboard section starts -->
<div class="main-content text-center">
    <div class="wrapper">
        <h1 strong>Dashboard</h1 strong>
        <br><br>

        <?php
            if(isset($_SESSION['login'])){
            echo $_SESSION['login'];
            unset($_SESSION['login']);
            
            } 
        ?>

        <div class="col-4 text-center">
            <h1>
                <?php
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
                ?>
            <td><?php echo $total_booked ?></td>
            </h1>
            Number of currently booked
        </div>

        <div class="col-4 text-center">
            <h1>
                <?php
                    $sql = "SELECT * FROM tbl_booking WHERE status!='Pending confirmation'"; //sql query to fetch all booking data regardless of whether the customer is booked or not
                    $res = mysqli_query($conn, $sql); //executing the query
                    $total_revenue = 0;

                    if ($res == TRUE){

                        $row_count = mysqli_num_rows($res);

                        if ($row_count>0){

                            while ($rows=mysqli_fetch_assoc($res)){

                                $total= (int) $rows['total']; //counts total for every customer which has been booked into the hotel
                                $total_revenue = $total_revenue + $total; //adds total of customer into running total
                            }

                        }
                    }
                ?>
            <td>$<?php echo $total_revenue ?></td>
            </h1>
            Total Revenue
        </div>

        <div class="col-4 text-center">
            <h1>
            <?php

                $sql = "SELECT * FROM tbl_numrooms WHERE id=1"; //sql query to fetch number of rooms data
                $res = mysqli_query($conn, $sql); //executing the query
                $num = mysqli_fetch_assoc($res);
                $total_rooms = (int) $num['total_rooms'];

                $total_available = $total_rooms - $total_booked; //available rooms is equal to the number of rooms minus the number of rooms booked
                      
            ?>
            <td><?php echo $total_available ?></td>
            </h1>
            Available rooms
        </div>

        <div class="col-4 text-center">
            <h1>

            <?php

                    $sql = "SELECT * FROM tbl_numrooms WHERE id=1"; //sql query to fetch all number of rooms data
                    $res = mysqli_query($conn, $sql); //executing the query
                    $num = mysqli_fetch_assoc($res);
                    $total_rooms = (int) $num['total_rooms'];
                    
                ?>
            
            <td><?php echo $total_rooms ?></td>
            </h1>
            Total number of rooms
        </div>

        <div class="clearfix"></div>
    </div>
</div>
<!-- Dashboard section ends -->

<?php include('modular/footer.php') ?>


