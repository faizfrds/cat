<?php include('modular-frontend/booking.php') ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore the types of service we provide</h2>

            
            <?php
                $sql = "SELECT * FROM tbl_service WHERE active='Yes'";
                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if($count>0){
                    while($row=mysqli_fetch_assoc($res)){
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        ?>

                       
                        <div class="box-3 float-container">

                            <?php
                                if($image_name==""){ //checks if image name exists
                                    echo "<div class='error'>Image not available</div>"; //if image name doesn't exist, error message shows
                                }
                                else{
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/service/<?php echo $image_name; ?>" width="300px" height="300px" alt="Luxury" class="img-responsive img-curve">
                                    <h3><?php echo $title; ?></h3>
                                    <figcaption>$<?php echo $price; ?></figcaption>
                                    <?php //if image exists, image is displayed using html image tag
                                }
                            ?>
                        </div>
                        

                        <?php
                    }
                }
            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

<?php include('modular-frontend/footer.php') ?>