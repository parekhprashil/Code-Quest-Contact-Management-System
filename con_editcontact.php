<?php
// edit_contact.php
session_start();
include 'conf.php'; // Include your DB connection config

// Check if 'id' is set, which indicates this is an edit request
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $user_id = $_SESSION['user_id'];

    // Fetch the contact data to pre-fill the form
    $sql = "SELECT * FROM contactdetails WHERE id = $id AND user_id = $user_id";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $contact = mysqli_fetch_assoc($result);
    } else {
        // Handle case where contact is not found
        echo "Contact not found.";
        exit;
    }
}

// Handle the form submission (updating the contact)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = (int)$_POST['id'];
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $contact_number = mysqli_real_escape_string($con, $_POST['contact']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $image_url = mysqli_real_escape_string($con, $_POST['image']);
    $user_id = $_SESSION['user_id'];

    $sql = "
        UPDATE contactdetails 
        SET contact_name = '$name', contact_phone_number = '$contact_number', contact_email_id = '$email', image_url = '$image_url' 
        WHERE id = $id AND user_id = $user_id";
    
    if (mysqli_query($con, $sql)) {
        // Redirect to the home page after successful update
        header('Location: home.php');
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }
}

// Close the database connection
mysqli_close($con);
?>
