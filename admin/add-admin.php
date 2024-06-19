<?php include("partials/navbar.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>

        <?php 
            //checking whether the session is set or not
            if(isset($_SESSION['add'])) { 
                echo $_SESSION['add']; //displaying session message
                unset($_SESSION['add']); //removing session message
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter your name">
                    </td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" placeholder="Enter your username">
                    </td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="password" placeholder="Enter your password">
                    </td>
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

<?php include("partials/footer.php"); ?>
<?php 
    //proses the value from form and save it in database
    //check whether the submit button is clicked or not
    
    if(isset($_POST["submit"])) 
    {
        //button clicked
        // echo "Button clicked";

        //1. get the data from form
        $full_name = $_POST["full_name"];
        $username = $_POST["username"];
        $password = md5($_POST["password"]); //password encryption with MD5

        //2. sql query to save the data into database
        $sql = "INSERT INTO tbl_admin SET
            full_name='$full_name',
            username='$username',
            password='$password'
        ";
        
        //3. execute query and save data in database
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        //4. Check whether the (query is executed) data is inserted or not and display approriate message
        if($res == TRUE) {
            //Data inserted
            //create a session variable to display message
            $_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";
            //redirect page to manage admin
            header("location:".SITEURL."admin/manage-admin.php");
        } else {
            //Failed to insert data
            //create a session variable to display message
            $_SESSION['add'] = "<div class='error'>Failed to Add Admin</div>";
            //redirect page to add admin
            header("location:".SITEURL."admin/add-admin.php");
        }
    }
?>