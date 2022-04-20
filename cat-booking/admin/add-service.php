<?php include('modular/booking.php') ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Add Service</h1>
        <br /><br />

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

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td> Title: </td>
                    <td><input type="text" name="title" placeholder="Enter service title" required></td>

                </tr>

                <tr>
                    <td> Price ($): </td>
                    <td><input type="number" name="price" placeholder="Enter service price" required></td>

                </tr>

                <tr> <!-- uploading image -->
                    <td> Select image: </td>
                    <td>
                        <input type="file" name="image"><!-- 'value' saves in db, string displays in browser -->
                    </td>

                </tr>

                <tr>
                    <td> Featured on home page? </td>
                    <td>
                        <input type="radio" name="featured" value="Yes" required> Yes <!-- 'value' saves in db, string displays in browser -->
                        <input type="radio" name="featured" value="No" required> No
                    </td>
                </tr>

                <tr>
                    <td> Service active on web page? </td>
                    <td>
                        <input type="radio" name="active" value="Yes" required> Yes <!-- 'value' saves in db, string displays in browser -->
                        <input type="radio" name="active" value="No" required> No
                    </td>

                </tr>

                <tr>
                    <td colspan="2">
                    <input type="submit" name="submit" value="Add Service" class="btn-secondary">
                </td>

                </tr>

            </table>

        </form>

    </div>
</div>

<?php include('modular/footer.php') ?>

<?php
    //process the value for form and save to database
    
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
        
        $image_name=""; //default image name is blank

        if($image_name!=""){ //only allowing image that has name and value to be used for sql query
            $image_name = $_FILES['image']['name'];

            $extension = end(explode('.', $image_name));
            $image_name = "Service_Img_".rand(000, 999).'.'.$extension; //renaming image name to prevent overwriting

            $source = $_FILES['image']['tmp_name'];
            $destination = "../images/service/".$image_name;

            $upload = move_uploaded_file($source, $destination); //moving file to 'images' folder

            if($upload==false){
                $_SESSION['upload'] = "<div class='error'>Cannot upload image...</div>";
                header('location:'.SITEURL.'admin/add-service.php');
                die(); //as we do not want an empty file to be uploaded into database, we stop the process before advancing further
            }

        }
        
        //sql query of data, name on left is name of column; name of right is name of value of data from form. Insert query.
        $sql = "INSERT INTO tbl_service SET
            title='$title',
            price='$price',
            image_name='$image_name',
            featured='$featured', 
            active='$active'
        ";

        //executing sql query to post data
        $res = mysqli_query($conn, $sql);

        if($res==TRUE){
        
            $_SESSION['add'] = "<div class='success'>Service added successfully</div>"; //create a session variable to display message
            header("location:".SITEURL.'admin/manage-service.php'); //redirect page to manage-admin to show that new admin has been added
        //period sign concatenates strings
        }
        else{
            $_SESSION['add'] = "<div class='error'>Failed to add service</div>";
            header("location:".SITEURL.'admin/add-service.php');

        }
    }

?>