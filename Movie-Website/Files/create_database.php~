<?php
    $servername = "localhost";
    $username = "root";
    $password = "terminator";
    $conn = new mysqli($servername,$username,$password);
    if($conn->connect_error)
    {
        die("Connection failed".$conn->connect_error);
    }
    
    $create_db_sql = "CREATE DATABASE FilmNoirDB";
    if($conn->query($create_db_sql) === TRUE)
    {
        echo "Database created successfully";
    }
    else
    {
        echo "Error has occured".$conn->error;
    }
?>
