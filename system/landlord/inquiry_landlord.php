<?php include 'database.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Properties</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>

<body>
    <div class="container">
        <?php

        include 'Navigationbar.php';
        ?>

        <main class="main-scrollable">
            <h1>Inquiry</h1>

            <div id="chat-list" class="chat-list">
        </main>

        <?php

$host = 'localhost';
$dbname = 'ktenant';
$username = 'root';
$password = '';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_errno) {
    echo "Database connection failed: " . $conn->connect_error;
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
?>

        <div id="chat-list" class="chat-list">
            <?php foreach ($chatList as $chatItem): ?>
            <div class="chat-item" data-tenant-id="<?php echo $chatItem['tenant_id']; ?>">
                <div class="tenant-name"><?php echo $chatItem['tenant_name']; ?></div>
                <div><?php echo $chatItem['latest_message']; ?></div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="right">
            <div class="top">
                <button id="menu-btn">
                    <span class="material-icons-sharp">
                        menu
                    </span>
                </button>
                <div class="theme-toggler">
                    <span class="material-icons-sharp active">light_mode </span>
                    <span class="material-icons-sharp">dark_mode </span>
                </div>
                <div class="profile">
                    <div class="info">
                        <p>Hey, <b>Tadala</b></p>
                        <small class="text-muted">Admin</small>
                    </div>
                    <div class="profile-photo">
                        <img src="assets/images/tadala.jpeg" alt="">
                    </div>
                </div>
            </div>
            <!--End of Top-->
            <div class="recent-updates">
                <h2>Recent Messages</h2>
                <?php
                include 'recent_messages.php'
                ?>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
    </script>
</body>

</html>