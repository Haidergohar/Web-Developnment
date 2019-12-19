<?php
session_start();
include_once("../includes/connection.php");

if(!isset($_GET['id'])){
    header("Location: index.php");
    exit();
} else{
    // check if session is active
    if(!isset($_SESSION['author_role'])){
        header("Location: login.php?message=Please+Login");
        exit();
    } else{
        if($_SESSION['author_role'] != "admin"){
            echo "You can not access this page";
        } else if($_SESSION['author_role']=="admin"){

            $post_id = $_GET['id'];

            $sqlCheck = "SELECT * FROM post WHERE post_id = '$post_id'";
            $result = mysqli_query($con, $sqlCheck);
            if(mysqli_num_rows($result)<=0){
                header("Location: posts.php?message=No+File+Exists");
                exit();
            }

            $sql = "DELETE FROM post WHERE post_id = '$post_id'";
            if(mysqli_query($con, $sql)){
                header("Location: posts.php?message=Post+Successfully+Deleted");
                exit();
            } else{
                header("Location: posts.php?message=Could+not+delete+your+post");
                exit();
            }
        }
    }
}

?>