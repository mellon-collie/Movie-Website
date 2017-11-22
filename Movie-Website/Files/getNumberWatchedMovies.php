<?php
	session_start();
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$genreName = $_POST["genreName"];
		$genreName = strtolower($genreName);
		$genreName = $genreName."watched";
		$servername = "localhost";
    	$username = "root";
    	$password = "terminator";
    	$dbname = "FilmNoirDB";
    	$conn = new mysqli($servername,$username,$password,$dbname);
    	if($conn->connect_error)
    	{
        	die("Connection failed".$conn->error);
   	    }

    	$sql_watched = "SELECT * FROM usergenrewatched";
    	$result_watched = $conn->query($sql_watched);
    	$count_watched = "";


    	if($result_watched->num_rows>0)
 	    {
    	    while($row = $result_watched->fetch_assoc())
        	{
            	if(strcmp($_SESSION["username"],$row["username"]) === 0)
            	{
                	$watched = $row[$genreName];
                	break;
            	}
        	}
    	}	

    $_SESSION["movies_watched"] = array_map('intval',explode(",",$watched));
    print_r($_SESSION["movies_watched"]);
    }
?>