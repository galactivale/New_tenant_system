<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contract</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/css/select2.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container">

        <?php 
        include 'Navigationbar.php'; 
        ?>

        <main class="main-scrollable">
            <h2>Create new Contract</h2>

            <?php
            require_once 'database.php';
            $tenants = [];

            $query = "SELECT * FROM users WHERE position = 0";
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                $tenants[$row['user_id']] = $row['user_id'] . ' ' . $row['name'] . ' ' . $row['surname'];
            }
            ?>

            <div class="recent-orders">
                <h2>Please select a tenant below</h2>
                <div class="custom-select">
                    <select id="tenantSelect">
                        <option value="">Select a Tenant</option>
                        <?php foreach ($tenants as $id => $name) { ?>
                            <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div id="tenantInfoContainer"></div>
            </div>

            <?php
            require_once 'database.php';
            $properties = [];

            $query = "SELECT * FROM property";
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                $properties[$row['property_id']] = $row['property_name'];
            }
            ?>

            <div class="recent-orders">
                <h2>Please select a Property below</h2>
                <div class="custom-select">
                    <select id="propertySelect">
                        <option value="">Select a Property</option>
                        <?php foreach ($properties as $id => $name) { ?>
                            <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div id="propertyInfoContainer"></div>
            </div>

            <div class="recent-orders">
                <h2>Security Deposit Amount</h2>
                <h2>MWK<input type="text" class="outlined-input" name="deposit" id="deposit"></h2>
            </div>

            <div class="recent-orders">
                <h2>Monthly Rent Amount</h2>
                <h2>MWK<input type="text" class="outlined-input" name="monthlyRateValue" id="monthlyRateInput" disabled></h2>
            </div>

            <div class="recent-orders">
                <h2>Move In Date</h2>
                <input type="date" id="movein" name="movein">
            </div>

            <div class="recent-orders">
                <h2>Lease End Date</h2>
                <input type="date" id="endDate" name="endDate">
            </div>

            <div class="recent-orders">
                <div class="checkbox-container">
                    <input type="checkbox" class="checkbox-container" id="terms-checkbox" name="terms-checkbox">
                    <label for="terms-checkbox">I agree to the Terms of Agreement</label>
                </div>
            </div>

            <div class="recent-orders">
                <button class="generate-contract-button" id="generatePdf">Generate Contract</button>
            </div>
            
        </main>
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

        
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/js/select2.min.js"></script>
        <script src="js/index.js"></script>

        <script>
  $(document).ready(function() {
    var selectedOptionIDT;

    $('#propertySelect').change(function() {
      selectedOptionIDT = $(this).val();
      console.log(selectedOptionIDT, "selected ID");

      $.ajax({
        type: 'GET',
        url: 'get_property_info.php',
        data: { property_id: selectedOptionIDT },
        success: function(response) {
          $('#propertyInfoContainer').html(response);
          var tempElement;

          var tempElement = $('<div>').html(response);
          var monthlyRate = tempElement.find('#monthlyRateValue').val();
          // Display the monthly rate in an input field
          $('#monthlyRateInput').val(monthlyRate);
        },
        error: function(xhr, status, error) {
          console.log('AJAX request failed: ' + status + ', Error: ' + error);
        }
      });
    });

    $('#tenantSelect').change(function() {
      var selectedOptionID = $(this).val();
      console.log(selectedOptionID, "selected ID");

      $.ajax({
        type: 'GET',
        url: 'get_tenant_info.php',
        data: { user_id: selectedOptionID },
        success: function(response) {
          $('#tenantInfoContainer').html(response);
          var tempElement = $('<div>').html(response);
        },
        error: function(xhr, status, error) {
          console.log('AJAX request failed: ' + status + ', Error: ' + error);
        }
      });
    });

    $('#generatePdf').click(function() {
      var userId = $('#idUser').text();
      var firstName = $('#FnameTenant').text();
      var surname = $('#LnameTenant').text();
      var propertyName = $('#propertyName').text();
      var propertyCity = $('#propertyCity').text();
      var streetAddress = $('#streetAddress').text();
      var rooms = $('#rooms').text();
      var deposit = $('#deposit').val();
      var propertyId = selectedOptionIDT;
      var monthlyRateValue = $('#monthlyRateValue').val();
      var endDate = $('#endDate').val();
      var movein = $('#movein').val();

      $.ajax({
        url: 'generate_contract_pdf.php',
        method: 'POST',
        data: {
          userId: userId,
          firstName: firstName,
          surname: surname,
          propertyName: propertyName,
          propertyCity: propertyCity,
          streetAddress: streetAddress,
          rooms: rooms,
          deposit: deposit,
          propertyId: propertyId,
          monthlyRateValue: monthlyRateValue,
          endDate: endDate,
          movein: movein
        },
        success: function(response) {
          console.log(response);
        },
        error: function(xhr, status, error) {
          console.log(error);
        }
      });
    });
  });
</script>


    </body>
</html>
