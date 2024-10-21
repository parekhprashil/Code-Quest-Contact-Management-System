<?php
// import.php
session_start();
    if (!isset($_SESSION['user_id'])) {
        header("location: index.php");
        exit;
    }
include 'conf.php'; // Database connection

// Check if a file is uploaded
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['importFile'])) {
    $file = $_FILES['importFile']['tmp_name'];
    $user_id = $_SESSION['user_id'];

    // Open and read the VCF file content
    $vcfContent = file_get_contents($file);

    // Split the VCF file into individual contacts (each contact starts with "BEGIN:VCARD")
    $contacts = explode("BEGIN:VCARD", $vcfContent);

    foreach ($contacts as $contact) {
        if (empty($contact)) continue;
        // echo "Contact: $contact<br>";

        // Extract Name (FN), Phone (TEL), and Email (EMAIL) from each vCard
        $contact_name = '';
        $contact_phone_number = '';
        $contact_email_id = '';

        if (preg_match("/FN:(.*)/", $contact, $matches)) {
            $contact_name = trim($matches[1]);
        }
        if (preg_match("/TEL:(.*)/", $contact, $matches)) {
            $contact_phone_number = trim($matches[1]);
        }
        if (preg_match("/EMAIL:(.*)/", $contact, $matches)) {
            $contact_email_id = trim($matches[1]);
        }

        // If name is empty, skip this contact
        if ($contact_name == '') continue;

        // Create the SQL query for inserting data
        $sql = "INSERT INTO contactdetails (contact_name, contact_phone_number, contact_email_id, image_url, user_id) 
                VALUES ('$contact_name', '$contact_phone_number', '$contact_email_id', '', '$user_id')";

        // Execute the query using mysqli
        if (mysqli_query($con, $sql)) {
            // echo "Contact added successfully!<br>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    // Close the database connection
    mysqli_close($con);

    // Redirect back to dashboard after import
    header('Location: home.php');
} else {
    echo "No file uploaded!";
}
?>
