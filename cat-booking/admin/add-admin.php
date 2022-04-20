<?php include('modular/booking.php') ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br /><br />

        <?php
            if(isset($_SESSION['add'])){
            echo $_SESSION['add']; //displaying session message
            unset($_SESSION['add']); //removing session message
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td> Username: </td>
                    <td><input type="text" name="username" placeholder="Enter username"></td>

                </tr>

                <tr>
                    <td> Password: </td>
                    <td><input type="password" name="password" placeholder="Enter password"></td>

                </tr>

                <tr>
                    <td colspan="2">
                    <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                </td>

                </tr>

            </table>

        </form>

    </div>
</div>

<?php include('modular/footer.php') ?>

<?php
    
    //process the value for form and save to database
    
    if(isset($_POST['submit'])){ //check whether submit button is clicked or not

        
        $username = $_POST['username']; //getting date from the form using the name
        $password = $_POST['password'];

        //sql query of data, name on left is name of column; name of right is name of value of data from form. Insert query.
        $sql = "INSERT INTO tbl_admin SET
            username='$username', 
            password='$password'
        "; 

        $res = mysqli_query($conn, $sql); //executing sql query to post data

        if($res==TRUE){
            
            $_SESSION['add'] = "<div class='success'>Admin added successfully</div>"; //create a session variable to display message
            header("location:".SITEURL.'admin/manage-admin.php'); //redirect page to manage-admin to show that new admin has been added
            //period sign concatenates strings
        }
        else{
            $_SESSION['add'] = "<div class='error'>Failed to add admin</div>";
            header("location:".SITEURL.'admin/add-admin.php');

        }
        

    }

?>