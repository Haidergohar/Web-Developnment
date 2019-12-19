<?php 
    $current_page = "Sign Up";
    include_once("includes/header.php"); 

?>


    <div class="container">
        <div class="content">
            <h2 class="heading">Sign Up</h2>

            <?php 
			
			 require_once("vendor/autoload.php");
							use PHPMailer\PHPMailer\PHPMailer;
							use PHPMailer\PHPMailer\Exception;

							$mail = new PHPMailer();

                // google recaptcha
                $public_key = "6LdN-LEUAAAAAB_CeudjhckxVO0tbDDz5FwFCtbK";
                $private_key= "6LdN-LEUAAAAAAtejVtA4XF305GbucW_XnU-yls8";
                $url = "https://www.google.com/recaptcha/api/siteverify";
                if(isset($_POST["sign-up"])){
                    
                    // google recaptcha
                    $response_key = $_POST["g-recaptcha-response"];

                    // https://www.google.com/recaptcha/api/siteverify?secret=private_key&reponse=response_key&remoteip=CurrentScriptIpAddress
                     $response = file_get_contents($url . "?secret=" . $private_key . "&response=" . $response_key . "&remoteip=" . $_SERVER["REMOTE_ADDR"]);
                     $response = json_decode($response);
                     //print_r($response);
                     if(!($response->success == 1)){
                         $errCaptcha = "Wrong Captcha";
                     }

                    $first_name = escape($_POST["first_name"]);
                    $last_name = escape($_POST["last_name"]);
                    $user_name = escape($_POST["user_name"]);
                    $user_email = escape($_POST["user_email"]);
                    $user_pass = escape($_POST["user_password"]); 
                    $user_con_pass = escape($_POST["user_confirm_password"]);

                    // first name validation
                    $pattern_fn = "/^[a-zA-Z ]{3,15}$/";
                    if(!preg_match($pattern_fn, $first_name)){
                        $errFn = "Must be atleast 3 characters long, letter and spaces allowed";
                    }

                    // last name validation
                    $pattern_ln = "/^[a-zA-Z ]{3,15}$/";
                    if(!preg_match($pattern_ln, $last_name)){
                        $errLn = "Must be atleast 3 characters long, letter and spaces allowed";
                    }

                    // username validation
                    // filter_var($user_email, FILTER_VALID_EMAIL);
                    $pattern_un = "/^[a-zA-Z0-9_]{3,16}$/";
                    if(!preg_match($pattern_un, $user_name)){
                        $errUn = "Must be atleast 3 characters long, letter, numbers and underscores allowed";
                    }
                    else{
                        $query1 = "SELECT * FROM users WHERE user_name = '$user_name'";
                        $query_con1 = mysqli_query($connection, $query1);
                        if(!$query_con1){
                            die("Query Failed " . mysqli_error($connection));
                        }
                        $count1 = mysqli_num_rows($query_con1);
                        if($count1 == 1){
                            $errUn = "Username not available pick new one";
                           // unset($user_name);
                        }
                    }

                    // useremail validation
                    $pattern_ue = "/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)[a-z]{2,6}$/i";
                    if(!preg_match($pattern_ue, $user_email)){
                        $errUe = "Invalid format of email";
                    }
                    else{
                        $query2 = "SELECT * FROM users WHERE user_email = '$user_email'";
                        $query_con2 = mysqli_query($connection, $query2);
                        if(!$query_con2){
                            die("Query Failed " . mysqli_error($connection));
                        }
                        $count2 = mysqli_num_rows($query_con2);
                        if($count2 == 1){
                            $errUe = "Email already registered";
                         //   unset($user_email);

                        }
                    }

                    
                    // password validation
                    if($user_pass == $user_con_pass){
                        $pattern_up = "/^.*(?=.{4,56})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$/";
                        if(!preg_match($pattern_up, $user_pass)){
                            $errUp = "Must be atleast 4 characters long, 1 upper case, 1 lower case letter and 1 number exist";
                        }
                    }
                    else{
                        $errUp = "Password Doesn't Match"; 
                    }

                    if(!isset($errFn) && !isset($errLn) && !isset($errUe) && !isset($errUn) && !isset($errUp) && !isset($errCaptcha)){
                       
                        $hash = password_hash($user_pass, PASSWORD_BCRYPT, ['cost' => 10]);

                        date_default_timezone_set("Asia/Karachi");
                        $date = date("Y-m-d H:i:s");

                          // recipient
                        $mail->addAddress($_POST["user_email"]);

                        $email = $_POST["user_email"];
                        $email = base64_encode(urlencode($_POST["user_email"]));
                        $token = getToken(16);
                        $expire_date = date("Y-m-d H:i:s", time() + (60 * 20));
                        $expire_date = base64_encode(urlencode($expire_date));
                        $mail->isHTML();
                        $mail->Subject = "Verify your Email";
                        $mail->Body = "<h2>Thank you for sign up</h2>
                                        <a href='localhost:84/registration/activation.php?eid={$email}&token={$token}&exd={$expire_date}'>Click here to verify</a>
                                        <p>This link is valid for 20 minutes.";

                        if($mail->send()){
                            

                            $query = "INSERT INTO users (first_name, last_name, user_name, user_email, user_password, validation_key, registration_date) VALUES('$first_name', '$last_name', '$user_name', '$user_email', '$hash', '$token', '$date')";

                            $query_con = mysqli_query($connection, $query);
                            if(!$query_con){
                                die("Query Failed ". mysqli_error($connection));
                            }
                            else{
                                echo "<div class='notification'>Sign up successful. Check your email for activation link.</div>";
                                unset($first_name);
                                unset($last_name);
                                unset($user_name);
                                unset($user_email);
                            }        

                        }
                        else{
                            echo "<div class='notification'>Something went wrong</div>";
                        }

                    }
                   
                }



            ?>



            <!-- <div class='notification'>Sign up successful. Check your email for activation link</div> -->
            <form action="sign_up.php" method="POST">
                <div class="input-box">
                    <input type="text" class="input-control" placeholder="First name" value="<?php echo isset($first_name)? $first_name:"" ?>" name="first_name" autocomplete="off">
                    <?php echo isset($errFn)?"<span class='error'>{$errFn}</span>":""; ?>
                </div>
                <div class="input-box">
                    <input type="text" class="input-control" placeholder="Last name" value="<?php echo isset($last_name)? $last_name:"" ?>" name="last_name" autocomplete="off">
                    <?php echo isset($errLn)?"<span class='error'>{$errLn}</span>":""; ?>              
                </div>
                <div class="input-box">
                    <input type="text" class="input-control" placeholder="Username" value="<?php echo isset($user_name)? $user_name:"" ?>" name="user_name" autocomplete="off">
                    <?php echo isset($errUn)?"<span class='error'>{$errUn}</span>":""; ?>                              
                </div>
                <div class="input-box">
                    <input type="email" class="input-control" placeholder="Email address" value="<?php echo isset($user_email)? $user_email:"" ?>" name="user_email" autocomplete="off" >
                    <?php echo isset($errUe)?"<span class='error'>{$errUe}</span>":""; ?>              
               </div>
                <div class="input-box">
                    <input type="password" class="input-control" placeholder="Enter password" name="user_password" autocomplete="off">
                    <?php echo isset($errUp)?"<span class='error'>{$errUp}</span>":""; ?>                            
                </div>
                <div class="input-box">
                    <input type="password" class="input-control" placeholder="Confirm password" name="user_confirm_password" autocomplete="off">
                    <?php echo isset($errUp)?"<span class='error'>{$errUp}</span>":""; ?>                                          
                </div>

                <!-- google recaptcha -->
                <div class="g-recaptcha" data-sitekey="<?php echo $public_key; ?>" data-size="normal" data-theme="light" data-tabindex="1"></div>
                <?php echo isset($errCaptcha)?"<span class='error'>{$errCaptcha}</span>":""; ?>                              
                
                <div class="input-box">
                    <input type="submit" class="input-submit" value="SIGN UP" name="sign-up">
                </div>
                <div class="sign-up-cta"><span>Already have an account?</span> <a href="login.php">Login here</a></div>
            </form>

        </div>
    </div>


<?php include_once("includes/footer.php"); ?>