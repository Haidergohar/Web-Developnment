<?php

    session_start();
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
        <form class="form-login" method="post">
            <img class="mb-4" src="/docs/4.3/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal">Please Login</h1>
            <input type="email" id="inputEmail" name="author_email" class="form-control" placeholder="Email address" required autofocus>
            <input type="password" id="inputPassword" name="author_password" class="form-control" placeholder="Password" required>
           
            <button class="btn btn-lg btn-primary btn-block" name="login" type="submit">Sign in</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2017-2019</p>
        </form>
    </div>
    
    <?php

        if(isset($_POST['login'])){

            $author_email = mysqli_real_escape_string($con, $_POST['author_email']);
            $author_password = mysqli_real_escape_string($con, $_POST['author_password']);

            // checking for empty fields
            if(empty($author_email) || empty($author_password)){
                header("Location: login.php?message=Empty+Fields");
                exit();
            }

            //checking for email validity
            if(!filter_var($author_email, FILTER_VALIDATE_EMAIL)){
                header("Location: login.php?message=Enter+a+Valid+Email");
                exit();
            } else{
                // if email exists
                $sql = "SELECT * FROM author WHERE author_email = '$author_email'";
                $result = mysqli_query($con, $sql);
                if(mysqli_num_rows($result) <= 0){
                    header("Location: login.php?message=Login+Error");
                    exit();
                } else{
                    while($row = mysqli_fetch_assoc($result)){
                        // checking if password matching
                        if(!password_verify($author_password, $row['author_password'])){
                            header("Location: login.php?message=Login+Error");
                            exit();
                        }else if(password_verify($author_password, $row['author_password'])){
                            $_SESSION['author_id'] = $row['author_id'];
                            $_SESSION['author_name'] = $row['author_name'];
                            $_SESSION['author_email'] = $row['author_email'];
                            $_SESSION['author_role'] = $row['author_role'];
                            $_SESSION['author_bio'] = $row['author_bio'];
                            header("Location: index.php");
                        }
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