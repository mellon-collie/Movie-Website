<?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "terminator";
    $dbname = "FilmNoirDB";
    $conn = new mysqli($servername,$username,$password,$dbname);
    
    if($conn->connect_error)
    {
        die("Connection failed".$conn->error);
    }

    $i = 0;
    $genres = ["action","adventure","animation","thriller","comedy","romance","sciencefiction","neonoir","horror"];
    
    $values = [];
    
    
    $sql = "SELECT * FROM usergenreinfo";
    $result = $conn->query($sql);

    if($result->num_rows>0)
    {
        while($row = $result->fetch_assoc())
        {
            if(strcmp($_SESSION["username"],$row["username"]) === 0)
            {                
                for($i = 0;$i<9;$i++)     
                {           
                    $values[$i] = (int)$row[$genres[$i]."liked"]/(int)$row[$genres[$i]."watched"];
                    $values[$i] = "".$values[$i];
                }
                break;
            }
        }
    }
    session_destroy();
    header("Location:login.php");
?>
