<?php
   include 'database.php';
  $query = "SELECT payment_date, SUM(payment_amount) AS total_amount FROM payment GROUP BY payment_date";
  $result = mysqli_query($conn, $query);

  $data = array();
  while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
  }
  
  header('Content-Type: application/json');
  echo json_encode($data);
?>
