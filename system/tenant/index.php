<?php
session_start();
if (isset($_SESSION["USER_ID"])) {
    $user_id = $_SESSION["USER_ID"];
     $user_unique_id = $_SESSION["UNIQUE_ID"];
     
    echo "UNIQUE_ID:" . $user_unique_id; 
    echo "USER_ID: " . $user_id;
} else {
    echo "USER_ID is not set in the session.";
}
if( !isset($_SESSION["USER_ID"]) ){
  
    header("Location:../../login.php");
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant Dashboard</title>
    <link rel="stylesheet" href="css/style.css">



</head>

<body>

    <div class="container">
        <?php
        include 'Navigationbar.php';
        ?>
        </aside>


        <!-- end aside by Tadala Kuntambila-->

        <main>
            <h1>Tenant Dashboard <?php isset($_SESSION["USER_ID"]);?></h1>
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
                            <h3>Amount Remaining </h3>
                            <h1> <?php
                            // DATABASE
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "ktenant";

                            $conn = mysqli_connect($servername, $username, $password, $dbname);
                            if (!$conn) {
                                die("Connection failed: " . mysqli_connect_error());
                            }

                            $sql = "SELECT contract.contract_id, contract.user_id, monthly_rent, (monthly_rent - IFNULL(SUM(payment_amount), 0)) AS amount_remaining
                                    FROM contract
                                    LEFT JOIN payment ON contract.contract_id = payment.contract_id
                                    WHERE contract.user_id = '$user_id'
                                    GROUP BY contract.contract_id";

                            $result = mysqli_query($conn, $sql);

                            
                            if ($result && mysqli_num_rows($result) > 0) {
                                $row = mysqli_fetch_assoc($result);
                                $amountRemaining = $row['amount_remaining'];
                                if ($amountRemaining > 0) {
                                    echo '<h1>MWK' . $amountRemaining . '</h1>';
                                } else {
                                    echo '<h1>0</h1>';
                                }
                            } else {
                                echo '<h1>0</h1>';
                            }
                            ?></h1>
                        </div>


                    </div>
                </div>
                <div class="sales">
                    <span class="material-icons-sharp">group</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Amount Paid</h3>
                            <h1><?php
                        
                                $servername = "localhost";
                                $username = "root";
                                $password = "";
                                $dbname = "ktenant";

                                $conn = mysqli_connect($servername, $username, $password, $dbname);
                                if (!$conn) {
                                    die("Connection failed: " . mysqli_connect_error());
                                }

                                $sql = "SELECT SUM(payment_amount) AS total_paid FROM payment    WHERE user_id = '$user_id'";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_assoc($result);
                                echo "MWK" . $row['total_paid'];
                                ?></h1>
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
                            <h1>1</h1>
                        </div>

                    </div>

                </div>

            </div>

            <!--End of insghts lol-->
            <div class="recent-orders">


                <h2> Recent Payments</h2>


                <?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ktenant";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (!isset($_SESSION["USER_ID"])) {

    header("location: login.php");
    exit();
}


$userID = $_SESSION["USER_ID"];

$sql = "SELECT * FROM `payment` WHERE `user_id` = '$userID'";

$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    // Output table headers
    echo '<table>
            <tr>
                <th>Payment ID</th>
                <th>Amount</th>
                <th> Payment Type </th>
                <th>Date</th>
            </tr>';

    // Iterate over the result set and output table rows
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['payment_id'] . '</td>';
        echo '<td>' . $row['payment_amount'] . '</td>';
        echo '<td>' . $row['payment_type'] . '</td>';
        echo '<td>' . $row['payment_date'] . '</td>';
        echo '</tr>';
    }

    // Close the table
    echo '</table>';
} else {
    echo 'No payment records found.';
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
                    
                        <small class="text-muted">Tenant</small>
                    </div>
                   
                </div>
            </div>
            <!--End of Top-->
            <div class="recent-updates">
                <h2>Recent Messages</h2>
                <div class="updates">
                    <div class="update">
                        <div class="profile-photo">
                            <img src="../landlord\assets\images/tadala.jpeg" alt="">
                        </div>
                        <div class="message">
                            <p> <b>Tadala </b> The Gyser has been fixed</p>
                            <small class="text-muted"></small>
                        </div>
                    </div>
                </div>
                



            </div>
            <script src="js/index.js"></script>
</body>


</html>