<?php include('modular/booking.php') ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br /><br />

        <?php
            $id= $_GET['id'];
            $sql= "SELECT * FROM tbl_admin WHERE id=$id";

            $res= mysqli_query($conn, $sql);

            $row= mysqli_fetch_assoc($res);

            $username = $row['username'];
            $password= $row['password'];
        ?>

        <?php
            if(isset($_SESSION['update'])){
            echo $_SESSION['update']; //displaying session message
            unset($_SESSION['update']); //removing session message
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td> Username: </td>
                    <td><input type="text" name="username" value="<?php echo $username; ?>" ></td>

                </tr>

                <tr>
                    <td> Password: </td>
                    <td><input type="password" name="password" value="<?php echo $password; ?>"></td>

                </tr>

                <tr>
                    <td colspan="2">
                    <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                </td>

                </tr>

            </table>

        </form>

    </div>
</div>

<?php include('modular/footer.php') ?>

<?php
    //process the value for form and save to database
    //check whether button is submitted or not

    $id = $_GET['id'];

    if(isset($_POST['submit'])){

        //getting date from the form using the name
        $username = $_POST['username'];
        $password = $_POST['password'];

        //sql query of data, name on left is name of column; name of right is name of value of data from form. Update query.
        $sql = "UPDATE tbl_admin SET 
            username='$username', 
            password='$password'
            WHERE id=$id
        ";

        //executing sql query to post data
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        if($res==TRUE){
            
            $_SESSION['add'] = "<div class='success'>Admin updated successfully</admin></div>"; //create a session variable to display message
            header("location:".SITEURL.'admin/manage-admin.php'); //redirect page to manage-admin to show that new admin has been added
            //period sign concatenates strings
        }
        else{
            $_SESSION['add'] = "<div class='error'>Failed to update admin</div>";
            header("location:".SITEURL.'admin/update-admin.php');

        }
        

    }

?>