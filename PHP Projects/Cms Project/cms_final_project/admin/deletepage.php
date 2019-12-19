<?php
include_once("../includes/connection.php");
include_once("../includes/functions.php");
session_start();
ob_start();

if(!isset($_SESSION['author_role'])){
    header("Location: login.php?message=Please+Login");
    exit();
} else{
    if($_SESSION['author_role']!="admin"){
        header("Location: index.php?message=Access+Denied");
        exit();
    } else{
        if(!isset($_GET['id'])){
            header("Location: page.php?message=Please+Click+the+Delete+Button");
            exit();
        } else{
            $page_id = $_GET['id'];
            $sql = "SELECT * FROM page WHERE page_id = '$page_id'";
            $result = mysqli_query($con, $sql);
            if(!$result){
                $err = mysqli_error($con);
                header("Location: page.php?message=Connection+Failed " . $err);
                exit();
            } else{
                if(mysqli_num_rows($result)<=0){
                    // we dont have any page for this id
                    header("Location: page.php?message=Page+Not+Found");
                    exit();
                } else{
                    $page_id = $_GET['id'];
                    $sql = "DELETE FROM page WHERE page_id = '$page_id'";
                    $result = mysqli_query($con, $sql);
                    if(!$result){
                        header("Location: page.php?message=Could+Not+Delete+Your+Page");
                        exit();
                    } else{
                        header("Location: page.php?message=Page+Successfully+Deleted");
                        exit();
                    }
                    
                   
                }
            }
        }
    }
}


?>