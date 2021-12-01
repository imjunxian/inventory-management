<?php
/*if(!isset($_SESSION)) 
{ 
    session_start(); 
}*/
session_start();
 
include('../../database/dbconfig.php');

$query = "SELECT * FROM users WHERE status='Active' and userRoles ='SuperUser' ORDER BY userId";
$query_run = mysqli_query($connection, $query);

$row = mysqli_num_rows($query_run);

if($connection)
{
    // echo "Database Connected";
}
else
{
    header("Location: ../dbconfig.php");
}
if(!isset($_SESSION['user_name'])){
    if($row == 0){
        header("Location: ../auth/register.php");
    }else{
        header("Location: ../auth/");
    }
}

?>