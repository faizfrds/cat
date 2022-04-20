<?php include('modular/booking.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Service</h1>
        <br /><br />

        <?php
            $id= $_GET['id'];
            $sql= "SELECT * FROM tbl_service WHERE id=$id";

            $res= mysqli_query($conn, $sql);

            $row= mysqli_fetch_assoc($res);

            $title= $row['title'];
            $price= $row['price'];
            $current_img= $row['image_name'];
            $featured= $row['featured'];
            $active= $row['active'];
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
                    <td> Title: </td>
                    <td><input type="text" name="title" value="<?php echo $title; ?>" ></td>

                </tr>
                

                <tr>
                    <td> Price ($): </td>
                    <td><input type="number" name="price" value="<?php echo $title; ?>" ></td>

                </tr>

                <tr>
                    <td> Current image: </td>
                    <td>
                        <img src ="<?php echo SITEURL; ?>images/service/<?php echo $current_img; ?>" width="50px" height="50px">
                    </td>

                </tr>

                <tr> <!-- uploading image -->
                    <td> Update image: </td>
                    <td>
                        <input type="file" name="image"><!-- 'value' saves in db, string displays in browser -->
                    </td>

                </tr>

                <tr>
                    <td> Featured on home page? </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes <!-- 'value' saves in db, string displays in browser -->
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td> Active on web page? </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes <!-- 'value' saves in db, string displays in browser -->
                        <input type="radio" name="active" value="No"> No
                    </td>

                </tr>

                <tr>
                    <td colspan="2">
                    <input type="submit" name="submit" value="Update Service" class="btn-secondary">
                </td>

                </tr>

            </table>

        </form>

    </div>
</div>

<?php include('modular/footer.php') ?>

<?php include('modular/footer.php') ?>

<?php
    //process the value for form and save to database

    $id = $_GET['id'];
    
    //getting date from the form using the title
    if(isset($_POST['submit'])){//check whether submit button is clicked or not

        //getting date from the form using the title
        $title = $_POST['title'];
        $price = $_POST['price'];

        if(isset($_POST['featured'])){
            $featured = $_POST['featured']; //checks if either radio input type is selected or not
        }
        else{
            $featured = "No";
        }

        if(isset($_POST['active'])){
            $active = $_POST['active']; //checks if either radio input type is selected or not
        }
        else{
            $active = "No";
        }

        if(isset($_FILES['image']['name'])){ //only allowing image that has name and value to be used for sql query
            $image_name = $_FILES['image']['name'];

            $source = $_FILES['image']['tmp_name'];
            $destination = "../images/service/".$image_name;

            $upload = move_uploaded_file($source, $destination); //moving file to 'images' folder

            if($upload==false){
                $_SESSION['upload'] = "<div class='error'>Cannot upload image...</div>";
                header('location:'.SITEURL.'admin/add-service.php');
                die(); //as we do not want an empty file to be uploaded into database, we stop the process before advancing further
            }
        }
        else{
            $image_name = $current_img;
        }


        //sql query of data, name on left is name of column; name of right is name of value of data from form. Insert query.
        $sql = "UPDATE tbl_service SET
            title='$title',
            image_name='$image_name',
            featured='$featured',
            price='$price', 
            active='$active'
            WHERE id=$id;
        ";

        //executing sql query to post data
        $res = mysqli_query($conn, $sql);

        if($res==TRUE){
        
            $_SESSION['add'] = "<div class='success'>Service updated successfully</div>"; //create a session variable to display message
            header("location:".SITEURL.'admin/manage-service.php'); //redirect page to manage-admin to show that new service has been added
      
        }
        else{
            $_SESSION['add'] = "<div class='error'>Failed to update service</div>";
            header("location:".SITEURL.'admin/update-service.php');

        }
    }

?>