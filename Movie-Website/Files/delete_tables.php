<?php 
    $servername = "localhost";
    $username = "root";
    $password = "terminator";
    $dbname = "FilmNoirDB";
    $conn = new mysqli($servername,$username,$password,$dbname);
    if($conn->connect_error)
    {
        die("Connection failed".$conn->error);
    }
    //$delsql = "DROP TABLE FilmNoirUserInfo";
    //$delsql = "DROP TABLE usergenrewatched";
    //$delsql = "DROP TABLE usergenreinfo";
     if($conn->query($delsql) === TRUE){
        echo "Record deleted successfully";
    } else {
        echo "Error deleted record: ".$conn->error;
    }
    $conn->close();
?>
