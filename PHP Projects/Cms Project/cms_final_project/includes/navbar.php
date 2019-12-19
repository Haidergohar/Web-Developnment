<?php include_once("connection.php"); ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">CMS Project</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>

            <?php
                $sqlpage = "SELECT * FROM page";
                $resultpage = mysqli_query($con, $sqlpage);
                if(!$resultpage){
                    die("Connection Failed " . mysqli_error($con));
                }
                while($rowpage = mysqli_fetch_assoc($resultpage)){
                    $page_id = $rowpage['page_id'];
                    $page_title = $rowpage['page_title'];
                
            ?>
            
            <li class="nav-item">
                <a class="nav-link" href="page.php?id=<?php echo $page_id; ?>"><?php echo $page_title; ?></a>
            </li>

            <?php
                }
            ?>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                All Categories
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                <?php
                    $sql = "SELECT * FROM category";
                    $result = mysqli_query($con, $sql);
                    if(!$result){
                        die("Connection Failed " . mysqli_error($con));
                    }
                    while($row = mysqli_fetch_assoc($result)){
                        $cat_id = $row['category_id'];
                        $cat_name = $row['category_name'];
                ?>

                <a class="dropdown-item" href="category.php?id=<?php echo $cat_id ?>"><?php echo $cat_name ?></a>
                <?php 
                    } 
                ?>
                </div>
            </li>
           
            </ul>
            <form action="search.php" class="form-inline my-2 my-lg-0">
            <input name='s' class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>