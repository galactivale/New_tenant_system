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
    

</head>

<body>
    <div class="container">

        <?php 
     include 'database.php';
        include 'Navigationbar.php'; 
        ?>



        <!-- end aside by Tadala Kuntambila-->

        <main class="main-scrollable">
            <h1>Properties</h1>

            <button onclick="openForm()" class="add-property-button">Add Property</button>



            <div class="form-popup" id="form-popup">
                <form method="post" action="add_property.php" class="form-container" enctype="multipart/form-data">
                    <h2>Add Property</h2>

                    <label for="property-name"><b>Property Name</b></label>
                    <input type="text" placeholder="Enter Property Name" name="property-name" required>

                    <label for="city"><b>City</b></label>
                    <input type="text" placeholder="Enter City" name="city" required>

                    <label for="street-address"><b>Street Address</b></label>
                    <input type="text" placeholder="Enter Street Address" name="street-address" required>

                    <label for="monthly-rate"><b>Monthly Rate</b></label>
                    <input type="number" placeholder="Enter Monthly Rate" name="monthly-rate" required>

                    <label for="rooms"><b>Rooms</b></label>
                    <input type="number" placeholder="Enter Number of Rooms" name="rooms" required>

                    <input for="image" name="pic" id="pic" type="file" accept=".jpeg" />

                    <div class="form-buttons">
                        <button type="submit" class="btn">Add</button>


                </form>
                <button class="btn" onclick="closeForm()">Close</button>
            </div>
    </div>
    <!--Property listing card-->



    <?php
        include 'database.php'; 

        if (isset($_POST['delete'])) {
            $id = $_POST['property_id'];
            $sql = "DELETE FROM property WHERE property_id = $id";
    
            if (mysqli_query($conn, $sql)) {
               
            } else {
                echo "Error deleting record: " . mysqli_error($conn);
            }
        }
        $result = mysqli_query($conn, "SELECT * FROM property");
        if(mysqli_num_rows($result) > 0) {
          
            $num = 0;
            while($row = mysqli_fetch_assoc($result)) {
                $popup = "popup_" . $num;
                $monthlyRateValue = $row['monthly_rate'];
                $formattedMonthly = 'MWK ' . number_format((float)$monthlyRateValue, 2, '.', ',');
                ?>
    <div class="property-listing">
        <div class="image-box">
            <img src="<?php echo $row['property_image'] ? 'http://localhost/Tenant/system/landlord/photos/'.$row['property_image'] : 'http://localhost/Tenant/system/landlord/photos/default.png'; ?>"
                alt="Property Image">
        </div>
        <div class="column">
            <h2><?php echo $row["property_name"]; ?></h2>
            <span class="text-muted"><?php echo $row["street_address"] . ', ' . $row["city"]; ?></span>
            <h4>Monthly Rate</h4>
            <h2 class="success"><?php echo $formattedMonthly; ?></h2>
            <div class="icon-box">
                <span>rooms<h2><?php echo $row["rooms"]; ?><span class="material-icons-sharp">meeting_room</span></h2>
                    </span>
            </div>
            <div class="button-box">
                <button onclick="popup('<?php echo $popup ?>', 0)">Edit</button>

                <form action="" method="post">
                    <input type="hidden" name="property_id" value="<?php echo $row['property_id']; ?>">
    
                            <button type="submit" class="button-box "name="delete">Delete</button>
                    
                </form>
            </div>
        </div>
    </div>

    <!-- Popup -->

    <div class="popup" id="<?php echo $popup ?>">
        <div class="popup-box">
            <div class="popup-content">
                <!-- Edit propery info  -->
                <img src="<?php echo $row['property_image'] ? 'http://localhost/Tenant/system/landlord/photos/'.$row['property_image'] : 'http://localhost/Tenant/system/landlord/photos/default.png'; ?>"
                    alt="Property https://github.com/galactivale/web-ktenantImage">
                <form action="update_property.php" method="post">
                    <input type="hidden" name="property_id" value="<?php echo $row['property_id']; ?>">

                    <label for="property-name"><b>Property Name</b></label>
                    <input type="text" value="<?php echo $row["property_name"]; ?>" name="property-name" required>
                    <label for="city"><b>City</b></label>
                    <input type="text" value="<?php echo $row["city"]; ?>" name="city" required>
                    <label for="street-address"><b>Street Address</b></label>
                    <input type="text" value="<?php echo $row["street_address"]; ?>" name="street-address" required>
                    <label for="monthly-rate"><b>Monthly Rate</b></label>
                    <input type="number" value="<?php echo $row["monthly_rate"]; ?>" name="monthly-rate" required>
                    <label for="rooms"><b>Rooms</b></label>
                    <input type="number" value="<?php echo $row["rooms"]; ?>" name="rooms" required>
                    <input for="image" name="pic" id="pic" type="file" accept=".jpeg" />

            </div>
            <div class="popup-button">
                <button type="submit" name="update" class="update-btn">Update</button>
                </form>
                <button onclick="popup('<?php echo $popup ?>', 1)">Cancel</button>
            </div>
        </div>
    </div>




    <?php
                $num++;
            }
        }
        else {
            echo "No result found";
        }
    ?>
    </main>
    <!--Endo main-->
    <div class="right">
        <div class="top"><button id="menu-btn">
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


        <script src="js/index.js"></script>
        <script>
        function _(id) {
            return document.getElementById(id);
        }

        function popup(name, num) {
            if (num == 0) {
                _(name).style.display = "flex";
            } else {
                _(name).style.display = "none";
            }
        }
        var cancelButton = document.querySelector(".popup-button button:last-of-type");
        cancelButton.addEventListener("click", function() {
            popup('<?php echo $popup ?>', 1);
        });
        </script>
</body>


</html>