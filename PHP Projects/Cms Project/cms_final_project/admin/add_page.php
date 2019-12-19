<?php
include_once("../includes/connection.php");
ob_start();
session_start();

if(!isset($_SESSION['author_role'])){
    header("Location: index.php");
    exit();
} else{
    if($_SESSION['author_role']!="admin"){
        echo "You can't access this page";
    } else{
        if(!isset($_POST['submit'])){
            header("Location: page.php?message=Please+Add+a+Page");
            exit();
        } else if(isset($_POST['submit'])){

            $page_title = $_POST['page_title'];
            $page_content = $_POST['page_content'];

            $sql = "INSERT INTO page(page_title, page_content) VALUES('$page_title', '$page_content')";
            $result = mysqli_query($con, $sql);
            if(!$result){
                header("Location: page.php?message=Connection+Error");
                exit();
            } else{
                header("Location: page.php?message=Page+Successfully+Added");
                exit();
            }
        }
    }
}

?>