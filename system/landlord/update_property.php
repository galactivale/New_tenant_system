<?php
include 'database.php'; 
if (isset($_POST['update'])) {

        if(empty($_POST['property-name']) || empty($_POST['city']) || empty($_POST['street-address']) || empty($_POST['monthly-rate']) || empty($_POST['rooms'])) {
          echo "All fields are required.";
          exit;
        }

  $property_name = $_POST['property-name'];
  $city = $_POST['city'];
  $street_address = $_POST['street-address'];
  $monthly_rate = $_POST['monthly-rate'];
  $rooms = $_POST['rooms'];
  
    $id = $_POST['property_id'];

  $sql = "UPDATE property SET 
            property_name = '$property_name',
            city = '$city',
            street_address = '$street_address',
            monthly_rate = $monthly_rate,
            rooms = $rooms
          WHERE property_id = $id";


  if (mysqli_query($conn, $sql)) {
    
    echo header('location:property_landlord.php');
  } else {
    
    echo "Error updating record: " . mysqli_error($conn);
  }
}
?>
