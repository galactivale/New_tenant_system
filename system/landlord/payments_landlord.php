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
    include 'database.php';
    include 'Navigationbar.php'; 
?>


<!-- end aside by Tadala Kuntambila-->

<main>
    <h1>Payments</h1>

    
    
    <div class="payments">
        <div class="sales">
            <span class="material-icons-sharp">paid</span>
            <div class="middle">
                <div class="left">
                    <h2>Total Payments</h2>
                    <h1>MWK685,000</h1>
                </div>             
            </div>
        </div>
        <div class="invoices">
            <span class="material-icons-sharp">receipt_long</span>
            <div class="middle">
                <div class="left">
                    <h2>Invoices</h2>
                    <h1>2</h1>
                </div>
                
            </div>
  
        </div>
        <div class="paid">
            <span class="material-icons-sharp">check_circle</span>
                <div class="middle">
                <div class="left">
                    <h2>paid</h2>
                    <h1>2</h1>
                </div>
                    
                </div>
        </div>
        <div class="unpaid">
            <span class="material-icons-sharp">
                pending
                </span>
                <div class="middle">
                <div class="left">
                    <h2>unpaid</h2>
                    <h1>1</h1>
                </div>
                    
                </div>
        </div>
             
        
        <button onclick="openForm()" id="invoice-button">Create Invoice</button>

    </div>
    <div class="form-popup" id="form-popup">
        <div class="form-container">
          <h2>Create Invoice</h2>
          <form>
            <label for="invoice-number">Tenant</label>
            <input type="text" id="tenant" name="tenant" required>
            <label for="invoice-number">Invoice Number</label>
            <input type="text" id="invoice-number" name="invoice-number" required>
            <label for="amount">Amount</label>
            <input type="number" id="amount" name="amount" required>
            <label for="description">Description</label>
            <input type="text" id="description" name="description" required>
            <div class="form-buttons">
              <button type="submit" class="btn">Create</button>
              <button type="button" id="closenow" class="btn cancel" onclick="closeForm()">Cancel</button>
            </div>
          </form>
        </div>
      
    </div>

    <div class="recent-orders">
        <h2>Payments</h2>
        <table>
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