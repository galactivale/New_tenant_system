<?php

    $servername= "localhost";
    $username="root";
    $password="";
    $dbname="ktenant"; 

    $conn= mysqli_connect($servername,$username,$password,$dbname); 
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Authentication

    if(!isset($_SESSION)){
        session_start();
    }
    $isExist = false;
    if((isset($_SESSION["TENANT_ID"]) && $_SESSION["TENANT_ID"] != "") && (isset($_SESSION["TENANT_PASSWORD"]) && $_SESSION["TENANT_PASSWORD"] != "")){
        $auth_ID = $_SESSION["TENANT_ID"];
        $password = $_SESSION["TENANT_PASSWORD"];
        

        $isExist = false;
        $auth_password = ""; $auth_position = 0;
        $query = mysqli_query($conn, "SELECT * FROM `users` WHERE `user_id` = '$auth_ID'");
        while($result = mysqli_fetch_assoc($query)){
            $auth_password = $result['password'];
            $auth_position = $result['position'];
            $isExist = true;
        }

        if($isExist != false){
            if($auth_password == $password){
                if($auth_position != 0){
                    $isExist = false;
                }
            }
            else{
                $isExist = false;
            }
        }

        if($isExist != true){
            header("location:../../login.php");
            exit();
        }
    }

?>