<?php

   
    require_once("includes/db.php");
    require_once("includes/functions.php");


    if(isset($_GET["eid"]) && isset($_GET["token"]) && isset($_GET["exd"])){

        $validation_key = $_GET["token"];
        $email = urldecode(base64_decode($_GET["eid"]));
        $expire_date = urldecode(base64_decode($_GET["exd"]));
      
        date_default_timezone_set("Asia/Karachi");       
        $current_date = date("Y-m-d H:i:s");

        if($current_date >= $expire_date){
            echo " Link Expired";
        }

        else{
            
        $query1 = "SELECT * FROM users WHERE user_email = '$email' AND validation_key = '$validation_key' AND is_active = 1";
            $query_con1 = mysqli_query($connection, $query1);
            if(!$query_con1){
                die("Query Failed " . mysqli_error($connection));
            }

            $count = mysqli_num_rows($query_con1);
            if($count == 1){
                echo "Email already verified";
            }

            else{
                
                //query 
                $query = "UPDATE users SET is_active = 1 WHERE user_email = '$email' AND validation_key = '$validation_key'";
                $query_con = mysqli_query($connection, $query);
                if(!$query_con){
                    die("Query Failed " . mysqli_error($connection));

                }
            if($query_con){
                echo "Email has been successfully Verified";
            }

            }
        }

    }
?>