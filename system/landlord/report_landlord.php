<!DOCTYPE html>
<html lang="en">

<head>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>



</head>

<body>
    <div class="container">

        <?php
        include 'database.php';
        include 'Navigationbar.php';
        ?>



        <!-- end aside by Tadala Kuntambila-->

        <main class="main-scrollable">
            <h1>Reports</h1>
            <div class="my-container">
                <div class="column">
                    <h2>Payments</h2>

                    <div>
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
                <div class="column">
                    <!-- Content for the second column -->
                    <h2>Tenants</h2>
                    <canvas id="tenantChart"></canvas>
                </div>

            </div>
            <h2>Tenant Information</h2>

          
                <table class ="table-container  ">

                    <thead>

                        <tr>

                            <th> ID</th>
                            <th> Username</th>
                            <th> first name</th>
                            <th> Last Name </th>
                            <th> Created Date</th>
                            <th>View Report</th>

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
                                echo '<td>' . $row['time'] . '</td>';
                                echo  '<td>'. '<button onclick="generateReport(' . $row['user_id'] . ')">View Report</button>' .'</td>';
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
                <?php  include 'recent_updates.php' ?>
            </div>

            <script>

                const ctx = document.getElementById('myChart');
                $.ajax({
                    url: 'get_payment_data.php',
                    dataType: 'json',
                    success: function (data) {
                        const labels = [];
                        const amounts = [];

                
                        data.forEach(function (row) {
                            labels.push(row.payment_date);
                            amounts.push(row.total_amount);
                        });

               
                        new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Payment Amount',
                                    data: amounts,
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    }
                });

            </script>

            <script>
                const ctx = document.getElementById('tenantChart').getContext('2d');

                $.ajax({
                    url: 'get_tenant_data.php',
                    dataType: 'json',
                    success: function (data) {
                        const labels = [];
                        const dataPoints = [];


                        data.forEach(function (row) {
                            labels.push(row.time);
                            dataPoints.push(row.totalTenants);
                        });

                     
                        new Chart(actx, {
                            type: 'line',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Total Tenants',
                                    data: dataPoints,
                                    backgroundColor: 'rgba(255, 0, 0, 0.5)',
                                    borderColor: 'red',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    }
                });

            </script>

            <script>
                const actx = document.getElementById('tenantChart').getContext('2d');

                $.ajax({
                    url: 'get_tenant_data.php',
                    dataType: 'json',
                    success: function (datat) {
                        const timeLabels = [];
                        const tenantData = [];

                        datat.forEach(function (row) {
                            timeLabels.push(row.time);
                            tenantData.push(row.totalTenants);
                        });

          
                        new Chart(actx, {
                            type: 'line',
                            data: {
                                labels: timeLabels,
                                datasets: [{
                                    label: 'Total Tenants',
                                    data: tenantData,
                                    backgroundColor: 'rgba(255, 0, 0, 0.5)',
                                    borderColor: 'red',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    }
                });

            </script>


            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



    <script>
  function generateReport(userId) {
    window.location.href = 'generate_tenant_report.php?userId=' + userId;
  }
</script>


</body>




</html>