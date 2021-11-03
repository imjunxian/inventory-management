<?php
/*if(!isset($_SESSION)) 
{ 
    session_start(); 
}*/
session_start();
 
include('../../database/dbconfig.php');

if($connection)
{
    // echo "Database Connected";
}
else
{
    header("Location: ../dbconfig.php");
}
if(!isset($_SESSION['user_name'])){
    header("Location: ../auth/");
}

?>