<?php
    include 'user_info_database.php';
    require_once('database.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp"
    rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landlord Dashoard</title>
    <link rel="stylesheet" href="css/style.css">

    

</head>
<body>
 
<div class="container">
<?php 
include 'Navigationbar.php';
?>
</aside>


<!-- end aside by Tadala Kuntambila-->

<main class="main-scrollable">
    <h1>Landlord Dashboard</h1>
    <div class="date">
        <?php
        $currentDate = date('Y-m-d');
        echo $currentDate;
        
        ?>

    </div>

    <div class="insights">
        <div class="sales">
            <span class="material-icons-sharp">paid</span>
            <div class="middle">
                <div class="left">
                    <h3>Total Payments</h3>
                    <h1> <?php echo $formattedPayments ?> </h1>
                </div>
                <div class="progress">
                    <svg>
                        <circle cx='38' cy='39' r='36'></circle>
                    </svg>  
                    
                </div>
                
            </div>
        </div>
        <div class="sales">
            <span class="material-icons-sharp">group</span>
            <div class="middle">
                <div class="left">
                    <h3>Total Tenants</h3>
                    <h1><?php echo  $totalUsers ?></h1>
                </div>
                <div class="progress">
                    <svg>
                        <circle cx='38' cy='39' r='36'></circle>
                    </svg>
                    
                </div>
            </div>
  
        </div>
        <div class="sales">
            <span class="material-icons-sharp">
                live_help
                </span>
            <div class="middle">
                <div class="left">
                    <h3>Inquires</h3>
                    <h1>0</h1>
                </div>
                <div class="progress">
                    <svg>
                        <circle cx='38' cy='39' r='36'></circle>
                    </svg>
                    
                </div>
            </div>
             
        </div>

        
    </div>

    <!--End of insghts lol-->
<div class="recent-orders">
<h2> Recent Tenants</h2>
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
            
        <p>Hey, <b><?php echo $_SESSION["USER_ID"]; ?></b></p>

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
                <img src="assets/images/girl.jpeg" alt="">
            </div>
            <div class="message">
                <p> <b>Daisy Benjamin</b> My heater has been broken for two days . plz help</p>
                <small class="text-muted"></small>
            </div>
        </div>
    </div>
</div>
</div>
<script src="js/index.js"></script>
</body>


</html>