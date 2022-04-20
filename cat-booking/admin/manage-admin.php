<?php include('modular/booking.php') ?>

    <div class="main-content">
            <div class="wrapper">
                <h1 strong>Admin Manager</h1 strong>
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
                <a href='add-admin.php' class='btn-primary'>Add Admin </a>

                <br /><br /><br />
                <table class="tbl-full" >
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                        $sql = "SELECT * FROM tbl_admin"; //sql query to fetch all admin data
                        $res = mysqli_query($conn, $sql); //executing the query

                        if($res == TRUE){

                            $row_count = mysqli_num_rows($res); //function to check the number of rows in the database
                            $idchange=1; //avoids the id number not showing in order

                            if ($row_count>0){

                                while ($rows=mysqli_fetch_assoc($res)){ //while loop runs as long as there is data in the database

                                    $id=$rows['id'];
                                    $username=$rows['username'];
                                    $password=$rows['password'];

                                    ?>

                                    <tr>
                                        <td><?php echo $idchange++ ?></td>
                                        <td><?php echo $username ?></td>
                                        <td><?php echo $password ?></td>
                                        <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin </a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>"class="btn-danger">Delete Admin </a> 
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