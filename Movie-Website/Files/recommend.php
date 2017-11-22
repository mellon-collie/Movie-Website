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


    $sql = "SELECT * FROM usergenreinfo";
    $result = $conn->query($sql);
    $genreNames = ["action","adventure","animation","thriller","comedy","romance","sciencefiction","neonoir","horror"];
    $genres = [];
    $values = [];
    $k = 0;
    if($result->num_rows>0)
    {
        while($row = $result->fetch_assoc())
        {
            if(strcmp($_SESSION["username"],$row["username"]) === 0)
            {                
                for($i = 0;$i<9;$i++)     
                {           
                    
                 	$ratio = (int)$row[$genreNames[$i]."liked"]/(int)$row[$genreNames[$i]."watched"];
                 	if($ratio>=0.8)
                 	{
                        $watched[$k] = (int)$row[$genresNames[$i]."watched"];
                        $genres[$k] = $genreNames[$i];
                        $k++;
                 	}
                }
                break;
            }
        }
    }

    $str = implode(" ",$genres);
    echo $str;
?>