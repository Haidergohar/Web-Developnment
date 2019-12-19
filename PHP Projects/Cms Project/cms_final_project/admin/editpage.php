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
            header("Location: page.php?message=Please+Click+the+Edit+Button");
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
            
            <nav class="navbar navbar-dark sticky-top bg-dark shadow">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">CMS Project</a>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
            <a class="nav-link" href="logout.php">Sign out</a>
            </li>
        </ul>
        </nav>

        <div class="container-fluid">
        <div class="row">
           
           <?php include_once("nav.inc.php"); ?> 

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Edit Page</h1>
                    <h6>Howdy <?php echo $_SESSION['author_name'] ?> | Your role is <?php echo $_SESSION['author_role'] ?></h6>

                </div>
                <div id="admin-index-form">
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


                    <?php 
                        $post_id = $_GET['id'];
                        $formSql = "Select * FROM page WHERE page_id = '$page_id'";
                        $formResult = mysqli_query($con, $formSql);
                        if(!$formResult){
                            die("Something went wrong " . mysqli_error($con));
                        }

                        if(mysqli_num_rows($formResult)<=0){
                            header("Location: page.php?message=No+Page+Exists");
                            exit();
                        }
            
                        while($formRow = mysqli_fetch_assoc($formResult)){
                            $pageTitle = $formRow['page_title'];
                            $pageContent = $formRow['page_content'];
                        
                    
                    ?>



                    <form method="post" enctype="multipart/form-data">
                        Page Title:
                        <input type="text" name="page_title" class="form-control" value="<?php echo $pageTitle; ?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Post Title"><br>
                        Page Content:
                        <textarea name="page_content" class="form-control" id="exampleFormControlTextarea1" rows="6"><?php echo $pageContent; ?></textarea><br>
                       
                        <button type="submit" name="submit" class="btn btn-primary">Update</button>
                    </form>
                    <?php } ?>
                    <?php

                            if(isset($_POST['submit'])){
                                $page_title = mysqli_real_escape_string($con, $_POST['page_title']);
                                $page_content = mysqli_real_escape_string($con, $_POST['page_content']);

                                if(empty($page_title) || empty($page_content)){
                                    header("Location: editpage.php?message=Empty+Fields");
                                    exit();
                                }

                                $sql = "UPDATE page SET page_title = '$page_title', page_content = '$page_content' WHERE page_id = '$page_id'";
                                if(mysqli_query($con, $sql)){
                                    echo '<script>window.location="page.php?message=Page+Updated"</script>';
                                    exit();
                                } else{
                                    echo '<script>window.location="page.php?message=Error"</script>';
                                    exit();
                                }
                                
                            }

                    ?>
               


                </div>
            </main>
        </div>
        </div>



            <script src="../js/bootstrap.min.js"></script>
            <script src="../js/bootstrap.bundle.min.js"></script>
            <script src="../js/jquery.js"></script>
            <script src="../js/scroll.js"></script>
            <script src="https://cdn.tiny.cloud/1/34t2dj8n83qxkje8rli2czjhx84gbzk5zlate0i3mrsdbat9/tinymce/5/tinymce.min.js?apikey=34t2dj8n83qxkje8rli2czjhx84gbzk5zlate0i3mrsdbat9"></script>
            <script>tinymce.init({ selector:'textarea' });</script>
        </body>
        </html>

                    <?php
                }
            }
        }
    }
}


?>