<?php
    session_start();
    if(!isset($_SESSION['user_id'])){
        header("location: index.php");
    }
    $user_id = $_SESSION['user_id'];
    include 'conf.php';
    extract($_POST);
    $sql = "INSERT INTO `contactdetails`(`contact_name`, `contact_phone_number`, `contact_email_id`, `image_url`, `User_id`) VALUES ('$name','$contact','$email','$image','$user_id')";
    $result = mysqli_query($con, $sql);
    if($result){
        header("Location: home.php");
    }
    else{
        echo "Error";
    }
?>
