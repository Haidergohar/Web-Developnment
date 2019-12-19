<nav class="col-md-2 d-none d-md-block bg-light sidebar" style="color:red;">
    <div class="sidebar-sticky" style="color:red;>
        <ul class="nav flex-column" style="color:red;>
        <li class="nav-item">
            <a class="nav-link active" href="index.php">
            <span data-feather="home"></span>
            Dashboard <span class="sr-only">(current)</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="posts.php">
            <span data-feather="file"></span>
            All Posts
            </a>
        </li>
        <?php 
            if(isset($_SESSION['author_role'])){
                if($_SESSION['author_role']=="admin"){
        ?>
          <li class="nav-item">
            <a class="nav-link" href="category.php">
            <span data-feather="file"></span>
            All Categories
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="page.php">
            <span data-feather="file"></span>
            All Pages
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="setting.php">
            <span data-feather="file"></span>
            Settings
            </a>
        </li>
        <?php
                }
            }
        ?>
        </ul>

    
    </div>
</nav>