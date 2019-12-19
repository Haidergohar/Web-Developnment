<?php
$con = mysqli_connect("localhost", "root", "", "cms_project");

$sqltotal = "SELECT * FROM pagination_practice";
$resulttotal = mysqli_query($con, $sqltotal);
$total = mysqli_num_rows($resulttotal);
$totalPages = ceil($total/6);

//echo "$total <br> $totalPages<br>";

if(isset($_GET['page'])){
    $page = $_GET['page'];
    $start = ($totalPages*$page)-$totalPages;
    $sql = "SELECT * FROM pagination_practice LIMIT $start,$totalPages";
} else{
    $sql = "SELECT * FROM pagination_practice LIMIT 0,6";
}


$result = mysqli_query($con, $sql);
while($row = mysqli_fetch_assoc($result)){
    echo $row['id'] . ' ' . $row['valuee'] . '<br>';
}

echo '<br><br>';

for($i=1; $i<=$totalPages; $i++){
    echo " <a href='?page=$i'> <button>$i</button> </a> ";
}
?>