<?php

$con = mysqli_connect("localhost", "root", "", "ktenant");

if(!$con){
    echo "failed to connect".mysqli_error();
}

$pic_uploaded = 0; 

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //Get form data
    $property_name = isset($_POST['property-name']) ? $_POST['property-name'] : '';
    $city = isset($_POST['city']) ? $_POST['city'] : '';
    $street_address = isset($_POST['street-address']) ? $_POST['street-address'] : '';
    $monthly_rate = isset($_POST['monthly-rate']) ? $_POST['monthly-rate'] : 0;
    $rooms = isset($_POST['rooms']) ? $_POST['rooms'] : 0;
    $pic = isset($_POST['pic']) ? $_POST['pic'] : '';

    $image = time().$_FILES["pic"]['name'];
    $image_url = 'http://localhost/Tenant/system/landlord/photos/' . $image;


    if(move_uploaded_file($_FILES['pic']['tmp_name'], $_SERVER['DOCUMENT_ROOT']. '/Tenant/system/landlord/photos/'. $image )) {

        $target_file = $_SERVER['DOCUMENT_ROOT'].'/landlord/photos/'.$image;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $picname = basename($_FILES['pic']['name']);
        $photo = time().$picname;
    
        if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") {
            ?>
            <script> alert("Please upload photo having extensions jpeg or png")</script>
            <?php
        } else if($_FILES["pic"]["size"] > 5000000) {
            ?>
            <script>alert("Your photo exceeds 5mb")</script>
            <?php
        } else {
            $pic_uploaded = 1; 
        }
    }
   
    if($pic_uploaded == 1) {
        $sql = "INSERT INTO `property` (`property_id`, `property_name`, `city`, `street_address`, `monthly_rate`, `property_status`, `rooms`, `property_image`, `created_at`) VALUES (NULL, '$property_name', '$city', '$street_address', '$monthly_rate', '', '$rooms', '$photo', current_timestamp())";
        $query_result = mysqli_query($con, $sql);

        if($query_result) {
            ?>
            <script> alert('Property successfully added')</script>
            <?php
            header('Location: property_landlord.php');
            exit;
        } else {
            ?>
            <script>alert("image not uploaded")</script>
            <?php
        }
    }
}

// Close connection
mysqli_close($con);
?>
