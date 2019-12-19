<?php
    session_start();
    include_once("../includes/functions.php");
    include_once("../includes/connection.php");
    ob_start();
    if(isset($_SESSION['author_role'])){
        if($_SESSION['author_role']=="admin") {
            if(isset($_GET['id'])){

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
                    <h1 class="h2">Edit Post</h1>
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
                        $formSql = "Select * FROM post WHERE post_id = '$post_id'";
                        $formResult = mysqli_query($con, $formSql);
                        if(!$formResult){
                            die("Something went wrong " . mysqli_error($con));
                        }

                        if(mysqli_num_rows($formResult)<=0){
                            header("Location: posts.php?message=No+File+Exists");
                            exit();
                        }
            
                        while($formRow = mysqli_fetch_assoc($formResult)){
                            $postTitle = $formRow['post_title'];
                            $postContent = $formRow['post_content'];
                            $postImage = $formRow['post_image'];
                            $postKeywords = $formRow['post_keywords'];
                        
                    
                    ?>



                    <form method="post" enctype="multipart/form-data">
                        Post Title:
                        <input type="text" name="post_title" class="form-control" value="<?php echo $postTitle; ?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Post Title"><br>
                        Post Content:
                        <textarea name="post_content" class="form-control" id="exampleFormControlTextarea1" rows="6"><?php echo $postContent; ?></textarea><br>
                        <img src="../<?php echo $postImage; ?>" width="150px" height="150px" alt="post_image"><br>
                        Post Image:
                        <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1"><br>
                        Post Keywords:
                        <input type="text" name="post_keywords" class="form-control" value="<?php echo $postKeywords; ?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Post Keywords"><br>
                        <button type="submit" name="submit" class="btn btn-primary">Update</button>
                    </form>
                    <?php } ?>
                    <?php

                            if(isset($_POST['submit'])){
                                $post_title = mysqli_real_escape_string($con, $_POST['post_title']);
                                $post_content = mysqli_real_escape_string($con, $_POST['post_content']);
                                $post_keywords = mysqli_real_escape_string($con, $_POST['post_keywords']);

                                if(empty($post_title) || empty($post_content)){
                                    header("Location: new_post.php?message=Empty+Fields");
                                    exit();
                                }

                                if(is_uploaded_file($_FILES['file']['tmp_name'])){
                                    // user also want to update file
                                    $file = $_FILES['file'];
                                    $fileName = $file['name'];
                                    $fileType = $file['type'];
                                    $fileTmp = $file['tmp_name'];
                                    $fileErr = $file['error'];
                                    $fileSize = $file['size'];
    
                                    $fileExt = explode(".",$fileName);
                                    $fileExtension = strtolower(end($fileExt));
    
                                    $allowedExt = array("jpg", "jpeg", "png");
    
                                    if(in_array($fileExtension, $allowedExt)){
                                            if($fileErr === 0){
                                                if($fileSize < 1000000){
                                                    $newFileName = uniqid('',true).".".$fileExtension;
                                                    $destination = "../uploads/".$newFileName;
                                                    $dbDestination = "uploads/".$newFileName;
                                                    move_uploaded_file($fileTmp, $destination);
                                                    
                                                    $sql = "UPDATE post SET post_title = '$post_title', post_content = '$post_content', post_image = '$dbDestination', post_keywords = '$post_keywords' WHERE post_id = '$post_id'";
                                                    if(mysqli_query($con, $sql)){
                                                        echo '<script>window.location="posts.php?message=Post+Updated"</script>';
                                                        exit();
                                                    } else{
                                                        echo '<script>window.location="posts.php?message=Error"</script>';
                                                        exit();
                                                    }
                                                } else{
                                                    echo '<script>window.location="posts.php?message=Maximum 3 mb file size are allowed"</script>';
                                                    exit();
                                                }
                                            } else{
                                                echo '<script>window.location="posts.php?message=Oops, There is an error in uploading file"</script>';
                                                exit();
                                            }
                                    } else{
                                        echo '<script>window.location="posts.php?message=Only jpg, jpeg and png Formats are allowed"</script>';
                                        exit();
                                    }
                                } else{
                                    // user dont want to update file
                                    $sql = "UPDATE post SET post_title = '$post_title', post_content = '$post_content', post_keywords = '$post_keywords' WHERE post_id = '$post_id'";
                                    if(mysqli_query($con, $sql)){
                                        echo '<script>window.location="posts.php?message=Post+Updated"</script>';
                                        exit();
                                    } else{
                                        echo '<script>window.location="posts.php?message=Error"</script>';
                                        exit();
                                    }
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

  
<?php } else{
        header("Location: index.php");
        }
     } else{
        header("Location: index.php");
    }
    } else{
        header("Location: login.php?message=Please+Login");
    }
?>

