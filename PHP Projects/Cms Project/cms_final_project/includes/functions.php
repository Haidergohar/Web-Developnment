<?php
include_once("connection.php");
    function add_jumbotron(){
        echo '<div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="display-4">Fluid jumbotron</h1>
                    <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
                 </div>
              </div>';
    }

    function getAuthorName($id){
        global $con;
        $sql = "SELECT * FROM author WHERE author_id = '$id'";
        $result = mysqli_query($con, $sql);
        while($row = mysqli_fetch_assoc($result)){
            $authorName = $row['author_name'];
            echo $authorName;
        }
    }

    function getCategoryName($id){
        global $con;
        $sql = "SELECT * FROM category WHERE category_id = '$id'";
        $result = mysqli_query($con, $sql);
        while($row = mysqli_fetch_assoc($result)){
            $categoryName = $row['category_name'];
            echo $categoryName;
        }
    }

    function getSettingValue($setting){
        global $con;
        $sql = "SELECT * FROM setting WHERE setting_name = '$setting'";
        $result = mysqli_query($con, $sql);
        while($row = mysqli_fetch_assoc($result)){
            $value = $row['setting_value'];
            echo $value;
        }
    }

    function setSettingValue($setting,$value){
        global $con;
        $sql = "UPDATE setting SET setting_value = '$value' WHERE setting_name = '$setting'";
        $result = mysqli_query($con, $sql);
        if(!$result){
            return false;
        } else{
            return true;
        }
    }
?>      