<?php
$con = mysqli_connect("localhost", "root", "", "contact_managment_system");
if (!$con) {
    echo "Error: " . mysqli_connect_error();
    exit();
}
?>