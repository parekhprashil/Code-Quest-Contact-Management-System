<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location: index.php");
    exit;
}

if (isset($_GET['id'])) {
    $contact_id = $_GET['id'];
    
    // Include configuration file
    include 'conf.php';
    
    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }
    
    // Create the SQL query
    $contact_id = mysqli_real_escape_string($con, $contact_id);
    $user_id = mysqli_real_escape_string($con, $_SESSION['user_id']);
    $sql = "DELETE FROM contactdetails WHERE id = '$contact_id' AND user_id = '$user_id'";
    
    // Execute the query
    if (mysqli_query($con, $sql)) {
        header("location: home.php");
        exit;
    } else {
        echo "Error deleting contact: " . mysqli_error($con);
    }
    
    // Close the connection
    mysqli_close($con);
} else {
    header("location: home.php");
    exit;
}
