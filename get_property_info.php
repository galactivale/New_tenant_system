<?php

require 'database.php'; 
if (isset($_GET['property_id'])) {
    $propertyId = $_GET['property_id'];

    $query = "SELECT * FROM property WHERE property_id = $propertyId ";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch tenant info
        $property = mysqli_fetch_assoc($result);

        $propertyInfo = ' <div class="property-details"> <h2>Property Information</h2>';
        $propertyInfo .=  ' <div class="property-image"> <img src=http://localhost/Tenant/system/landlord/photos/'. $property['property_image'] . '> </div>'; 
        $propertyInfo .= ' <div class="property-info"><h3><strong>Property Name:</strong> <div id="propertyName">' . $property['property_name'] . '</h3> </div>';
        $propertyInfo .= ' <h3><strong>Property ID:</strong> <div id="propertyid">' . $property['property_id'] . '</h3> </div>';
        $propertyInfo .= '<h3><strong>City :</strong> <div id="propertyCity">' . $property['city'] . '</h3> ';
        $propertyInfo .= '<h3><strong>Street address:</strong> <div id="streetAddress"> ' . $property['street_address'] . '</h3> </div>';
        $propertyInfo .= '<h3><strong>Monthly Rate:</strong> <div id="monthlyRate"> ' . $property['monthly_rate'] . '</h3> </div>';
        $propertyInfo .= '<h3><strong>Rooms:</strong><div id="rooms"> ' . $property['rooms'] . '</h3> </div> </div>';

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
