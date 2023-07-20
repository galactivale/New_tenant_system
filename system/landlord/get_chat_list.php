<?php
session_start();

if (!isset($_SESSION["LANDLORD_ID"])) {
    header("Location: ../../login.php");
    exit();
}

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

$landlordId = $_SESSION["LANDLORD_ID"];

$query = "SELECT i.user_id AS tenant_id, CONCAT(u.first_name, ' ', u.last_name) AS tenant_name, i.description AS latest_message
          FROM inquiry i
          INNER JOIN users u ON i.user_id = u.user_id
          WHERE i.landlord_id = ?
          GROUP BY i.user_id
          ORDER BY i.created_at DESC";

$stmt = $conn->prepare($query);
$stmt->bind_param('i', $landlordId);
$stmt->execute();
$result = $stmt->get_result();

$chatList = array();
while ($row = $result->fetch_assoc()) {
    $chatList[] = $row;
}

$conn->close();

echo json_encode(array(
    'success' => true,
    'chatList' => $chatList
));
?>
