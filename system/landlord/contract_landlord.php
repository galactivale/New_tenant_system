<?php
require_once 'vendor/autoload.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp"
    rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Properties</title>
    <link rel="stylesheet" href="css/style.css">


</head>
<body>
 
<div class="container">

<?php
include 'Database.php';
include 'Navigationbar.php'; 

?>
<!-- end aside by Tadala Kuntambila-->

<main>
    
<div class="recent-orders">
  <h2>Contracts</h2>

  <?php 

$sql = "SELECT COUNT(*) as total_contracts FROM `contract` ";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  $totalContracts = $row['total_contracts'];
}
?>
 <div class="payments">
        <div class="sales">
            <span class="material-icons-sharp"  >person</span>
            <div class="middle">
                <div class="left">
                    <h2>Contracts</h2>
                    <h1><?php echo $totalContracts  ?> </h1>
                </div>             
            </div>
        </div>
        <div class="paid">
            <span class="material-icons-sharp">check_circle</span>
                <div class="middle">
                <div class="left">
                    <h2>Active</h2>
                    <h1>7</h1>
                </div>
                </div>
        </div>
        <div class="unpaid">
            <span class="material-icons-sharp">
                pending
                </span>
                <div class="middle">
                <div class="left">
                    <h2>inactive</h2>
                    <h1>0</h1>
                </div>
                    
                </div>
                
        </div>
        <div class="archive">
        <span class="material-icons-sharp">inventory_2  </span>
            <div class="middle">
                <div class="left">
                    <h2>Archive</h2>
                    <h1>0</h1>
                </div>
                
            </div>
  
        </div>
</div>

  <div class="action-buttons">
    <div class="search-bar">
      <form>
        <input type="text" placeholder="Search...">
        <button type="submit"><i class="material-icons-sharp">search</i></button>
      </form>
    </div>
    <button onclick="openAddContractURL()" class="add-property-button">Add Contract</button>

  </div>
  
    <div class="form-popup" id="myForm">
      <form action="" method="post" class="form-container">
        <h2>New Contract</h2>
    
        <label for="first-name"><b>First Name<b></label> 
        <input type="text" placeholder="Enter First Name" name="first-name" required>

        <label for="last-name"><b>Last Name</b></label>
        <input type="text" placeholder="Enter Last Name" name="last-name" required>

        <label for="city"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" required>

        <label for="username"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="username" required>

        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" required>
        
    
        <label for="phone-number"><b>Phone Number</b></label>
        <input type="text" placeholder="Enter City" name="city" required>   
    
        <div class="form-buttons">
        <button type="submit" class="btn">Add</button>
        <button type="button" class="btn" onclick="closeForm()">Close</button>
        </div>
      </form>
    </div>
    <table>
         
        <thead>
            
            <tr>
                <th> Contract ID</th>
                <th> Tenant ID</th>
                <th> Property ID </th>
                <th> Name </th>
                <th> Monthly Rate Amount</th>
                <th> Start Date</th>
                <th> End Date</th>
                <th> Status</th>


            </tr>
        </thead>
        <tbody>
              <?php

              include 'database.php'; 
              $sql = "SELECT * FROM `contract`";
              
              $result = mysqli_query($conn, $sql);
            
              if ($result && mysqli_num_rows($result) > 0) {
  
                while ($row = mysqli_fetch_assoc($result)) {
                  $monthlyRateValue = $row['monthly_rent'];
                  $formattedMonthly = 'MWK ' . number_format((float)$monthlyRateValue, 2, '.', ',');
                  echo '<tr>';
                  echo '<td>' . $row['contract_id'] . '</td>';
                  echo '<td>' . $row['user_id'] . '</td>';
                  echo '<td>' . $row['property_id'] . '</td>';
                  echo '<td>' . $row['first_name'] .  $row['last_name'] . '</td>';
                  echo '<td>' . $formattedMonthly. '</td>';
                  echo '<td>' . $row['contract_start_date'] . '</td>';
                  echo '<td>' . $row['contract_end_date'] . '</td>';
                  echo '<td>' . ($row['contract_status'] == 1 ?  'Active' : 'Inactive') . '</td>';
                  echo '</tr>';
                }
            
                echo '</table>';
              } else {

                echo 'No contracts found.';
              }

              ?>
        </tbody>
    </table>
    
</div>
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
    <?php  include 'recent_updates.php' ?>
</div>

<script src="js/index.js"></script>
<script>
  function openExternalURL() {
    window.open('manage_contracts.php', '_blank');
  }
  function openAddContractURL() {
    window.open('new_contract_landlord.php', '_blank');
  }
</script>
</body>


</html>