<?php include("partials/navbar.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>

        <?php 
            //1.get the id of admin to be deleted
            $id = $_GET['id'];
    
            //2.create sql query to delete admin
            $sql = "SELECT * FROM tbl_admin WHERE id=$id";

            //execute the query 
            $res = mysqli_query($conn, $sql);

            //3. redirect to manage admin page with message (success/error)
            //check whether the query executed successfully or not 
            if($res == TRUE){
                //check whether the data is available or not 
                $count = mysqli_num_rows($res);
                //check whether we have admin data or not 
                if($count == 1){
                    //get details
                    // echo "Admin Available";
                    $rows = mysqli_fetch_assoc($res);

                    $full_name=$rows['full_name'];
                    $username=$rows['username'];
                } else {
                    //redirect to manage admin
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter your name"
                            value="<?php echo $full_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" placeholder="Enter your username"
                            value="<?php echo $username; ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php 
    //check whether the submit button is cliked or not
    if(isset($_POST['submit'])){
        //get all the values from form to update
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        //create a sql query to update admin
        $sql = "UPDATE tbl_admin SET
        full_name = '$full_name',
        username = '$username'
        WHERE id='$id'
        ";

        //execute the query
        $res = mysqli_query($conn, $sql);

        //check whether the query executed sucessfully or not
        if($res == TRUE){
            //query executed and admin updated
            $_SESSION['update'] ='<div class="success">Admin Updated Successfully</div>';
            //Redirect to manage admin page
            header('location:'.SITEURL.'admin/manage-admin.php');
        } else {
            //failed to update admin
            //create session variable to display message
            $_SESSION['update'] ='<div class="error">Failed to Update Admin. Try Again Later</div>';
            //Redirect to manage admin page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }
?>

<?php include("partials/footer.php"); ?>