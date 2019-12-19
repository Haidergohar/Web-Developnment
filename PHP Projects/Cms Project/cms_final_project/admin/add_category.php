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
            header("Location: category.php?message=Please+Add+a+Category");
            exit();
        } else if(isset($_POST['submit'])){
            $category_name = $_POST['category_name'];
            $sql = "INSERT INTO category(category_name) VALUES('$category_name')";
            $result = mysqli_query($con, $sql);
            if(!$result){
                header("Location: category.php?message=Connection+Error");
                exit();
            } else{
                header("Location: category.php?message=Category+Successfully+Added");
                exit();
            }
        }
    }
}

?>