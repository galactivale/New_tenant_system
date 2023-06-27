<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp"
    rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payments</title>
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
 
<div class="container">

<?php   
//include 'database.php';
//header("Location: ../../login.php");
session_start();
if( !isset($_SESSION["username"]) ){
    header("Location:../../login.php");
    exit();
}



        include 'Navigationbar.php'; 
        ?>


<!-- end aside by Tadala Kuntambila-->

<main>
    <h1>Payments</h1>

    <?php
// Execute the SQL query
$sql = "SELECT p.payment_id, u.name, u.surname, p.payment_amount, p.payment_date
        FROM payment p
        JOIN contract c ON p.contract_id = c.contract_id
        JOIN users u ON c.user_id = u.user_id";

$result = mysqli_query($conn, $sql);

// Check if any rows are returned
if ($result && mysqli_num_rows($result) > 0) {
    // Output table headers
    echo '<table>
            <tr>
                <th>Payment ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Amount</th>
                <th>Date</th>
            </tr>';

    // Iterate over the result set and output table rows
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['payment_id'] . '</td>';
        echo '<td>' . $row['first_name'] . '</td>';
        echo '<td>' . $row['last_name'] . '</td>';
        echo '<td>' . $row['payment_amount'] . '</td>';
        echo '<td>' . $row['payment_date'] . '</td>';
        echo '</tr>';
    }

    // Close the table
    echo '</table>';
} else {
    echo 'No payment records found.';
}
?>

    
    <div class="recent-orders">
        <h2>Payment History </h2>
        <table>
            <thead>
                <tr>
                    <th> ID</th>
                    <th> Name</th>
                    <th> Amount </th>
                    <th> email</th>
                    <th> phone number</th>
                    <th> status</th>
                    <th>edit</th>
    
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td> T001</td>
                    <td> Linda Styles</td>
                    <td> MWK450,000</td>
                    <td> lindast21@gmail.com</td>
                    <td> 0998321182 </td>
                    <td class="warning"> pending</td>
                    <td class="primary">details</td>
                </tr>
                <tr>
                    <td> T030</td>
                    <td> Martin Luther</td>
                    <td> MWK140,000</td>
                    <td> Martinndast21@gmail.com</td>
                    <td> 0998321182 </td>
                    <td class="success"> paid</td>
                    <td class="primary">details</td>
                </tr>
                <tr>
                    <td> T009</td>
                    <td> Gary Vee</td>
                    <td> MWK600,000</td>
                    <td> Garyvee@gmail.com</td>
                    <td> 0998321140 </td>
                    <td class="success"> active</td>
                    <td class="primary">details</td>
                </tr>
                <tr>
                    <td> T012</td>
                    <td> AJ Styles</td>
                    <td> MWK720,500</td>
                    <td> ajstyles@icould.com</td>
                    <td> 0998321182 </td>
                    <td class="success"> active</td>
                    <td class="primary">details</td>
                </tr>
                <tr>
                    <td> T001</td>
                    <td> Harry Potter</td>
                    <td> MWK610,000</td>
                    <td> Harrypotter@yahoo.com</td>
                    <td> 0998221182 </td>
                    <td class="success"> active</td>
                    <td class="primary">details</td>
                </tr>
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
</body>


</html>