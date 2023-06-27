<?php

require 'database.php'; 
if (isset($_GET['property_id'])) {
    $propertyId = $_GET['property_id'];

    $query = "SELECT * FROM property WHERE property_id = $propertyId ";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
      // Fetch tenant info
      $property = mysqli_fetch_assoc($result);

      $propertyInfo = '<div class="row">';
      $propertyInfo .= '<div class="col-md-4">';
     $propertyInfo .= '<div class="property-image" style="height: 100%;"><img src="http://localhost/Tenant/system/landlord/photos/' . $property['property_image'] . '" style="width: 100%; height: 100%; object-fit: cover;"></div>';
    $propertyInfo .= '</div>';
      
      $propertyInfo .= '<div class="col-md-4">';
      $propertyInfo .= '<h5><strong>Property Information</strong></h5>';
      $propertyInfo .= '<div id="propertyName">' . '<h5>'. $property['property_name'] . '</h5>' .'</div>';
      $propertyInfo .= '<p><strong>Property ID:</strong></p>';
      $propertyInfo .= '<div id="propertyid">' . $property['property_id'] . '</div>';
      $propertyInfo .= '<p><strong>City:</strong></p>';
      $propertyInfo .= '<div id="propertyCity">' . $property['city'] . '</div>';
      $propertyInfo .= '<p><strong>Street address:</strong></p>';
      $propertyInfo .= '<div id="streetAddress">' . $property['street_address'] . '</div>';
      $propertyInfo .= '<p><strong>Monthly Rate:</strong></p>';
      $propertyInfo .= '<div id="monthlyRate">' . $property['monthly_rate'] . '</div>';
      $propertyInfo .= '</div>';
      
      
      $propertyInfo .= '<div class="col-md-4">';
      
  
      $propertyInfo .= '<p><strong>Rooms:</strong></p>';
      $propertyInfo .= '<div id="rooms">' . $property['rooms'] . '</div>';
      $propertyInfo .= '<p><strong>Square Feet:</strong></p>';
      $propertyInfo .= '<div id="sqrfeet">' . $property['square_feet'] . '</div>';
      $propertyInfo .= '<p><strong>Square Feet:</strong></p>';
      $propertyInfo .= '<div id="baths">' . $property['baths'] . '</div>';
      $propertyInfo .= '<p><strong>Kitchen:</strong></p>';
      $propertyInfo .= '<div id="kitchen">' . $property['kitchen'] . '</div>';
      $propertyInfo .= '<p><strong>balcony Feet:</strong></p>';
      $propertyInfo .= '<div id="balcony">' . $property['balcony'] . '</div>';
      $propertyInfo .= '</div>';
      
      $propertyInfo .= '</div>';
      
      $monthlyRate = $property['monthly_rate'];
      
      $propertyInfo .= '<input type="hidden" id="monthlyRateValue" value="' . $monthlyRate . '">';
      
      // Return HTML
      echo $propertyInfo;
      
      

    } else {
        echo 'Tenant not found.';
    }
} else {
    
    echo 'Invalid request.';
}
?>