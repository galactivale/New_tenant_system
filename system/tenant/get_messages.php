<?php
session_start();

if (!isset($_SESSION["USER_ID"])) {
    $user_unique_id = $_SESSION["UNIQUE_ID"];

    header("Location: ../../login.php");
    exit();
}

function getMessagesWithLandlord($user_unique_id)
{
    global $conn;
    $landlord_id = 8862;

    $sql = "SELECT * FROM inquiry
            WHERE (incoming_msg_id = '$user_unique_id' AND outgoing_msg_id = '$landlord_id')
            OR (incoming_msg_id = '$landlord_id' AND outgoing_msg_id = '$user_unique_id')
            ORDER BY inquiry_id ASC";

    $result = mysqli_query($conn, $sql);
    $messages = array();

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $messages[] = $row;
        }
    }

    return $messages;
}

// Database connection parameters
$host = 'localhost';
$dbname = 'ktenant';
$username = 'root';
$password = '';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_errno) {
    echo json_encode(array(
        'success' => false,
        'message' => "Database connection failed: " . $conn->connect_error
    ));
    exit();
}

$uniqueID = $_SESSION["UNIQUE_ID"]; // Use the UNIQUE_ID from the session

$messages = getMessagesWithLandlord($uniqueID);

$conn->close();

echo json_encode(array(
    'success' => true,
    'messages' => $messages
));
?>
