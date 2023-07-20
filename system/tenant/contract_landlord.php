


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
    <style>
    
        .file-viewer {
            width: 100%;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .file-viewer iframe {
            width: 100%;
            height: 100%;
        }
    </style>


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
  <h2>Contract Details</h2>
    
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
    <?php 
            include 'recent_messages.php'
            ?>
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