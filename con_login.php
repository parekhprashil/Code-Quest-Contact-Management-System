<?php
include 'conf.php';

extract($_POST);
// generate login check here
$sql = "SELECT * FROM user WHERE emailid='$email' AND password='$password'";

// echo $sql;
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

if ($row) {
    session_start();
    $_SESSION['user_id'] = $row['id'];
    header("Location: home.php");
} else {
    header("Location: index.php");
}
