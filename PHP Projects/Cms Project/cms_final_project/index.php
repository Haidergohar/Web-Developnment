<?php

    include_once("includes/functions.php");
    include_once("includes/connection.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CMS Project</title>
    <link rel="stylesheet" href="style/bootstrap.min.css">
    <link rel="stylesheet" href="style/style.css">
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->

<style>

    .col-md-4{
        margin-bottom: 30px;
    }

</style>

</head>
<body>
    
    <!-- NAVBAR START HERE -->
    <?php include_once("includes/navbar.php"); ?>
    <!-- NAVBAR END HERE -->

    <div class="jumbotron jumbotron-fluid">
        <div class="container">
          <h1 class="display-4"><?php getSettingValue("home_jumbo_title"); ?></h1>
          <p class="lead"><?php getSettingValue("home_jumbo_desc"); ?></p>
        </div>
    </div>

    <div class="container">
    <?php
        // pagination
        $sqlpg = "SELECT * FROM post";
        $resultpg = mysqli_query($con, $sqlpg);
        if(!$resultpg){
            die("Error in establishing connection" . mysqli_error($con));
        }
        $totalPosts = mysqli_num_rows($resultpg);
        $postPerPage = 9;
        $totalPages = ceil($totalPosts/$postPerPage);
    
    ?>
    <?php
        // pagination get
        if(isset($_GET['p'])){
            $page_num = $_GET['p'];
            $start = ($page_num*$postPerPage)-$postPerPage;
            $sql = "SELECT * FROM post ORDER BY post_id DESC LIMIT $start,$postPerPage";
        } else{
            $sql = "SELECT * FROM post ORDER BY post_id DESC LIMIT 0,$postPerPage";
        }

    ?>
        
            <?php 
                $result = mysqli_query($con, $sql);
                if(!$result){
                    die("Error in establishing connection" . mysqli_error($con));
                }
                $num = 0;
                while($row = mysqli_fetch_assoc($result)){
                    $post_title = $row['post_title'];
                    $post_image = $row['post_image'];
                    $post_author = $row['post_author'];
                    $post_content = $row['post_content'];
                    $post_id = $row['post_id'];

                    $sqlauth = "SELECT * FROM author WHERE author_id='$post_author'";
                    $resultauth = mysqli_query($con, $sqlauth);
                    if(!$resultauth){
                        die("Error in establishing connection" . mysqli_error($con));
                    }
                    while($rowauth = mysqli_fetch_assoc($resultauth)){
                        $post_author_name = $rowauth['author_name'];
                        if($num==0){
            ?>
            <div class="row">
            <div class="col-md-4">
            <div class="card" style="width: 100%;">
                <img src="<?php echo $post_image; ?>" class="card-img-top" width="250px" height="250px" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $post_title; ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?php echo $post_author_name; ?></h6>
                    <p class="card-text"><?php echo substr(strip_tags($post_content), 0, 90)."..."; ?></p>
                    <a href="post.php?id=<?php echo $post_id; ?>" class="btn btn-primary">Read More</a>
                </div>
            </div>
            </div>

            <?php
            $num = $num+1;
            } else if($num%3==0){
                ?>
            </div>
            <div class="row">
            <div class="col-md-4">
            <div class="card" style="width: 100%;">
                <img src="<?php echo $post_image; ?>" class="card-img-top" width="250px" height="250px" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $post_title; ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?php echo $post_author_name; ?></h6>
                    <p class="card-text"><?php echo substr(strip_tags($post_content), 0, 90)."..."; ?></p>
                    <a href="post.php?id=<?php echo $post_id; ?>" class="btn btn-primary">Read More </a>
                </div>
            </div>
            </div>



                <?php
            $num = $num+1;
            } else{
                ?>

            <div class="col-md-4">
            <div class="card" style="width: 100%;">
                <img src="<?php echo $post_image; ?>" class="card-img-top" width="250px" height="250px" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $post_title; ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?php echo $post_author_name; ?></h6>
                    <p class="card-text"><?php echo substr(strip_tags($post_content), 0, 90)."..."; ?></p>
                    <a href="post.php?id=<?php echo $post_id; ?>" class="btn btn-primary">Read More</a>
                </div>
            </div>
            </div>


                <?php
            $num = $num+1;

            } } } ?>
        </div>

        <?php
            echo "<center>";
            for($i=1; $i<=$totalPages; $i++){
                ?>
                <a href="?p=<?php echo $i; ?>"><button class="btn btn-info"><?php echo $i; ?></button></a>&nbsp;
                <?php
            }                
            echo "</center>";

        ?>

    </div>

   
    <script src="js/popper.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scroll.js"></script>
</body>
</html>