<?php 
include 'database.php';
$sql = "SELECT COUNT(*) as total_users FROM `users` WHERE `position` = 1";
$result = mysqli_query($conn, $sql);


if ($result && mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  $totalUsers = $row['total_users'];
}
?>
<?php
$sql = "SELECT COUNT(*) as total_active_users FROM `users` WHERE `position` = 0 AND `active` = 1";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  $totalActiveUsers = $row['total_active_users'];
}

?>
<?php
$sql = "SELECT COUNT(*) as inactive_users FROM `users` WHERE `position` = 0 AND `active` =0";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  $inactiveUsers = $row['inactive_users'];
  
}
?>

<?php
$sql = "SELECT SUM(payment_amount) AS total_payment FROM payment";

$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {

    $row = mysqli_fetch_assoc($result);
    
    $totalPayments = $row["total_payment"];
    $formattedPayments = 'MWK ' . number_format((float)$totalPayments, 2, '.', ',');
    

} else {
    echo "0";
}

?>