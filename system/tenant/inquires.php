<?php
//include 'database.php';
//header("Location: ../../login.php");

include 'chat_functions.php';
session_start();
if (isset($_SESSION["USER_ID"])) {
    $user_id = $_SESSION["USER_ID"];
    $user_unique_id = $_SESSION["UNIQUE_ID"];


        echo "UNIQUE_ID: " . $user_unique_id;
    echo "USER_ID: " . $user_id;
} else {
    echo "USER_ID is not set in the session.";
}
if (!isset($_SESSION["USER_ID"])) {

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
            <h1>Inquires
                <?php isset($_SESSION["USER_ID"]); ?>
            </h1>
            <div class="date">
                <?php
                $currentDate = date('Y-m-d');
                echo $currentDate;

                ?>
            </div>
            <div class="chat-container">

    <div class="row chat-box">
      <div class="chat-history">
      
        <div id="chat-container"></div>
      </div>
    </div>
    <div class="row chat-input">
      <input type="text" id="message-input" placeholder="Type your message...">
      <button id="send-button">Send</button>
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
                    
                        <small class="text-muted">Tenant</small>
                    </div>
                
                </div>
            </div>
            <!--End of Top-->
            <div class="recent-updates">
                <h2>Recent Messages</h2>
                <div class="updates">
                   <p> No new messages </p>
                </div>



            </div>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

            <script>
                document.getElementById("send-button").addEventListener("click", function () {

                    var message = document.getElementById("message-input").value;

                    var data = new FormData();
                    data.append("message", message);

                    fetch("submit_message.php", {
                        method: "POST",
                        body: data
                    })
                        .then(function (response) {
                            if (response.ok) {
                                console.log(response);
                            } else {

                                console.error("Request failed. Status: " + response.status);
                            }
                        })
                        .catch(function (error) {
                            console.error("Request error:", error);
                        });

                    document.getElementById("message-input").value = "";
                });

            </script>

<script>
        $(document).ready(function() {

            function getMessages() {
                $.ajax({
                    url: "get_messages.php",
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            var messages = response.messages;
                            //var

                      
                            var chatContainer = $("#chat-container");
                            chatContainer.empty();

                            $.each(messages, function(index, message) {
                                var messageContainer = $("<div></div>").addClass("message-container");

                                
                                var messageContent = $("<div></div>").text(message.msg);
                                //console.log(message)

                                if (message.incoming_msg_id == <?= $_SESSION["UNIQUE_ID"] ?>) {

                                  
                                    messageContent.addClass("tenant-message");
                                } else {
                                    
                                    messageContent.addClass("landlord-message");
                                }

                                messageContainer.append(messageContent);
                                chatContainer.append(messageContainer);
                            });

                           
                            chatContainer.scrollTop(chatContainer.prop("scrollHeight"));
                        } else {
                            console.log("Error retrieving messages: " + response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log("AJAX error: " + error);
                    }
                });
            }


            getMessages();
            setInterval(getMessages, 3000);
           
        });
    </script>
</body>


</html>