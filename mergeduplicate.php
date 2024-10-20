<?php
// merge_duplicates.php
session_start();
include 'conf.php'; // Database connection

$user_id = $_SESSION['user_id'];
$merge_status = 'no_duplicates'; // Default status

// Step 1: Find duplicates based on 'contact_name' and 'contact_phone_number'
$sql = "
    SELECT contact_name, contact_phone_number, MIN(id) as keep_id, COUNT(*) as duplicate_count
    FROM contactdetails
    WHERE user_id = $user_id
    GROUP BY contact_name, contact_phone_number
    HAVING COUNT(*) > 1";

$result = mysqli_query($con, $sql);

// Step 2: Process each group of duplicates
if ($result && mysqli_num_rows($result) > 0) {
    $merge_status = 'success'; // Update status to success if duplicates found
    while ($row = mysqli_fetch_assoc($result)) {
        $contact_name = $row['contact_name'];
        $contact_phone_number = $row['contact_phone_number'];
        $keep_id = $row['keep_id']; // The ID of the record to keep

        // Find all duplicate entries except the one to keep
        $delete_sql = "
            DELETE FROM contactdetails
            WHERE user_id = $user_id
            AND contact_name = '$contact_name'
            AND contact_phone_number = '$contact_phone_number'
            AND id != $keep_id";

        if (!mysqli_query($con, $delete_sql)) {
            $merge_status = 'error'; // Update status to error if any delete fails
            break;
        }
    }
} else {
    $merge_status = 'no_duplicates'; // No duplicates found
}

// Close the database connection
mysqli_close($con);

// Redirect back to the home page with a merge status in the query parameter
header("Location: home.php?merge_status=$merge_status");
exit;
?>
