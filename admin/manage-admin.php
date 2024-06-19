<?php include("partials/navbar.php"); ?>

<!-- Main Content Section Start -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>
        <br>

        <?php 
            if(isset($_SESSION['add'])) {
                echo $_SESSION['add']; //displaying session message
                unset($_SESSION['add']); //removing session message
            }

            if(isset($_SESSION['delete'])) {
                echo $_SESSION['delete']; //displaying session message
                unset($_SESSION['delete']); //removing session message
            }

            if(isset($_SESSION['update'])) {
                echo $_SESSION['update']; //displaying session message
                unset($_SESSION['update']); //removing session message
            }

            if (isset($_SESSION['user-not-found'])) {
                echo $_SESSION['user-not-found']; // displaying session message
                unset($_SESSION['user-not-found']); // removing session message
            }
            
            if (isset($_SESSION['pw-not-match'])) {
                echo $_SESSION['pw-not-match']; // displaying session message
                unset($_SESSION['pw-not-match']); // removing session message
            }
            
            if (isset($_SESSION['change-pw'])) {
                echo $_SESSION['change-pw']; // displaying session message
                unset($_SESSION['change-pw']); // removing session message
            }
        ?>
        <br><br>

        <!-- Button to add admin -->
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br><br><br>

        <table class="tbl-full">
            <tr>
                <th>No</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Action</th>
            </tr>

            <?php 
                //query to get all admin
                $sql = "SELECT * FROM tbl_admin";
                //execute the query
                $res = mysqli_query($conn, $sql);

                //check whether the query is executed or not
                if($res == TRUE) {
                    //count rows to check whether we have data in database or not
                    $count = mysqli_num_rows($res); //function to get all the rows in database

                    $id_credential = 1; //create a variable and assign the value
                    
                    //check the num of rows
                    if($count>0) {
                        //we have data in database
                        while($rows = mysqli_fetch_assoc($res)) {
                            //using while loop to get all data from database
                            //and whille loop will run as we have data in database

                            //get individual data
                            $id=$rows['id'];
                            $full_name=$rows['full_name'];
                            $username=$rows['username'];

                            //display the values in our table
                            ?>
            <tr>
                <td><?php echo $id_credential++; ?></td>
                <td><?php echo $full_name; ?></td>
                <td><?php echo $username; ?></td>
                <td>
                    <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id; ?>"
                        class="btn-primary">Change Password</a>
                    <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id; ?>"
                        class="btn-secondary">Update Admin</a>
                    <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id; ?>"
                        class="btn-danger">Delete
                        Admin</a>
                </td>
            </tr>

            <?php
            }
            } else {
            //we dont have data in database
            }
            }
            ?>
        </table>
    </div>
</div>
<!-- Main Content Section End -->

<?php include("partials/footer.php"); ?>