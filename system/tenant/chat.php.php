<?php
//include 'database.php';
//header("Location: ../../login.php");
session_start();
if (isset($_SESSION["USER_ID"])) {
    $user_id = $_SESSION["USER_ID"];

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

<style>
        .chat-container {
            width: 400px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
        }

        .chat-message {
            margin-bottom: 10px;
        }

        .chat-message h4 {
            margin: 0;
        }

        .chat-message p {
            margin: 0;
        }

        .chat-form input,
        .chat-form textarea {
            width: 100%;
            margin-bottom: 10px;
        }

        .chat-form button {
            padding: 5px 10px;
        }
    </style>

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
            
            <div class="chat-container">
        <h2>Chat Interface</h2>
        <div class="chat-messages">
            <?
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "ktenant";

            $conn = mysqli_connect($servername, $username, $password, $dbname);
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="chat-message">';
                    echo '<h4>' . $row['title'] . '</h4>';
                    echo '<p>' . $row['description'] . '</p>';
                    echo '</div>';
                }
            } else {
                echo '<p>No chat messages available.</p>';
            }
            ?>
        </div>
        <div class="chat-form">
            <h3>New Message</h3>
            <form method="POST" action="">
                <input type="text" name="user_id" placeholder="User ID" required><br>
                <input type="text" name="title" placeholder="Title" required><br>
                <textarea name="description" placeholder="Description" required></textarea><br>
                <button type="submit">Send</button>
            </form>
        </div>
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