<?php
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $tenantId = $_POST['selectedTenantId'];
    $paymentType = $_POST['payment-type'];
    $amount = $_POST['amount'];
    $description = $_POST['description'];

    $query = "SELECT contract_id FROM contract WHERE user_id = $tenantId";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $contractId = $row['contract_id'];

        // Construct the SQL query
        $query = "INSERT INTO payment (payment_id, user_id, contract_id, payment_date, payment_amount, payment_type)
                  VALUES ('', '$tenantId', '$contractId', CURRENT_DATE, '$amount', '$paymentType')";

        // Execute the query
        if ($conn->query($query) === TRUE) {
            // Payment record successfully added
            echo "Payment record added successfully.";
        } else {
            // Error occurred while adding the payment record
            echo "Failed to add payment record: " . $conn->error;
        }
    } else {
        // No contract found for the selected tenant
        echo "No contract found for the selected tenant.";
    }

    // Close the database connection
    $conn->close();
}
?>
