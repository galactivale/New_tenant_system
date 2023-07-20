<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ktenant";


$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


function sendMessage($incoming_msg_id, $message)
{
    global $conn;

    $landlord_id = 8862; 
 
    if ($incoming_msg_id == $landlord_id) {
        return false; 
    }

    $sql = "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg)
            VALUES ('$landlord_id', '$incoming_msg_id', '$message')";

    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
}

function getMessagesWithLandlord($user_id)
{
    global $conn;
    $landlord_id = 8862; 

    $sql = "SELECT * FROM messages
            WHERE (incoming_msg_id = '$user_id' AND outgoing_msg_id = '$landlord_id')
            OR (incoming_msg_id = '$landlord_id' AND outgoing_msg_id = '$user_id')
            ORDER BY msg_id ASC";

    $result = mysqli_query($conn, $sql);
    $messages = array();

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $messages[] = $row;
        }
    }

    return $messages;
}
?>
