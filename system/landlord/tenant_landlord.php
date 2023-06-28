<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp"
    rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant</title>
    <link rel="stylesheet" href="css/style.css">


</head>
<body>
 
<div class="container">

 <?php
 include 'Navigationbar.php';
 include 'database.php'; 
 
 ?>


<!-- end aside by Tadala Kuntambila-->

<main class="main-scrollable">
<h1>Tenants</h1>
<div class="recent-orders">
 
<?php 

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
 <div class="payments">
        <div class="sales">
            <span class="material-icons-sharp"  >person</span>
            <div class="middle">
                <div class="left">
                    <h2>Tenants</h2>
                    <h1><?php echo $totalUsers; ?></h1>
                </div>             
            </div>
        </div>
        
        <div class="paid">
            <span class="material-icons-sharp">check_circle</span>
                <div class="middle">
                <div class="left">
                    <h2>Active</h2>
                    <h1><?php echo $totalActiveUsers  ?></h1>
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
                    <h1><?php echo $inactiveUsers ?></h1>
                </div>
                    
                </div>
        </div>
        <div class="archive">
        <span class="material-icons-sharp">inventory_2  </span>
            <div class="middle">
                <div class="left">
                    <h2>Archived</h2>
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
    <button onclick="openForm()" id="addtenant-button" class="add-property-button">Add Tenant</button>
  </div>
  




    <div class="form-popup" id="form-popup">
      <form action="add_tenant.php" method="GET" class="form-container">
        <h2>Add Tenant</h2>
    
        <label for="first-name"><b>First Name<b></label>
        <input type="text" placeholder="Enter First Name" name="name" required>

        <label for="last-name"><b>Last Name</b></label>
        <input type="text" placeholder="Enter Last Name" name="surname" required>

        <label for="city"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" required>

        <label for="username"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="username" required>

        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" required>  
    
        <div class="form-buttons">
        <button type="submit" class="btn">Add</button>
        <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
        </div>
      </form>
    </div>
    <div class="table-container">
    <table>
         
        <thead>
            
            <tr>
                
                <th> ID</th>
                <th> Username</th>
                <th> first name</th>
                <th> Last Name </th>
                <th> email</th>
                <th> Created Date</th>
                <th>Active</th>

            </tr>
        </thead>
        
        <tbody>
        <?php


$sql = "SELECT * FROM `users` WHERE `position` = 1";

$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {

  while ($row = mysqli_fetch_assoc($result)) {
   
    echo '<tr>';
    echo '<td>' . $row['user_id'] . '</td>';
    echo '<td>' . $row['username'] . '</td>';
    echo '<td>' . $row['name'] . '</td>';
    echo '<td>' . $row['surname'] . '</td>';
    echo '<td>' . $row['email'] . '</td>';
    echo '<td>' . $row['time'] . '</td>';
    echo '<td>' . ($row['active'] == 1 ?  'Active' : 'Inactive') . '</td>';
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
    <div class="updates">
        <div class="update">
            <div class="profile-photo">
                <img src="assets/images/girl.jpeg" alt="">
            </div>
            <div class="message">
                <p> <b>Daisy Benjamin</b> My heater has been broken for two days . plz help</p>
                <small class="text-muted"></small>
            </div>
        </div>
    </div>
    <div class="updates">
        <div class="update">
            <div class="profile-photo">
                <img src="assets/images/girl2.jpeg" alt="">
            </div>
            <div class="message">
                <p> <b>Laura McFadden</b> Hey, can you come over?</p>
                <small class="text-muted"></small>
            </div>
        </div>
    </div>
    <div class="updates">
        <div class="update">
            <div class="profile-photo">
                <img src="assets/images/guy4.jpeg" alt="">
            </div>
            <div class="message">
                <p> <b>Max Accounting</b> You got an extra set of keys? My dog locked me out agan..</p>
                <small class="text-muted"></small>
            </div>
        </div>
    </div>
    <div class="updates">
        <div class="update">
            <div class="profile-photo">
                <img src="assets/images/guy.jpeg" alt="">
            </div>
            <div class="message">
                <p> <b>Donald Benjamin</b> Please extend my lease</p>
                <small class="text-muted"></small>
            </div>
        </div>
    </div>
    <div class="updates">
        <div class="update">
            <div class="profile-photo">
                <img src="assets/images/guy2.jpeg" alt="">
            </div>
            <div class="message">
                <p> <b>Henry Samba </b>Kitchen needs maintaince. Do Now</p>
                <small class="text-muted"></small>
            </div>
        </div>
    </div>
    <div class="updates">
        <div class="update">
            <div class="profile-photo">
                <img src="assets/images/guy5.jpeg" alt="">
            </div>
            <div class="message">
                <p> <b>David Woke</b> Gonna sue you. </p>
                <small class="text-muted"></small>
            </div>
        </div>
    </div>
</div>
</div>

<script src="js/index.js"></script>
</body>


</html>