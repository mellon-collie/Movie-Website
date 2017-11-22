<?php
    session_start();    
    $id = $_POST["movieID"];  
    //echo $id;
    //$id = 293660;  
    $cSession = curl_init('https://api.themoviedb.org/3/movie/'.$id.'?api_key=9fec24ec7d4e672df882a26a2de58930');
    curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($cSession,CURLOPT_HEADER,false);
    $result = curl_exec($cSession);
    curl_close($cSession);  
    $json = json_decode($result);
    echo $json->genres[0]->name;
    //print_r($json);
?>
