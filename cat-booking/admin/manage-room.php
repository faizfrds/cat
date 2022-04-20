<?php include('modular/booking.php') ?>

    <div class="main-content">
        <div class="wrapper">
            <h1 strong>Room Manager</h1 strong>
                
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

                <br /><br /><br />
                <!--button to add admin -->
                
                <a href='<?php echo SITEURL; ?>admin/add-room.php' class='btn-primary'>Add Room Type </a>

                <br /><br /><br />
                <table class="tbl-full" >
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>

                    <?php //creating and executing query to retrieve all information from database

                        $sql = "SELECT * FROM tbl_room"; //sql query to fetch all room data
                        $res = mysqli_query($conn, $sql); //executing the query

                        if($res == TRUE){

                            $row_count = mysqli_num_rows($res); //function to check the number of rows in the database
                            $idchange=1; //avoids the id number not showing in order

                            if ($row_count>0){

                                while ($rows=mysqli_fetch_assoc($res)){ //while loop runs as long as there is data in the database

                                    $id=$rows['id'];
                                    $title=$rows['title'];
                                    $description=$rows['description'];
                                    $price=$rows['price'];
                                    $image_name=$rows['image_name'];
                                    $featured=$rows['featured'];
                                    $active=$rows['active'];

                                    ?>

                                    <tr>
                                        <td><?php echo $idchange++ ?></td>
                                        <td><?php echo $title ?></td>
                                        <td><?php echo $description ?></td>
                                        <td>$<?php echo $price; ?></td>

                                        <td> <!-- displaying image in page -->
                                            <?php 
                                        
                                            if ($image_name!=""){ //check if image name exists
                                                ?>
                                                <img src ="<?php echo SITEURL; ?>images/room/<?php echo $image_name; ?>" width="100px" height="100px">
                                                <?php
                                            } 
                                            else{
                                                echo "<div class='error'>No product image uploaded</div>";
                                            }
                                            ?>
                                        </td>


                                        <td><?php echo $featured ?></td>
                                        <td><?php echo $active ?></td>
                                        <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-room.php?id=<?php echo $id; ?>" class="btn-secondary">Update Room </a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-room.php?id=<?php echo $id; ?>"class="btn-danger">Delete Room </a> 
                                        </td>
                                    </tr>

                                    <?php
                                }
                            }
                        }

                    ?>

                        
                </table>
        </div>
    </div>
        
<?php include('modular/footer.php') ?>