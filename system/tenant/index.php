<?php
include 'database.php';
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
            <h1>Tenant Dashboard</h1>
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
                            <h1>MWK450,111.00</h1>
                        </div>


                    </div>
                </div>
                <div class="sales">
                    <span class="material-icons-sharp">group</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Amount Paid</h3>
                            <h1>MWK0</h1>
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

                    </div>

                </div>



                <script async src="https://js.stripe.com/v3/buy-button.js">

                    <script async
                        src="https://js.stripe.com/v3/buy-button.js">
                </script>

                <stripe-buy-button buy-button-id="buy_btn_1NE4duI0x23BUHNJBp84RZo4"
                    publishable-key="pk_test_scMohyFxHpovb9BDkm21uvXa">
                </stripe-buy-button>

            </div>

            <!--End of insghts lol-->
            <div class="recent-orders">

                
                <h2> Recent Payments</h2>


                <table>

                    <tbody>
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
                <div class="updates">
                    <div class="update">
                        <div class="profile-photo">
                            <img src="../landlord/assets/images/girl.jpeg" alt="">
                        </div>
                        <div class="message">
                            <p> <b>Maya Sangala</b> The Gyser has been fixed</p>
                            <small class="text-muted"></small>
                        </div>
                    </div>
        </div>



        </div>
        <script src="js/index.js"></script>
</body>


</html>