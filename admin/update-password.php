<?php include("partials/navbar.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php 
            if(isset($_GET['id'])) {
                $id = $_GET['id'];
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>

                <tr>
                    <td>New Password: </td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password: </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php 
// Check whether the submit button is clicked or not
if (isset($_POST['submit'])) {
    // Get the data from form
    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    // Check whether the user with current id and current password exists or not
    $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

    // Execute the query
    $res = mysqli_query($conn, $sql);

    // Check whether the query executed successfully or not
    if ($res == TRUE) {
        // Check whether the data is available or not 
        $count = mysqli_num_rows($res);

        if ($count == 1) {
            // User exists and password can be changed
            // Check whether the new password match or not
            if ($new_password == $confirm_password) {
                // Update the password
                $sql2 = "UPDATE tbl_admin SET password='$new_password' WHERE id=$id";

                // Execute the query
                $res2 = mysqli_query($conn, $sql2);

                // Check whether the query executed successfully or not
                if ($res2 == TRUE) {
                    // Query executed and password updated
                    $_SESSION['change-pw'] = '<div class="success">Password Changed Successfully</div>';
                    // Redirect to manage admin page
                    header('location:' . SITEURL . 'admin/manage-admin.php');
                } else {
                    // Failed to update admin
                    // Create session variable to display message
                    $_SESSION['change-pw'] = '<div class="error">Failed to Change Password. Try Again Later</div>';
                    // Redirect to manage admin page
                    header('location:' . SITEURL . 'admin/manage-admin.php');
                }
            } else {
                // Redirect to manage admin with error message
                $_SESSION['pw-not-match'] = "<div class='error'>Password Did Not Match</div>";
                header('location:' . SITEURL . 'admin/manage-admin.php');
            }
        } else {
            // User doesn't exist, set message and redirect
            $_SESSION['user-not-found'] = "<div class='error'>User Not Found</div>";
            header('location:' . SITEURL . 'admin/manage-admin.php');
        }
    }
}
?>



<?php include("partials/footer.php"); ?>