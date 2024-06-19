<?php 
    //Start session
    session_start();


    //Create constants to store non repeating values
    define('SITEURL','http://localhost/fashion-store-pwl/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','');
    define('DB_NAME','clothes-order');

    // Database connection
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_connect_error()); 

    // Selecting database
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn));

?>