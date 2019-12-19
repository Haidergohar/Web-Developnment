<?php

    define("db_host", "localhost");
    define("db_user","root");
    define("dp_pass","");
    define("db_name","registration");

    $connection = mysqli_connect(db_host, db_user, "", db_name);

    if(!$connection){
        echo "Connection Failed ". mysqli_error();
    }


?>