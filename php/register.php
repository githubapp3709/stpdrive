<?php
require_once("db.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $ver_code = rand(100000, 999999);
    $full_name = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $check = "SELECT `email` FROM `users` WHERE `email`='$email' ";
    $response = $db->query($check);
    if ($response->num_rows != 0) {
        echo "usermatch";
    } else {
        $store = "INSERT INTO `users`(`full_name`, `email`, `password`, `activation_code`) VALUES ('$full_name','$email','$password','$ver_code')";
        if ($db->query($store)) {
            echo "success";
        } else {
            echo "failed";
        }
    }
}
