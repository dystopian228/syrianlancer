<?php 

    $serverName="localhost"; 
    $userName="root"; 
    $password=""; 
    $dbName="Syrian_Lancer";

    $conn=mysqli_connect($serverName,$userName,$password,$dbName);
    mysqli_set_charset($conn, "utf8");
    