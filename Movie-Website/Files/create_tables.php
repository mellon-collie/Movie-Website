<?php
    $servername = "localhost";
    $username = "root";
    $password = "terminator";
    $dbname = "FilmNoirDB";
    $conn = new mysqli($servername,$username,$password,$dbname);
    if($conn->connect_error)
    {
        die("Connection failed".$conn->connect_error);
    }
    
    $create_table_sql = "CREATE TABLE FilmNoirUserInfo(id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,username VARCHAR(30) NOT NULL,firstname VARCHAR(30) NOT NULL,lastname VARCHAR(30) NOT NULL,email VARCHAR(50) NOT NULL,password VARCHAR(50) NOT NULL)";
    /*$create_table_sql = "CREATE TABLE usergenrewatched(id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, username VARCHAR(30) NOT NULL,  actionwatched TEXT, adventurewatched TEXT, animationwatched TEXT, thrillerwatched TEXT, comedywatched TEXT, romancewatched TEXT, sciencefictionwatched TEXT, neonoirwatched TEXT, horrorwatched TEXT)";*/

    /*$create_table_sql = "CREATE TABLE usergenreinfo(id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, username VARCHAR(30) NOT NULL, actionliked INT(6), actionwatched INT(6), adventureliked INT(6), adventurewatched INT(6), animationliked INT(6), animationwatched INT(6), thrillerliked INT(6),  thrillerwatched INT(6), comedyliked INT(6), comedywatched INT(6), romanceliked INT(6), romancewatched INT(6), sciencefictionliked INT(6), sciencefictionwatched INT(6), neonoirliked INT(6), neonoirwatched INT(6), horrorliked INT(6), horrorwatched INT(6))";*/

    if($conn->query($create_table_sql) === TRUE)
    {
        echo "Table created successfully";
    }
    else
    {
        echo "Error creating table ".$conn->error;
    }
?>
