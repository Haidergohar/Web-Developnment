<?php

    $con = mysqli_connect("localhost", "root", "", "cms_project");

    if(!$con){
        die("COnnection Failed " . mysqli_error($con));
    }

?>