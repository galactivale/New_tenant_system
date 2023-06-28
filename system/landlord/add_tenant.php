<?php
require("database.php");

// Sign UP
if (isset($_GET['username']) && isset($_GET['email']) && isset($_GET['password']) && isset($_GET['name']) && isset($_GET['surname'])) {
    $username = $_GET['username'];
    $email = $_GET['email'];
    $password = $_GET['password'];
    $name = $_GET['name'];
    $surname = $_GET['surname'];

    $tmp_id = "";
    while (true) {
        $tmp_id = rand(1, 9999999);
        $isExist = false;
        $query = mysqli_query($conn, "SELECT * FROM `users` WHERE `user_id` = '$tmp_id'");
        while ($result = mysqli_fetch_assoc($query)) {
            $isExist = true;
        }
        if ($isExist == false) {
            break;
        }
    }

    $isName = false;
    $query = mysqli_query($conn, "SELECT * FROM `users` WHERE `username` = '$username'");
    while ($result = mysqli_fetch_assoc($query)) {
        $isExist = true;
    }
    if ($isExist == false) {
        mysqli_query($conn, "INSERT INTO `users` (`user_id`,`username`,`password`,`email`,`name`,`surname`,`position`) VALUES ('$tmp_id','$username','$password','$email','$name','$surname','1')");

        echo "Tenant registered successfully.";
        header('location:tenant_landlord.php');

        exit();
    }

    echo "Error: Username already exists.";
    exit();
}

?>