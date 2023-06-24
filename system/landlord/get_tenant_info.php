<?php
require 'database.php';

if (isset($_GET['user_id'])) {
    $userId = $_GET['user_id'];

    $query = "SELECT * FROM users WHERE user_id = $userId AND position = 0";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch user info
        $user = mysqli_fetch_assoc($result);

        $imageURL = $user['user_img'];
        $baseURL = 'http://localhost/Tenant/system/landlord/photos/';

        // Check if image URL is null or empty
        if (empty($imageURL)) {
            $imageURL = 'default_person.jpg';
        }

        $propertyInfo = ' <div  class="property-details"> <h2>Tenant Information</h2>';
        $propertyInfo .= '<div class="property-image"><img src="'. $baseURL . $imageURL . '"></div>';
        $propertyInfo .= ' <div class="property-info"><h3><strong>User Id:</strong> <div id="idUser"> ' . $user['user_id'] . '</h3>  </div>';
        $propertyInfo .= '<h3><strong>First Name:</strong> <div id="FnameTenant" >' . $user['name'] . '</h3> ' ;
        $propertyInfo .= ' <h3><strong>Surname :</strong><div id="LnameTenant"> ' . $user['surname'] . '</h3></div> ';

        
        // Return HTML
        echo $propertyInfo;
    } else {
        echo 'User not found.';
    }
} else {
    echo 'Invalid request.';
}
?>
