<?php

    include_once("../includes/functions.php");
    include_once("../includes/connection.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CMS Project</title>
    <link rel="stylesheet" href="../style/bootstrap.min.css">
    <link rel="stylesheet" href="../style/style.css">
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->

</head>
<body>

    <?php
        if(isset($_GET['message'])){
            $msg = $_GET['message'];
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>'. $msg .'</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
        }
    ?>

    <div style="width:500px; margin:auto auto; margin-top:150px;">
        <form class="form-signup" method="post">
            <img class="mb-4" src="/docs/4.3/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal">Please sign up</h1>
            <input type="text" id="input" name="author_name" class="form-control" placeholder="Enter Name" required autofocus>           
            <input type="email" id="inputEmail" name="author_email" class="form-control" placeholder="Email address" required autofocus>
            <input type="password" id="inputPassword" name="author_password" class="form-control" placeholder="Password" required>
           
            <button class="btn btn-lg btn-primary btn-block" name="signup" type="submit">Sign up</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2017-2019</p>
        </form>
    </div>
    
    <?php

        if(isset($_POST['signup'])){

            $author_name = mysqli_real_escape_string($con, $_POST['author_name']);
            $author_email = mysqli_real_escape_string($con, $_POST['author_email']);
            $author_password = mysqli_real_escape_string($con, $_POST['author_password']);

            // checking for empty fields
            if(empty($author_name) || empty($author_email) || empty($author_password)){
                header("Location: signup.php?message=Empty+Fields");
                exit();
            }

            //checking for email validity
            if(!filter_var($author_email, FILTER_VALIDATE_EMAIL)){
                header("Location: signup.php?message=Enter+a+Valid+Email");
                exit();
            } else{
                // if email exists
                $sql = "SELECT * FROM author WHERE author_email = '$author_email'";
                $result = mysqli_query($con, $sql);
                if(mysqli_num_rows($result) > 0){
                    header("Location: signup.php?message=Email+Already+Exists");
                    exit();
                } else{
                    // hashing password
                    $hash = password_hash($author_password, PASSWORD_DEFAULT);


                    // Signing up the user
                    $sql = "INSERT INTO author (author_name, author_email, author_password, author_bio, author_role) VALUES('$author_name', '$author_email', '$hash', 'Enter Bio', 'author')";
                    $result = mysqli_query($con, $sql);
                    if($result){
                        header("Location: signup.php?message=Succesfully+Registered");
                        exit();
                    } else{
                        header("Location: signup.php?message=Registration+Failed");
                        exit();
                    }                    
                }
            }
          
        }
    ?>

    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/jquery.js"></script>
    <script src="../js/scroll.js"></script>
</body>
</html>