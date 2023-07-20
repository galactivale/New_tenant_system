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

        $getUserUniqueIDQuery = "SELECT unique_id FROM users WHERE user_id = ?";
        $getUserUniqueIDStmt = $conn->prepare($getUserUniqueIDQuery);
        $getUserUniqueIDStmt->bind_param('i', $tmp_id);
        $getUserUniqueIDStmt->execute();
        $getUserUniqueIDResult = $getUserUniqueIDStmt->get_result();

        if ($getUserUniqueIDResult->num_rows === 0) {
            echo "User ID not found in the users table.";
            exit();
        }

        

        $userData = $getUserUniqueIDResult->fetch_assoc();
        $unique_id = $userData['unique_id'];

        $_SESSION["UNIQUE_ID"] = $unique_id;

        header("location:landlord/index.php");
        exit();
    }

    header("location:../signup.php?error=1;");
    exit();
}

// Login
if (isset($_GET['username']) && $_GET['username'] != "" && isset($_GET['password']) && $_GET['password'] != "") {
    $username = $_GET['username'];

    $password = $_GET['password'];

    $isExist = false;
    $auth_password = "";
    $auth_ID = "";
    $auth_position = 0;
    $query = mysqli_query($conn, "SELECT * FROM `users` WHERE `username` = '$username'");
    while ($result = mysqli_fetch_assoc($query)) {
        $auth_password = $result['password'];
        $auth_position = $result['position'];
        $auth_ID = $result['user_id'];
        $unique_id = $result['unique_id']; // Fetch the unique_id from the users table
        $isExist = true;
    }

    if ($isExist) {
        if ($auth_password == $password) {
            // Store both USER_ID and UNIQUE_ID in the session
            $_SESSION["USER_ID"] = $auth_ID;
            $_SESSION["UNIQUE_ID"] = $unique_id;

            if ($auth_position != 1) {
                header("location:landlord/index.php");
                exit();
            } else {
                header("location:tenant/index.php");
                exit();
            }
        }
    }

    header("location: ..//login.php");
    exit();
}

// ...

?>
