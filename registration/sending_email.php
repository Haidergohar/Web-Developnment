<?php

    require_once("vendor/autoload.php");
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    $mail = new PHPMailer();
    
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = "smtp.gmail.com";
    $mail->Port = "465";
    $mail->SMTPSecure = "ssl";
    
    $mail->Username = "";
    $mail->Password = "";

    $mail->setFrom("");
    $mail->addReplyTo("");

    // recipient
    $mail->addAddress("");
    $mail->isHTML();
    $mail->Subject = "Sending from localhost";
    $mail->Body = "<div style='color:white; background-color: blue;'>This mail is for testing purpose</div><div style='color:white; background-color: red; font-size: 30px;'>Working Perfect</div>";

    if($mail->send()){
        echo "Email Sent";
    }
    else{
        echo "Something went wrong";
    }  
?>