<?php

    require_once("includes/db.php");
    require_once("includes/functions.php");

    ob_start();
    session_start();

    if(isset($_COOKIE["_ucv_"])){
        
        global $connection;
        $selector = escape(base64_decode($_COOKIE['_ucv_']));
        
        $query = "UPDATE remember_me SET is_expired ='-1' WHERE selector = '$selector' AND is_expired = 0";
        $query_con = mysqli_query($connection, $query);

        if(!$query_con){
            die("Query Failed " . mysqli_error($connection));
        }

        setcookie('_ucv_', '', time() - 60 * 60);

    }

    if(isset($_SESSION["login"])){
        session_destroy();
        unset($_SESSION["login"]);
        unset($_SESSION["name"]);
        header("Location: login.php");
    }

    header("Location: login.php");

?>