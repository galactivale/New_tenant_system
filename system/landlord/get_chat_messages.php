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
$tenantId = $_GET["USER_ID"];

// Query to fetch chat messages between landlord and tenant
$query = "SELECT * FROM inquiry
          WHERE (user_id = ? AND landlord_id = ?)
          OR (user_id = ? AND landlord_id = ?)
          ORDER BY created_at ASC";

$stmt = $conn->prepare($query);
$stmt->bind_param('iiii', $tenantId, $landlordId, $landlordId, $tenantId);
$stmt->execute();
$result = $stmt->get_result();

$chatMessages = array();
while ($row = $result->fetch_assoc()) {
    $chatMessages[] = $row;
}

$conn->close();

echo json_encode(array(
    'success' => true,
    'chatMessages' => $chatMessages
));
?>
