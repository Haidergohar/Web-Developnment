<?php
include_once("includes/connection.php");
include_once("includes/functions.php");

if(!isset($_GET['id'])){
    header("Location: index.php");
    exit();
} else{
    $page_id = mysqli_real_escape_string($con, $_GET['id']);
    if(!is_numeric($page_id)){
        header("Location: index.php");
        exit();
    } else if(is_numeric($page_id)){
        $sql = "SELECT * FROM page WHERE page_id ='$page_id'";
        $result = mysqli_query($con, $sql);
        
        // check if page exists
        if(mysqli_num_rows($result)<=0){
            // no page
            header("Location: index.php?message=no+page+found");
            exit();
        } else if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_assoc($result)){

                $page_title = $row['page_title'];
                $page_content = $row['page_content'];
               
                ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title><?php echo $page_title; ?></title>
<link rel="stylesheet" href="style/bootstrap.min.css">
<link rel="stylesheet" href="style/style.css">
<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->

</head>
<body>

<!-- NAVBAR START HERE -->
<?php include_once("includes/navbar.php"); ?>
<!-- NAVBAR END HERE -->



<div class="container">
    
    <h1 style="width:100%; background-color:grey; color:white; padding-top:25px; padding-bottom:25px; text-align:center;"><?php echo $page_title; ?></h1>
    <hr>  
  
    <p><?php echo $page_content; ?></p>
</div>


 
    <script src="js/popper.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scroll.js"></script>
</body>
</html>
                <?php
            }
        }
    }
}

?>