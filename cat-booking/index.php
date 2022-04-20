<?php include('modular-frontend/booking.php') ?>

<?php
    if(isset($_SESSION['add'])){
    echo $_SESSION['add']; //displaying session message
    unset($_SESSION['add']); //removing session message
    }
?>


    <!-- Room display section starts -->
    <section class="rooms">
        <div class="container">
            <h2 class="text-center">Explore Room Types For Your Cat(s)</h2>

            <?php
                
                $sql = "SELECT * FROM tbl_room WHERE active='Yes' AND featured='Yes' LIMIT 3"; //creating sql query
                $res = mysqli_query($conn, $sql); //executing sql query

                $count = mysqli_num_rows($res); //check whther there is any room to display from the database

                if($count>0){
                    while($row=mysqli_fetch_assoc($res)){
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>

                        <a href="room.php">
                            <div class="box-3 float-container">

                                <?php
                                    if($image_name==""){ //checks if image name exists
                                        echo "<div class='error'>Image not available</div>"; //if image name doesn't exist, error message shows
                                    }
                                    else{
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/room/<?php echo $image_name; ?>" width="300px" height="300px" alt="Luxury" class="img-responsive img-curve">
                                        <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                        <?php //if image exists, image is displayed using html image tag
                                    }
                                ?>
                            </div>
                        </a>

                        <?php
                    }
                }
                else{
                    echo "<div class 'error'>No room to show</div>";
                }

            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Room display section ends -->
    
    <!-- Book button section starts -->
    <section class="book-button text-center">
        <div class="wrapper-book">
            
            <a href="book.php" class="btn btn-primary">Book Now</a>

        </div>
    </section>
    <!-- Book button section ends -->

    <!-- Service display section starts -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Services We Provide</h2>

            <?php //creating and executing query to retrieve all information from database

            $sql = "SELECT * FROM tbl_service WHERE active='Yes' AND featured='YES'";
            $res = mysqli_query($conn, $sql); //executing the query

            if($res == TRUE){  

                $row_count = mysqli_num_rows($res); //function to check the number of rows in the database
                $idchange=1; //avoids the id number not showing in order

                if ($row_count>0){

                    while ($rows=mysqli_fetch_assoc($res)){ //while loop runs as long as there is data in the database

                    $title=$rows['title'];
                    $price=$rows['price'];
                    $image_name=$rows['image_name'];
                    ?>

                    <div class="service-menu-box">

                        <div class="service-menu-img"><img src ="<?php echo SITEURL; ?>images/service/<?php echo $image_name; ?>" width="200px" height="175px" float="left"></div>
                        
                        <div class="service-menu-desc">
                            <div>
                                <h3><?php echo $title ?></h3>
                                <p class="service-price">$<?php echo $price ?></p>
                            </div>
                        </div>
                        <br>
                        
                    </div>
                    <?php
                    }
                }
            }
            ?>

            <div class="clearfix"></div>

        </div>

        <p class="text-center">
            <a href="service.php">See All Services</a>
        </p>
    </section>
    <!-- Service display section ends -->

<?php include('modular-frontend/footer.php') ?>