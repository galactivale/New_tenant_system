<?php

// DATABASE
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ktenant";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start();

// Sign UP
if (isset($_GET['username']) && isset($_GET['email']) && isset($_GET['password']) && isset($_GET['name']) && isset($_GET['surname'])) {
    $username = $_GET['username'];
    $email = $_GET['email'];
    $password = $_GET['password'];
    $name = $_GET['name'];
    $surname = $_GET['surname'];

    $query = mysqli_query($conn, "SELECT * FROM `users` WHERE `username` = '$username' OR `email` = '$email'");
    $result = mysqli_fetch_assoc($query);
    if ($result) {
        // Username or email already exists
        header("location:../signup.php?error=1");
        exit();
    }

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
        $_SESSION["USER_ID"] = $tmp_id;
        $_SESSION["USER_PASSWORD"] = $password;
        header("location:landlord/index.php");
        exit();
    }

    header("location:../signup.php?error=1;");
    exit();
}

// Login
if (isset($_GET['username']) && $_GET['username'] != "" && isset($_GET['password']) && $_GET['password'] != "") {
    $username = $_GET['username'];
    echo $username;

    $password = $_GET['password'];
    echo $password;

    $isExist = false;
    $auth_password = "";
    $auth_ID = "";
    $auth_position = 0;
    $query = mysqli_query($conn, "SELECT * FROM `users` WHERE `username` = '$username'");
    while ($result = mysqli_fetch_assoc($query)) {
        $auth_password = $result['password'];
        $auth_position = $result['position'];
        $auth_ID = $result['user_id'];
        echo $auth_ID;
        $isExist = true;
    }
    var_dump($isExist);
    var_dump($auth_password);
    var_dump($auth_ID);
    var_dump($auth_position);

    if ($isExist) {
        if ($auth_password == $password) {
            if ($auth_position != 1) {
                $_SESSION["USER_ID"] = $auth_ID;
                $_SESSION["USER_PASSWORD"] = $password;
                header("location:landlord/index.php");
                exit();
            } else {
                $_SESSION["USER_ID"] = $auth_ID;
                $_SESSION["USER_PASSWORD"] = $password;
                header("location:tenant/index.php");
                exit();
            }
        }
    }

    echo "USER SESSION".$_SESSION["USER_ID"];
    header("location: ..//login.php");
    exit();
}

?>
