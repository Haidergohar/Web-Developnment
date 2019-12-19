<style>
/* styling link resend button */

.resend{
    color: blue;
    background-color: transparent;
    border: none;
    display: inline;
    cursor: pointer;
}

</style>
    <div class="container">
        <div class="content">
            <h2 class="heading">Login</h2>
            <?php
                ob_start();
                session_start();
                $current_page = "Login";
                require_once("includes/header.php"); 

                
                // google recaptcha
                $public_key = "6LdN-LEUAAAAAB_CeudjhckxVO0tbDDz5FwFCtbK";
                $private_key= "6LdN-LEUAAAAAAtejVtA4XF305GbucW_XnU-yls8";
                $url = "https://www.google.com/recaptcha/api/siteverify";

                if(isset($_POST["resend"])){
                   
                    if(!isset($_COOKIE['_utt_'])){
                        
                        $user_name = escape($_POST["user_name"]);
                        $user_email = escape($_POST["user_email"]);
    
                        date_default_timezone_set("Asia/Karachi");
                          // recipient
                        $mail->addAddress($_POST["user_email"]);
                        $email = $_POST["user_email"];
                        $email = base64_encode(urlencode($_POST["user_email"]));
                        $token = getToken(16);
                        $expire_date = date("Y-m-d H:i:s", time() + (60 * 20));
                        $expire_date = base64_encode(urlencode($expire_date));
                        
                        $query = "UPDATE users SET validation_key = '$token' WHERE user_name = '$user_name' AND user_email = '$user_email' AND is_active = 0";
                        $query_con = mysqli_query($connection, $query);
                        
                        if(!$query_con){
                            die("Query Failed " . mysqli_error($connection));
                        } else{
                            $mail->isHTML();                              
                            $mail->Subject = "Verify your Email";
                            $mail->Body = "<h2>Thank you for sign up</h2>
                                            <a href='localhost/registration/activation.php?eid={$email}&token={$token}&exd={$expire_date}'>Click here to verify</a>
                                            <p>This link is valid for 20 minutes.";
                            if($mail->send()){
                                setcookie('_utt_', getToken(16), time() + (60 * 20), '', '', '', true);
                                echo "<div class='notification'>Check your email for activation link</div>";
                            }
                            else{
                                echo "<div class='notification'>Something went wrong</div>";
                            }
                        }
                    }else{
                        echo "<div class='notification'>You must wait atleast 20 minutes for another request.</div>";                        
                    }

                }

                $isAuthenticated = false; 
                if(isset($_POST["login"])){

                    // google recaptcha
                    $response_key = $_POST["g-recaptcha-response"];

                    // https://www.google.com/recaptcha/api/siteverify?secret=private_key&reponse=response_key&remoteip=CurrentScriptIpAddress
                    $response = file_get_contents($url . "?secret=" . $private_key . "&response=" . $response_key . "&remoteip=" . $_SERVER["REMOTE_ADDR"]);
                    $response = json_decode($response);
                    //print_r($response);


                    if(!($response->success == 1)){
                        $errCaptcha = "Wrong Captcha";
                    }

                    $user_name = escape($_POST["user_name"]);
                    $user_email = escape($_POST["user_email"]);
                    $user_password = escape($_POST["user_password"]);

                    $query = "SELECT * FROM users WHERE user_name = '$user_name' AND user_email = '$user_email'";
                    $query_con = mysqli_query($connection, $query);

                    if(!$query_con){
                        die("Query Failed " . mysqli_error());
                    }


                    $result = mysqli_fetch_assoc($query_con);

                    if(password_verify($user_password, $result['user_password'])){

                        if($result['is_active'] == 1){
                            if(!isset($errCaptcha)){
                                $isAuthenticated = true;
                                echo "<div class='notification'>Logged In Successfull</div>";            
                               // $_SESSION["login"] = "success";
                               // header("Refresh:2;url=index.php");
                            }
                            else{   
                                echo "<div class='notification'>Login Failed</div>";
                            }
                        }
                        else{
                            if(!isset($errCaptcha)){
                            echo "<div class='notification'>You are not verified user <form method='POST'> <input type='text' name='user_name' value={$user_name} hidden/> <input type='email' name='user_email' value={$user_email} hidden/> <input type='submit' name='resend' value='Click here to verify your email.' class='resend'/></form></div>";
                            }
                            else{   
                                echo "<div class='notification'>Login Failed</div>";
                            }
                        }
                      
                    }

                    else{

                        echo "<div class='notification'>Invalid username or email or password</div>";

                    }

                }

                if($isAuthenticated){
                  
                    if(!empty($_POST["remember-me"])){
                        $selector = getToken(32);
                        $encoded_token = base64_encode($selector);
                     
                        date_default_timezone_set("Asia/Karachi");
                        setcookie('_ucv_', $encoded_token, time() + 60 * 60 * 24 * 2, '', '', '', true);
                        $expire = date("Y-m-d H:i:s", time() + 60 * 60 * 24 * 2);
                        
                        $query1 = "INSERT INTO remember_me (user_name, selector, expire_date, is_expired ) VALUES('$user_name', '$selector', '$expire', 0)";
                        $query_con1 = mysqli_query($connection, $query1);
                        if(!$query_con1){
                            die("Query Failed " . mysqli_error($connection));
                        } 
                        
                    }
                    $_SESSION["login"] = "success";
                    header("Refresh:1;url=index.php");
                }

                if(isAlreadyLoggedIn()){
                    echo "logged in";
                }
                else{
                    echo "not logged in";
                }
            ?>


            <!-- <div class='notification'>Logged In Successfull</div> -->
           
            
            <form action="login.php" method="POST">
                <div class="input-box">
                    <input type="text" class="input-control" placeholder="Username" name="user_name" required>
                </div>
                <div class="input-box">
                    <input type="email" class="input-control" placeholder="Email address" name="user_email" required>
                </div>
                <div class="input-box">
                    <input type="password" class="input-control" placeholder="Enter password" name="user_password" required>
                </div>
                <div class="input-box rm-box">
                    <div>
                        <input type="checkbox" id="remember-me" class="remember-me" name="remember-me">
                        <label for="remember-me">Remember me</label>
                    </div>
                    <a href="forgot_password.php" class="forgot-password">Forgot password?</a>
                </div>
                <div class="g-recaptcha" data-sitekey="<?php echo $public_key; ?>" data-size="normal" data-theme="light" data-tabindex="1"></div>
                <?php echo isset($errCaptcha)?"<span class='error'>{$errCaptcha}</span>":""; ?>       
                <div class="input-box">
                    <input type="submit" class="input-submit" value="LOGIN" name="login">
                </div>
                <div class="login-cta"><span>Don't have an account?</span> <a href="sign_up.php">Sign up here</a></div>
            </form>

        </div>
    </div>

<?php require_once("includes/footer.php") ?>