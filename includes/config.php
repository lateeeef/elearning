<?php
    $dbname = 'dbcaiwl';
    $server = 'localhost';
    $username = 'root';
    $password = '';

    $connect = mysqli_connect($server, $username, $password, $dbname);
    if(!$connect){
        echo "Error connecting to the database";
    }
?>