<?php
require_once __DIR__ . '/vendor/autoload.php'; 

if (isset($_GET['userId'])) {
    $userId = $_GET['userId'];


    $mysqli = new mysqli('localhost', 'root', '', 'ktenant');

    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
    }

    $query = "SELECT * FROM Users WHERE user_id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $userData = $result->fetch_assoc();

    $query = "SELECT * FROM contract WHERE user_id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $contractData = $result->fetch_assoc();

    $query = "SELECT * FROM Payment WHERE user_id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $paymentData = $result->fetch_all(MYSQLI_ASSOC);

    $propertyData = [];
    if ($contractData) {
        $propertyId = $contractData['property_id'];

        $query = "SELECT * FROM property WHERE property_id = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('i', $propertyId);
        $stmt->execute();
        $result = $stmt->get_result();
        $propertyData = $result->fetch_assoc();
    }

    $mpdf = new \Mpdf\Mpdf();
    $html = '
        <h1><i class="fas fa-file-alt"></i> User Report</h1>
        <h2><i class="fas fa-user"></i> User Details:</h2>
        <p><i class="fas fa-user-circle"></i> Username: ' . $userData['username'] . '</p>
        <p><i class="fas fa-user"></i> Name: ' . $userData['name'] . '</p>
        <p><i class="fas fa-user"></i> Surname: ' . $userData['surname'] . '</p>
        <p><i class="fas fa-envelope"></i> Email: ' . $userData['email'] . '</p>';

    if ($propertyData) {
        $html .= '
        <h2><i class="fas fa-home"></i> Property Details:</h2>
        <p><i class="fas fa-building"></i> Property Name: ' . $propertyData['property_name'] . '</p>
        <p><i class="fas fa-map-marker-alt"></i> City: ' . $propertyData['city'] . '</p>
        <p><i class="fas fa-map-marked-alt"></i> Street Address: ' . $propertyData['street_address'] . '</p>
        <p><i class="fas fa-dollar-sign"></i> Monthly Rate: ' . $propertyData['monthly_rate'] . '</p>';
    }

    $html .= '
        <h2><i class="fas fa-file-contract"></i> Contract Details:</h2>
        <p><i class="fas fa-calendar-alt"></i> Contract Start Date: ' . $contractData['contract_start_date'] . '</p>
        <p><i class="fas fa-calendar-alt"></i> Contract End Date: ' . $contractData['contract_end_date'] . '</p>
        <p><i class="fas fa-check"></i> Contract Status: ' . $contractData['contract_status'] . '</p>

        <h2><i class="fas fa-history"></i> Payment History:</h2>
        <table>
            <thead>
                <tr>
                    <th><i class="fas fa-calendar-day"></i> Date</th>
                    <th><i class="fas fa-money-bill"></i> Amount</th>
                </tr>
            </thead>
            <tbody>';
    foreach ($paymentData as $payment) {
        $html .= '
                <tr>
                    <td>' . $payment['payment_date'] . '</td>
                    <td>' . $payment['payment_amount'] . '</td>
                </tr>';
    }
    $html .= '
            </tbody>
        </table>
     ';

    $mpdf->WriteHTML($html);
    ob_clean();
    $mpdf->Output('user_report.pdf', 'D');
} else {
    echo "Invalid user ID.";
}
?>
