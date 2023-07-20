<?php
session_start();

if (!isset($_SESSION["USER_ID"])) {
    $user_unique_id = $_SESSION["UNIQUE_ID"];
    header("Location: ../../login.php");
    exit();
}

if (isset($_POST['message'])) {
    $message = $_POST['message'];
    $user_unique_id = $_SESSION["UNIQUE_ID"];
    $host = 'localhost';
    $dbname = 'ktenant';
    $username = 'root';
    $password = '';

    $conn = new mysqli($host, $username, $password, $dbname);

    if ($conn->connect_errno) {
        echo "Database connection failed: " . $conn->connect_error;
        exit();
    }

    $landlordId = 8862;

    $insertQuery = "INSERT INTO inquiry (incoming_msg_id, outgoing_msg_id, msg) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param('iis', $landlordId,  $user_unique_id, $message);
    $stmt->execute();

    $conn->close();

    exit();
}
?>
