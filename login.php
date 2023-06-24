<?php

    // PHP Content

    if(!isset($_SESSION)){
        session_start();
    }
    session_destroy();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body>
    
    <div class="wrapper">
        <h2>KTenant </h2>
        <header>Login Form</header>
        <form action="system/auth.php" method="get">
            <div class="field email">
                <div class="input-area">
                    <input type="text" placeholder="Username" name="username">
                    <i class="icon fas fa-envelope"></i>
                    <i class="error error-icon fas fa-exclamation-circle"></i>
                </div>
             
            </div>
            <div class="field password">
                <div class="input-area">
                    <input type="password" placeholder="Password" name="password" required>
                    <i class="icon fas fa-lock"></i>
                    <i class="error error-icon fas fa-exclamation-circle"></i>
                </div>
                <div class="error error-txt">Password can't be blank</div>
            </div>
            <div class="pass-txt"><a href="#">Forgot password?</a></div>
            <input type="submit" value="Login">
        </form>
        <div class="sign-txt">Are you a Landlord? <a href="sign_up.php">Signup now</a></div>
    </div>

    <!-- <script src="script.js"></script> -->

</body>

</html>