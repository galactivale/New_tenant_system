<?php
 include 'database.php';

  $query = "SELECT DATE_FORMAT(time, '%Y-%m-%d') AS time, COUNT(*) AS totalTenants
            FROM users
            WHERE position = 1
            GROUP BY DATE_FORMAT(time, '%Y-%m-%d')
            ORDER BY time ASC";
  $result = mysqli_query($conn, $query);


  $datat = array();
  while ($row = mysqli_fetch_assoc($result)) {
    $datat[] = $row;
  }

  header('Content-Type: application/json');
  echo json_encode($datat);
?>
