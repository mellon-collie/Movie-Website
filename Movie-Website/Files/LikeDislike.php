<?php
    session_start();
    
    $info = $_POST["genreIDs"];
    $GENRE = $info[0];
    $genre = strtolower($GENRE);
    $genre_watched = $genre."watched";
    $genre_liked = $genre."liked";
    
    $liked = $info[1];
    $watched = $info[2];
    $watchedIndex = $info[3];
    
    $id = -1;
    $count_liked = -1;
    $count_watched = -1;
    //print_r($genreIDS);
    //echo $genre;
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
    
    if($result_watched->num_rows>0)
    {
        while($row = $result_watched->fetch_assoc())
        {
            //echo $row["username"];
            if(strcmp($_SESSION["username"],$row["username"]) === 0)
            {
                $watched = $row[$genre_watched];
                echo "watchedsyesbfaue = ".$watched;
                if(strlen($watched)>=2)
                {
                    $id = $row['id'];  
                    //$watched_before = $watched_before.",".$watchedIndex;
                    
                    $watchedIndex = $watchedIndex.","; 
                    $alter_sql_watched = "UPDATE usergenrewatched SET $genre_watched = CONCAT('$watched','$watchedIndex') where id=$id";
                    //var_dump($watched_before);
                }
                else
                {
                    $id = $row['id'];
                    $watched_before = "".$watchedIndex;
                    $alter_sql_watched = "UPDATE usergenrewatched SET $genre_watched = CONCAT('$watched_before',',') where id=$id";
                }  
                $check = $conn->query($alter_sql_watched);
                $watched = $row;
                break;

            }
           
        }
    }

    $_SESSION["movies_watched"] = array_map('intval',explode(",",$watched));
    $count_liked_watched_before = -1;
    $count_watched_watched_before = -1;
    $id = -1;
    $sql_likedWatched_before = "SELECT * FROM usergenreinfo";
    $result_likedWatched_before = $conn->query($sql_likedWatched_before);
    if($result_likedWatched_before->num_rows>0)
    {
        while($row = $result_likedWatched_before->fetch_assoc())
        {
            if(strcmp($_SESSION["username"],$row["username"]) === 0)
            {
                $id = $row['id'];
                $count_liked_watched_before = $row[$genre_liked];
                $count_watched_watched_before = $row[$genre_watched];
            }
        }
    }  
    $count_liked_watched_before = $count_liked_watched_before + $liked;
    $count_watched_watched_before = $count_watched_watched_before + $watched;
    
    $sql_alter_likedWatched = "SELECT * FROM usergenreinfo";
    $result_alter_likedWatched = $conn->query($sql_alter_likedWatched);
    if($result_alter_likedWatched->num_rows>0)
    {
        while($row = $result_alter_likedWatched->fetch_assoc())
        {
           if(strcmp($_SESSION["username"],$row["username"]) === 0)
           {
                $id = $row['id'];               
                $alter_sql_liked = "UPDATE usergenreinfo SET ".$genre."liked"."=".$count_liked_watched_before." where id=".$id;
                $conn->query($alter_sql_liked);
                $alter_sql_watched = "UPDATE usergenreinfo SET ".$genre."watched"."=".$count_watched_watched_before." where id=".$id;
                $conn->query($alter_sql_watched);
                
                
           }
        }
    }

    $sql_likedWatched_after = "SELECT * FROM usergenreinfo";
    $result_likedWatched_after = $conn->query($sql_likedWatched_after);
    $count_liked_watched_after = -1;
    $count_watched_watched_after = -1;
    if($result_likedWatched_after->num_rows>0)
    {
        while($row = $result_likedWatched_after->fetch_assoc())
        {
            if(strcmp($_SESSION["username"],$row["username"]) === 0)
            {
                $id = $row['id'];
                $count_liked_watched_after = $row[$genre_liked];
                $count_watched_watched_after = $row[$genre_watched];
            }
        }
    }  
    echo "watched = ".$watched_before." liked,watched = ".$count_liked_watched_after.",".$count_watched_watched_after;
?>
