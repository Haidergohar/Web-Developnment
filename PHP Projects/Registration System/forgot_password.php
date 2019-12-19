<?php 
    $current_page = "Forgot Password";
    include_once("includes/header.php"); 
    
?>

    <div class="container">
        <div class="content">
            <h2 class="heading">Password Recovery</h2>

            <?php

                if(isset($_POST["password-recovery"])){
                    $user_name = escape($_POST["user-name"]);
                    $user_email = escape($_POST["user-email"]);

                    $query = "SELECT * FROM users WHERE user_name = '$user_name' AND user_email = '$user_email' AND is_active = 1";
                    $query_con = mysqli_query($connection, $query);

                    if(!$query_con){
                        die("Query Failed " . mysqli_error($connection));
                    }

                    if(mysqli_num_rows($query_con) == 1){
                       
                        if(!isset($_COOKIE['_unp_'])){
                        
                            $user_name = escape($_POST["user-name"]);
                            $user_email = escape($_POST["user-email"]);
        
                            date_default_timezone_set("Asia/Karachi");
                              // recipient
                            $mail->addAddress($_POST["user-email"]);
                            $email = $_POST["user-email"];
                            $email = base64_encode(urlencode($_POST["user-email"]));
                            $token = getToken(16);
                            $encoded_token = base64_encode(urlencode($token));
                            $expire_date = date("Y-m-d H:i:s", time() + (60 * 20));
                            $expire_date = base64_encode(urlencode($expire_date));
                            
                            $query = "UPDATE users SET validation_key = '$token' WHERE user_name = '$user_name' AND user_email = '$user_email' AND is_active = 1";
                            $query_con = mysqli_query($connection, $query);
                            
                            if(!$query_con){
                                die("Query Failed " . mysqli_error($connection));
                            } else{
                                  
                                $mail->Subject = "Password Reset Request";
                                $mail->Body = "<h2>Follow the link to reset password</h2>
                                                <a href='localhost/registration/new_password.php?eid={$email}&token={$encoded_token}&exd={$expire_date}'>Click here to reset password</a>
                                                <p>This link is valid for 20 minutes.";
                                if($mail->send()){
                                    setcookie('_unp_', getToken(16), time() + (60 * 20), '', '', '', true);
                                    echo "<div class='notification'>Check your email for password reset link</div>";
                                }
                                else{
                                    echo "<div class='notification'>Something went wrong</div>";
                                }
                            }
                        }else{
                            echo "<div class='notification'>You must wait atleast 20 minutes for another request.</div>";                        
                        }
    
                    }
                    else{
                        echo "<div class='notification'>Sorry, User not found</div>";
                    }
                }

            ?>
           
            <!-- <div class='notification'>You need to wait at lest 20 minutes for another request</div> -->
            <form action="" method="POST">
                <div class="input-box">
                    <input type="text" class="input-control" placeholder="Username" name="user-name" required>
                </div>
                <div class="input-box">
                    <input type="email" class="input-control" placeholder="Email address" name="user-email" required>
                </div>
                <div class="input-box">
                    <input type="submit" class="input-submit" value="RECOVER PASSWORD" name="password-recovery" required>
                </div>
            </form>
        </div>
    </div>

    <?php include_once("includes/footer.php"); ?>