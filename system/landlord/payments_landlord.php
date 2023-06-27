<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
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
            <h1>
                <?php
                    $totalPayments = 0;
                    $sql = "SELECT SUM(payment_amount) AS total_payments FROM payment";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $totalPayments = $row['total_payments'];
                    $formattedPayments = 'MWK ' . number_format((float)$totalPayments, 2, '.', ',');
                    echo "Payments " ;
                ?>
            </h1>

            <div class="payments">
                <div class="sales">
                    <span class="material-icons-sharp">paid</span>
                    <div class="middle">
                        <div class="left">
                            <h2>Total Payments</h2>
                            <h1><?php echo $formattedPayments; ?></h1>
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
                    <span class="material-icons-sharp">pending</span>
                    <div class="middle">
                        <div class="left">
                            <h2>unpaid</h2>
                            <h1>1</h1>
                        </div>
                    </div>
                </div>
                <button onclick="openForm()" id="invoice-button">Add Record</button>
            </div>

            <?php
                require_once 'database.php';
                $tenants = [];
                $query = "SELECT * FROM contract WHERE contract_status = 1";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    $tenants[$row['user_id']] = $row['user_id'] . ' ' . $row['first_name'] . ' ' . $row['last_name'];
                }
            ?>

            <div class="form-popup" id="form-popup">
                <div class="form-container">
                    <h2>Add Payment Record</h2>
                    <form action="add_payment_record.php" method="post">
                        <label for="invoice-number">Tenant</label>
                        <select id="tenantSelect" name="tenantSelect">
                            <option required value="">Select a Tenant</option>
                            <?php foreach ($tenants as $id => $name) { ?>
                                <option value="<?php echo $id; ?>" data-contract-id="<?php echo $id; ?>">
                                    <?php echo $name; ?>
                                </option>
                            <?php } ?>
                        </select>
                        <input type="hidden" id="contractId" name="contractId" value="">
                        <label for="payment-type">Payment Type</label>
                        <select id="payment-type" name="payment-type" required>
                            <option value="cash">Cash</option>
                            <option value="check">Check</option>
                        </select>
                        <input type="hidden" id="selectedTenantId" name="selectedTenantId" value="">
                        <label for="amount">Amount</label>
                        <input type="number" id="amount" name="amount" required>
                        <label for="description">Description</label>
                        <input type="text" id="description" name="description" required>
                        <div class="form-buttons">
                            <button type="submit" class="btn">Add Record</button>
                            <button type="button" id="closenow" class="btn cancel" onclick="closeForm()">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="recent-orders">
                <h2>Payments</h2>
                <?php
                    $sql = "SELECT p.payment_id, u.name, u.surname, p.payment_amount, p.payment_date, p.payment_type
                            FROM payment p
                            JOIN contract c ON p.contract_id = c.contract_id
                            JOIN users u ON c.user_id = u.user_id";
                    $result = mysqli_query($conn, $sql);
                    if ($result && mysqli_num_rows($result) > 0) {
                        echo '<table>
                                <tr>
                                    <th>Payment ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Amount</th>
                                    <th>Type</th>
                                    <th>Date</th>
                                </tr>';
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '<td>' . $row['payment_id'] . '</td>';
                            echo '<td>' . $row['name'] . '</td>';
                            echo '<td>' . $row['surname'] . '</td>';
                            echo '<td>' . $row['payment_amount'] . '</td>';
                            echo '<td>' . $row['payment_type'] . '</td>';
                            echo '<td>' . $row['payment_date'] . '</td>';
                            echo '</tr>';
                        }
                        echo '</table>';
                    } else {
                        echo 'No payment records found.';
                    }
                ?>
            </div>
        </main>

        <div class="right">
            <div class="top">
                <button id="menu-btn">
                    <span class="material-icons-sharp">menu</span>
                </button>
                <div class="theme-toggler">
                    <span class="material-icons-sharp active">light_mode</span>
                    <span class="material-icons-sharp">dark_mode</span>
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

            <div class="recent-updates">
                <h2>Recent Messages</h2>
                <?php include 'recent_messages.php'; ?>
            </div>

            <script src="js/index.js"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('#tenantSelect').change(function() {
                        var selectedOptionID = $(this).val();
                        $('#selectedTenantId').val(selectedOptionID);
                    });

                    $('#contractId').change(function() {
                        var contractID = $(this).val();
                        $('#contractId').val(contractID);
                    });
                });
            </script>
        </div>
    </div>
</body>
</html>